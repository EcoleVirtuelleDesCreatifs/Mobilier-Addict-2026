<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuOrderSeeder extends Seeder
{
    public function run(): void
    {
        $menuOrder = [
            'accueil' => ['position' => 1, 'order' => 1],
            'chambre' => ['position' => 1, 'order' => 2],
            'protege-matelas' => ['position' => 1, 'order' => 3],
            'meuble-et-fauteuil' => ['position' => 1, 'order' => 4],
            'lit-et-canape' => ['position' => 1, 'order' => 5],
            'electromenager' => ['position' => 1, 'order' => 6],
        ];

        foreach ($menuOrder as $slug => $orderData) {
            $menu = Menu::query()->where('slug', $slug)->first();
            if ($menu) {
                $menu->update($orderData);
            }
        }
    }
}
