<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NewsletterSubscriptionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\HomeSectionController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController as FrontMenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UniversController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\NewsletterController;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/sitemap.xml', function () {
    $urls = [];

    $add = function (string $loc, ?string $lastmod = null) use (&$urls) {
        $urls[] = [
            'loc' => $loc,
            'lastmod' => $lastmod,
        ];
    };

    $add(route('home'), Carbon::now()->toDateString());
    $add(route('collection.index'));
    $add(route('blog.index'));
    $add(route('pages.about'));
    $add(route('pages.contact'));
    $add(route('pages.customer-service'));
    $add(route('pages.shipping-returns'));
    $add(route('pages.faq'));
    $add(route('pages.legal'));
    $add(route('pages.privacy'));
    $add(route('pages.cgv'));
    $add(route('pages.guides.mattress'));
    $add(route('pages.guides.pillow'));
    $add(route('pages.guides.care'));

    if (Schema::hasTable('categories')) {
        Category::query()->select(['slug', 'updated_at'])->whereNotNull('slug')->get()->each(function ($category) use ($add) {
            $add(route('univers.show', $category->slug), optional($category->updated_at)->toDateString());
        });
    }

    if (Schema::hasTable('menus') && Schema::hasTable('menu_product')) {
        Menu::query()
            ->select(['slug', 'updated_at', 'is_active'])
            ->where('is_active', true)
            ->whereNotNull('slug')
            ->get()
            ->each(function ($menu) use ($add) {
                $slug = strtolower((string) $menu->slug);
                if (in_array($slug, ['accueil', 'home'], true)) {
                    return;
                }
                $add(route('menu.show', $menu->slug), optional($menu->updated_at)->toDateString());
            });
    }

    if (Schema::hasTable('products')) {
        Product::query()->select(['slug', 'updated_at', 'is_active'])->where('is_active', true)->whereNotNull('slug')->get()->each(function ($product) use ($add) {
            $add(route('product.show', $product->slug), optional($product->updated_at)->toDateString());
        });
    }

    if (Schema::hasTable('blog_posts')) {
        BlogPost::query()->select(['slug', 'updated_at'])->whereNotNull('slug')->get()->each(function ($post) use ($add) {
            $add(route('blog.show', $post->slug), optional($post->updated_at)->toDateString());
        });
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($urls as $row) {
        $xml .= "  <url>\n";
        $xml .= '    <loc>' . htmlspecialchars($row['loc'], ENT_XML1) . "</loc>\n";
        if (!empty($row['lastmod'])) {
            $xml .= '    <lastmod>' . htmlspecialchars($row['lastmod'], ENT_XML1) . "</lastmod>\n";
        }
        $xml .= "  </url>\n";
    }

    $xml .= "</urlset>\n";

    return response($xml, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/prix', function () {
    return view('pricing');
})->name('pricing');

Route::view('/a-propos', 'pages.about')->name('pages.about');
Route::view('/contact', 'pages.contact')->name('pages.contact');
Route::view('/service-client', 'pages.customer-service')->name('pages.customer-service');
Route::view('/livraison-retours', 'pages.shipping-returns')->name('pages.shipping-returns');
Route::view('/faq', 'pages.faq')->name('pages.faq');

Route::view('/mentions-legales', 'pages.legal')->name('pages.legal');
Route::view('/politique-de-confidentialite', 'pages.privacy')->name('pages.privacy');
Route::view('/cgv', 'pages.cgv')->name('pages.cgv');

Route::view('/guides/achat-matelas', 'pages.guides.mattress')->name('pages.guides.mattress');
Route::view('/guides/choisir-oreiller', 'pages.guides.pillow')->name('pages.guides.pillow');
Route::view('/guides/entretien-literie', 'pages.guides.care')->name('pages.guides.care');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/search/suggest', [SearchController::class, 'suggest'])->name('search.suggest');

