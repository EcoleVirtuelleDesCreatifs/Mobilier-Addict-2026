<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\B2BCategoryController;
use App\Http\Controllers\Admin\FeaturedCategoryController;
use App\Http\Controllers\Admin\SaveTheDateController;
use App\Http\Controllers\B2BController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\NewsletterSubscriptionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\HomeSectionController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\FacebookPixelController;
use App\Http\Controllers\Admin\NewProductsButtonController;
use App\Http\Controllers\Admin\SpaceSectionController;
use App\Http\Controllers\Admin\SpaceCardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController as FrontMenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UniversController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\NewsletterController;
use App\Http\Middleware\TrackPageView;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::middleware(TrackPageView::class)->group(function () {
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
        ->ordered()
        ->get();

    return view('collection', compact('products'));
})->name('collection.index');

Route::get('/categories/{slug}', function ($slug) {
    // Try to get category from database
    $category = Category::where('slug', $slug)
        ->where('is_active', true)
        ->with(['products' => function ($query) {
            $query->active()->ordered();
        }])
        ->first();

    // Fallback to hardcoded data if category not found
    if (!$category) {
        $fallbackCategories = [
            // Electromenager categories
            'gazinieres' => [
                'name' => 'Gazinières',
                'slug' => 'gazinieres',
                'description' => 'Cuisine au gaz',
                'image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=600&fit=crop',
                'color' => '#3b82f6',
            ],
            'frigo' => [
                'name' => 'Frigo',
                'slug' => 'frigo',
                'description' => 'Conservation optimale',
                'image' => 'https://images.unsplash.com/photo-1584568694244-14fbdf83bd30?w=800&h=600&fit=crop',
                'color' => '#8b5cf6',
            ],
            'climatiseurs' => [
                'name' => 'Climatiseurs',
                'slug' => 'climatiseurs',
                'description' => 'Fraîcheur garantie',
                'image' => 'https://images.unsplash.com/photo-1631679706909-1844bbd07221?w=800&h=600&fit=crop',
                'color' => '#ec4899',
            ],
            'mixeurs' => [
                'name' => 'Mixeurs',
                'slug' => 'mixeurs',
                'description' => 'Préparation facile',
                'image' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=800&h=600&fit=crop',
                'color' => '#f59e0b',
            ],
            // Matelas categories
            'medicosoins' => [
                'name' => 'MedicoSoins',
                'slug' => 'medicosoins',
                'description' => 'Soutien orthopédique',
                'image' => 'https://images.unsplash.com/photo-1632778149955-e80f8ceca2e8?w=800&h=600&fit=crop',
                'color' => '#3b82f6',
            ],
            'confort_soft' => [
                'name' => 'Confort Soft',
                'slug' => 'confort_soft',
                'description' => 'Douceur absolue',
                'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=800&h=600&fit=crop',
                'color' => '#8b5cf6',
            ],
            'addict' => [
                'name' => 'Addict',
                'slug' => 'addict',
                'description' => 'Le choix passionné',
                'image' => 'https://images.unsplash.com/photo-1505693314120-0d443867891c?w=800&h=600&fit=crop',
                'color' => '#ec4899',
            ],
            'luxury' => [
                'name' => 'Luxury',
                'slug' => 'luxury',
                'description' => 'Haut de gamme',
                'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=800&h=600&fit=crop',
                'color' => '#f59e0b',
            ],
            // Lit-canape categories
            'fauteuil' => [
                'name' => 'Fauteuil',
                'slug' => 'fauteuil',
                'description' => 'Confort et style',
                'image' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=800&h=600&fit=crop',
                'color' => '#3b82f6',
            ],
            'table_manger' => [
                'name' => 'Table à manger',
                'slug' => 'table_manger',
                'description' => 'Design fonctionnel',
                'image' => 'https://images.unsplash.com/photo-1617806118233-18e1de247200?w=800&h=600&fit=crop',
                'color' => '#8b5cf6',
            ],
            'bureaux' => [
                'name' => 'Bureaux',
                'slug' => 'bureaux',
                'description' => 'Espace travail',
                'image' => 'https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?w=800&h=600&fit=crop',
                'color' => '#ec4899',
            ],
            'canapes' => [
                'name' => 'Canapés',
                'slug' => 'canapes',
                'description' => 'Détente optimale',
                'image' => 'https://images.unsplash.com/photo-1550226891-ef816aed4a98?w=800&h=600&fit=crop',
                'color' => '#f59e0b',
            ],
        ];

        if (!isset($fallbackCategories[$slug])) {
            abort(404);
        }

        $categoryData = $fallbackCategories[$slug];
        $category = (object) array_merge($categoryData, [
            'products' => collect([]),
        ]);
    }

    return view('category', compact('category'));
})->name('category.show');

