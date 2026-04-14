        <section class="hero" aria-label="Accueil">
            <div class="hero__bg">
                <video class="hero__bg-video" autoplay muted loop playsinline preload="metadata" poster="https://images.unsplash.com/photo-1616627561839-074385245ff6?w=1920&h=900&fit=crop">
                    <source src="{{ asset('assets/video/hero.mp4') }}" type="video/mp4">
                </video>
                <img class="hero__bg-fallback" src="https://images.unsplash.com/photo-1616627561839-074385245ff6?w=1920&h=900&fit=crop" alt="" loading="eager" decoding="async" fetchpriority="high" />
            </div>
            <div class="hero__overlay"></div>
            @php($heroMainSlide = ($heroSlides ?? collect())->first())
            <div class="container hero__inner">
                <div class="hero__content">
                    <span class="hero__badge">{{ $heroMainSlide?->badge ?: '✨ Nouvelle collection 2026' }}</span>
                    <h1 class="hero__title">
                        {{ $heroMainSlide?->title ?: 'Réveillez-vous' }}
                        <span class="hero__accent">{{ $heroMainSlide?->title_highlight ?: 'Reposé' }}</span>
                    </h1>
                    <p class="hero__text">{{ $heroMainSlide?->description ?: "Découvrez nos matelas d'exception, conçus pour offrir à votre corps le repos qu'il mérite." }}</p>
                    <div class="hero__actions">
                        <a class="hero__btn hero__btn--primary" href="{{ $heroMainSlide?->btn_primary_url ?: '#collection' }}">
                            {{ $heroMainSlide?->btn_primary_text ?: 'Explorer la collection' }}
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                        </a>
                    </div>
                </div>
                <div class="hero__visual">
                    <div class="hero__card" data-slider>
                        <div class="hero__card-track" data-slider-track>
                            @if(($heroSlides ?? collect())->count())
                                @foreach($heroSlides as $slide)
                                    <div class="hero__card-slide" data-slide>
                                        <img src="@image_url($slide->image)" alt="{{ $slide->image_alt ?: $slide->title }}" loading="{{ $loop->first ? 'eager' : 'lazy' }}" decoding="async" {{ $loop->first ? 'fetchpriority=high' : '' }} />
                                    </div>
                                @endforeach
                            @else
                                <div class="hero__card-slide" data-slide>
                                    <img src="{{ asset('assets/slider/slide-1.jpg') }}" alt="Slide 1" loading="eager" decoding="async" fetchpriority="high" />
                                </div>
                                <div class="hero__card-slide" data-slide>
                                    <img src="{{ asset('assets/slider/slide-2.jpg') }}" alt="Slide 2" loading="lazy" decoding="async" />
                                </div>
                            @endif
                        </div>
                        <button class="hero__card-nav hero__card-nav--prev" type="button" data-slider-prev aria-label="Image précédente">
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                        </button>
                        <button class="hero__card-nav hero__card-nav--next" type="button" data-slider-next aria-label="Image suivante">
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                        </button>
                        <div class="hero__card-dots" aria-label="Changer d'image">
                            @php($dotsCount = ($heroSlides ?? collect())->count() ?: 2)
                            @for($i = 0; $i < $dotsCount; $i++)
                                <button class="hero__card-dot" type="button" data-dot="{{ $i }}" aria-label="Image {{ $i + 1 }}"></button>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__scroll">
                <span>Découvrir</span>
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M12 5v14M5 12l7 7 7-7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
            </div>
        </section>
