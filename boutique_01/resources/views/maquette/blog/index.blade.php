@extends('maquette.layout')

@section('content')

            <div class="container">
                <header class="magazine-intro">
                    <div>
                        <p class="magazine-kicker">Le journal de la maison · Mobilier Addict</p>
                        <h1>Des idées pour<br><span>mieux vivre chez vous.</span></h1>
                    </div>
                    <p>Un salon où l’on aime recevoir, une chambre propice au repos, des meubles dont on prend soin : retrouvez nos conseils pour un intérieur agréable à vivre, à Abidjan comme ailleurs en Côte d’Ivoire.</p>
                </header>

                <nav class="magazine-topics" aria-label="Choisir un thème du magazine">
                    <span>Au fil de vos envies</span>
                    <a href="#guide-salon">Aménager son salon</a>
                    <a href="#guide-literie">Bien choisir sa literie</a>
                    <a href="#guide-livraison">Préparer son achat</a>
                    <a href="#guide-entretien">Entretenir ses meubles</a>
                </nav>

                <article class="magazine-feature" id="guide-salon" aria-labelledby="salon-title">
                    <div class="magazine-feature-image">
                        <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/blog/furniture-2.jpg" alt="Petit canapé noir, commode et lampadaire dans un intérieur lumineux" width="1400" height="1169" fetchpriority="high">
                        <span>À la une · Aménagement</span>
                    </div>
                    <div class="magazine-feature-content">
                        <p class="magazine-kicker">Faire de la place à l’essentiel</p>
                        <h2 id="salon-title">Petit salon,<br>grandes possibilités.</h2>
                        <p>Un salon accueillant n’a pas besoin d’être grand. Un canapé bien proportionné, quelques rangements et des passages dégagés suffisent à donner une autre respiration à la pièce.</p>
                        <p>Avant de choisir vos meubles, observez la lumière, l’ouverture des portes et les moments que vous aimez y partager. L’objectif n’est pas de tout remplir, mais de trouver la juste place pour chaque chose.</p>
                        <a class="magazine-button" href="{{ route('pages.contact') }}#petit-salon">Lire le guide d’aménagement <span aria-hidden="true">↗</span></a>
                    </div>
                </article>

                <section class="magazine-guides" aria-labelledby="magazine-guides-title">
                    <div class="magazine-section-heading">
                        <div>
                            <p class="magazine-kicker">Des conseils qui servent vraiment</p>
                            <h2 id="magazine-guides-title">La maison, au quotidien</h2>
                        </div>
                        <p>Choisir avec soin, préparer son installation et faire durer ce que l’on aime.</p>
                    </div>
                    @php $guides = [
                        ['literie', 'furniture-1.jpg', 'Literie & confort', 'Une chambre où il fait bon se reposer', 'Lit et linge de lit dans une chambre aux tons naturels', 'Le confort commence par une literie adaptée à vos habitudes. Dimensions du matelas, soutien, linge de lit et aération : ces détails méritent autant d’attention que la décoration. Dans un climat chaud et humide, laisser circuler l’air et bien sécher les textiles font aussi partie des bons réflexes.', 'Lire le guide literie'],
                        ['livraison', 'furniture-3.jpg', 'Achat & installation', 'Des meubles choisis, une arrivée bien préparée', 'Cuisine aménagée avec des rangements et un îlot central', 'Un meuble doit trouver sa place dans la maison, mais aussi pouvoir y entrer. Largeur des portes, accès à l’immeuble, étage et repère de livraison : préparer ces informations évite bien des imprévus. À Abidjan ou à l’intérieur du pays, quelques vérifications facilitent la réception et l’installation.', 'Préparer la réception'],
                        ['entretien', 'furniture-4.jpg', 'Matières & entretien', 'Prendre soin de ses meubles pendant la saison des pluies', 'Fauteuils, canapé et tables dans un espace de vie lumineux', 'L’humidité demande quelques attentions, sans compliquer le quotidien. Aérer les pièces, éloigner les meubles des murs humides et essuyer rapidement les liquides sont de bonnes habitudes. Pour le bois, les tissus ou les revêtements synthétiques, un nettoyage adapté à la matière reste essentiel.', 'Découvrir les conseils d’entretien'],
                    ];
                    ?>
                    <div class="magazine-grid">
                        <?php foreach ($guides as [$id, $image, $category, $title, $alt, $summary, $linkLabel]): ?>
                            <article class="magazine-card" id="guide-{{ $id }}" aria-labelledby="{{ $id }}-title">
                                <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/blog/{{ $image }}" alt="{{ htmlspecialchars($alt, ENT_QUOTES, 'UTF-8') }}" width="1400" height="1169" loading="lazy" decoding="async">
                                <div class="magazine-card-content">
                                    <p class="magazine-category">{{ htmlspecialchars($category, ENT_QUOTES, 'UTF-8') }}</p>
                                    <h3 id="{{ $id }}-title">{{ htmlspecialchars($title, ENT_QUOTES, 'UTF-8') }}</h3>
                                    <p class="magazine-excerpt">{{ htmlspecialchars($summary, ENT_QUOTES, 'UTF-8') }}</p>
                                    <a class="magazine-read" href="{{ route('pages.contact') }}#{{ $id }}">{{ htmlspecialchars($linkLabel, ENT_QUOTES, 'UTF-8') }} <span aria-hidden="true">→</span></a>
                                </div>
                            </article>
                        <?php endforeach;  @endphp
                    </div>
                </section>

                <section class="magazine-notebook" aria-labelledby="notebook-title">
                    <div class="magazine-notebook-intro">
                        <p class="magazine-kicker">Le carnet pratique</p>
                        <h2 id="notebook-title">Avant de craquer<br>pour un meuble…</h2>
                        <p>Trois repères simples pour passer de l’inspiration à un choix qui vous convient.</p>
                    </div>
                    <ol class="magazine-checklist">
                        <li><span aria-hidden="true">01</span><div><h3>Prenez les bonnes mesures</h3><p>La place dans la pièce compte autant que le passage des portes et des escaliers. Gardez ces dimensions avec vous lorsque vous comparez les modèles.</p></div></li>
                        <li><span aria-hidden="true">02</span><div><h3>Pensez à votre rythme de vie</h3><p>Recevoir souvent, vivre avec des enfants ou aménager un coin lecture ne mène pas aux mêmes choix. Privilégiez un meuble adapté à son usage réel.</p></div></li>
                        <li><span aria-hidden="true">03</span><div><h3>Regardez au-delà du style</h3><p>La matière, l’entretien et le confort font la différence au quotidien. Intégrez aussi la livraison et le montage éventuel à votre budget en FCFA.</p></div></li>
                    </ol>
                </section>

                <section class="magazine-contact" aria-labelledby="magazine-contact-title">
                    <div>
                        <p class="magazine-kicker">À vous d’imaginer la suite</p>
                        <h2 id="magazine-contact-title">Votre prochain projet commence chez vous.</h2>
                        <p>Découvrez nos univers ou échangez avec Mobilier Addict sur vos envies, votre espace et les articles qui vous intéressent.</p>
                    </div>
                    <div class="magazine-contact-actions">
                        <a class="magazine-button" href="{{ route('category.show', 'mobilier') }}">Explorer le mobilier <span aria-hidden="true">↗</span></a>
                        <a class="magazine-read" href="{{ route('pages.contact') }}">Parlons de votre projet <span aria-hidden="true">→</span></a>
                    </div>
                </section>
            </div>
        
@endsection
