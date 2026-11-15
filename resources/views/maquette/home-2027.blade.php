@extends('maquette.layout')
@section('title', 'Mobilier Addict — Matelas et literie à Abidjan')
@section('content')
@php
    $selection = $matelasProducts->filter(fn ($p) => $p->is_active && $p->price > 0)->take(12);
    $posts = collect([$blogFeaturedPost])->filter()->merge($blogPosts)->unique('id')->take(3);
    $slides = $heroSlides->values();
    $wa = 'https://wa.me/' . whatsapp_number();
@endphp
<div class="ma27">
    <section class="hero"><div class="wrap">
        <div>
            <div class="kicker">Literie · Abidjan</div>
            <h1>Le matelas que <em class="rot"><span class="on">votre dos</span><span aria-hidden="true">votre budget</span><span aria-hidden="true">votre sommeil</span></em> attendait.</h1>
            <p class="lead">Choisissez en trente secondes. Livraison à Abidjan, paiement à la livraison.</p>
            <form class="finder" action="{{ route('menu.show', 'matelas') }}" method="GET">
                <div class="frow"><span class="lab">Taille</span><div class="chips">
                    @foreach(['' => 'Toutes', '140' => '140 × 190', '160' => '160 × 190', '180' => '180 × 190'] as $value => $label)
                    <label class="chip"><input type="radio" name="size" value="{{ $value }}" @checked($loop->first)>{{ $label }}</label>
                    @endforeach
                </div></div>
                <div class="frow"><span class="lab">Confort</span><div class="chips">
                    @foreach(['' => 'Tous', 'soft' => 'Souple', 'equilibre' => 'Équilibré', 'ferme' => 'Ferme'] as $value => $label)
                    <label class="chip"><input type="radio" name="comfort[]" value="{{ $value }}" @checked($loop->first)>{{ $label }}</label>
                    @endforeach
                </div></div>
                <div class="go-row"><button class="btn pink" type="submit">Voir les matelas →</button><span class="alt">Un doute ? <a href="{{ $wa }}" target="_blank" rel="noopener">Demandez conseil</a></span></div>
            </form>
        </div>
        <div class="shot" data-hero-slider role="region" aria-roledescription="carrousel" aria-label="Notre sélection literie">
            @forelse($slides as $slide)
            <img data-hero-slide id="hero-slide-{{ $loop->iteration }}" class="{{ $loop->first ? 'on' : '' }}" src="{{ image_url($slide->image) }}" alt="{{ $slide->image_alt ?: $slide->title }}" aria-hidden="{{ $loop->first ? 'false' : 'true' }}" width="800" height="940" loading="{{ $loop->first ? 'eager' : 'lazy' }}" @if($loop->first) fetchpriority="high" @endif decoding="async" draggable="false">
            @empty
            <img data-hero-slide class="on" src="{{ asset('assets/maquette/img/blog/famille-parentale.webp') }}" alt="Chambre et literie Mobilier Addict" width="800" height="940" fetchpriority="high" draggable="false">
            @endforelse
            @if($slides->count() > 1)
            <button class="hero-slider-arrow hero-slider-prev" type="button" data-slider-prev aria-label="Visuel précédent"><span aria-hidden="true">‹</span></button>
            <button class="hero-slider-arrow hero-slider-next" type="button" data-slider-next aria-label="Visuel suivant"><span aria-hidden="true">›</span></button>
            <div class="hero-slider-controls">
                <div class="dots">@foreach($slides as $slide)<button type="button" aria-label="Afficher le visuel {{ $loop->iteration }}" aria-controls="hero-slide-{{ $loop->iteration }}" aria-pressed="{{ $loop->first ? 'true' : 'false' }}"><i></i></button>@endforeach</div>
                <button class="hero-slider-toggle" type="button" data-slider-toggle aria-label="Mettre le diaporama en pause">Pause</button>
            </div>
            @endif
        </div>
    </div></section>
    <section class="proof" aria-label="Nos engagements"><div class="wrap"><ul>
        <li><div><b>Livraison à Abidjan</b><span>Créneau confirmé avec vous</span></div></li>
        <li><div><b>Payé à la livraison</b><span>Selon les modalités de commande</span></div></li>
        <li><div><b>Garantie fabricant</b><span>Conditions selon le modèle</span></div></li>
        <li><div><b>Conseil personnalisé</b><span>Une équipe sur WhatsApp</span></div></li>
    </ul></div></section>
    <section class="sec"><div class="wrap">
        <div class="sec-head"><div><div class="kicker">La sélection</div><h2>Nos matelas, <em>choisis pour vous.</em></h2></div><a class="tlink" href="{{ route('menu.show', 'matelas') }}">Voir tous les matelas →</a></div>
        <div class="grid">
            @foreach($selection as $product)
            @include('maquette.includes.card-2027')
            @endforeach
        </div>
    </div></section>
    <section class="sec band"><div class="wrap">
        <div class="sec-head"><div><div class="kicker">Les univers</div><h2>Tout pour la maison.</h2></div></div>
        <ul class="rows">@foreach($catalogueCards as $card)<li><a href="{{ $card['url'] }}"><span class="n">{{ sprintf('%02d', $loop->iteration) }}</span><span class="name">{{ $card['title'] }}</span><span class="qty">{{ $card['count'] }} produit{{ $card['count'] > 1 ? 's' : '' }}</span><span class="arr">→</span></a></li>@endforeach</ul>
    </div></section>
    <section class="sec"><div class="wrap">
        <div class="sec-head"><div><div class="kicker">Simple</div><h2>Choisi aujourd'hui, <em>livré chez vous.</em></h2></div></div>
        <div class="steps"><div class="step"><div class="num">1</div><h3>Vous choisissez</h3><p>En ligne ou avec un conseiller sur WhatsApp, selon votre dos et votre budget.</p></div><div class="step"><div class="num">2</div><h3>Nous livrons</h3><p>Le créneau et les frais sont confirmés selon votre adresse.</p></div><div class="step"><div class="num">3</div><h3>Vous payez à réception</h3><p>Vous réglez votre commande à la livraison.</p></div></div>
    </div></section>
    <section class="spaced"><div class="wrap"><div class="dark-box"><div class="txt"><div class="kicker">Professionnels & projets</div><h2>La literie <em>sur-mesure.</em></h2><p class="lead">Un hôtel, des meublés ou toute une maison à équiper : nous dimensionnons la literie à votre projet.</p><ul class="segs">@foreach(['hotellerie' => 'Hôtellerie', 'appartement-meuble' => 'Appartements meublés', 'studio' => 'Studio', 'famille' => 'Famille'] as $slug => $name)<li><a href="{{ url($slug) }}">✓ {{ $name }}</a></li>@endforeach</ul><a class="btn white" href="{{ route('devis.create') }}">Demander un devis →</a></div><img class="img" src="{{ asset('assets/maquette/img/blog/hotellerie-signature.webp') }}" alt="Chambre équipée pour un projet hôtelier" width="800" height="900" loading="lazy" decoding="async"></div></div></section>
    <section class="spaced"><div class="wrap"><div class="strip"><div><p class="t">Créez votre badge, partagez votre univers.</p><p class="s">Le grand jeu #MobilierAddict.</p></div><a class="btn white" href="{{ url('/jeu') }}">Je participe →</a></div></div></section>
    <section class="sec band"><div class="wrap"><div class="sec-head"><div><div class="kicker">Le journal</div><h2>Mieux choisir, mieux dormir.</h2></div><a class="tlink" href="{{ route('blog.index') }}">Tous les articles →</a></div><div class="posts">@foreach($posts as $post)<a class="post" href="{{ route('blog.show', $post->slug) }}"><time datetime="{{ $post->published_at?->toDateString() }}">{{ $post->published_at?->format('d/m/Y') }} · {{ $post->reading_time ?: 3 }} min</time><h3>{{ $post->title }}</h3><span class="read">Lire →</span></a>@endforeach</div></div></section>
    <section class="sec final"><div class="wrap"><div class="kicker">Conseil gratuit</div><h2>Une question avant <em>de choisir ?</em></h2><p class="lead">Un conseiller vous accompagne sur WhatsApp.</p><div class="cta"><a class="btn pink" href="{{ $wa }}" target="_blank" rel="noopener">Écrire sur WhatsApp</a><a class="btn line" href="tel:+{{ whatsapp_number() }}">Nous appeler</a></div></div></section>
