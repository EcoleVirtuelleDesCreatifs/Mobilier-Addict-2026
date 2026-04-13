<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuOrderSeeder extends Seeder
{
    public function run(): void
    {
        $menuOrder = [
            '/' => ['order' => 1],
            'protege-matelas-impermeable' => ['order' => 2],
            'meuble-et-fauteuil' => ['order' => 3],
            'lit-canape' => ['order' => 4],
            'electromenager' => ['order' => 5],
            'matelas' => ['order' => 6],
            'oreillers-et-taies' => ['order' => 7],
            'drap-et-couettes' => ['order' => 8],
        ];

        foreach ($menuOrder as $slug => $orderData) {
            $menu = Menu::query()->where('slug', $slug)->first();
            if ($menu) {
                $menu->update($orderData);
                echo "Updated menu: {$menu->name} (slug: {$menu->slug}) to order {$orderData['order']}\n";
            } else {
                echo "Menu not found with slug: {$slug}\n";
            }
        }
    }
}
