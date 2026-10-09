@extends('maquette.layout')

@section('content')

            <div class="cart-page mt-100">
                <div class="container">
                    <div class="cart-page-wrapper">
                        <div class="row">
                            <div class="col-lg-7 col-md-12 col-12">
                                <table class="cart-table w-100">
                                    <thead>
                                      <tr>
                                        <th class="cart-caption heading_18">Produit</th>
                                        <th class="cart-caption heading_18"></th>
                                        <th class="cart-caption text-center heading_18 d-none d-md-table-cell">Quantité</th>
                                        <th class="cart-caption text-end heading_18">Prix</th>
                                      </tr>
                                    </thead>
                        
                                    <tbody>
                                        <tr class="cart-item">
                                          <td class="cart-item-media">
                                            <div class="mini-img-wrapper">
                                                <img loading="lazy" decoding="async" class="mini-img" src="{{ asset('assets/maquette/') }}/img/products/real/1770689632_0OTK5fkOpt.jpg" alt="img">
                                            </div>                                    
                                          </td>
                                          <td class="cart-item-details">
                                            <h2 class="product-title"><a href="{{ route('cart.index') }}#">Canapé d'angle réversible Eliot</a></h2>
                                            <p class="product-vendor">XS / Gris colombe</p>                                   
                                          </td>
                                          <td class="cart-item-quantity">
                                            <div class="quantity d-flex align-items-center justify-content-between">
                                                <button class="qty-btn dec-qty"><img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/minus.svg"
                                                        alt="minus"></button>
                                                <input class="qty-input" type="number" name="qty" value="1" min="0">
                                                <button class="qty-btn inc-qty"><img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/plus.svg"
                                                        alt="plus"></button>
                                            </div>
                                            <a href="{{ route('cart.index') }}#" class="product-remove mt-2">Supprimer</a>                           
                                          </td>
                                          <td class="cart-item-price text-end">
                                            <div class="product-price">580,00 FCFA</div>                           
                                          </td>                        
                                        </tr>
                                        <tr class="cart-item">
                                          <td class="cart-item-media">
                                            <div class="mini-img-wrapper">
                                                <img loading="lazy" decoding="async" class="mini-img" src="{{ asset('assets/maquette/') }}/img/products/real/1769643261_righaaXc9N.jpg" alt="img">
                                            </div>                                    
                                          </td>
                                          <td class="cart-item-details">
                                            <h2 class="product-title"><a href="{{ route('cart.index') }}#">Fauteuil lounge Vita</a></h2>
                                            <p class="product-vendor">XS / Rose</p>                                   
                                          </td>
                                          <td class="cart-item-quantity">
                                            <div class="quantity d-flex align-items-center justify-content-between">
                                                <button class="qty-btn dec-qty"><img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/minus.svg"
                                                        alt="minus"></button>
                                                <input class="qty-input" type="number" name="qty" value="1" min="0">
                                                <button class="qty-btn inc-qty"><img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/plus.svg"
                                                        alt="plus"></button>
                                            </div>
                                            <a href="{{ route('cart.index') }}#" class="product-remove mt-2">Supprimer</a>                           
                                          </td>
                                          <td class="cart-item-price text-end">
                                            <div class="product-price">580,00 FCFA</div>                           
                                          </td>
                                        </tr>
                                        <tr class="cart-item">
                                          <td class="cart-item-media">
                                            <div class="mini-img-wrapper">
                                                <img loading="lazy" decoding="async" class="mini-img" src="{{ asset('assets/maquette/') }}/img/products/real/1770691758_oLpAhmB0Wd.jpg" alt="img">
                                            </div>                                    
                                          </td>
                                          <td class="cart-item-details">
                                            <h2 class="product-title"><a href="{{ route('cart.index') }}#">Chaise de salle à manger Sarno</a></h2>
                                            <p class="product-vendor">XS / Gris colombe</p>                                  
                                          </td>
                                          <td class="cart-item-quantity">
                                            <div class="quantity d-flex align-items-center justify-content-between">
                                                <button class="qty-btn dec-qty"><img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/minus.svg"
                                                        alt="minus"></button>
                                                <input class="qty-input" type="number" name="qty" value="1" min="0">
                                                <button class="qty-btn inc-qty"><img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/plus.svg"
                                                        alt="plus"></button>
                                            </div>
                                            <a href="{{ route('cart.index') }}#" class="product-remove mt-2">Supprimer</a>                           
                                          </td>
                                          <td class="cart-item-price text-end">
                                            <div class="product-price">580,00 FCFA</div>                           
                                          </td>                        
                                        </tr>
                                        <tr class="cart-item">
                                          <td class="cart-item-media">
                                            <div class="mini-img-wrapper">
                                                <img loading="lazy" decoding="async" class="mini-img" src="{{ asset('assets/maquette/') }}/img/products/real/1770691758_zO2jmRAXwA.jpg" alt="img">
                                            </div>                                    
                                          </td>
                                          <td class="cart-item-details">
                                            <h2 class="product-title"><a href="{{ route('cart.index') }}#">Canapé d'angle réversible Eliot</a></h2>
                                            <p class="product-vendor">XS / Gris colombe</p>                                  
                                          </td>
                                          <td class="cart-item-quantity">
                                            <div class="quantity d-flex align-items-center justify-content-between">
                                                <button class="qty-btn dec-qty"><img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/minus.svg"
                                                        alt="minus"></button>
                                                <input class="qty-input" type="number" name="qty" value="1" min="0">
                                                <button class="qty-btn inc-qty"><img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/plus.svg"
                                                        alt="plus"></button>
                                            </div>
                                            <a href="{{ route('cart.index') }}#" class="product-remove mt-2">Supprimer</a>                           
                                          </td>
                                          <td class="cart-item-price text-end">
                                            <div class="product-price">580,00 FCFA</div>                           
                                          </td>                        
                                        </tr>
                                    </tbody>
                                  </table>
                            </div>
                            <div class="col-lg-5 col-md-12 col-12">
                                <div class="cart-total-area">
                                    <h3 class="cart-total-title d-none d-lg-block mb-0">Total du panier</h4>
                                    <div class="cart-total-box mt-4">
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
                                        <p class="shipping_text">Livraison et taxes calculées au paiement</p>
                                        <div class="d-flex justify-content-center mt-4">
                                            <a href="{{ route('cart.shipping') }}" class="position-relative btn-primary text-uppercase">
                                                Passer au paiement
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
