@extends('maquette.layout')

@section('content')

            <div class="article-page art-v2 mt-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="article-rte">
                                <div class="article-img">
                                    <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/blog/furniture-9.jpg" alt="img">
                                </div>
                                <div class="article-meta">
                                    <p class="article-ma-kicker">Aménagement · Le magazine Mobilier Addict</p>
                                    <h1 class="article-title">Petit salon, grandes possibilités</h1>
                                    <div class="article-card-published text_14 d-flex align-items-center flex-wrap">
                                        <a href="{{ route('blog.index') }}" class="article-date d-flex align-items-center">
                                            <span>Notre magazine</span>
                                        </a>
                                        <span class="article-separator mx-3">
                                            <svg width="2" height="12" viewBox="0 0 2 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4" d="M1.09761 0.5H0V11.5H1.09761V0.5Z" fill="black"/>
                                            </svg>
                                        </span>
                                        <span class="article-date d-flex align-items-center">
                                            <span>Guide pratique · Lecture : 4 minutes</span>
                                        </span>
                                    </div>
                                </div>

                                <div class="article-content">
                                    <p>Un salon accueillant n'a pas besoin d'être grand. Dans beaucoup de logements, à Abidjan comme ailleurs en Côte d'Ivoire, la pièce de vie doit tout accueillir : les moments en famille, les visites, parfois un coin repas ou télévision. Avec quelques choix réfléchis, un petit espace devient agréable à vivre sans avoir l'air encombré.</p>

                                    <h6 class="heading_24 mb-3 mt-5">Commencer par les mesures</h6>
                                    <p>Avant de regarder les modèles, mesurez la pièce : longueur des murs, hauteur sous plafond, largeur des portes et des passages. Notez aussi l'emplacement des fenêtres et des prises. Ces quelques chiffres évitent la déception d'un canapé trop large ou d'un meuble qui bloque une porte.</p>
                                    <p>Gardez ces dimensions avec vous au moment de comparer les articles. Elles vous aideront à vérifier que le meuble trouve sa place dans la pièce, mais aussi qu'il peut entrer dans le logement.</p>

                                    <h6 class="heading_24 mb-3 mt-5">Des meubles à la bonne échelle</h6>
                                    <p>Dans une petite pièce, mieux vaut un canapé compact bien proportionné qu'un grand modèle qui occupe tout l'espace. Un fauteuil léger, une table basse fine ou un meuble TV peu profond suffisent souvent à compléter l'ensemble. Les pieds visibles et les lignes épurées donnent une impression de légèreté.</p>
                                    <p>Choisissez peu de meubles, mais de bonne qualité : une assise confortable, une structure solide et un revêtement facile à entretenir comptent plus que le nombre d'éléments.</p>

                                    <figure class="blockquote">
                                        <blockquote>
                                            Dans une petite pièce, chaque meuble doit gagner sa place : utile, bien dimensionné et simple à entretenir.
                                        </blockquote>
                                        <figcaption>— Conseil Mobilier Addict</figcaption>
                                    </figure>

                                    <h6 class="heading_24 mb-3 mt-5">Laisser circuler l'air et la lumière</h6>
                                    <p>Sous un climat chaud, l'aération compte autant que la décoration. Évitez de coller les meubles aux murs et devant les ouvertures : laisser passer l'air rend la pièce plus confortable et préserve les matériaux de l'humidité. Les textiles clairs et légers renforcent la sensation d'espace.</p>

                                    <h6 class="heading_24 mb-3 mt-5">Un rangement qui ne prend pas la place</h6>
                                    <p>Un meuble TV avec rangements, une table basse avec tiroir ou une étagère murale permettent de garder la pièce dégagée. Le rangement vertical est votre allié : il libère le sol et facilite le ménage, surtout pendant la saison des pluies.</p>

                                    <h6 class="heading_24 mb-3 mt-5">Avant l'achat</h6>
                                    <p>Préparez vos mesures, réfléchissez à l'usage réel de la pièce et anticipez la livraison : accès à l'immeuble, étage, repère dans votre commune. À Abidjan ou à l'intérieur du pays, ces informations facilitent la réception et l'installation. Les conditions exactes de livraison et de montage sont à confirmer auprès de la boutique.</p>

                                    <p class="article-ma-note">Pour aller plus loin, consultez notre <a href="{{ route('pages.contact') }}#petit-salon">guide complet d'aménagement du salon</a> ou découvrez nos <a href="{{ route('category.show', 'mobilier') }}">univers mobilier</a>.</p>
                                </div>

                                <div class="next-prev-article mt-5 d-flex align-items-center justify-content-between flex-wrap">
                                    <a href="{{ route('blog.index') }}" class="article-btn prev-article-btn mt-2">← RETOUR AU MAGAZINE</a>
                                    <a href="{{ route('pages.contact') }}" class="article-btn next-article-btn active mt-2">TOUS NOS GUIDES →</a>
                                </div>

                            </div>
                        </div>
                                                                    </div>
                </div>
            </div>            
        
@endsection
