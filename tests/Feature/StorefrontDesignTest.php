<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Tests\TestCase;

class StorefrontDesignTest extends TestCase
{
    private function product(array $attributes = []): Product
    {
        $product = new Product(array_merge([
            'name' => 'Matelas test', 'slug' => 'matelas-test', 'price' => 70000,
            'stock' => 5, 'is_active' => true, 'image' => null,
        ], $attributes));
        $product->id = 42;
        $product->setRelation('variants', collect());
        $product->setRelation('category', null);
        return $product;
    }

    public function test_product_card_uses_the_active_variant_price_and_id(): void
    {
        $product = $this->product();
        $variant = new ProductVariant(['price' => 85000, 'is_active' => true]);
        $variant->id = 17;
        $inactive = new ProductVariant(['price' => 1000, 'is_active' => false]);
        $product->setRelation('variants', collect([$inactive, $variant]));

        $html = view('maquette.includes.card-2027', compact('product'))->render();

        $this->assertStringContainsString('85 000', $html);
        $this->assertStringContainsString('name="product_variant_id" value="17"', $html);
        $this->assertStringContainsString('name="quantity" value="1"', $html);
    }

    public function test_color_products_link_to_their_options_instead_of_quick_add(): void
    {
        $product = $this->product();
        $product->setRelation('category', new Category(['slug' => 'draps']));

        $html = view('maquette.includes.card-2027', compact('product'))->render();

        $this->assertStringNotContainsString('class="ma27-quick-add"', $html);
        $this->assertStringContainsString('Voir les options de Matelas test', $html);
    }

    public function test_unavailable_products_do_not_have_a_quick_add_form(): void
    {
        $product = $this->product(['stock' => 0]);

        $html = view('maquette.includes.card-2027', compact('product'))->render();

        $this->assertStringNotContainsString('class="ma27-quick-add"', $html);
        $this->assertStringContainsString('Sur commande', $html);
    }

    public function test_missing_images_use_a_neutral_placeholder(): void
    {
        $this->assertSame(asset('assets/maquette/img/product-placeholder.svg'), image_url('products/nonexistent-product-image.webp'));
        $this->assertSame(asset('assets/maquette/img/product-placeholder.svg'), image_url(null));
    }

    public function test_existing_public_assets_are_not_replaced_by_the_placeholder(): void
    {
        $this->assertSame(asset('assets/logo/favicon.png'), image_url('assets/logo/favicon.png'));
    }

    public function test_favorites_button_reflects_session_state_and_escapes_names(): void
    {
        session(['favorites' => [42]]);
        $product = $this->product(['name' => '<script>unsafe</script>']);

        $html = view('maquette.includes.favorite-button', compact('product'))->render();

        $this->assertStringContainsString('aria-pressed="true"', $html);
        $this->assertStringContainsString('name="_token"', $html);
        $this->assertStringNotContainsString('<script>unsafe</script>', $html);
    }
}
