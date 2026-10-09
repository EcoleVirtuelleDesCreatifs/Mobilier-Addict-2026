<!DOCTYPE html>
<html lang="fr" class="no-js">
  <head>
@php
    $defaultTitle = 'Mobilier Addict — Mobilier, literie et électroménager à Abidjan';
    $defaultDesc = 'Mobilier Addict : mobilier, literie et électroménager pour la maison en Côte d\'Ivoire. Livraison à Abidjan et intérieur du pays, devis personnalisé et accompagnement dédié.';
    $seoTitle = trim($__env->yieldContent('title')) !== '' ? trim($__env->yieldContent('title')) : $defaultTitle;
    $seoDesc = trim($__env->yieldContent('meta_description')) !== '' ? trim($__env->yieldContent('meta_description')) : $defaultDesc;
    $seoCanonical = trim($__env->yieldContent('canonical')) !== '' ? trim($__env->yieldContent('canonical')) : url()->current();
    $seoImage = trim($__env->yieldContent('meta_image')) !== '' ? trim($__env->yieldContent('meta_image')) : asset('assets/logo/desktop/logo.png');
    $seoType = trim($__env->yieldContent('og_type')) !== '' ? trim($__env->yieldContent('og_type')) : 'website';
@endphp

    <title>{{ $seoTitle }}</title>
    <!-- meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="{{ $seoDesc }}" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="author" content="Mobilier Addict" />
    <meta name="geo.region" content="CI-AB" />
    <meta name="geo.placename" content="Abidjan, Côte d'Ivoire" />
    <meta name="geo.position" content="5.3599517;-4.0082561" />
    <meta name="ICBM" content="5.3599517, -4.0082561" />
    <link rel="canonical" href="{{ $seoCanonical }}" />
    <meta property="og:type" content="{{ $seoType }}" />
    <meta property="og:site_name" content="Mobilier Addict" />
    <meta property="og:title" content="{{ $seoTitle }}" />
    <meta property="og:description" content="{{ $seoDesc }}" />
    <meta property="og:url" content="{{ $seoCanonical }}" />
    <meta property="og:image" content="{{ $seoImage }}" />
    <meta property="og:locale" content="fr_CI" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $seoTitle }}" />
    <meta name="twitter:description" content="{{ $seoDesc }}" />
    <meta name="twitter:image" content="{{ $seoImage }}" />
    @stack('meta')

    <!-- Données structurées JSON-LD : Site + Organisation -->
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
                'potentialAction' => [
                    [
                        '@type' => 'SearchAction',
                        'target' => [
                            '@type' => 'EntryPoint',
                            'urlTemplate' => route('search.index') . '?q={search_term_string}',
                        ],
                        'query-input' => 'required name=search_term_string',
                    ],
                ],
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
                'sameAs' => [
                    'https://www.facebook.com/mobilier225',
                    'https://www.instagram.com/mobiliermaison/',
                    'https://www.linkedin.com/showcase/76503826',
                ],
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
    <link
      rel="shortcut icon"
      href="{{ asset('assets/logo/favicon.png') }}"
      type="image/x-icon"
    />
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <!-- all css -->
    <style>
      :root {
        --primary-color: #00234d;
        --secondary-color: #d8327f;

        --btn-primary-border-radius: 0.25rem;
        --btn-primary-color: #fff;
        --btn-primary-background-color: #00234d;
        --btn-primary-border-color: #00234d;
        --btn-primary-hover-color: #fff;
        --btn-primary-background-hover-color: #00234d;
        --btn-primary-border-hover-color: #00234d;
        --btn-primary-font-weight: 500;

        --btn-secondary-border-radius: 0.25rem;
        --btn-secondary-color: #00234d;
        --btn-secondary-background-color: transparent;
        --btn-secondary-border-color: #00234d;
        --btn-secondary-hover-color: #fff;
        --btn-secondary-background-hover-color: #00234d;
        --btn-secondary-border-hover-color: #00234d;
        --btn-secondary-font-weight: 500;

        --heading-color: #000;
        --heading-font-family: "Poppins", sans-serif;
        --heading-font-weight: 700;

        --title-color: #000;
        --title-font-family: "Poppins", sans-serif;
        --title-font-weight: 400;

        --body-color: #000;
        --body-background-color: #fff;
        --body-font-family: "Poppins", sans-serif;
        --body-font-size: 14px;
        --body-font-weight: 400;

        --section-heading-color: #000;
        --section-heading-font-family: "Poppins", sans-serif;
        --section-heading-font-size: 48px;
        --section-heading-font-weight: 600;

        --section-subheading-color: #000;
        --section-subheading-font-family: "Poppins", sans-serif;
        --section-subheading-font-size: 16px;
        --section-subheading-font-weight: 400;
      }
    </style>

    <link rel="stylesheet" href="{{ asset('assets/maquette/') }}/css/vendor.css" />
    <link rel="stylesheet" href="{{ asset('assets/maquette/') }}/css/style.min.css" />
    @stack('styles')
  </head>

  <body>
    <a class="editorial-skip" href="#MainContent">Aller au contenu</a>
    <div class="body-wrapper">@include('maquette.includes.announcement')
