<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@hasSection('title')@yield('title')@else Mobilier Addict @endif</title>
        <meta name="description" content="@yield('meta_description', 'Mobilier Addict : literie, mobilier et équipements pour la maison.')">
        <meta name="robots" content="index,follow">

        @php
            $seoTitle = trim($__env->yieldContent('title')) !== '' ? trim($__env->yieldContent('title')) : 'Mobilier Addict';
            $seoDescription = trim($__env->yieldContent('meta_description')) !== '' ? trim($__env->yieldContent('meta_description')) : 'Mobilier Addict : literie, mobilier et équipements pour la maison.';
            $seoUrl = trim($__env->yieldContent('canonical')) !== '' ? trim($__env->yieldContent('canonical')) : url()->current();
            $seoImage = trim($__env->yieldContent('meta_image')) !== '' ? trim($__env->yieldContent('meta_image')) : asset('assets/logo/desktop/logo.png');
        @endphp
        <link rel="canonical" href="{{ $seoUrl }}">

        <meta property="og:site_name" content="Mobilier Addict">
        <meta property="og:title" content="{{ $seoTitle }}">
        <meta property="og:description" content="{{ $seoDescription }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ $seoUrl }}">
        <meta property="og:image" content="{{ $seoImage }}">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $seoTitle }}">
        <meta name="twitter:description" content="{{ $seoDescription }}">
        <meta name="twitter:image" content="{{ $seoImage }}">

        <link rel="icon" href="{{ asset('assets/logo/favicon.png') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" referrerpolicy="no-referrer" />

        @stack('styles')
    </head>
    <body>
        @include('partials.header')

        <main>
            @yield('content')
        </main>

        @include('partials.footer')

        <script src="{{ asset('js/slider.js') }}" defer></script>
        <script src="{{ asset('js/animations.js') }}" defer></script>
        @stack('scripts')
    </body>
</html>
