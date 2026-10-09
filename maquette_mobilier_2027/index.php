<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <title>Mobilier Addict — Vente de matelas</title>
    <!-- meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="meta description" />
    <link
      rel="shortcut icon"
      href="assets/img/favicon.png"
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

    <link rel="stylesheet" href="assets/css/vendor.css" />
    <link rel="stylesheet" href="assets/css/style.min.css" />
  </head>

  <body>
    <div class="body-wrapper">
      <?php include __DIR__ . '/includes/announcement.php'; ?>

      <?php include __DIR__ . '/includes/header.php'; ?>

      <main id="MainContent" class="content-for-layout">
        <!-- slideshow start -->
        <div class="slideshow-section position-relative">
          <div
            class="slideshow-active activate-slider"
            data-slick='{
                            "autoplay": true,
                            "autoplaySpeed": 2000,
                            "speed": 600,
                            "cssEase": "ease",
                            "pauseOnHover": true,
                            "pauseOnFocus": true,
                            "infinite": true,
                            "slidesToShow": 1,
                            "slidesToScroll": 1,
                            "dots": true,
                            "arrows": true,
                            "responsive": [
                                {
                                    "breakpoint": 768,
                                    "settings": {
                                        "arrows": false
                                    }
                                }
                            ],
                            "fade": true
                        }'
          >
            <div class="slide-item slide-item-bag position-relative">
              <img loading="eager" fetchpriority="high"                 class="slide-img d-none d-md-block"
                src="assets/img/slideshow/f1.jpg"
                alt="slide-1"
              />
              <img loading="eager" fetchpriority="high"                 class="slide-img d-md-none"
                src="assets/img/slideshow/f1-m.jpg"
                alt="slide-1"
              />
              <div class="content-absolute content-slide">
                <div
                  class="container height-inherit d-flex align-items-center justify-content-end"
                >
                  <div class="content-box slide-content slide-content-1 py-4">
                    <h2
                      class="slide-heading heading_72 animate__animated animate__fadeInUp"
                      data-animation="animate__animated animate__fadeInUp"
                    >
                      Des matelas pour un sommeil parfait
                    </h2>
                    <p
                      class="slide-subheading heading_24 animate__animated animate__fadeInUp"
                      data-animation="animate__animated animate__fadeInUp"
                    >
                      Confort et soutien optimal
                    </p>
                    <a
                      class="btn-primary slide-btn animate__animated animate__fadeInUp"
                      href="matelas.php"
                      data-animation="animate__animated animate__fadeInUp"
                      >ACHETER</a
                    >
                  </div>
                </div>
              </div>
            </div>
            <div class="slide-item slide-item-bag position-relative">
              <img loading="lazy" decoding="async"                 class="slide-img d-none d-md-block"
                src="assets/img/slideshow/f2.jpg"
                alt="slide-2"
              />
              <img loading="lazy" decoding="async"                 class="slide-img d-md-none"
                src="assets/img/slideshow/f2-m.jpg"
                alt="slide-2"
              />
              <div class="content-absolute content-slide">
                <div
                  class="container height-inherit d-flex align-items-center justify-content-end"
                >
                  <div
                    class="content-box slide-content slide-content-1 py-4 text-center"
                  >
                    <h2
                      class="slide-heading heading_72 animate__animated animate__fadeInUp"
                      data-animation="animate__animated animate__fadeInUp"
                    >
                      Oreillers, draps et couettes
                    </h2>
                    <p
                      class="slide-subheading heading_24 animate__animated animate__fadeInUp"
                      data-animation="animate__animated animate__fadeInUp"
                    >
                      Tout pour votre literie
                    </p>
                    <a
                      class="btn-primary slide-btn animate__animated animate__fadeInUp"
                      href="oreillers-et-taies.php"
                      data-animation="animate__animated animate__fadeInUp"
                      >ACHETER</a
                    >
                  </div>
                </div>
              </div>
            </div>
            <div class="slide-item slide-item-bag position-relative">
              <img loading="lazy" decoding="async"                 class="slide-img d-none d-md-block"
                src="assets/img/slideshow/f3.jpg"
                alt="slide-3"
              />
              <img loading="lazy" decoding="async"                 class="slide-img d-md-none"
                src="assets/img/slideshow/f3-m.jpg"
                alt="slide-3"
              />
              <div class="content-absolute content-slide">
                <div
                  class="container height-inherit d-flex align-items-center justify-content-center"
                >
                  <div
                    class="content-box slide-content slide-content-1 py-4 text-center"
                  >
                    <h2
                      class="slide-heading heading_72 animate__animated animate__fadeInUp"
                      data-animation="animate__animated animate__fadeInUp"
                    >
                      Mobiliers et accessoires
                    </h2>
                    <p
                      class="slide-subheading heading_24 animate__animated animate__fadeInUp"
                      data-animation="animate__animated animate__fadeInUp"
                    >
                      Aménagez votre intérieur
                    </p>
                    <a
                      class="btn-primary slide-btn animate__animated animate__fadeInUp"
                      href="mobilier-accessoire.php"
                      data-animation="animate__animated animate__fadeInUp"
                      >ACHETER</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="activate-arrows"></div>
          <div class="activate-dots dot-tools"></div>
        </div>
        <!-- slideshow end -->

        <!-- trusted badge start -->
        <div class="trusted-section mt-100 overflow-hidden">
          <div class="container">
            <div
              class="trust-strip"
              data-aos="fade-up"
              data-aos-duration="700"
            >
              <div class="trust-item">
                <span class="trust-item-icon" aria-hidden="true">
                  <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"
                    />
                    <path d="M15 18H9" />
                    <path
                      d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.62l-3.48-4.35A1 1 0 0 0 17.52 8H14"
                    />
                    <circle cx="17" cy="18" r="2" />
                    <circle cx="7" cy="18" r="2" />
                  </svg>
                </span>
                <div class="trust-item-body">
                  <h2 class="heading_18 trust-item-title">
                    Livraison Express
                  </h2>
                  <p class="text_16 trust-item-text">
                    Gratuite dès 50.000F • Sous 48h partout
                  </p>
                </div>
              </div>
              <div class="trust-item">
                <span class="trust-item-icon" aria-hidden="true">
                  <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <rect x="2" y="5" width="20" height="14" rx="2" />
                    <path d="M2 10h20" />
                    <path d="M6 15h4" />
                  </svg>
                </span>
                <div class="trust-item-body">
                  <h2 class="heading_18 trust-item-title">
                    Paiement Flexible
                  </h2>
                  <p class="text_16 trust-item-text">
                    À la livraison ou en 3x sans frais
                  </p>
                </div>
              </div>
              <div class="trust-item">
                <span class="trust-item-icon" aria-hidden="true">
                  <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"
                    />
                    <path d="m9 12 2 2 4-4" />
                  </svg>
                </span>
                <div class="trust-item-body">
                  <h2 class="heading_18 trust-item-title">
                    Garantie 10 Ans
                  </h2>
                  <p class="text_16 trust-item-text">
                    Qualité certifiée et durable
                  </p>
                </div>
              </div>
              <div class="trust-item">
                <span class="trust-item-icon" aria-hidden="true">
                  <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M3 14v-3a9 9 0 0 1 18 0v3" />
                    <path
                      d="M3 14a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"
                    />
                    <path
                      d="M21 14a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2Z"
                    />
                    <path d="M21 16v2a4 4 0 0 1-4 4h-5" />
                  </svg>
                </span>
                <div class="trust-item-body">
                  <h2 class="heading_18 trust-item-title">
                    Support 24/7
                  </h2>
                  <p class="text_16 trust-item-text">
                    Experts disponibles à tout moment
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- trusted badge end -->

        <!-- banner start -->
        <div class="grid-banner mt-100 overflow-hidden">
          <div class="collection-tab-inner mt-0">
            <div class="container">
              <div class="grid-container-2">
                <a
                  class="grid-item grid-item-1 promo-card"
                  href="matelas.php"
                  data-aos="fade-right"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="promo-card-img"
                    src="assets/img/banner/f1.jpg"
                    alt="Nos matelas"
                  />
                  <span class="promo-card-badge">-20 %</span>
                  <div class="promo-card-overlay">
                    <p class="promo-card-kicker">Cashback immédiat</p>
                    <h2 class="heading_34 promo-card-title">Nos matelas</h2>
                    <span class="promo-card-cta">
                      Voir plus
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M5 12h14" />
                        <path d="m13 6 6 6-6 6" />
                      </svg>
                    </span>
                  </div>
                </a>
                <a
                  class="grid-item grid-item-2 promo-card"
                  href="oreillers-et-taies.php"
                  data-aos="fade-right"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="promo-card-img"
                    src="assets/img/banner/f3.jpg"
                    alt="Nos oreillers"
                  />
                  <div class="promo-card-overlay">
                    <p class="promo-card-kicker">Cashback immédiat</p>
                    <h2 class="heading_34 promo-card-title">Nos oreillers</h2>
                    <span class="promo-card-cta">
                      Voir plus
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M5 12h14" />
                        <path d="m13 6 6 6-6 6" />
                      </svg>
                    </span>
                  </div>
                </a>
                <a
                  class="grid-item grid-item-3 promo-card promo-card--feature"
                  href="drap-et-couettes.php"
                  data-aos="fade-left"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="promo-card-img"
                    src="assets/img/products/real/1770738680_Z9FYQSbomB.jpg"
                    alt="Nos couettes"
                  />
                  <div class="promo-card-overlay">
                    <p class="promo-card-kicker">Cashback immédiat</p>
                    <h2 class="heading_34 promo-card-title">Nos couettes</h2>
                    <span class="promo-card-cta">
                      Voir plus
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M5 12h14" />
                        <path d="m13 6 6 6-6 6" />
                      </svg>
                    </span>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- banner end -->

        <!-- shop by category start -->
        <div class="shop-category cat-band mt-100 overflow-hidden">
          <div class="collection-tab-inner mt-0">
            <div class="container">
              <div
                class="featured-head"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <div class="featured-head-text">
                  <p class="featured-kicker">Explorez nos univers</p>
                  <h2 class="section-heading featured-title">
                    Acheter par catégorie
                  </h2>
                </div>
              </div>
              <div class="grid-container shop-category-inner">
                <a
                  class="grid-item grid-item-1 cat-card"
                  href="matelas.php"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="cat-card-img"
                    src="assets/img/products/real/1770689632_0OTK5fkOpt.jpg"
                    alt="Matelas"
                  />
                  <div class="cat-card-label">
                    <span class="cat-card-info">
                      <span class="cat-card-kicker">Confort &amp; soutien</span>
                      <span class="cat-card-name">Matelas</span>
                    </span>
                    <span class="cat-card-arrow" aria-hidden="true">
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M5 12h14" />
                        <path d="m13 6 6 6-6 6" />
                      </svg>
                    </span>
                  </div>
                </a>
                <a
                  class="grid-item grid-item-2 cat-card"
                  href="oreillers-et-taies.php"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="cat-card-img"
                    src="assets/img/products/real/1769643261_righaaXc9N.jpg"
                    alt="Oreillers et taies"
                  />
                  <div class="cat-card-label">
                    <span class="cat-card-info">
                      <span class="cat-card-kicker">Douceur &amp; maintien</span>
                      <span class="cat-card-name">Oreillers et taies</span>
                    </span>
                    <span class="cat-card-arrow" aria-hidden="true">
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M5 12h14" />
                        <path d="m13 6 6 6-6 6" />
                      </svg>
                    </span>
                  </div>
                </a>
                <a
                  class="grid-item grid-item-3 cat-card"
                  href="drap-et-couettes.php"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="cat-card-img"
                    src="assets/img/products/real/1770691758_oLpAhmB0Wd.jpg"
                    alt="Drap et Couettes"
                  />
                  <div class="cat-card-label">
                    <span class="cat-card-info">
                      <span class="cat-card-kicker">Linge de lit</span>
                      <span class="cat-card-name">Drap et Couettes</span>
                    </span>
                    <span class="cat-card-arrow" aria-hidden="true">
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M5 12h14" />
                        <path d="m13 6 6 6-6 6" />
                      </svg>
                    </span>
                  </div>
                </a>
                <a
                  class="grid-item grid-item-4 cat-card"
                  href="mobilier-accessoire.php"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="cat-card-img"
                    src="assets/img/products/real/1770738680_Z9FYQSbomB.jpg"
                    alt="Mobiliers et Accessoires"
                  />
                  <div class="cat-card-label">
                    <span class="cat-card-info">
                      <span class="cat-card-kicker">Pour votre intérieur</span>
                      <span class="cat-card-name">Mobiliers &amp; Accessoires</span>
                    </span>
                    <span class="cat-card-arrow" aria-hidden="true">
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M5 12h14" />
                        <path d="m13 6 6 6-6 6" />
                      </svg>
                    </span>
                  </div>
                </a>
                <a
                  class="grid-item grid-item-5 cat-card"
                  href="electromenager.php"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="cat-card-img"
                    src="assets/img/products/real/1770691758_zO2jmRAXwA.jpg"
                    alt="Électroménager"
                  />
                  <div class="cat-card-label">
                    <span class="cat-card-info">
                      <span class="cat-card-kicker">Maison connectée</span>
                      <span class="cat-card-name">Électroménager</span>
                    </span>
                    <span class="cat-card-arrow" aria-hidden="true">
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M5 12h14" />
                        <path d="m13 6 6 6-6 6" />
                      </svg>
                    </span>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- shop by category end -->

        <!-- collection start -->
        <div class="featured-collection mt-100 overflow-hidden">
          <div class="collection-tab-inner">
            <div class="container">
              <div
                class="featured-head"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <div class="featured-head-text">
                  <p class="featured-kicker">Notre sélection</p>
                  <h2 class="section-heading featured-title">
                    Nos matelas en vedette
                  </h2>
                </div>
                <a class="featured-link" href="matelas.php">
                  Voir tout
                  <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M5 12h14" />
                    <path d="m13 6 6 6-6 6" />
                  </svg>
                </a>
              </div>
              <div class="row featured-grid">
                <div
                  class="col-lg-3 col-md-6 col-12"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-img">
                      <a
                        class="hover-switch"
                        href="collection-left-sidebar.php"
                      >
                        <img loading="lazy" decoding="async"                           class="secondary-img"
                          src="assets/img/products/real/1770738680_YSa0YK1dz1.jpg"
                          alt="product-img"
                        />
                        <img loading="lazy" decoding="async"                           class="primary-img"
                          src="assets/img/products/real/1770738680_Z9FYQSbomB.jpg"
                          alt="product-img"
                        />
                      </a>

                      <div class="product-badge">
                        <span class="badge-label badge-percentage rounded"
                          >-44%</span
                        >
                      </div>

                      <div
                        class="product-card-action product-card-action-2 justify-content-center"
                      >
                        <a
                          href="index.php#quickview-modal"
                          class="action-card action-quickview"
                          data-bs-toggle="modal"
                        >
                          <svg
                            width="26"
                            height="26"
                            viewBox="0 0 26 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M10 0C15.5117 0 20 4.48828 20 10C20 12.3945 19.1602 14.5898 17.75 16.3125L25.7188 24.2812L24.2812 25.7188L16.3125 17.75C14.5898 19.1602 12.3945 20 10 20C4.48828 20 0 15.5117 0 10C0 4.48828 4.48828 0 10 0ZM10 2C5.57031 2 2 5.57031 2 10C2 14.4297 5.57031 18 10 18C14.4297 18 18 14.4297 18 10C18 5.57031 14.4297 2 10 2ZM11 6V9H14V11H11V14H9V11H6V9H9V6H11Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-wishlist">
                          <svg
                            class="icon icon-wishlist"
                            width="26"
                            height="22"
                            viewBox="0 0 26 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-addtocart">
                          <svg
                            class="icon icon-cart"
                            width="24"
                            height="26"
                            viewBox="0 0 24 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title">
                        <a href="collection-left-sidebar.php"
                          > Matelas Ressorts Ensachés</a
                        >
                      </h3>
                      <div class="product-card-price">
                        <span class="card-price-regular">899 FCFA</span>
                        <span
                          class="card-price-compare text-decoration-line-through"
                          >1 259 FCFA</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-lg-3 col-md-6 col-12"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-img">
                      <a
                        class="hover-switch"
                        href="collection-left-sidebar.php"
                      >
                        <img loading="lazy" decoding="async"                           class="secondary-img"
                          src="assets/img/products/real/1769651796_8nTO7f2rrg.jpg"
                          alt="product-img"
                        />
                        <img loading="lazy" decoding="async"                           class="primary-img"
                          src="assets/img/products/real/1769999657_1CIVZl8UG6.jpg"
                          alt="product-img"
                        />
                      </a>

                      <div
                        class="product-card-action product-card-action-2 justify-content-center"
                      >
                        <a
                          href="index.php#quickview-modal"
                          class="action-card action-quickview"
                          data-bs-toggle="modal"
                        >
                          <svg
                            width="26"
                            height="26"
                            viewBox="0 0 26 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M10 0C15.5117 0 20 4.48828 20 10C20 12.3945 19.1602 14.5898 17.75 16.3125L25.7188 24.2812L24.2812 25.7188L16.3125 17.75C14.5898 19.1602 12.3945 20 10 20C4.48828 20 0 15.5117 0 10C0 4.48828 4.48828 0 10 0ZM10 2C5.57031 2 2 5.57031 2 10C2 14.4297 5.57031 18 10 18C14.4297 18 18 14.4297 18 10C18 5.57031 14.4297 2 10 2ZM11 6V9H14V11H11V14H9V11H6V9H9V6H11Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-wishlist">
                          <svg
                            class="icon icon-wishlist"
                            width="26"
                            height="22"
                            viewBox="0 0 26 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-addtocart">
                          <svg
                            class="icon icon-cart"
                            width="24"
                            height="26"
                            viewBox="0 0 24 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title">
                        <a href="collection-left-sidebar.php"
                          > Oreiller Mémoire de Forme</a
                        >
                      </h3>
                      <div class="product-card-price">
                        <span class="card-price-regular">89 FCFA</span>
                        <span
                          class="card-price-compare text-decoration-line-through"
                          >129 FCFA</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-lg-3 col-md-6 col-12"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-img">
                      <a
                        class="hover-switch"
                        href="collection-left-sidebar.php"
                      >
                        <img loading="lazy" decoding="async"                           class="secondary-img"
                          src="assets/img/products/real/1769999657_xCatLOv9hZ.jpg"
                          alt="product-img"
                        />
                        <img loading="lazy" decoding="async"                           class="primary-img"
                          src="assets/img/products/real/1769993520_r5wT4mQ4N8.jpg"
                          alt="product-img"
                        />
                      </a>

                      <div class="product-badge">
                        <span class="badge-label badge-new rounded">Nouveau</span>
                      </div>

                      <div
                        class="product-card-action product-card-action-2 justify-content-center"
                      >
                        <a
                          href="index.php#quickview-modal"
                          class="action-card action-quickview"
                          data-bs-toggle="modal"
                        >
                          <svg
                            width="26"
                            height="26"
                            viewBox="0 0 26 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M10 0C15.5117 0 20 4.48828 20 10C20 12.3945 19.1602 14.5898 17.75 16.3125L25.7188 24.2812L24.2812 25.7188L16.3125 17.75C14.5898 19.1602 12.3945 20 10 20C4.48828 20 0 15.5117 0 10C0 4.48828 4.48828 0 10 0ZM10 2C5.57031 2 2 5.57031 2 10C2 14.4297 5.57031 18 10 18C14.4297 18 18 14.4297 18 10C18 5.57031 14.4297 2 10 2ZM11 6V9H14V11H11V14H9V11H6V9H9V6H11Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-wishlist">
                          <svg
                            class="icon icon-wishlist"
                            width="26"
                            height="22"
                            viewBox="0 0 26 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-addtocart">
                          <svg
                            class="icon icon-cart"
                            width="24"
                            height="26"
                            viewBox="0 0 24 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title">
                        <a href="collection-left-sidebar.php"
                          > Couette Chaude en Plumes</a
                        >
                      </h3>
                      <div class="product-card-price">
                        <span class="card-price-regular">199 FCFA</span>
                        <span
                          class="card-price-compare text-decoration-line-through"
                          >289 FCFA</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-lg-3 col-md-6 col-12"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-img">
                      <a
                        class="hover-switch"
                        href="collection-left-sidebar.php"
                      >
                        <img loading="lazy" decoding="async"                           class="secondary-img"
                          src="assets/img/products/real/1769996652_KIr5Mp78N5.jpg"
                          alt="product-img"
                        />
                        <img loading="lazy" decoding="async"                           class="primary-img"
                          src="assets/img/products/real/1769999657_1CIVZl8UG6.jpg"
                          alt="product-img"
                        />
                      </a>

                      <div
                        class="product-card-action product-card-action-2 justify-content-center"
                      >
                        <a
                          href="index.php#quickview-modal"
                          class="action-card action-quickview"
                          data-bs-toggle="modal"
                        >
                          <svg
                            width="26"
                            height="26"
                            viewBox="0 0 26 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M10 0C15.5117 0 20 4.48828 20 10C20 12.3945 19.1602 14.5898 17.75 16.3125L25.7188 24.2812L24.2812 25.7188L16.3125 17.75C14.5898 19.1602 12.3945 20 10 20C4.48828 20 0 15.5117 0 10C0 4.48828 4.48828 0 10 0ZM10 2C5.57031 2 2 5.57031 2 10C2 14.4297 5.57031 18 10 18C14.4297 18 18 14.4297 18 10C18 5.57031 14.4297 2 10 2ZM11 6V9H14V11H11V14H9V11H6V9H9V6H11Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-wishlist">
                          <svg
                            class="icon icon-wishlist"
                            width="26"
                            height="22"
                            viewBox="0 0 26 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-addtocart">
                          <svg
                            class="icon icon-cart"
                            width="24"
                            height="26"
                            viewBox="0 0 24 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title">
                        <a href="collection-left-sidebar.php"
                          > Table de Nuit en Chêne</a
                        >
                      </h3>
                      <div class="product-card-price">
                        <span class="card-price-regular">179 FCFA</span>
                        <span
                          class="card-price-compare text-decoration-line-through"
                          >249 FCFA</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-lg-3 col-md-6 col-12"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-img">
                      <a
                        class="hover-switch"
                        href="collection-left-sidebar.php"
                      >
                        <img loading="lazy" decoding="async"                           class="secondary-img"
                          src="assets/img/products/real/1769999657_kRzaynhx3X.jpg"
                          alt="product-img"
                        />
                        <img loading="lazy" decoding="async"                           class="primary-img"
                          src="assets/img/products/real/1769999657_xCatLOv9hZ.jpg"
                          alt="product-img"
                        />
                      </a>

                      <div
                        class="product-card-action product-card-action-2 justify-content-center"
                      >
                        <a
                          href="index.php#quickview-modal"
                          class="action-card action-quickview"
                          data-bs-toggle="modal"
                        >
                          <svg
                            width="26"
                            height="26"
                            viewBox="0 0 26 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M10 0C15.5117 0 20 4.48828 20 10C20 12.3945 19.1602 14.5898 17.75 16.3125L25.7188 24.2812L24.2812 25.7188L16.3125 17.75C14.5898 19.1602 12.3945 20 10 20C4.48828 20 0 15.5117 0 10C0 4.48828 4.48828 0 10 0ZM10 2C5.57031 2 2 5.57031 2 10C2 14.4297 5.57031 18 10 18C14.4297 18 18 14.4297 18 10C18 5.57031 14.4297 2 10 2ZM11 6V9H14V11H11V14H9V11H6V9H9V6H11Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-wishlist">
                          <svg
                            class="icon icon-wishlist"
                            width="26"
                            height="22"
                            viewBox="0 0 26 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-addtocart">
                          <svg
                            class="icon icon-cart"
                            width="24"
                            height="26"
                            viewBox="0 0 24 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title">
                        <a href="collection-left-sidebar.php"
                          > Commode de Chambre Vita</a
                        >
                      </h3>
                      <div class="product-card-price">
                        <span class="card-price-regular">649 FCFA</span>
                        <span
                          class="card-price-compare text-decoration-line-through"
                          >899 FCFA</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-lg-3 col-md-6 col-12"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-img">
                      <a
                        class="hover-switch"
                        href="collection-left-sidebar.php"
                      >
                        <img loading="lazy" decoding="async"                           class="secondary-img"
                          src="assets/img/products/real/1770689632_0OTK5fkOpt.jpg"
                          alt="product-img"
                        />
                        <img loading="lazy" decoding="async"                           class="primary-img"
                          src="assets/img/products/real/1769643261_righaaXc9N.jpg"
                          alt="product-img"
                        />
                      </a>

                      <div
                        class="product-card-action product-card-action-2 justify-content-center"
                      >
                        <a
                          href="index.php#quickview-modal"
                          class="action-card action-quickview"
                          data-bs-toggle="modal"
                        >
                          <svg
                            width="26"
                            height="26"
                            viewBox="0 0 26 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M10 0C15.5117 0 20 4.48828 20 10C20 12.3945 19.1602 14.5898 17.75 16.3125L25.7188 24.2812L24.2812 25.7188L16.3125 17.75C14.5898 19.1602 12.3945 20 10 20C4.48828 20 0 15.5117 0 10C0 4.48828 4.48828 0 10 0ZM10 2C5.57031 2 2 5.57031 2 10C2 14.4297 5.57031 18 10 18C14.4297 18 18 14.4297 18 10C18 5.57031 14.4297 2 10 2ZM11 6V9H14V11H11V14H9V11H6V9H9V6H11Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-wishlist">
                          <svg
                            class="icon icon-wishlist"
                            width="26"
                            height="22"
                            viewBox="0 0 26 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-addtocart">
                          <svg
                            class="icon icon-cart"
                            width="24"
                            height="26"
                            viewBox="0 0 24 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title">
                        <a href="collection-left-sidebar.php"
                          > Table de Chevet Noire</a
                        >
                      </h3>
                      <div class="product-card-price">
                        <span class="card-price-regular">129 FCFA</span>
                        <span
                          class="card-price-compare text-decoration-line-through"
                          >189 FCFA</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-lg-3 col-md-6 col-12"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-img">
                      <a
                        class="hover-switch"
                        href="collection-left-sidebar.php"
                      >
                        <img loading="lazy" decoding="async"                           class="secondary-img"
                          src="assets/img/products/real/1770691758_oLpAhmB0Wd.jpg"
                          alt="product-img"
                        />
                        <img loading="lazy" decoding="async"                           class="primary-img"
                          src="assets/img/products/real/1770691758_zO2jmRAXwA.jpg"
                          alt="product-img"
                        />
                      </a>

                      <div
                        class="product-card-action product-card-action-2 justify-content-center"
                      >
                        <a
                          href="index.php#quickview-modal"
                          class="action-card action-quickview"
                          data-bs-toggle="modal"
                        >
                          <svg
                            width="26"
                            height="26"
                            viewBox="0 0 26 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M10 0C15.5117 0 20 4.48828 20 10C20 12.3945 19.1602 14.5898 17.75 16.3125L25.7188 24.2812L24.2812 25.7188L16.3125 17.75C14.5898 19.1602 12.3945 20 10 20C4.48828 20 0 15.5117 0 10C0 4.48828 4.48828 0 10 0ZM10 2C5.57031 2 2 5.57031 2 10C2 14.4297 5.57031 18 10 18C14.4297 18 18 14.4297 18 10C18 5.57031 14.4297 2 10 2ZM11 6V9H14V11H11V14H9V11H6V9H9V6H11Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-wishlist">
                          <svg
                            class="icon icon-wishlist"
                            width="26"
                            height="22"
                            viewBox="0 0 26 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-addtocart">
                          <svg
                            class="icon icon-cart"
                            width="24"
                            height="26"
                            viewBox="0 0 24 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title">
                        <a href="collection-left-sidebar.php"
                          > Taie d'Oreiller Satin</a
                        >
                      </h3>
                      <div class="product-card-price">
                        <span class="card-price-regular">39 FCFA</span>
                        <span
                          class="card-price-compare text-decoration-line-through"
                          >59 FCFA</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-lg-3 col-md-6 col-12"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-img">
                      <a
                        class="hover-switch"
                        href="collection-left-sidebar.php"
                      >
                        <img loading="lazy" decoding="async"                           class="secondary-img"
                          src="assets/img/products/real/1770738680_YSa0YK1dz1.jpg"
                          alt="product-img"
                        />
                        <img loading="lazy" decoding="async"                           class="primary-img"
                          src="assets/img/products/real/1770738680_Z9FYQSbomB.jpg"
                          alt="product-img"
                        />
                      </a>

                      <div
                        class="product-card-action product-card-action-2 justify-content-center"
                      >
                        <a
                          href="index.php#quickview-modal"
                          class="action-card action-quickview"
                          data-bs-toggle="modal"
                        >
                          <svg
                            width="26"
                            height="26"
                            viewBox="0 0 26 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M10 0C15.5117 0 20 4.48828 20 10C20 12.3945 19.1602 14.5898 17.75 16.3125L25.7188 24.2812L24.2812 25.7188L16.3125 17.75C14.5898 19.1602 12.3945 20 10 20C4.48828 20 0 15.5117 0 10C0 4.48828 4.48828 0 10 0ZM10 2C5.57031 2 2 5.57031 2 10C2 14.4297 5.57031 18 10 18C14.4297 18 18 14.4297 18 10C18 5.57031 14.4297 2 10 2ZM11 6V9H14V11H11V14H9V11H6V9H9V6H11Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-wishlist">
                          <svg
                            class="icon icon-wishlist"
                            width="26"
                            height="22"
                            viewBox="0 0 26 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>

                        <a href="index.php#" class="action-card action-addtocart">
                          <svg
                            class="icon icon-cart"
                            width="24"
                            height="26"
                            viewBox="0 0 24 26"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                              fill="#00234D"
                            />
                          </svg>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title">
                        <a href="collection-left-sidebar.php"
                          > Fauteuil de Chambre Vita</a
                        >
                      </h3>
                      <div class="product-card-price">
                        <span class="card-price-regular">549 FCFA</span>
                        <span
                          class="card-price-compare text-decoration-line-through"
                          >759 FCFA</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- collection end -->

        

        <!-- sur-mesure start -->
        <div class="sm-band mt-100 overflow-hidden">
          <div class="container">
            <div
              class="sm-head"
              data-aos="fade-up"
              data-aos-duration="700"
            >
              <span class="sm-badge">
                <svg
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path
                    d="M3 10.5 12 3l9 7.5"
                  />
                  <path
                    d="M5 9.5V21h14V9.5"
                  />
                  <path d="M9 21v-6h6v6" />
                </svg>
                Solutions adaptées
              </span>
              <h2 class="section-heading sm-title">Sur-mesure</h2>
              <p class="sm-sub">
                Que vous équipiez un hôtel, un appartement ou votre maison
                familiale, nous avons la solution parfaite.
              </p>
            </div>
            <div class="sm-grid">
              <a
                class="sm-card sm-card-1"
                href="hotellerie.php"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <img loading="lazy" decoding="async"                   class="sm-card-img"
                  src="assets/img/products/real/1769651796_8nTO7f2rrg.jpg"
                  alt="Hôtellerie"
                />
                <div class="sm-card-text">
                  <h3 class="sm-card-title">Hôtellerie</h3>
                  <p class="sm-card-sub">
                    Solutions professionnelles pour hôtels, chambres d'hôtes
                    et résidences de tourisme
                  </p>
                </div>
              </a>
              <a
                class="sm-card sm-card-2"
                href="appartement-meuble.php"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <img loading="lazy" decoding="async"                   class="sm-card-img"
                  src="assets/img/products/real/1769999657_1CIVZl8UG6.jpg"
                  alt="Appartement Meublé"
                />
                <div class="sm-card-text">
                  <h3 class="sm-card-title">Appartement Meublé</h3>
                </div>
              </a>
              <a
                class="sm-card sm-card-3"
                href="studio.php"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <img loading="eager" fetchpriority="high"                   class="sm-card-img"
                  src="assets/img/products/real/1770689632_0OTK5fkOpt.jpg"
                  alt="Studio"
                />
                <div class="sm-card-text">
                  <h3 class="sm-card-title">Studio</h3>
                </div>
              </a>
              <a
                class="sm-card sm-card-4"
                href="famille.php"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <img loading="lazy" decoding="async"                   class="sm-card-img"
                  src="assets/img/products/real/1769993520_r5wT4mQ4N8.jpg"
                  alt="Famille"
                />
                <div class="sm-card-text">
                  <h3 class="sm-card-title">Famille</h3>
                  <p class="sm-card-sub">
                    Matelas pour toute la famille, du bébé aux grands-parents
                  </p>
                </div>
              </a>
            </div>
          </div>
        </div>
        <!-- sur-mesure end -->

        <!-- all products start -->
        <div class="pc-band mt-100 overflow-hidden">
          <div class="container">
            <div class="pc-head" data-aos="fade-up" data-aos-duration="700">
              <span class="pc-kicker">Catalogue complet</span>
              <div class="pc-head-row">
                <h2 class="section-heading pc-title">Tous nos produits</h2>
                <p class="pc-sub">
                  De la literie à l'électroménager, tout l'équipement de
                  votre intérieur réuni au même endroit.
                </p>
              </div>
            </div>
            <div class="pc-grid">
              <a class="pc-card" href="matelas.php" data-aos="fade-up" data-aos-duration="700">
                <div class="pc-card-media">
                  <img class="pc-card-img" src="assets/img/products/real/1769999657_1CIVZl8UG6.jpg" alt="Matelas" loading="lazy" decoding="async">
                </div>
                <div class="pc-card-body">
                  <div>
                    <h3 class="pc-card-title">Matelas</h3>
                    <p class="pc-card-text">Ressorts, mousse et mémoire de forme, toutes tailles</p>
                  </div>
                  <span class="pc-card-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
              <a class="pc-card" href="oreillers-et-taies.php" data-aos="fade-up" data-aos-duration="700">
                <div class="pc-card-media">
                  <img class="pc-card-img" src="assets/img/products/real/1769999657_xCatLOv9hZ.jpg" alt="Oreillers et taies" loading="lazy" decoding="async">
                </div>
                <div class="pc-card-body">
                  <div>
                    <h3 class="pc-card-title">Oreillers &amp; taies</h3>
                    <p class="pc-card-text">Moelleux ou ferme, pour toutes les positions de sommeil</p>
                  </div>
                  <span class="pc-card-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
              <a class="pc-card" href="drap-et-couettes.php" data-aos="fade-up" data-aos-duration="700">
                <div class="pc-card-media">
                  <img class="pc-card-img" src="assets/img/products/real/1769993520_r5wT4mQ4N8.jpg" alt="Draps et couettes" loading="lazy" decoding="async">
                </div>
                <div class="pc-card-body">
                  <div>
                    <h3 class="pc-card-title">Draps &amp; couettes</h3>
                    <p class="pc-card-text">Linge de lit doux et respirant, adapté au climat</p>
                  </div>
                  <span class="pc-card-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
              <a class="pc-card" href="mobilier-accessoire.php" data-aos="fade-up" data-aos-duration="700">
                <div class="pc-card-media">
                  <img class="pc-card-img" src="assets/img/products/real/1770689632_0OTK5fkOpt.jpg" alt="Lits et mobilier de chambre" loading="lazy" decoding="async">
                </div>
                <div class="pc-card-body">
                  <div>
                    <h3 class="pc-card-title">Lits &amp; chambre</h3>
                    <p class="pc-card-text">Cadres de lit, commodes et rangements pour la chambre</p>
                  </div>
                  <span class="pc-card-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
              <a class="pc-card" href="mobilier-accessoire.php" data-aos="fade-up" data-aos-duration="700">
                <div class="pc-card-media">
                  <img class="pc-card-img" src="assets/img/products/real/1770738680_Z9FYQSbomB.jpg" alt="Mobilier et accessoires" loading="lazy" decoding="async">
                </div>
                <div class="pc-card-body">
                  <div>
                    <h3 class="pc-card-title">Mobilier &amp; accessoires</h3>
                    <p class="pc-card-text">Canapés, fauteuils, tables et meubles du quotidien</p>
                  </div>
                  <span class="pc-card-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
              <a class="pc-card" href="electromenager.php" data-aos="fade-up" data-aos-duration="700">
                <div class="pc-card-media">
                  <img class="pc-card-img" src="assets/img/products/real/1769999657_1CIVZl8UG6.jpg" alt="Électroménager" loading="lazy" decoding="async">
                </div>
                <div class="pc-card-body">
                  <div>
                    <h3 class="pc-card-title">Électroménager</h3>
                    <p class="pc-card-text">Les essentiels de la maison, de la cuisine à la buanderie</p>
                  </div>
                  <span class="pc-card-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
            </div>
          </div>
        </div>
        <!-- all products end -->

        <!-- video start -->
        <div class="video-section mt-100 overflow-hidden">
          <div
            class="overlay-furniture section-spacing"
            style="
              background: url('assets/img/video/video-furniture.jpg')
                no-repeat fixed bottom center/cover;
            "
          >
            <div class="container video-container">
              <div class="row">
                <div class="col-12">
                  <div
                    class="video-tools d-flex align-items-center justify-content-center"
                  >
                    <div class="video-button-area">
                      <a
                        class="video-button"
                        href="index.php#video-modal"
                        data-bs-toggle="modal"
                      >
                        <svg
                          width="22"
                          height="26"
                          viewBox="0 0 22 26"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M21.5 12.134C22.1667 12.5189 22.1667 13.4811 21.5 13.866L2 25.1244C1.33333 25.5093 0.499999 25.0281 0.499999 24.2583L0.5 1.74167C0.5 0.971867 1.33333 0.490743 2 0.875643L21.5 12.134Z"
                            fill="#FEFEFE"
                          />
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" tabindex="-1" id="video-modal">
            <div class="modal-dialog modal-dialog-centered modal-xl">
              <div class="modal-content">
                <div class="modal-header border-0">
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fermer"
                  ></button>
                </div>
                <div class="modal-body">
                  <iframe
                    height="600"
                    src="https://www.youtube.com/embed/tvPnrfQCiCo"
                    title="Lecteur vidéo YouTube"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                  ></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- video end -->

        

        <!-- testimonial start -->
        <div class="testimonial-section mt-100 overflow-hidden home-section">
          <div class="testimonial-inner">
            <div class="container">
              <div class="row">
                <div
                  class="col-lg-5 col-md-12 col-12"
                  data-aos="fade-right"
                  data-aos-duration="700"
                >
                  <div class="section-header">
                    <h2 class="section-heading primary-color">
                      Ce que disent nos clients
                    </h2>
                    <p class="section-subheading">
                      Les services fournis ont été fluides et satisfaisants. Les produits livrés étaient à la hauteur de nos attentes.
                    </p>
                  </div>
                </div>
                <div
                  class="col-lg-6 offset-lg-1 col-md-12 col-12"
                  data-aos="fade-left"
                  data-aos-duration="700"
                >
                  <div class="testimonial-container position-relative">
                    <div
                      class="testimonial-slideshow common-slider"
                      data-slick='{
                                            "slidesToShow": 1, 
                                            "slidesToScroll": 1,
                                            "dots": false,
                                            "arrows": true
                                        }'
                    >
                      <div class="testimonial-item">
                        <div
                          class="testimonial-icon-wrap d-flex align-items-center"
                        >
                          <div class="testimonial-icon-quote">
                            <svg
                              width="40"
                              height="29"
                              viewBox="0 0 40 29"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M0 28.99L11.7 0H19.5L12.22 28.99H0ZM20.28 28.99L32.11 0H39.91L32.5 28.99H20.28Z"
                                fill="#00234D"
                              />
                            </svg>
                          </div>
                          <div
                            class="testimonial-icon-star d-flex align-items-center ms-3"
                          >
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                          </div>
                        </div>
                        <p class="testimonial-review my-4 text_16">
                          « J'achète mes matelas chez Mobilier Addict depuis 6 ans. J'adore leur service réactif et je n'ai jamais eu de problème avec leurs matelas. »
                        </p>
                        <div
                          class="testimonial-reviewer d-flex align-items-center"
                        >
                          <div class="reviewer-img">
                            <img loading="lazy" decoding="async"                               src="assets/img/testimonial/avatar.svg"
                              alt="Avatar client"
                            />
                          </div>
                          <div class="reviewer-info ms-4">
                            <h4
                              class="reviewer-name heading_18 mb-2 primary-color"
                            >
                              Floyd Miles
                            </h4>
                            <p class="reviewer-desig text_14 m-0">
                              Dirigeant, Hypebeast
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="testimonial-item">
                        <div
                          class="testimonial-icon-wrap d-flex align-items-center"
                        >
                          <div class="testimonial-icon-quote">
                            <svg
                              width="40"
                              height="29"
                              viewBox="0 0 40 29"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M0 28.99L11.7 0H19.5L12.22 28.99H0ZM20.28 28.99L32.11 0H39.91L32.5 28.99H20.28Z"
                                fill="#00234D"
                              />
                            </svg>
                          </div>
                          <div
                            class="testimonial-icon-star d-flex align-items-center ms-3"
                          >
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                          </div>
                        </div>
                        <p class="testimonial-review my-4 text_16">
                          « J'achète mes matelas chez Mobilier Addict depuis 6 ans. J'adore leur service réactif et je n'ai jamais eu de problème avec leurs matelas. »
                        </p>
                        <div
                          class="testimonial-reviewer d-flex align-items-center"
                        >
                          <div class="reviewer-img">
                            <img loading="lazy" decoding="async"                               src="assets/img/testimonial/avatar.svg"
                              alt="Avatar client"
                            />
                          </div>
                          <div class="reviewer-info ms-4">
                            <h4
                              class="reviewer-name heading_18 mb-2 primary-color"
                            >
                              Floyd Miles
                            </h4>
                            <p class="reviewer-desig text_14 m-0">
                              Dirigeant, Hypebeast
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="testimonial-item">
                        <div
                          class="testimonial-icon-wrap d-flex align-items-center"
                        >
                          <div class="testimonial-icon-quote">
                            <svg
                              width="40"
                              height="29"
                              viewBox="0 0 40 29"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M0 28.99L11.7 0H19.5L12.22 28.99H0ZM20.28 28.99L32.11 0H39.91L32.5 28.99H20.28Z"
                                fill="#00234D"
                              />
                            </svg>
                          </div>
                          <div
                            class="testimonial-icon-star d-flex align-items-center ms-3"
                          >
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                            <img loading="lazy" decoding="async" src="assets/img/icon/star.png" alt="img" />
                          </div>
                        </div>
                        <p class="testimonial-review my-4 text_16">
                          « J'achète mes matelas chez Mobilier Addict depuis 6 ans. J'adore leur service réactif et je n'ai jamais eu de problème avec leurs matelas. »
                        </p>
                        <div
                          class="testimonial-reviewer d-flex align-items-center"
                        >
                          <div class="reviewer-img">
                            <img loading="lazy" decoding="async"                               src="assets/img/testimonial/avatar.svg"
                              alt="Avatar client"
                            />
                          </div>
                          <div class="reviewer-info ms-4">
                            <h4
                              class="reviewer-name heading_18 mb-2 primary-color"
                            >
                              Floyd Miles
                            </h4>
                            <p class="reviewer-desig text_14 m-0">
                              Dirigeant, Hypebeast
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="activate-arrows show-arrows-always article-arrows arrows-white"
                    ></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- testimonial end -->

        <!-- single banner start -->
        <div class="single-banner-section mt-100 overflow-hidden">
          <div class="position-relative overlay">
            <img loading="lazy" decoding="async"               class="single-banner-img"
              src="assets/img/products/real/1769993520_r5wT4mQ4N8.jpg"
              alt="slide-1"
            />

            <div class="content-absolute content-slide">
              <div
                class="container height-inherit d-flex align-items-center justify-content-center"
              >
                <div
                  class="content-box single-banner-content py-4 text-center"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <h2
                    class="single-banner-heading heading_42 text-white animate__animated animate__fadeInUp"
                    data-animation="animate__animated animate__fadeInUp"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    Matelas sur mesure
                  </h2>
                  <p
                    class="single-banner-text text_16 text-white animate__animated animate__fadeInUp"
                    data-animation="animate__animated animate__fadeInUp"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    Un matelas adapté à votre morphologie et à vos habitudes de sommeil.
                  </p>
                  <a
                    class="btn-primary single-banner-btn animate__animated animate__fadeInUp"
                    href="matelas.php"
                    data-animation="animate__animated animate__fadeInUp"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    DÉCOUVRIR
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- single banner end -->

        <!-- latest blog start -->
        <div class="latest-blog-section blog-v2 mt-100 overflow-hidden home-section">
          <div class="latest-blog-inner">
            <div class="container">
              <div
                class="featured-head"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <div class="featured-head-text">
                  <p class="featured-kicker">Le magazine</p>
                  <h2 class="section-heading featured-title">
                    Derniers articles
                  </h2>
                </div>
                <a class="featured-link" href="blog.php">
                  Tous les articles
                  <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M5 12h14" />
                    <path d="m13 6 6 6-6 6" />
                  </svg>
                </a>
              </div>
              <div class="article-card-container position-relative">
                <div
                  class="common-slider"
                  data-slick='{
                                "slidesToShow": 3, 
                                "slidesToScroll": 1,
                                "dots": false,
                                "arrows": true,
                                "responsive": [
                                  {
                                    "breakpoint": 1281,
                                    "settings": {
                                      "slidesToShow": 2
                                    }
                                  },
                                  {
                                    "breakpoint": 602,
                                    "settings": {
                                      "slidesToShow": 1
                                    }
                                  }
                                ]
                            }'
                >
                  <div
                    class="article-slick-item"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    <div class="article-card blog-card">
                      <a class="article-card-img-wrapper" href="article.php">
                        <img loading="lazy" decoding="async"                           src="assets/img/blog/furniture-1.jpg"
                          alt="img"
                          class="article-card-img rounded"
                        />

                        <span class="article-tag article-tag-absolute rounded"
                          >Décoration</span
                        >
                      </a>
                      <p
                        class="article-card-published text_12 d-flex align-items-center"
                      >
                        <span class="article-date d-flex align-items-center">
                          <span class="icon-publish">
                            <svg
                              width="17"
                              height="18"
                              viewBox="0 0 17 18"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M3.46875 0.875V1.59375H0.59375V17.4063H16.4063V1.59375H13.5313V0.875H12.0938V1.59375H4.90625V0.875H3.46875ZM2.03125 3.03125H3.46875V3.75H4.90625V3.03125H12.0938V3.75H13.5313V3.03125H14.9688V4.46875H2.03125V3.03125ZM2.03125 5.90625H14.9688V15.9688H2.03125V5.90625ZM6.34375 7.34375V8.78125H7.78125V7.34375H6.34375ZM9.21875 7.34375V8.78125H10.6563V7.34375H9.21875ZM12.0938 7.34375V8.78125H13.5313V7.34375H12.0938ZM3.46875 10.2188V11.6563H4.90625V10.2188H3.46875ZM6.34375 10.2188V11.6563H7.78125V10.2188H6.34375ZM9.21875 10.2188V11.6563H10.6563V10.2188H9.21875ZM12.0938 10.2188V11.6563H13.5313V10.2188H12.0938ZM3.46875 13.0938V14.5313H4.90625V13.0938H3.46875ZM6.34375 13.0938V14.5313H7.78125V13.0938H6.34375ZM9.21875 13.0938V14.5313H10.6563V13.0938H9.21875Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">30 décembre 2022</span>
                        </span>
                        <span
                          class="article-author d-flex align-items-center ms-4"
                        >
                          <span class="icon-author"
                            ><svg
                              width="15"
                              height="17"
                              viewBox="0 0 15 17"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M7.5 0.59375C4.72888 0.59375 2.46875 2.85388 2.46875 5.625C2.46875 7.3573 3.35315 8.89587 4.69238 9.80274C2.12903 10.9033 0.3125 13.447 0.3125 16.4063H1.75C1.75 13.2224 4.31616 10.6563 7.5 10.6563C10.6838 10.6563 13.25 13.2224 13.25 16.4063H14.6875C14.6875 13.447 12.871 10.9033 10.3076 9.80274C11.6469 8.89587 12.5313 7.3573 12.5313 5.625C12.5313 2.85388 10.2711 0.59375 7.5 0.59375ZM7.5 2.03125C9.49341 2.03125 11.0938 3.63159 11.0938 5.625C11.0938 7.61841 9.49341 9.21875 7.5 9.21875C5.50659 9.21875 3.90625 7.61841 3.90625 5.625C3.90625 3.63159 5.50659 2.03125 7.5 2.03125Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">Lara Joe</span>
                        </span>
                      </p>
                      <h2 class="article-card-heading heading_18">
                        <a class="heading_18" href="article.php">
                          Bien choisir son matelas.
                        </a>
                      </h2>
                      <a class="blog-card-more" href="article.php">
                        Lire l'article
                        <svg
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path d="M5 12h14" />
                          <path d="m13 6 6 6-6 6" />
                        </svg>
                      </a>
                    </div>
                  </div>
                  <div
                    class="article-slick-item"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    <div class="article-card blog-card">
                      <a class="article-card-img-wrapper" href="article.php">
                        <img loading="lazy" decoding="async"                           src="assets/img/blog/furniture-2.jpg"
                          alt="img"
                          class="article-card-img rounded"
                        />
                        <span class="article-tag article-tag-absolute rounded"
                          >Mobilier</span
                        >
                      </a>
                      <p
                        class="article-card-published text_12 d-flex align-items-center"
                      >
                        <span class="article-date d-flex align-items-center">
                          <span class="icon-publish">
                            <svg
                              width="17"
                              height="18"
                              viewBox="0 0 17 18"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M3.46875 0.875V1.59375H0.59375V17.4063H16.4063V1.59375H13.5313V0.875H12.0938V1.59375H4.90625V0.875H3.46875ZM2.03125 3.03125H3.46875V3.75H4.90625V3.03125H12.0938V3.75H13.5313V3.03125H14.9688V4.46875H2.03125V3.03125ZM2.03125 5.90625H14.9688V15.9688H2.03125V5.90625ZM6.34375 7.34375V8.78125H7.78125V7.34375H6.34375ZM9.21875 7.34375V8.78125H10.6563V7.34375H9.21875ZM12.0938 7.34375V8.78125H13.5313V7.34375H12.0938ZM3.46875 10.2188V11.6563H4.90625V10.2188H3.46875ZM6.34375 10.2188V11.6563H7.78125V10.2188H6.34375ZM9.21875 10.2188V11.6563H10.6563V10.2188H9.21875ZM12.0938 10.2188V11.6563H13.5313V10.2188H12.0938ZM3.46875 13.0938V14.5313H4.90625V13.0938H3.46875ZM6.34375 13.0938V14.5313H7.78125V13.0938H6.34375ZM9.21875 13.0938V14.5313H10.6563V13.0938H9.21875Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">30 décembre 2022</span>
                        </span>
                        <span
                          class="article-author d-flex align-items-center ms-4"
                        >
                          <span class="icon-author"
                            ><svg
                              width="15"
                              height="17"
                              viewBox="0 0 15 17"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M7.5 0.59375C4.72888 0.59375 2.46875 2.85388 2.46875 5.625C2.46875 7.3573 3.35315 8.89587 4.69238 9.80274C2.12903 10.9033 0.3125 13.447 0.3125 16.4063H1.75C1.75 13.2224 4.31616 10.6563 7.5 10.6563C10.6838 10.6563 13.25 13.2224 13.25 16.4063H14.6875C14.6875 13.447 12.871 10.9033 10.3076 9.80274C11.6469 8.89587 12.5313 7.3573 12.5313 5.625C12.5313 2.85388 10.2711 0.59375 7.5 0.59375ZM7.5 2.03125C9.49341 2.03125 11.0938 3.63159 11.0938 5.625C11.0938 7.61841 9.49341 9.21875 7.5 9.21875C5.50659 9.21875 3.90625 7.61841 3.90625 5.625C3.90625 3.63159 5.50659 2.03125 7.5 2.03125Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">Lara Joe</span>
                        </span>
                      </p>
                      <h2 class="article-card-heading heading_18">
                        <a class="heading_18" href="article.php">
                          Les secrets d'un sommeil réparateur.
                        </a>
                      </h2>
                      <a class="blog-card-more" href="article.php">
                        Lire l'article
                        <svg
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path d="M5 12h14" />
                          <path d="m13 6 6 6-6 6" />
                        </svg>
                      </a>
                    </div>
                  </div>
                  <div
                    class="article-slick-item"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    <div class="article-card blog-card">
                      <a class="article-card-img-wrapper" href="article.php">
                        <img loading="lazy" decoding="async"                           src="assets/img/blog/furniture-3.jpg"
                          alt="img"
                          class="article-card-img rounded"
                        />
                        <span class="article-tag article-tag-absolute rounded"
                          >Cuisine</span
                        >
                      </a>
                      <p
                        class="article-card-published text_12 d-flex align-items-center"
                      >
                        <span class="article-date d-flex align-items-center">
                          <span class="icon-publish">
                            <svg
                              width="17"
                              height="18"
                              viewBox="0 0 17 18"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M3.46875 0.875V1.59375H0.59375V17.4063H16.4063V1.59375H13.5313V0.875H12.0938V1.59375H4.90625V0.875H3.46875ZM2.03125 3.03125H3.46875V3.75H4.90625V3.03125H12.0938V3.75H13.5313V3.03125H14.9688V4.46875H2.03125V3.03125ZM2.03125 5.90625H14.9688V15.9688H2.03125V5.90625ZM6.34375 7.34375V8.78125H7.78125V7.34375H6.34375ZM9.21875 7.34375V8.78125H10.6563V7.34375H9.21875ZM12.0938 7.34375V8.78125H13.5313V7.34375H12.0938ZM3.46875 10.2188V11.6563H4.90625V10.2188H3.46875ZM6.34375 10.2188V11.6563H7.78125V10.2188H6.34375ZM9.21875 10.2188V11.6563H10.6563V10.2188H9.21875ZM12.0938 10.2188V11.6563H13.5313V10.2188H12.0938ZM3.46875 13.0938V14.5313H4.90625V13.0938H3.46875ZM6.34375 13.0938V14.5313H7.78125V13.0938H6.34375ZM9.21875 13.0938V14.5313H10.6563V13.0938H9.21875Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">30 décembre 2022</span>
                        </span>
                        <span
                          class="article-author d-flex align-items-center ms-4"
                        >
                          <span class="icon-author"
                            ><svg
                              width="15"
                              height="17"
                              viewBox="0 0 15 17"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M7.5 0.59375C4.72888 0.59375 2.46875 2.85388 2.46875 5.625C2.46875 7.3573 3.35315 8.89587 4.69238 9.80274C2.12903 10.9033 0.3125 13.447 0.3125 16.4063H1.75C1.75 13.2224 4.31616 10.6563 7.5 10.6563C10.6838 10.6563 13.25 13.2224 13.25 16.4063H14.6875C14.6875 13.447 12.871 10.9033 10.3076 9.80274C11.6469 8.89587 12.5313 7.3573 12.5313 5.625C12.5313 2.85388 10.2711 0.59375 7.5 0.59375ZM7.5 2.03125C9.49341 2.03125 11.0938 3.63159 11.0938 5.625C11.0938 7.61841 9.49341 9.21875 7.5 9.21875C5.50659 9.21875 3.90625 7.61841 3.90625 5.625C3.90625 3.63159 5.50659 2.03125 7.5 2.03125Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">Lara Joe</span>
                        </span>
                      </p>
                      <h2 class="article-card-heading heading_18">
                        <a class="heading_18" href="article.php">
                          Oreiller ou traversin : que choisir ?
                        </a>
                      </h2>
                      <a class="blog-card-more" href="article.php">
                        Lire l'article
                        <svg
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path d="M5 12h14" />
                          <path d="m13 6 6 6-6 6" />
                        </svg>
                      </a>
                    </div>
                  </div>
                  <div
                    class="article-slick-item"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    <div class="article-card blog-card">
                      <a class="article-card-img-wrapper" href="article.php">
                        <img loading="lazy" decoding="async"                           src="assets/img/blog/furniture-4.jpg"
                          alt="img"
                          class="article-card-img rounded"
                        />
                        <span class="article-tag article-tag-absolute rounded"
                          >Mobilier</span
                        >
                      </a>
                      <p
                        class="article-card-published text_12 d-flex align-items-center"
                      >
                        <span class="article-date d-flex align-items-center">
                          <span class="icon-publish">
                            <svg
                              width="17"
                              height="18"
                              viewBox="0 0 17 18"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M3.46875 0.875V1.59375H0.59375V17.4063H16.4063V1.59375H13.5313V0.875H12.0938V1.59375H4.90625V0.875H3.46875ZM2.03125 3.03125H3.46875V3.75H4.90625V3.03125H12.0938V3.75H13.5313V3.03125H14.9688V4.46875H2.03125V3.03125ZM2.03125 5.90625H14.9688V15.9688H2.03125V5.90625ZM6.34375 7.34375V8.78125H7.78125V7.34375H6.34375ZM9.21875 7.34375V8.78125H10.6563V7.34375H9.21875ZM12.0938 7.34375V8.78125H13.5313V7.34375H12.0938ZM3.46875 10.2188V11.6563H4.90625V10.2188H3.46875ZM6.34375 10.2188V11.6563H7.78125V10.2188H6.34375ZM9.21875 10.2188V11.6563H10.6563V10.2188H9.21875ZM12.0938 10.2188V11.6563H13.5313V10.2188H12.0938ZM3.46875 13.0938V14.5313H4.90625V13.0938H3.46875ZM6.34375 13.0938V14.5313H7.78125V13.0938H6.34375ZM9.21875 13.0938V14.5313H10.6563V13.0938H9.21875Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">30 décembre 2022</span>
                        </span>
                        <span
                          class="article-author d-flex align-items-center ms-4"
                        >
                          <span class="icon-author"
                            ><svg
                              width="15"
                              height="17"
                              viewBox="0 0 15 17"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M7.5 0.59375C4.72888 0.59375 2.46875 2.85388 2.46875 5.625C2.46875 7.3573 3.35315 8.89587 4.69238 9.80274C2.12903 10.9033 0.3125 13.447 0.3125 16.4063H1.75C1.75 13.2224 4.31616 10.6563 7.5 10.6563C10.6838 10.6563 13.25 13.2224 13.25 16.4063H14.6875C14.6875 13.447 12.871 10.9033 10.3076 9.80274C11.6469 8.89587 12.5313 7.3573 12.5313 5.625C12.5313 2.85388 10.2711 0.59375 7.5 0.59375ZM7.5 2.03125C9.49341 2.03125 11.0938 3.63159 11.0938 5.625C11.0938 7.61841 9.49341 9.21875 7.5 9.21875C5.50659 9.21875 3.90625 7.61841 3.90625 5.625C3.90625 3.63159 5.50659 2.03125 7.5 2.03125Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">Lara Joe</span>
                        </span>
                      </p>
                      <h2 class="article-card-heading heading_18">
                        <a class="heading_18" href="article.php">
                          Les secrets d'un sommeil réparateur.
                        </a>
                      </h2>
                      <a class="blog-card-more" href="article.php">
                        Lire l'article
                        <svg
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path d="M5 12h14" />
                          <path d="m13 6 6 6-6 6" />
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
                <div
                  class="activate-arrows show-arrows-always article-arrows arrows-white"
                ></div>
              </div>
            </div>
          </div>
        </div>
        <!-- latest blog end -->
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
                      <?php $footerGroup = 'about'; include __DIR__ . '/includes/footer-links.php'; ?>
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
                      <?php $footerGroup = 'shopping'; include __DIR__ . '/includes/footer-links.php'; ?>
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
                      <?php $footerGroup = 'help'; include __DIR__ . '/includes/footer-links.php'; ?>
                    </ul>
                  </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6 col-12 footer-widget">
                  <div class="footer-widget-inner">
                    <h4 class="footer-logo">
                      <a href="index.php"
                        ><span class="logo-text logo-text-white">Mobilier Addict</span></a>
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
                            <a href="index.php#">
                              <svg
                                class="icon icon-twitter"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M17.1452 6.62529C17.1452 6.79391 17.1452 6.94848 17.1452 7.08899C17.1452 8.35363 16.9063 9.60422 16.4286 10.8407C15.9789 12.0492 15.3185 13.1593 14.4473 14.171C13.6042 15.1827 12.4941 16.0117 11.1171 16.6581C9.76815 17.2763 8.27869 17.5855 6.64871 17.5855C4.59719 17.5855 2.71429 17.0375 1 15.9415C1.28103 15.9696 1.57611 15.9836 1.88525 15.9836C3.59953 15.9836 5.13115 15.4637 6.48009 14.4239C5.66511 14.3958 4.93443 14.1429 4.28806 13.6651C3.66979 13.1874 3.24824 12.5831 3.02342 11.8525C3.24824 11.9087 3.47307 11.9368 3.69789 11.9368C4.03513 11.9368 4.35831 11.8806 4.66745 11.7681C3.82436 11.5995 3.12178 11.178 2.55972 10.5035C1.99766 9.82904 1.71663 9.05621 1.71663 8.18501C1.71663 8.15691 1.71663 8.14286 1.71663 8.14286C2.25059 8.42389 2.81265 8.57845 3.40281 8.60656C2.30679 7.84777 1.75878 6.82201 1.75878 5.52927C1.75878 4.8548 1.9274 4.23653 2.26464 3.67447C3.19204 4.79859 4.30211 5.69789 5.59485 6.37237C6.91569 7.04684 8.33489 7.42623 9.85246 7.51054C9.79625 7.22951 9.76815 6.94848 9.76815 6.66745C9.76815 5.65574 10.1194 4.79859 10.822 4.09602C11.5527 3.36534 12.4239 3 13.4356 3C14.5035 3 15.4028 3.37939 16.1335 4.13817C16.9766 3.96956 17.7635 3.67447 18.4941 3.25293C18.2131 4.12412 17.6651 4.79859 16.8501 5.27635C17.6089 5.19204 18.3255 5.00937 19 4.72834C18.4941 5.45902 17.8759 6.09133 17.1452 6.62529Z"
                                  fill="#00234D"
                                />
                              </svg>
                            </a>
                          </li>
                          <li class="footer-social-item">
                            <a href="index.php#">
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
                            <a href="index.php#">
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
                            <a href="index.php#">
                              <svg
                                class="icon icon-tiktok"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  fill-rule="evenodd"
                                  clip-rule="evenodd"
                                  d="M13.2367 1C13.5336 3.55445 14.9591 5.0774 17.4375 5.23942V8.11251C16.0012 8.25292 14.7431 7.78307 13.2799 6.89739V12.2709C13.2799 19.0972 5.8393 21.2304 2.84795 16.3375C0.925716 13.189 2.10282 7.66426 8.26909 7.44284V10.4725C7.79933 10.5481 7.29717 10.667 6.83821 10.8236C5.46673 11.288 4.68919 12.1575 4.90518 13.6913C5.32094 16.6292 10.7097 17.4986 10.2615 11.7579V1.0054H13.2367V1Z"
                                  fill="#00234D"
                                />
                              </svg>
                            </a>
                          </li>
                          <li class="footer-social-item">
                            <a href="index.php#">
                              <svg
                                class="icon icon-youtube"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M18.7892 6.69789C18.9297 7.6815 19 8.65105 19 9.60656V10.9555L18.7892 13.8642C18.6768 14.6792 18.4379 15.2693 18.0726 15.6347C17.6792 16.0281 17.089 16.281 16.3021 16.3934C15.5433 16.4496 14.63 16.4918 13.5621 16.5199C12.5222 16.548 11.6651 16.5621 10.9906 16.5621H9.97892C6.85948 16.534 4.82201 16.4778 3.86651 16.3934C3.86651 16.3934 3.7541 16.3794 3.52927 16.3513C3.30445 16.3232 3.12178 16.2951 2.98126 16.267C2.84075 16.2389 2.65808 16.1686 2.43326 16.0562C2.23653 15.9438 2.05386 15.8033 1.88525 15.6347C1.74473 15.466 1.60422 15.2412 1.4637 14.9602C1.35129 14.6511 1.28103 14.3841 1.25293 14.1593L1.16862 13.8642C1.05621 12.8806 1 11.911 1 10.9555V9.60656L1.16862 6.69789C1.28103 5.8829 1.51991 5.29274 1.88525 4.9274C2.27869 4.50585 2.8829 4.25293 3.69789 4.16862C4.45667 4.11241 5.35597 4.07026 6.39578 4.04215C7.4356 4.01405 8.29274 4 8.96721 4H9.97892C12.5082 4 14.6159 4.05621 16.3021 4.16862C17.089 4.25293 17.6792 4.50585 18.0726 4.9274C18.185 5.03981 18.2834 5.18033 18.3677 5.34895C18.452 5.48946 18.5222 5.64403 18.5785 5.81265C18.6347 5.95316 18.6768 6.09368 18.7049 6.23419C18.733 6.37471 18.7611 6.48712 18.7892 6.57143V6.69789ZM12.4239 10.4075L13.0141 10.1124L8.16628 7.58314V12.6417L12.4239 10.4075Z"
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
                <?php $footerGroup = 'legal'; include __DIR__ . '/includes/footer-links.php'; ?>
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
              <?php $menu_mobile = true; include __DIR__ . '/includes/menu.php'; ?>
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
                  class="announcement-login announcement-text"
                  href="login.php"
                >
                  <span class="utilty-icon-wrapper">
                    <svg
                      class="icon icon-user"
                      width="24"
                      height="24"
                      viewBox="0 0 10 11"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M5 0C3.07227 0 1.5 1.57227 1.5 3.5C1.5 4.70508 2.11523 5.77539 3.04688 6.40625C1.26367 7.17188 0 8.94141 0 11H1C1 8.78516 2.78516 7 5 7C7.21484 7 9 8.78516 9 11H10C10 8.94141 8.73633 7.17188 6.95312 6.40625C7.88477 5.77539 8.5 4.70508 8.5 3.5C8.5 1.57227 6.92773 0 5 0ZM5 1C6.38672 1 7.5 2.11328 7.5 3.5C7.5 4.88672 6.38672 6 5 6C3.61328 6 2.5 4.88672 2.5 3.5C2.5 2.11328 3.61328 1 5 1Z"
                        fill="#000"
                      />
                    </svg>
                  </span>
                  <span>Connexion</span>
                </a>
              </li>
              <li class="utilty-menu-item">
                <a
                  class="header-action-item header-wishlist"
                  href="wishlist.php"
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
      <div class="offcanvas offcanvas-end" tabindex="-1" id="drawer-cart">
        <div class="offcanvas-header border-btm-black">
          <h5 class="cart-drawer-heading text_16">Votre panier (04)</h5>
          <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Fermer"
          ></button>
        </div>
        <div class="offcanvas-body p-0">
          <div
            class="cart-content-area d-flex justify-content-between flex-column"
          >
            <div class="minicart-loop custom-scrollbar">
              <!-- minicart item -->
              <div class="minicart-item d-flex">
                <div class="mini-img-wrapper">
                  <img loading="lazy" decoding="async"                     class="mini-img"
                    src="assets/img/products/real/1769999657_kRzaynhx3X.jpg"
                    alt="img"
                  />
                </div>
                <div class="product-info">
                  <h2 class="product-title">
                    <a href="index.php#">Canapé d'angle réversible Eliot</a>
                  </h2>
                  <p class="product-vendor">XS / Gris colombe</p>
                  <div
                    class="misc d-flex align-items-end justify-content-between"
                  >
                    <div
                      class="quantity d-flex align-items-center justify-content-between"
                    >
                      <button class="qty-btn dec-qty">
                        <img loading="lazy" decoding="async" src="assets/img/icon/minus.svg" alt="minus" />
                      </button>
                      <input
                        class="qty-input"
                        type="number"
                        name="qty"
                        value="1"
                        min="0"
                      />
                      <button class="qty-btn inc-qty">
                        <img loading="lazy" decoding="async" src="assets/img/icon/plus.svg" alt="plus" />
                      </button>
                    </div>
                    <div
                      class="product-remove-area d-flex flex-column align-items-end"
                    >
                      <div class="product-price">580,00 FCFA</div>
                      <a href="index.php#" class="product-remove">Supprimer</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- minicart item -->
              <div class="minicart-item d-flex">
                <div class="mini-img-wrapper">
                  <img loading="lazy" decoding="async"                     class="mini-img"
                    src="assets/img/products/real/1769999657_xCatLOv9hZ.jpg"
                    alt="img"
                  />
                </div>
                <div class="product-info">
                  <h2 class="product-title">
                    <a href="index.php#">Fauteuil lounge Vita</a>
                  </h2>
                  <p class="product-vendor">XS / Rose</p>
                  <div
                    class="misc d-flex align-items-end justify-content-between"
                  >
                    <div
                      class="quantity d-flex align-items-center justify-content-between"
                    >
                      <button class="qty-btn dec-qty">
                        <img loading="lazy" decoding="async" src="assets/img/icon/minus.svg" alt="minus" />
                      </button>
                      <input
                        class="qty-input"
                        type="number"
                        name="qty"
                        value="1"
                        min="0"
                      />
                      <button class="qty-btn inc-qty">
                        <img loading="lazy" decoding="async" src="assets/img/icon/plus.svg" alt="plus" />
                      </button>
                    </div>
                    <div
                      class="product-remove-area d-flex flex-column align-items-end"
                    >
                      <div class="product-price">580,00 FCFA</div>
                      <a href="index.php#" class="product-remove">Supprimer</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- minicart item -->
              <div class="minicart-item d-flex">
                <div class="mini-img-wrapper">
                  <img loading="lazy" decoding="async"                     class="mini-img"
                    src="assets/img/products/real/1770689632_0OTK5fkOpt.jpg"
                    alt="img"
                  />
                </div>
                <div class="product-info">
                  <h2 class="product-title">
                    <a href="index.php#">Chaise de salle à manger Sarno</a>
                  </h2>
                  <p class="product-vendor">XS / Gris colombe</p>
                  <div
                    class="misc d-flex align-items-end justify-content-between"
                  >
                    <div
                      class="quantity d-flex align-items-center justify-content-between"
                    >
                      <button class="qty-btn dec-qty">
                        <img loading="lazy" decoding="async" src="assets/img/icon/minus.svg" alt="minus" />
                      </button>
                      <input
                        class="qty-input"
                        type="number"
                        name="qty"
                        value="1"
                        min="0"
                      />
                      <button class="qty-btn inc-qty">
                        <img loading="lazy" decoding="async" src="assets/img/icon/plus.svg" alt="plus" />
                      </button>
                    </div>
                    <div
                      class="product-remove-area d-flex flex-column align-items-end"
                    >
                      <div class="product-price">580,00 FCFA</div>
                      <a href="index.php#" class="product-remove">Supprimer</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- minicart item -->
              <div class="minicart-item d-flex">
                <div class="mini-img-wrapper">
                  <img loading="lazy" decoding="async"                     class="mini-img"
                    src="assets/img/products/real/1769643261_righaaXc9N.jpg"
                    alt="img"
                  />
                </div>
                <div class="product-info">
                  <h2 class="product-title">
                    <a href="index.php#">Fauteuil lounge Vita</a>
                  </h2>
                  <p class="product-vendor">XS / Gris colombe</p>
                  <div
                    class="misc d-flex align-items-end justify-content-between"
                  >
                    <div
                      class="quantity d-flex align-items-center justify-content-between"
                    >
                      <button class="qty-btn dec-qty">
                        <img loading="lazy" decoding="async" src="assets/img/icon/minus.svg" alt="minus" />
                      </button>
                      <input
                        class="qty-input"
                        type="number"
                        name="qty"
                        value="1"
                        min="0"
                      />
                      <button class="qty-btn inc-qty">
                        <img loading="lazy" decoding="async" src="assets/img/icon/plus.svg" alt="plus" />
                      </button>
                    </div>
                    <div
                      class="product-remove-area d-flex flex-column align-items-end"
                    >
                      <div class="product-price">580,00 FCFA</div>
                      <a href="index.php#" class="product-remove">Supprimer</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="minicart-footer">
              <div class="minicart-calc-area">
                <div
                  class="minicart-calc d-flex align-items-center justify-content-between"
                >
                  <span class="cart-subtotal mb-0">Sous-total</span>
                  <span class="cart-subprice">1548,00 FCFA</span>
                </div>
                <p class="cart-taxes text-center my-4">
                  Les taxes et la livraison seront calculées lors du paiement.
                </p>
              </div>
              <div
                class="minicart-btn-area d-flex align-items-center justify-content-between"
              >
                <a href="cart.php" class="minicart-btn btn-secondary"
                  >Voir le panier</a
                >
                <a href="checkout.php" class="minicart-btn btn-primary"
                  >Paiement</a
                >
              </div>
            </div>
          </div>
          <div class="cart-empty-area text-center py-5 d-none">
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

      <?php include __DIR__ . '/includes/quickview.php'; ?>


      <!-- all js -->
      <script src="assets/js/vendor.js" defer></script>
      <script src="assets/js/main.min.js" defer></script>
    </div>
  </body>
</html>