</div>
@endsection
@push('scripts')
<script>
(() => {
    const carousel = document.querySelector('[data-hero-slider]');
    if (!carousel) return;
    const photos = [...carousel.querySelectorAll('[data-hero-slide]')];
    const words = [...carousel.closest('.hero').querySelectorAll('.rot span')];
    const dots = [...carousel.querySelectorAll('.dots button')];
    const toggle = carousel.querySelector('[data-slider-toggle]');
    const motion = matchMedia('(prefers-reduced-motion: reduce)');
    let index = 0, timer, paused = motion.matches, hovered = false, focused = false, touchX = null;
    carousel.dataset.animated = String(photos.length > 1);
    const schedule = () => {
        clearTimeout(timer);
        const stopped = paused || hovered || focused || document.hidden || photos.length < 2;
        carousel.dataset.paused = String(stopped);
        if (toggle) {
            toggle.textContent = paused ? 'Lecture' : 'Pause';
            toggle.setAttribute('aria-label', paused ? 'Reprendre le diaporama' : 'Mettre le diaporama en pause');
        }
        if (!stopped) timer = setTimeout(() => show(index + 1), 6000);
    };
    const show = (next) => {
        index = (next + photos.length) % photos.length;
        photos.forEach((el, i) => {
            el.classList.toggle('on', i === index);
            el.setAttribute('aria-hidden', String(i !== index));
        });
        words.forEach((el, i) => {
            el.classList.toggle('on', i === index % words.length);
            el.setAttribute('aria-hidden', String(i !== index % words.length));
        });
        dots.forEach((el, i) => el.setAttribute('aria-pressed', String(i === index)));
        schedule();
    };
    dots.forEach((el, i) => el.addEventListener('click', () => show(i)));
    carousel.querySelector('[data-slider-prev]')?.addEventListener('click', () => show(index - 1));
    carousel.querySelector('[data-slider-next]')?.addEventListener('click', () => show(index + 1));
    toggle?.addEventListener('click', () => { paused = !paused; focused = false; hovered = false; schedule(); });
    carousel.addEventListener('keydown', (event) => {
        if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') return;
        event.preventDefault();
        show(index + (event.key === 'ArrowRight' ? 1 : -1));
    });
    carousel.addEventListener('pointerenter', (event) => {
        if (event.pointerType === 'mouse') { hovered = true; schedule(); }
    });
    carousel.addEventListener('pointerleave', () => { hovered = false; schedule(); });
    carousel.addEventListener('focusin', () => { focused = true; schedule(); });
    carousel.addEventListener('focusout', (event) => {
        if (!carousel.contains(event.relatedTarget)) { focused = false; schedule(); }
    });
    carousel.addEventListener('pointerdown', (event) => { if (event.pointerType === 'touch') touchX = event.clientX; });
    carousel.addEventListener('pointerup', (event) => {
        if (touchX !== null && Math.abs(event.clientX - touchX) > 40) show(index + (event.clientX < touchX ? 1 : -1));
        touchX = null;
    });
    carousel.addEventListener('pointercancel', () => { touchX = null; });
    document.addEventListener('visibilitychange', schedule);
    motion.addEventListener('change', () => { paused = motion.matches; schedule(); });
    schedule();
})();
</script>
@endpush
