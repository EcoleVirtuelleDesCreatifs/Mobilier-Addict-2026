@php
    // Données structurées JSON-LD : fil d'Ariane + liste de produits
    $schemaCrumbs = [
        ['name' => 'Accueil', 'url' => route('home')],
        ['name' => $collectionTitle ?? $pageTitle ?? '', 'url' => url()->current()],
    ];
    $schemaSource = $collectionProducts ?? $products ?? collect();
    if ($schemaSource instanceof \Illuminate\Contracts\Pagination\Paginator) {
        $schemaSource = collect($schemaSource->items());
    }
    $schemaItems = collect($schemaSource)->values()->map(function ($p, $i) {
        return [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'url' => route('product.show', $p->slug),
            'name' => $p->name,
        ];
    })->values();
@endphp
<script type="application/ld+json">
{!! json_encode([
    '@@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => collect($schemaCrumbs)->values()->map(fn($c, $i) => [
        '@type' => 'ListItem', 'position' => $i + 1, 'name' => $c['name'], 'item' => $c['url'],
    ])->all(),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@if($schemaItems->isNotEmpty())
<script type="application/ld+json">
{!! json_encode([
    '@@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'numberOfItems' => $schemaItems->count(),
    'itemListElement' => $schemaItems->all(),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif
