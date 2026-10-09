<?php

namespace Database\Seeders;

use App\Models\B2BCategory;
use Illuminate\Database\Seeder;

class B2BCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'key' => 'medicosoins',
                'name' => 'MedicoSoins',
                'description' => 'Soutien orthopédique',
                'color' => '#3b82f6',
                'is_active' => true,
                'min_products' => 5,
            ],
            [
                'key' => 'confort_soft',
                'name' => 'Confort Soft',
                'description' => 'Douceur absolue',
                'color' => '#8b5cf6',
                'is_active' => true,
                'min_products' => 5,
            ],
            [
                'key' => 'addict',
                'name' => 'Addict',
                'description' => 'Le choix passionné',
                'color' => '#ec4899',
                'is_active' => true,
                'min_products' => 5,
            ],
            [
                'key' => 'luxury',
                'name' => 'Luxury',
                'description' => 'Haut de gamme',
                'color' => '#f59e0b',
                'is_active' => true,
                'min_products' => 5,
            ],
        ];

        foreach ($categories as $category) {
            B2BCategory::query()->updateOrCreate(
                ['key' => $category['key']],
                $category
            );
        }
    }
}
