<!doctype html>
<html lang="en" class="no-js">

<head>
    <title>Mobilier Addict</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="meta description">
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- all css -->
    <style>
        :root {
            --primary-color: #00234d;
            --secondary-color: #d8327f;

            --btn-primary-border-radius: 0.25rem;
            --btn-primary-color: #fff;
            --btn-primary-background-color: #00234D;
            --btn-primary-border-color: #00234D;
            --btn-primary-hover-color: #fff;
            --btn-primary-background-hover-color: #00234D;
            --btn-primary-border-hover-color: #00234D;
            --btn-primary-font-weight: 500;

            --btn-secondary-border-radius: 0.25rem;
            --btn-secondary-color: #00234D;
            --btn-secondary-background-color: transparent;
            --btn-secondary-border-color: #00234D;
            --btn-secondary-hover-color: #fff;
            --btn-secondary-background-hover-color: #00234D;
            --btn-secondary-border-hover-color: #00234D;
            --btn-secondary-font-weight: 500;

            --heading-color: #000;
            --heading-font-family: 'Poppins', sans-serif;
            --heading-font-weight: 700;

            --title-color: #000;
            --title-font-family: 'Poppins', sans-serif;
            --title-font-weight: 400;

            --body-color: #000;
            --body-background-color: #fff;
            --body-font-family: 'Poppins', sans-serif;
            --body-font-size: 14px;
            --body-font-weight: 400;

            --section-heading-color: #000;
            --section-heading-font-family: 'Poppins', sans-serif;
            --section-heading-font-size: 48px;
            --section-heading-font-weight: 600;

            --section-subheading-color: #000;
            --section-subheading-font-family: 'Poppins', sans-serif;
            --section-subheading-font-size: 16px;
            --section-subheading-font-weight: 400;
        }
    </style>

    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
</head>

