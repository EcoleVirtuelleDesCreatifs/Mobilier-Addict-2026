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
use App\Http\Controllers\B2BController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\NewsletterSubscriptionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\FacebookPixelController;
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
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::group([], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/jeu', [\App\Http\Controllers\GameController::class, 'index'])->name('game.index');
    Route::post('/jeu', [\App\Http\Controllers\GameController::class, 'store'])->name('game.store');
    Route::get('/jeu/{participant}', [\App\Http\Controllers\GameController::class, 'show'])->name('game.show');
    Route::post('/jeu/{participant}/soutien', [\App\Http\Controllers\GameController::class, 'support'])->name('game.support');
    Route::get('/jeu/{participant}/badge', [\App\Http\Controllers\GameController::class, 'badge'])->name('game.badge');
    Route::get('/media/{path}', [\App\Http\Controllers\PublicMediaController::class, 'show'])->where('path', '.*')->name('media.show');

Route::get('/sitemap.xml', function () {
    $urls = [];

    $add = function (string $loc, ?string $lastmod = null, ?string $image = null) use (&$urls) {
        $urls[] = [
            'loc' => $loc,
            'lastmod' => $lastmod,
            'image' => $image,
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
    $add(route('pages.hotellerie'));
    $add(route('pages.appartement-meuble'));
    $add(route('pages.studio'));
    $add(route('pages.famille'));
    $add(route('devis.create'));

    if (Schema::hasTable('categories')) {
        // Audit : ne référencer que les catégories contenant des produits actifs.
        Category::query()->select(['slug', 'updated_at'])->whereNotNull('slug')
            ->whereHas('productsMany', fn ($q) => $q->where('products.is_active', true))
            ->get()->each(function ($category) use ($add) {
            $add(route('univers.show', $category->slug), optional($category->updated_at)->toDateString());
        });
    }

    if (Schema::hasTable('menus') && Schema::hasTable('menu_product')) {
        Menu::query()
            ->select(['slug', 'updated_at', 'is_active'])
            ->where('is_active', true)
            ->whereNotNull('slug')
            ->whereHas('products', fn ($q) => $q->where('products.is_active', true))
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
        $allProducts = Product::query()->select(['id', 'name', 'slug', 'updated_at', 'is_active', 'image'])->where('is_active', true)->whereNotNull('slug')->get();
        $allProducts->each(function ($product) use ($add, $allProducts) {
            // Exclure du sitemap les fiches déclinées par taille : leur canonical pointe vers la fiche mère.
            $base = preg_replace('/\s*[-–—]\s*\d+\s*(cm)?\s*x\s*\d+\s*(cm)?\s*$/iu', '', (string) $product->name);
            if ($base !== '' && $base !== $product->name) {
                $canonical = $allProducts->filter(fn ($p) => str_starts_with((string) $p->name, $base))->sortBy('id')->first();
                if ($canonical && $canonical->id !== $product->id) {
                    return;
                }
            }
            $add(route('product.show', $product->slug), optional($product->updated_at)->toDateString(), $product->image ? image_url($product->image) : null);
        });
    }

    if (Schema::hasTable('blog_posts')) {
        BlogPost::query()->select(['slug', 'updated_at', 'image'])->whereNotNull('slug')->get()->each(function ($post) use ($add) {
            $add(route('blog.show', $post->slug), optional($post->updated_at)->toDateString(), $post->image ? image_url($post->image) : null);
        });
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

    foreach ($urls as $row) {
        $xml .= "  <url>\n";
        $xml .= '    <loc>' . htmlspecialchars($row['loc'], ENT_XML1) . "</loc>\n";
        if (!empty($row['lastmod'])) {
            $xml .= '    <lastmod>' . htmlspecialchars($row['lastmod'], ENT_XML1) . "</lastmod>\n";
        }
        if (!empty($row['image'])) {
            $xml .= '    <image:image><image:loc>' . htmlspecialchars($row['image'], ENT_XML1) . "</image:loc></image:image>\n";
        }
        $xml .= "  </url>\n";
    }

    $xml .= "</urlset>\n";

    return response($xml, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/prix', function () {
    return view('pricing');
})->name('pricing');

Route::get('/devis-sur-mesure', [\App\Http\Controllers\DevisController::class, 'create'])->name('devis.create');
Route::post('/devis-sur-mesure', [\App\Http\Controllers\DevisController::class, 'store'])->name('devis.store');
Route::view('/conseils', 'maquette.pages.conseils')->name('pages.conseils');
Route::view('/a-propos', 'maquette.pages.about')->name('pages.about');
Route::view('/contact', 'maquette.pages.contact')->name('pages.contact');
Route::view('/service-client', 'maquette.pages.customer-service')->name('pages.customer-service');
Route::view('/livraison-retours', 'pages.shipping-returns')->name('pages.shipping-returns');
Route::view('/faq', 'maquette.pages.faq')->name('pages.faq');
Route::view('/hotellerie', 'maquette.pages.hotellerie')->name('pages.hotellerie');
Route::view('/appartement-meuble', 'maquette.pages.appartement-meuble')->name('pages.appartement-meuble');
Route::view('/studio', 'maquette.pages.studio')->name('pages.studio');
Route::view('/famille', 'maquette.pages.famille')->name('pages.famille');

Route::view('/mentions-legales', 'pages.legal')->name('pages.legal');
Route::view('/politique-de-confidentialite', 'maquette.pages.privacy')->name('pages.privacy');
Route::view('/cgv', 'maquette.pages.cgv')->name('pages.cgv');

Route::view('/guides/achat-matelas', 'pages.guides.mattress')->name('pages.guides.mattress');
Route::view('/guides/choisir-oreiller', 'pages.guides.pillow')->name('pages.guides.pillow');
Route::view('/guides/entretien-literie', 'pages.guides.care')->name('pages.guides.care');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/search/suggest', [SearchController::class, 'suggest'])->name('search.suggest');

Route::get('/collection', [\App\Http\Controllers\CatalogueController::class, 'index'])->name('collection.index');

Route::get('/categories/{slug}', function ($slug) {
    // If the slug matches an active menu, redirect to the menu page
    if ($menu = Menu::where('slug', $slug)->where('is_active', true)->first()) {
        return redirect()->route('menu.show', $slug, 301);
    }

    // Try to get category from database
    $category = Category::where('slug', $slug)
        ->where('is_active', true)
        ->with(['productsMany' => function ($query) {
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
            // Mobilier Accessoire categories
            'tables' => [
                'name' => 'Tables',
                'slug' => 'tables',
                'description' => 'Design fonctionnel',
                'image' => 'https://images.unsplash.com/photo-1617806118233-18e1de247200?w=800&h=600&fit=crop',
                'color' => '#3b82f6',
            ],
            'chaises' => [
                'name' => 'Chaises',
                'slug' => 'chaises',
                'description' => 'Confort optimal',
                'image' => 'https://images.unsplash.com/photo-1505693314120-0d443867891c?w=800&h=600&fit=crop',
                'color' => '#8b5cf6',
            ],
            'rangement' => [
                'name' => 'Rangement',
                'slug' => 'rangement',
                'description' => 'Organisation pratique',
                'image' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?w=800&h=600&fit=crop',
                'color' => '#ec4899',
            ],
            'accessoires' => [
                'name' => 'Accessoires',
                'slug' => 'accessoires',
                'description' => 'Finitions parfaites',
                'image' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&h=600&fit=crop',
                'color' => '#f59e0b',
            ],
        ];

        if (!isset($fallbackCategories[$slug])) {
            abort(404);
        }

        $categoryData = $fallbackCategories[$slug];
        $category = (object) array_merge($categoryData, [
            'products' => collect([]),
            'productsMany' => collect([]),
        ]);
    }

    return view('category', compact('category'));
})->name('category.show');

Route::get('/nouveautes', [\App\Http\Controllers\CatalogueController::class, 'index'])->name('nouveautes.index');

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
Route::get('/favoris', function () {
    $products = Product::query()->active()->with(['variants', 'category'])
        ->whereIn('id', session('favorites', []))->get();
    return view('products.favorites', compact('products'));
})->name('favorites.index');
Route::post('/favoris/{product}', function (\App\Models\Product $product) {
    abort_unless($product->is_active, 404);
    $favorites = collect(session('favorites', []))->map(fn ($id) => (int) $id);
    $exists = $favorites->contains($product->id);
    $favorites = $exists ? $favorites->reject(fn ($id) => $id === $product->id) : $favorites->push($product->id);
    session(['favorites' => $favorites->unique()->take(100)->values()->all()]);
    return back()->with('success', $exists ? 'Produit retiré des favoris.' : 'Produit ajouté aux favoris.');
})->name('favorites.toggle');

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
    Route::get('/diag', function () {
        $views = glob(storage_path('framework/views/*.php')) ?: [];

        return response()->json([
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'environment' => app()->environment(),
            'compiled_views_count' => count($views),
            'oldest_compiled_view' => $views ? date('Y-m-d H:i:s', min(array_map('filemtime', $views))) : null,
            'newest_compiled_view' => $views ? date('Y-m-d H:i:s', max(array_map('filemtime', $views))) : null,
            'views_writable' => is_writable(storage_path('framework/views')),
            'dashboard_md5' => md5_file(resource_path('views/admin/dashboard.blade.php')),
        ]);
    })->middleware('permission:admin.diag')->name('admin.diag');

    Route::get('/home', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/home/realtime-stats', [DashboardController::class, 'realtimeStats'])->name('admin.dashboard.realtime');

    Route::get('/settings/facebook-pixel', [FacebookPixelController::class, 'edit'])->middleware('permission:settings.manage')->name('admin.settings.facebook-pixel.edit');
    Route::post('/settings/facebook-pixel', [FacebookPixelController::class, 'update'])->middleware('permission:settings.manage')->name('admin.settings.facebook-pixel.update');

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

    Route::resource('menus', MenuController::class)->middleware('permission:menus.manage')->names('admin.menus');

    Route::get('/users/stats', [AdminUserController::class, 'stats'])->middleware('permission:users.manage')->name('admin.users.stats');
    Route::resource('users', AdminUserController::class)->middleware('permission:users.manage')->names('admin.users');
    Route::post('/users/{user}/role', [AdminUserController::class, 'changeRole'])->middleware('permission:users.manage')->name('admin.users.role');
    Route::post('/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->middleware('permission:users.manage')->name('admin.users.toggle-status');

    Route::post('/roles/{role}/toggle', [RoleController::class, 'toggle'])->middleware('permission:roles.manage')->name('admin.roles.toggle');
    Route::resource('roles', RoleController::class)->middleware('permission:roles.manage')->names('admin.roles');

    Route::get('/slider', [SliderController::class, 'index'])->middleware('permission:homepage.manage')->name('admin.slider.index');
    Route::get('/slider/create', [SliderController::class, 'create'])->middleware('permission:homepage.manage')->name('admin.slider.create');
    Route::post('/slider', [SliderController::class, 'store'])->middleware('permission:homepage.manage')->name('admin.slider.store');
    Route::get('/slider/{slider}/edit', [SliderController::class, 'edit'])->middleware('permission:homepage.manage')->name('admin.slider.edit');
    Route::put('/slider/{slider}', [SliderController::class, 'update'])->middleware('permission:homepage.manage')->name('admin.slider.update');
    Route::delete('/slider/{slider}', [SliderController::class, 'destroy'])->middleware('permission:homepage.manage')->name('admin.slider.destroy');

    Route::resource('b2b', B2BCategoryController::class)->middleware('permission:homepage.manage')->names('admin.b2b');

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
    Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])->middleware('permission:orders.update_status')->name('admin.invoices.destroy');

    Route::get('/quotes', [\App\Http\Controllers\Admin\QuoteController::class, 'index'])->middleware('permission:orders.view')->name('admin.quotes.index');
    Route::get('/quotes/{quote}', [\App\Http\Controllers\Admin\QuoteController::class, 'show'])->middleware('permission:orders.view')->name('admin.quotes.show');
    Route::post('/quotes/{quote}/status', [\App\Http\Controllers\Admin\QuoteController::class, 'updateStatus'])->middleware('permission:orders.update_status')->name('admin.quotes.status');
    Route::post('/quotes/{quote}/update', [\App\Http\Controllers\Admin\QuoteController::class, 'update'])->middleware('permission:orders.update_status')->name('admin.quotes.update');
    Route::post('/quotes/{quote}/items', [\App\Http\Controllers\Admin\QuoteController::class, 'addItem'])->middleware('permission:orders.update_status')->name('admin.quotes.items.store');
    Route::delete('/quotes/{quote}/items/{item}', [\App\Http\Controllers\Admin\QuoteController::class, 'removeItem'])->middleware('permission:orders.update_status')->name('admin.quotes.items.destroy');
    Route::delete('/quotes/{quote}', [\App\Http\Controllers\Admin\QuoteController::class, 'destroy'])->middleware('permission:orders.update_status')->name('admin.quotes.destroy');
    Route::post('/orders/{order}/quotes', [\App\Http\Controllers\Admin\QuoteController::class, 'storeFromOrder'])->middleware('permission:orders.update_status')->name('admin.orders.quotes.store');

    Route::get('/jeu', [\App\Http\Controllers\Admin\GameParticipantController::class, 'index'])->middleware('permission:game.manage')->name('admin.game.index');
    Route::post('/jeu/reglages', [\App\Http\Controllers\Admin\GameParticipantController::class, 'updateSettings'])->middleware('permission:game.manage')->name('admin.game.settings');
    Route::get('/jeu/{participant}/modifier', [\App\Http\Controllers\Admin\GameParticipantController::class, 'edit'])->middleware('permission:game.manage')->name('admin.game.edit');
    Route::put('/jeu/{participant}', [\App\Http\Controllers\Admin\GameParticipantController::class, 'update'])->middleware('permission:game.manage')->name('admin.game.update');
    Route::delete('/jeu/{participant}', [\App\Http\Controllers\Admin\GameParticipantController::class, 'destroy'])->middleware('permission:game.manage')->name('admin.game.destroy');

    Route::get('/space-sections', [SpaceSectionController::class, 'index'])->middleware('permission:homepage.manage')->name('admin.space_sections.index');
    Route::get('/space-sections/{space_section}/edit', [SpaceSectionController::class, 'edit'])->middleware('permission:homepage.manage')->name('admin.space_sections.edit');
    Route::put('/space-sections/{space_section}', [SpaceSectionController::class, 'update'])->middleware('permission:homepage.manage')->name('admin.space_sections.update');

    Route::post('/space-sections/{space_section}/cards', [SpaceCardController::class, 'store'])->middleware('permission:homepage.manage')->name('admin.space_sections.cards.store');
    Route::put('/space-sections/{space_section}/cards/{space_card}', [SpaceCardController::class, 'update'])->middleware('permission:homepage.manage')->name('admin.space_sections.cards.update');
    Route::delete('/space-sections/{space_section}/cards/{space_card}', [SpaceCardController::class, 'destroy'])->middleware('permission:homepage.manage')->name('admin.space_sections.cards.destroy');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user && in_array($user->role, ['admin', 'super_admin', 'editor', 'writer'], true)) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('home');
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
