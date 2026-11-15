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
        $variant = new ProductVariant(['price' => 85000, 'stock' => 0, 'is_active' => true]);
        $variant->id = 17;
        $inactive = new ProductVariant(['price' => 1000, 'is_active' => false]);
        $product->setRelation('variants', collect([$inactive, $variant]));

        $html = view('maquette.includes.card-2027', compact('product'))->render();

        $this->assertStringContainsString('85 000', $html);
        $this->assertStringContainsString('name="product_variant_id" value="17"', $html);
        $this->assertStringContainsString('name="quantity" value="1"', $html);
        $this->assertStringContainsString('Commander directement</button>', $html);
        $this->assertStringContainsString('Ajouter au panier</button>', $html);
        $this->assertStringContainsString('name="redirect_to" value="shipping"', $html);
    }

    public function test_card_can_order_a_stocked_variant_when_parent_stock_is_zero(): void
    {
        $product = $this->product(['stock' => 0]);
        $variant = new ProductVariant(['price' => 85000, 'stock' => 3, 'is_active' => true]);
        $variant->id = 17;
        $product->setRelation('variants', collect([$variant]));
        $html = view('maquette.includes.card-2027', compact('product'))->render();
        $this->assertStringContainsString('name="product_variant_id" value="17"', $html);
        $this->assertStringNotContainsString(' disabled', $html);
        $this->assertStringNotContainsString('Sur commande', $html);
    }

    public function test_card_prefers_a_priced_stocked_variant_over_a_zero_price_option(): void
    {
        $product = $this->product(['stock' => 0]);
        $product->setRelation('variants', collect([
            new ProductVariant(['price' => 0, 'stock' => 3, 'is_active' => true]),
            new ProductVariant(['price' => 85000, 'stock' => 2, 'is_active' => true]),
        ]));
        $html = view('maquette.includes.card-2027', compact('product'))->render();
        $this->assertStringContainsString('85 000', $html);
        $this->assertSame(2, substr_count($html, '#product-options'));
        $this->assertStringNotContainsString(' disabled', $html);
    }

    public function test_inactive_variant_does_not_unlock_an_out_of_stock_product(): void
    {
        $product = $this->product(['stock' => 0]);
        $product->setRelation('variants', collect([
            new ProductVariant(['price' => 85000, 'stock' => 3, 'is_active' => false]),
        ]));
        $html = view('maquette.includes.card-2027', compact('product'))->render();
        $this->assertSame(2, substr_count($html, ' disabled'));
    }

    public function test_color_products_link_to_their_options_instead_of_quick_add(): void
    {
        $product = $this->product();
        $product->setRelation('category', new Category(['slug' => 'draps']));

        $html = view('maquette.includes.card-2027', compact('product'))->render();

        $this->assertStringNotContainsString('ma27-quick-add', $html);
        $this->assertStringContainsString('Voir les options de Matelas test', $html);
    }

    public function test_multiple_variants_require_options_before_either_card_action(): void
    {
        $product = $this->product();
        $product->setRelation('variants', collect([
            new ProductVariant(['price' => 70000, 'is_active' => true]),
            new ProductVariant(['price' => 85000, 'is_active' => true]),
        ]));
        $html = view('maquette.includes.card-2027', compact('product'))->render();
        $this->assertStringNotContainsString('ma27-quick-add', $html);
        $this->assertSame(2, substr_count($html, '#product-options'));
        $this->assertStringContainsString('Commander directement</a>', $html);
        $this->assertStringContainsString('Ajouter au panier</a>', $html);
    }

    public function test_unavailable_products_do_not_have_a_quick_add_form(): void
    {
        $product = $this->product(['stock' => 0]);

        $html = view('maquette.includes.card-2027', compact('product'))->render();

        $this->assertStringNotContainsString('ma27-quick-add', $html);
        $this->assertStringContainsString('Sur commande', $html);
        $this->assertSame(2, substr_count($html, ' disabled'));
    }

    public function test_missing_images_use_a_neutral_placeholder(): void
    {
        $this->assertSame(asset('assets/maquette/img/product-placeholder.svg'), image_url('products/nonexistent-product-image.webp'));
        $this->assertSame(asset('assets/maquette/img/product-placeholder.svg'), image_url(null));
    }

    public function test_storefront_uses_helvetica_without_loading_external_text_fonts(): void
    {
        foreach (['ma27.css', 'ma27-pages.css'] as $file) {
            $css = file_get_contents(public_path('assets/maquette/css/' . $file));
            $this->assertStringContainsString('--serif:Helvetica,Arial,sans-serif', $css);
            $this->assertStringNotContainsString('Instrument Serif', $css);
            $this->assertStringNotContainsString('Inter', $css);
            $this->assertStringNotContainsString('fonts.googleapis.com', $css);
        }
        $this->assertStringNotContainsString('fonts.googleapis.com', file_get_contents(resource_path('views/maquette/layout.blade.php')));
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
