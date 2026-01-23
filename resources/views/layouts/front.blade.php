<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mobilier Addict') | Literie</title>
    <meta name="description" content="@yield('meta_description', 'Mobilier Addict : literie, mobilier et équipements pour la maison. Découvrez nos univers, nos meilleures ventes et nos inspirations déco.')" />
    <link rel="canonical" href="@yield('canonical', url()->current())" />
    <meta name="robots" content="@yield('meta_robots', 'index,follow')" />

    <meta property="og:site_name" content="{{ config('app.name', 'Mobilier Addict') }}" />
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:title" content="@yield('og_title', trim(View::yieldContent('title', 'Mobilier Addict')) . ' | Literie')" />
    <meta property="og:description" content="@yield('og_description', trim(View::yieldContent('meta_description', 'Mobilier Addict : literie, mobilier et équipements pour la maison. Découvrez nos univers, nos meilleures ventes et nos inspirations déco.')))" />
    <meta property="og:url" content="@yield('og_url', url()->current())" />
    <meta property="og:image" content="@yield('og_image', asset('assets/logo/mobile/logo.png'))" />

    <meta name="twitter:card" content="@yield('twitter_card', 'summary_large_image')" />
    <meta name="twitter:title" content="@yield('twitter_title', trim(View::yieldContent('title', 'Mobilier Addict')) . ' | Literie')" />
    <meta name="twitter:description" content="@yield('twitter_description', trim(View::yieldContent('meta_description', 'Mobilier Addict : literie, mobilier et équipements pour la maison. Découvrez nos univers, nos meilleures ventes et nos inspirations déco.')))" />
    <meta name="twitter:image" content="@yield('twitter_image', asset('assets/logo/mobile/logo.png'))" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('img/favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @stack('styles')
</head>

<body>
    <a class="skip-link" href="#contenu">Aller au contenu</a>

    @include('partials.header')

    <main id="contenu">
        @yield('content')
    </main>

    @include('partials.footer')

    <button class="scroll-top" id="scrollTop" aria-label="Retour en haut">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/slider.js') }}" defer></script>
    <script src="{{ asset('js/animations.js') }}" defer></script>
    @stack('scripts')
</body>

</html>
