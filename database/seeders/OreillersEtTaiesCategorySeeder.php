<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OreillersEtTaiesCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menu = \App\Models\Menu::where('slug', 'oreillers-et-taies')->first();

        if (!$menu) {
            return;
        }

        $categories = [
            [
                'name' => 'MedicoSoins',
                'slug' => 'medicosoins',
                'description' => 'Soutien orthopédique',
                'image' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&h=600&fit=crop',
                'color' => '#3b82f6',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Confort Soft',
                'slug' => 'confort_soft',
                'description' => 'Douceur absolue',
                'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=800&h=600&fit=crop',
                'color' => '#8b5cf6',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Addict',
                'slug' => 'addict',
                'description' => 'Le choix passionné',
                'image' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=800&h=600&fit=crop',
                'color' => '#ec4899',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Luxury',
                'slug' => 'luxury',
                'description' => 'Haut de gamme',
                'image' => 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800&h=600&fit=crop',
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
