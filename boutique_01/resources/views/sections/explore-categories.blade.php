@php
    use App\Models\FeaturedCategory;

    $section = $exploreCategoriesSection ?? null;
    $isActive = $section ? (bool) ($section->is_active ?? true) : true;
    $title = $section && !empty($section->title) ? $section->title : 'Meilleures Catégories';
    $subtitle = $section && !empty($section->description) ? $section->description : 'Matelas, Oreillers, Couettes, Électroménagers, Lit et Canapé';

    // Try to get featured categories from database
    $featuredCategories = FeaturedCategory::query()->active()->ordered()->get();

    // If no featured categories in database, use default cards
    if ($featuredCategories->isEmpty()) {
        $cards = [];

        if ($section && !empty($section->content['cards']) && is_array($section->content['cards'])) {
            $cards = $section->content['cards'];
        }

        if (!$cards) {
            $cards = [
                ['menu_slug' => 'matelas', 'title' => 'Matelas', 'cta' => 'Découvrir', 'image' => null, 'image_alt' => 'Matelas'],
                ['menu_slug' => 'lit-canape', 'title' => 'Lits & Canapés', 'cta' => 'Découvrir', 'image' => null, 'image_alt' => 'Lits & Canapés'],
                ['menu_slug' => 'electromenager', 'title' => 'Electroménagers', 'cta' => 'Découvrir', 'image' => null, 'image_alt' => 'Electroménagers'],
                ['menu_slug' => 'drap-et-couettes', 'title' => 'Couettes', 'cta' => 'Découvrir', 'image' => null, 'image_alt' => 'Couettes'],
            ];
        }
    } else {
        // Use featured categories from database
        $cards = $featuredCategories->map(function($fc) {
            return [
                'menu_slug' => $fc->menu ? $fc->menu->slug : null,
                'title' => $fc->title,
                'cta' => $fc->cta,
                'image' => $fc->image,
                'image_alt' => $fc->image_alt ?: $fc->title,
            ];
        })->toArray();
    }
@endphp

@if($isActive)
    <section class="home-explore-categories" aria-label="Explorez nos catégories">
        <div class="container">
            <div class="home-explore-categories__head">
                <h2 class="home-explore-categories__title">{{ $title }}</h2>
                <p class="home-explore-categories__subtitle">{{ $subtitle }}</p>
            </div>

            <div class="home-explore-categories__grid">
                @foreach($cards as $card)
                    @php
                        $menuSlug = !empty($card['menu_slug']) ? (string) $card['menu_slug'] : '';
                        $cardTitle = !empty($card['title']) ? (string) $card['title'] : '';
                        $cardCta = !empty($card['cta']) ? (string) $card['cta'] : 'Découvrir';
                        $cardAlt = !empty($card['image_alt']) ? (string) $card['image_alt'] : $cardTitle;
                        $href = $menuSlug !== '' ? route('menu.show', $menuSlug) : '#';
                        $img = !empty($card['image']) ? $card['image'] : null;
                    @endphp

                    <a class="home-explore-categories__card" href="{{ $href }}">
                        @if($img)
                            <img class="home-explore-categories__img" src="@image_url($img)" alt="{{ $cardAlt }}" loading="lazy" />
                        @endif
                        <div class="home-explore-categories__overlay">
                            <h3 class="home-explore-categories__name">{{ $cardTitle }}</h3>
                            <span class="home-explore-categories__cta">{{ $cardCta }} <span aria-hidden="true">→</span></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif
