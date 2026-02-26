<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @php
            $routeName = \Illuminate\Support\Facades\Route::currentRouteName();
            $routeTitle = $routeName
                ? ucwords(str_replace(['.', '-', '_'], ' ', $routeName))
                : 'Mobilier Addict';
            $pageTitle = trim($__env->yieldContent('title')) !== '' ? trim($__env->yieldContent('title')) : $routeTitle;
        @endphp

        <title>{{ $pageTitle }}</title>
        <meta name="description" content="@yield('meta_description', 'Mobilier Addict : literie, mobilier et équipements pour la maison.')">
        <meta name="robots" content="index,follow">

        @php
            $seoTitle = $pageTitle;
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

        <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
        <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
        <link rel="dns-prefetch" href="//images.unsplash.com">
        <link rel="preconnect" href="https://images.unsplash.com" crossorigin>
        <link rel="dns-prefetch" href="//connect.facebook.net">
        <link rel="preconnect" href="https://connect.facebook.net" crossorigin>
        <link rel="dns-prefetch" href="//www.facebook.com">
        <link rel="preconnect" href="https://www.facebook.com" crossorigin>

        <link rel="icon" href="{{ asset('assets/logo/favicon.png') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" referrerpolicy="no-referrer" />

        @stack('styles')

        @php
            $fbPixelId = \App\Models\SiteSetting::getValue('facebook_pixel_id');
            $fbPixelEnabled = \App\Models\SiteSetting::getValue('facebook_pixel_enabled', '0');
            $fbPixelActive = in_array((string) $fbPixelEnabled, ['1', 'true', 'on', 'yes'], true) && !empty($fbPixelId);
        @endphp
        @if($fbPixelActive)
            <script>
                !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
                n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', '{{ $fbPixelId }}');
                fbq('track', 'PageView');
            </script>
            <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ $fbPixelId }}&ev=PageView&noscript=1"/></noscript>
        @endif
    </head>
    <body>
        @include('partials.header')

        <main>
            @yield('content')
        </main>

        <button class="scroll-top" id="scrollTop" type="button" aria-label="Remonter en haut">
            <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path d="M12 19V5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M6 11l6-6 6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var btn = document.getElementById('scrollTop');
            if (!btn) return;

            var isMobile = function () {
                return window.matchMedia && window.matchMedia('(max-width: 768px)').matches;
            };

            var onScroll = function () {
                if (!isMobile()) {
                    btn.classList.remove('visible');
                    return;
                }
                if (window.scrollY > 400) btn.classList.add('visible');
                else btn.classList.remove('visible');
            };

            onScroll();
            window.addEventListener('scroll', onScroll, { passive: true });
            window.addEventListener('resize', onScroll);
            btn.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
        </script>

        @include('partials.footer')

        <script src="{{ asset('js/slider.js') }}" defer></script>
        <script src="{{ asset('js/animations.js') }}" defer></script>
        @stack('scripts')
    </body>
</html>
