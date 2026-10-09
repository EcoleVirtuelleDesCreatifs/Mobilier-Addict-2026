<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class ProtegeMatelasMenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::query()->firstOrCreate(
            ['slug' => 'protege-matelas'],
            [
                'name' => 'Protège Matelas',
                'url' => null,
                'icon' => null,
                'parent_id' => null,
                'order' => 0,
                'position' => 'header',
                'is_active' => true,
                'open_new_tab' => false,
            ]
        );
    }
}
