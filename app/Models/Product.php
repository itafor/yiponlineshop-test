<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image_url',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function galleryImages()
    {
        $images = $this->relationLoaded('images') ? $this->images : $this->images()->get();

        if ($images->isNotEmpty()) {
            return $images;
        }

        return collect([(object) [
            'url' => $this->image_url,
            'public_id' => null,
            'sort_order' => 0,
        ]])->filter(fn ($image) => filled($image->url));
    }
}
