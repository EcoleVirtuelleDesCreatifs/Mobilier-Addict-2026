<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\NewsletterSubscription;
use App\Models\Product;
use App\Models\Section;
use App\Models\Slide;

class DashboardController extends Controller
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

        $homeSections = Section::query()->whereIn('slug', ['categories', 'electro'])->get()->keyBy('slug');

        return view('admin.dashboard', [
            'stats' => [
                'products' => Product::count(),
                'categories' => Category::count(),
                'posts' => BlogPost::count(),
                'slides' => Slide::count(),
                'newsletter' => NewsletterSubscription::count(),
            ],
            'homeSections' => $homeSections,
        ]);
    }
}
