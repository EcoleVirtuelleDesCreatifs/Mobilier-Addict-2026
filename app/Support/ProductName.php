<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Support\Str;

/**
 * Mise en forme des noms de produits (affichage, balise title, slug, fil d'Ariane).
 *
 * « MATELAS ADDICT PH10 ferme - 2 Place -140x190cm -SONAMI »
 *   → nom : « Matelas Addict PH10 ferme Sonami 140×190 cm — 2 places »
 *   → title : « Matelas Addict PH10 ferme 140×190 | Mobilier Addict » (avec --strip=SONAMI)
 */
class ProductName
{
    private const SMALL_WORDS = ['de', 'du', 'des', 'et', 'en', 'à', 'a', 'la', 'le', 'les', 'pour', 'avec', 'sans', 'sur', 'au', 'aux', 'd', 'l'];

    /** Qualificatifs écrits en minuscules, même saisis en capitales (fermeté, couleurs). */
    private const DESCRIPTORS = ['ferme', 'extra', 'souple', 'medium', 'médium', 'équilibré', 'equilibre', 'moelleux', 'mi-ferme', 'très', 'blanc', 'blanche', 'gris', 'grise', 'noir', 'noire', 'beige', 'bleu', 'rose', 'marron', 'taupe', 'crème'];

    private const DIM_PATTERN = '/(\d{2,3})\s*(?:cm)?\s*[x×X*]\s*(\d{2,3})\s*(?:cm)?/u';

    private const PLACES_PATTERN = '/(\d+(?:[.,]5)?)\s*places?\b/iu';

    /** Décompose un nom brut en base / dimensions / nombre de places. */
    public static function parse(string $raw, array $strip = []): array
    {
        $text = ' ' . trim($raw) . ' ';

        $dims = null;
        if (preg_match(self::DIM_PATTERN, $text, $m)) {
            $dims = $m[1] . '×' . $m[2];
            $text = str_replace($m[0], ' ', $text);
        }

        $places = null;
        if (preg_match(self::PLACES_PATTERN, $text, $m)) {
            $places = (float) str_replace(',', '.', $m[1]);
            $text = str_replace($m[0], ' ', $text);
        }

        foreach ($strip as $word) {
            $word = trim((string) $word);
            if ($word !== '') {
                $text = preg_replace('/(?<![\p{L}\p{N}])' . preg_quote($word, '/') . '(?![\p{L}\p{N}])/iu', ' ', $text);
            }
        }

        // Séparateurs orphelins (« - », « -X », « X- », « | », « / ») et espaces multiples.
        $text = preg_replace('/\s[-–—|\/]+(?=\S)/u', ' ', $text);
        $text = preg_replace('/(?<=\S)[-–—|\/]+\s/u', ' ', $text);
        $text = preg_replace('/\s[-–—|\/,]+\s/u', ' ', $text);
        $text = trim(preg_replace('/\s+/u', ' ', $text), " -–—|/,");

        return ['base' => self::caseWords($text), 'dims' => $dims, 'places' => $places];
    }

    /** Nom propre et lisible pour l'affichage et la base. */
    public static function normalize(string $raw, array $strip = []): string
    {
        $p = self::parse($raw, $strip);
        $name = $p['base'];
        if ($p['dims']) {
            $name .= ' ' . $p['dims'] . ' cm';
        }
        if ($p['places']) {
            $name .= ' — ' . self::placesLabel($p['places']);
        }

        return trim($name);
    }

    /** Balise title ≤ 60 caractères : « Base Dimensions | Mobilier Addict ». */
    public static function seoTitle(Product $product, int $max = 60): string
    {
        $custom = trim((string) ($product->seo_title ?? ''));
        if ($custom !== '') {
            return Str::limit($custom, $max, '');
        }

        $suffix = ' | Mobilier Addict';
        $p = self::parse((string) $product->name);
        $short = trim($p['base'] . ($p['dims'] ? ' ' . $p['dims'] : ''));

        if (mb_strlen($short . $suffix) > $max) {
            $short = self::cutWords($short, $max - mb_strlen($suffix));
        }

        return $short . $suffix;
    }

    /** Slug court et cohérent avec le nom : matelas-addict-ph10-ferme-140x190-2-places. */
    public static function slug(string $raw, array $strip = []): string
    {
        $p = self::parse($raw, $strip);
        $parts = [$p['base'], $p['dims'] ? str_replace('×', 'x', $p['dims']) : null, $p['places'] ? str_replace(',', '-', self::placesLabel($p['places'])) : null];

        return Str::slug(implode(' ', array_filter($parts))) ?: 'produit';
    }

    /** Le slug désigne-t-il un autre modèle que le nom ? (ex. slug « ph6 » pour un produit « PH10 »). */
    public static function slugMismatch(string $name, string $slug): bool
    {
        $codes = fn (string $s) => collect(preg_split('/[^a-z0-9]+/', Str::slug($s)))
            ->filter(fn ($t) => preg_match('/[a-z]/', $t) && preg_match('/\d/', $t))
            ->reject(fn ($t) => preg_match('/^\d+x\d+(cm)?$|^\d+cm$/', $t))
            ->values()->all();

        $nameCodes = $codes($name);
        $slugCodes = $codes($slug);

        if (array_diff($slugCodes, $nameCodes) || array_diff($nameCodes, $slugCodes)) {
            return true;
        }

        // Mots-clés de fermeté contradictoires (extra-ferme / ferme / souple…).
        $firmness = fn (string $s) => preg_match('/extra[\s-]*ferme|souple|medium|equilibre|ferme/', Str::slug($s), $m) ? $m[0] : null;
        $a = $firmness($name);
        $b = $firmness($slug);

        return $a !== null && $b !== null && str_replace(' ', '-', $a) !== $b;
    }

    public static function places(Product $product): ?float
    {
        $p = self::parse((string) $product->name);
        if ($p['places']) {
            return $p['places'];
        }

        $variant = method_exists($product, 'preferredVariant') ? $product->preferredVariant() : null;

        return $variant && $variant->places ? (float) $variant->places : null;
    }

    public static function placesLabel(float $places): string
    {
        $n = rtrim(rtrim(number_format($places, 1, ',', ''), '0'), ',');

        return $n . ($places >= 2 ? ' places' : ' place');
    }

    private static function caseWords(string $text): string
    {
        $words = preg_split('/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY);
        $out = [];
        foreach ($words as $i => $word) {
            $lower = mb_strtolower($word);
            if (preg_match('/\d/u', $word)) {
                $out[] = mb_strtoupper($word);          // PH10, T2…
            } elseif ($i > 0 && (in_array($lower, self::SMALL_WORDS, true) || in_array($lower, self::DESCRIPTORS, true))) {
                $out[] = $lower;
            } elseif ($word === mb_strtoupper($word) && mb_strlen($word) > 2) {
                $out[] = self::ucfirst($lower);         // ADDICT → Addict
            } elseif ($i === 0) {
                $out[] = self::ucfirst($word);
            } else {
                $out[] = $word;                         // ferme, XL… inchangés
            }
        }

        return implode(' ', $out);
    }

    private static function ucfirst(string $s): string
    {
        return mb_strtoupper(mb_substr($s, 0, 1)) . mb_substr($s, 1);
    }

    private static function cutWords(string $s, int $max): string
    {
        if (mb_strlen($s) <= $max) {
            return $s;
        }
        $cut = mb_substr($s, 0, $max + 1);
        $pos = mb_strrpos($cut, ' ');

        return rtrim($pos ? mb_substr($cut, 0, $pos) : mb_substr($s, 0, $max), ' -–—,');
    }
}
