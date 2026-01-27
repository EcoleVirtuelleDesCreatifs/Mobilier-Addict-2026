<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@hasSection('title')@yield('title') | Mobilier Addict@else Mobilier Addict @endif</title>
        <meta name="description" content="@yield('meta_description', 'Mobilier Addict : literie, mobilier et équipements pour la maison.')">

        @hasSection('canonical')
            <link rel="canonical" href="@yield('canonical')">
        @endif

        <link rel="icon" href="{{ asset('favicon.ico') }}">
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