Route::get('/nouveautes', function () {
    $products = Product::query()
        ->active()
        ->orderByDesc('created_at')
        ->take(48)
        ->get();

    if ($products->isEmpty()) {
        $products = Product::query()
            ->orderByDesc('created_at')
            ->take(48)
            ->get();
    }

    $pageTitle = 'Nouveautés';
    $pageMetaDescription = 'Découvrez les derniers produits ajoutés à notre catalogue.';
    $pageBadge = '✨ Nouveautés';
    $pageHeading = 'Nouveautés';
    $pageSubtitle = 'Découvrez les dernières nouveautés ajoutées à notre catalogue.';

    return view('collection', compact('products', 'pageTitle', 'pageMetaDescription', 'pageBadge', 'pageHeading', 'pageSubtitle'));
})->name('nouveautes.index');

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
});

Route::prefix('ma/admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/home/monthly-stats', [DashboardController::class, 'monthlyStats'])->name('admin.dashboard.monthly-stats');

    Route::get('/settings/facebook-pixel', [FacebookPixelController::class, 'edit'])->name('admin.settings.facebook-pixel.edit');
    Route::post('/settings/facebook-pixel', [FacebookPixelController::class, 'update'])->name('admin.settings.facebook-pixel.update');

    Route::get('/settings/new-products-button', [NewProductsButtonController::class, 'edit'])->name('admin.settings.new-products-button.edit');
    Route::post('/settings/new-products-button', [NewProductsButtonController::class, 'update'])->name('admin.settings.new-products-button.update');

    Route::post('/notifications/{notification}/read', [AdminNotificationController::class, 'markAsRead'])->name('admin.notifications.read');
    Route::post('/notifications/read-all', [AdminNotificationController::class, 'markAllAsRead'])->name('admin.notifications.read-all');
    Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications.index');
    Route::post('/notifications/{notification}/handled', [AdminNotificationController::class, 'markAsHandled'])->name('admin.notifications.handled');
    Route::post('/notifications/{notification}/unhandled', [AdminNotificationController::class, 'markAsUnhandled'])->name('admin.notifications.unhandled');

    Route::get('/stats', [StatsController::class, 'index'])->middleware('permission:stats.view')->name('admin.stats.index');

    Route::get('/newsletter', [NewsletterSubscriptionController::class, 'index'])->middleware('permission:newsletter.view')->name('admin.newsletter.index');

    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('admin.profile');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    Route::get('/editor', fn () => redirect()->route('admin.dashboard'))->name('admin.editor');
    Route::get('/writer', fn () => redirect()->route('admin.dashboard'))->name('admin.writer');

    Route::get('/articles', [ArticleController::class, 'index'])->middleware('permission:articles.manage')->name('admin.articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->middleware('permission:articles.manage')->name('admin.articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->middleware('permission:articles.manage')->name('admin.articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->middleware('permission:articles.manage')->name('admin.articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->middleware('permission:articles.manage')->name('admin.articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->middleware('permission:articles.manage')->name('admin.articles.destroy');
    Route::post('/articles/upload-image', [ArticleController::class, 'uploadImage'])->middleware('permission:articles.manage')->name('admin.articles.upload-image');

    Route::get('/person-week', fn () => redirect()->route('admin.dashboard'))->name('admin.person-week.index');
    Route::get('/person-week/create', fn () => redirect()->route('admin.dashboard'))->name('admin.person-week.create');

    Route::get('/jobs', fn () => redirect()->route('admin.dashboard'))->name('admin.jobs.index');
    Route::get('/jobs/create', fn () => redirect()->route('admin.dashboard'))->name('admin.jobs.create');

    Route::get('/flash-news', fn () => redirect()->route('admin.dashboard'))->name('admin.flash-news.index');
    Route::get('/flash-news/create', fn () => redirect()->route('admin.dashboard'))->name('admin.flash-news.create');

    Route::resource('menus', MenuController::class)->middleware('permission:menus.manage')->names('admin.menus');

    Route::resource('users', AdminUserController::class)->middleware('permission:users.manage')->names('admin.users');
    Route::get('/users/stats', [AdminUserController::class, 'stats'])->middleware('permission:users.manage')->name('admin.users.stats');
    Route::post('/users/{user}/role', [AdminUserController::class, 'changeRole'])->middleware('permission:users.manage')->name('admin.users.role');
    Route::post('/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->middleware('permission:users.manage')->name('admin.users.toggle-status');

    Route::post('/roles/{role}/toggle', [RoleController::class, 'toggle'])->middleware('permission:roles.manage')->name('admin.roles.toggle');
    Route::resource('roles', RoleController::class)->middleware('permission:roles.manage')->names('admin.roles');

    Route::get('/slider', [SliderController::class, 'index'])->name('admin.slider.index');
    Route::get('/slider/create', [SliderController::class, 'create'])->name('admin.slider.create');
    Route::post('/slider', [SliderController::class, 'store'])->name('admin.slider.store');
    Route::get('/slider/{slider}/edit', [SliderController::class, 'edit'])->name('admin.slider.edit');
    Route::put('/slider/{slider}', [SliderController::class, 'update'])->name('admin.slider.update');
    Route::delete('/slider/{slider}', [SliderController::class, 'destroy'])->name('admin.slider.destroy');

    Route::resource('b2b', B2BCategoryController::class)->names('admin.b2b');
    Route::resource('featured-categories', FeaturedCategoryController::class)->names('admin.featured_categories');

    Route::get('/save-the-date', [SaveTheDateController::class, 'index'])->middleware('permission:articles.manage')->name('admin.save-the-date.index');
    Route::get('/save-the-date/create', [SaveTheDateController::class, 'create'])->middleware('permission:articles.manage')->name('admin.save-the-date.create');
    Route::post('/save-the-date', [SaveTheDateController::class, 'store'])->middleware('permission:articles.manage')->name('admin.save-the-date.store');
    Route::delete('/save-the-date/{saveTheDate}', [SaveTheDateController::class, 'destroy'])->middleware('permission:articles.manage')->name('admin.save-the-date.destroy');

    Route::post('/products/{product}/toggle-active', [AdminProductController::class, 'toggleActive'])->middleware('permission:products.manage')->name('admin.products.toggle-active');
    Route::delete('/products/{product}/image', [AdminProductController::class, 'destroyImage'])->middleware('permission:products.manage')->name('admin.products.image.destroy');
    Route::delete('/products/{product}/gallery/{index}', [AdminProductController::class, 'destroyGalleryImage'])->middleware('permission:products.manage')->name('admin.products.gallery.destroy');
    Route::resource('products', AdminProductController::class)->middleware('permission:products.manage')->names('admin.products');
    Route::resource('categories', CategoryController::class)->middleware('permission:categories.manage')->names('admin.categories');
    Route::get('/orders', [OrderController::class, 'index'])->middleware('permission:orders.view')->name('admin.orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->middleware('permission:orders.view')->name('admin.orders.show');
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->middleware('permission:orders.update_status')->name('admin.orders.status');

    Route::get('/invoices', [InvoiceController::class, 'index'])->middleware('permission:orders.view')->name('admin.invoices.index');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->middleware('permission:orders.view')->name('admin.invoices.show');
    Route::get('/invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])->middleware('permission:orders.view')->name('admin.invoices.pdf');
    Route::post('/orders/{order}/invoices', [InvoiceController::class, 'storeFromOrder'])->middleware('permission:orders.update_status')->name('admin.orders.invoices.store');
    Route::post('/invoices/{invoice}/status', [InvoiceController::class, 'updateStatus'])->middleware('permission:orders.update_status')->name('admin.invoices.status');

    Route::get('/home-sections', [HomeSectionController::class, 'index'])->name('admin.home_sections.index');
    Route::get('/home-sections/create', [HomeSectionController::class, 'create'])->name('admin.home_sections.create');
    Route::post('/home-sections', [HomeSectionController::class, 'store'])->name('admin.home_sections.store');
    Route::get('/home-sections/{home_section}/edit', [HomeSectionController::class, 'edit'])->name('admin.home_sections.edit');
    Route::put('/home-sections/{home_section}', [HomeSectionController::class, 'update'])->name('admin.home_sections.update');

    Route::get('/space-sections', [SpaceSectionController::class, 'index'])->name('admin.space_sections.index');
    Route::get('/space-sections/{space_section}/edit', [SpaceSectionController::class, 'edit'])->name('admin.space_sections.edit');
    Route::put('/space-sections/{space_section}', [SpaceSectionController::class, 'update'])->name('admin.space_sections.update');

    Route::post('/space-sections/{space_section}/cards', [SpaceCardController::class, 'store'])->name('admin.space_sections.cards.store');
    Route::put('/space-sections/{space_section}/cards/{space_card}', [SpaceCardController::class, 'update'])->name('admin.space_sections.cards.update');
    Route::delete('/space-sections/{space_section}/cards/{space_card}', [SpaceCardController::class, 'destroy'])->name('admin.space_sections.cards.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// B2B Routes
Route::prefix('b2b')->name('b2b.')->group(function () {
    Route::get('/', [B2BController::class, 'index'])->name('index');
    Route::get('/{key}', [B2BController::class, 'category'])->name('category');
    Route::post('/{key}/order', [B2BController::class, 'submitOrder'])->name('submit');
});

require __DIR__ . '/auth.php';
