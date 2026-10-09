<!doctype html>
<html lang="fr" class="no-js">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script>document.documentElement.classList.remove('no-js');</script>

        @php
            $routeName = \Illuminate\Support\Facades\Route::currentRouteName();
            $routeTitle = $routeName
                ? ucwords(str_replace(['.', '-', '_'], ' ', $routeName))
                : 'Mobilier Addict';
            $defaultTitle = 'Mobilier Addict — Mobilier, literie et électroménager à Abidjan';
            $defaultDesc = 'Mobilier Addict : mobilier, literie et électroménager pour la maison en Côte d\'Ivoire. Livraison à Abidjan et intérieur du pays, devis personnalisé et accompagnement dédié.';
            $pageTitle = trim($__env->yieldContent('title')) !== '' ? trim($__env->yieldContent('title')) : $routeTitle;
            $seoDescription = trim($__env->yieldContent('meta_description')) !== '' ? trim($__env->yieldContent('meta_description')) : $defaultDesc;
            $seoUrl = trim($__env->yieldContent('canonical')) !== '' ? trim($__env->yieldContent('canonical')) : url()->current();
            $seoImage = trim($__env->yieldContent('meta_image')) !== '' ? trim($__env->yieldContent('meta_image')) : asset('assets/logo/desktop/logo.png');
        @endphp

        <title>{{ $pageTitle }}</title>
        <meta name="description" content="{{ $seoDescription }}">
        <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
        <meta name="author" content="Mobilier Addict">
        <meta name="geo.region" content="CI-AB">
        <meta name="geo.placename" content="Abidjan, Côte d'Ivoire">
        <meta name="geo.position" content="5.3599517;-4.0082561">
        <meta name="ICBM" content="5.3599517, -4.0082561">
        <link rel="canonical" href="{{ $seoUrl }}">

        <meta property="og:site_name" content="Mobilier Addict">
        <meta property="og:title" content="{{ $pageTitle }}">
        <meta property="og:description" content="{{ $seoDescription }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ $seoUrl }}">
        <meta property="og:image" content="{{ $seoImage }}">
        <meta property="og:locale" content="fr_CI">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $pageTitle }}">
        <meta name="twitter:description" content="{{ $seoDescription }}">
        <meta name="twitter:image" content="{{ $seoImage }}">

        <!-- Données structurées JSON-LD : Site + Organisation + LocalBusiness -->
        <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebSite',
                    '@id' => route('home') . '#website',
                    'url' => route('home'),
                    'name' => 'Mobilier Addict',
                    'description' => $defaultDesc,
                    'inLanguage' => 'fr-CI',
                    'publisher' => ['@id' => route('home') . '#organization'],
                ],
                [
                    '@type' => 'Organization',
                    '@id' => route('home') . '#organization',
                    'name' => 'Mobilier Addict',
                    'alternateName' => 'Mobilier Addict Côte d\'Ivoire',
                    'url' => route('home'),
                    'logo' => asset('assets/logo/desktop/logo.png'),
                    'image' => asset('assets/logo/desktop/logo.png'),
                    'description' => $defaultDesc,
                    'contactPoint' => [
                        [
                            '@type' => 'ContactPoint',
                            'telephone' => '+225-07-99-14-03-56',
                            'contactType' => 'customer service',
                            'areaServed' => 'CI',
                            'availableLanguage' => ['French'],
                        ],
                    ],
                ],
                [
                    '@type' => 'LocalBusiness',
                    '@id' => route('home') . '#localbusiness',
                    'name' => 'Mobilier Addict',
                    'image' => asset('assets/logo/desktop/logo.png'),
                    'url' => route('home'),
                    'telephone' => '+225-07-99-14-03-56',
                    'priceRange' => '$$',
                    'areaServed' => 'Abidjan, Côte d\'Ivoire',
                    'geo' => [
                        '@type' => 'GeoCoordinates',
                        'latitude' => '5.3599517',
                        'longitude' => '-4.0082561',
                    ],
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressCountry' => 'CI',
                        'addressLocality' => 'Abidjan',
                        'addressRegion' => 'Abidjan',
                    ],
                ],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>

        <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
        <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
        <link rel="dns-prefetch" href="//images.unsplash.com">
        <link rel="preconnect" href="https://images.unsplash.com" crossorigin>
        <link rel="dns-prefetch" href="//connect.facebook.net">
        <link rel="preconnect" href="https://connect.facebook.net" crossorigin>
        <link rel="dns-prefetch" href="//www.facebook.com">
        <link rel="preconnect" href="https://www.facebook.com" crossorigin>

        <link rel="icon" href="{{ asset('assets/logo/favicon.png') }}">
        @php
            $cssPath = public_path('css/style.css');
            $cssVersion = is_file($cssPath) ? substr(md5_file($cssPath), 0, 12) : time();
            $sectionsCssPath = public_path('assets/css/sections.css');
            $sectionsCssVersion = is_file($sectionsCssPath) ? substr(md5_file($sectionsCssPath), 0, 12) : time();
        @endphp
        <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ $cssVersion }}">
        <link rel="stylesheet" href="{{ asset('assets/css/sections.css') }}?v={{ $sectionsCssVersion }}">
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

        @php
            $sliderPath = public_path('js/slider.js');
            $animationsPath = public_path('js/animations.js');
            $sliderVersion = is_file($sliderPath) ? substr(md5_file($sliderPath), 0, 12) : time();
            $animationsVersion = is_file($animationsPath) ? substr(md5_file($animationsPath), 0, 12) : time();
        @endphp
        <script src="{{ asset('js/slider.js') }}?v={{ $sliderVersion }}" defer></script>
        <script src="{{ asset('js/animations.js') }}?v={{ $animationsVersion }}" defer></script>
        @stack('scripts')
    </body>
</html>
