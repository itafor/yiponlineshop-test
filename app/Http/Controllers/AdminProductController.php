<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Services\CloudinaryUploader;
use App\Services\SmartyRenderer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Throwable;

class AdminProductController extends Controller
{
    public function index(Request $request, SmartyRenderer $smarty)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:160'],
            'status' => ['nullable', 'in:active,inactive'],
        ]);

        $products = Product::with('images')
            ->when($filters['search'] ?? null, function ($query, string $search): void {
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->when($filters['status'] ?? null, function ($query, string $status): void {
                $query->where('is_active', $status === 'active');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return $smarty->render('admin/products/index.tpl', [
            'products' => $products,
            'filters' => [
                'search' => $filters['search'] ?? '',
                'status' => $filters['status'] ?? '',
            ],
            'pagination' => [
                'currentPage' => $products->currentPage(),
                'lastPage' => $products->lastPage(),
                'total' => $products->total(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem(),
                'previousUrl' => $products->previousPageUrl(),
                'nextUrl' => $products->nextPageUrl(),
            ],
        ]);
    }

    public function create(SmartyRenderer $smarty)
    {
        return $smarty->render('admin/products/create.tpl', [
            'product' => null,
            'formAction' => '/admin/products',
            'formMethod' => 'POST',
            'submitText' => 'Create Product',
            'busyText' => 'Creating product...',
        ]);
    }

    public function show(Product $product, SmartyRenderer $smarty)
    {
        return $smarty->render('admin/products/show.tpl', [
            'product' => $product->load('images'),
        ]);
    }

    public function store(Request $request, CloudinaryUploader $cloudinary)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:160', 'unique:products,name'],
            'description' => ['required', 'string', 'max:2000'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'images' => ['required', 'array', 'min:1', 'max:8'],
            'images.*' => ['required', 'image', 'max:8192'],
        ]);

        $uploads = [];

        try {
            foreach ($request->file('images', []) as $image) {
                $uploads[] = $cloudinary->upload($image);
            }
        } catch (Throwable $exception) {
            report($exception);

            return back()
                ->withInput($request->except('images'))
                ->with('error', 'The product images could not be uploaded to Cloudinary. Please check your internet connection and Cloudinary credentials, then try again.');
        }

        DB::transaction(function () use ($data, $uploads): void {
            $product = Product::create([
                'name' => $data['name'],
                'slug' => $this->uniqueSlug($data['name']),
                'description' => $data['description'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'image_url' => $uploads[0]['url'],
                'is_active' => true,
            ]);

            foreach ($uploads as $index => $upload) {
                $product->images()->create([
                    'url' => $upload['url'],
                    'public_id' => $upload['public_id'],
                    'sort_order' => $index,
                ]);
            }
        });

        return redirect('/admin/products')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product, SmartyRenderer $smarty)
    {
        return $smarty->render('admin/products/edit.tpl', [
            'product' => $product->load('images'),
            'formAction' => '/admin/products/'.$product->slug,
            'formMethod' => 'PATCH',
            'submitText' => 'Update Product',
            'busyText' => 'Updating product..',
        ]);
    }

    public function update(Request $request, Product $product, CloudinaryUploader $cloudinary)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:160', Rule::unique('products', 'name')->ignore($product->id)],
            'description' => ['required', 'string', 'max:2000'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'images' => ['nullable', 'array', 'max:8'],
            'images.*' => ['required', 'image', 'max:8192'],
        ]);

        $uploads = [];

        try {
            foreach ($request->file('images', []) as $image) {
                $uploads[] = $cloudinary->upload($image);
            }
        } catch (Throwable $exception) {
            report($exception);

            return back()
                ->withInput($request->except('images'))
                ->with('error', 'The new product images could not be uploaded to Cloudinary. Please try again.');
        }

        DB::transaction(function () use ($data, $product, $uploads): void {
            $slug = $product->name === $data['name'] ? $product->slug : $this->uniqueSlug($data['name'], $product->id);

            $product->update([
                'name' => $data['name'],
                'slug' => $slug,
                'description' => $data['description'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'is_active' => (bool) ($data['is_active'] ?? false),
            ]);

            $nextSortOrder = (int) $product->images()->max('sort_order') + 1;

            foreach ($uploads as $index => $upload) {
                $product->images()->create([
                    'url' => $upload['url'],
                    'public_id' => $upload['public_id'],
                    'sort_order' => $nextSortOrder + $index,
                ]);
            }

            $this->syncMainImage($product);
        });

        return redirect('/admin/products')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product, CloudinaryUploader $cloudinary)
    {
        if ($product->orderItems()->exists()) {
            return back()->with('error', 'This product has been ordered and cannot be deleted.');
        }

        $product->load('images');

        foreach ($product->images as $image) {
            $cloudinary->destroy($image->public_id);
        }

        $product->delete();

        return redirect('/admin/products')->with('success', 'Product deleted successfully.');
    }

    public function destroyImage(Product $product, ProductImage $image, CloudinaryUploader $cloudinary)
    {
        abort_unless($image->product_id === $product->id, 404);
        abort_if($product->images()->count() <= 1, 422, 'A product must keep at least one image.');

        $cloudinary->destroy($image->public_id);
        $image->delete();
        $this->syncMainImage($product);

        return back()->with('success', 'Product image deleted.');
    }

    private function uniqueSlug(string $name, ?int $ignoreProductId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $counter = 2;

        while (Product::where('slug', $slug)->when($ignoreProductId, fn ($query) => $query->where('id', '!=', $ignoreProductId))->exists()) {
            $slug = $base.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    private function syncMainImage(Product $product): void
    {
        $mainImage = $product->images()->orderBy('sort_order')->first();

        if ($mainImage) {
            $product->forceFill(['image_url' => $mainImage->url])->save();
        }
    }
}
