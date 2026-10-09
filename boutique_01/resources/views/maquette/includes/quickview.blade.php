@php
// Aperçu rapide produit — literie (partagé sur toutes les pages)
$qv_form_action = basename($_SERVER['PHP_SELF']);
@endphp
<!-- product quickview start -->
<div class="modal fade" tabindex="-1" id="quickview-modal">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-gallery product-gallery-vertical d-flex">
                            <div class="product-img-large">
                                <div class="qv-large-slider img-large-slider common-slider" data-slick='{
                                    "slidesToShow": 1,
                                    "slidesToScroll": 1,
                                    "dots": false,
                                    "arrows": false,
                                    "asNavFor": ".qv-thumb-slider"
                                }'>
                                    <div class="img-large-wrapper">
                                        <img src="{{ asset('assets/maquette/') }}/img/products/real/1770689632_0OTK5fkOpt.jpg" alt="Matelas Addict Confort — vue principale">
                                    </div>
                                    <div class="img-large-wrapper">
                                        <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/products/real/1769643261_righaaXc9N.jpg" alt="Matelas dans une chambre lumineuse">
                                    </div>
                                    <div class="img-large-wrapper">
                                        <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/products/real/1770691758_oLpAhmB0Wd.jpg" alt="Chambre à coucher équipée">
                                    </div>
                                    <div class="img-large-wrapper">
                                        <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/products/real/1770738680_YSa0YK1dz1.jpg" alt="Détail de la literie">
                                    </div>
                                </div>
                            </div>
                            <div class="product-img-thumb">
                                <div class="qv-thumb-slider img-thumb-slider common-slider" data-vertical-slider="true" data-slick='{
                                    "slidesToShow": 4,
                                    "slidesToScroll": 1,
                                    "dots": false,
                                    "arrows": true,
                                    "infinite": false,
                                    "speed": 300,
                                    "cssEase": "ease",
                                    "focusOnSelect": true,
                                    "swipeToSlide": true,
                                    "asNavFor": ".qv-large-slider"
                                }'>
                                    <div><div class="img-thumb-wrapper"><img src="{{ asset('assets/maquette/') }}/img/products/real/1770691758_zO2jmRAXwA.jpg" alt=""></div></div>
                                    <div><div class="img-thumb-wrapper"><img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/products/real/1770738680_Z9FYQSbomB.jpg" alt=""></div></div>
                                    <div><div class="img-thumb-wrapper"><img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/products/real/1770689632_0OTK5fkOpt.jpg" alt=""></div></div>
                                    <div><div class="img-thumb-wrapper"><img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/products/real/1769643261_righaaXc9N.jpg" alt=""></div></div>
                                </div>
                                <div class="activate-arrows show-arrows-always arrows-white d-none d-lg-flex justify-content-between mt-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-details ps-lg-4">
                            <div class="mb-3"><span class="product-availability">En stock</span></div>
                            <h2 class="product-title mb-3">Matelas Addict Confort</h2>
                            <div class="product-price-wrapper mb-3">
                                <span class="product-price regular-price">189,00 FCFA</span>
                            </div>
                            <p class="product-description mb-4">
                                Matelas au soutien équilibré, pensé pour les climats chauds :
                                mousse haute résilience, housse respirante amovible et finitions
                                soignées. Disponible en plusieurs dimensions pour s'adapter à
                                votre chambre.
                            </p>
                            <div class="product-sku product-meta mb-1">
                                <strong class="label">Réf. :</strong> MA-MAT-CONF
                            </div>
                            <div class="product-vendor product-meta mb-3">
                                <strong class="label">Gamme :</strong> Literie — Addict
                            </div>

                            <div class="product-variant-wrapper">
                                <div class="product-variant product-variant-other">
                                    <strong class="label mb-1 d-block">Taille :</strong>
                                    <ul class="variant-list list-unstyled d-flex align-items-center flex-wrap">
                                        <li class="variant-item">
                                            <input type="radio" name="qv-size" value="90x190" checked>
                                            <label class="variant-label">90 × 190</label>
                                        </li>
                                        <li class="variant-item">
                                            <input type="radio" name="qv-size" value="140x190">
                                            <label class="variant-label">140 × 190</label>
                                        </li>
                                        <li class="variant-item">
                                            <input type="radio" name="qv-size" value="160x200">
                                            <label class="variant-label">160 × 200</label>
                                        </li>
                                        <li class="variant-item">
                                            <input type="radio" name="qv-size" value="180x200">
                                            <label class="variant-label">180 × 200</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="misc d-flex align-items-end justify-content-between mt-4">
                                <div class="quantity d-flex align-items-center justify-content-between">
                                    <button class="qty-btn dec-qty" aria-label="Diminuer la quantité"><img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/minus.svg" alt=""></button>
                                    <input class="qty-input" type="number" name="qty" value="1" min="1" aria-label="Quantité">
                                    <button class="qty-btn inc-qty" aria-label="Augmenter la quantité"><img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/plus.svg" alt=""></button>
                                </div>
                                <a class="message-popup d-flex align-items-center" href="{{ route('pages.contact') }}">
                                    <span class="message-popup-icon">
                                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.5 4.25V16.25H4.5V20.0703L5.71875 19.0859L9.25781 16.25H16.5V4.25H1.5ZM3 5.75H15V14.75H8.74219L8.53125 14.9141L6 16.9297V14.75H3V5.75ZM18 7.25V8.75H21V17.75H18V19.9297L15.2578 17.75H9.63281L7.75781 19.25H14.7422L19.5 23.0703V19.25H22.5V7.25H18Z" fill="black"/>
                                        </svg>
                                    </span>
                                    <span class="message-popup-text ms-2">Une question ? Contactez-nous</span>
                                </a>
                            </div>

                            <form class="product-form" action="{{ htmlspecialchars($qv_form_action, ENT_QUOTES, 'UTF-8') }}#">
                                <div class="product-form-buttons d-flex align-items-center justify-content-between mt-4">
                                    <button type="submit" class="position-relative btn-atc btn-add-to-cart loader">AJOUTER AU PANIER</button>
                                    <a href="{{ route('collection.index') }}" class="product-wishlist" aria-label="Ajouter aux favoris">
                                        <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z" fill="#00234D"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="buy-it-now-btn mt-2">
                                    <button type="submit" class="position-relative btn-atc btn-buyit-now">ACHETER</button>
                                </div>
                            </form>

                            <div class="qv-reassurance mt-4">
                                <ul class="list-unstyled d-flex flex-wrap mb-0">
                                    <li class="qv-reassurance-item d-flex align-items-center">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d8327f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                        <span class="ms-2">Livraison en Côte d'Ivoire</span>
                                    </li>
                                    <li class="qv-reassurance-item d-flex align-items-center">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d8327f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                        <span class="ms-2">Conseils au +225 07 99 14 03 56</span>
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
<!-- product quickview end -->
