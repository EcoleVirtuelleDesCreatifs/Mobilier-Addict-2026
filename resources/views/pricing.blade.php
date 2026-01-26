@extends('layouts.front')

@section('title', "Votre Sommeil Parfait")
@section('meta_description', "Découvrez nos offres et trouvez votre sommeil parfait, à votre prix.")

@section('content')
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
            <a class="pricing-card" href="#">
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

            <a class="pricing-card pricing-card--featured" href="#">
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

            <a class="pricing-card" href="#">
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
@endsection
