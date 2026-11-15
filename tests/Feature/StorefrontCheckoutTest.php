<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class StorefrontCheckoutTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->assertSame('sqlite', config('database.default'));
        $this->assertSame(':memory:', config('database.connections.sqlite.database'));
        config(['app.url' => 'http://localhost']);
        app('url')->forceRootUrl('http://localhost');
        Notification::fake();
        view()->share('errors', new \Illuminate\Support\ViewErrorBag());

        foreach ([
            '0001_01_01_000000_create_users_table.php',
            '2026_01_22_120000_add_is_admin_to_users_table.php',
            '2026_01_30_190000_add_admin_fields_to_users_table.php',
            '2026_01_21_234714_create_menus_table.php',
            '2026_02_09_000001_create_site_settings_table.php',
            '2026_01_21_235838_create_categories_table.php',
            '2026_01_22_001058_create_products_table.php',
            '2026_01_22_071858_add_extra_fields_to_products_table.php',
            '2026_01_28_000002_add_shipping_price_to_products_table.php',
            '2026_02_05_140000_create_product_variants_table.php',
            '2026_01_26_150000_create_orders_table.php',
            '2026_01_26_150001_create_order_items_table.php',
            '2026_02_05_140001_add_variant_id_to_order_items_table.php',
            '2026_02_15_170001_add_selected_color_to_order_items_table.php',
        ] as $migration) {
            (require database_path('migrations/' . $migration))->up();
        }
        Schema::table('product_variants', fn (Blueprint $table) => $table->string('variant_type')->nullable());
    }

    private function product(): Product
    {
        return Product::create([
            'name' => 'Matelas de test', 'slug' => 'matelas-test',
            'image' => 'assets/maquette/img/product-placeholder.svg',
            'price' => 70000, 'shipping_price' => 2000, 'stock' => 5, 'is_active' => true,
        ]);
    }

    public function test_inactive_admin_cannot_log_in(): void
    {
        \App\Models\User::create([
            'name' => 'Admin test', 'email' => 'inactive@example.test', 'password' => 'test-password',
            'is_admin' => true, 'is_active' => false, 'role' => 'admin',
        ]);
        $this->post(route('login.submit'), ['email' => 'inactive@example.test', 'password' => 'test-password'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_inactive_admin_session_and_permissions_are_blocked(): void
    {
        \Illuminate\Support\Facades\Route::middleware(['web', 'auth', 'admin'])->get('/_test/admin-only', fn () => 'ok');
        $user = \App\Models\User::create([
            'name' => 'Admin test', 'email' => 'inactive@example.test', 'password' => 'test-password',
            'is_admin' => true, 'is_active' => false, 'role' => 'admin',
        ]);
        $this->actingAs($user)->get('/_test/admin-only')->assertForbidden();
        $this->assertFalse($user->hasPermission('products.view'));
    }

    public function test_active_admin_can_log_in_and_access_admin_routes(): void
    {
        \Illuminate\Support\Facades\Route::middleware(['web', 'auth', 'admin'])->get('/_test/admin-only', fn () => 'ok');
        $user = \App\Models\User::create([
            'name' => 'Admin test', 'email' => 'active@example.test', 'password' => 'test-password',
            'is_admin' => true, 'is_active' => true, 'role' => 'admin',
        ]);
        $this->post(route('login.submit'), ['email' => 'active@example.test', 'password' => 'test-password'])
            ->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
        $this->get('/_test/admin-only')->assertOk();
        $this->assertTrue($user->hasPermission('products.view'));
    }

    public function test_home_selection_displays_twelve_active_priced_products(): void
    {
        $products = collect(range(1, 13))->map(fn ($i) => Product::create([
            'name' => 'Matelas sélection ' . $i, 'slug' => 'matelas-selection-' . $i,
            'image' => 'assets/logo/favicon.png', 'price' => 70000, 'stock' => 5, 'is_active' => true,
        ]));
        $products->prepend(Product::create(['name' => 'Matelas inactif', 'slug' => 'matelas-inactif', 'image' => 'assets/logo/favicon.png', 'price' => 70000, 'is_active' => false]));
        $products->prepend(Product::create(['name' => 'Matelas sans prix', 'slug' => 'matelas-sans-prix', 'image' => 'assets/logo/favicon.png', 'price' => 0, 'is_active' => true]));
        $html = view('maquette.home-2027', [
            'matelasProducts' => $products, 'blogFeaturedPost' => null, 'blogPosts' => collect(),
            'catalogueCards' => [], 'heroSlides' => collect(),
        ])->render();
        $this->assertSame(12, substr_count($html, '<article class="p">'));
        $this->assertStringContainsString('Matelas sélection 12</a>', $html);
        $this->assertStringNotContainsString('Matelas sélection 13</a>', $html);
        $this->assertStringNotContainsString('Matelas inactif', $html);
        $this->assertStringNotContainsString('Matelas sans prix', $html);
    }

    public function test_home_slider_renders_every_slide_and_accessible_controls(): void
    {
        $html = view('maquette.home-2027', [
            'matelasProducts' => collect(), 'blogFeaturedPost' => null, 'blogPosts' => collect(),
            'catalogueCards' => [],
            'heroSlides' => collect(range(1, 4))->map(fn ($i) => new \App\Models\Slide([
                'title' => 'Visuel ' . $i, 'image' => 'assets/logo/favicon.png',
            ])),
        ])->render();
        $this->assertSame(4, substr_count($html, 'data-hero-slide '));
        $this->assertStringContainsString('aria-label="Visuel suivant"', $html);
        $this->assertStringContainsString('aria-label="Mettre le diaporama en pause"', $html);
    }

    public function test_product_page_displays_the_price_of_the_selected_variant(): void
    {
        $product = $this->product();
        $variant = ProductVariant::create([
            'product_id' => $product->id, 'thickness_cm' => 20, 'places' => 2,
            'price' => 85000, 'stock' => 5, 'is_active' => true,
        ]);
        $product->setRelation('variants', collect([$variant]));
        $product->setRelation('category', null);
        $product->setRelation('categories', collect());
        $html = view('products.show', ['product' => $product, 'relatedProducts' => collect()])->render();
        $this->assertMatchesRegularExpression('/id="pdpPrice">85 000 FCFA/', $html);
        $this->assertStringContainsString('id="product-options"', $html);
        $this->assertStringContainsString('class="pdp-buy" name="redirect_to" value="shipping"', $html);
    }

    public function test_stocked_variant_unlocks_the_product_page_and_direct_purchase(): void
    {
        $product = $this->product();
        $product->update(['stock' => 0]);
        $empty = ProductVariant::create([
            'product_id' => $product->id, 'thickness_cm' => 15, 'places' => 2,
            'price' => 70000, 'stock' => 0, 'is_active' => true,
        ]);
        $available = ProductVariant::create([
            'product_id' => $product->id, 'thickness_cm' => 20, 'places' => 2,
            'price' => 85000, 'stock' => 3, 'is_active' => true,
        ]);
        $product->setRelation('variants', collect([$empty, $available]));
        $product->setRelation('category', null);
        $product->setRelation('categories', collect());
        $html = view('products.show', ['product' => $product, 'relatedProducts' => collect()])->render();
        $this->assertMatchesRegularExpression('/id="pdpPrice">85 000 FCFA/', $html);
        $this->assertMatchesRegularExpression('/value="' . $available->id . '"[^>]* checked/', $html);
        $this->assertDoesNotMatchRegularExpression('/class="pdp-(?:atc|buy)"[^>]*disabled/', $html);
        $this->post(route('cart.add'), [
            'product_id' => $product->id, 'product_variant_id' => $available->id,
            'quantity' => 1, 'redirect_to' => 'shipping',
        ])->assertRedirect(route('cart.shipping'));
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_availability_filters_include_stocked_active_variants(): void
    {
        $product = $this->product();
        $product->update(['stock' => 0]);
        ProductVariant::create([
            'product_id' => $product->id, 'thickness_cm' => 20, 'places' => 2,
            'price' => 85000, 'stock' => 3, 'is_active' => true,
        ]);
        $this->get('/collection?availability=in')->assertOk()->assertViewHas('products', fn ($rows) => $rows->contains('id', $product->id));
        $this->get('/collection?availability=out')->assertOk()->assertViewHas('products', fn ($rows) => !$rows->contains('id', $product->id));
    }

    public function test_catalogue_tabs_keep_active_menus_without_products(): void
    {
        $menu = \App\Models\Menu::create(['name' => 'Matelas', 'slug' => 'matelas', 'position' => 'header', 'is_active' => true]);
        \App\Models\Menu::create(['name' => 'Oreillers', 'slug' => 'oreillers', 'position' => 'header', 'is_active' => true]);
        $html = view('menus.show-2027', [
            'menu' => $menu, 'pageTitle' => 'Matelas', 'menuCategories' => collect(),
            'products' => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12),
        ])->render();
        preg_match('/<nav class="tabs".*?<\/nav>/s', $html, $tabs);
        $this->assertStringContainsString('Oreillers', $tabs[0]);
    }

    public function test_collection_search_and_sort_only_include_active_products(): void
    {
        $this->product()->update(['name' => 'Canapé Alpha']);
        Product::create(['name' => 'Canapé Beta', 'slug' => 'canape-beta', 'image' => 'assets/logo/favicon.png', 'price' => 40000, 'is_active' => true]);
        Product::create(['name' => 'Canapé Caché', 'slug' => 'canape-cache', 'image' => 'assets/logo/favicon.png', 'price' => 100, 'is_active' => false]);
        $this->get('/collection?' . http_build_query(['q' => 'Canapé', 'sort' => 'price-asc']))
            ->assertOk()
            ->assertViewHas('products', fn ($products) => $products->pluck('name')->all() === ['Canapé Beta', 'Canapé Alpha']);
        $this->get('/nouveautes')->assertOk()->assertDontSee('Canapé Caché');
    }

    public function test_direct_purchase_adds_the_chosen_variant_and_opens_delivery_without_ordering(): void
    {
        $product = $this->product();
        $variant = ProductVariant::create([
            'product_id' => $product->id, 'thickness_cm' => 20, 'places' => 2,
            'price' => 85000, 'stock' => 5, 'is_active' => true,
        ]);
        $key = $product->id . ':' . $variant->id . ':';
        $this->post(route('cart.add'), [
            'product_id' => $product->id, 'product_variant_id' => $variant->id,
            'quantity' => 2, 'redirect_to' => 'shipping', 'price' => 1,
        ])->assertRedirect(route('cart.shipping'))
            ->assertSessionHas('cart.' . $key, fn ($row) => $row['quantity'] === 2 && $row['product_variant_id'] === $variant->id);
        $this->get(route('cart.shipping'))->assertOk()->assertSee('170 000');
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_ajax_add_to_cart_returns_server_totals_without_ordering(): void
    {
        $product = $this->product();
        $this->postJson(route('cart.add'), ['product_id' => $product->id, 'quantity' => 1, 'price' => 1])
            ->assertOk()->assertJsonPath('ok', true)->assertJsonPath('cart_count', 1)
            ->assertJsonPath('cart_subtotal', 70000)->assertJsonPath('checkout_url', route('cart.shipping'))
            ->assertJsonPath('cart_items.0.name', $product->name)
            ->assertJsonPath('cart_items.0.cart_key', $product->id . ':0:')
            ->assertJsonPath('cart_items.0.quantity', 1)
            ->assertJsonPath('cart_items.0.line_total', 70000)
            ->assertJsonPath('cart_remove_url', route('cart.remove'));
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_pagination_canonical_and_newsletter_label(): void
    {
        $this->get('/collection?page=2')->assertOk()
            ->assertSee('rel="canonical" href="http://localhost/collection?page=2"', false)
            ->assertSee('for="footer-newsletter-email"', false)
            ->assertSee('id="footer-newsletter-email"', false);
        $this->get('/collection')->assertOk()
            ->assertSee('rel="canonical" href="http://localhost/collection"', false);
    }

    public function test_empty_cart_cannot_enter_checkout(): void
    {
        $this->get('/panier/livraison')->assertRedirect(route('cart.index'));
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_cart_updates_quantity_and_removes_the_correct_variant(): void
    {
        $product = $this->product();
        $variant = ProductVariant::create([
            'product_id' => $product->id, 'thickness_cm' => 20, 'places' => 2,
            'price' => 85000, 'stock' => 5, 'is_active' => true,
        ]);
        $this->post('/panier/ajouter', [
            'product_id' => $product->id, 'product_variant_id' => $variant->id, 'quantity' => 1,
        ])->assertRedirect();
        $key = $product->id . ':' . $variant->id . ':';
        $this->post('/panier/modifier', ['cart_key' => $key, 'quantity' => 3])->assertRedirect();
        $this->get('/panier')->assertOk()->assertSee('255 000')->assertSee('Matelas de test');
        $this->post('/panier/supprimer', ['cart_key' => $key])->assertRedirect();
        $this->get('/panier')->assertOk()->assertSee('Votre panier est vide');
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_checkout_validates_then_saves_server_prices_and_payment_at_delivery(): void
    {
        $product = $this->product();
        $this->post('/panier/ajouter', ['product_id' => $product->id, 'quantity' => 2])->assertRedirect();
        $this->get('/panier/livraison')->assertOk()->assertSee('Finaliser');
        $this->post('/panier/livraison', [])->assertSessionHasErrors(['lastname', 'firstnames', 'whatsapp', 'delivery_place']);
        $this->assertDatabaseCount('orders', 0);

        $response = $this->post('/panier/livraison', [
            'lastname' => 'Test', 'firstnames' => 'Client', 'whatsapp' => '+2250000000000',
            'delivery_place' => 'Cocody, adresse de test', 'shipping_method' => 'standard',
            'total' => 1, 'payment_method' => 'Carte bancaire',
        ]);
        $response->assertRedirect();
        $order = Order::sole();
        $this->assertSame('Paiement à la livraison', $order->payment_method);
        $this->assertSame(142000.0, (float) $order->total);
        $this->assertSame(2, $order->items->sole()->quantity);
        $this->assertSame(70000.0, (float) $order->items->sole()->unit_price);
        $response->assertSessionMissing('cart');
        $this->get($response->headers->get('Location'))->assertOk()->assertSee('Votre commande est bien enregistrée');
    }
}
