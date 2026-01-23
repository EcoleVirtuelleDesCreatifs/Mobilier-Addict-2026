<?php

namespace App\Http\Controllers;

use App\Models\Section;

class HomeController extends Controller
{
    public function index()
    {
        Section::query()->firstOrCreate(
            ['slug' => 'categories'],
            [
                'badge' => 'Explorez nos univers',
                'badge_icon' => '🛒',
                'title' => 'Trouvez Votre Bonheur',
                'description' => null,
                'background_color' => null,
                'type' => 'categories',
                'order' => 1,
                'is_active' => true,
            ]
        );

        Section::query()->firstOrCreate(
            ['slug' => 'electro'],
            [
                'badge' => 'Électroménager & Meubles',
                'badge_icon' => '🔌',
                'title' => 'Équipez Votre Maison',
                'description' => null,
                'background_color' => null,
                'type' => 'categories',
                'order' => 2,
                'is_active' => true,
            ]
        );

        $homeSections = Section::query()
            ->active()
            ->whereIn('slug', ['categories', 'electro'])
            ->with([
                'categories' => function ($query) {
                    $query->active()->ordered()->withCount(['products as products_rel_count'])->take(4);
                },
            ])
            ->get()
            ->keyBy('slug');

        return view('home', compact('homeSections'));
    }
}
