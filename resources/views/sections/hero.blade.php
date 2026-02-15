        <section class="hero" aria-label="Accueil">
            <div class="hero__bg">
                <video class="hero__bg-video" autoplay muted loop playsinline preload="metadata" poster="https://images.unsplash.com/photo-1616627561839-074385245ff6?w=1920&h=900&fit=crop">
                    <source src="{{ asset('assets/video/hero.mp4') }}" type="video/mp4">
                </video>
                <img class="hero__bg-fallback" src="https://images.unsplash.com/photo-1616627561839-074385245ff6?w=1920&h=900&fit=crop" alt="" loading="eager" />
            </div>
            <div class="hero__overlay"></div>
            <div class="container hero__inner">
                <div class="hero__content">
                    <span class="hero__badge">✨ Nouvelle collection 2026</span>
                    <h1 class="hero__title">Réveillez-Vous<br>
                        <span class="hero__accent" aria-label="Transformé">
                            <span class="hero__accent-word hero__accent-word--a">Transformé</span>
                            <span class="hero__accent-word hero__accent-word--b">Reposé</span>
                            <span class="hero__accent-word hero__accent-word--c">Énergisé</span>
                            <span class="hero__accent-word hero__accent-word--d">Serein</span>
                        </span>
                    </h1>
                    <p class="hero__text">Découvrez nos matelas d'exception, conçus pour offrir à votre corps le repos qu'il mérite. Chaque nuit devient une expérience de bien-être absolu.</p>
                    <div class="hero__actions">
                        <a class="hero__btn hero__btn--primary" href="#collection">
                            Explorer la collection
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                        </a>
                        <a class="hero__btn hero__btn--secondary" href="#" data-video-trigger>
                            <svg viewBox="0 0 24 24" width="20" height="20"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/><path d="M10 8l6 4-6 4V8z" fill="currentColor"/></svg>
                            Voir la vidéo
                        </a>
                    </div>
                    <div class="hero__stats">
                        <div class="hero__stat">
                            <span class="hero__stat-number">10K+</span>
                            <span class="hero__stat-label">Clients satisfaits</span>
                        </div>
                        <div class="hero__stat">
                            <span class="hero__stat-number">4.9</span>
                            <span class="hero__stat-label">Note moyenne</span>
                        </div>
                        <div class="hero__stat">
                            <span class="hero__stat-number">10</span>
                            <span class="hero__stat-label">Ans de garantie</span>
                        </div>
                    </div>
                </div>
                <div class="hero__visual">
                    <div class="hero__card" data-slider>
                        <div class="hero__card-track" data-slider-track>
                            @if(($heroSlides ?? collect())->count())
                                @foreach($heroSlides as $slide)
                                    <div class="hero__card-slide" data-slide>
                                        <img src="@image_url($slide->image)" alt="{{ $slide->image_alt ?: $slide->title }}" loading="eager" />
                                    </div>
                                @endforeach
                            @else
                                <div class="hero__card-slide" data-slide>
                                    <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&h=700&fit=crop" alt="Chambre luxueuse" loading="eager" />
                                </div>
                                <div class="hero__card-slide" data-slide>
                                    <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=600&h=700&fit=crop" alt="Chambre moderne" loading="eager" />
                                </div>
                                <div class="hero__card-slide" data-slide>
                                    <img src="https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=600&h=700&fit=crop" alt="Chambre premium" loading="eager" />
                                </div>
                            @endif
                        </div>
                        <button class="hero__card-nav hero__card-nav--prev" type="button" data-slider-prev aria-label="Image précédente">
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                        </button>
                        <button class="hero__card-nav hero__card-nav--next" type="button" data-slider-next aria-label="Image suivante">
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                        </button>
                        <div class="hero__card-badge">
                            <span class="hero__card-discount">-30%</span>
                            <span class="hero__card-text">Offre limitée</span>
                        </div>
                        <div class="hero__card-dots" aria-label="Changer d'image">
                            @php($dotsCount = ($heroSlides ?? collect())->count() ?: 3)
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
