<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::orderBy('id')->first();

        $category = BlogCategory::firstOrCreate(
            ['slug' => 'conseils-literie'],
            ['name' => 'Conseils literie', 'description' => 'Guides pour bien choisir et entretenir votre literie.', 'is_active' => true]
        );

        $posts = [
            [
                'title' => 'Comment choisir son matelas à Abidjan : le guide complet',
                'excerpt' => 'Dimension, densité, fermeté, climat : tous les critères pour choisir le bon matelas, adapté à votre morphologie et à la vie à Abidjan.',
                'content' => <<<'HTML'
<p>Bien dormir commence par un matelas adapté à votre corps et à votre environnement. À Abidjan, où la chaleur et l'humidité accompagnent la majeure partie de l'année, le choix du matelas mérite une attention particulière. Voici les critères qui comptent vraiment.</p>

<h5>1. La bonne dimension</h5>
<p>La taille du matelas dépend de votre gabarit et de votre chambre :</p>
<ul>
<li><strong>90 x 190 cm</strong> : idéal pour un enfant ou une chambre d'amis ;</li>
<li><strong>120 x 190 cm</strong> : confortable pour une personne seule ;</li>
<li><strong>140 x 190 cm</strong> : le standard pour deux personnes dans une chambre modeste ;</li>
<li><strong>160 x 200 cm</strong> et plus : le confort d'un vrai lit de couple.</li>
</ul>
<p>Astuce : ajoutez au moins 15 cm à votre taille pour la longueur, et vérifiez que la chambre laisse un passage libre autour du lit.</p>

<h5>2. La densité de la mousse</h5>
<p>La densité, exprimée en kg/m³, détermine la durée de vie et le soutien du matelas :</p>
<ul>
<li><strong>Moins de 25 kg/m³</strong> : usage occasionnel ;</li>
<li><strong>28 à 35 kg/m³</strong> : bon compromis pour un adulte de corpulence moyenne ;</li>
<li><strong>35 kg/m³ et plus</strong> : soutien ferme et durable, recommandé pour un usage quotidien.</li>
</ul>
<p>Un matelas trop peu dense s'affaisse rapidement et perd son soutien en quelques mois.</p>

<h5>3. Ferme ou souple ?</h5>
<p>La fermeté dépend de votre morphologie et de votre position de sommeil :</p>
<ul>
<li><strong>Dormeurs sur le dos ou le ventre</strong> : un matelas ferme maintient la colonne alignée ;</li>
<li><strong>Dormeurs sur le côté</strong> : un accueil plus souple soulage les épaules et les hanches ;</li>
<li><strong>Gabarits lourds</strong> : privilégiez une densité élevée pour éviter l'effet cuvette.</li>
</ul>

<h5>4. Penser au climat d'Abidjan</h5>
<p>Sous un climat chaud et humide, privilégiez un matelas bien aéré : une mousse à cellules ouvertes, une housse respirante et amovible, et un sommier qui laisse circuler l'air en dessous. Aérez la chambre chaque jour et retournez le matelas régulièrement pour éviter la moisissure.</p>

<h5>5. Budget et garantie</h5>
<p>Un bon matelas est un investissement de plusieurs années. Chez Mobilier Addict, tous nos matelas sont garantis 10 ans. La livraison est assurée partout à Abidjan et dans les villes voisines.</p>
<p><a href="/menu/matelas">Découvrez notre collection de matelas</a> ou <a href="/contact">contactez-nous</a> pour un conseil personnalisé.</p>
HTML,
                'image' => 'articles/guide-matelas-1.jpg',
                'image_alt' => 'Choisir son matelas : dimensions, densité et fermeté',
                'reading_time' => 4,
                'order' => 1,
            ],
            [
                'title' => 'Matelas ferme ou souple : lequel choisir pour votre dos ?',
                'excerpt' => 'Ferme ou souple, la réponse dépend de votre position de sommeil, de votre morphologie et de vos éventuels maux de dos. Explications simples pour bien trancher.',
                'content' => <<<'HTML'
<p>« Il me faut un matelas ferme pour le dos » : c'est l'une des idées les plus répandues, et elle n'est pas toujours vraie. La bonne fermeté est celle qui maintient votre colonne vertébrale alignée dans votre position de sommeil habituelle. Tour d'horizon.</p>

<h5>Ce que dit votre position de sommeil</h5>
<ul>
<li><strong>Sur le dos</strong> : un matelas ferme à mi-ferme soutient la zone lombaire et évite que le bassin ne s'enfonce.</li>
<li><strong>Sur le côté</strong> : un accueil plus souple laisse l'épaule et la hanche s'enfoncer légèrement, ce qui garde la colonne droite vue de profil.</li>
<li><strong>Sur le ventre</strong> : un soutien ferme est indispensable pour ne pas cambrer le dos.</li>
</ul>

<h5>Ce que dit votre morphologie</h5>
<p>Plus le gabarit est lourd, plus le matelas doit être dense et ferme pour offrir un soutien suffisant. À l'inverse, une personne légère sur un matelas très ferme aura l'impression de dormir sur une planche : les points de pression sur les épaules et les hanches créent des tensions.</p>

<h5>Et en cas de mal de dos ?</h5>
<p>Un matelas trop mou laisse le bassin s'enfoncer, un matelas trop dur appuie sur les zones de contact. La plupart des maux de dos au réveil s'améliorent avec un matelas mi-ferme de densité suffisante (28 kg/m³ et plus pour un adulte). Si votre matelas a plus de 8 ans ou montre un creux visible, c'est souvent lui le premier coupable.</p>

<h5>Le réflexe simple : essayer</h5>
<p>Allongez-vous quelques minutes dans votre position habituelle. Si vous pouvez glisser facilement une main sous vos reins sans espace excessif, le soutien est probablement le bon.</p>
<p>Notre collection propose des matelas fermes, mi-fermes et souples, en mousse haute densité, garantis 10 ans et livrés partout à Abidjan. <a href="/menu/matelas">Comparez les modèles</a> ou <a href="/contact">demandez conseil</a>.</p>
HTML,
                'image' => 'articles/guide-matelas-2.jpg',
                'image_alt' => 'Matelas ferme ou souple : quel soutien pour votre dos',
                'reading_time' => 3,
                'order' => 2,
            ],
        ];

        foreach ($posts as $data) {
            BlogPost::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                array_merge($data, [
                    'blog_category_id' => $category->id,
                    'user_id' => $author?->id,
                    'published_at' => now(),
                    'is_featured' => false,
                    'is_active' => true,
                ])
            );
        }
    }
}
