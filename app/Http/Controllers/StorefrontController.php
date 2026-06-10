<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\SmartyRenderer;

class StorefrontController extends Controller
{
    public function index(SmartyRenderer $smarty)
    {
        return $smarty->render('products/index.tpl', [
            'products' => Product::with('images')->where('is_active', true)->latest()->get(),
        ]);
    }

    public function show(Product $product, SmartyRenderer $smarty)
    {
        abort_unless($product->is_active, 404);

        return $smarty->render('products/show.tpl', [
            'product' => $product->load('images'),
            'galleryImages' => $product->galleryImages()->values(),
        ]);
    }
}
