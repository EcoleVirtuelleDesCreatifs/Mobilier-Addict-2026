<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MatelasDemoSeeder extends Seeder
{
    public function run(): void
    {
        $menu = Menu::query()->firstOrCreate(
            ['slug' => 'matelas'],
            [
                'name' => 'Matelas',
                'url' => null,
                'icon' => null,
                'parent_id' => null,
                'order' => 0,
                'position' => 'header',
                'is_active' => true,
                'open_new_tab' => false,
            ]
        );

        $images = [
            'uploads/products/1769633758_1aFM61Dr6y.png',
            'uploads/products/1769633758_8nx0aFBMa9.png',
            'uploads/products/1769633758_C8EczcSmAo.png',
            'uploads/products/1769633758_K4AyQQSICj.png',
            'uploads/products/1769633843_5Pjm0gnxBO.png',
            'uploads/products/1769633843_5kV3lB6FcU.png',
            'uploads/products/1769633843_NGP2aZjxnp.png',
            'uploads/products/1769633843_dpVkLcbEOj.png',
            'uploads/products/1769633931_5TFXsfW2tH.png',
            'uploads/products/1769633931_LzTNVfwwNn.png',
            'uploads/products/1769633931_YENcXls1JM.png',
            'uploads/products/1769633931_wDEepbpVBy.png',
        ];

        $defs = [
            [
                'prefix' => 'Medicosoins',
                'firmness' => 'medicosoins',
                'names' => ['PH6 Extra Ferme', 'PH5 Orthopédique', 'PH4 Posture Plus'],
                'base_price' => 85000,
            ],
            [
                'prefix' => 'Confort Soft',
                'firmness' => 'confort_soft',
                'names' => ['Douce Nuit', 'Nuage', 'Relax Soft'],
                'base_price' => 65000,
            ],
            [
                'prefix' => 'Addict',
                'firmness' => 'addict',
                'names' => ['Addict Pro', 'Addict Air', 'Addict Confort'],
                'base_price' => 95000,
            ],
            [
                'prefix' => 'Luxury',
                'firmness' => 'luxury',
                'names' => ['Luxury Royal', 'Luxury Premium', 'Luxury Palace'],
                'base_price' => 120000,
            ],
        ];

        $createdProductIds = [];
        $imgIdx = 0;

        foreach ($defs as $group) {
            foreach ($group['names'] as $i => $suffix) {
                $name = $group['prefix'] . ' ' . $suffix;
                $slugBase = Str::slug($name);
                $slug = $slugBase;

                $n = 1;
                while (Product::query()->where('slug', $slug)->exists()) {
                    $n++;
                    $slug = $slugBase . '-' . $n;
                }

                $image = $images[$imgIdx % count($images)];
                $imgIdx++;

                $product = Product::query()->updateOrCreate(
                    ['slug' => $slug],
                    [
                        'name' => $name,
                        'short_description' => 'Matelas ' . $group['prefix'] . ' — soutien et confort pour un sommeil réparateur.',
                        'description' => null,
                        'image' => $image,
                        'gallery' => null,
                        'price' => (float) $group['base_price'],
                        'old_price' => null,
                        'discount_percent' => null,
                        'category_id' => null,
                        'badge' => null,
                        'badge_type' => null,
                        'stock' => 20,
                        'sku' => null,
                        'dimensions' => null,
                        'material' => 'Mousse + tissu respirant',
                        'color' => null,
                        'rating' => 4.8,
                        'reviews_count' => 12,
                        'firmness' => $group['firmness'],
                        'thickness' => null,
                        'size' => null,
                        'is_featured' => false,
                        'is_bestseller' => $i === 0,
                        'is_collection' => true,
                        'is_active' => true,
                        'order' => 0,
                    ]
                );

                $createdProductIds[] = (int) $product->id;

                $variants = [
                    ['thickness_cm' => 20, 'places' => 1, 'price' => $group['base_price'] + 0],
                    ['thickness_cm' => 25, 'places' => 2, 'price' => $group['base_price'] + 20000],
                    ['thickness_cm' => 30, 'places' => 3, 'price' => $group['base_price'] + 40000],
                ];

                foreach ($variants as $v) {
                    ProductVariant::query()->updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'thickness_cm' => (int) $v['thickness_cm'],
                            'places' => (int) $v['places'],
                        ],
                        [
                            'price' => (float) $v['price'],
                            'old_price' => null,
                            'discount_percent' => null,
                            'stock' => 10,
                            'sku' => null,
                            'is_active' => true,
                        ]
                    );
                }
            }
        }

        if (!empty($createdProductIds)) {
            $menu->products()->syncWithoutDetaching(array_values(array_unique($createdProductIds)));
        }
    }
}
