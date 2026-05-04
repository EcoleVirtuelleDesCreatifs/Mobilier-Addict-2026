<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatelasCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menu = \App\Models\Menu::where('slug', 'matelas')->first();

        if (!$menu) {
            return;
        }

        $categories = [
            [
                'name' => 'MedicoSoins',
                'slug' => 'medicosoins',
                'description' => 'Soutien orthopédique',
                'image' => 'https://images.unsplash.com/photo-1632778149955-e80f8ceca2e8?w=800&h=600&fit=crop',
                'color' => '#3b82f6',
                'is_active' => true,
                'order' => 1,
                'menu_id' => $menu->id,
            ],
            [
                'name' => 'Confort Soft',
                'slug' => 'confort_soft',
                'description' => 'Douceur absolue',
                'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=800&h=600&fit=crop',
                'color' => '#8b5cf6',
                'is_active' => true,
                'order' => 2,
                'menu_id' => $menu->id,
            ],
            [
                'name' => 'Addict',
                'slug' => 'addict',
                'description' => 'Le choix passionné',
                'image' => 'https://images.unsplash.com/photo-1505693314120-0d443867891c?w=800&h=600&fit=crop',
                'color' => '#ec4899',
                'is_active' => true,
                'order' => 3,
                'menu_id' => $menu->id,
            ],
            [
                'name' => 'Luxury',
                'slug' => 'luxury',
                'description' => 'Haut de gamme',
                'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=800&h=600&fit=crop',
                'color' => '#f59e0b',
                'is_active' => true,
                'order' => 4,
                'menu_id' => $menu->id,
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
