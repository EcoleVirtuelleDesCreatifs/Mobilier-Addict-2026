<?php

namespace Tests\Feature;

use App\Models\B2BCategory;
use App\Models\Menu;
use App\Models\PageView;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminSmokeTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $user = User::factory()->create();
        $user->forceFill(['is_admin' => true, 'is_active' => true, 'role' => 'super_admin'])->save();

        return $user;
    }

    public function test_admin_can_create_category_menu_and_product(): void
    {
        Storage::fake('public');
        $admin = $this->admin();
        $menu = Menu::create(['name' => 'Matelas', 'slug' => 'matelas', 'is_active' => true, 'order' => 1]);

        $this->actingAs($admin)->post(route('admin.categories.store'), [
            'name' => 'Matelas mousse', 'image' => UploadedFile::fake()->image('c.jpg'), 'color' => '#ff0066', 'menu_ids' => [$menu->id],
        ])->assertSessionHasNoErrors()->assertRedirect();
        $this->assertDatabaseHas('categories', ['name' => 'Matelas mousse', 'color' => '#ff0066']);

        $this->actingAs($admin)->post(route('admin.menus.store'), ['name' => 'Oreillers', 'is_active' => 1, 'position' => 'header'])
            ->assertSessionHasNoErrors();

        $this->actingAs($admin)->post(route('admin.products.store'), [
            'name' => 'Matelas Confort', 'price' => 150000, 'image' => UploadedFile::fake()->image('p.jpg'), 'is_active' => 1, 'menu_ids' => [$menu->id],
            'variants_enabled' => 1, 'variants' => [['variant_type' => '140x190', 'thickness_cm' => 20, 'places' => 2, 'price' => 150000, 'stock' => 3, 'is_active' => 1]],
        ])->assertSessionHasNoErrors()->assertRedirect();
        $product = Product::where('name', 'Matelas Confort')->firstOrFail();

        $this->actingAs($admin)->get(route('admin.products.edit', $product))->assertOk();
        $this->actingAs($admin)->put(route('admin.products.update', $product), ['name' => 'Matelas Confort+', 'price' => 160000])
            ->assertSessionHasNoErrors();
        $this->assertSame('Matelas Confort+', $product->fresh()->name);
    }

    public function test_admin_can_update_and_delete_b2b_category(): void
    {
        $admin = $this->admin();
        $b2b = B2BCategory::create(['key' => 'hotel', 'name' => 'Hôtel', 'is_active' => true, 'min_products' => 1]);

        $this->actingAs($admin)->get(route('admin.b2b.edit', $b2b))->assertOk()->assertSee('Hôtel');
        $this->actingAs($admin)->put(route('admin.b2b.update', $b2b), ['key' => 'hotel', 'name' => 'Hôtellerie', 'color' => '#123456', 'min_products' => 2])
            ->assertSessionHasNoErrors();
        $this->assertSame('Hôtellerie', $b2b->fresh()->name);

        $this->actingAs($admin)->delete(route('admin.b2b.destroy', $b2b))->assertRedirect();
        $this->assertDatabaseMissing('b2b_categories', ['id' => $b2b->id]);
    }

    public function test_visitor_stats_only_count_cote_divoire(): void
    {
        $admin = $this->admin();
        foreach ([['CI', 'Abidjan', 'Abidjan'], ['CI', 'Bouaké', 'Gbêkê'], ['FR', 'Paris', 'Île-de-France'], ['US', 'Ashburn', 'Virginia']] as $i => [$code, $city, $region]) {
            PageView::create(['visitor_id' => "v{$i}", 'path' => '/', 'route_name' => 'home', 'country_code' => $code, 'country' => $code, 'city' => $city, 'region' => $region, 'source' => 'Direct', 'medium' => 'direct']);
        }
        PageView::create(['visitor_id' => 'unknown', 'path' => '/', 'route_name' => 'home']);

        $json = $this->actingAs($admin)->getJson(route('admin.dashboard.realtime'))->assertOk()->json();
        $this->assertSame(2, $json['visitors']['today']);

        $this->actingAs($admin)->get(route('admin.dashboard'))->assertOk();

        $this->actingAs($admin)->get(route('admin.stats.index'))->assertOk()
            ->assertSee('Abidjan')->assertSee('Bouaké')->assertDontSee('Ashburn')->assertDontSee('Paris')
            ->assertViewHas('visitorsMonth', 2);

        $this->actingAs($admin)->get(route('admin.stats.index', ['month' => 'nimportequoi']))->assertOk();
    }
}