Route::get('/collection', function () {
    $products = Product::query()
        ->active()
        ->collection()
        ->ordered()
        ->get();

    if ($products->isEmpty()) {
        $products = Product::query()
            ->active()
            ->ordered()
            ->get();
    }

    return view('collection', compact('products'));
})->name('collection.index');

// Cart routes
Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::post('/panier/ajouter', [CartController::class, 'add'])->name('cart.add');
Route::post('/panier/modifier', [CartController::class, 'update'])->name('cart.update');
Route::post('/panier/supprimer', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/panier/livraison', [CartController::class, 'shipping'])->name('cart.shipping');
Route::post('/panier/livraison', [CartController::class, 'storeShipping'])->name('cart.shipping.store');
Route::get('/panier/paiement', [CartController::class, 'payment'])->name('cart.payment');
Route::post('/panier/paiement', [CartController::class, 'placeOrder'])->name('cart.placeOrder');
Route::get('/panier/confirmation/{order}', [CartController::class, 'confirmation'])->name('cart.confirmation');

Route::get('/menu', fn () => redirect()->route('home'));
Route::get('/menu/{slug}', [FrontMenuController::class, 'show'])->name('menu.show');
Route::get('/univers/{slug}', [UniversController::class, 'show'])->name('univers.show');
Route::get('/produit/{slug}', [ProductController::class, 'show'])->name('product.show');

// Demo product page (hardcoded)
Route::get('/demo/produit', function () {
    $product = Product::query()->where('slug', 'matelas-harmonie-confort-nuage')->first();

    if (!$product) {
        $product = Product::query()->active()->ordered()->first();
    }

    if (!$product) {
        $product = Product::query()->create([
            'name' => 'Matelas Harmonie – Confort Nuage',
            'slug' => 'matelas-harmonie-confort-nuage',
            'short_description' => 'Mi-ferme • Anti-pression • Ventilation 3D',
            'description' => "Le Matelas Harmonie est conçu pour offrir un équilibre parfait entre soutien et confort. Sa technologie de mousse à mémoire de forme s'adapte à votre morphologie pour un sommeil réparateur.\n\nCaractéristiques principales :\n- Épaisseur : 25 cm\n- Densité : 55 kg/m³\n- Face été / face hiver\n- Certifié Oeko-Tex\n- Garantie 10 ans",
            'image' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&h=800&fit=crop',
            'gallery' => [
                'https://images.unsplash.com/photo-1616627561839-074385245ff6?w=400&h=400&fit=crop',
                'https://images.unsplash.com/photo-1615873968403-89e068629265?w=400&h=400&fit=crop',
            ],
            'price' => 79000,
            'old_price' => 99000,
            'discount_percent' => 20,
            'stock' => 50,
            'is_active' => true,
            'order' => 0,
        ]);
    }

    $relatedProducts = Product::query()
        ->active()
        ->ordered()
        ->where('id', '!=', $product->id)
        ->take(4)
        ->get();

    return view('products.show', compact('product', 'relatedProducts'));
})->name('demo.product');

Route::get('/login', function () {
    return redirect()->route('login');
});

Route::get('/admin/login', function () {
    return redirect()->route('login');
});

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::prefix('ma/admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/home/monthly-stats', [DashboardController::class, 'monthlyStats'])->name('admin.dashboard.monthly-stats');

    Route::get('/stats', [StatsController::class, 'index'])->name('admin.stats.index');

    Route::get('/newsletter', [NewsletterSubscriptionController::class, 'index'])->name('admin.newsletter.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile');

    Route::get('/editor', fn () => redirect()->route('admin.dashboard'))->name('admin.editor');
    Route::get('/writer', fn () => redirect()->route('admin.dashboard'))->name('admin.writer');

    Route::get('/articles', [ArticleController::class, 'index'])->name('admin.articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('admin.articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('admin.articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('admin.articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('admin.articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');
    Route::post('/articles/upload-image', [ArticleController::class, 'uploadImage'])->name('admin.articles.upload-image');

    Route::get('/person-week', fn () => redirect()->route('admin.dashboard'))->name('admin.person-week.index');
    Route::get('/person-week/create', fn () => redirect()->route('admin.dashboard'))->name('admin.person-week.create');

    Route::get('/jobs', fn () => redirect()->route('admin.dashboard'))->name('admin.jobs.index');
    Route::get('/jobs/create', fn () => redirect()->route('admin.dashboard'))->name('admin.jobs.create');

    Route::get('/flash-news', fn () => redirect()->route('admin.dashboard'))->name('admin.flash-news.index');
    Route::get('/flash-news/create', fn () => redirect()->route('admin.dashboard'))->name('admin.flash-news.create');

    Route::resource('menus', MenuController::class)->names('admin.menus');

    Route::get('/users', fn () => redirect()->route('admin.dashboard'))->name('admin.users.index');
    Route::get('/users/create', fn () => redirect()->route('admin.dashboard'))->name('admin.users.create');
    Route::get('/users/stats', fn () => redirect()->route('admin.dashboard'))->name('admin.users.stats');

    Route::get('/roles', fn () => redirect()->route('admin.dashboard'))->name('admin.roles.index');
    Route::get('/roles/create', fn () => redirect()->route('admin.dashboard'))->name('admin.roles.create');

    Route::get('/slider', [SliderController::class, 'index'])->name('admin.slider.index');
    Route::get('/slider/create', [SliderController::class, 'create'])->name('admin.slider.create');
    Route::post('/slider', [SliderController::class, 'store'])->name('admin.slider.store');
    Route::get('/slider/{slider}/edit', [SliderController::class, 'edit'])->name('admin.slider.edit');
    Route::put('/slider/{slider}', [SliderController::class, 'update'])->name('admin.slider.update');
    Route::delete('/slider/{slider}', [SliderController::class, 'destroy'])->name('admin.slider.destroy');

    Route::get('/save-the-date', fn () => redirect()->route('admin.dashboard'))->name('admin.save-the-date.index');
    Route::get('/save-the-date/create', fn () => redirect()->route('admin.dashboard'))->name('admin.save-the-date.create');

    Route::post('/products/{product}/toggle-active', [AdminProductController::class, 'toggleActive'])->name('admin.products.toggle-active');
    Route::resource('products', AdminProductController::class)->names('admin.products');
    Route::resource('categories', CategoryController::class)->names('admin.categories');
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');

    Route::get('/quotes', [QuoteController::class, 'index'])->name('admin.quotes.index');
    Route::get('/quotes/{quote}', [QuoteController::class, 'show'])->name('admin.quotes.show');
    Route::post('/orders/{order}/quotes', [QuoteController::class, 'storeFromOrder'])->name('admin.orders.quotes.store');
    Route::post('/quotes/{quote}/status', [QuoteController::class, 'updateStatus'])->name('admin.quotes.status');

    Route::get('/invoices', [InvoiceController::class, 'index'])->name('admin.invoices.index');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('admin.invoices.show');
    Route::post('/orders/{order}/invoices', [InvoiceController::class, 'storeFromOrder'])->name('admin.orders.invoices.store');
    Route::post('/invoices/{invoice}/status', [InvoiceController::class, 'updateStatus'])->name('admin.invoices.status');

    Route::get('/home-sections', [HomeSectionController::class, 'index'])->name('admin.home_sections.index');
    Route::get('/home-sections/create', [HomeSectionController::class, 'create'])->name('admin.home_sections.create');
    Route::post('/home-sections', [HomeSectionController::class, 'store'])->name('admin.home_sections.store');
    Route::get('/home-sections/{home_section}/edit', [HomeSectionController::class, 'edit'])->name('admin.home_sections.edit');
    Route::put('/home-sections/{home_section}', [HomeSectionController::class, 'update'])->name('admin.home_sections.update');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
