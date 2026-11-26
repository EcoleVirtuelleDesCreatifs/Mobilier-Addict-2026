<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Support\ProductName;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_name_title_and_slug_are_normalized(): void
    {
        $raw = 'MATELAS ADDICT PH10 ferme - 2 Place -140x190cm -SONAMI';

        $this->assertSame('Matelas Addict PH10 ferme 140×190 cm — 2 places', ProductName::normalize($raw, ['SONAMI']));
        $this->assertSame('matelas-addict-ph10-ferme-140x190-2-places', ProductName::slug($raw, ['SONAMI']));
        $this->assertTrue(ProductName::slugMismatch($raw, 'medicosoins-ph6-extra-ferme'));

        $title = ProductName::seoTitle(new Product(['name' => ProductName::normalize($raw, ['SONAMI'])]));
        $this->assertSame('Matelas Addict PH10 ferme 140×190 | Mobilier Addict', $title);
        $this->assertLessThanOrEqual(60, mb_strlen($title));
    }

    public function test_tidy_command_renames_and_redirects_old_slug(): void
    {
        $product = Product::create([
            'name' => 'MATELAS ADDICT PH10 ferme - 2 Place -140x190cm -SONAMI',
            'slug' => 'medicosoins-ph6-extra-ferme',
            'price' => 150000,
            'image' => 'assets/maquette/img/products/real/placeholder.jpg',
            'is_active' => true,
        ]);

        $this->artisan('products:tidy', ['--strip' => 'SONAMI'])->assertSuccessful();
        $this->assertSame('medicosoins-ph6-extra-ferme', $product->fresh()->slug, 'Aperçu : aucune modification');

        $this->artisan('products:tidy', ['--strip' => 'SONAMI', '--apply' => true])->assertSuccessful();
        $product->refresh();
        $this->assertSame('Matelas Addict PH10 ferme 140×190 cm — 2 places', $product->name);
        $this->assertSame('matelas-addict-ph10-ferme-140x190-2-places', $product->slug);

        $this->get('/produit/medicosoins-ph6-extra-ferme')
            ->assertStatus(301)
            ->assertRedirect(route('product.show', $product->slug));

        $this->get('/produit/' . $product->slug)->assertOk()
            ->assertSee('<title>Matelas Addict PH10 ferme 140×190 | Mobilier Addict</title>', false)
            ->assertSee('"@type":"BreadcrumbList"', false)
            ->assertDontSee('"aggregateRating"', false);

        $this->get('/produit/nexiste-pas')->assertNotFound();
    }
}