<body>
    <div class="body-wrapper">
      <?php include __DIR__ . '/includes/announcement.php'; ?>

      <?php include __DIR__ . '/includes/header.php'; ?>


        <!-- breadcrumb start -->
        <div class="breadcrumb">
            <div class="container">
                <ul class="list-unstyled d-flex align-items-center m-0">
                    <li><a href="index.php">Accueil</a></li>
                    <li>
                        <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.4">
                                <path
                                    d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                                    fill="#000" />
                            </g>
                        </svg>
                    </li>
                    <li>Panier</li>
                    <li>
                        <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.4">
                                <path
                                    d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                                    fill="#000" />
                            </g>
                        </svg>
                    </li>
                    <li>Paiement</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <main id="MainContent" class="content-for-layout">
            <div class="checkout-page mt-100">
                <div class="container">
                    <div class="checkout-page-wrapper">
                        <div class="row">
                            <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                                <div class="section-header mb-3">
                                    <h2 class="section-heading">Paiement</h2>
                                </div>
            
                                <div class="checkout-progress overflow-hidden">
                                    <ol class="checkout-bar px-0">
                                        <li class="progress-step step-done"><a href="cart.php">Panier</a></li>
                                        <li class="progress-step step-active"><a href="checkout.php">Vos informations</a></li>
                                        <li class="progress-step step-todo"><a href="checkout.php">Livraison</a></li>
                                        <li class="progress-step step-todo"><a href="checkout.php">Paiement</a></li>
                                        <li class="progress-step step-todo"><a href="checkout.php">Avis</a></li>
                                    </ol>
                                </div>

                                <div class="checkout-user-area overflow-hidden d-flex align-items-center">
                                    <div class="checkout-user-img me-4">
                                        <img loading="lazy" decoding="async" src="assets/img/checkout/user.jpg" alt="img">
                                    </div>
                                    <div class="checkout-user-details d-flex align-items-center justify-content-between w-100">
                                        <div class="checkout-user-info">
                                            <h2 class="checkout-user-name">Susan Gardner</h2>
                                            <p class="checkout-user-address mb-0">2752 avenue Royale, Québec, G1R 2B2, Canada</p>
                                        </div>
                                        
                                        <a href="checkout.php#" class="edit-user btn-secondary">MODIFIER LE PROFIL</a>
                                    </div>
                                </div>

                                <div class="shipping-address-area">
                                    <h2 class="shipping-address-heading pb-1">Adresse de livraison</h2>
                                    <div class="shipping-address-form-wrapper">
                                        <form action="checkout.php#" class="shipping-address-form common-form">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Prénom</label>
                                                        <input type="text" />
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Nom</label>
                                                        <input type="text" />
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Adresse e-mail</label>
                                                        <input type="email" />
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Numéro de téléphone</label>
                                                        <input type="text" />
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Société</label>
                                                        <input type="text" />
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Pays</label>
                                                        <select class="form-select">
                                                            <option selected="ca">Canada</option>
                                                            <option value="us">États-Unis</option>
                                                            <option value="au">Australie</option>
                                                            <option value="me">Mexique</option>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Ville</label>                                                        
                                                        <select class="form-select">
                                                            <option selected="ca">Toronto</option>
                                                            <option value="us">Québec</option>
                                                            <option value="au">Windsor</option>
                                                            <option value="me">Calgary</option>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Code postal</label>
                                                        <input type="text" />
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Adresse 1</label>
                                                        <input type="text" />
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Adresse 2</label>
                                                        <input type="text" />
                                                    </fieldset>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                                <div class="shipping-address-area billing-area">
                                    <h2 class="shipping-address-heading pb-1">Adresse de facturation</h2>
                                    <div class="form-checkbox d-flex align-items-center mt-4">
                                        <input class="form-check-input mt-0" type="checkbox">
                                        <label class="form-check-label ms-2">
                                            Identique à l'adresse de livraison
                                        </label>
                                    </div>
                                </div>
                                <div class="shipping-address-area billing-area">
                                    <div class="minicart-btn-area d-flex align-items-center justify-content-between flex-wrap">
                                        <a href="cart.php" class="checkout-page-btn minicart-btn btn-secondary">RETOUR AU PANIER</a>
                                        <a href="checkout.php" class="checkout-page-btn minicart-btn btn-primary">PASSER À LA LIVRAISON</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                                <div class="cart-total-area checkout-summary-area">
                                    <h3 class="d-none d-lg-block mb-0 text-center heading_24 mb-4">Récapitulatif de commande</h4>

                                    <div class="minicart-item d-flex">
                                        <div class="mini-img-wrapper">
                                            <img loading="lazy" decoding="async" class="mini-img" src="assets/img/products/real/1770689632_0OTK5fkOpt.jpg" alt="img">
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="checkout.php#">Canapé d'angle réversible Eliot</a></h2>
                                            <p class="product-vendor">150 FCFA x 1</p>
                                        </div>
                                    </div>
                                    <div class="minicart-item d-flex">
                                        <div class="mini-img-wrapper">
                                            <img loading="lazy" decoding="async" class="mini-img" src="assets/img/products/real/1769643261_righaaXc9N.jpg" alt="img">
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="checkout.php#">Canapé d'angle réversible Eliot</a></h2>
                                            <p class="product-vendor">150 FCFA x 1</p>
                                        </div>
                                    </div>
                                    <div class="minicart-item d-flex">
                                        <div class="mini-img-wrapper">
                                            <img loading="lazy" decoding="async" class="mini-img" src="assets/img/products/real/1770691758_oLpAhmB0Wd.jpg" alt="img">
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="checkout.php#">Canapé d'angle réversible Eliot</a></h2>
                                            <p class="product-vendor">150 FCFA x 1</p>
                                        </div>
                                    </div>
                                    <div class="minicart-item d-flex">
                                        <div class="mini-img-wrapper">
                                            <img loading="lazy" decoding="async" class="mini-img" src="assets/img/products/real/1770691758_zO2jmRAXwA.jpg" alt="img">
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="checkout.php#">Canapé d'angle réversible Eliot</a></h2>
                                            <p class="product-vendor">150 FCFA x 1</p>
                                        </div>
                                    </div>

                                    <div class="cart-total-box mt-4 bg-transparent p-0">
                                        <div class="subtotal-item subtotal-box">
                                            <h4 class="subtotal-title">Sous-total :</h4>
                                            <p class="subtotal-value">465,00 FCFA</p>
                                        </div>
                                        <div class="subtotal-item shipping-box">
                                            <h4 class="subtotal-title">Livraison :</h4>
                                            <p class="subtotal-value">10,00 FCFA</p>
                                        </div>
                                        <div class="subtotal-item discount-box">
                                            <h4 class="subtotal-title">Remise :</h4>
                                            <p class="subtotal-value">100,00 FCFA</p>
                                        </div>
                                        <hr />
                                        <div class="subtotal-item discount-box">
                                            <h4 class="subtotal-title">Total :</h4>
                                            <p class="subtotal-value">1000,00 FCFA</p>
                                        </div>


                                        <div class="mt-4 checkout-promo-code">
                                            <input class="input-promo-code" type="text" placeholder="Code promo" />
                                            <a href="checkout.php" class="btn-apply-code position-relative btn-secondary text-uppercase mt-3">
                                                Appliquer le code promo
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </main>
        
        <!-- footer start -->
        <footer class="mt-100 overflow-hidden">
            <div class="footer-top bg-4">
                <div class="container">
                    <div class="footer-widget-wrapper">
                        <div class="row justify-content-between">
                            <div class="col-xl-2 col-lg-2 col-md-6 col-12 footer-widget">
                                <div class="footer-widget-inner">
                                    <h4 class="footer-heading d-flex align-items-center justify-content-between">
                                        <span>À propos</span>
                                        <span class="d-md-none">
                                            <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                                stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
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
                                    <h4 class="footer-heading d-flex align-items-center justify-content-between">
                                        <span>Achats</span>
                                        <span class="d-md-none">
                                            <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                                stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
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
                                    <h4 class="footer-heading d-flex align-items-center justify-content-between">
                                        <span>Aide</span>
                                        <span class="d-md-none">
                                            <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                                stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
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
                                        <a href="index.php"><span class="logo-text logo-text-white">Mobilier Addict</span></a>
                                    </h4>
                                    <div class="footer-newsletter">
                                        <p class="footer-text mb-3">Restez informé de toutes les nouveautés.</p>
                                        <div class="newsletter-wrapper">
                                            <form action="checkout.php#" class="footer-newsletter-form d-flex align-items-center">
                                                <input class="footer-newsletter-input bg-transparent" type="email"
                                                    placeholder="Votre e-mail" autocomplete="off">
                                                <button class="footer-newsletter-btn newsletter-btn-white"
                                                    type="submit">S'INSCRIRE</button>
                                            </form>
                                        </div>
                                        <div class="footer-social-wrapper">
                                            <ul
                                                class="footer-social list-unstyled d-flex align-items-center flex-wrap mb-0">
                                                <li class="footer-social-item">
                                                    <a href="checkout.php#">
                                                        <svg class="icon icon-twitter" width="20" height="20"
                                                            viewBox="0 0 20 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M17.1452 6.62529C17.1452 6.79391 17.1452 6.94848 17.1452 7.08899C17.1452 8.35363 16.9063 9.60422 16.4286 10.8407C15.9789 12.0492 15.3185 13.1593 14.4473 14.171C13.6042 15.1827 12.4941 16.0117 11.1171 16.6581C9.76815 17.2763 8.27869 17.5855 6.64871 17.5855C4.59719 17.5855 2.71429 17.0375 1 15.9415C1.28103 15.9696 1.57611 15.9836 1.88525 15.9836C3.59953 15.9836 5.13115 15.4637 6.48009 14.4239C5.66511 14.3958 4.93443 14.1429 4.28806 13.6651C3.66979 13.1874 3.24824 12.5831 3.02342 11.8525C3.24824 11.9087 3.47307 11.9368 3.69789 11.9368C4.03513 11.9368 4.35831 11.8806 4.66745 11.7681C3.82436 11.5995 3.12178 11.178 2.55972 10.5035C1.99766 9.82904 1.71663 9.05621 1.71663 8.18501C1.71663 8.15691 1.71663 8.14286 1.71663 8.14286C2.25059 8.42389 2.81265 8.57845 3.40281 8.60656C2.30679 7.84777 1.75878 6.82201 1.75878 5.52927C1.75878 4.8548 1.9274 4.23653 2.26464 3.67447C3.19204 4.79859 4.30211 5.69789 5.59485 6.37237C6.91569 7.04684 8.33489 7.42623 9.85246 7.51054C9.79625 7.22951 9.76815 6.94848 9.76815 6.66745C9.76815 5.65574 10.1194 4.79859 10.822 4.09602C11.5527 3.36534 12.4239 3 13.4356 3C14.5035 3 15.4028 3.37939 16.1335 4.13817C16.9766 3.96956 17.7635 3.67447 18.4941 3.25293C18.2131 4.12412 17.6651 4.79859 16.8501 5.27635C17.6089 5.19204 18.3255 5.00937 19 4.72834C18.4941 5.45902 17.8759 6.09133 17.1452 6.62529Z"
                                                                fill="#FEFEFE" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li class="footer-social-item">
                                                    <a href="checkout.php#">
                                                        <svg class="icon icon-facebook" width="20" height="20"
                                                            viewBox="0 0 20 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M16.3021 4.58314H14.0258C13.1546 4.58314 12.4098 4.89227 11.7916 5.51054C11.2014 6.12881 10.9063 6.87354 10.9063 7.74473V9.97892H9.09368V12.6768H10.9063V18.9578H13.6042V12.6768H16.3021V9.97892H13.6042V8.16628C13.6042 7.94145 13.6885 7.74473 13.8571 7.57611C14.0258 7.37939 14.2365 7.28103 14.4895 7.28103H16.3021V4.58314ZM1 2C1 1.44772 1.44772 1 2 1H18C18.5523 1 19 1.44772 19 2V17.9578C19 18.5101 18.5523 18.9578 18 18.9578H2C1.44772 18.9578 1 18.5101 1 17.9578V2Z"
                                                                fill="#FEFEFE" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li class="footer-social-item">
                                                    <a href="checkout.php#">
                                                        <svg class="icon icon-instagram" width="20" height="20"
                                                            viewBox="0 0 20 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M9.99998 2.62165C12.4031 2.62165 12.6877 2.6308 13.6367 2.6741C14.5142 2.71415 14.9908 2.86077 15.3079 2.98398C15.728 3.14725 16.0278 3.34231 16.3428 3.65723C16.6577 3.97215 16.8528 4.272 17.016 4.69206C17.1392 5.00923 17.2859 5.48577 17.3259 6.36323C17.3692 7.31228 17.3783 7.5969 17.3783 10C17.3783 12.4031 17.3692 12.6878 17.3259 13.6368C17.2859 14.5143 17.1392 14.9908 17.016 15.308C16.8528 15.728 16.6577 16.0279 16.3428 16.3428C16.0278 16.6577 15.728 16.8528 15.3079 17.016C14.9908 17.1393 14.5142 17.2859 13.6367 17.3259C12.6879 17.3692 12.4032 17.3784 9.99998 17.3784C7.59672 17.3784 7.3121 17.3692 6.36323 17.3259C5.48574 17.2859 5.00919 17.1393 4.69206 17.016C4.27196 16.8528 3.97212 16.6577 3.6572 16.3428C3.34227 16.0279 3.14721 15.728 2.98398 15.308C2.86073 14.9908 2.71411 14.5143 2.67406 13.6368C2.63076 12.6878 2.62162 12.4031 2.62162 10C2.62162 7.5969 2.63076 7.31228 2.67406 6.36326C2.71411 5.48577 2.86073 5.00923 2.98398 4.69206C3.14721 4.272 3.34227 3.97215 3.6572 3.65723C3.97212 3.34231 4.27196 3.14725 4.69206 2.98398C5.00919 2.86077 5.48574 2.71415 6.36319 2.6741C7.31224 2.6308 7.59687 2.62165 9.99998 2.62165ZM9.99998 1C7.55571 1 7.24926 1.01036 6.28931 1.05416C5.33133 1.09789 4.67712 1.25001 4.10462 1.47251C3.51279 1.70251 3.01088 2.01025 2.51055 2.51058C2.01021 3.01092 1.70247 3.51283 1.47247 4.10466C1.24997 4.67716 1.09785 5.33137 1.05412 6.28935C1.01032 7.24926 1 7.55575 1 10C1 12.4443 1.01032 12.7508 1.05412 13.7107C1.09785 14.6687 1.24997 15.3229 1.47247 15.8954C1.70247 16.4872 2.01021 16.9891 2.51055 17.4895C3.01088 17.9898 3.51279 18.2975 4.10462 18.5275C4.67712 18.75 5.33133 18.9021 6.28931 18.9459C7.24926 18.9897 7.55571 19 9.99998 19C12.4443 19 12.7507 18.9897 13.7107 18.9459C14.6686 18.9021 15.3228 18.75 15.8953 18.5275C16.4872 18.2975 16.9891 17.9898 17.4894 17.4895C17.9898 16.9891 18.2975 16.4872 18.5275 15.8954C18.75 15.3229 18.9021 14.6687 18.9458 13.7107C18.9896 12.7508 19 12.4443 19 10C19 7.55575 18.9896 7.24926 18.9458 6.28935C18.9021 5.33137 18.75 4.67716 18.5275 4.10466C18.2975 3.51283 17.9898 3.01092 17.4894 2.51058C16.9891 2.01025 16.4872 1.70251 15.8953 1.47251C15.3228 1.25001 14.6686 1.09789 13.7107 1.05416C12.7507 1.01036 12.4443 1 9.99998 1ZM9.99998 5.37838C7.44753 5.37838 5.37835 7.44757 5.37835 10C5.37835 12.5525 7.44753 14.6217 9.99998 14.6217C12.5524 14.6217 14.6216 12.5525 14.6216 10C14.6216 7.44757 12.5524 5.37838 9.99998 5.37838ZM9.99998 13C8.34314 13 6.99996 11.6569 6.99996 10C6.99996 8.34317 8.34314 7 9.99998 7C11.6568 7 13 8.34317 13 10C13 11.6569 11.6568 13 9.99998 13ZM15.8842 5.19579C15.8842 5.79226 15.4007 6.27581 14.8042 6.27581C14.2077 6.27581 13.7242 5.79226 13.7242 5.19579C13.7242 4.59931 14.2077 4.1158 14.8042 4.1158C15.4007 4.1158 15.8842 4.59931 15.8842 5.19579Z"
                                                                fill="#FEFEFE" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li class="footer-social-item">
                                                    <a href="checkout.php#">
                                                        <svg class="icon icon-tiktok" width="20" height="20"
                                                            viewBox="0 0 20 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M13.2367 1C13.5336 3.55445 14.9591 5.0774 17.4375 5.23942V8.11251C16.0012 8.25292 14.7431 7.78307 13.2799 6.89739V12.2709C13.2799 19.0972 5.8393 21.2304 2.84795 16.3375C0.925716 13.189 2.10282 7.66426 8.26909 7.44284V10.4725C7.79933 10.5481 7.29717 10.667 6.83821 10.8236C5.46673 11.288 4.68919 12.1575 4.90518 13.6913C5.32094 16.6292 10.7097 17.4986 10.2615 11.7579V1.0054H13.2367V1Z"
                                                                fill="#FEFEFE" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li class="footer-social-item">
                                                    <a href="checkout.php#">
                                                        <svg class="icon icon-youtube" width="20" height="20"
                                                            viewBox="0 0 20 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M18.7892 6.69789C18.9297 7.6815 19 8.65105 19 9.60656V10.9555L18.7892 13.8642C18.6768 14.6792 18.4379 15.2693 18.0726 15.6347C17.6792 16.0281 17.089 16.281 16.3021 16.3934C15.5433 16.4496 14.63 16.4918 13.5621 16.5199C12.5222 16.548 11.6651 16.5621 10.9906 16.5621H9.97892C6.85948 16.534 4.82201 16.4778 3.86651 16.3934C3.86651 16.3934 3.7541 16.3794 3.52927 16.3513C3.30445 16.3232 3.12178 16.2951 2.98126 16.267C2.84075 16.2389 2.65808 16.1686 2.43326 16.0562C2.23653 15.9438 2.05386 15.8033 1.88525 15.6347C1.74473 15.466 1.60422 15.2412 1.4637 14.9602C1.35129 14.6511 1.28103 14.3841 1.25293 14.1593L1.16862 13.8642C1.05621 12.8806 1 11.911 1 10.9555V9.60656L1.16862 6.69789C1.28103 5.8829 1.51991 5.29274 1.88525 4.9274C2.27869 4.50585 2.8829 4.25293 3.69789 4.16862C4.45667 4.11241 5.35597 4.07026 6.39578 4.04215C7.4356 4.01405 8.29274 4 8.96721 4H9.97892C12.5082 4 14.6159 4.05621 16.3021 4.16862C17.089 4.25293 17.6792 4.50585 18.0726 4.9274C18.185 5.03981 18.2834 5.18033 18.3677 5.34895C18.452 5.48946 18.5222 5.64403 18.5785 5.81265C18.6347 5.95316 18.6768 6.09368 18.7049 6.23419C18.733 6.37471 18.7611 6.48712 18.7892 6.57143V6.69789ZM12.4239 10.4075L13.0141 10.1124L8.16628 7.58314V12.6417L12.4239 10.4075Z"
                                                                fill="#FEFEFE" />
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
                <div class="container">
                    <div
                        class="footer-bottom-inner d-flex flex-wrap justify-content-md-between justify-content-center align-items-center">
                        <ul class="footer-bottom-menu list-unstyled d-flex flex-wrap align-items-center mb-0">
                            <?php $footerGroup = 'legal'; include __DIR__ . '/includes/footer-links.php'; ?>
                        </ul>
                        <p class="copyright footer-text">©<span class="current-year"></span> Mobilier Addict.</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer end -->
        
        <!-- scrollup start -->
        <button id="scrollup">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>  
        </button>
        <!-- scrollup end -->

        <!-- drawer menu start -->
        <div class="offcanvas offcanvas-start d-flex d-lg-none" tabindex="-1" id="drawer-menu">
            <div class="offcanvas-wrapper">
                <div class="offcanvas-header border-btm-black">
                    <h5 class="drawer-heading">Menu</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Fermer"></button>
                </div>
                <div class="offcanvas-body p-0 d-flex flex-column justify-content-between">
                    <nav class="site-navigation">
                        <?php $menu_mobile = true; include __DIR__ . '/includes/menu.php'; ?>
                    </nav>
                    <ul class="utility-menu list-unstyled">
                        <li class="utilty-menu-item">
                            <a class="announcement-text" href="tel:+2250799140356">
                                <span class="utilty-icon-wrapper">
                                    <svg class="icon icon-phone" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                        </path>
                                    </svg>
                                </span>
                                Appelez : +225 07 99 14 03 56
                            </a>
                        </li>
                        <li class="utilty-menu-item">
                            <a class="announcement-login announcement-text" href="login.php">
                                <span class="utilty-icon-wrapper">
                                    <svg class="icon icon-user" width="24" height="24" viewBox="0 0 10 11" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5 0C3.07227 0 1.5 1.57227 1.5 3.5C1.5 4.70508 2.11523 5.77539 3.04688 6.40625C1.26367 7.17188 0 8.94141 0 11H1C1 8.78516 2.78516 7 5 7C7.21484 7 9 8.78516 9 11H10C10 8.94141 8.73633 7.17188 6.95312 6.40625C7.88477 5.77539 8.5 4.70508 8.5 3.5C8.5 1.57227 6.92773 0 5 0ZM5 1C6.38672 1 7.5 2.11328 7.5 3.5C7.5 4.88672 6.38672 6 5 6C3.61328 6 2.5 4.88672 2.5 3.5C2.5 2.11328 3.61328 1 5 1Z"
                                            fill="#000" />
                                    </svg>
                                </span>
                                <span>Connexion</span>
                            </a>
                        </li>
                        <li class="utilty-menu-item">
                            <a class="header-action-item header-wishlist" href="wishlist.php">
                                <span class="utilty-icon-wrapper">
                                    <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22"
                                        fill="#000" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                            fill="#000" />
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
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Fermer"></button>
            </div>
            <div class="offcanvas-body p-0">
                <div class="cart-content-area d-flex justify-content-between flex-column">
                    <div class="minicart-loop custom-scrollbar">
                        <!-- minicart item -->
                        <div class="minicart-item d-flex">
                            <div class="mini-img-wrapper">
                                <img loading="lazy" decoding="async" class="mini-img" src="assets/img/products/real/1770738680_YSa0YK1dz1.jpg" alt="img">
                            </div>
                            <div class="product-info">
                                <h2 class="product-title"><a href="checkout.php#">Canapé d'angle réversible Eliot</a></h2>
                                <p class="product-vendor">XS / Gris colombe</p>
                                <div class="misc d-flex align-items-end justify-content-between">
                                    <div class="quantity d-flex align-items-center justify-content-between">
                                        <button class="qty-btn dec-qty"><img loading="lazy" decoding="async" src="assets/img/icon/minus.svg"
                                                alt="minus"></button>
                                        <input class="qty-input" type="number" name="qty" value="1" min="0">
                                        <button class="qty-btn inc-qty"><img loading="lazy" decoding="async" src="assets/img/icon/plus.svg"
                                                alt="plus"></button>
                                    </div>
                                    <div class="product-remove-area d-flex flex-column align-items-end">
                                        <div class="product-price">580,00 FCFA</div>
                                        <a href="checkout.php#" class="product-remove">Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- minicart item -->
                        <div class="minicart-item d-flex">
                            <div class="mini-img-wrapper">
                                <img loading="lazy" decoding="async" class="mini-img" src="assets/img/products/real/1770738680_Z9FYQSbomB.jpg" alt="img">
                            </div>
                            <div class="product-info">
                                <h2 class="product-title"><a href="checkout.php#">Fauteuil lounge Vita</a></h2>
                                <p class="product-vendor">XS / Rose</p>
                                <div class="misc d-flex align-items-end justify-content-between">
                                    <div class="quantity d-flex align-items-center justify-content-between">
                                        <button class="qty-btn dec-qty"><img loading="lazy" decoding="async" src="assets/img/icon/minus.svg"
                                                alt="minus"></button>
                                        <input class="qty-input" type="number" name="qty" value="1" min="0">
                                        <button class="qty-btn inc-qty"><img loading="lazy" decoding="async" src="assets/img/icon/plus.svg"
                                                alt="plus"></button>
                                    </div>
                                    <div class="product-remove-area d-flex flex-column align-items-end">
                                        <div class="product-price">580,00 FCFA</div>
                                        <a href="checkout.php#" class="product-remove">Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- minicart item -->
                        <div class="minicart-item d-flex">
                            <div class="mini-img-wrapper">
                                <img loading="lazy" decoding="async" class="mini-img" src="assets/img/products/real/1769651796_8nTO7f2rrg.jpg" alt="img">
                            </div>
                            <div class="product-info">
                                <h2 class="product-title"><a href="checkout.php#">Chaise de salle à manger Sarno</a></h2>
                                <p class="product-vendor">XS / Gris colombe</p>
                                <div class="misc d-flex align-items-end justify-content-between">
                                    <div class="quantity d-flex align-items-center justify-content-between">
                                        <button class="qty-btn dec-qty"><img loading="lazy" decoding="async" src="assets/img/icon/minus.svg"
                                                alt="minus"></button>
                                        <input class="qty-input" type="number" name="qty" value="1" min="0">
                                        <button class="qty-btn inc-qty"><img loading="lazy" decoding="async" src="assets/img/icon/plus.svg"
                                                alt="plus"></button>
                                    </div>
                                    <div class="product-remove-area d-flex flex-column align-items-end">
                                        <div class="product-price">580,00 FCFA</div>
                                        <a href="checkout.php#" class="product-remove">Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- minicart item -->
                        <div class="minicart-item d-flex">
                            <div class="mini-img-wrapper">
                                <img loading="lazy" decoding="async" class="mini-img" src="assets/img/products/real/1769999657_1CIVZl8UG6.jpg" alt="img">
                            </div>
                            <div class="product-info">
                                <h2 class="product-title"><a href="checkout.php#">Fauteuil lounge Vita</a></h2>
                                <p class="product-vendor">XS / Gris colombe</p>
                                <div class="misc d-flex align-items-end justify-content-between">
                                    <div class="quantity d-flex align-items-center justify-content-between">
                                        <button class="qty-btn dec-qty"><img loading="lazy" decoding="async" src="assets/img/icon/minus.svg"
                                                alt="minus"></button>
                                        <input class="qty-input" type="number" name="qty" value="1" min="0">
                                        <button class="qty-btn inc-qty"><img loading="lazy" decoding="async" src="assets/img/icon/plus.svg"
                                                alt="plus"></button>
                                    </div>
                                    <div class="product-remove-area d-flex flex-column align-items-end">
                                        <div class="product-price">580,00 FCFA</div>
                                        <a href="checkout.php#" class="product-remove">Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="minicart-footer">
                        <div class="minicart-calc-area">
                            <div class="minicart-calc d-flex align-items-center justify-content-between">
                                <span class="cart-subtotal mb-0">Sous-total</span>
                                <span class="cart-subprice">1548,00 FCFA</span>
                            </div>
                            <p class="cart-taxes text-center my-4">Les taxes et la livraison seront calculées lors du paiement.
                            </p>
                        </div>
                        <div class="minicart-btn-area d-flex align-items-center justify-content-between">
                            <a href="cart.php" class="minicart-btn btn-secondary">Voir le panier</a>
                            <a href="checkout.php" class="minicart-btn btn-primary">Paiement</a>
                        </div>
                    </div>
                </div>
                <div class="cart-empty-area text-center py-5 d-none">
                    <div class="cart-empty-icon pb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
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
        
        <!-- all js -->
        <script src="assets/js/vendor.js" defer></script>
        <script src="assets/js/main.min.js" defer></script>
    </div>
</body>

</html>