<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SeoArticlesSeeder extends Seeder
{
    public function run(): void
    {
        $userId = DB::table('users')->where('is_admin', 1)->orderBy('id')->value('id') ?? 1;

        $literie = DB::table('blog_categories')->where('slug', 'conseils-literie')->value('id');
        if (! $literie) {
            $literie = DB::table('blog_categories')->insertGetId([
                'name' => 'Conseils literie',
                'slug' => 'conseils-literie',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $ameublement = DB::table('blog_categories')->where('slug', 'ameublement')->value('id');
        if (! $ameublement) {
            $ameublement = DB::table('blog_categories')->insertGetId([
                'name' => 'Ameublement',
                'slug' => 'ameublement',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $articles = [
            [
                'category' => $literie,
                'title' => 'Livraison de matelas à Abidjan : délais, zones et tarifs',
                'slug' => 'livraison-matelas-abidjan-delais-zones-tarifs',
                'excerpt' => 'Commander un matelas à Abidjan : comment se passe la livraison, quelles zones sont couvertes, sous combien de temps et à quel prix.',
                'image' => 'articles/livraison-matelas-abidjan.jpg',
                'source' => 'furniture-3',
                'image_alt' => 'Livraison et installation d\'un matelas Mobilier Addict à Abidjan',
                'order' => 3,
                'content' => '<p>Acheter un <strong>matelas à Abidjan</strong> ne devrait pas se compliquer au moment de la livraison. Chez Mobilier Addict, la livraison fait partie de l\'expérience : voici comment elle se déroule, zones par zones.</p>
<h2>Quelles zones sont livrées à Abidjan ?</h2>
<p>Nous livrons dans l\'ensemble du district d\'Abidjan : <strong>Cocody, Plateau, Marcory, Treichville, Yopougon, Abobo, Adjamé, Riviera, Angré, Bingerville et Port-Bouët</strong>. Les communes éloignées (Songon, Grand-Bassam, Anyama) sont livrées sur devis.</p>
<h2>Quels délais de livraison ?</h2>
<ul>
<li><strong>Produits en stock</strong> : livraison sous 24 à 72 h selon votre commune.</li>
<li><strong>Mobilier volumineux</strong> (sommiers, chambres complètes) : un créneau est convenu avec vous, généralement sous 3 à 5 jours.</li>
<li><strong>Commandes sur-mesure</strong> (hôtellerie, appartements meublés) : le calendrier est défini dans le devis.</li>
</ul>
<h2>Combien coûte la livraison ?</h2>
<p>Le tarif dépend de la zone et du volume. Il est indiqué clairement avant la confirmation de commande — aucun frais caché. Consultez la page <a href="/livraison-retours">Livraison &amp; retours</a> pour le détail des zones.</p>
<h2>Installation et reprise de l\'ancien matelas</h2>
<p>Notre équipe installe le matelas dans la pièce de votre choix, pas seulement devant la porte. Selon l\'offre en cours, la reprise de l\'ancien matelas peut être proposée : demandez-la au moment de la commande.</p>
<h2>Paiement à la livraison</h2>
<p>Vous ne payez qu\'à la réception, après vérification du produit. C\'est la garantie de recevoir exactement ce que vous avez commandé.</p>
<p>Prêt à choisir ? Découvrez nos <a href="/menu/matelas">matelas disponibles en stock</a> avec livraison à Abidjan.</p>',
            ],
            [
                'category' => $ameublement,
                'title' => 'Meubler un appartement à Abidjan : budget, priorités et bon plan',
                'slug' => 'meubler-appartement-abidjan-budget-priorites',
                'excerpt' => 'Studio, F2 ou F3 à Abidjan : par quoi commencer, combien prévoir et comment meubler son appartement sans se ruiner.',
                'image' => 'articles/meubler-appartement-abidjan.jpg',
                'source' => 'appart-standing',
                'image_alt' => 'Appartement meublé clé en main à Abidjan : salon lumineux et équipé',
                'order' => 4,
                'content' => '<p>Emménager dans un <strong>appartement à Abidjan</strong> — que ce soit à Cocody, Angré ou Yopougon — soulève toujours la même question : par quoi commencer et combien prévoir ?</p>
<h2>Les priorités d\'ameublement</h2>
<p>Trois achats couvrent 80 % du confort quotidien :</p>
<ol>
<li><strong>Le matelas</strong> — c\'est votre sommeil, ne rognez pas dessus. Un bon <a href="/menu/matelas">matelas</a> dure 8 à 10 ans.</li>
<li><strong>Le rangement</strong> — armoire ou commode : indispensable dès la première semaine.</li>
<li><strong>Le coin repas ou salon</strong> — table, canapé ou fauteuil selon l\'espace.</li>
</ol>
<h2>Quel budget prévoir ?</h2>
<ul>
<li><strong>Studio / chambre</strong> : à partir de 150 000 F (matelas + oreillers + rangement de base).</li>
<li><strong>F2</strong> : comptez 300 000 à 500 000 F pour un aménagement complet et durable.</li>
<li><strong>F3 et plus</strong> : au-delà de 600 000 F selon le niveau de gamme.</li>
</ul>
<h2>Le bon plan : les packs prêts à emménager</h2>
<p>Plutôt que d\'acheter pièce par pièce, nos <a href="/appartement-meuble">packs appartement meublé</a> regroupent literie, mobilier et électroménager à prix négocié, avec une seule livraison. Idéal pour un emménagement rapide ou un investissement locatif.</p>
<h2>Astuce budget</h2>
<p>Équipez d\'abord la chambre et la cuisine, puis complétez le salon au fil des mois. Un bel intérieur se construit par étapes — pas en une seule dépense.</p>',
            ],
            [
                'category' => $literie,
                'title' => 'Entretenir son matelas sous le climat d\'Abidjan : 7 réflexes anti-humidité',
                'slug' => 'entretenir-matelas-climat-tropical-abidjan',
                'excerpt' => 'Chaleur, humidité, poussière : le climat ivoirien use les matelas plus vite. Nos conseils pour garder le vôtre propre et durable.',
                'image' => 'articles/entretenir-matelas-climat-tropical.jpg',
                'source' => 'famille-parentale',
                'image_alt' => 'Chambre bien aérée avec matelas protégé sous climat tropical',
                'order' => 5,
                'content' => '<p>Sous le climat chaud et humide d\'<strong>Abidjan</strong>, un matelas mal entretenu vieillit deux fois plus vite : auréoles, odeurs, acariens. Sept réflexes simples suffisent à le protéger.</p>
<h2>1. Protégez-le dès le premier jour</h2>
<p>Une <strong>alèse imperméable</strong> est l\'achat le plus rentable : elle bloque transpiration et liquides. Nos <a href="/menu/drap-et-couettes">protège-matelas et housses</a> se lavent en machine.</p>
<h2>2. Aérez la chambre chaque matin</h2>
<p>Ouvrez les fenêtres 10 à 15 minutes et repliez la couette : l\'humidité accumulée la nuit doit s\'évacuer. Sans climatisation, un ventilateur dirigé vers le lit aide.</p>
<h2>3. Retournez-le régulièrement</h2>
<p>Retournez et pivotez le matelas <strong>tous les 3 mois</strong> pour répartir l\'usure et éviter l\'affaissement localisé.</p>
<h2>4. Aspirez la surface</h2>
<p>Un passage d\'aspirateur mensuel élimine poussière et acariens, fréquents sous climat tropical.</p>
<h2>5. Traitez les taches immédiatement</h2>
<p>Eau savonneuse en faible quantité, tamponner sans frotter, sécher au ventilateur — jamais de matelas détrempé.</p>
<h2>6. Évitez l\'humidité du sol</h2>
<p>Ne posez jamais le matelas directement au sol : utilisez un sommier ou un lit qui laisse circuler l\'air en dessous.</p>
<h2>7. Sachez quand le remplacer</h2>
<p>Creux central, ressorts qui grincent, réveils avec mal de dos : après 7 à 10 ans, un matelas ne soutient plus. Comparez nos <a href="/menu/matelas">matelas en stock à Abidjan</a> avec paiement à la livraison.</p>',
            ],
            [
                'category' => $literie,
                'title' => '140×190, 160×200 ou 180×200 : quelle taille de matelas choisir ?',
                'slug' => 'quelle-taille-matelas-choisir-dimensions-guide',
                'excerpt' => '90, 140, 160 ou 180 cm : le guide des dimensions de matelas pour choisir la bonne taille selon votre chambre et votre couple.',
                'image' => 'articles/quelle-taille-matelas.jpg',
                'source' => 'famille-enfants',
                'image_alt' => 'Comparaison des tailles de matelas : une place, deux places et king size',
                'order' => 6,
                'content' => '<p>« 2 places » veut tout dire — et rien. Voici les <strong>dimensions de matelas</strong> vendues en Côte d\'Ivoire et comment choisir la bonne.</p>
<h2>Les tailles standard</h2>
<ul>
<li><strong>90 × 190 cm</strong> — une place : enfant, étudiant, lit d\'appoint.</li>
<li><strong>120 × 190 cm</strong> — une place large : confortable en solo, juste à deux.</li>
<li><strong>140 × 190 cm</strong> — le « 2 places » classique : correct pour un couple, chambre standard.</li>
<li><strong>160 × 200 cm</strong> — le vrai confort à deux : chacun garde son espace.</li>
<li><strong>180 × 200 cm</strong> — king size : le top pour les grands dormeurs ou les enfants qui rejoignent le lit.</li>
</ul>
<h2>Trois questions pour choisir</h2>
<ol>
<li><strong>Combien dormez-vous dans le lit ?</strong> À deux, partez sur 160 cm minimum si la chambre le permet.</li>
<li><strong>Quelle est la taille de la chambre ?</strong> Gardez au moins 60 cm de passage autour du lit.</li>
<li><strong>Quelle est votre gabarit ?</strong> Au-delà d\'1,80 m, préférez 200 cm de long.</li>
</ol>
<h2>Attention au sommier et aux draps</h2>
<p>La taille du matelas conditionne celle du <strong>sommier, des draps housses et de la couette</strong>. Un 160 exige une couette 240 × 220 minimum. Retrouvez le <a href="/menu/drap-et-couettes">linge de lit assorti</a> à chaque dimension.</p>
<h2>Notre recommandation</h2>
<p>Pour une chambre principale à Abidjan, le <strong>160 × 200</strong> offre le meilleur rapport confort/prix. Parcourez les <a href="/menu/matelas">matelas par dimension</a> — chaque fiche indique les tailles disponibles.</p>',
            ],
            [
                'category' => $ameublement,
                'title' => 'Équiper un hôtel ou une résidence en Côte d\'Ivoire : literie, mobilier, devis',
                'slug' => 'equiper-hotel-residence-cote-divoire-devis',
                'excerpt' => 'Hôtel, résidence meublée ou appart-hôtel en Côte d\'Ivoire : comment équiper vos chambres avec un budget maîtrisé et un seul interlocuteur.',
                'image' => 'articles/equiper-hotel-cote-divoire.jpg',
                'source' => 'hotellerie-signature',
                'image_alt' => 'Chambre d\'hôtel équipée en Côte d\'Ivoire : literie hôtelière premium',
                'order' => 7,
                'content' => '<p>Équiper un <strong>hôtel, une résidence meublée ou un appart-hôtel en Côte d\'Ivoire</strong> demande autre chose qu\'un achat au détail : volumes, cohérence, délais, garanties. Voici comment le faire efficacement.</p>
<h2>Les trois erreurs à éviter</h2>
<ol>
<li><strong>Acheter au coup par coup</strong> : incohérences visuelles entre les chambres et prix non négociés.</li>
<li><strong>Négliger la literie</strong> : c\'est le premier critère de note des clients — prévoyez des matelas hôteliers fermes et durables.</li>
<li><strong>Oublier la logistique</strong> : livrer 20 chambres le même jour exige une organisation dédiée.</li>
</ol>
<h2>La démarche Mobilier Addict</h2>
<p>Notre offre <a href="/hotellerie">hôtellerie &amp; collectivités</a> couvre :</p>
<ul>
<li>Literie hôtelière (matelas, sommiers, oreillers, protection)</li>
<li>Mobilier de chambre et parties communes</li>
<li>Linge de lit et de bain en quantité</li>
<li>Livraison et installation coordonnées sur site</li>
</ul>
<h2>Budget et devis</h2>
<p>Chaque projet est chiffré sur devis : nombre de chambres, standing visé, délais. Un hôtel de 15 chambres à Abidjan s\'équipe généralement entre <strong>6 et 15 millions de F</strong> selon la gamme.</p>
<h2>Pourquoi un seul fournisseur ?</h2>
<p>Un interlocuteur unique = une seule livraison, une seule garantie, des tarifs de gros et des chambres homogènes. Demandez votre <a href="/devis-sur-mesure">devis sur-mesure</a> — réponse sous 48 h.</p>',
            ],
        ];

        $dir = storage_path('app/public/articles');
        File::ensureDirectoryExists($dir);

        foreach ($articles as $a) {
            foreach (['jpg', 'webp'] as $ext) {
                $src = public_path("assets/maquette/img/blog/{$a['source']}.{$ext}");
                if (is_file($src)) {
                    File::copy($src, $dir . '/' . basename($a['image'], '.jpg') . ".{$ext}");
                }
            }

            BlogPost::updateOrCreate(
                ['slug' => $a['slug']],
                [
                    'blog_category_id' => $a['category'],
                    'user_id' => $userId,
                    'title' => $a['title'],
                    'excerpt' => $a['excerpt'],
                    'content' => $a['content'],
                    'image' => $a['image'],
                    'image_alt' => $a['image_alt'],
                    'published_at' => now(),
                    'reading_time' => max(1, (int) ceil(str_word_count(strip_tags($a['content'])) / 200)),
                    'is_featured' => 0,
                    'order' => $a['order'],
                    'is_active' => 1,
                ]
            );
        }
    }
}
