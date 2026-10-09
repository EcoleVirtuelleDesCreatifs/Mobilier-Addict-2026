        @if(!empty($spaceSection))
            <section class="spaces" aria-label="Solutions B2B">
                <div class="container">
                    <div class="spaces__header">
                        <span class="spaces__badge">{{ trim(($spaceSection->badge_icon ? $spaceSection->badge_icon . ' ' : '') . ($spaceSection->badge ?? '')) }}</span>
                        <h2 class="spaces__title">{!! nl2br(e($spaceSection->title)) !!}</h2>
                        @if(!empty($spaceSection->subtitle))
                            <p class="spaces__subtitle">{{ $spaceSection->subtitle }}</p>
                        @endif
                    </div>

                    <div class="spaces__grid">
                        @foreach(($spaceSection->cards ?? collect()) as $card)
                            @php
                                $sizeClass = $card->size === 'large' ? 'space-card--large' : '';
                                $extraClass = '';
                                if (($card->size === 'large') && ($loop->last)) {
                                    $extraClass = 'space-card--wide';
                                }
                            @endphp

                            <a class="space-card {{ $sizeClass }} {{ $extraClass }}" href="{{ route('b2b.index') }}">
                                <img src="@image_url($card->image)" alt="{{ $card->image_alt ?: $card->title }}" loading="lazy" />
                                <div class="space-card__overlay">
                                    <h3 class="space-card__title">{{ $card->title }}</h3>
                                    @if(!empty($card->description))
                                        <p class="space-card__desc">{{ $card->description }}</p>
                                    @endif
                                    @if(!empty($card->cta_text))
                                        <span class="space-card__cta">{{ $card->cta_text }}</span>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
