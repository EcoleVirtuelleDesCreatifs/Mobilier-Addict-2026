<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Support\ProductName;
use Illuminate\Console\Command;

/**
 * Remet au propre les noms de produits (capitales, tirets, dimensions, places)
 * et corrige les slugs incohérents. Les anciens slugs sont redirigés en 301.
 *
 * Aperçu sans rien modifier :   php artisan products:tidy
 * Appliquer :                   php artisan products:tidy --apply
 */
class TidyProductNames extends Command
{
    protected $signature = 'products:tidy
                            {--apply : Enregistrer les modifications (sinon simple aperçu)}
                            {--slugs=mismatch : Slugs à régénérer : mismatch (seulement les incohérents), all, none}
                            {--strip= : Mots à retirer des noms, séparés par des virgules (ex. SONAMI)}
                            {--id=* : Limiter à certains produits (id)}';

    protected $description = 'Normalise les noms de produits et corrige les slugs incohérents (avec redirections 301)';

    public function handle(): int
    {
        $strip = array_filter(array_map('trim', explode(',', (string) $this->option('strip'))));
        $slugMode = (string) $this->option('slugs');
        $apply = (bool) $this->option('apply');

        $query = Product::query()->orderBy('id');
        if ($ids = $this->option('id')) {
            $query->whereIn('id', $ids);
        }

        $rows = [];
        $changes = [];
        $reserved = [];

        foreach ($query->get() as $product) {
            $newName = ProductName::normalize((string) $product->name, $strip);
            $newSlug = $product->slug;

            $regen = $slugMode === 'all'
                || ($slugMode === 'mismatch' && ProductName::slugMismatch($newName, (string) $product->slug));

            if ($regen) {
                $newSlug = $this->uniqueSlug(ProductName::slug($newName), $product, $reserved);
            }
            $reserved[] = $newSlug;

            if ($newName === $product->name && $newSlug === $product->slug) {
                continue;
            }

            $rows[] = [$product->id, $product->name, $newName, $newSlug !== $product->slug ? $product->slug . ' → ' . $newSlug : '='];
            $changes[] = [$product, $newName, $newSlug];
        }

        if (! $rows) {
            $this->info('Rien à corriger.');

            return self::SUCCESS;
        }

        $this->table(['ID', 'Nom actuel', 'Nouveau nom', 'Slug'], $rows);

        if (! $apply) {
            $this->warn(count($rows) . ' produit(s) à modifier. Relancez avec --apply pour enregistrer.');

            return self::SUCCESS;
        }

        foreach ($changes as [$product, $name, $slug]) {
            $product->forceFill(['name' => $name, 'slug' => $slug])->save();
        }

        $this->info(count($changes) . ' produit(s) mis à jour. Les anciennes adresses redirigent en 301.');

        return self::SUCCESS;
    }

    private function uniqueSlug(string $base, Product $product, array $reserved): string
    {
        $slug = $base;
        $i = 2;
        while (in_array($slug, $reserved, true)
            || Product::query()->where('slug', $slug)->whereKeyNot($product->id)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
