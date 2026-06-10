<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@yiponline.test',
        ], [
            'name' => 'YipOnline Admin',
            'password' => Hash::make('password123'),
            'is_admin' => true,
        ]);

        User::updateOrCreate([
            'email' => 'customer@yiponline.test',
        ], [
            'name' => 'Demo Customer',
            'password' => Hash::make('password123'),
            'is_admin' => false,
        ]);

        $products = [
            [
                'name' => 'Growth Starter Kit',
                'description' => 'A practical business toolkit with planning templates, reporting sheets, and launch checklists for small teams.',
                'price' => 24500,
                'stock' => 18,
                'image_url' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=900&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=900&q=80',
                ],
            ],
            [
                'name' => 'Retail Display Pack',
                'description' => 'Clean signage, shelf labels, and campaign cards for stores that want a sharper customer experience.',
                'price' => 38500,
                'stock' => 11,
                'image_url' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=900&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1472851294608-062f824d29cc?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=900&q=80',
                ],
            ],
            [
                'name' => 'SaaS Launch Bundle',
                'description' => 'Landing copy worksheets, onboarding email samples, and customer feedback forms for digital product teams.',
                'price' => 52000,
                'stock' => 9,
                'image_url' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=900&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=900&q=80',
                ],
            ],
            [
                'name' => 'Market Research Sprint',
                'description' => 'A focused research package with survey scripts, competitor tracking sheets, and interview guides.',
                'price' => 61000,
                'stock' => 7,
                'image_url' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=900&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=900&q=80',
                ],
            ],
        ];

        foreach ($products as $product) {
            $images = $product['images'];
            unset($product['images']);

            $model = Product::updateOrCreate([
                'slug' => Str::slug($product['name']),
            ], $product + ['is_active' => true]);

            $model->images()->delete();

            foreach ($images as $index => $imageUrl) {
                $model->images()->create([
                    'url' => $imageUrl,
                    'sort_order' => $index,
                ]);
            }
        }
    }
}
