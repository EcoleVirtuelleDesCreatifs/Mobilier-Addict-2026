<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\MatelasMenuSeeder;
use Database\Seeders\ProtegeMatelasMenuSeeder;
use Database\Seeders\MatelasDemoSeeder;
use Database\Seeders\MenuOrderSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            MatelasMenuSeeder::class,
            ProtegeMatelasMenuSeeder::class,
            MatelasDemoSeeder::class,
            MenuOrderSeeder::class,
        ]);
    }
}
