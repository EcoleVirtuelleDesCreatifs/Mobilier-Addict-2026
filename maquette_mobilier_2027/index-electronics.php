<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <title>Mobilier Addict</title>
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
        --body-font-weight: 300;

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
      <?php $announcement_fluid = true; include __DIR__ . '/includes/announcement.php'; ?>

      <!-- header start -->
      <header class="sticky-header header-electronics border-btm-black">
        <div class="header-top border-btm-black">
          <div class="container-fluid">
            <div class="row align-items-center">
              <div class="col-lg-3 col-md-4 col-4">
                <div class="header-logo">
                  <a href="index-electronics.php" class="logo-main">
                    <span class="logo-text">Mobilier Addict</span>
                  </a>
                </div>
              </div>
              <div class="col-lg-6 d-lg-block d-none">
                <div class="header-search">
                  <form
                    action="index-electronics.php#"
                    method="get"
                    role="search"
                    class="search-form d-flex justify-content-center"
                  >
                    <div class="field field-search">
                      <input
                        class="field-input input-reset"
                        type="search"
                        name="q"
                        value=""
                        placeholder="Rechercher"
                        autocomplete="off"
                      />
                      <button class="search-button btn-reset" type="submit">
                        <svg
                          class="icon icon-search"
                          width="20"
                          height="20"
                          viewBox="0 0 20 20"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M7.75 0.250183C11.8838 0.250183 15.25 3.61639 15.25 7.75018C15.25 9.54608 14.6201 11.1926 13.5625 12.4846L19.5391 18.4611L18.4609 19.5392L12.4844 13.5627C11.1924 14.6203 9.5459 15.2502 7.75 15.2502C3.61621 15.2502 0.25 11.884 0.25 7.75018C0.25 3.61639 3.61621 0.250183 7.75 0.250183ZM7.75 1.75018C4.42773 1.75018 1.75 4.42792 1.75 7.75018C1.75 11.0724 4.42773 13.7502 7.75 13.7502C11.0723 13.7502 13.75 11.0724 13.75 7.75018C13.75 4.42792 11.0723 1.75018 7.75 1.75018Z"
                            fill="currentColor"
                          />
                        </svg>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-lg-3 col-md-8 col-8">
                <div
                  class="header-action d-flex align-items-center justify-content-end"
                >
                  <a
                    class="header-action-item header-search d-lg-none"
                    href="javascript:void(0)"
                  >
                    <svg
                      class="icon icon-search"
                      width="20"
                      height="20"
                      viewBox="0 0 20 20"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M7.75 0.250183C11.8838 0.250183 15.25 3.61639 15.25 7.75018C15.25 9.54608 14.6201 11.1926 13.5625 12.4846L19.5391 18.4611L18.4609 19.5392L12.4844 13.5627C11.1924 14.6203 9.5459 15.2502 7.75 15.2502C3.61621 15.2502 0.25 11.884 0.25 7.75018C0.25 3.61639 3.61621 0.250183 7.75 0.250183ZM7.75 1.75018C4.42773 1.75018 1.75 4.42792 1.75 7.75018C1.75 11.0724 4.42773 13.7502 7.75 13.7502C11.0723 13.7502 13.75 11.0724 13.75 7.75018C13.75 4.42792 11.0723 1.75018 7.75 1.75018Z"
                        fill="currentColor"
                      />
                    </svg>
                  </a>
                  <a
                    class="header-action-item header-wishlist ms-4 d-none d-lg-block"
                    href="wishlist.php"
                  >
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
                        fill="currentColor"
                      />
                    </svg>
                  </a>
                  <a
                    class="header-action-item header-cart ms-4"
                    href="index-electronics.php#drawer-cart"
                    data-bs-toggle="offcanvas"
                  >
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
                        fill="currentColor"
                      />
                    </svg>
                  </a>
                  <a
                    class="header-action-item header-hamburger ms-4 d-lg-none"
                    href="index-electronics.php#drawer-menu"
                    data-bs-toggle="offcanvas"
                  >
                    <svg
                      class="icon icon-hamburger"
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <line x1="3" y1="12" x2="21" y2="12"></line>
                      <line x1="3" y1="6" x2="21" y2="6"></line>
                      <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="search-wrapper d-lg-none">
            <div class="container">
              <form action="index-electronics.php#" class="search-form d-flex align-items-center">
                <button
                  type="submit"
                  class="search-submit bg-transparent pl-0 text-start"
                >
                  <svg
                    class="icon icon-search"
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M7.75 0.250183C11.8838 0.250183 15.25 3.61639 15.25 7.75018C15.25 9.54608 14.6201 11.1926 13.5625 12.4846L19.5391 18.4611L18.4609 19.5392L12.4844 13.5627C11.1924 14.6203 9.5459 15.2502 7.75 15.2502C3.61621 15.2502 0.25 11.884 0.25 7.75018C0.25 3.61639 3.61621 0.250183 7.75 0.250183ZM7.75 1.75018C4.42773 1.75018 1.75 4.42792 1.75 7.75018C1.75 11.0724 4.42773 13.7502 7.75 13.7502C11.0723 13.7502 13.75 11.0724 13.75 7.75018C13.75 4.42792 11.0723 1.75018 7.75 1.75018Z"
                      fill="black"
                    />
                  </svg>
                </button>
                <div class="search-input mr-4">
                  <input
                    type="text"
                    placeholder="Recherchez vos produits…"
                    autocomplete="off"
                  />
                </div>
                <div class="search-close">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-close"
                  >
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="header-bottom d-lg-block d-none">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-10">
                <div class="header-bottom-inner">
                  <div class="header-category-widget">
                    <button
                      type="button"
                      class="category-btn button-reset"
                      aria-expanded="false"
                    >
                      <span class="header-category-title">
                        <svg
                          class="icon icon_24 icon-grid"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 256 256"
                        >
                          <rect width="256" height="256" fill="none" />
                          <rect
                            x="48"
                            y="48"
                            width="64"
                            height="64"
                            rx="8"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="16"
                          />
                          <rect
                            x="144"
                            y="48"
                            width="64"
                            height="64"
                            rx="8"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="16"
                          />
                          <rect
                            x="48"
                            y="144"
                            width="64"
                            height="64"
                            rx="8"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="16"
                          />
                          <rect
                            x="144"
                            y="144"
                            width="64"
                            height="64"
                            rx="8"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="16"
                          />
                        </svg>
                        <span class="category-title-text text_16"
                          >Catégories</span
                        >
                      </span>
                      <span>
                        <svg
                          class="icon icon-dropdown"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="1"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                      </span>
                    </button>
                    <div class="category-list list-unstyled">
                      <ul class="category-list-inner list-unstyled">
                        <li class="category-list-item">
                          <a
                            class="category-list-option"
                            href="collection-left-sidebar.php"
                            data-value="Desktop PC"
                          >
                            <div class="category-dropdwon-title">
                              <svg
                                class="icon icon_24 icon-desktop"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 256 256"
                              >
                                <rect width="256" height="256" fill="none" />
                                <path
                                  d="M144,184H32a16,16,0,0,1-16-16V96A16,16,0,0,1,32,80H144"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="112"
                                  y1="216"
                                  x2="64"
                                  y2="216"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="208"
                                  y1="72"
                                  x2="176"
                                  y2="72"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="208"
                                  y1="104"
                                  x2="176"
                                  y2="104"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <rect
                                  x="144"
                                  y="40"
                                  width="96"
                                  height="176"
                                  rx="8"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="88"
                                  y1="184"
                                  x2="88"
                                  y2="216"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <circle cx="192" cy="180" r="12" />
                              </svg>
                              <span class="category-dropdwon-text text_16"
                                >PC de bureau</span
                              >
                            </div>
                            <span>
                              <svg
                                class="icon icon-caret-right"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="25"
                                viewBox="0 0 24 25"
                                fill="none"
                              >
                                <g opacity="1">
                                  <path
                                    d="M9 18.6842L15 12.6842L9 6.6842"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                              </svg>
                            </span>
                          </a>
                          <div class="category-submenu-wrap">
                            <div class="category-submenu-inner">
                              <div class="category-submenu-block">
                                <ul class="category-submenu-list">
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        PC de bureau
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            PC tout-en-un
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            PC de marque
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Mini PC
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Composants
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                           SSD
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Carte mère
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Processeur
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Écrans
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Alimentation
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Accessoires
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Clavier
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Souris
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Tapis de souris
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Ruban LED
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Support de carte graphique
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item has-image">
                                    <a
                                      href="product.php"
                                      class="category-submenu-image"
                                      aria-label="lien sous-menu"
                                    >
                                      <img loading="lazy" decoding="async"                                         src="assets/img/products/real/1770689632_0OTK5fkOpt.jpg"
                                        alt="image produit"
                                        width="1100"
                                        height="600"
                                        loading="lazy"
                                      />
                                    </a>
                                    <a
                                      href="product.php"
                                      class="submenu-product-title heading_20"
                                      aria-label="titre sous-menu"
                                    >
                                      Nouveaux portables
                                    </a>
                                  </li>
                                </ul>
                              </div>
                              <a
                                class="category-menu-bottom"
                                href="collection-left-sidebar.php"
                              >
                                <div class="category-bottom-content">
                                  <div
                                    class="category-bottom-subheading subheading heading_18 medium"
                                  >
                                    Soldes du vendredi
                                  </div>
                                  <h3
                                    class="category-bottom-heading heading_32"
                                  >
                                    Rendez votre maison plus intelligente
                                  </h3>
                                </div>
                                <div class="category-bottom-image">
                                  <img loading="lazy" decoding="async"                                     src="assets/img/banner/img-banner6.png"
                                    alt="image de bannière"
                                    width="1100"
                                    height="600"
                                    loading="lazy"
                                  />
                                </div>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="category-list-item">
                          <a
                            class="category-list-option text"
                            href="collection-left-sidebar.php"
                            data-value="Laptop"
                          >
                            <div class="category-dropdwon-title">
                              <svg
                                class="icon icon_24 icon-laptop"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 256 256"
                              >
                                <rect width="256" height="256" fill="none" />
                                <path
                                  d="M40,176V72A16,16,0,0,1,56,56H200a16,16,0,0,1,16,16V176"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <path
                                  d="M24,176H232a0,0,0,0,1,0,0v16a16,16,0,0,1-16,16H40a16,16,0,0,1-16-16V176A0,0,0,0,1,24,176Z"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="144"
                                  y1="88"
                                  x2="112"
                                  y2="88"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                              </svg>
                              <span class="category-dropdwon-text text_16"
                                >Portable</span
                              >
                            </div>
                            <span>
                              <svg
                                class="icon icon-caret-right"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="25"
                                viewBox="0 0 24 25"
                                fill="none"
                              >
                                <g opacity="1">
                                  <path
                                    d="M9 18.6842L15 12.6842L9 6.6842"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                              </svg>
                            </span>
                          </a>
                          <div class="category-submenu-wrap">
                            <div class="category-submenu-inner">
                              <div class="category-submenu-block">
                                <ul class="category-submenu-list">
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Tous les portables
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Portable gaming
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Portable professionnel
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Portable tactile
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Marque
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                           Apple
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Asus
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Dell
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Gigabyte
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            HP
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Lenovo
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Accessoires
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            RAM pour portable
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Refroidisseur pour portable
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Sacoche pour portable
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Batterie
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Adaptateur
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item has-image">
                                    <a
                                      href="product.php"
                                      class="category-submenu-image"
                                      aria-label="lien sous-menu"
                                    >
                                      <img loading="lazy" decoding="async"                                         src="assets/img/products/real/1769643261_righaaXc9N.jpg"
                                        alt="image produit"
                                        width="1100"
                                        height="600"
                                        loading="lazy"
                                      />
                                    </a>
                                    <a
                                      href="product.php"
                                      class="submenu-product-title heading_20"
                                      aria-label="titre sous-menu"
                                    >
                                      Nouveaux portables
                                    </a>
                                  </li>
                                </ul>
                              </div>
                              <a
                                class="category-menu-bottom"
                                href="collection-left-sidebar.php"
                              >
                                <div class="category-bottom-content">
                                  <div
                                    class="category-bottom-subheading subheading heading_18 medium"
                                  >
                                    Soldes du vendredi
                                  </div>
                                  <h3
                                    class="category-bottom-heading heading_32"
                                  >
                                    Rendez votre maison plus intelligente
                                  </h3>
                                </div>
                                <div class="category-bottom-image">
                                  <img loading="lazy" decoding="async"                                     src="assets/img/banner/img-banner6.png"
                                    alt="image de bannière"
                                    width="1100"
                                    height="600"
                                    loading="lazy"
                                  />
                                </div>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="category-list-item">
                          <a
                            class="category-list-option text"
                            href="collection-left-sidebar.php"
                            data-value="Processor"
                          >
                            <div class="category-dropdwon-title">
                              <svg
                                class="icon icon_24 icon-processor"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 256 256"
                              >
                                <rect width="256" height="256" fill="none" />
                                <rect
                                  x="104"
                                  y="104"
                                  width="48"
                                  height="48"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <rect
                                  x="48"
                                  y="48"
                                  width="160"
                                  height="160"
                                  rx="8"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="208"
                                  y1="104"
                                  x2="232"
                                  y2="104"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="208"
                                  y1="152"
                                  x2="232"
                                  y2="152"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="24"
                                  y1="104"
                                  x2="48"
                                  y2="104"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="24"
                                  y1="152"
                                  x2="48"
                                  y2="152"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="152"
                                  y1="208"
                                  x2="152"
                                  y2="232"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="104"
                                  y1="208"
                                  x2="104"
                                  y2="232"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="152"
                                  y1="24"
                                  x2="152"
                                  y2="48"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="104"
                                  y1="24"
                                  x2="104"
                                  y2="48"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                              </svg>
                              <span class="category-dropdwon-text text_16"
                                >Processeur</span
                              >
                            </div>
                            <span>
                              <svg
                                class="icon icon-caret-right"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="25"
                                viewBox="0 0 24 25"
                                fill="none"
                              >
                                <g opacity="1">
                                  <path
                                    d="M9 18.6842L15 12.6842L9 6.6842"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                              </svg>
                            </span>
                          </a>
                          <div class="category-submenu-wrap">
                            <div class="category-submenu-inner">
                              <div class="category-submenu-block">
                                <ul class="category-submenu-list">
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Processeurs Intel
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Core i3, i5, i7, i9
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Pentium
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Celeron
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Xeon
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Core Ultra
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Processeurs AMD
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Ryzen 3
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Ryzen 5
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Ryzen 7
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Ryzen 9
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Accessoires
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Ventirad
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Pâte thermique
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Contrôleur de ventilateur
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Carte mère
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            RAM
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item has-image">
                                    <a
                                      href="product.php"
                                      class="category-submenu-image"
                                      aria-label="lien sous-menu"
                                    >
                                      <img loading="lazy" decoding="async"                                         src="assets/img/products/real/1770691758_oLpAhmB0Wd.jpg"
                                        alt="image produit"
                                        width="1100"
                                        height="600"
                                        loading="lazy"
                                      />
                                    </a>
                                    <a
                                      href="product.php"
                                      class="submenu-product-title heading_20"
                                      aria-label="titre sous-menu"
                                    >
                                      Nouveau processeur
                                    </a>
                                  </li>
                                </ul>
                              </div>
                              <a
                                class="category-menu-bottom"
                                href="collection-left-sidebar.php"
                              >
                                <div class="category-bottom-content">
                                  <div
                                    class="category-bottom-subheading subheading heading_18 medium"
                                  >
                                    Soldes du vendredi
                                  </div>
                                  <h3
                                    class="category-bottom-heading heading_32"
                                  >
                                    Rendez votre maison plus intelligente
                                  </h3>
                                </div>
                                <div class="category-bottom-image">
                                  <img loading="lazy" decoding="async"                                     src="assets/img/banner/img-banner6.png"
                                    alt="image de bannière"
                                    width="1100"
                                    height="600"
                                    loading="lazy"
                                  />
                                </div>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="category-list-item">
                          <a
                            class="category-list-option text"
                            href="collection-left-sidebar.php"
                            data-value="Graphics Card"
                          >
                            <div class="category-dropdwon-title">
                              <svg
                                class="icon icon_24 icon-graphics-card"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 256 256"
                              >
                                <rect width="256" height="256" fill="none" />
                                <path
                                  d="M16,184H232a8,8,0,0,0,8-8V64a8,8,0,0,0-8-8H16V208"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <circle
                                  cx="176"
                                  cy="120"
                                  r="32"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="80"
                                  y1="208"
                                  x2="80"
                                  y2="184"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="48"
                                  y1="184"
                                  x2="48"
                                  y2="208"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="112"
                                  y1="208"
                                  x2="112"
                                  y2="184"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="153.37"
                                  y1="97.37"
                                  x2="198.63"
                                  y2="142.63"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <circle
                                  cx="80"
                                  cy="120"
                                  r="32"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="57.37"
                                  y1="97.37"
                                  x2="102.63"
                                  y2="142.63"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                              </svg>
                              <span class="category-dropdwon-text text_16"
                                >Carte graphique</span
                              >
                            </div>
                            <span>
                              <svg
                                class="icon icon-caret-right"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="25"
                                viewBox="0 0 24 25"
                                fill="none"
                              >
                                <g opacity="1">
                                  <path
                                    d="M9 18.6842L15 12.6842L9 6.6842"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                              </svg>
                            </span>
                          </a>
                          <div class="category-submenu-wrap">
                            <div class="category-submenu-inner">
                              <div class="category-submenu-block">
                                <ul class="category-submenu-list">
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Nvidia GeForce
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            RTX 4090
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            RTX 4080
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            RTX 4070
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            GTX 1660
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            GTX 1650
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        AMD Radeon
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            RX 7900 XTX
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                             RX 7800 XT
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            RX 6800 XT
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Accessoires
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Supports de carte graphique
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Câbles et rallonges PCIe
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Ponts multi-GPU
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Adaptateurs
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Bombe à air
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item has-image">
                                    <a
                                      href="product.php"
                                      class="category-submenu-image"
                                      aria-label="lien sous-menu"
                                    >
                                      <img loading="lazy" decoding="async"                                         src="assets/img/products/real/1770691758_zO2jmRAXwA.jpg"
                                        alt="image produit"
                                        width="1100"
                                        height="600"
                                        loading="lazy"
                                      />
                                    </a>
                                    <a
                                      href="product.php"
                                      class="submenu-product-title heading_20"
                                      aria-label="titre sous-menu"
                                    >
                                      Nouveaux visuels
                                    </a>
                                  </li>
                                </ul>
                              </div>
                              <a
                                class="category-menu-bottom"
                                href="collection-left-sidebar.php"
                              >
                                <div class="category-bottom-content">
                                  <div
                                    class="category-bottom-subheading subheading heading_18 medium"
                                  >
                                    Soldes du vendredi
                                  </div>
                                  <h3
                                    class="category-bottom-heading heading_32"
                                  >
                                    Rendez votre maison plus intelligente
                                  </h3>
                                </div>
                                <div class="category-bottom-image">
                                  <img loading="lazy" decoding="async"                                     src="assets/img/banner/img-banner6.png"
                                    alt="image de bannière"
                                    width="1100"
                                    height="600"
                                    loading="lazy"
                                  />
                                </div>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="category-list-item">
                          <a
                            class="category-list-option text"
                            href="collection-left-sidebar.php"
                            data-value="Storage"
                          >
                            <div class="category-dropdwon-title">
                              <svg
                                class="icon icon_24 icon-storage"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 256 256"
                              >
                                <rect width="256" height="256" fill="none" />
                                <path
                                  d="M24,64H232a8,8,0,0,1,8,8V176a0,0,0,0,1,0,0H16a0,0,0,0,1,0,0V72A8,8,0,0,1,24,64Z"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="16"
                                  y1="176"
                                  x2="16"
                                  y2="200"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="48"
                                  y1="176"
                                  x2="48"
                                  y2="200"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="80"
                                  y1="176"
                                  x2="80"
                                  y2="200"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="112"
                                  y1="176"
                                  x2="112"
                                  y2="200"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="144"
                                  y1="176"
                                  x2="144"
                                  y2="200"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="176"
                                  y1="176"
                                  x2="176"
                                  y2="200"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="208"
                                  y1="176"
                                  x2="208"
                                  y2="200"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="240"
                                  y1="176"
                                  x2="240"
                                  y2="200"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <rect
                                  x="48"
                                  y="96"
                                  width="64"
                                  height="48"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <rect
                                  x="144"
                                  y="96"
                                  width="64"
                                  height="48"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                              </svg>
                              <span class="category-dropdwon-text text_16"
                                >Stockage</span
                              >
                            </div>
                            <span>
                              <svg
                                class="icon icon-caret-right"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="25"
                                viewBox="0 0 24 25"
                                fill="none"
                              >
                                <g opacity="1">
                                  <path
                                    d="M9 18.6842L15 12.6842L9 6.6842"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                              </svg>
                            </span>
                          </a>
                          <div class="category-submenu-wrap">
                            <div class="category-submenu-inner">
                              <div class="category-submenu-block">
                                <ul class="category-submenu-list">
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Stockage
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Toutes les cartes graphiques
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Sur mesure
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            CPU
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Écrans
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            De marque
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Écrans
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Tous les PC de bureau
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Sur mesure
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            CPU
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Écrans
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            De marque
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Accessoires
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Tous les PC de bureau
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Sur mesure
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            CPU
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Écrans
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            De marque
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item has-image">
                                    <a
                                      href="product.php"
                                      class="category-submenu-image"
                                      aria-label="lien sous-menu"
                                    >
                                      <img loading="lazy" decoding="async"                                         src="assets/img/products/real/1770738680_YSa0YK1dz1.jpg"
                                        alt="image produit"
                                        width="1100"
                                        height="600"
                                        loading="lazy"
                                      />
                                    </a>
                                    <a
                                      href="product.php"
                                      class="submenu-product-title heading_20"
                                      aria-label="titre sous-menu"
                                    >
                                      Nouveaux visuels
                                    </a>
                                  </li>
                                </ul>
                              </div>
                              <a
                                class="category-menu-bottom"
                                href="collection-left-sidebar.php"
                              >
                                <div class="category-bottom-content">
                                  <div
                                    class="category-bottom-subheading subheading heading_18 medium"
                                  >
                                    Soldes du vendredi
                                  </div>
                                  <h3
                                    class="category-bottom-heading heading_32"
                                  >
                                    Rendez votre maison plus intelligente
                                  </h3>
                                </div>
                                <div class="category-bottom-image">
                                  <img loading="lazy" decoding="async"                                     src="assets/img/banner/img-banner6.png"
                                    alt="image de bannière"
                                    width="1100"
                                    height="600"
                                    loading="lazy"
                                  />
                                </div>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="category-list-item">
                          <a
                            class="category-list-option text"
                            href="collection-left-sidebar.php"
                            data-value="Network Tools"
                          >
                            <div class="category-dropdwon-title">
                              <svg
                                class="icon icon_24 icon-router"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 256 256"
                              >
                                <rect width="256" height="256" fill="none" />
                                <polyline
                                  points="56 232 128 88 200 232"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <path
                                  d="M88.64,95.17a40,40,0,1,1,78.72,0"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <path
                                  d="M70.53,131.38a72,72,0,1,1,114.94,0"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="72"
                                  y1="200"
                                  x2="184"
                                  y2="200"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="88"
                                  y1="168"
                                  x2="168"
                                  y2="168"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                              </svg>
                              <span class="category-dropdwon-text text_16"
                                >Outils réseau</span
                              >
                            </div>
                            <span>
                              <svg
                                class="icon icon-caret-right"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="25"
                                viewBox="0 0 24 25"
                                fill="none"
                              >
                                <g opacity="1">
                                  <path
                                    d="M9 18.6842L15 12.6842L9 6.6842"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                              </svg>
                            </span>
                          </a>
                          <div class="category-submenu-wrap">
                            <div class="category-submenu-inner">
                              <div class="category-submenu-block">
                                <ul class="category-submenu-list">
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                       Routeur
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Toutes les marques
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Asus
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            C-net
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Cisco
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            D-Link
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Composants
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Répéteur
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Carte réseau
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Adaptateur Wi-Fi
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Câble réseau
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Modem
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Accessoires
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Connecteur
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Plaque frontale
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Câble LAN
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Panneau de brassage
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Modulaire
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item has-image">
                                    <a
                                      href="product.php"
                                      class="category-submenu-image"
                                      aria-label="lien sous-menu"
                                    >
                                      <img loading="lazy" decoding="async"                                         src="assets/img/products/real/1770738680_Z9FYQSbomB.jpg"
                                        alt="image produit"
                                        width="1100"
                                        height="600"
                                        loading="lazy"
                                      />
                                    </a>
                                    <a
                                      href="product.php"
                                      class="submenu-product-title heading_20"
                                      aria-label="titre sous-menu"
                                    >
                                      Nouveaux visuels
                                    </a>
                                  </li>
                                </ul>
                              </div>
                              <a
                                class="category-menu-bottom"
                                href="collection-left-sidebar.php"
                              >
                                <div class="category-bottom-content">
                                  <div
                                    class="category-bottom-subheading subheading heading_18 medium"
                                  >
                                    Soldes du vendredi
                                  </div>
                                  <h3
                                    class="category-bottom-heading heading_32"
                                  >
                                    Rendez votre maison plus intelligente
                                  </h3>
                                </div>
                                <div class="category-bottom-image">
                                  <img loading="lazy" decoding="async"                                     src="assets/img/banner/img-banner6.png"
                                    alt="image de bannière"
                                    width="1100"
                                    height="600"
                                    loading="lazy"
                                  />
                                </div>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="category-list-item">
                          <a
                            class="category-list-option text"
                            href="collection-left-sidebar.php"
                            data-value="Audio Devices"
                          >
                            <div class="category-dropdwon-title">
                              <svg
                                class="icon icon_24 icon-audio"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 256 256"
                              >
                                <rect width="256" height="256" fill="none" />
                                <path
                                  d="M224,128H192a16,16,0,0,0-16,16v40a16,16,0,0,0,16,16h16a16,16,0,0,0,16-16V128a96,96,0,1,0-192,0v56a16,16,0,0,0,16,16H64a16,16,0,0,0,16-16V144a16,16,0,0,0-16-16H32"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                              </svg>
                              <span class="category-dropdwon-text text_16"
                                >Périphériques audio</span
                              >
                            </div>
                            <span>
                              <svg
                                class="icon icon-caret-right"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="25"
                                viewBox="0 0 24 25"
                                fill="none"
                              >
                                <g opacity="1">
                                  <path
                                    d="M9 18.6842L15 12.6842L9 6.6842"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                              </svg>
                            </span>
                          </a>
                          <div class="category-submenu-wrap">
                            <div class="category-submenu-inner">
                              <div class="category-submenu-block">
                                <ul class="category-submenu-list">
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Enceinte
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Enceinte connectée
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Enceinte Bluetooth
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Barre de son
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                      Casque
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Casque circum-aural
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Tour de cou
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Écouteurs
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Accessoires
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                           Dictaphone
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Convertisseur
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item has-image">
                                    <a
                                      href="product.php"
                                      class="category-submenu-image"
                                      aria-label="lien sous-menu"
                                    >
                                      <img loading="lazy" decoding="async"                                         src="assets/img/products/real/1769651796_8nTO7f2rrg.jpg"
                                        alt="image produit"
                                        width="1100"
                                        height="600"
                                        loading="lazy"
                                      />
                                    </a>
                                    <a
                                      href="product.php"
                                      class="submenu-product-title heading_20"
                                      aria-label="titre sous-menu"
                                    >
                                      Nouveaux visuels
                                    </a>
                                  </li>
                                </ul>
                              </div>
                              <a
                                class="category-menu-bottom"
                                href="collection-left-sidebar.php"
                              >
                                <div class="category-bottom-content">
                                  <div
                                    class="category-bottom-subheading subheading heading_18 medium"
                                  >
                                    Soldes du vendredi
                                  </div>
                                  <h3
                                    class="category-bottom-heading heading_32"
                                  >
                                    Rendez votre maison plus intelligente
                                  </h3>
                                </div>
                                <div class="category-bottom-image">
                                  <img loading="lazy" decoding="async"                                     src="assets/img/banner/img-banner6.png"
                                    alt="image de bannière"
                                    width="1100"
                                    height="600"
                                    loading="lazy"
                                  />
                                </div>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="category-list-item">
                          <a
                            class="category-list-option text"
                            href="collection-left-sidebar.php"
                            data-value="Printing"
                          >
                            <div class="category-dropdwon-title">
                              <svg
                                class="icon icon_24 icon-printer"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 256 256"
                              >
                                <rect width="256" height="256" fill="none" />
                                <polyline
                                  points="64 80 64 40 192 40 192 80"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <rect
                                  x="64"
                                  y="152"
                                  width="128"
                                  height="64"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <path
                                  d="M64,176H24V96c0-8.84,7.76-16,17.33-16H214.67C224.24,80,232,87.16,232,96v80H192"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <circle cx="188" cy="116" r="12" />
                              </svg>
                              <span class="category-dropdwon-text text_16"
                                >Impression</span
                              >
                            </div>
                            <span>
                              <svg
                                class="icon icon-caret-right"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="25"
                                viewBox="0 0 24 25"
                                fill="none"
                              >
                                <g opacity="1">
                                  <path
                                    d="M9 18.6842L15 12.6842L9 6.6842"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                              </svg>
                            </span>
                          </a>
                          <div class="category-submenu-wrap">
                            <div class="category-submenu-inner">
                              <div class="category-submenu-block">
                                <ul class="category-submenu-list">
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Imprimante
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Imprimantes jet d'encre
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Imprimantes laser
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Imprimantes LED
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Marque
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Brother
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Canon
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            HP
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            pantum
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Accessoires
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Toner
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Cartouche
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Ruban
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Recharge
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item has-image">
                                    <a
                                      href="product.php"
                                      class="category-submenu-image"
                                      aria-label="lien sous-menu"
                                    >
                                      <img loading="lazy" decoding="async"                                         src="assets/img/products/real/1769999657_1CIVZl8UG6.jpg"
                                        alt="image produit"
                                        width="1100"
                                        height="600"
                                        loading="lazy"
                                      />
                                    </a>
                                    <a
                                      href="product.php"
                                      class="submenu-product-title heading_20"
                                      aria-label="titre sous-menu"
                                    >
                                      Nouveaux visuels
                                    </a>
                                  </li>
                                </ul>
                              </div>
                              <a
                                class="category-menu-bottom"
                                href="collection-left-sidebar.php"
                              >
                                <div class="category-bottom-content">
                                  <div
                                    class="category-bottom-subheading subheading heading_18 medium"
                                  >
                                    Soldes du vendredi
                                  </div>
                                  <h3
                                    class="category-bottom-heading heading_32"
                                  >
                                    Rendez votre maison plus intelligente
                                  </h3>
                                </div>
                                <div class="category-bottom-image">
                                  <img loading="lazy" decoding="async"                                     src="assets/img/banner/img-banner6.png"
                                    alt="image de bannière"
                                    width="1100"
                                    height="600"
                                    loading="lazy"
                                  />
                                </div>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="category-list-item">
                          <a
                            class="category-list-option text"
                            href="collection-left-sidebar.php"
                            data-value="Gadget"
                          >
                            <div class="category-dropdwon-title">
                              <svg
                                class="icon icon_24 icon-watch"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 256 256"
                              >
                                <rect width="256" height="256" fill="none" />
                                <circle
                                  cx="128"
                                  cy="128"
                                  r="72"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-miterlimit="10"
                                  stroke-width="16"
                                />
                                <path
                                  d="M88,68.13l6.81-37.56A8,8,0,0,1,102.68,24h50.64a8,8,0,0,1,7.87,6.57L168,68.13"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <path
                                  d="M88,187.87l6.81,37.56a8,8,0,0,0,7.87,6.57h50.64a8,8,0,0,0,7.87-6.57L168,187.87"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <polyline
                                  points="128 88 128 128 168 128"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                              </svg>
                              <span class="category-dropdwon-text text_16"
                                >Gadget</span
                              >
                            </div>
                            <span>
                              <svg
                                class="icon icon-caret-right"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="25"
                                viewBox="0 0 24 25"
                                fill="none"
                              >
                                <g opacity="1">
                                  <path
                                    d="M9 18.6842L15 12.6842L9 6.6842"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                              </svg>
                            </span>
                          </a>
                          <div class="category-submenu-wrap">
                            <div class="category-submenu-inner">
                              <div class="category-submenu-block">
                                <ul class="category-submenu-list">
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Chargeur et adaptateur
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Chargeur sans fil
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Câble et adaptateur
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Câble
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Adaptateur
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Quotidien
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Répéteur
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Balance connectée
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Veilleuse à capteur
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Sacoche pour portable
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Brosse à dents électrique
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Accessoires
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Chargeur voiture
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Support téléphone
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Perche à selfie
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Nettoyant écran
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item has-image">
                                    <a
                                      href="product.php"
                                      class="category-submenu-image"
                                      aria-label="lien sous-menu"
                                    >
                                      <img loading="lazy" decoding="async"                                         src="assets/img/products/real/1769999657_xCatLOv9hZ.jpg"
                                        alt="image produit"
                                        width="1100"
                                        height="600"
                                        loading="lazy"
                                      />
                                    </a>
                                    <a
                                      href="product.php"
                                      class="submenu-product-title heading_20"
                                      aria-label="titre sous-menu"
                                    >
                                      Nouveaux visuels
                                    </a>
                                  </li>
                                </ul>
                              </div>
                              <a
                                class="category-menu-bottom"
                                href="collection-left-sidebar.php"
                              >
                                <div class="category-bottom-content">
                                  <div
                                    class="category-bottom-subheading subheading heading_18 medium"
                                  >
                                    Soldes du vendredi
                                  </div>
                                  <h3
                                    class="category-bottom-heading heading_32"
                                  >
                                    Rendez votre maison plus intelligente
                                  </h3>
                                </div>
                                <div class="category-bottom-image">
                                  <img loading="lazy" decoding="async"                                     src="assets/img/banner/img-banner6.png"
                                    alt="image de bannière"
                                    width="1100"
                                    height="600"
                                    loading="lazy"
                                  />
                                </div>
                              </a>
                            </div>
                          </div>
                        </li>
                        <li class="category-list-item">
                          <a
                            class="category-list-option text"
                            href="collection-left-sidebar.php"
                            data-value="Gadget"
                          >
                            <div class="category-dropdwon-title">
                              <svg
                                class="icon icon_24 icon-watch"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 256 256"
                              >
                                <rect width="256" height="256" fill="none" />
                                <rect
                                  x="24"
                                  y="56"
                                  width="208"
                                  height="144"
                                  rx="8"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="56"
                                  y1="128"
                                  x2="200"
                                  y2="128"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="56"
                                  y1="96"
                                  x2="200"
                                  y2="96"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="56"
                                  y1="160"
                                  x2="64"
                                  y2="160"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="96"
                                  y1="160"
                                  x2="160"
                                  y2="160"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                                <line
                                  x1="192"
                                  y1="160"
                                  x2="200"
                                  y2="160"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="16"
                                />
                              </svg>
                              <span class="category-dropdwon-text text_16"
                                >Accessoires</span
                              >
                            </div>
                            <span>
                              <svg
                                class="icon icon-caret-right"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="25"
                                viewBox="0 0 24 25"
                                fill="none"
                              >
                                <g opacity="1">
                                  <path
                                    d="M9 18.6842L15 12.6842L9 6.6842"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                              </svg>
                            </span>
                          </a>
                          <div class="category-submenu-wrap">
                            <div class="category-submenu-inner">
                              <div class="category-submenu-block">
                                <ul class="category-submenu-list">
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Alimentation électrique
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Câble d'alimentation
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Prise
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Mini onduleur
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Santé et bien-être
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Purificateur d'air
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Purificateur d'eau
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Humidificateur
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Déshumidificateur
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item">
                                    <div class="mega-menu-header">
                                      <span class="text_14 megamenu-heading">
                                        Électroménager
                                      </span>
                                    </div>
                                    <div class="category-submenu">
                                      <ul class="list-unstyled">
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="product.php"
                                          >
                                            Aspirateur
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-left-sidebar.php"
                                          >
                                            Lave-linge
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-right-sidebar.php"
                                          >
                                            Ventilateur portable
                                          </a>
                                        </li>
                                        <li class="menu-list-item nav-item-sub">
                                          <a
                                            class="nav-link-sub text_14"
                                            href="collection-without-sidebar.php"
                                          >
                                            Caméra de sécurité
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </li>
                                  <li class="category-submenu-item has-image">
                                    <a
                                      href="product.php"
                                      class="category-submenu-image"
                                      aria-label="lien sous-menu"
                                    >
                                      <img loading="lazy" decoding="async"                                         src="assets/img/products/real/1769993520_r5wT4mQ4N8.jpg"
                                        alt="image produit"
                                        width="1100"
                                        height="600"
                                        loading="lazy"
                                      />
                                    </a>
                                    <a
                                      href="product.php"
                                      class="submenu-product-title heading_20"
                                      aria-label="titre sous-menu"
                                    >
                                      Nouveaux visuels
                                    </a>
                                  </li>
                                </ul>
                              </div>
                              <a
                                class="category-menu-bottom"
                                href="collection-left-sidebar.php"
                              >
                                <div class="category-bottom-content">
                                  <div
                                    class="category-bottom-subheading subheading heading_18 medium"
                                  >
                                    Soldes du vendredi
                                  </div>
                                  <h3
                                    class="category-bottom-heading heading_32"
                                  >
                                    Rendez votre maison plus intelligente
                                  </h3>
                                </div>
                                <div class="category-bottom-image">
                                  <img loading="lazy" decoding="async"                                     src="assets/img/banner/img-banner6.png"
                                    alt="image de bannière"
                                    width="1100"
                                    height="600"
                                    loading="lazy"
                                  />
                                </div>
                              </a>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <nav class="site-navigation">
                    <?php include __DIR__ . '/includes/menu.php'; ?>
                  </nav>
                </div>
              </div>
              <div class="col-lg-2">
                <div class="member-signup d-flex justify-content-end">
                  <a href="about-us.php" class="btn-member">Centre de service</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- header end -->

      <main id="MainContent" class="content-for-layout">
        <!-- slideshow start -->
        <div class="slideshow-section slideshow-electronics position-relative">
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
            <div class="slide-item position-relative overlay">
              <img loading="eager" fetchpriority="high"                 class="slide-img d-none d-md-block"
                src="assets/img/slideshow/e1.jpg"
                alt="slide-1"
              />
              <img loading="eager" fetchpriority="high"                 class="slide-img d-md-none"
                src="assets/img/slideshow/e1.jpg"
                alt="slide-1"
              />
              <div class="content-absolute content-slide">
                <div
                  class="container height-inherit d-flex align-items-center justify-content-center"
                >
                  <div class="content-box slide-content py-4 text-center">
                    <p
                      class="slide-subheading text_16 text-white animate__animated animate__fadeInUp"
                      data-animation="animate__animated animate__fadeInUp"
                    >
                      Offre spéciale
                    </p>
                    <h2
                      class="slide-heading heading_56 text-white animate__animated animate__fadeInUp"
                      data-animation="animate__animated animate__fadeInUp"
                    >
                      Plus de 56 % de remise pour les nouveaux clients
                    </h2>
                    <a
                      class="btn-primary slide-btn animate__animated animate__fadeInUp"
                      href="collection-left-sidebar.php"
                      data-animation="animate__animated animate__fadeInUp"
                      >Voir plus</a
                    >
                  </div>
                </div>
              </div>
            </div>
            <div class="slide-item position-relative overlay">
              <img loading="lazy" decoding="async"                 class="slide-img d-none d-md-block"
                src="assets/img/slideshow/e2.jpg"
                alt="slide-2"
              />
              <img loading="lazy" decoding="async"                 class="slide-img d-md-none"
                src="assets/img/slideshow/e2.jpg"
                alt="slide-2"
              />
              <div class="content-absolute content-slide">
                <div
                  class="container height-inherit d-flex align-items-center justify-content-center"
                >
                  <div class="content-box slide-content py-4 text-center">
                    <p
                      class="slide-subheading text_16 text-white animate__animated animate__fadeInUp"
                      data-animation="animate__animated animate__fadeInUp"
                    >
                      Offre spéciale
                    </p>
                    <h2
                      class="slide-heading heading_56 text-white animate__animated animate__fadeInUp"
                      data-animation="animate__animated animate__fadeInUp"
                    >
                      Plus de 56 % de remise pour les nouveaux clients
                    </h2>
                    <a
                      class="btn-primary slide-btn animate__animated animate__fadeInUp"
                      href="collection-left-sidebar.php"
                      data-animation="animate__animated animate__fadeInUp"
                      >Voir plus</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="activate-arrows arrows-white"></div>
          <div class="activate-dots dots-white"></div>
        </div>
        <!-- slideshow end -->

        <!-- category slider start -->
        <div class="mt-60 home-section">
          <div
            class="section-category-slider aos-init aos-animate"
            data-aos="fade-up"
            data-aos-duration="700"
          >
            <div class="container">
              <div class="row overflow-lg-x-auto overflow-y-hidden flex-nowrap">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-6 col-6">
                  <a
                    href="collection-left-sidebar.php"
                    class="category-block category-block-2 heading_18 medium"
                  >
                    <img loading="lazy" decoding="async"                       src="assets/img/trusted/laptop.png"
                      alt="image"
                      width="1100"
                      height="600"
                      loading="lazy"
                    />
                    <span class="collection-title">Portable</span>
                  </a>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-6 col-6">
                  <a
                    href="collection-left-sidebar.php"
                    class="category-block category-block-2 heading_18 medium"
                  >
                    <img loading="lazy" decoding="async"                       src="assets/img/trusted/desktop.png"
                      alt="image"
                      width="1100"
                      height="600"
                      loading="lazy"
                    />
                    <span class="collection-title">PC de bureau</span>
                  </a>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-6 col-6">
                  <a
                    href="collection-left-sidebar.php"
                    class="category-block category-block-2 heading_18 medium"
                  >
                    <img loading="lazy" decoding="async"                       src="assets/img/trusted/headset.png"
                      alt="image"
                      width="1100"
                      height="600"
                      loading="lazy"
                    />
                    <span class="collection-title">Audio</span>
                  </a>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-6 col-6">
                  <a
                    href="collection-left-sidebar.php"
                    class="category-block category-block-2 heading_18 medium"
                  >
                    <img loading="lazy" decoding="async"                       src="assets/img/trusted/graphics.png"
                      alt="image"
                      width="1100"
                      height="600"
                      loading="lazy"
                    />
                    <span class="collection-title">Cartes graphiques</span>
                  </a>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-6 col-6">
                  <a
                    href="collection-left-sidebar.php"
                    class="category-block category-block-2 heading_18 medium"
                  >
                    <img loading="lazy" decoding="async"                       src="assets/img/trusted/processor.png"
                      alt="image"
                      width="1100"
                      height="600"
                      loading="lazy"
                    />
                    <span class="collection-title">Processeur</span>
                  </a>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-6 col-6">
                  <a
                    href="collection-left-sidebar.php"
                    class="category-block category-block-2 heading_18 medium"
                  >
                    <img loading="lazy" decoding="async"                       src="assets/img/trusted/storage.png"
                      alt="image"
                      width="1100"
                      height="600"
                      loading="lazy"
                    />
                    <span class="collection-title">Stockage</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- category slider end -->

        <!-- Collage start -->
        <div class="section-collage mt-100 mb-100">
          <div class="container-fluid">
            <div class="collage-wrap">
              <div class="collage-header section-header">
                <h2 class="section-heading">Meilleures offres du jour</h2>
              </div>
              <div class="collage-grid">
                <div
                  class="collage-grid-item relative aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="collage-media">
                    <img loading="lazy" decoding="async"                       src="assets/img/collection/23.jpg"
                      alt="image"
                      width="1100"
                      height="600"
                      loading="lazy"
                    />
                  </div>
                  <div class="content-absolute">
                    <div class="collage-content flex-start">
                      <div class="content-box">
                        <div class="card-rating">
                          <ul class="rating-list list-unstyled">
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                          </ul>
                        </div>
                        <h3 class="heading-collage heading_32">
                          Robot de livraison
                        </h3>
                        <div class="card-price">
                          <span class="card-price-regular text text_14"
                            >124 FCFA US</span
                          >
                          <span class="card-price-compare text text_14"
                            >224 FCFA US</span
                          >
                        </div>
                        <div class="subheading-collage text text_16">
                          + Livraison gratuite
                        </div>
                        <a href="index-electronics.php#" class="core-link text_14 link-underline"
                          >ACHETER</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="collage-grid-item relative aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="collage-media">
                    <img loading="lazy" decoding="async"                       src="assets/img/collection/20.jpg"
                      alt="image"
                      width="1100"
                      height="600"
                      loading="lazy"
                    />
                  </div>
                  <div class="content-absolute">
                    <div class="collage-content flex-start">
                      <div class="content-box">
                        <div class="card-rating">
                          <ul class="rating-list list-unstyled">
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                          </ul>
                        </div>
                        <h3 class="heading-collage heading_32">Drone FPV 4K</h3>
                        <div class="card-price">
                          <span class="card-price-regular text text_14"
                            >124 FCFA US</span
                          >
                          <span class="card-price-compare text text_14"
                            >224 FCFA US</span
                          >
                        </div>
                        <div class="subheading-collage text text_16">
                          + Cadeau offert
                        </div>
                        <a href="index-electronics.php#" class="core-link text_14 link-underline"
                          >ACHETER</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="collage-grid-item relative aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="1200"
                >
                  <div class="collage-media">
                    <img loading="lazy" decoding="async"                       src="assets/img/collection/22.jpg"
                      alt="image"
                      width="1100"
                      height="600"
                      loading="lazy"
                    />
                  </div>
                  <div class="content-absolute">
                    <div class="collage-content flex-start">
                      <div class="content-box">
                        <div class="card-rating">
                          <ul class="rating-list list-unstyled">
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                          </ul>
                        </div>
                        <h3 class="heading-collage heading_32">Souris gaming</h3>
                        <div class="card-price">
                          <span class="card-price-regular text text_14"
                            >124 FCFA US</span
                          >
                          <span class="card-price-compare text text_14"
                            >224 FCFA US</span
                          >
                        </div>
                        <div class="subheading-collage text text_16">
                          + 1 acheté = 1 offert
                        </div>
                        <a href="index-electronics.php#" class="core-link text_14 link-underline"
                          >ACHETER</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="collage-grid-item relative aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="1200"
                >
                  <div class="collage-media">
                    <img loading="lazy" decoding="async"                       src="assets/img/collection/21.jpg"
                      alt="image"
                      width="1100"
                      height="600"
                      loading="lazy"
                    />
                  </div>
                  <div class="content-absolute">
                    <div class="collage-content flex-start">
                      <div class="content-box">
                        <div class="card-rating">
                          <ul class="rating-list list-unstyled">
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                            <li class="review-icon">
                              <svg
                                class="icon icon_14 icon-star"
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="15"
                                viewBox="0 0 14 15"
                                fill="currentColor"
                              >
                                <g clip-path="url(#clip0_7557_6855)">
                                  <path
                                    d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </g>
                                <defs>
                                  <clipPath>
                                    <rect
                                      width="14"
                                      height="14"
                                      fill="currentColor"
                                      transform="translate(0 0.5)"
                                    />
                                  </clipPath>
                                </defs>
                              </svg>
                            </li>
                          </ul>
                        </div>
                        <h3 class="heading-collage heading_32">
                          Mini-ordinateur
                        </h3>
                        <div class="card-price">
                          <span class="card-price-regular text text_14"
                            >124 FCFA US</span
                          >
                          <span class="card-price-compare text text_14"
                            >224 FCFA US</span
                          >
                        </div>
                        <div class="subheading-collage text text_16">
                          + Livraison gratuite
                        </div>
                        <a href="index-electronics.php#" class="core-link text_14 link-underline"
                          >ACHETER</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Collage end -->

        <!-- Product slider start -->
        <div class="section-product-slider home-section aos-init aos-animate">
          <product-slider
            class="product-slider-wrap"
            data-slidesPerView="3"
            data-aos="fade-up"
            data-aos-duration="700"
          >
            <div class="container relative">
              <div class="row align-content-center">
                <div class="col-lg-3">
                  <div class="product-slider-header">
                    <h2 class="section-heading text-start">
                      Produits de la semaine
                    </h2>
                    <a
                      href="collection-left-sidebar.php"
                      class="core-link text_14 link-underline"
                      aria-label="bouton du carrousel"
                    >
                      Tout voir
                    </a>
                  </div>
                </div>
                <div class="col-lg-9">
                  <div class="product-slider relative">
                    <div class="swiper">
                      <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide">
                          <div class="product-card">
                            <div class="product-card-image relative">
                              <a href="collection-left-sidebar.php">
                                <img loading="lazy" decoding="async"                                   src="assets/img/products/real/1769996652_KIr5Mp78N5.jpg"
                                  class="primary-image"
                                  alt="product-image"
                                  width="1100"
                                  height="600"
                                  loading="lazy"
                                />
                                <img loading="lazy" decoding="async"                                   src="assets/img/products/real/1769999657_1CIVZl8UG6.jpg"
                                  class="secondary-image"
                                  alt="product-image"
                                  width="1100"
                                  height="600"
                                  loading="lazy"
                                />
                              </a>
                              <div class="card-badge">
                                <div
                                  class="discount-badge-text badge-red text text_12"
                                >
                                  -44%
                                </div>
                              </div>
                              <a href="wishlist.php" class="card-wishlist">
                                <svg
                                  class="icon icon-wishlist"
                                  xmlns="http://www.w3.org/2000/svg"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  fill="none"
                                >
                                  <path
                                    d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </svg>
                              </a>
                              <a
                                href="compare.php"
                                class="card-compare button-reset"
                              >
                                <svg
                                  class="icon icon-bar-chart"
                                  xmlns="http://www.w3.org/2000/svg"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  fill="none"
                                >
                                  <path
                                    d="M18 20V10"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                  <path
                                    d="M12 20V4"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                  <path
                                    d="M6 20V14"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </svg>
                              </a>
                              <div class="card-action">
                                <a
                                  href="index-electronics.php#quickview-modal"
                                  class="card-quickview-button button-reset"
                                  data-bs-toggle="modal"
                                >
                                  <span class="card-quickview-icon">
                                    <svg
                                      class="icon icon_24 icon-quickview"
                                      xmlns="http://www.w3.org/2000/svg"
                                      viewBox="0 0 256 256"
                                    >
                                      <rect
                                        width="256"
                                        height="256"
                                        fill="none"
                                      />
                                      <path
                                        d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="16"
                                      />
                                      <circle
                                        cx="128"
                                        cy="128"
                                        r="40"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="16"
                                      />
                                    </svg>
                                  </span>
                                </a>
                                <a
                                  href="index-electronics.php#drawer-cart"
                                  data-bs-toggle="offcanvas"
                                  class="card-cart-button"
                                >
                                  <span class="card-cart-icon">
                                    <svg
                                      class="icon icon_24 icon-cart"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="24"
                                      height="24"
                                      viewBox="0 0 24 24"
                                      fill="none"
                                    >
                                      <path
                                        d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                      <path
                                        d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                      <path
                                        d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                    </svg>
                                  </span>
                                </a>
                              </div>
                            </div>
                            <div class="product-card-details">
                              <h3 class="product-card-title text-center">
                                <a
                                  href="collection-left-sidebar.php"
                                  class="card-title-link"
                                >
                                  Téléphone orange
                                </a>
                              </h3>
                              <div class="card-rating">
                                <ul class="rating-list list-unstyled">
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                </ul>
                                <span class="rating-number text_12">(6)</span>
                              </div>
                              <div class="card-price flex-center">
                                <span class="card-price-regular text text_14"
                                  >124 FCFA US</span
                                >
                                <span class="card-price-compare text text_14"
                                  >224 FCFA US</span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="swiper-slide">
                          <div class="product-card">
                            <div class="product-card-image relative">
                              <a href="collection-left-sidebar.php">
                                <img loading="lazy" decoding="async"                                   src="assets/img/products/real/1769999657_kRzaynhx3X.jpg"
                                  class="primary-image"
                                  alt="product-image"
                                  width="1100"
                                  height="600"
                                  loading="lazy"
                                />
                                <img loading="lazy" decoding="async"                                   src="assets/img/products/real/1769999657_xCatLOv9hZ.jpg"
                                  class="secondary-image"
                                  alt="product-image"
                                  width="1100"
                                  height="600"
                                  loading="lazy"
                                />
                              </a>
                              <a href="wishlist.php" class="card-wishlist">
                                <svg
                                  class="icon icon-wishlist"
                                  xmlns="http://www.w3.org/2000/svg"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  fill="none"
                                >
                                  <path
                                    d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </svg>
                              </a>
                              <a
                                href="compare.php"
                                class="card-compare button-reset"
                              >
                                <svg
                                  class="icon icon-bar-chart"
                                  xmlns="http://www.w3.org/2000/svg"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  fill="none"
                                >
                                  <path
                                    d="M18 20V10"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                  <path
                                    d="M12 20V4"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                  <path
                                    d="M6 20V14"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </svg>
                              </a>
                              <div class="card-action">
                                <a
                                  href="index-electronics.php#quickview-modal"
                                  class="card-quickview-button button-reset"
                                  data-bs-toggle="modal"
                                >
                                  <span class="card-quickview-icon">
                                    <svg
                                      class="icon icon_24 icon-quickview"
                                      xmlns="http://www.w3.org/2000/svg"
                                      viewBox="0 0 256 256"
                                    >
                                      <rect
                                        width="256"
                                        height="256"
                                        fill="none"
                                      />
                                      <path
                                        d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="16"
                                      />
                                      <circle
                                        cx="128"
                                        cy="128"
                                        r="40"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="16"
                                      />
                                    </svg>
                                  </span>
                                </a>
                                <a
                                  href="index-electronics.php#drawer-cart"
                                  data-bs-toggle="offcanvas"
                                  class="card-cart-button"
                                >
                                  <span class="card-cart-icon">
                                    <svg
                                      class="icon icon_24 icon-cart"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="24"
                                      height="24"
                                      viewBox="0 0 24 24"
                                      fill="none"
                                    >
                                      <path
                                        d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                      <path
                                        d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                      <path
                                        d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                    </svg>
                                  </span>
                                </a>
                              </div>
                            </div>
                            <div class="product-card-details">
                              <h3 class="product-card-title text-center">
                                <a
                                  href="collection-left-sidebar.php"
                                  class="card-title-link"
                                >
                                  Portable Slim Pro
                                </a>
                              </h3>
                              <div class="card-rating">
                                <ul class="rating-list list-unstyled">
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                </ul>
                                <span class="rating-number text_12">(6)</span>
                              </div>
                              <div class="card-price flex-center">
                                <span class="card-price-regular text text_14"
                                  >124 FCFA US</span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="swiper-slide">
                          <div class="product-card">
                            <div class="product-card-image relative">
                              <a href="collection-left-sidebar.php">
                                <img loading="lazy" decoding="async"                                   src="assets/img/products/real/1770689632_0OTK5fkOpt.jpg"
                                  class="primary-image"
                                  alt="product-image"
                                  width="1100"
                                  height="600"
                                  loading="lazy"
                                />
                                <img loading="lazy" decoding="async"                                   src="assets/img/products/real/1769643261_righaaXc9N.jpg"
                                  class="secondary-image"
                                  alt="product-image"
                                  width="1100"
                                  height="600"
                                  loading="lazy"
                                />
                              </a>
                              <div class="card-badge">
                                <div
                                  class="new-badge-text badge-blue text text_12"
                                >
                                  Nouveau
                                </div>
                              </div>
                              <a href="wishlist.php" class="card-wishlist">
                                <svg
                                  class="icon icon-wishlist"
                                  xmlns="http://www.w3.org/2000/svg"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  fill="none"
                                >
                                  <path
                                    d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </svg>
                              </a>
                              <a
                                href="compare.php"
                                class="card-compare button-reset"
                              >
                                <svg
                                  class="icon icon-bar-chart"
                                  xmlns="http://www.w3.org/2000/svg"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  fill="none"
                                >
                                  <path
                                    d="M18 20V10"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                  <path
                                    d="M12 20V4"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                  <path
                                    d="M6 20V14"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </svg>
                              </a>
                              <div class="card-action">
                                <a
                                  href="index-electronics.php#quickview-modal"
                                  class="card-quickview-button button-reset"
                                  data-bs-toggle="modal"
                                >
                                  <span class="card-quickview-icon">
                                    <svg
                                      class="icon icon_24 icon-quickview"
                                      xmlns="http://www.w3.org/2000/svg"
                                      viewBox="0 0 256 256"
                                    >
                                      <rect
                                        width="256"
                                        height="256"
                                        fill="none"
                                      />
                                      <path
                                        d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="16"
                                      />
                                      <circle
                                        cx="128"
                                        cy="128"
                                        r="40"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="16"
                                      />
                                    </svg>
                                  </span>
                                </a>
                                <a
                                  href="index-electronics.php#drawer-cart"
                                  data-bs-toggle="offcanvas"
                                  class="card-cart-button"
                                >
                                  <span class="card-cart-icon">
                                    <svg
                                      class="icon icon_24 icon-cart"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="24"
                                      height="24"
                                      viewBox="0 0 24 24"
                                      fill="none"
                                    >
                                      <path
                                        d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                      <path
                                        d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                      <path
                                        d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                    </svg>
                                  </span>
                                </a>
                              </div>
                            </div>
                            <div class="product-card-details">
                              <h3 class="product-card-title text-center">
                                <a
                                  href="collection-left-sidebar.php"
                                  class="card-title-link"
                                >
                                  Drone cinéma
                                </a>
                              </h3>
                              <div class="card-rating">
                                <ul class="rating-list list-unstyled">
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                </ul>
                                <span class="rating-number text_12">(6)</span>
                              </div>
                              <div class="card-price flex-center">
                                <span class="card-price-regular text text_14"
                                  >124 FCFA US</span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="swiper-slide">
                          <div class="product-card">
                            <div class="product-card-image relative">
                              <a href="collection-left-sidebar.php">
                                <img loading="lazy" decoding="async"                                   src="assets/img/products/real/1770691758_oLpAhmB0Wd.jpg"
                                  class="primary-image"
                                  alt="product-image"
                                  width="1100"
                                  height="600"
                                  loading="lazy"
                                />
                                <img loading="lazy" decoding="async"                                   src="assets/img/products/real/1770691758_zO2jmRAXwA.jpg"
                                  class="secondary-image"
                                  alt="product-image"
                                  width="1100"
                                  height="600"
                                  loading="lazy"
                                />
                              </a>
                              <a href="wishlist.php" class="card-wishlist">
                                <svg
                                  class="icon icon-wishlist"
                                  xmlns="http://www.w3.org/2000/svg"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  fill="none"
                                >
                                  <path
                                    d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </svg>
                              </a>
                              <a
                                href="compare.php"
                                class="card-compare button-reset"
                              >
                                <svg
                                  class="icon icon-bar-chart"
                                  xmlns="http://www.w3.org/2000/svg"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  fill="none"
                                >
                                  <path
                                    d="M18 20V10"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                  <path
                                    d="M12 20V4"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                  <path
                                    d="M6 20V14"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </svg>
                              </a>
                              <div class="card-action">
                                <a
                                  href="index-electronics.php#quickview-modal"
                                  class="card-quickview-button button-reset"
                                  data-bs-toggle="modal"
                                >
                                  <span class="card-quickview-icon">
                                    <svg
                                      class="icon icon_24 icon-quickview"
                                      xmlns="http://www.w3.org/2000/svg"
                                      viewBox="0 0 256 256"
                                    >
                                      <rect
                                        width="256"
                                        height="256"
                                        fill="none"
                                      />
                                      <path
                                        d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="16"
                                      />
                                      <circle
                                        cx="128"
                                        cy="128"
                                        r="40"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="16"
                                      />
                                    </svg>
                                  </span>
                                </a>
                                <a
                                  href="index-electronics.php#drawer-cart"
                                  data-bs-toggle="offcanvas"
                                  class="card-cart-button"
                                >
                                  <span class="card-cart-icon">
                                    <svg
                                      class="icon icon_24 icon-cart"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="24"
                                      height="24"
                                      viewBox="0 0 24 24"
                                      fill="none"
                                    >
                                      <path
                                        d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                      <path
                                        d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                      <path
                                        d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                    </svg>
                                  </span>
                                </a>
                              </div>
                            </div>
                            <div class="product-card-details">
                              <h3 class="product-card-title text-center">
                                <a
                                  href="collection-left-sidebar.php"
                                  class="card-title-link"
                                >
                                  Clavier RGB blanc
                                </a>
                              </h3>
                              <div class="card-rating">
                                <ul class="rating-list list-unstyled">
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                </ul>
                                <span class="rating-number text_12">(6)</span>
                              </div>
                              <div class="card-price flex-center">
                                <span class="card-price-regular text text_14"
                                  >124 FCFA US</span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="swiper-slide">
                          <div class="product-card">
                            <div class="product-card-image relative">
                              <a href="collection-left-sidebar.php">
                                <img loading="lazy" decoding="async"                                   src="assets/img/products/real/1770738680_YSa0YK1dz1.jpg"
                                  class="primary-image"
                                  alt="product-image"
                                  width="1100"
                                  height="600"
                                  loading="lazy"
                                />
                                <img loading="lazy" decoding="async"                                   src="assets/img/products/real/1770738680_Z9FYQSbomB.jpg"
                                  class="secondary-image"
                                  alt="product-image"
                                  width="1100"
                                  height="600"
                                  loading="lazy"
                                />
                              </a>
                              <a href="wishlist.php" class="card-wishlist">
                                <svg
                                  class="icon icon-wishlist"
                                  xmlns="http://www.w3.org/2000/svg"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  fill="none"
                                >
                                  <path
                                    d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </svg>
                              </a>
                              <a
                                href="compare.php"
                                class="card-compare button-reset"
                              >
                                <svg
                                  class="icon icon-bar-chart"
                                  xmlns="http://www.w3.org/2000/svg"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  fill="none"
                                >
                                  <path
                                    d="M18 20V10"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                  <path
                                    d="M12 20V4"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                  <path
                                    d="M6 20V14"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </svg>
                              </a>
                              <div class="card-action">
                                <a
                                  href="index-electronics.php#quickview-modal"
                                  class="card-quickview-button button-reset"
                                  data-bs-toggle="modal"
                                >
                                  <span class="card-quickview-icon">
                                    <svg
                                      class="icon icon_24 icon-quickview"
                                      xmlns="http://www.w3.org/2000/svg"
                                      viewBox="0 0 256 256"
                                    >
                                      <rect
                                        width="256"
                                        height="256"
                                        fill="none"
                                      />
                                      <path
                                        d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="16"
                                      />
                                      <circle
                                        cx="128"
                                        cy="128"
                                        r="40"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="16"
                                      />
                                    </svg>
                                  </span>
                                </a>
                                <a
                                  href="index-electronics.php#drawer-cart"
                                  data-bs-toggle="offcanvas"
                                  class="card-cart-button"
                                >
                                  <span class="card-cart-icon">
                                    <svg
                                      class="icon icon_24 icon-cart"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="24"
                                      height="24"
                                      viewBox="0 0 24 24"
                                      fill="none"
                                    >
                                      <path
                                        d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                      <path
                                        d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                      <path
                                        d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                    </svg>
                                  </span>
                                </a>
                              </div>
                            </div>
                            <div class="product-card-details">
                              <h3 class="product-card-title text-center">
                                <a
                                  href="collection-left-sidebar.php"
                                  class="card-title-link"
                                >
                                  Portable Slim Pro
                                </a>
                              </h3>
                              <div class="card-rating">
                                <ul class="rating-list list-unstyled">
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                </ul>
                                <span class="rating-number text_12">(6)</span>
                              </div>
                              <div class="card-price flex-center">
                                <span class="card-price-regular text text_14"
                                  >124 FCFA US</span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="swiper-slide">
                          <div class="product-card">
                            <div class="product-card-image relative">
                              <a href="collection-left-sidebar.php">
                                <img loading="lazy" decoding="async"                                   src="assets/img/products/real/1769651796_8nTO7f2rrg.jpg"
                                  class="primary-image"
                                  alt="product-image"
                                  width="1100"
                                  height="600"
                                  loading="lazy"
                                />
                                <img loading="lazy" decoding="async"                                   src="assets/img/products/real/1769999657_1CIVZl8UG6.jpg"
                                  class="secondary-image"
                                  alt="product-image"
                                  width="1100"
                                  height="600"
                                  loading="lazy"
                                />
                              </a>
                              <div class="card-badge">
                                <div
                                  class="new-badge-text badge-blue text text_12"
                                >
                                  Nouveau
                                </div>
                              </div>
                              <a href="wishlist.php" class="card-wishlist">
                                <svg
                                  class="icon icon-wishlist"
                                  xmlns="http://www.w3.org/2000/svg"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  fill="none"
                                >
                                  <path
                                    d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </svg>
                              </a>
                              <a
                                href="compare.php"
                                class="card-compare button-reset"
                              >
                                <svg
                                  class="icon icon-bar-chart"
                                  xmlns="http://www.w3.org/2000/svg"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  fill="none"
                                >
                                  <path
                                    d="M18 20V10"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                  <path
                                    d="M12 20V4"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                  <path
                                    d="M6 20V14"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </svg>
                              </a>
                              <div class="card-action">
                                <a
                                  href="index-electronics.php#quickview-modal"
                                  class="card-quickview-button button-reset"
                                  data-bs-toggle="modal"
                                >
                                  <span class="card-quickview-icon">
                                    <svg
                                      class="icon icon_24 icon-quickview"
                                      xmlns="http://www.w3.org/2000/svg"
                                      viewBox="0 0 256 256"
                                    >
                                      <rect
                                        width="256"
                                        height="256"
                                        fill="none"
                                      />
                                      <path
                                        d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="16"
                                      />
                                      <circle
                                        cx="128"
                                        cy="128"
                                        r="40"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="16"
                                      />
                                    </svg>
                                  </span>
                                </a>
                                <a
                                  href="index-electronics.php#drawer-cart"
                                  data-bs-toggle="offcanvas"
                                  class="card-cart-button"
                                >
                                  <span class="card-cart-icon">
                                    <svg
                                      class="icon icon_24 icon-cart"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="24"
                                      height="24"
                                      viewBox="0 0 24 24"
                                      fill="none"
                                    >
                                      <path
                                        d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                      <path
                                        d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                      <path
                                        d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                    </svg>
                                  </span>
                                </a>
                              </div>
                            </div>
                            <div class="product-card-details">
                              <h3 class="product-card-title text-center">
                                <a
                                  href="collection-left-sidebar.php"
                                  class="card-title-link"
                                >
                                  Drone cinéma
                                </a>
                              </h3>
                              <div class="card-rating">
                                <ul class="rating-list list-unstyled">
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                </ul>
                                <span class="rating-number text_12">(6)</span>
                              </div>
                              <div class="card-price flex-center">
                                <span class="card-price-regular text text_14"
                                  >124 FCFA US</span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="swiper-slide">
                          <div class="product-card">
                            <div class="product-card-image relative">
                              <a href="collection-left-sidebar.php">
                                <img loading="lazy" decoding="async"                                   src="assets/img/products/real/1769999657_xCatLOv9hZ.jpg"
                                  class="primary-image"
                                  alt="product-image"
                                  width="1100"
                                  height="600"
                                  loading="lazy"
                                />
                                <img loading="lazy" decoding="async"                                   src="assets/img/products/real/1769993520_r5wT4mQ4N8.jpg"
                                  class="secondary-image"
                                  alt="product-image"
                                  width="1100"
                                  height="600"
                                  loading="lazy"
                                />
                              </a>
                              <a href="wishlist.php" class="card-wishlist">
                                <svg
                                  class="icon icon-wishlist"
                                  xmlns="http://www.w3.org/2000/svg"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  fill="none"
                                >
                                  <path
                                    d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </svg>
                              </a>
                              <a
                                href="compare.php"
                                class="card-compare button-reset"
                              >
                                <svg
                                  class="icon icon-bar-chart"
                                  xmlns="http://www.w3.org/2000/svg"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  fill="none"
                                >
                                  <path
                                    d="M18 20V10"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                  <path
                                    d="M12 20V4"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                  <path
                                    d="M6 20V14"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  />
                                </svg>
                              </a>
                              <div class="card-action">
                                <a
                                  href="index-electronics.php#quickview-modal"
                                  class="card-quickview-button button-reset"
                                  data-bs-toggle="modal"
                                >
                                  <span class="card-quickview-icon">
                                    <svg
                                      class="icon icon_24 icon-quickview"
                                      xmlns="http://www.w3.org/2000/svg"
                                      viewBox="0 0 256 256"
                                    >
                                      <rect
                                        width="256"
                                        height="256"
                                        fill="none"
                                      />
                                      <path
                                        d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="16"
                                      />
                                      <circle
                                        cx="128"
                                        cy="128"
                                        r="40"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="16"
                                      />
                                    </svg>
                                  </span>
                                </a>
                                <a
                                  href="index-electronics.php#drawer-cart"
                                  data-bs-toggle="offcanvas"
                                  class="card-cart-button"
                                >
                                  <span class="card-cart-icon">
                                    <svg
                                      class="icon icon_24 icon-cart"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="24"
                                      height="24"
                                      viewBox="0 0 24 24"
                                      fill="none"
                                    >
                                      <path
                                        d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                      <path
                                        d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                      <path
                                        d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                        stroke="black"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                      />
                                    </svg>
                                  </span>
                                </a>
                              </div>
                            </div>
                            <div class="product-card-details">
                              <h3 class="product-card-title text-center">
                                <a
                                  href="collection-left-sidebar.php"
                                  class="card-title-link"
                                >
                                  Clavier RGB blanc
                                </a>
                              </h3>
                              <div class="card-rating">
                                <ul class="rating-list list-unstyled">
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                  <li class="review-icon">
                                    <svg
                                      class="icon icon_14 icon-star"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="15"
                                      viewBox="0 0 14 15"
                                      fill="currentColor"
                                    >
                                      <g clip-path="url(#clip0_7557_6855)">
                                        <path
                                          d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                          fill="currentColor"
                                          stroke="currentColor"
                                          stroke-width="1.5"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        />
                                      </g>
                                      <defs>
                                        <clipPath>
                                          <rect
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            transform="translate(0 0.5)"
                                          />
                                        </clipPath>
                                      </defs>
                                    </svg>
                                  </li>
                                </ul>
                                <span class="rating-number text_12">(6)</span>
                              </div>
                              <div class="card-price flex-center">
                                <span class="card-price-regular text text_14"
                                  >124 FCFA US</span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="article-arrows show-arrows-always arrows-white">
                      <div
                        class="swiper-button-prev product-nav-prev arrow-slider arrow-prev"
                      >
                        <svg
                          class="icon icon_28"
                          xmlns="http://www.w3.org/2000/svg"
                          width="100"
                          height="100"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="1"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                      </div>
                      <div
                        class="swiper-button-next product-nav-next arrow-slider arrow-next"
                      >
                        <svg
                          class="icon icon_28"
                          xmlns="http://www.w3.org/2000/svg"
                          width="100"
                          height="100"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="1"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </product-slider>
        </div>
        <!-- Product slider end -->

        <!-- Populer Product start -->
        <div class="section-popular-product mt-100">
          <div class="container-fluid">
            <div
              class="section-header d-flex flex-wrap align-items-center justify-content-between"
            >
              <h2 class="section-heading">Produits populaires</h2>
              <a
                href="collection-left-sidebar.php"
                class="core-link text_14 link-underline"
                aria-label="bouton du carrousel"
              >
                Tout voir
              </a>
            </div>
            <div class="tab-content">
              <div class="row">
                <div
                  class="col-xl-3 col-md-4 col-sm-6 col-12 aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-image relative">
                      <a href="collection-left-sidebar.php">
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1769996652_KIr5Mp78N5.jpg"
                          class="primary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1769999657_1CIVZl8UG6.jpg"
                          class="secondary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                      </a>
                      <div class="card-badge">
                        <div class="discount-badge-text badge-red text text_12">
                          -44%
                        </div>
                      </div>
                      <a href="wishlist.php" class="card-wishlist">
                        <svg
                          class="icon icon-wishlist"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <a href="compare.php" class="card-compare button-reset">
                        <svg
                          class="icon icon-bar-chart"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M18 20V10"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M12 20V4"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M6 20V14"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <div class="card-action">
                        <a
                          href="index-electronics.php#quickview-modal"
                          class="card-quickview-button button-reset"
                          data-bs-toggle="modal"
                        >
                          <span class="card-quickview-icon">
                            <svg
                              class="icon icon_24 icon-quickview"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 256 256"
                            >
                              <rect width="256" height="256" fill="none" />
                              <path
                                d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                              <circle
                                cx="128"
                                cy="128"
                                r="40"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                            </svg>
                          </span>
                        </a>
                        <a
                          href="index-electronics.php#drawer-cart"
                          data-bs-toggle="offcanvas"
                          class="card-cart-button"
                        >
                          <span class="card-cart-icon">
                            <svg
                              class="icon icon_24 icon-cart"
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                            >
                              <path
                                d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                            </svg>
                          </span>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title text-center">
                        <a
                          href="collection-left-sidebar.php"
                          class="card-title-link"
                          >Tapis de souris RGB avec charge</a
                        >
                      </h3>
                      <div class="card-rating">
                        <ul class="rating-list list-unstyled">
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                        </ul>
                        <span class="rating-number text text_12">(6)</span>
                      </div>
                      <div class="card-price flex-center">
                        <span class="card-price-regular text text_14"
                          >124 FCFA US</span
                        >
                        <span class="card-price-compare text text_14"
                          >224 FCFA US</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-xl-3 col-md-4 col-sm-6 col-12 aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-image relative">
                      <a href="collection-left-sidebar.php">
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1769999657_kRzaynhx3X.jpg"
                          class="primary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1769999657_xCatLOv9hZ.jpg"
                          class="secondary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                      </a>
                      <a href="wishlist.php" class="card-wishlist">
                        <svg
                          class="icon icon-wishlist"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <a href="compare.php" class="card-compare button-reset">
                        <svg
                          class="icon icon-bar-chart"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M18 20V10"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M12 20V4"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M6 20V14"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <div class="card-action">
                        <a
                          href="index-electronics.php#quickview-modal"
                          class="card-quickview-button button-reset"
                          data-bs-toggle="modal"
                        >
                          <span class="card-quickview-icon">
                            <svg
                              class="icon icon_24 icon-quickview"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 256 256"
                            >
                              <rect width="256" height="256" fill="none" />
                              <path
                                d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                              <circle
                                cx="128"
                                cy="128"
                                r="40"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                            </svg>
                          </span>
                        </a>
                        <a
                          href="index-electronics.php#drawer-cart"
                          data-bs-toggle="offcanvas"
                          class="card-cart-button"
                        >
                          <span class="card-cart-icon">
                            <svg
                              class="icon icon_24 icon-cart"
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                            >
                              <path
                                d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                            </svg>
                          </span>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title text-center">
                        <a
                          href="collection-left-sidebar.php"
                          class="card-title-link"
                        >
                          Portable Slim Pro
                        </a>
                      </h3>
                      <div class="card-rating">
                        <ul class="rating-list list-unstyled">
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                        </ul>
                        <span class="rating-number text text_12">(6)</span>
                      </div>
                      <div class="card-price flex-center">
                        <span class="card-price-regular text text_14"
                          >124 FCFA US</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-xl-3 col-md-4 col-sm-6 col-12 aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-image relative">
                      <a href="collection-left-sidebar.php">
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1770689632_0OTK5fkOpt.jpg"
                          class="primary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1769643261_righaaXc9N.jpg"
                          class="secondary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                      </a>
                      <a href="wishlist.php" class="card-wishlist">
                        <svg
                          class="icon icon-wishlist"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <a href="compare.php" class="card-compare button-reset">
                        <svg
                          class="icon icon-bar-chart"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M18 20V10"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M12 20V4"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M6 20V14"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <div class="card-action">
                        <a
                          href="index-electronics.php#quickview-modal"
                          class="card-quickview-button button-reset"
                          data-bs-toggle="modal"
                        >
                          <span class="card-quickview-icon">
                            <svg
                              class="icon icon_24 icon-quickview"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 256 256"
                            >
                              <rect width="256" height="256" fill="none" />
                              <path
                                d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                              <circle
                                cx="128"
                                cy="128"
                                r="40"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                            </svg>
                          </span>
                        </a>
                        <a
                          href="index-electronics.php#drawer-cart"
                          data-bs-toggle="offcanvas"
                          class="card-cart-button"
                        >
                          <span class="card-cart-icon">
                            <svg
                              class="icon icon_24 icon-cart"
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                            >
                              <path
                                d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                            </svg>
                          </span>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title text-center">
                        <a
                          href="collection-left-sidebar.php"
                          class="card-title-link"
                        >
                          Clavier RGB blanc
                        </a>
                      </h3>
                      <div class="card-rating">
                        <ul class="rating-list list-unstyled">
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                        </ul>
                        <span class="rating-number text text_12">(6)</span>
                      </div>
                      <div class="card-price flex-center">
                        <span class="card-price-regular text text_14"
                          >124 FCFA US</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-xl-3 col-md-4 col-sm-6 col-12 aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-image relative">
                      <a href="collection-left-sidebar.php">
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1770691758_oLpAhmB0Wd.jpg"
                          class="primary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1770691758_zO2jmRAXwA.jpg"
                          class="secondary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                      </a>
                      <a href="wishlist.php" class="card-wishlist">
                        <svg
                          class="icon icon-wishlist"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <a href="compare.php" class="card-compare button-reset">
                        <svg
                          class="icon icon-bar-chart"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M18 20V10"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M12 20V4"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M6 20V14"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <div class="card-action">
                        <a
                          href="index-electronics.php#quickview-modal"
                          class="card-quickview-button button-reset"
                          data-bs-toggle="modal"
                        >
                          <span class="card-quickview-icon">
                            <svg
                              class="icon icon_24 icon-quickview"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 256 256"
                            >
                              <rect width="256" height="256" fill="none" />
                              <path
                                d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                              <circle
                                cx="128"
                                cy="128"
                                r="40"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                            </svg>
                          </span>
                        </a>
                        <a
                          href="index-electronics.php#drawer-cart"
                          data-bs-toggle="offcanvas"
                          class="card-cart-button"
                        >
                          <span class="card-cart-icon">
                            <svg
                              class="icon icon_24 icon-cart"
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                            >
                              <path
                                d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                            </svg>
                          </span>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title text-center">
                        <a
                          href="collection-left-sidebar.php"
                          class="card-title-link"
                        >
                          TV Ultra noire
                        </a>
                      </h3>
                      <div class="card-rating">
                        <ul class="rating-list list-unstyled">
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                        </ul>
                        <span class="rating-number text text_12">(6)</span>
                      </div>
                      <div class="card-price flex-center">
                        <span class="card-price-regular text text_14"
                          >124 FCFA US</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-xl-3 col-md-4 col-sm-6 col-12 aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-image relative">
                      <a href="collection-left-sidebar.php">
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1770738680_YSa0YK1dz1.jpg"
                          class="primary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1770738680_Z9FYQSbomB.jpg"
                          class="secondary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                      </a>
                      <a href="wishlist.php" class="card-wishlist">
                        <svg
                          class="icon icon-wishlist"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <a href="compare.php" class="card-compare button-reset">
                        <svg
                          class="icon icon-bar-chart"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M18 20V10"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M12 20V4"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M6 20V14"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <div class="card-action">
                        <a
                          href="index-electronics.php#quickview-modal"
                          class="card-quickview-button button-reset"
                          data-bs-toggle="modal"
                        >
                          <span class="card-quickview-icon">
                            <svg
                              class="icon icon_24 icon-quickview"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 256 256"
                            >
                              <rect width="256" height="256" fill="none" />
                              <path
                                d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                              <circle
                                cx="128"
                                cy="128"
                                r="40"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                            </svg>
                          </span>
                        </a>
                        <a
                          href="index-electronics.php#drawer-cart"
                          data-bs-toggle="offcanvas"
                          class="card-cart-button"
                        >
                          <span class="card-cart-icon">
                            <svg
                              class="icon icon_24 icon-cart"
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                            >
                              <path
                                d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                            </svg>
                          </span>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title text-center">
                        <a
                          href="collection-left-sidebar.php"
                          class="card-title-link"
                        >
                          Enceintes géantes
                        </a>
                      </h3>
                      <div class="card-rating">
                        <ul class="rating-list list-unstyled">
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                        </ul>
                        <span class="rating-number text text_12">(6)</span>
                      </div>
                      <div class="card-price flex-center">
                        <span class="card-price-regular text text_14"
                          >124 FCFA US</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-xl-3 col-md-4 col-sm-6 col-12 aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-image relative">
                      <a href="collection-left-sidebar.php">
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1769651796_8nTO7f2rrg.jpg"
                          class="primary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1769999657_1CIVZl8UG6.jpg"
                          class="secondary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                      </a>
                      <div class="card-badge">
                        <div class="new-badge-text badge-blue text text_12">
                          Nouveau
                        </div>
                      </div>
                      <a href="wishlist.php" class="card-wishlist">
                        <svg
                          class="icon icon-wishlist"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <a href="compare.php" class="card-compare button-reset">
                        <svg
                          class="icon icon-bar-chart"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M18 20V10"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M12 20V4"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M6 20V14"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <div class="card-action">
                        <a
                          href="index-electronics.php#quickview-modal"
                          class="card-quickview-button button-reset"
                          data-bs-toggle="modal"
                        >
                          <span class="card-quickview-icon">
                            <svg
                              class="icon icon_24 icon-quickview"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 256 256"
                            >
                              <rect width="256" height="256" fill="none" />
                              <path
                                d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                              <circle
                                cx="128"
                                cy="128"
                                r="40"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                            </svg>
                          </span>
                        </a>
                        <a
                          href="index-electronics.php#drawer-cart"
                          data-bs-toggle="offcanvas"
                          class="card-cart-button"
                        >
                          <span class="card-cart-icon">
                            <svg
                              class="icon icon_24 icon-cart"
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                            >
                              <path
                                d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                            </svg>
                          </span>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title text-center">
                        <a
                          href="collection-left-sidebar.php"
                          class="card-title-link"
                        >
                          Assistance domestique
                        </a>
                      </h3>
                      <div class="card-rating">
                        <ul class="rating-list list-unstyled">
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                        </ul>
                        <span class="rating-number text text_12">(6)</span>
                      </div>
                      <div class="card-price flex-center">
                        <span class="card-price-regular text text_14"
                          >124 FCFA US</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-xl-3 col-md-4 col-sm-6 col-12 aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-image relative">
                      <a href="collection-left-sidebar.php">
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1769999657_xCatLOv9hZ.jpg"
                          class="primary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1769993520_r5wT4mQ4N8.jpg"
                          class="secondary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                      </a>
                      <a href="wishlist.php" class="card-wishlist">
                        <svg
                          class="icon icon-wishlist"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <a href="compare.php" class="card-compare button-reset">
                        <svg
                          class="icon icon-bar-chart"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M18 20V10"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M12 20V4"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M6 20V14"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <div class="card-action">
                        <a
                          href="index-electronics.php#quickview-modal"
                          class="card-quickview-button button-reset"
                          data-bs-toggle="modal"
                        >
                          <span class="card-quickview-icon">
                            <svg
                              class="icon icon_24 icon-quickview"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 256 256"
                            >
                              <rect width="256" height="256" fill="none" />
                              <path
                                d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                              <circle
                                cx="128"
                                cy="128"
                                r="40"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                            </svg>
                          </span>
                        </a>
                        <a
                          href="index-electronics.php#drawer-cart"
                          data-bs-toggle="offcanvas"
                          class="card-cart-button"
                        >
                          <span class="card-cart-icon">
                            <svg
                              class="icon icon_24 icon-cart"
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                            >
                              <path
                                d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                            </svg>
                          </span>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title text-center">
                        <a
                          href="collection-left-sidebar.php"
                          class="card-title-link"
                        >
                          Enceintes pour la maison
                        </a>
                      </h3>
                      <div class="card-rating">
                        <ul class="rating-list list-unstyled">
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                        </ul>
                        <span class="rating-number text text_12">(6)</span>
                      </div>
                      <div class="card-price flex-center">
                        <span class="card-price-regular text text_14"
                          >124 FCFA US</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-xl-3 col-md-4 col-sm-6 col-12 aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="product-card">
                    <div class="product-card-image relative">
                      <a href="collection-left-sidebar.php">
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1769996652_KIr5Mp78N5.jpg"
                          class="primary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                        <img loading="lazy" decoding="async"                           src="assets/img/products/real/1769999657_1CIVZl8UG6.jpg"
                          class="secondary-image"
                          alt="product-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                      </a>
                      <a href="wishlist.php" class="card-wishlist">
                        <svg
                          class="icon icon-wishlist"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M20.84 4.61C20.3292 4.09901 19.7228 3.69365 19.0554 3.41709C18.3879 3.14052 17.6725 2.99818 16.95 2.99818C16.2275 2.99818 15.5121 3.14052 14.8446 3.41709C14.1772 3.69365 13.5708 4.09901 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.57831 8.50903 2.99871 7.05 2.99871C5.59096 2.99871 4.19169 3.57831 3.16 4.61C2.1283 5.64169 1.54871 7.04097 1.54871 8.5C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6054C22.3095 9.9379 22.4518 9.22249 22.4518 8.5C22.4518 7.77751 22.3095 7.06211 22.0329 6.39465C21.7563 5.72719 21.351 5.12076 20.84 4.61V4.61Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <a href="compare.php" class="card-compare button-reset">
                        <svg
                          class="icon icon-bar-chart"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                        >
                          <path
                            d="M18 20V10"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M12 20V4"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M6 20V14"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </a>
                      <div class="card-action">
                        <a
                          href="index-electronics.php#quickview-modal"
                          class="card-quickview-button button-reset"
                          data-bs-toggle="modal"
                        >
                          <span class="card-quickview-icon">
                            <svg
                              class="icon icon_24 icon-quickview"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 256 256"
                            >
                              <rect width="256" height="256" fill="none" />
                              <path
                                d="M128,56C48,56,16,128,16,128s32,72,112,72,112-72,112-72S208,56,128,56Z"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                              <circle
                                cx="128"
                                cy="128"
                                r="40"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              />
                            </svg>
                          </span>
                        </a>
                        <a
                          href="index-electronics.php#drawer-cart"
                          data-bs-toggle="offcanvas"
                          class="card-cart-button"
                        >
                          <span class="card-cart-icon">
                            <svg
                              class="icon icon_24 icon-cart"
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                            >
                              <path
                                d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                            </svg>
                          </span>
                        </a>
                      </div>
                    </div>
                    <div class="product-card-details">
                      <h3 class="product-card-title text-center">
                        <a
                          href="collection-left-sidebar.php"
                          class="card-title-link"
                        >
                          Enceinte noire
                        </a>
                      </h3>
                      <div class="card-rating">
                        <ul class="rating-list list-unstyled">
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                          <li class="review-icon">
                            <svg
                              class="icon icon_14 icon-star"
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="15"
                              viewBox="0 0 14 15"
                              fill="currentColor"
                            >
                              <g clip-path="url(#clip0_7557_6855)">
                                <path
                                  d="M6.99999 1.66675L8.80249 5.31841L12.8333 5.90758L9.91666 8.74841L10.605 12.7617L6.99999 10.8659L3.39499 12.7617L4.08332 8.74841L1.16666 5.90758L5.19749 5.31841L6.99999 1.66675Z"
                                  fill="currentColor"
                                  stroke="currentColor"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </g>
                              <defs>
                                <clipPath>
                                  <rect
                                    width="14"
                                    height="14"
                                    fill="currentColor"
                                    transform="translate(0 0.5)"
                                  />
                                </clipPath>
                              </defs>
                            </svg>
                          </li>
                        </ul>
                        <span class="rating-number text text_12">(6)</span>
                      </div>
                      <div class="card-price flex-center">
                        <span class="card-price-regular text text_14"
                          >124 FCFA US</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="view-all text-center aos-init aos-animate"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <a
                  href="collection-left-sidebar.php"
                  class="btn-primary"
                  aria-label="bouton voir plus"
                >
                  Tout voir
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- Populer Product end -->

        <!-- Image banner with shipping start -->
        <div
          class="section-banner-shipping-wrap aos-init aos-animate mt-100"
          data-aos="fade-up"
          data-aos-duration="700"
        >
          <div class="container">
            <div class="section-image-banner image-banner-3">
              <div class="image-banner-wrap row-reverse">
                <div class="image-banner-media">
                  <img loading="lazy" decoding="async"                     src="assets/img/banner/img-banner6.png"
                    alt="product-image"
                    width="1100"
                    height="600"
                    loading="lazy"
                  />
                </div>
                <div class="image-banner-content flex-start">
                  <div class="content-box">
                    <div class="image-banner-subheading heading_18 medium">
                      Offre groupée
                    </div>
                    <h3 class="image-banner-heading heading_48">
                      Construisez votre maison connectée
                    </h3>
                    <p class="image-banner-text heading_20">
                      À partir de 56 FCFA
                    </p>
                    <a
                      href="collection-without-sidebar.php"
                      class="image-banner-button btn-primary"
                      aria-label="bouton de la bannière"
                    >
                      Voir les produits
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Shipping policy start -->
            <div
              class="section-shipping-policy shipping-policy-2 shipping-policy-elec"
            >
              <div class="container">
                <div class="row row-gap-4">
                  <div class="col-lg-4 col-md-4 col-12">
                    <div class="shipping-policy-item">
                      <div class="shipping-policy-icon">
                        <svg
                          class="icon icon_40 icon-shipping"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 256 256"
                        >
                          <rect width="256" height="256" fill="none" />
                          <path
                            d="M184,80h42.58A8,8,0,0,1,234,85l14,35"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="16"
                          />
                          <line
                            x1="24"
                            y1="144"
                            x2="184"
                            y2="144"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="16"
                          />
                          <circle
                            cx="192"
                            cy="192"
                            r="24"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="16"
                          />
                          <circle
                            cx="80"
                            cy="192"
                            r="24"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="16"
                          />
                          <line
                            x1="168"
                            y1="192"
                            x2="104"
                            y2="192"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="16"
                          />
                          <path
                            d="M184,120h64v64a8,8,0,0,1-8,8H216"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="16"
                          />
                          <path
                            d="M56,192H32a8,8,0,0,1-8-8V72a8,8,0,0,1,8-8H184V169.37"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="16"
                          />
                        </svg>
                      </div>
                      <div class="shipping-policy-content text-start">
                        <h6 class="shipping-subheading heading_20 medium">
                          Livraison et retour gratuits
                        </h6>
                        <p class="shipping-text text_14">
                          Sur toute commande de plus de 99 FCFA
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-12">
                    <div class="shipping-policy-item">
                      <div class="shipping-policy-icon">
                        <svg
                          class="icon icon_40 icon-credit-card"
                          xmlns="http://www.w3.org/2000/svg"
                          width="54"
                          height="39"
                          viewBox="0 0 54 39"
                          fill="none"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M35.69 29.3958C35.69 28.74 36.2206 28.2083 36.8751 28.2083H44.7755C45.43 28.2083 45.9606 28.74 45.9606 29.3958C45.9606 30.0517 45.43 30.5833 44.7755 30.5833H36.8751C36.2206 30.5833 35.69 30.0517 35.69 29.3958Z"
                            fill="black"
                          />
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M23.8394 29.3958C23.8394 28.74 24.37 28.2083 25.0245 28.2083H28.9747C29.6292 28.2083 30.1598 28.74 30.1598 29.3958C30.1598 30.0517 29.6292 30.5833 28.9747 30.5833H25.0245C24.37 30.5833 23.8394 30.0517 23.8394 29.3958Z"
                            fill="black"
                          />
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M2.50962 3.66667C2.50962 3.22944 2.86334 2.875 3.29966 2.875H50.7022C51.1385 2.875 51.4922 3.22944 51.4922 3.66667V10.6084H2.50962V3.66667ZM51.4922 12.9834H52.6759C53.3304 12.9834 53.861 12.4517 53.861 11.7959C53.861 11.14 53.3304 10.6084 52.6759 10.6084H51.4922V12.9834ZM51.4922 12.9834V35.3333C51.4922 35.7706 51.1385 36.125 50.7022 36.125H3.29966C2.86334 36.125 2.50962 35.7706 2.50962 35.3333V12.9834H51.4922ZM0.139497 11.8523V35.3333C0.139497 37.0822 1.55435 38.5 3.29966 38.5H50.7022C52.4475 38.5 53.8623 37.0822 53.8623 35.3333V3.66667C53.8623 1.91777 52.4475 0.5 50.7022 0.5H3.29966C1.55435 0.5 0.139497 1.91777 0.139497 3.66667V11.7394C0.138625 11.7581 0.138184 11.7769 0.138184 11.7959C0.138184 11.8148 0.138625 11.8336 0.139497 11.8523Z"
                            fill="black"
                          />
                          <path
                            d="M53.861 11.7959C53.861 11.14 53.3304 10.6084 52.6759 10.6084H51.4922V12.9834H52.6759C53.3304 12.9834 53.861 12.4517 53.861 11.7959Z"
                            fill="black"
                          />
                        </svg>
                      </div>
                      <div class="shipping-policy-content text-start">
                        <h6 class="shipping-subheading heading_20 medium">
                          Paiement 100 % sécurisé
                        </h6>
                        <p class="shipping-text text_14">Sécurité garantie</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-12">
                    <div class="shipping-policy-item">
                      <div class="shipping-policy-icon">
                        <svg
                          class="icon icon_40 icon-help"
                          xmlns="http://www.w3.org/2000/svg"
                          width="46"
                          height="39"
                          viewBox="0 0 46 39"
                          fill="none"
                        >
                          <path
                            d="M39.7726 12.9574C38.6872 9.35564 36.4695 6.19907 33.4481 3.95531C30.4266 1.71155 26.7622 0.499948 22.9977 0.5C19.2332 0.500052 15.5689 1.71175 12.5475 3.9556C9.52619 6.19945 7.30856 9.35607 6.22319 12.9578C4.75752 13.0114 3.37151 13.6379 2.36364 14.7025C1.35576 15.7672 0.806631 17.1847 0.834508 18.6499C0.862385 20.1151 1.46503 21.5108 2.51268 22.5364C3.56033 23.562 4.96917 24.1354 6.43581 24.1332C6.48226 24.1332 6.52577 24.1227 6.57203 24.1216C7.5842 26.8385 9.25678 29.2612 11.4392 31.1716C13.6215 33.0819 16.2452 34.4199 19.0738 35.0651C19.2009 36.0213 19.6733 36.8982 20.4022 37.5308C21.1311 38.1633 22.0662 38.508 23.0316 38.4999C23.997 38.4917 24.9261 38.1314 25.6442 37.4867C26.3624 36.842 26.82 35.9573 26.931 34.999C27.042 34.0408 26.7987 33.075 26.247 32.2834C25.6952 31.4918 24.873 30.929 23.935 30.7007C22.997 30.4725 22.0078 30.5946 21.1536 31.0441C20.2994 31.4936 19.639 32.2394 19.2966 33.1414C16.4553 32.4467 13.8669 30.9675 11.827 28.8727C9.78715 26.7779 8.37807 24.1521 7.76076 21.2951C7.14346 18.4382 7.34282 15.4654 8.33607 12.7163C9.32932 9.96716 11.0764 7.55264 13.3778 5.74853C15.6791 3.94442 18.4419 2.82347 21.3505 2.51375C24.2592 2.20402 27.1963 2.718 29.8265 3.99698C32.4567 5.27596 34.6738 7.26835 36.2246 9.74656C37.7753 12.2248 38.5972 15.0888 38.5964 18.0116V23.1702C38.5964 23.4256 38.698 23.6705 38.8787 23.8511C39.0595 24.0317 39.3046 24.1332 39.5602 24.1332L39.5623 24.1328L39.5645 24.1332C41.0316 24.1354 42.4408 23.5616 43.4885 22.5355C44.5362 21.5094 45.1386 20.1132 45.1659 18.6475C45.1932 17.1819 44.6432 15.7642 43.6344 14.6999C42.6256 13.6356 41.2387 13.0098 39.7726 12.9574ZM22.9983 32.5144C23.4033 32.5145 23.7991 32.6345 24.1358 32.8594C24.4725 33.0842 24.7349 33.4038 24.8899 33.7777C25.0448 34.1515 25.0854 34.5629 25.0063 34.9598C24.9273 35.3566 24.7323 35.7212 24.4459 36.0073C24.1596 36.2935 23.7947 36.4883 23.3975 36.5673C23.0003 36.6462 22.5886 36.6058 22.2145 36.4509C21.8403 36.2961 21.5205 36.0339 21.2955 35.6975C21.0704 35.361 20.9503 34.9655 20.9502 34.5608C20.9508 34.0183 21.1667 33.4981 21.5507 33.1144C21.9347 32.7307 22.4553 32.515 22.9983 32.5144ZM2.76078 18.5351C2.76232 17.6792 3.06289 16.8507 3.6106 16.1926C4.15831 15.5345 4.91879 15.0882 5.76074 14.9306C5.31155 17.3286 5.38722 19.7954 5.98256 22.1614C5.09559 22.0529 4.27878 21.6246 3.68555 20.9569C3.09231 20.2891 2.76347 19.428 2.76078 18.5351ZM40.5239 22.0642V18.0116C40.519 16.978 40.4223 15.9468 40.2351 14.9302C41.0533 15.0794 41.7963 15.5025 42.3418 16.1298C42.8873 16.7571 43.2028 17.5513 43.2365 18.3817C43.2701 19.2121 43.0198 20.0291 42.5267 20.6984C42.0337 21.3677 41.3274 21.8494 40.5239 22.0642Z"
                            fill="black"
                          />
                          <path
                            d="M22.9974 8.23607C20.9588 8.23601 18.9659 8.83999 17.2708 9.97165C15.5757 11.1033 14.2545 12.7118 13.4743 14.5938C12.694 16.4757 12.4899 18.5466 12.8875 20.5445C13.2852 22.5423 14.2668 24.3776 15.7083 25.818C17.1498 27.2584 18.9864 28.2394 20.9859 28.6369C22.9854 29.0343 25.0579 28.8304 26.9414 28.051C28.8249 27.2715 30.4348 25.9514 31.5674 24.2577C32.7001 22.564 33.3047 20.5728 33.3047 18.5358C33.3016 15.8052 32.2146 13.1874 30.2823 11.2565C28.35 9.32565 25.7302 8.23941 22.9974 8.23607ZM22.9974 26.9088C21.34 26.9089 19.7198 26.4178 18.3416 25.4978C16.9635 24.5777 15.8893 23.27 15.255 21.7399C14.6207 20.2099 14.4547 18.5263 14.7781 16.902C15.1014 15.2777 15.8995 13.7856 17.0715 12.6146C18.2435 11.4435 19.7367 10.646 21.3623 10.323C22.9879 9.99989 24.6729 10.1657 26.2042 10.7995C27.7354 11.4333 29.0442 12.5066 29.965 13.8836C30.8858 15.2607 31.3772 16.8796 31.3772 18.5358C31.3746 20.7556 30.491 22.8839 28.92 24.4536C27.349 26.0233 25.2191 26.9063 22.9974 26.9088Z"
                            fill="black"
                          />
                          <path
                            d="M22.9998 12.9361C22.7442 12.9361 22.4991 13.0376 22.3184 13.2182C22.1377 13.3988 22.0361 13.6437 22.036 13.8991V17.5718H17.7166C17.461 17.5718 17.2158 17.6733 17.0351 17.8539C16.8543 18.0345 16.7528 18.2794 16.7528 18.5348C16.7528 18.7902 16.8543 19.0352 17.0351 19.2158C17.2158 19.3964 17.461 19.4978 17.7166 19.4978H22.9998C23.2554 19.4978 23.5005 19.3963 23.6812 19.2157C23.8619 19.0351 23.9635 18.7902 23.9636 18.5348V13.8991C23.9635 13.6437 23.8619 13.3988 23.6812 13.2182C23.5005 13.0376 23.2554 12.9361 22.9998 12.9361Z"
                            fill="black"
                          />
                        </svg>
                      </div>
                      <div class="shipping-policy-content text-start">
                        <h6 class="shipping-subheading heading_20 medium">
                          Assistance client 24/7
                        </h6>
                        <p class="shipping-text text_14">Assistance immédiate</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Image banner with shipping end -->

        <!-- Image banner start -->
        <div
          class="section-image-banner image-banner-2 mt-100 aos-init aos-animate"
          data-aos="fade-up"
          data-aos-duration="700"
        >
          <div class="container">
            <div class="image-banner-wrap row-reverse">
              <div class="image-banner-media">
                <img loading="lazy" decoding="async"                   src="assets/img/banner/img-banner7.jpg"
                  alt="product-image"
                  width="1100"
                  height="600"
                  loading="lazy"
                />
              </div>
              <div class="image-banner-content flex-start">
                <div class="content-box">
                  <div class="image-banner-subheading heading_18 medium">
                    Montage PC
                  </div>
                  <h3 class="image-banner-heading heading_48">
                    Choisissez vos composants, nous nous chargeons du montage
                  </h3>
                  <p class="image-banner-text heading_20">À partir de 56 FCFA</p>
                  <a
                    href="collection-without-sidebar.php"
                    class="image-banner-button btn-primary"
                    aria-label="bouton de la bannière"
                  >
                    Montage PC
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Image banner end -->

        <!-- faq start -->
        <div class="faq-section faq-electronics mt-100 overflow-hidden">
          <div class="faq-inner">
            <div class="container">
              <div class="section-header">
                <h2 class="section-heading">Questions fréquentes</h2>
              </div>
              <div class="faq-container">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="faq-item rounded">
                      <h2
                        class="faq-heading heading_18 collapsed d-flex align-items-center justify-content-between"
                        data-bs-toggle="collapse"
                        data-bs-target="#faq1"
                      >
                        Mobilier Addict est-il un investissement sûr ?
                        <span class="faq-heading-icon">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-down"
                          >
                            <polyline points="6 9 12 15 18 9"></polyline>
                          </svg>
                        </span>
                      </h2>
                      <div id="faq1" class="accordion-collapse collapse">
                        <p class="faq-body text_14">
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Sit repellat quod facere illo esse cumque
                          inventore veniam necessitatibus totam repudiandae. Hic
                          rerum animi modi sed?
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="faq-item rounded">
                      <h2
                        class="faq-heading heading_18 collapsed d-flex align-items-center justify-content-between"
                        data-bs-toggle="collapse"
                        data-bs-target="#faq2"
                      >
                        Comment configurer un portefeuille crypto ?
                        <span class="faq-heading-icon">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-down"
                          >
                            <polyline points="6 9 12 15 18 9"></polyline>
                          </svg>
                        </span>
                      </h2>
                      <div id="faq2" class="accordion-collapse collapse">
                        <p class="faq-body text_14">
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Sit repellat quod facere illo esse cumque
                          inventore veniam necessitatibus totam repudiandae. Hic
                          rerum animi modi sed?
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="faq-item rounded">
                      <h2
                        class="faq-heading heading_18 collapsed d-flex align-items-center justify-content-between"
                        data-bs-toggle="collapse"
                        data-bs-target="#faq3"
                      >
                        Où et comment acheter chez Mobilier Addict ?
                        <span class="faq-heading-icon">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-down"
                          >
                            <polyline points="6 9 12 15 18 9"></polyline>
                          </svg>
                        </span>
                      </h2>
                      <div id="faq3" class="accordion-collapse collapse">
                        <p class="faq-body text_14">
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Sit repellat quod facere illo esse cumque
                          inventore veniam necessitatibus totam repudiandae. Hic
                          rerum animi modi sed?
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="faq-item rounded">
                      <h2
                        class="faq-heading heading_18 collapsed d-flex align-items-center justify-content-between"
                        data-bs-toggle="collapse"
                        data-bs-target="#faq4"
                      >
                        À quelle fréquence les résultats sont-ils communiqués ?
                        <span class="faq-heading-icon">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-down"
                          >
                            <polyline points="6 9 12 15 18 9"></polyline>
                          </svg>
                        </span>
                      </h2>
                      <div id="faq4" class="accordion-collapse collapse">
                        <p class="faq-body text_14">
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Sit repellat quod facere illo esse cumque
                          inventore veniam necessitatibus totam repudiandae. Hic
                          rerum animi modi sed?
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="faq-item rounded">
                      <h2
                        class="faq-heading heading_18 collapsed d-flex align-items-center justify-content-between"
                        data-bs-toggle="collapse"
                        data-bs-target="#faq5"
                      >
                        Comment obtenir de l'aide ?
                        <span class="faq-heading-icon">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-down"
                          >
                            <polyline points="6 9 12 15 18 9"></polyline>
                          </svg>
                        </span>
                      </h2>
                      <div id="faq5" class="accordion-collapse collapse">
                        <p class="faq-body text_14">
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Sit repellat quod facere illo esse cumque
                          inventore veniam necessitatibus totam repudiandae. Hic
                          rerum animi modi sed?
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="faq-item rounded">
                      <h2
                        class="faq-heading heading_18 collapsed d-flex align-items-center justify-content-between"
                        data-bs-toggle="collapse"
                        data-bs-target="#faq6"
                      >
                        Axion est-il disponible sur une grande plateforme d'échange ?
                        <span class="faq-heading-icon">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-down"
                          >
                            <polyline points="6 9 12 15 18 9"></polyline>
                          </svg>
                        </span>
                      </h2>
                      <div id="faq6" class="accordion-collapse collapse">
                        <p class="faq-body text_14">
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Sit repellat quod facere illo esse cumque
                          inventore veniam necessitatibus totam repudiandae. Hic
                          rerum animi modi sed?
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="view-all text-center"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <a class="btn-primary" href="faq.php">VOIR PLUS</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- faq end -->

        <!-- Latest blog start -->
        <div
          class="section-latest-blog mt-100 aos-init aos-animate"
          data-aos="fade-up"
          data-aos-duration="700"
        >
          <div class="latest-blog-wrap">
            <div class="container">
              <div class="section-header">
                <h2 class="section-heading">Nos dernières actualités</h2>
              </div>
              <div
                class="row overflow-lg-x-scroll overflow-y-hidden flex-nowrap"
              >
                <div
                  class="col-lg-4 col-sm-6 col-12 aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="blog-card blog-card-2">
                    <div class="blog-image-wrap relative">
                      <a
                        href="article.php"
                        class="blog-image"
                        aria-label="image du blog"
                      >
                        <img loading="lazy" decoding="async"                           src="assets/img/blog/tech-1.jpg"
                          alt="blog-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                      </a>
                      <p class="blog-publish text_14">
                        <span class="blog-author">
                          <span class="author-icon">
                            <svg
                              class="icon icon_16 icon-user"
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                            >
                              <path
                                d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              ></path>
                              <path
                                d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              ></path>
                            </svg>
                          </span>
                          <span class="author-text">Admin</span>
                        </span>
                        <span class="blog-date">
                          <span class="calender-icon">
                            <svg
                              class="icon icon_16 icon-calender"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 256 256"
                            >
                              <rect width="256" height="256" fill="none"></rect>
                              <rect
                                x="40"
                                y="40"
                                width="176"
                                height="176"
                                rx="8"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              ></rect>
                              <line
                                x1="176"
                                y1="24"
                                x2="176"
                                y2="56"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              ></line>
                              <line
                                x1="80"
                                y1="24"
                                x2="80"
                                y2="56"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              ></line>
                              <line
                                x1="40"
                                y1="88"
                                x2="216"
                                y2="88"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              ></line>
                            </svg>
                          </span>
                          <span class="publish-date">4 avril 2025</span>
                        </span>
                      </p>
                    </div>
                    <div class="blog-content">
                      <a
                        href="article.php"
                        class="blog-title heading_20 medium"
                      >
                        Pourquoi avoir des plantes chez soi : voici pourquoi !
                      </a>
                      <a
                        href="article.php"
                        class="core-link text_14 link-underline"
                        aria-label="bouton article"
                      >
                        Lire la suite
                      </a>
                    </div>
                  </div>
                </div>
                <div
                  class="col-lg-4 col-sm-6 col-12 aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="blog-card blog-card-2">
                    <div class="blog-image-wrap relative">
                      <a
                        href="article.php"
                        class="blog-image"
                        aria-label="image du blog"
                      >
                        <img loading="lazy" decoding="async"                           src="assets/img/blog/tech-2.jpg"
                          alt="blog-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                      </a>
                      <p class="blog-publish text_14">
                        <span class="blog-author">
                          <span class="author-icon">
                            <svg
                              class="icon icon_16 icon-user"
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                            >
                              <path
                                d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              ></path>
                              <path
                                d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              ></path>
                            </svg>
                          </span>
                          <span class="author-text">Admin</span>
                        </span>
                        <span class="blog-date">
                          <span class="calender-icon">
                            <svg
                              class="icon icon_16 icon-calender"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 256 256"
                            >
                              <rect width="256" height="256" fill="none"></rect>
                              <rect
                                x="40"
                                y="40"
                                width="176"
                                height="176"
                                rx="8"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              ></rect>
                              <line
                                x1="176"
                                y1="24"
                                x2="176"
                                y2="56"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              ></line>
                              <line
                                x1="80"
                                y1="24"
                                x2="80"
                                y2="56"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              ></line>
                              <line
                                x1="40"
                                y1="88"
                                x2="216"
                                y2="88"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              ></line>
                            </svg>
                          </span>
                          <span class="publish-date">4 avril 2025</span>
                        </span>
                      </p>
                    </div>
                    <div class="blog-content">
                      <a
                        href="article.php"
                        class="blog-title heading_20 medium"
                      >
                        Pourquoi avoir des plantes chez soi : voici pourquoi !
                      </a>
                      <a
                        href="article.php"
                        class="core-link text_14 link-underline"
                        aria-label="bouton article"
                      >
                        Lire la suite
                      </a>
                    </div>
                  </div>
                </div>
                <div
                  class="col-lg-4 col-sm-6 col-12 aos-init aos-animate"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <div class="blog-card blog-card-2">
                    <div class="blog-image-wrap relative">
                      <a
                        href="article.php"
                        class="blog-image"
                        aria-label="image du blog"
                      >
                        <img loading="lazy" decoding="async"                           src="assets/img/blog/tech-3.jpg"
                          alt="blog-image"
                          width="1100"
                          height="600"
                          loading="lazy"
                        />
                      </a>
                      <p class="blog-publish text text_14">
                        <span class="blog-author">
                          <span class="author-icon">
                            <svg
                              class="icon icon_16 icon-user"
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                            >
                              <path
                                d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              ></path>
                              <path
                                d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              ></path>
                            </svg>
                          </span>
                          <span class="author-text">Admin</span>
                        </span>
                        <span class="blog-date">
                          <span class="calender-icon">
                            <svg
                              class="icon icon_16 icon-calender"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 256 256"
                            >
                              <rect width="256" height="256" fill="none"></rect>
                              <rect
                                x="40"
                                y="40"
                                width="176"
                                height="176"
                                rx="8"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              ></rect>
                              <line
                                x1="176"
                                y1="24"
                                x2="176"
                                y2="56"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              ></line>
                              <line
                                x1="80"
                                y1="24"
                                x2="80"
                                y2="56"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              ></line>
                              <line
                                x1="40"
                                y1="88"
                                x2="216"
                                y2="88"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="16"
                              ></line>
                            </svg>
                          </span>
                          <span class="publish-date">4 avril 2025</span>
                        </span>
                      </p>
                    </div>
                    <div class="blog-content">
                      <a
                        href="article.php"
                        class="blog-title heading_20 medium"
                      >
                        Pourquoi avoir des plantes chez soi : voici pourquoi !
                      </a>
                      <a
                        href="article.php"
                        class="core-link text_14 link-underline"
                        aria-label="bouton article"
                      >
                        Lire la suite
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Latest blog end -->

         <!-- brand logo start -->
        <div class="brand-logo-section mt-100">
          <div class="brand-logo-inner">
            <div class="container">
              <div class="brand-logo-container overflow-hidden">
                <div
                  class="scroll-horizontal row align-items-center flex-nowrap"
                >
                  <div
                    class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    <a
                      href="index.php"
                      class="brand-logo d-flex align-items-center justify-content-center"
                    >
                      <img loading="lazy" decoding="async" src="assets/img/brand/1.png" alt="img" />
                    </a>
                  </div>
                  <div
                    class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    <a
                      href="index.php"
                      class="brand-logo d-flex align-items-center justify-content-center"
                    >
                      <img loading="lazy" decoding="async" src="assets/img/brand/2.png" alt="img" />
                    </a>
                  </div>
                  <div
                    class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    <a
                      href="index.php"
                      class="brand-logo d-flex align-items-center justify-content-center"
                    >
                      <img loading="lazy" decoding="async" src="assets/img/brand/3.png" alt="img" />
                    </a>
                  </div>
                  <div
                    class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    <a
                      href="index.php"
                      class="brand-logo d-flex align-items-center justify-content-center"
                    >
                      <img loading="lazy" decoding="async" src="assets/img/brand/4.png" alt="img" />
                    </a>
                  </div>
                  <div
                    class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    <a
                      href="index.php"
                      class="brand-logo d-flex align-items-center justify-content-center"
                    >
                      <img loading="lazy" decoding="async" src="assets/img/brand/5.png" alt="img" />
                    </a>
                  </div>
                  <div
                    class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    <a
                      href="index.php"
                      class="brand-logo d-flex align-items-center justify-content-center"
                    >
                      <img loading="lazy" decoding="async" src="assets/img/brand/6.png" alt="img" />
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- brand logo end -->
      </main>

      <!-- footer start -->
      <footer class="mt-100 overflow-hidden">
        <div class="footer-top bg-4">
          <div class="container-fluid">
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
                          stroke="#fff"
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
                          stroke="#fff"
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
                          stroke="#fff"
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
                          action="index-electronics.php#"
                          class="footer-newsletter-form d-flex align-items-center"
                        >
                          <input
                            class="footer-newsletter-input bg-transparent"
                            type="email"
                            placeholder="Votre e-mail"
                            autocomplete="off"
                          />
                          <button
                            class="footer-newsletter-btn newsletter-btn-white"
                            type="submit"
                          >
                            S'INSCRIRE
                          </button>
                        </form>
                      </div>
                      <div class="footer-social-wrapper">
                        <ul
                          class="footer-social list-unstyled d-flex align-items-center flex-wrap mb-0"
                        >
                          <li class="footer-social-item">
                            <a href="index-electronics.php#">
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
                                  fill="#FEFEFE"
                                />
                              </svg>
                            </a>
                          </li>
                          <li class="footer-social-item">
                            <a href="index-electronics.php#">
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
                                  fill="#FEFEFE"
                                />
                              </svg>
                            </a>
                          </li>
                          <li class="footer-social-item">
                            <a href="index-electronics.php#">
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
                                  fill="#FEFEFE"
                                />
                              </svg>
                            </a>
                          </li>
                          <li class="footer-social-item">
                            <a href="index-electronics.php#">
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
                                  fill="#FEFEFE"
                                />
                              </svg>
                            </a>
                          </li>
                          <li class="footer-social-item">
                            <a href="index-electronics.php#">
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
                                  fill="#FEFEFE"
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
        <div class="footer-bottom bg-4">
          <div class="container-fluid">
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
        class="offcanvas offcanvas-start offcanvas-electronics d-flex d-lg-none"
        tabindex="-1"
        id="drawer-menu"
      >
        <div class="offcanvas-wrapper">
          <div
            class="offcanvas-header category-menu-header border-bottom-black"
          >
            <button
              type="button"
              class="btn-close text-reset"
              data-bs-dismiss="offcanvas"
              aria-label="Fermer"
            ></button>
            <div class="mobile-menu-tablist" id="pills-tab" role="tablist">
              <button
                class="menu-tab-button button-reset active"
                data-bs-toggle="pill"
                data-bs-target="#mobile-menu-tab"
                type="button"
                aria-label="Menu"
              >
                <span class="heading text_18 medium">Menu</span>
                <span>
                  <svg
                    class="icon icon_18"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 256 256"
                  >
                    <rect width="256" height="256" fill="none" />
                    <polyline
                      points="208 96 128 176 48 96"
                      fill="none"
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="16"
                    />
                  </svg>
                </span>
              </button>
              <button
                class="menu-tab-button subheading text_18 button-reset"
                data-bs-toggle="pill"
                data-bs-target="#category-list-tab"
                type="button"
                aria-label="Catégorie"
              >
                <span class="heading text_18 medium">Catégorie</span>
                <span>
                  <svg
                    class="icon icon_18"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 256 256"
                  >
                    <rect width="256" height="256" fill="none" />
                    <polyline
                      points="208 96 128 176 48 96"
                      fill="none"
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="16"
                    />
                  </svg>
                </span>
              </button>
            </div>
          </div>
          <div class="mobile-cat-menu" id="pills-tabContent">
            <div
              class="mobile-menu-tab active"
              id="mobile-menu-tab"
              aria-labelledby="mobile-menu-tab"
            >
              <div
                class="offcanvas-body p-0 d-flex flex-column justify-content-between"
              >
                <mobile-submenu>
                  <nav class="site-navigation">
                    <?php $menu_mobile = true; include __DIR__ . '/includes/menu.php'; ?>
                  </nav>
                </mobile-submenu>
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
            <div
              class="mobile-menu-tab"
              id="category-list-tab"
              aria-labelledby="category-list-tab"
            >
              <div
                class="offcanvas-body p-0 d-flex flex-column justify-content-between"
              >
                <mobile-submenu>
                  <nav class="site-navigation">
                    <?php $menu_list = $menu_categories; $menu_mobile = true; $menu_link_class = 'text_16'; include __DIR__ . '/includes/menu.php'; ?>
                  </nav>
                </mobile-submenu>
              </div>
            </div>
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
                    <a href="index-electronics.php#">Canapé d'angle réversible Eliot</a>
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
                      <a href="index-electronics.php#" class="product-remove">Supprimer</a>
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
                    <a href="index-electronics.php#">Fauteuil lounge Vita</a>
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
                      <a href="index-electronics.php#" class="product-remove">Supprimer</a>
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
                    <a href="index-electronics.php#">Chaise de salle à manger Sarno</a>
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
                      <a href="index-electronics.php#" class="product-remove">Supprimer</a>
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
                    <a href="index-electronics.php#">Fauteuil lounge Vita</a>
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
                      <a href="index-electronics.php#" class="product-remove">Supprimer</a>
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
