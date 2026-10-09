<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = \App\Models\Category::where('is_active', true)->get();
        $products = \App\Models\Product::where('is_active', true)->get();

        if ($categories->isEmpty() || $products->isEmpty()) {
            return;
        }

        // Distribute products among categories
        $categoryIndex = 0;
        foreach ($products as $product) {
            $category = $categories[$categoryIndex % $categories->count()];
            $category->productsMany()->syncWithoutDetaching([$product->id]);
            $categoryIndex++;
        }

        // Ensure each category has at least 3 products
        foreach ($categories as $category) {
            $currentProductIds = $category->productsMany()->pluck('products.id')->toArray();
            if (count($currentProductIds) < 3) {
                // Get products not already attached to this category
                $availableProducts = $products->whereNotIn('id', $currentProductIds);
                $needed = 3 - count($currentProductIds);
                
                foreach ($availableProducts->take($needed) as $product) {
                    $category->productsMany()->syncWithoutDetaching([$product->id]);
                }
            }
        }
    }
}
