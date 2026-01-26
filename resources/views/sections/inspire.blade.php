        <section class="inspire" aria-label="Inspirez-vous">
            <div class="container">
                <div class="inspire__header">
                    <span class="inspire__badge">✨ Laissez-vous séduire</span>
                    <h2 class="inspire__title">Créez Votre Refuge de Bien-Être</h2>
                    <p class="inspire__subtitle">Chaque nuit mérite d'être exceptionnelle. Découvrez nos univers pensés pour éveiller vos sens.</p>
                </div>

                <div class="inspire__grid">
                    <a class="inspire__card inspire__card--large" href="#">
                        <img src="https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800&h=1000&fit=crop" alt="Chambre luxueuse" loading="lazy" />
                        <div class="inspire__overlay">
                            <span class="inspire__tag">Luxe & Sérénité</span>
                            <h3 class="inspire__card-title">L'Art du Sommeil Parfait</h3>
                            <p class="inspire__card-text">Plongez dans un cocon de douceur où chaque détail invite à la détente absolue.</p>
                            <span class="inspire__cta">Explorer <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                        </div>
                    </a>

                    <a class="inspire__card" href="#">
                        <img src="https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=600&h=400&fit=crop" alt="Chambre moderne" loading="lazy" />
                        <div class="inspire__overlay">
                            <span class="inspire__tag">Design Moderne</span>
                            <h3 class="inspire__card-title">Élégance Contemporaine</h3>
                            <span class="inspire__cta">Découvrir <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                        </div>
                    </a>

                    <a class="inspire__card" href="#">
                        <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=600&h=400&fit=crop" alt="Chambre cosy" loading="lazy" />
                        <div class="inspire__overlay">
                            <span class="inspire__tag">Cosy & Chaleureux</span>
                            <h3 class="inspire__card-title">Douceur Naturelle</h3>
                            <span class="inspire__cta">Découvrir <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                        </div>
                    </a>

                    <div class="inspire__message">
                        <div class="inspire__message-inner">
                            <div class="inspire__icon">💭</div>
                            <h3 class="inspire__message-title">Rêvez Plus Grand</h3>
                            <p class="inspire__message-text">Votre chambre est bien plus qu'un simple espace. C'est votre sanctuaire, l'endroit où chaque réveil devient une promesse de journée réussie.</p>
                            <a class="inspire__message-btn" href="#">
                                Trouvez votre bonheur
                                <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pricing" aria-label="Trouvez votre matelas">
            <div class="container">
                <div class="pricing__header">
                    <span class="pricing__badge">💰 Adapté à votre budget</span>
                    <h2 class="pricing__title">Votre Sommeil Parfait,<br>À Votre Prix</h2>
                    <p class="pricing__subtitle">Peu importe votre budget, nous avons le matelas qui transformera vos nuits</p>
                </div>

                <div class="pricing__tabs">
                    <button class="pricing__tab is-active" type="button">Matelas</button>
                    <button class="pricing__tab" type="button">Lits Complets</button>
                </div>

                <div class="pricing__grid">
                    <a class="pricing-card" href="{{ route('pricing') }}">
                        <div class="pricing-card__image">
                            <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=600&h=700&fit=crop" alt="Chambre économique" loading="lazy" />
                            <div class="pricing-card__glow pricing-card__glow--blue"></div>
                        </div>
                        <div class="pricing-card__content">
                            <span class="pricing-card__label">Essentiel</span>
                            <h3 class="pricing-card__title">Confort Accessible</h3>
                            <p class="pricing-card__desc">Qualité et douceur pour des nuits reposantes, sans compromis sur l'essentiel.</p>
                            <div class="pricing-card__price">
                                <span class="pricing-card__from">À partir de</span>
                                <span class="pricing-card__amount">35.000<small>F</small></span>
                            </div>
                            <span class="pricing-card__cta">Découvrir <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                        </div>
                    </a>

                    <a class="pricing-card pricing-card--featured" href="{{ route('pricing') }}">
                        <div class="pricing-card__badge">⭐ BEST SELLER</div>
                        <div class="pricing-card__image">
                            <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&h=700&fit=crop" alt="Chambre premium" loading="lazy" />
                            <div class="pricing-card__glow pricing-card__glow--pink"></div>
                        </div>
                        <div class="pricing-card__content">
                            <span class="pricing-card__label">Premium</span>
                            <h3 class="pricing-card__title">L'Équilibre Parfait</h3>
                            <p class="pricing-card__desc">Le choix de nos clients. Confort supérieur et durabilité exceptionnelle.</p>
                            <div class="pricing-card__price">
                                <span class="pricing-card__from">Entre</span>
                                <span class="pricing-card__amount">50.000<small>F</small></span>
                                <span class="pricing-card__to">et 78.000F</span>
                            </div>
                            <span class="pricing-card__cta">Découvrir <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                        </div>
                    </a>

                    <a class="pricing-card" href="{{ route('pricing') }}">
                        <div class="pricing-card__image">
                            <img src="https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=600&h=700&fit=crop" alt="Chambre luxe" loading="lazy" />
                            <div class="pricing-card__glow pricing-card__glow--gold"></div>
                        </div>
                        <div class="pricing-card__content">
                            <span class="pricing-card__label">Excellence</span>
                            <h3 class="pricing-card__title">Luxe Absolu</h3>
                            <p class="pricing-card__desc">L'expérience ultime du sommeil. Matériaux nobles, finitions prestigieuses.</p>
                            <div class="pricing-card__price">
                                <span class="pricing-card__from">À partir de</span>
                                <span class="pricing-card__amount">100.000<small>F</small></span>
                            </div>
                            <span class="pricing-card__cta">Découvrir <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                        </div>
                    </a>
                </div>

                <div class="pricing__footer">
                    <p class="pricing__guarantee">✓ Livraison gratuite &nbsp; ✓ 100 nuits d'essai &nbsp; ✓ Garantie 10 ans</p>
                </div>
            </div>
        </section>

        <section class="trust" aria-label="Pourquoi nous choisir">
            <div class="trust__bg">
                <img src="https://images.unsplash.com/photo-1540518614846-7eded433c457?w=1920&h=800&fit=crop" alt="" loading="lazy" />
            </div>
            <div class="container">
                <div class="trust__header">
                    <span class="trust__badge">❤️ +10 000 clients satisfaits</span>
                    <h2 class="trust__title">Pourquoi Ils Nous<br>Font Confiance</h2>
                    <p class="trust__subtitle">Découvrez ce qui fait la différence Matelas Addict</p>
                </div>

                <div class="trust__grid">
                    <div class="trust-card">
                        <div class="trust-card__icon">
                            <svg viewBox="0 0 48 48" width="48" height="48"><circle cx="24" cy="24" r="22" fill="none" stroke="currentColor" stroke-width="2"/><path d="M14 24c0-6 4-10 10-10s10 4 10 10-4 14-10 14-10-8-10-14z" fill="currentColor" opacity=".2"/><path d="M24 14c-5.5 0-10 4.5-10 10s4.5 10 10 10 10-4.5 10-10" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                        </div>
                        <h3 class="trust-card__title">Confort Enveloppant</h3>
                        <p class="trust-card__text">Chaque courbe de votre corps est délicatement soutenue. Vous vous endormez comme sur un nuage, bercé par une douceur incomparable.</p>
                        <div class="trust-card__stat">
                            <span class="trust-card__number">98%</span>
                            <span class="trust-card__label">de satisfaction</span>
                        </div>
                    </div>

                    <div class="trust-card trust-card--highlight">
                        <div class="trust-card__icon">
                            <svg viewBox="0 0 48 48" width="48" height="48"><path d="M24 4l6 12 13 2-9.5 9 2.5 13-12-6.5L12 40l2.5-13L5 18l13-2z" fill="currentColor" opacity=".2"/><path d="M24 4l6 12 13 2-9.5 9 2.5 13-12-6.5L12 40l2.5-13L5 18l13-2z" stroke="currentColor" stroke-width="2" fill="none" stroke-linejoin="round"/></svg>
                        </div>
                        <h3 class="trust-card__title">Réveil Sans Douleur</h3>
                        <p class="trust-card__text">Fini les maux de dos au réveil ! Notre technologie d'alignement vertébral vous offre des matins pleins d'énergie et de vitalité.</p>
                        <div class="trust-card__stat">
                            <span class="trust-card__number">87%</span>
                            <span class="trust-card__label">moins de douleurs</span>
                        </div>
                    </div>

                    <div class="trust-card">
                        <div class="trust-card__icon">
                            <svg viewBox="0 0 48 48" width="48" height="48"><rect x="8" y="8" width="32" height="32" rx="4" fill="currentColor" opacity=".2"/><path d="M8 16h32M16 8v32" stroke="currentColor" stroke-width="2"/><circle cx="32" cy="32" r="8" fill="none" stroke="currentColor" stroke-width="2"/><path d="M29 32l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <h3 class="trust-card__title">Qualité Garantie 10 Ans</h3>
                        <p class="trust-card__text">Des matériaux nobles, une fabrication irréprochable. Votre investissement est protégé, votre sommeil assuré pour des années.</p>
                        <div class="trust-card__stat">
                            <span class="trust-card__number">10</span>
                            <span class="trust-card__label">ans de garantie</span>
                        </div>
                    </div>
                </div>

                <div class="trust__cta">
                    <a class="trust__btn" href="#">
                        Rejoignez-les maintenant
                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                    </a>
                </div>
            </div>
        </section>
