@extends('maquette.layout')

@section('content')

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
                                        <li class="progress-step step-done"><a href="{{ route('cart.index') }}">Panier</a></li>
                                        <li class="progress-step step-active"><a href="{{ route('cart.shipping') }}">Vos informations</a></li>
                                        <li class="progress-step step-todo"><a href="{{ route('cart.shipping') }}">Livraison</a></li>
                                        <li class="progress-step step-todo"><a href="{{ route('cart.shipping') }}">Paiement</a></li>
                                        <li class="progress-step step-todo"><a href="{{ route('cart.shipping') }}">Avis</a></li>
                                    </ol>
                                </div>

                                <div class="checkout-user-area overflow-hidden d-flex align-items-center">
                                    <div class="checkout-user-img me-4">
                                        <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/checkout/user.jpg" alt="img">
                                    </div>
                                    <div class="checkout-user-details d-flex align-items-center justify-content-between w-100">
                                        <div class="checkout-user-info">
                                            <h2 class="checkout-user-name">Susan Gardner</h2>
                                            <p class="checkout-user-address mb-0">2752 avenue Royale, Québec, G1R 2B2, Canada</p>
                                        </div>
                                        
                                        <a href="{{ route('cart.shipping') }}#" class="edit-user btn-secondary">MODIFIER LE PROFIL</a>
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
                                        <a href="{{ route('cart.index') }}" class="checkout-page-btn minicart-btn btn-secondary">RETOUR AU PANIER</a>
                                        <a href="{{ route('cart.shipping') }}" class="checkout-page-btn minicart-btn btn-primary">PASSER À LA LIVRAISON</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                                <div class="cart-total-area checkout-summary-area">
                                    <h3 class="d-none d-lg-block mb-0 text-center heading_24 mb-4">Récapitulatif de commande</h4>

                                    <div class="minicart-item d-flex">
                                        <div class="mini-img-wrapper">
                                            <img loading="lazy" decoding="async" class="mini-img" src="{{ asset('assets/maquette/') }}/img/products/real/1770689632_0OTK5fkOpt.jpg" alt="img">
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="{{ route('cart.shipping') }}#">Canapé d'angle réversible Eliot</a></h2>
                                            <p class="product-vendor">150 FCFA x 1</p>
                                        </div>
                                    </div>
                                    <div class="minicart-item d-flex">
                                        <div class="mini-img-wrapper">
                                            <img loading="lazy" decoding="async" class="mini-img" src="{{ asset('assets/maquette/') }}/img/products/real/1769643261_righaaXc9N.jpg" alt="img">
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="{{ route('cart.shipping') }}#">Canapé d'angle réversible Eliot</a></h2>
                                            <p class="product-vendor">150 FCFA x 1</p>
                                        </div>
                                    </div>
                                    <div class="minicart-item d-flex">
                                        <div class="mini-img-wrapper">
                                            <img loading="lazy" decoding="async" class="mini-img" src="{{ asset('assets/maquette/') }}/img/products/real/1770691758_oLpAhmB0Wd.jpg" alt="img">
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="{{ route('cart.shipping') }}#">Canapé d'angle réversible Eliot</a></h2>
                                            <p class="product-vendor">150 FCFA x 1</p>
                                        </div>
                                    </div>
                                    <div class="minicart-item d-flex">
                                        <div class="mini-img-wrapper">
                                            <img loading="lazy" decoding="async" class="mini-img" src="{{ asset('assets/maquette/') }}/img/products/real/1770691758_zO2jmRAXwA.jpg" alt="img">
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="{{ route('cart.shipping') }}#">Canapé d'angle réversible Eliot</a></h2>
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
                                            <a href="{{ route('cart.shipping') }}" class="btn-apply-code position-relative btn-secondary text-uppercase mt-3">
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
        
@endsection
