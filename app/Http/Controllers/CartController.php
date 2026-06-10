<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\SmartyRenderer;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(SmartyRenderer $smarty)
    {
        return $smarty->render('cart/index.tpl', $this->cartViewData());
    }

    public function add(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:20'],
        ]);

        if (! $product->is_active || $product->stock < 1) {
            return back()->with('error', "{$product->name} is out of stock.");
        }

        $items = session('cart.items', []);
        $requestedQuantity = ($items[$product->id]['quantity'] ?? 0) + $data['quantity'];

        if ($requestedQuantity > $product->stock) {
            return back()->with('error', "Only {$product->stock} unit(s) of {$product->name} are available.");
        }

        $items[$product->id] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'price' => (float) $product->price,
            'image_url' => $product->image_url,
            'quantity' => $requestedQuantity,
        ];

        session(['cart.items' => $items]);

        return redirect('/cart')->with('success', 'Product added to cart.');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:0', 'max:20'],
        ]);

        $items = session('cart.items', []);

        if ($data['quantity'] === 0) {
            unset($items[$product->id]);
        } elseif (isset($items[$product->id])) {
            if ($product->stock < 1) {
                unset($items[$product->id]);
                session(['cart.items' => $items]);

                return back()->with('error', "{$product->name} is out of stock and was removed from your cart.");
            }

            if ($data['quantity'] > $product->stock) {
                return back()->with('error', "Only {$product->stock} unit(s) of {$product->name} are available.");
            }

            $items[$product->id]['quantity'] = $data['quantity'];
        }

        session(['cart.items' => $items]);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Product $product)
    {
        $items = session('cart.items', []);
        unset($items[$product->id]);
        session(['cart.items' => $items]);

        return back()->with('success', 'Item removed.');
    }

    private function cartViewData(): array
    {
        $items = collect(session('cart.items', []))->map(function (array $item) {
            $item['line_total'] = $item['price'] * $item['quantity'];
            return $item;
        })->values();

        return [
            'items' => $items,
            'cartTotal' => $items->sum('line_total'),
        ];
    }
}
