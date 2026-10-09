<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\NewsletterSubscription;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'stats' => [
                'products' => Product::count(),
                'categories' => Category::count(),
                'posts' => BlogPost::count(),
                'slides' => Slide::count(),
                'newsletter' => NewsletterSubscription::count(),
                'users' => User::count(),
            ],
            'ordersMissing' => ! Schema::hasTable('orders'),
            'ordersTotalCount' => Schema::hasTable('orders') ? Order::count() : 0,
            'ordersPendingCount' => Schema::hasTable('orders') ? Order::where('status', 'pending')->count() : 0,
            'lowStockCount' => Product::where('stock', '<=', 5)->count(),
            'productsOnlineCount' => Product::where('is_active', true)->count(),
            'productsOfflineCount' => Product::where('is_active', false)->count(),
            'latestOrders' => Schema::hasTable('orders')
                ? Order::query()->orderByDesc('created_at')->limit(6)->get()
                : collect(),
            'latestProducts' => Product::query()->orderByDesc('created_at')->limit(6)->get(),
        ]);
    }
}