@include('maquette.includes.header')
      <main id="MainContent" class="content-for-layout">
@yield('content')
      </main>
      <!-- footer start -->
      <footer class="mt-100 overflow-hidden footer-ma">
        <div class="footer-top">
          <div class="container">
            <div class="footer-widget-wrapper">
              <div class="row justify-content-between">
                <div class="col-xl-2 col-lg-2 col-md-6 col-12 footer-widget">
                  <div class="footer-widget-inner">
                    <h4
                      class="footer-heading d-flex align-items-center justify-content-between"
                    >
                      <span>À propos</span>
                      <span class="d-md-none">
                        <svg
                          class="icon icon-dropdown"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="#00234D"
                          stroke-width="1"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                      </span>
                    </h4>
                    <ul class="footer-menu list-unstyled mb-0 d-md-block">
                      @include('maquette.includes.footer-links', ['footerGroup' => 'about'])
                    </ul>
                  </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-6 col-12 footer-widget">
                  <div class="footer-widget-inner">
                    <h4
                      class="footer-heading d-flex align-items-center justify-content-between"
                    >
                      <span>Achats</span>
                      <span class="d-md-none">
                        <svg
                          class="icon icon-dropdown"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="#00234D"
                          stroke-width="1"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                      </span>
                    </h4>
                    <ul class="footer-menu list-unstyled mb-0 d-md-block">
                      @include('maquette.includes.footer-links', ['footerGroup' => 'shopping'])
                    </ul>
                  </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-6 col-12 footer-widget">
                  <div class="footer-widget-inner">
                    <h4
                      class="footer-heading d-flex align-items-center justify-content-between"
                    >
                      <span>Aide</span>
                      <span class="d-md-none">
                        <svg
                          class="icon icon-dropdown"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="#00234D"
                          stroke-width="1"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                      </span>
                    </h4>
                    <ul class="footer-menu list-unstyled mb-0 d-md-block">
                      @include('maquette.includes.footer-links', ['footerGroup' => 'help'])
                    </ul>
                  </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6 col-12 footer-widget">
                  <div class="footer-widget-inner">
                    <h4 class="footer-logo">
                      <a href="{{ route('home') }}"
                        ><img
                          src="{{ asset('assets/logo/mobile/logo.png') }}"
                          alt="Mobilier Addict"
                          class="footer-logo-img"
                        /></a>
                    </h4>
                    <div class="footer-newsletter">
                      <p class="footer-text mb-3">
                        Restez informé de toutes les nouveautés.
                      </p>
                      <div class="newsletter-wrapper">
                        <form
                          action="index.php#"
                          class="footer-newsletter-form d-flex align-items-center"
                        >
                          <input
                            class="footer-newsletter-input bg-transparent"
                            type="email"
                            placeholder="Votre e-mail"
                            autocomplete="off"
                          />
                          <button class="footer-newsletter-btn" type="submit">
                            S'INSCRIRE
                          </button>
                        </form>
                      </div>
                      <div class="footer-social-wrapper">
                        <ul
                          class="footer-social list-unstyled d-flex align-items-center flex-wrap mb-0"
                        >
                          <li class="footer-social-item">
                            <a href="https://www.facebook.com/mobilier225" target="_blank" rel="noopener" aria-label="Facebook">
                              <svg
                                class="icon icon-facebook"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M16.3021 4.58314H14.0258C13.1546 4.58314 12.4098 4.89227 11.7916 5.51054C11.2014 6.12881 10.9063 6.87354 10.9063 7.74473V9.97892H9.09368V12.6768H10.9063V18.9578H13.6042V12.6768H16.3021V9.97892H13.6042V8.16628C13.6042 7.94145 13.6885 7.74473 13.8571 7.57611C14.0258 7.37939 14.2365 7.28103 14.4895 7.28103H16.3021V4.58314ZM1 2C1 1.44772 1.44772 1 2 1H18C18.5523 1 19 1.44772 19 2V17.9578C19 18.5101 18.5523 18.9578 18 18.9578H2C1.44772 18.9578 1 18.5101 1 17.9578V2Z"
                                  fill="#00234D"
                                />
                              </svg>
                            </a>
                          </li>
                          <li class="footer-social-item">
                            <a href="https://www.instagram.com/mobiliermaison/" target="_blank" rel="noopener" aria-label="Instagram">
                              <svg
                                class="icon icon-instagram"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M9.99998 2.62165C12.4031 2.62165 12.6877 2.6308 13.6367 2.6741C14.5142 2.71415 14.9908 2.86077 15.3079 2.98398C15.728 3.14725 16.0278 3.34231 16.3428 3.65723C16.6577 3.97215 16.8528 4.272 17.016 4.69206C17.1392 5.00923 17.2859 5.48577 17.3259 6.36323C17.3692 7.31228 17.3783 7.5969 17.3783 10C17.3783 12.4031 17.3692 12.6878 17.3259 13.6368C17.2859 14.5143 17.1392 14.9908 17.016 15.308C16.8528 15.728 16.6577 16.0279 16.3428 16.3428C16.0278 16.6577 15.728 16.8528 15.3079 17.016C14.9908 17.1393 14.5142 17.2859 13.6367 17.3259C12.6879 17.3692 12.4032 17.3784 9.99998 17.3784C7.59672 17.3784 7.3121 17.3692 6.36323 17.3259C5.48574 17.2859 5.00919 17.1393 4.69206 17.016C4.27196 16.8528 3.97212 16.6577 3.6572 16.3428C3.34227 16.0279 3.14721 15.728 2.98398 15.308C2.86073 14.9908 2.71411 14.5143 2.67406 13.6368C2.63076 12.6878 2.62162 12.4031 2.62162 10C2.62162 7.5969 2.63076 7.31228 2.67406 6.36326C2.71411 5.48577 2.86073 5.00923 2.98398 4.69206C3.14721 4.272 3.34227 3.97215 3.6572 3.65723C3.97212 3.34231 4.27196 3.14725 4.69206 2.98398C5.00919 2.86077 5.48574 2.71415 6.36319 2.6741C7.31224 2.6308 7.59687 2.62165 9.99998 2.62165ZM9.99998 1C7.55571 1 7.24926 1.01036 6.28931 1.05416C5.33133 1.09789 4.67712 1.25001 4.10462 1.47251C3.51279 1.70251 3.01088 2.01025 2.51055 2.51058C2.01021 3.01092 1.70247 3.51283 1.47247 4.10466C1.24997 4.67716 1.09785 5.33137 1.05412 6.28935C1.01032 7.24926 1 7.55575 1 10C1 12.4443 1.01032 12.7508 1.05412 13.7107C1.09785 14.6687 1.24997 15.3229 1.47247 15.8954C1.70247 16.4872 2.01021 16.9891 2.51055 17.4895C3.01088 17.9898 3.51279 18.2975 4.10462 18.5275C4.67712 18.75 5.33133 18.9021 6.28931 18.9459C7.24926 18.9897 7.55571 19 9.99998 19C12.4443 19 12.7507 18.9897 13.7107 18.9459C14.6686 18.9021 15.3228 18.75 15.8953 18.5275C16.4872 18.2975 16.9891 17.9898 17.4894 17.4895C17.9898 16.9891 18.2975 16.4872 18.5275 15.8954C18.75 15.3229 18.9021 14.6687 18.9458 13.7107C18.9896 12.7508 19 12.4443 19 10C19 7.55575 18.9896 7.24926 18.9458 6.28935C18.9021 5.33137 18.75 4.67716 18.5275 4.10466C18.2975 3.51283 17.9898 3.01092 17.4894 2.51058C16.9891 2.01025 16.4872 1.70251 15.8953 1.47251C15.3228 1.25001 14.6686 1.09789 13.7107 1.05416C12.7507 1.01036 12.4443 1 9.99998 1ZM9.99998 5.37838C7.44753 5.37838 5.37835 7.44757 5.37835 10C5.37835 12.5525 7.44753 14.6217 9.99998 14.6217C12.5524 14.6217 14.6216 12.5525 14.6216 10C14.6216 7.44757 12.5524 5.37838 9.99998 5.37838ZM9.99998 13C8.34314 13 6.99996 11.6569 6.99996 10C6.99996 8.34317 8.34314 7 9.99998 7C11.6568 7 13 8.34317 13 10C13 11.6569 11.6568 13 9.99998 13ZM15.8842 5.19579C15.8842 5.79226 15.4007 6.27581 14.8042 6.27581C14.2077 6.27581 13.7242 5.79226 13.7242 5.19579C13.7242 4.59931 14.2077 4.1158 14.8042 4.1158C15.4007 4.1158 15.8842 4.59931 15.8842 5.19579Z"
                                  fill="#00234D"
                                />
                              </svg>
                            </a>
                          </li>
                          <li class="footer-social-item">
                            <a href="https://www.linkedin.com/showcase/76503826" target="_blank" rel="noopener" aria-label="LinkedIn">
                              <svg
                                class="icon icon-linkedin"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M15.625 15.625h-2.521v-3.906c0-.932-.02-2.131-1.3-2.131-1.302 0-1.5 1.016-1.5 2.063v3.974H7.781V7.5h2.423v1.107h.033c.338-.64 1.164-1.314 2.396-1.314 2.563 0 3.036 1.687 3.036 3.881v4.451zM5.813 6.394a1.458 1.458 0 1 1 0-2.917 1.458 1.458 0 0 1 0 2.917zM6.875 15.625H4.688V7.5h2.187v8.125zM16.875 1H3.125C2.503 1 2 1.503 2 2.125v15.75C2 18.497 2.503 19 3.125 19h13.75c.622 0 1.125-.503 1.125-1.125V2.125C18 1.503 17.497 1 16.875 1z"
                                  fill="#00234D"
                                />
                              </svg>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-bottom">
          <div class="container">
            <div
              class="footer-bottom-inner d-flex flex-wrap justify-content-md-between justify-content-center align-items-center"
            >
              <ul
                class="footer-bottom-menu list-unstyled d-flex flex-wrap align-items-center mb-0"
              >
                @include('maquette.includes.footer-links', ['footerGroup' => 'legal'])
              </ul>
              <p class="copyright footer-text">
                ©<span class="current-year"></span> Mobilier Addict.
              </p>
            </div>
          </div>
        </div>
      </footer>
      <!-- footer end -->

      <!-- scrollup start -->
      <button id="scrollup">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="#fff"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
      </button>
      <!-- scrollup end -->

      <!-- drawer menu start -->
      <div
        class="offcanvas offcanvas-start d-flex d-lg-none"
        tabindex="-1"
        id="drawer-menu"
      >
        <div class="offcanvas-wrapper">
          <div class="offcanvas-header border-btm-black">
            <h5 class="drawer-heading">Menu</h5>
            <button
              type="button"
              class="btn-close text-reset"
              data-bs-dismiss="offcanvas"
              aria-label="Fermer"
            ></button>
          </div>
          <div
            class="offcanvas-body p-0 d-flex flex-column justify-content-between"
          >
            <nav class="site-navigation">
              @include('maquette.includes.menu', ['menu_mobile' => true])
            </nav>
            <ul class="utility-menu list-unstyled">
              <li class="utilty-menu-item">
                <a class="announcement-text" href="tel:+2250799140356">
                  <span class="utilty-icon-wrapper">
                    <svg
                      class="icon icon-phone"
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="#000"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path
                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
                      ></path>
                    </svg>
                  </span>
                  Appelez : +225 07 99 14 03 56
                </a>
              </li>
              <li class="utilty-menu-item">
                <a
                  class="header-action-item header-wishlist"
                  href="{{ route('collection.index') }}"
                >
                  <span class="utilty-icon-wrapper">
                    <svg
                      class="icon icon-wishlist"
                      width="26"
                      height="22"
                      viewBox="0 0 26 22"
                      fill="#000"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                        fill="#000"
                      />
                    </svg>
                  </span>
                  <span>Mes favoris</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- drawer menu end -->

      <!-- drawer cart start -->
      @php
        $drawerCart = session('cart', []);
        $drawerItems = collect();
        if (is_array($drawerCart) && count($drawerCart)) {
            $drawerRows = collect($drawerCart)->filter(fn ($r) => is_array($r) && isset($r['product_id']));
            $drawerProducts = \App\Models\Product::query()->whereIn('id', $drawerRows->pluck('product_id'))->get()->keyBy('id');
            $drawerVariants = \App\Models\ProductVariant::query()->whereIn('id', $drawerRows->pluck('product_variant_id')->filter())->get()->keyBy('id');
            $drawerItems = $drawerRows->map(function ($row, $key) use ($drawerProducts, $drawerVariants) {
                $p = $drawerProducts->get((int) $row['product_id']);
                if (!$p) {
                    return null;
                }
                $v = isset($row['product_variant_id']) ? $drawerVariants->get((int) $row['product_variant_id']) : null;
                $options = null;
                if ($v) {
                    $options = !empty($v->variant_type)
                        ? $v->variant_type . ' • ' . $v->places . ' place(s)'
                        : $v->thickness_cm . ' cm • ' . $v->places . ' place(s)';
                }
                $color = isset($row['selected_color']) ? trim((string) $row['selected_color']) : '';
                if ($color !== '') {
                    $options = $options ? ($options . ' • ' . $color) : $color;
                }
                return (object) [
                    'key' => (string) $key,
                    'name' => $p->name,
                    'slug' => $p->slug,
                    'image' => $p->image,
                    'price' => (float) ($v?->price ?? $p->price),
                    'qty' => max(1, (int) ($row['quantity'] ?? 1)),
                    'options' => $options,
                ];
            })->filter()->values();
        }
        $drawerCount = (int) $drawerItems->sum('qty');
        $drawerSubtotal = $drawerItems->sum(fn ($i) => $i->price * $i->qty);
      @endphp
      <div class="offcanvas offcanvas-end" tabindex="-1" id="drawer-cart">
        <div class="offcanvas-header border-btm-black">
          <h5 class="cart-drawer-heading text_16">Votre panier ({{ str_pad($drawerCount, 2, '0', STR_PAD_LEFT) }})</h5>
          <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Fermer"
          ></button>
        </div>
        <div class="offcanvas-body p-0">
          <div
            class="cart-content-area d-flex justify-content-between flex-column{{ $drawerItems->isEmpty() ? ' d-none' : '' }}"
          >
            <div class="minicart-loop custom-scrollbar">
              @forelse($drawerItems as $item)
                <div class="minicart-item d-flex">
                  <div class="mini-img-wrapper">
                    <img loading="lazy" decoding="async" class="mini-img"
                      src="@image_url($item->image)"
                      alt="{{ $item->name }}"
                    />
                  </div>
                  <div class="product-info">
                    <h2 class="product-title">
                      <a href="{{ route('product.show', $item->slug) }}">{{ $item->name }}</a>
                    </h2>
                    @if($item->options)
                      <p class="product-vendor">{{ $item->options }}</p>
                    @endif
                    <div
                      class="misc d-flex align-items-end justify-content-between"
                    >
                      <span class="text_14">Qté : {{ $item->qty }}</span>
                      <div
                        class="product-remove-area d-flex flex-column align-items-end"
                      >
                        <div class="product-price">{{ number_format($item->price * $item->qty, 0, ',', ' ') }} FCFA</div>
                        <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                          @csrf
                          <input type="hidden" name="cart_key" value="{{ $item->key }}">
                          <button type="submit" class="product-remove border-0 bg-transparent p-0">Supprimer</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              @empty
                <div class="text-center py-4">
                  <p class="text_16 mb-0">Aucun article pour le moment.</p>
                </div>
              @endforelse
              </div>
            </div>
            <div class="minicart-footer">
              <div class="minicart-calc-area">
                <div
                  class="minicart-calc d-flex align-items-center justify-content-between"
                >
                  <span class="cart-subtotal mb-0">Sous-total</span>
                  <span class="cart-subprice">{{ number_format($drawerSubtotal, 0, ',', ' ') }} FCFA</span>
                </div>
                <p class="cart-taxes text-center my-4">
                  Les taxes et la livraison seront calculées lors du paiement.
                </p>
              </div>
              <div
                class="minicart-btn-area d-flex align-items-center justify-content-between"
              >
                <a href="{{ route('cart.index') }}" class="minicart-btn btn-secondary"
                  >Voir le panier</a
                >
                <a href="{{ route('cart.shipping') }}" class="minicart-btn btn-primary"
                  >Commander</a
                >
              </div>
            </div>
          </div>
          <div class="cart-empty-area text-center py-5{{ $drawerItems->isNotEmpty() ? ' d-none' : '' }}">
            <div class="cart-empty-icon pb-4">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="70"
                height="70"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                <line x1="15" y1="9" x2="15.01" y2="9"></line>
              </svg>
            </div>
            <p class="cart-empty">Votre panier est vide</p>
          </div>
        </div>
      </div>
      <!-- drawer cart end -->

      {{-- Quickview factice supprimé : non branché sur des produits réels --}}

      @include('maquette.includes.flash-toast')

      <!-- all js -->
      <script src="{{ asset('assets/maquette/') }}/js/vendor.js" defer></script>
      <script src="{{ asset('assets/maquette/') }}/js/main.min.js" defer></script>
      @stack('scripts')
    </div>
  </body>
</html>
