        <section class="video-hero" aria-label="Découvrez notre univers" data-video-url="https://www.youtube.com/embed/dQw4w9WgXcQ">
            <div class="video-hero__bg">
                <img src="https://images.unsplash.com/photo-1616627561839-074385245ff6?w=1920&h=900&fit=crop" alt="" loading="lazy" />
            </div>
            <div class="container">
                <div class="video-hero__content">
                    <span class="video-hero__badge">🎬 Immersion totale</span>
                    <h2 class="video-hero__title">Entrez Dans<br>Notre Univers</h2>
                    <p class="video-hero__text">Découvrez les coulisses de notre savoir-faire artisanal. Chaque matelas est une œuvre, conçue avec passion pour votre bien-être.</p>

                    <a class="video-hero__play" href="#" aria-label="Lire la vidéo" data-video-trigger>
                        <span class="video-hero__play-icon">
                            <svg viewBox="0 0 24 24" width="28" height="28"><path d="M8 5v14l11-7L8 5z" fill="currentColor"/></svg>
                        </span>
                        <span class="video-hero__play-text">
                            <strong>Regarder la vidéo</strong>
                            <small>2 min 30</small>
                        </span>
                    </a>
                </div>

                <div class="video-hero__preview">
                    <div class="video-hero__frame" role="button" tabindex="0" aria-label="Lire la vidéo" data-video-trigger>
                        <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&h=500&fit=crop" alt="Aperçu vidéo" loading="lazy" />
                        <div class="video-hero__frame-play">
                            <svg viewBox="0 0 80 80" width="80" height="80">
                                <circle cx="40" cy="40" r="38" fill="rgba(255,255,255,.9)" stroke="none"/>
                                <path d="M32 25v30l24-15-24-15z" fill="#ec4899"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="video-modal" id="videoModal" aria-hidden="true">
            <div class="video-modal__overlay" data-video-close></div>
            <div class="video-modal__dialog" role="dialog" aria-modal="true" aria-label="Vidéo">
                <button class="video-modal__close" type="button" aria-label="Fermer" data-video-close>
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M18.3 5.71L12 12l6.3 6.29-1.41 1.42L12 13.41l-6.29 6.3-1.42-1.42L10.59 12 4.29 5.71 5.71 4.29 12 10.59l6.29-6.3z" fill="currentColor"/></svg>
                </button>
                <div class="video-modal__frame" id="videoModalFrame"></div>
            </div>
        </div>

        @push('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const section = document.querySelector('.video-hero');
            const modal = document.getElementById('videoModal');
            const frame = document.getElementById('videoModalFrame');
            if (!section || !modal || !frame) return;

            const reducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const baseUrl = section.getAttribute('data-video-url');

            const buildUrl = () => {
                if (!baseUrl) return null;
                const hasQuery = baseUrl.includes('?');
                const sep = hasQuery ? '&' : '?';
                return reducedMotion ? baseUrl : `${baseUrl}${sep}autoplay=1`;
            };

            const open = () => {
                const url = buildUrl();
                if (!url) return;
                frame.innerHTML = `<iframe src="${url}" title="Vidéo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>`;
                modal.classList.add('is-open');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            };

            const close = () => {
                modal.classList.remove('is-open');
                modal.setAttribute('aria-hidden', 'true');
                frame.innerHTML = '';
                document.body.style.overflow = '';
            };

            section.querySelectorAll('[data-video-trigger]').forEach((el) => {
                el.addEventListener('click', (e) => {
                    e.preventDefault();
                    open();
                });
                el.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        open();
                    }
                });
            });

            modal.querySelectorAll('[data-video-close]').forEach((el) => {
                el.addEventListener('click', (e) => {
                    e.preventDefault();
                    close();
                });
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('is-open')) {
                    close();
                }
            });
        });
        </script>
        @endpush

        @push('styles')
        <style>
        .video-modal{position:fixed;inset:0;z-index:99999;display:none}
        .video-modal.is-open{display:block}
        .video-modal__overlay{position:absolute;inset:0;background:rgba(2,6,23,.72);backdrop-filter:blur(8px)}
        .video-modal__dialog{position:relative;max-width:min(980px,calc(100vw - 32px));margin:6vh auto 0;background:rgba(255,255,255,.92);border:1px solid rgba(255,255,255,.22);border-radius:18px;box-shadow:0 30px 80px rgba(0,0,0,.35);overflow:hidden}
        .video-modal__close{position:absolute;top:12px;right:12px;border:none;background:rgba(15,23,42,.08);color:#0b1220;border-radius:12px;width:40px;height:40px;display:flex;align-items:center;justify-content:center;cursor:pointer;z-index:2}
        .video-modal__close:hover{background:rgba(15,23,42,.14)}
        .video-modal__frame{width:100%;aspect-ratio:16/9;background:#000}
        .video-modal__frame iframe{width:100%;height:100%;display:block}
        </style>
        @endpush

        <section class="accessories" aria-label="Accessoires literie">
            <div class="container">
                <div class="accessories__header">
                    <span class="accessories__badge">✨ Accessoires essentiels</span>
                    <h2 class="accessories__title">Complétez Votre Cocon</h2>
                    <p class="accessories__subtitle">Les petits plus qui font toute la différence pour des nuits parfaites</p>
                </div>

                <div class="accessories__grid">
                    @foreach(($accessoryProducts ?? collect()) as $product)
                        @php
                            $categoryLabel = $product->category?->name;
                        @endphp

                        <article class="acc-card">
                            <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                <div class="acc-card__media">
                                    <img src="{{ $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1584100936595-c0654b55a2e2?w=400&h=400&fit=crop' }}" alt="{{ $product->name }}" loading="lazy" />
                                </div>
                            </a>

                            <div class="acc-card__body">
                                <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                    <h3 class="acc-card__name">{{ $product->name }}</h3>
                                </a>
                                <div class="acc-card__footer">
                                    <span class="acc-card__price">{{ number_format((float) $product->price, 0, ',', '.') }}<small>F</small></span>
                                    <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="acc-card__btn" type="submit" aria-label="Ajouter au panier">+</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
