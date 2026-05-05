<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LitCanapeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menu = \App\Models\Menu::where('slug', 'lit-canape')->first();

        if (!$menu) {
            return;
        }

        $categories = [
            [
                'name' => 'Fauteuil',
                'slug' => 'fauteuil',
                'description' => 'Confort et style',
                'image' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=800&h=600&fit=crop',
                'color' => '#3b82f6',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Table à manger',
                'slug' => 'table_manger',
                'description' => 'Design fonctionnel',
                'image' => 'https://images.unsplash.com/photo-1617806118233-18e1de247200?w=800&h=600&fit=crop',
                'color' => '#8b5cf6',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Bureaux',
                'slug' => 'bureaux',
                'description' => 'Espace travail',
                'image' => 'https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?w=800&h=600&fit=crop',
                'color' => '#ec4899',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Canapés',
                'slug' => 'canapes',
                'description' => 'Détente optimale',
                'image' => 'https://images.unsplash.com/photo-1550226891-ef816aed4a98?w=800&h=600&fit=crop',
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
