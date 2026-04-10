<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MatelasMenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::query()->firstOrCreate(
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
    }
}
