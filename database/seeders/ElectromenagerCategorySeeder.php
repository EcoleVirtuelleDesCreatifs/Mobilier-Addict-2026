<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElectromenagerCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menu = \App\Models\Menu::where('slug', 'electromenager')->first();

        if (!$menu) {
            return;
        }

        $categories = [
            [
                'name' => 'Gazinières',
                'slug' => 'gazinieres',
                'description' => 'Cuisine au gaz',
                'image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=600&fit=crop',
                'color' => '#3b82f6',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Frigo',
                'slug' => 'frigo',
                'description' => 'Conservation optimale',
                'image' => 'https://images.unsplash.com/photo-1584568694244-14fbdf83bd30?w=800&h=600&fit=crop',
                'color' => '#8b5cf6',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Climatiseurs',
                'slug' => 'climatiseurs',
                'description' => 'Fraîcheur garantie',
                'image' => 'https://images.unsplash.com/photo-1631679706909-1844bbd07221?w=800&h=600&fit=crop',
                'color' => '#ec4899',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Mixeurs',
                'slug' => 'mixeurs',
                'description' => 'Préparation facile',
                'image' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=800&h=600&fit=crop',
                'color' => '#f59e0b',
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = \App\Models\Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
            $category->menus()->sync([$menu->id]);
        }
    }
}
