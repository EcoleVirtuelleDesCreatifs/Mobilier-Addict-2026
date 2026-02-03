@extends('layouts.front')

@section('title', $pageTitle)
@section('meta_description', $pageDescription ?: ('Découvrez notre univers ' . $pageTitle . ' sur Mobilier Addict.'))
@section('canonical', route('univers.show', $slug))

@section('content')
    @php
        $designSlug = match ($slug) {
            'une-cuisine-pensee-pour-le-plaisir' => 'cuisine',
            'draps-couleur-unie' => 'draps-couettes',
            'la-fraicheur-au-coeur-de-votre-confort' => 'froid-climatisation',
            'lelegance-au-coeur-de-votre-salon' => 'salon',
            'vivez-chaque-image-ressentez-chaque-son' => 'multi-media',
            default => (in_array($slug, ['hotellerie', 'entrez-dans-lunivers-de-vos-nuits'], true) ? 'matelas' : $slug),
        };

        $page = match ($designSlug) {
            'matelas' => [
                'badge' => '✨ Retrouvez le sommeil que vous méritez',
                'title' => 'Matelas',
                'headline' => 'Dormez profond. Réveillez-vous léger.',
                'subtitle' => "Un bon matelas ne se contente pas d'être confortable : il change vos journées. Découvrez des matelas pensés pour soulager, soutenir et apaiser.",
                'hero_bg' => 'https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=900&h=1100&fit=crop',
                'benefits' => [
                    ['title' => 'Soutien qui libère', 'text' => "Votre corps s'aligne naturellement. Moins de tensions, plus d'énergie le matin."],
                    ['title' => 'Douceur qui apaise', 'text' => 'Un accueil moelleux, une sensation "hôtel" à la maison, nuit après nuit.'],
                    ['title' => 'Qualité durable', 'text' => 'Des matériaux pensés pour durer : confort stable, finitions premium, garantie.'],
                ],
                'cta_title' => "Besoin d'un conseil rapide ?",
                'cta_text' => 'Dis-nous ta position de sommeil, on te guide vers le bon confort.',
                'cta_button' => 'Je choisis mon confort',
                'faq' => [
                    ['q' => 'Quel confort choisir (ferme, mi-ferme, moelleux) ?', 'a' => "Si tu dors sur le dos ou le ventre, privilégie un soutien plus ferme. Sur le côté, un accueil plus moelleux aide à relâcher les épaules et les hanches."],
                    ['q' => 'En combien de temps je ressens la différence ?', 'a' => "Souvent dès les premières nuits : sommeil plus stable, réveil plus facile. Le corps s'adapte ensuite progressivement pour un confort optimal."],
                    ['q' => "Et si j'hésite encore ?", 'a' => "Écris-nous : on te recommande le meilleur compromis selon ta morphologie, ta position de sommeil et tes préférences."],
                ],
                'hero_card_badge_top' => 'Confort',
                'hero_card_badge_bottom' => 'qui rassure',
                'carousel_title' => 'Nos Best-Sellers Matelas',
                'carousel_desc' => 'Les matelas préférés de nos clients — découvrez pourquoi.',
                'inspire_title' => 'Trouvez Votre Confort Idéal',
                'inspire_desc' => 'Chaque corps est unique. Découvrez nos matelas adaptés à votre morphologie.',
                'inspire_cards' => [
                    ['img' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&h=1000&fit=crop', 'tag' => 'Ferme & Soutenant', 'title' => 'Soutien Optimal', 'text' => 'Pour ceux qui dorment sur le dos et recherchent un maintien parfait.'],
                    ['img' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=600&h=400&fit=crop', 'tag' => 'Mi-Ferme', 'title' => 'Équilibre Parfait'],
                    ['img' => 'https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?w=600&h=400&fit=crop', 'tag' => 'Moelleux', 'title' => 'Douceur Enveloppante'],
                ],
                'mission_title' => 'Un Sommeil Réparateur, Chaque Nuit',
                'mission_desc' => 'Chez Mobilier Addict, nous croyons qu\'un bon matelas transforme vos nuits et vos journées. Nous sélectionnons des matelas qui soulagent, soutiennent et apaisent pour un réveil plein d\'énergie.',
                'reco_title' => 'Nos Matelas Recommandés',
                'reco_desc' => 'Le top pour un sommeil profond et réparateur.',
                'reco_bg' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1920&h=600&fit=crop',
                'why_title' => 'Rejoignez <span>+3 000</span> dormeurs satisfaits',
                'why_subtitle' => 'Ils ont retrouvé un sommeil de qualité grâce à nos matelas. À votre tour !',
                'why_stats' => [
                    ['number' => '98%', 'label' => 'Clients satisfaits'],
                    ['number' => '10 ans', 'label' => 'Garantie matelas'],
                    ['number' => '100 nuits', 'label' => 'Essai gratuit'],
                ],
                'why_benefits' => [
                    ['title' => 'Soutien Ergonomique Certifié', 'text' => 'Nos matelas épousent votre corps pour un alignement parfait de la colonne.'],
                    ['title' => 'Essai 100 Nuits Sans Risque', 'text' => 'Testez votre matelas chez vous. Pas convaincu ? Retour et remboursement gratuits.'],
                    ['title' => 'Livraison Express & Installation', 'text' => 'Livré chez vous en 48h. Nos experts installent et reprennent l\'ancien matelas.'],
                    ['title' => 'Matériaux Sains & Certifiés', 'text' => 'Mousses certifiées, tissus hypoallergéniques, fabrication responsable.'],
                ],
            ],
            'oreillers' => [
                'badge' => '💤 Votre nuque vous dira merci',
                'title' => 'Oreillers',
                'headline' => 'Le petit détail qui change tout.',
                'subtitle' => "Maintien, douceur, fraîcheur : trouvez l'oreiller qui épouse votre posture et libère vos tensions.",
                'hero_bg' => 'https://images.unsplash.com/photo-1582582429416-03ad554aab0d?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1582582429416-03ad554aab0d?w=900&h=1100&fit=crop',
                'benefits' => [
                    ['title' => 'Maintien précis', 'text' => "L'oreiller soutient la nuque sans pousser la tête vers l'avant."],
                    ['title' => 'Fraîcheur douce', 'text' => 'Des matières respirantes pour moins de chaleur et plus de confort.'],
                    ['title' => 'Réveil plus léger', 'text' => 'Moins de raideurs, plus de mobilité dès le matin.'],
                ],
                'cta_title' => 'Oreiller idéal, en 30 secondes',
                'cta_text' => 'Dis-nous ta position (dos / côté / ventre) et ta préférence (souple / ferme).',
                'cta_button' => 'Je trouve le bon oreiller',
                'faq' => [
                    ['q' => 'Quel oreiller pour dormir sur le côté ?', 'a' => "Un oreiller plus haut aide à garder la nuque alignée avec la colonne."],
                    ['q' => 'Mémoire de forme ou fibres ?', 'a' => "La mémoire de forme épouse la nuque. Les fibres sont plus aérées et modulables."],
                    ['q' => 'Comment entretenir mon oreiller ?', 'a' => "Aère-le régulièrement et privilégie une housse protectrice. Suis les consignes de lavage."],
                ],
                'hero_card_badge_top' => 'Maintien',
                'hero_card_badge_bottom' => 'sans tension',
                'carousel_title' => 'Nos Best-Sellers Oreillers',
                'carousel_desc' => 'Les oreillers préférés de nos clients — pour des nuits sans tension.',
                'inspire_title' => 'Libérez Votre Nuque',
                'inspire_desc' => 'Un bon oreiller change tout. Trouvez celui qui correspond à votre position de sommeil.',
                'inspire_cards' => [
                    ['img' => 'https://images.unsplash.com/photo-1584100936595-c0654b55a2e2?w=800&h=1000&fit=crop', 'tag' => 'Mémoire de Forme', 'title' => 'Soutien Cervical', 'text' => 'Épouse parfaitement votre nuque pour un maintien optimal.'],
                    ['img' => 'https://images.unsplash.com/photo-1582582429416-03ad554aab0d?w=600&h=400&fit=crop', 'tag' => 'Fibres Douces', 'title' => 'Confort Moelleux'],
                    ['img' => 'https://images.unsplash.com/photo-1578898395750-4a1b05d8bd77?w=600&h=400&fit=crop', 'tag' => 'Ergonomique', 'title' => 'Position Parfaite'],
                ],
                'mission_title' => 'Votre Nuque Mérite le Meilleur',
                'mission_desc' => 'Un oreiller adapté à votre morphologie et votre position de sommeil transforme vos nuits. Fini les réveils avec des douleurs cervicales.',
                'reco_title' => 'Nos Oreillers Recommandés',
                'reco_desc' => 'Sélectionnés pour leur maintien et leur confort.',
                'reco_bg' => 'https://images.unsplash.com/photo-1582582429416-03ad554aab0d?w=1920&h=600&fit=crop',
                'why_title' => 'Rejoignez <span>+2 000</span> clients soulagés',
                'why_subtitle' => 'Ils ont dit adieu aux douleurs cervicales. À votre tour !',
                'why_stats' => [
                    ['number' => '97%', 'label' => 'Clients satisfaits'],
                    ['number' => '2 ans', 'label' => 'Garantie oreiller'],
                    ['number' => '30 nuits', 'label' => 'Essai gratuit'],
                ],
                'why_benefits' => [
                    ['title' => 'Maintien Cervical Optimal', 'text' => 'Oreillers ergonomiques qui alignent naturellement votre nuque.'],
                    ['title' => 'Essai 30 Nuits Satisfait', 'text' => 'Testez votre oreiller. Pas adapté ? Échange ou remboursement.'],
                    ['title' => 'Livraison Rapide & Soignée', 'text' => 'Livré sous 48h dans un emballage protecteur.'],
                    ['title' => 'Matières Hypoallergéniques', 'text' => 'Tissus respirants et anti-acariens pour un sommeil sain.'],
                ],
            ],
            'draps-couettes' => [
                'badge' => '🧺 Douceur qui rassure',
                'title' => 'Draps & Couettes',
                'headline' => 'Votre cocon, chaque nuit.',
                'subtitle' => "Des matières respirantes, des finitions premium et une sensation de propre qui donne envie d'aller se coucher.",
                'hero_bg' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=900&h=1100&fit=crop',
                'benefits' => [
                    ['title' => 'Douceur immédiate', 'text' => 'Une sensation enveloppante, comme à l’hôtel, dès la première nuit.'],
                    ['title' => 'Respirant', 'text' => 'Des tissus qui laissent circuler l’air pour un sommeil plus frais.'],
                    ['title' => 'Élégance simple', 'text' => 'Des couleurs et finitions qui transforment la chambre en cocon.'],
                ],
                'cta_title' => 'Votre lit mérite ce confort',
                'cta_text' => "Choisis la matière et la taille : on t'aide à composer l'ensemble parfait.",
                'cta_button' => 'Je compose mon linge de lit',
                'faq' => [
                    ['q' => 'Quelle taille choisir ?', 'a' => "Vérifie les dimensions de ton matelas et privilégie une housse adaptée (bonnet)."],
                    ['q' => 'Quelle matière est la plus confortable ?', 'a' => "Le coton est polyvalent. Le percale est plus frais. Le satin est plus doux et soyeux."],
                    ['q' => 'Couette chaude ou légère ?', 'a' => "Tout dépend de la saison et de ta sensibilité à la chaleur. Une couette 4 saisons est idéale."],
                ],
                'hero_card_badge_top' => 'Douceur',
                'hero_card_badge_bottom' => 'premium',
                'carousel_title' => 'Nos Best-Sellers Linge de Lit',
                'carousel_desc' => 'Draps et couettes préférés de nos clients — douceur garantie.',
                'inspire_title' => 'Créez Votre Cocon de Douceur',
                'inspire_desc' => 'Des matières nobles et des finitions soignées pour transformer chaque nuit.',
                'inspire_cards' => [
                    ['img' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=800&h=1000&fit=crop', 'tag' => 'Coton Égyptien', 'title' => 'drap couleur unie ( Drap addict)', 'text' => 'La douceur incomparable du coton longues fibres.'],
                    ['img' => 'https://images.unsplash.com/photo-1616046229478-9901c5536a45?w=600&h=400&fit=crop', 'tag' => 'Percale', 'title' => 'Drap avec motif (Fleurie)'],
                    ['img' => 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=600&h=400&fit=crop', 'tag' => 'Satin', 'title' => 'Drap en coton'],
                ],
                'categories_title' => 'Couettes & Oreillers',
                'categories_badge' => 'CATÉGORIES',
                'categories_cards' => [
                    [
                        'img' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=1200&h=800&fit=crop',
                        'tag' => 'COUETTES',
                        'title' => 'COUETTES',
                        'items' => [
                            'Couleur unique',
                            'Avec motif',
                        ],
                    ],
                    [
                        'img' => 'https://images.unsplash.com/photo-1582582429416-03ad554aab0d?w=1200&h=800&fit=crop',
                        'tag' => 'OREILLERS',
                        'title' => 'OREILLERS',
                        'items' => [
                            'Oreiller pH2 avec motif',
                            'Oreiller basique avec motif',
                            'Oreiller en Ouate mini',
                            'Oreiller en ouate extra',
                        ],
                    ],
                ],
                'mission_title' => 'Le Linge de Lit Qui Fait la Différence',
                'mission_desc' => 'Des draps qui respirent, des couettes qui enveloppent, des matières qui durent. Transformez votre lit en véritable refuge.',
                'reco_title' => 'Notre Linge de Lit Recommandé',
                'reco_desc' => 'Sélectionné pour sa douceur et sa qualité exceptionnelle.',
                'reco_bg' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=1920&h=600&fit=crop',
                'why_title' => 'Rejoignez <span>+1 800</span> clients conquis',
                'why_subtitle' => 'Ils ont transformé leur lit en cocon. Découvrez leur secret.',
                'why_stats' => [
                    ['number' => '99%', 'label' => 'Clients satisfaits'],
                    ['number' => '5 ans', 'label' => 'Durée de vie'],
                    ['number' => '60°C', 'label' => 'Lavable'],
                ],
                'why_benefits' => [
                    ['title' => 'Matières Nobles Certifiées', 'text' => 'Coton bio, percale 80 fils, satin de qualité hôtelière.'],
                    ['title' => 'Confort Toutes Saisons', 'text' => 'Couettes légères en été, chaudes en hiver, ou 4 saisons.'],
                    ['title' => 'Livraison Soignée', 'text' => 'Emballage premium, livraison rapide et suivi en temps réel.'],
                    ['title' => 'Entretien Facile', 'text' => 'Lavable en machine, séchage rapide, repassage minimal.'],
                ],
            ],
            'lits-sommiers' => [
                'badge' => '🛏️ Élégance & robustesse',
                'title' => 'Lits & Sommiers',
                'headline' => 'Une chambre qui inspire.',
                'subtitle' => "Un lit beau, solide et silencieux : le point de départ d'un intérieur apaisant.",
                'hero_bg' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=900&h=1100&fit=crop',
                'benefits' => [
                    ['title' => 'Silence absolu', 'text' => 'Fini les grincements. Un sommeil continu, sans micro-réveils.'],
                    ['title' => 'Stabilité qui rassure', 'text' => 'Une structure solide, un soutien fiable, nuit après nuit.'],
                    ['title' => 'Style qui apaise', 'text' => 'Une chambre élégante qui donne envie de rentrer et souffler.'],
                ],
                'cta_title' => 'Le lit parfait existe',
                'cta_text' => "Choisis ton style et ta taille : on t'aide à trouver la base idéale pour ton matelas.",
                'cta_button' => 'Je choisis mon lit',
                'faq' => [
                    ['q' => 'Sommiers : lattes ou tapissier ?', 'a' => "Les lattes offrent plus d'aération et de soutien. Le tapissier ajoute un rendu plus décoratif."],
                    ['q' => 'Comment éviter un lit qui grince ?', 'a' => "Une structure stable, des fixations de qualité et un bon serrage font toute la différence."],
                    ['q' => 'Quelle hauteur de lit choisir ?', 'a' => "Une hauteur confortable facilite le lever et donne une sensation plus premium à la chambre."],
                ],
                'hero_card_badge_top' => 'Silence',
                'hero_card_badge_bottom' => 'et style',
                'carousel_title' => 'Nos Best-Sellers Lits & Sommiers',
                'carousel_desc' => 'Les lits et sommiers préférés de nos clients — découvrez pourquoi.',
                'inspire_title' => 'Créez Votre Refuge de Bien-Être',
                'inspire_desc' => 'Chaque nuit mérite d\'être exceptionnelle. Découvrez nos univers pensés pour éveiller vos sens.',
                'inspire_cards' => [
                    ['img' => 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800&h=1000&fit=crop', 'tag' => 'Luxe & Sérénité', 'title' => 'L\'Art du Sommeil Parfait', 'text' => 'Plongez dans un cocon de douceur où chaque détail invite à la détente absolue.'],
                    ['img' => 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=600&h=400&fit=crop', 'tag' => 'Design Moderne', 'title' => 'Élégance Contemporaine'],
                    ['img' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=600&h=400&fit=crop', 'tag' => 'Cosy & Chaleureux', 'title' => 'Douceur Naturelle'],
                ],
                'mission_title' => 'Transformer Votre Chambre en Sanctuaire',
                'mission_desc' => 'Chez Mobilier Addict, nous croyons qu\'un lit de qualité est le fondement d\'un sommeil réparateur. Nous sélectionnons des structures élégantes, stables et silencieuses qui subliment votre espace.',
                'reco_title' => 'Nos Lits & Sommiers Recommandés',
                'reco_desc' => 'Le top pour une chambre stable, silencieuse et élégante.',
                'reco_bg' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=1920&h=600&fit=crop',
                'why_title' => 'Rejoignez <span>+2 500</span> clients satisfaits',
                'why_subtitle' => 'Ils nous ont fait confiance pour transformer leur chambre. À votre tour !',
                'why_stats' => [
                    ['number' => '98%', 'label' => 'Clients satisfaits'],
                    ['number' => '10 ans', 'label' => 'Garantie structure'],
                    ['number' => '48h', 'label' => 'Livraison express'],
                ],
                'why_benefits' => [
                    ['title' => 'Qualité Premium Garantie', 'text' => 'Sélection rigoureuse des meilleurs fabricants européens.'],
                    ['title' => 'Conseil Personnalisé Gratuit', 'text' => 'Un expert dédié vous guide pour choisir le lit parfait.'],
                    ['title' => 'Garantie Satisfait ou Remboursé', 'text' => '30 jours pour tester. Retour gratuit, remboursement intégral.'],
                    ['title' => 'Livraison & Montage Inclus', 'text' => 'Livré chez vous en 48h avec montage par nos experts.'],
                ],
            ],
            'cuisine' => [
                'badge' => '🍳 Équipez votre cuisine',
                'title' => 'Cuisine',
                'headline' => 'Une cuisine bien équipée.',
                'subtitle' => 'Gazinières, mixeurs, bouilloires, réfrigérateurs et congélateurs pour simplifier votre quotidien.',
                'hero_bg' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=900&h=1100&fit=crop',
                'benefits' => [
                    ['title' => 'Performance', 'text' => 'Des appareils fiables et efficaces pour cuisiner en toute simplicité.'],
                    ['title' => 'Économie d\'énergie', 'text' => 'Appareils classe A+ pour réduire votre consommation.'],
                    ['title' => 'Design moderne', 'text' => 'Des finitions élégantes qui s\'intègrent à votre intérieur.'],
                ],
                'cta_title' => 'Trouvez l\'appareil idéal',
                'cta_text' => 'Dites-nous vos besoins, on vous guide vers le bon équipement.',
                'cta_button' => 'Je m\'équipe',
                'faq' => [
                    ['q' => 'Quelle gazinière choisir ?', 'a' => 'Gaz, électrique ou mixte selon vos préférences et votre installation.'],
                    ['q' => 'Quelle capacité de réfrigérateur ?', 'a' => 'Comptez environ 100L par personne dans le foyer.'],
                    ['q' => 'Garantie des appareils ?', 'a' => 'Tous nos appareils sont garantis 2 ans minimum.'],
                ],
                'hero_card_badge_top' => 'Qualité',
                'hero_card_badge_bottom' => 'garantie',
                'carousel_title' => 'Nos Best-Sellers Cuisine',
                'carousel_desc' => 'Les équipements préférés de nos clients — efficacité garantie.',
                'inspire_title' => 'Cuisinez Comme un Chef',
                'inspire_desc' => 'Des appareils performants pour des repas réussis à chaque fois.',
                'inspire_cards' => [
                    ['img' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=1000&fit=crop', 'tag' => 'Électroménager', 'title' => 'Cuisine Équipée', 'text' => 'Tout ce qu\'il faut pour préparer vos meilleurs plats.'],
                    ['img' => 'https://images.unsplash.com/photo-1574269909862-7e1d70bb8078?w=600&h=400&fit=crop', 'tag' => 'Réfrigération', 'title' => 'Conservation Optimale'],
                    ['img' => 'https://images.unsplash.com/photo-1585515320310-259814833e62?w=600&h=400&fit=crop', 'tag' => 'Cuisson', 'title' => 'Précision & Puissance'],
                ],
                'mission_title' => 'Une Cuisine Performante',
                'mission_desc' => 'Nous sélectionnons des appareils fiables, économes en énergie et design pour transformer votre cuisine en véritable espace de création.',
                'reco_title' => 'Nos Équipements Recommandés',
                'reco_desc' => 'Sélectionnés pour leur fiabilité et leur rapport qualité-prix.',
                'reco_bg' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=1920&h=600&fit=crop',
                'why_title' => 'Rejoignez <span>+3 000</span> cuisiniers satisfaits',
                'why_subtitle' => 'Ils ont équipé leur cuisine avec nous. À votre tour !',
                'why_stats' => [
                    ['number' => '97%', 'label' => 'Clients satisfaits'],
                    ['number' => '2 ans', 'label' => 'Garantie minimum'],
                    ['number' => 'A+', 'label' => 'Classe énergétique'],
                ],
                'why_benefits' => [
                    ['title' => 'Marques de Confiance', 'text' => 'Partenaires des meilleures marques d\'électroménager.'],
                    ['title' => 'Installation Possible', 'text' => 'Service d\'installation par nos techniciens qualifiés.'],
                    ['title' => 'SAV Réactif', 'text' => 'Support technique disponible 7j/7 pour vous accompagner.'],
                    ['title' => 'Livraison Sécurisée', 'text' => 'Vos appareils livrés avec soin, emballage renforcé.'],
                ],
            ],
            'froid-climatisation' => [
                'badge' => '❄️ Restez au frais',
                'title' => 'Froid & Climatisation',
                'headline' => 'Le confort thermique à portée de main.',
                'subtitle' => 'Climatiseurs, ventilateurs et solutions de refroidissement pour un intérieur agréable toute l\'année.',
                'hero_bg' => 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=900&h=1100&fit=crop',
                'benefits' => [
                    ['title' => 'Fraîcheur instantanée', 'text' => 'Climatisation rapide et efficace pour un confort immédiat.'],
                    ['title' => 'Silencieux', 'text' => 'Appareils discrets qui ne perturbent pas votre quotidien.'],
                    ['title' => 'Économique', 'text' => 'Technologie inverter pour une consommation maîtrisée.'],
                ],
                'cta_title' => 'Quel climatiseur pour vous ?',
                'cta_text' => 'Surface, budget, installation : on vous aide à choisir.',
                'cta_button' => 'Je trouve ma solution',
                'faq' => [
                    ['q' => 'Quelle puissance choisir ?', 'a' => 'Comptez environ 100W par m² pour un refroidissement optimal.'],
                    ['q' => 'Split ou mobile ?', 'a' => 'Le split est plus performant, le mobile plus flexible.'],
                    ['q' => 'Entretien nécessaire ?', 'a' => 'Nettoyage des filtres régulier pour maintenir l\'efficacité.'],
                ],
                'hero_card_badge_top' => 'Fraîcheur',
                'hero_card_badge_bottom' => 'garantie',
                'carousel_title' => 'Nos Best-Sellers Climatisation',
                'carousel_desc' => 'Les solutions de refroidissement préférées de nos clients.',
                'inspire_title' => 'Un Intérieur Toujours Agréable',
                'inspire_desc' => 'Climatiseurs performants et silencieux pour un confort optimal.',
                'inspire_cards' => [
                    ['img' => 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=800&h=1000&fit=crop', 'tag' => 'Climatiseurs', 'title' => 'Fraîcheur Maîtrisée', 'text' => 'Des appareils puissants et économes pour votre confort.'],
                    ['img' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=400&fit=crop', 'tag' => 'Ventilateurs', 'title' => 'Brise Légère'],
                    ['img' => 'https://images.unsplash.com/photo-1631545806609-3c480b5c0d38?w=600&h=400&fit=crop', 'tag' => 'Split', 'title' => 'Performance Pro'],
                ],
                'mission_title' => 'Le Confort Thermique Idéal',
                'mission_desc' => 'Nous proposons des solutions de climatisation adaptées à tous les espaces, pour un confort thermique optimal en toutes saisons.',
                'reco_title' => 'Nos Solutions Recommandées',
                'reco_desc' => 'Efficacité, silence et économie d\'énergie.',
                'reco_bg' => 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=1920&h=600&fit=crop',
                'why_title' => 'Rejoignez <span>+1 500</span> foyers rafraîchis',
                'why_subtitle' => 'Ils ont choisi le confort thermique. À votre tour !',
                'why_stats' => [
                    ['number' => '98%', 'label' => 'Clients satisfaits'],
                    ['number' => '3 ans', 'label' => 'Garantie compresseur'],
                    ['number' => '-40%', 'label' => 'Économie d\'énergie'],
                ],
                'why_benefits' => [
                    ['title' => 'Installation Professionnelle', 'text' => 'Pose par des techniciens certifiés pour une efficacité maximale.'],
                    ['title' => 'Garantie Étendue', 'text' => '3 ans de garantie sur tous nos climatiseurs split.'],
                    ['title' => 'Devis Gratuit', 'text' => 'Étude de vos besoins et devis personnalisé sans engagement.'],
                    ['title' => 'SAV Rapide', 'text' => 'Intervention sous 48h en cas de problème.'],
                ],
            ],
            'salon' => [
                'badge' => '🛋️ Votre espace de vie',
                'title' => 'Salon',
                'headline' => 'Un salon qui vous ressemble.',
                'subtitle' => 'Canapés, fauteuils et meubles pour créer un espace de vie chaleureux et accueillant.',
                'hero_bg' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=900&h=1100&fit=crop',
                'benefits' => [
                    ['title' => 'Confort absolu', 'text' => 'Des assises moelleuses et enveloppantes pour se détendre.'],
                    ['title' => 'Style & Design', 'text' => 'Des lignes modernes qui subliment votre intérieur.'],
                    ['title' => 'Durabilité', 'text' => 'Des matériaux résistants pour un mobilier qui dure.'],
                ],
                'cta_title' => 'Créez votre salon idéal',
                'cta_text' => 'Style, taille, budget : on vous aide à composer votre espace.',
                'cta_button' => 'Je crée mon salon',
                'faq' => [
                    ['q' => 'Quel canapé pour un petit salon ?', 'a' => 'Optez pour un canapé d\'angle ou convertible pour optimiser l\'espace.'],
                    ['q' => 'Tissu ou cuir ?', 'a' => 'Le tissu est plus chaleureux, le cuir plus facile à entretenir.'],
                    ['q' => 'Quelle densité de mousse ?', 'a' => 'Minimum 35kg/m³ pour un confort durable.'],
                ],
                'hero_card_badge_top' => 'Confort',
                'hero_card_badge_bottom' => '& style',
                'carousel_title' => 'Nos Best-Sellers Salon',
                'carousel_desc' => 'Les meubles préférés de nos clients pour un salon parfait.',
                'inspire_title' => 'Créez Votre Cocon de Détente',
                'inspire_desc' => 'Des meubles confortables et élégants pour des moments de partage.',
                'inspire_cards' => [
                    ['img' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&h=1000&fit=crop', 'tag' => 'Canapés', 'title' => 'Confort Premium', 'text' => 'Des assises généreuses pour des moments de détente absolue.'],
                    ['img' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=600&h=400&fit=crop', 'tag' => 'Fauteuils', 'title' => 'Élégance Pure'],
                    ['img' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=600&h=400&fit=crop', 'tag' => 'Meubles TV', 'title' => 'Design Moderne'],
                ],
                'mission_title' => 'Un Salon Qui Vous Ressemble',
                'mission_desc' => 'Nous sélectionnons des meubles alliant confort, esthétique et durabilité pour créer l\'espace de vie dont vous rêvez.',
                'reco_title' => 'Nos Meubles Recommandés',
                'reco_desc' => 'Confort, style et qualité pour votre salon.',
                'reco_bg' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1920&h=600&fit=crop',
                'why_title' => 'Rejoignez <span>+2 200</span> salons transformés',
                'why_subtitle' => 'Ils ont créé leur espace de vie idéal. À votre tour !',
                'why_stats' => [
                    ['number' => '96%', 'label' => 'Clients satisfaits'],
                    ['number' => '5 ans', 'label' => 'Garantie structure'],
                    ['number' => '72h', 'label' => 'Livraison rapide'],
                ],
                'why_benefits' => [
                    ['title' => 'Qualité Artisanale', 'text' => 'Meubles fabriqués avec des matériaux nobles et durables.'],
                    ['title' => 'Livraison & Montage', 'text' => 'Installation par nos équipes pour un salon prêt à vivre.'],
                    ['title' => 'Garantie 5 Ans', 'text' => 'Structure garantie pour une tranquillité d\'esprit totale.'],
                    ['title' => 'Conseils Déco', 'text' => 'Nos experts vous aident à harmoniser votre intérieur.'],
                ],
            ],
            'multi-media' => [
                'badge' => '📺 Divertissement total',
                'title' => 'Multi-Média',
                'headline' => 'Le son et l\'image comme jamais.',
                'subtitle' => 'Télévisions, woofers, barres de son et accessoires audio-vidéo pour une expérience immersive.',
                'hero_bg' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=900&h=1100&fit=crop',
                'benefits' => [
                    ['title' => 'Image 4K/8K', 'text' => 'Des écrans ultra-haute définition pour des images époustouflantes.'],
                    ['title' => 'Son surround', 'text' => 'Des basses profondes et un son enveloppant.'],
                    ['title' => 'Smart TV', 'text' => 'Accès à toutes vos applications de streaming préférées.'],
                ],
                'cta_title' => 'Quel écran pour vous ?',
                'cta_text' => 'Taille, technologie, budget : on vous guide vers le bon choix.',
                'cta_button' => 'Je choisis mon écran',
                'faq' => [
                    ['q' => 'Quelle taille de TV ?', 'a' => 'Distance de visionnage divisée par 1.5 = taille idéale en pouces.'],
                    ['q' => 'OLED ou QLED ?', 'a' => 'OLED pour les noirs parfaits, QLED pour la luminosité.'],
                    ['q' => 'Quelle barre de son ?', 'a' => 'Choisissez selon la taille de votre pièce et vos besoins.'],
                ],
                'hero_card_badge_top' => 'Son',
                'hero_card_badge_bottom' => '& image',
                'carousel_title' => 'Nos Best-Sellers Multi-Média',
                'carousel_desc' => 'Les équipements préférés de nos clients pour le divertissement.',
                'inspire_title' => 'Vivez l\'Expérience Immersive',
                'inspire_desc' => 'Des écrans spectaculaires et un son puissant pour vos soirées.',
                'inspire_cards' => [
                    ['img' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=800&h=1000&fit=crop', 'tag' => 'Télévisions', 'title' => 'Image Époustouflante', 'text' => 'Des écrans 4K/8K pour des images d\'une netteté incroyable.'],
                    ['img' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=600&h=400&fit=crop', 'tag' => 'Audio', 'title' => 'Son Puissant'],
                    ['img' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=400&fit=crop', 'tag' => 'Home Cinéma', 'title' => 'Expérience Cinéma'],
                ],
                'mission_title' => 'Le Divertissement Nouvelle Génération',
                'mission_desc' => 'Nous sélectionnons les meilleures technologies audio-vidéo pour transformer votre salon en salle de cinéma.',
                'reco_title' => 'Nos Équipements Recommandés',
                'reco_desc' => 'Image, son et connectivité au top.',
                'reco_bg' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=1920&h=600&fit=crop',
                'why_title' => 'Rejoignez <span>+1 800</span> passionnés équipés',
                'why_subtitle' => 'Ils ont transformé leur salon en salle de cinéma. À votre tour !',
                'why_stats' => [
                    ['number' => '99%', 'label' => 'Clients satisfaits'],
                    ['number' => '3 ans', 'label' => 'Garantie écran'],
                    ['number' => '4K/8K', 'label' => 'Ultra HD'],
                ],
                'why_benefits' => [
                    ['title' => 'Grandes Marques', 'text' => 'Samsung, LG, Sony et les meilleures marques audio.'],
                    ['title' => 'Installation Murale', 'text' => 'Pose de votre TV au mur par nos techniciens.'],
                    ['title' => 'Garantie Étendue', 'text' => '3 ans de garantie sur tous nos écrans.'],
                    ['title' => 'Conseil Expert', 'text' => 'Nos spécialistes vous aident à choisir le setup parfait.'],
                ],
            ],
            default => [
                'badge' => '✨ Découvrez notre sélection',
                'title' => $pageTitle,
                'headline' => $pageTitle,
                'subtitle' => $pageDescription ?: "Découvrez nos incontournables.",
                'hero_bg' => 'https://images.unsplash.com/photo-1616627561839-074385245ff6?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=900&h=1100&fit=crop',
                'benefits' => [
                    ['title' => 'Choix facile', 'text' => 'Une sélection claire des essentiels.'],
                    ['title' => 'Qualité', 'text' => 'Des produits durables et confortables.'],
                    ['title' => 'Service', 'text' => 'Livraison rapide et accompagnement.'],
                ],
                'cta_title' => 'Besoin de conseils ?',
                'cta_text' => "Parle-nous de ton besoin : on te recommande la meilleure option.",
                'cta_button' => 'Je me fais guider',
                'faq' => [
                    ['q' => 'Comment choisir ?', 'a' => "Dis-nous ce que tu recherches, on te guide vers la bonne sélection."],
                    ['q' => 'Puis-je commander facilement ?', 'a' => 'Oui : paiement flexible et livraison rapide.'],
                    ['q' => 'Une question ?', 'a' => "Notre support est disponible pour t'aider."],
                ],
                'hero_card_badge_top' => 'Sélection',
                'hero_card_badge_bottom' => 'premium',
                'carousel_title' => 'Nos Best-Sellers',
                'carousel_desc' => 'Les produits préférés de nos clients.',
                'inspire_title' => 'Découvrez Notre Univers',
                'inspire_desc' => 'Une sélection pensée pour votre confort et votre style.',
                'inspire_cards' => [
                    ['img' => 'https://images.unsplash.com/photo-1616627561839-074385245ff6?w=800&h=1000&fit=crop', 'tag' => 'Sélection', 'title' => 'Qualité Premium', 'text' => 'Des produits sélectionnés avec soin.'],
                    ['img' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&h=400&fit=crop', 'tag' => 'Confort', 'title' => 'Bien-Être'],
                    ['img' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=600&h=400&fit=crop', 'tag' => 'Design', 'title' => 'Style Moderne'],
                ],
                'mission_title' => 'Notre Engagement Qualité',
                'mission_desc' => 'Nous sélectionnons les meilleurs produits pour votre satisfaction.',
                'reco_title' => 'Nos Recommandations',
                'reco_desc' => 'Notre sélection pour vous.',
                'reco_bg' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=1920&h=600&fit=crop',
                'why_title' => 'Rejoignez <span>nos clients</span> satisfaits',
                'why_subtitle' => 'Ils nous ont fait confiance. À votre tour !',
                'why_stats' => [
                    ['number' => '95%', 'label' => 'Clients satisfaits'],
                    ['number' => '2 ans', 'label' => 'Garantie'],
                    ['number' => '48h', 'label' => 'Livraison'],
                ],
                'why_benefits' => [
                    ['title' => 'Qualité Garantie', 'text' => 'Produits sélectionnés avec soin.'],
                    ['title' => 'Service Client', 'text' => 'Support disponible pour vous accompagner.'],
                    ['title' => 'Livraison Rapide', 'text' => 'Livraison dans les meilleurs délais.'],
                    ['title' => 'Satisfaction', 'text' => 'Votre satisfaction est notre priorité.'],
                ],
            ],
        };

        $featuresTitle = match ($designSlug) {
            'lits-sommiers' => 'Pourquoi votre chambre va changer',
            'oreillers' => 'Pourquoi votre nuque va vous remercier',
            'draps-couettes' => 'Pourquoi vous allez adorer vous coucher',
            default => 'Pourquoi vous allez l’adorer',
        };

        $featuresSubtitle = match ($designSlug) {
            'lits-sommiers' => 'Stabilité, silence, style : tout ce qui rend une chambre plus apaisante.',
            'oreillers' => 'Le maintien juste, au bon endroit : pour des réveils plus légers.',
            'draps-couettes' => 'Douceur, respirabilité et finition premium : l’effet “hôtel” à la maison.',
            default => 'Des choix simples, pensés pour votre confort et votre quotidien.',
        };

        $teaserTitle = match ($designSlug) {
            'lits-sommiers' => 'Nos lits & sommiers préférés',
            'oreillers' => 'Nos oreillers les plus appréciés',
            'draps-couettes' => 'Nos incontournables du linge de lit',
            default => 'Nos recommandations',
        };

        $teaserSubtitle = match ($designSlug) {
            'lits-sommiers' => 'Le top pour une chambre stable, silencieuse et élégante.',
            'oreillers' => 'Le bon maintien, la bonne hauteur, le bon réveil.',
            'draps-couettes' => 'Des matières qui donnent envie de se coucher plus tôt.',
            default => 'Une sélection courte pour aller vite. Pour tout voir, ouvre la liste complète.',
        };

        $guideTitle = match ($designSlug) {
            'lits-sommiers' => 'Guide : choisir son lit sans regret',
            'oreillers' => 'Guide : trouver le bon oreiller',
            'draps-couettes' => 'Guide : composer un lit parfait',
            default => 'Guide d’achat rapide',
        };

        $guideSubtitle = match ($designSlug) {
            'lits-sommiers' => 'Taille, stabilité, silence : les 3 critères qui font la différence.',
            'oreillers' => 'Position de sommeil, hauteur, matière : choisissez juste.',
            'draps-couettes' => 'Matière, taille, sensation : l’ensemble qui change vos nuits.',
            default => '3 étapes pour choisir en confiance — sans vous tromper.',
        };

        $guideSteps = match ($designSlug) {
            'lits-sommiers' => [
                ['title' => 'Votre style', 'text' => 'Minimal, chaleureux, premium : choisissez ce qui apaise votre chambre.'],
                ['title' => 'Votre taille', 'text' => '1 place, 2 places : prenez les bonnes dimensions pour votre matelas.'],
                ['title' => 'Votre silence', 'text' => 'Une structure stable évite les grincements et les micro‑réveils.'],
            ],
            'oreillers' => [
                ['title' => 'Votre position', 'text' => 'Côté, dos, ventre : l’oreiller s’adapte à votre posture.'],
                ['title' => 'Votre hauteur', 'text' => 'Ni trop bas, ni trop haut : gardez la nuque alignée.'],
                ['title' => 'Votre matière', 'text' => 'Mémoire ou fibres : choisissez maintien ou légèreté.'],
            ],
            'draps-couettes' => [
                ['title' => 'Votre matière', 'text' => 'Coton, percale, satin : selon la douceur et la fraîcheur voulues.'],
                ['title' => 'Votre taille', 'text' => 'Choisissez une housse adaptée (bonnet) et une couette à la bonne dimension.'],
                ['title' => 'Votre saison', 'text' => 'Léger, chaud, 4 saisons : pour un confort stable toute l’année.'],
            ],
            default => [
                ['title' => 'Votre besoin', 'text' => 'Confort, maintien, chaleur, style : le bon choix commence par votre ressenti.'],
                ['title' => 'Votre usage', 'text' => 'Solo ou couple, quotidien ou occasionnel : adaptez la matière et la structure.'],
                ['title' => 'Votre décision', 'text' => 'Choisissez la sélection ci-dessous — et finalisez en 2 minutes.'],
            ],
        };

        $compareTitle = match ($designSlug) {
            'lits-sommiers' => 'Comparatif : trouvez votre style',
            'oreillers' => 'Comparatif : hauteur & maintien',
            'draps-couettes' => 'Comparatif : matière & sensation',
            default => 'Choisir plus vite',
        };

        $compareSubtitle = match ($designSlug) {
            'lits-sommiers' => 'Décidez en 10 secondes, puis choisissez dans la sélection.',
            'oreillers' => 'Le bon oreiller, c’est celui qui aligne votre nuque.',
            'draps-couettes' => 'La bonne matière, c’est celle qui vous donne envie de vous coucher.',
            default => 'Un comparatif simple pour décider en 10 secondes.',
        };

        $compareCards = match ($designSlug) {
            'lits-sommiers' => [
                ['title' => 'Minimal', 'text' => 'Lignes simples, chambre apaisée.', 'list' => ['Design discret', 'Facile à assortir', 'Style moderne']],
                ['title' => 'Le plus choisi', 'text' => 'Équilibre entre style et stabilité.', 'list' => ['Structure stable', 'Look premium', 'Excellent quotidien'], 'highlight' => true],
                ['title' => 'Signature', 'text' => 'Pour se faire plaisir : finitions haut niveau.', 'list' => ['Tête de lit', 'Rendu luxe', 'Très robuste']],
            ],
            'oreillers' => [
                ['title' => 'Souple', 'text' => 'Accueil doux, sensation cocon.', 'list' => ['Confort moelleux', 'Léger', 'Facile à aimer']],
                ['title' => 'Le plus choisi', 'text' => 'Maintien équilibré au quotidien.', 'list' => ['Soutien stable', 'Confort durable', 'Réveil plus léger'], 'highlight' => true],
                ['title' => 'Ergo', 'text' => 'Mémoire de forme : précision.', 'list' => ['Nuque alignée', 'Anti-pression', 'Sensation enveloppante']],
            ],
            'draps-couettes' => [
                ['title' => 'Coton', 'text' => 'Polyvalent, simple, efficace.', 'list' => ['Facile à laver', 'Confort quotidien', 'Bon budget']],
                ['title' => 'Le plus choisi', 'text' => 'Percale : frais et net.', 'list' => ['Respirant', 'Look hôtel', 'Toucher premium'], 'highlight' => true],
                ['title' => 'Satin', 'text' => 'Doux, soyeux, chic.', 'list' => ['Très doux', 'Rendu luxe', 'Sensation cocon']],
            ],
            default => [
                ['title' => 'Entrée de gamme', 'text' => 'Le bon choix pour démarrer : simple, efficace, budget maîtrisé.', 'list' => ['Confort essentiel', 'Usage occasionnel / étudiant', 'Bon rapport qualité/prix']],
                ['title' => 'Le plus choisi', 'text' => 'L’équilibre parfait : confort premium au quotidien, sans surpayer.', 'list' => ['Confort durable', 'Idéal quotidien', 'Sensation “hôtel”'], 'highlight' => true],
                ['title' => 'Premium', 'text' => 'Pour se faire plaisir : finitions haut niveau, confort maximal.', 'list' => ['Finitions premium', 'Confort haut de gamme', 'Look & sensation luxe']],
            ],
        };

        $testimonialsTitle = match ($designSlug) {
            'lits-sommiers' => 'Ils parlent de leur chambre différemment',
            'oreillers' => 'Ils parlent d’un réveil plus léger',
            'draps-couettes' => 'Ils parlent d’un vrai cocon',
            'cuisine' => 'Ils parlent d’une cuisine transformée',
            'froid-climatisation' => 'Ils parlent d’un confort retrouvé',
            'salon' => 'Ils parlent d’un salon qui respire',
            'multi-media' => 'Ils parlent d’un divertissement au top',
            default => 'Ils en parlent comme d’un changement',
        };

        $testimonialsSubtitle = match ($designSlug) {
            'lits-sommiers' => 'Du style, du silence, et une vraie sensation “premium”.',
            'oreillers' => 'Moins de tensions, plus d’énergie au quotidien.',
            'draps-couettes' => 'Le genre de confort qui donne envie de se coucher plus tôt.',
            'cuisine' => 'Des équipements qui changent le quotidien en cuisine.',
            'froid-climatisation' => 'Une fraîcheur qui fait toute la différence.',
            'salon' => 'Un espace de vie repensé pour le confort.',
            'multi-media' => 'Une expérience son et image qui impressionne.',
            default => 'Des avis qui rassurent avant d’acheter.',
        };

        $testimonials = match ($designSlug) {
            'lits-sommiers' => [
                ['text' => '"Très beau rendu. La chambre a changé d’ambiance, on s’y sent vraiment bien."', 'meta' => 'Awa • Dakar'],
                ['text' => '"Stable et silencieux. On dort mieux parce qu’on ne se réveille plus pour rien."', 'meta' => 'Moussa • Thiès'],
                ['text' => '"Montage simple, qualité au top. Franchement c’est premium."', 'meta' => 'Fatou • Saint‑Louis'],
            ],
            'oreillers' => [
                ['text' => '"Je n’ai plus la nuque bloquée au réveil. Ça change tout."', 'meta' => 'Aïssatou • Rufisque'],
                ['text' => '"Maintien parfait, et pas trop chaud. J’adore."', 'meta' => 'Cheikh • Dakar'],
                ['text' => '"On a pris le pack, super rapport qualité/prix."', 'meta' => 'Mariama • Thiès'],
            ],
            'draps-couettes' => [
                ['text' => '"Sensation hôtel direct. C’est doux et ça respire."', 'meta' => 'Khady • Dakar'],
                ['text' => '"La chambre fait plus premium, et on dort mieux."', 'meta' => 'Mamadou • Saint‑Louis'],
                ['text' => '"Livraison rapide, qualité nickel. Je recommande."', 'meta' => 'Aminata • Thiès'],
            ],
            'cuisine' => [
                ['text' => '"La gazinière est puissante et facile à nettoyer. Un vrai plaisir de cuisiner."', 'meta' => 'Ndèye • Dakar'],
                ['text' => '"Le frigo est silencieux et garde tout bien frais. Parfait pour la famille."', 'meta' => 'Ibrahima • Thiès'],
                ['text' => '"Mixeur ultra efficace, je fais mes jus en 2 minutes."', 'meta' => 'Coumba • Saint‑Louis'],
            ],
            'froid-climatisation' => [
                ['text' => '"Le climatiseur est silencieux et rafraîchit toute la pièce rapidement."', 'meta' => 'Ousmane • Dakar'],
                ['text' => '"Avec la chaleur de Dakar, ce ventilateur est devenu indispensable."', 'meta' => 'Rama • Rufisque'],
                ['text' => '"Installation facile et efficacité immédiate. Je recommande."', 'meta' => 'Abdou • Thiès'],
            ],
            'salon' => [
                ['text' => '"Le canapé est très confortable et le tissu résiste bien. Parfait pour la famille."', 'meta' => 'Mame Diarra • Dakar'],
                ['text' => '"Le meuble TV a modernisé tout le salon. Très beau design."', 'meta' => 'Pape • Saint‑Louis'],
                ['text' => '"Fauteuil relax au top. Après le travail, c’est mon coin préféré."', 'meta' => 'Sokhna • Thiès'],
            ],
            'multi-media' => [
                ['text' => '"Image 4K sublime, Netflix fluide. La famille adore."', 'meta' => 'Modou • Dakar'],
                ['text' => '"La barre de son transforme l’expérience. On se croirait au cinéma."', 'meta' => 'Bineta • Rufisque'],
                ['text' => '"Le woofer Bluetooth a un son puissant. Parfait pour les fêtes."', 'meta' => 'Lamine • Thiès'],
            ],
            default => [
                ['text' => '"Je dors mieux dès la première semaine. Le matin, je suis moins cassée et plus en forme."', 'meta' => 'Awa • Dakar'],
                ['text' => '"Super qualité, très beau rendu dans la chambre. On sent que c’est solide et bien fini."', 'meta' => 'Moussa • Thiès'],
                ['text' => '"Livraison rapide, service réactif. J’ai choisi facilement grâce aux conseils."', 'meta' => 'Fatou • Saint‑Louis'],
            ],
        };

        $fakeProducts = match ($designSlug) {
            'lits-sommiers' => [
                ['name' => 'Lit Élégance – Tête de lit douce', 'desc' => 'Tissu premium • Design apaisant • Montage facile', 'price' => '115.000F', 'old' => '139.000F', 'badge' => '-17%', 'img' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=700&h=700&fit=crop'],
                ['name' => 'Sommier Lattes – Aération & soutien', 'desc' => 'Silencieux • Renfort central • Longue durée', 'price' => '69.000F', 'old' => null, 'badge' => 'Top', 'img' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=700&h=700&fit=crop'],
                ['name' => 'Lit Minimal – Bois chaleureux', 'desc' => 'Stable • Style moderne • Finition soignée', 'price' => '99.000F', 'old' => null, 'badge' => 'New', 'img' => 'https://images.unsplash.com/photo-1615873968403-89e068629265?w=700&h=700&fit=crop'],
                ['name' => 'Pack Chambre – Lit + Sommier', 'desc' => 'Prix doux • Ensemble complet • Confort durable', 'price' => '159.000F', 'old' => '189.000F', 'badge' => 'Pack', 'img' => 'https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?w=700&h=700&fit=crop'],
            ],
            'oreillers' => [
                ['name' => 'Oreiller Mémoire – Nuque alignée', 'desc' => 'Ergonomique • Anti-pression • Housse douce', 'price' => '15.000F', 'old' => '19.000F', 'badge' => '-21%', 'img' => 'https://images.unsplash.com/photo-1582582429416-03ad554aab0d?w=700&h=700&fit=crop'],
                ['name' => 'Oreiller Fraîcheur – Aéré', 'desc' => 'Respirant • Moins de chaleur • Confort stable', 'price' => '12.000F', 'old' => null, 'badge' => 'Best', 'img' => 'https://images.unsplash.com/photo-1616627561839-074385245ff6?w=700&h=700&fit=crop'],
                ['name' => 'Pack Duo – 2 Oreillers', 'desc' => 'Économisez • Idéal couple • Prêt à dormir', 'price' => '22.000F', 'old' => '28.000F', 'badge' => 'Pack', 'img' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=700&h=700&fit=crop'],
                ['name' => 'Oreiller Souple – Accueil doux', 'desc' => 'Sensation cocon • Léger • Confort quotidien', 'price' => '10.000F', 'old' => null, 'badge' => null, 'img' => 'https://images.unsplash.com/photo-1615873968403-89e068629265?w=700&h=700&fit=crop'],
            ],
            'draps-couettes' => [
                ['name' => 'Parure Percale – Fraîche & nette', 'desc' => 'Respirant • Toucher premium • Look hôtel', 'price' => '35.000F', 'old' => '42.000F', 'badge' => '-16%', 'img' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=700&h=700&fit=crop'],
                ['name' => 'Couette 4 Saisons – Équilibre', 'desc' => 'Ni trop chaud • Ni trop léger • Confort annuel', 'price' => '49.000F', 'old' => null, 'badge' => 'Top', 'img' => 'https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?w=700&h=700&fit=crop'],
                ['name' => 'Housse de couette – Satin doux', 'desc' => 'Soyeux • Chic • Sensation cocon', 'price' => '29.000F', 'old' => null, 'badge' => 'New', 'img' => 'https://images.unsplash.com/photo-1615873968403-89e068629265?w=700&h=700&fit=crop'],
                ['name' => 'Pack Lit – Parure + Couette', 'desc' => 'Économisez • Ensemble complet • Très confortable', 'price' => '79.000F', 'old' => '95.000F', 'badge' => 'Pack', 'img' => 'https://images.unsplash.com/photo-1616627561839-074385245ff6?w=700&h=700&fit=crop'],
            ],
            'cuisine' => [
                ['name' => 'Gazinière 4 Feux – Inox Pro', 'desc' => 'Puissante • Facile à nettoyer • Design moderne', 'price' => '185.000F', 'old' => '210.000F', 'badge' => '-12%', 'img' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=700&h=700&fit=crop'],
                ['name' => 'Réfrigérateur 300L – Classe A+', 'desc' => 'Économique • Grande capacité • Silencieux', 'price' => '320.000F', 'old' => null, 'badge' => 'Top', 'img' => 'https://images.unsplash.com/photo-1574269909862-7e1d70bb8078?w=700&h=700&fit=crop'],
                ['name' => 'Mixeur Puissant – 1000W', 'desc' => 'Multifonction • Lames inox • Simple d\'usage', 'price' => '45.000F', 'old' => '55.000F', 'badge' => '-18%', 'img' => 'https://images.unsplash.com/photo-1585515320310-259814833e62?w=700&h=700&fit=crop'],
                ['name' => 'Bouilloire Électrique – Rapide', 'desc' => 'Chauffe en 2min • Arrêt auto • 1.7L', 'price' => '18.000F', 'old' => null, 'badge' => 'New', 'img' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=700&h=700&fit=crop'],
            ],
            'froid-climatisation' => [
                ['name' => 'Climatiseur Split 12000 BTU', 'desc' => 'Inverter • Silencieux • Économique', 'price' => '285.000F', 'old' => '320.000F', 'badge' => '-11%', 'img' => 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=700&h=700&fit=crop'],
                ['name' => 'Ventilateur Sur Pied – 3 Vitesses', 'desc' => 'Oscillant • Télécommande • Silencieux', 'price' => '35.000F', 'old' => null, 'badge' => 'Best', 'img' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=700&h=700&fit=crop'],
                ['name' => 'Climatiseur Mobile – 9000 BTU', 'desc' => 'Portable • Facile à installer • Efficace', 'price' => '195.000F', 'old' => '230.000F', 'badge' => '-15%', 'img' => 'https://images.unsplash.com/photo-1631545806609-3c480b5c0d38?w=700&h=700&fit=crop'],
                ['name' => 'Refroidisseur d\'Air – Compact', 'desc' => 'Économique • Humidificateur • 3 modes', 'price' => '55.000F', 'old' => null, 'badge' => 'New', 'img' => 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=700&h=700&fit=crop'],
            ],
            'salon' => [
                ['name' => 'Canapé 3 Places – Tissu Premium', 'desc' => 'Confortable • Design moderne • Résistant', 'price' => '450.000F', 'old' => '520.000F', 'badge' => '-13%', 'img' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=700&h=700&fit=crop'],
                ['name' => 'Fauteuil Relax – Cuir Synthétique', 'desc' => 'Inclinable • Repose-pieds • Élégant', 'price' => '185.000F', 'old' => null, 'badge' => 'Top', 'img' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=700&h=700&fit=crop'],
                ['name' => 'Meuble TV – Design Scandinave', 'desc' => 'Bois massif • Rangements • 140cm', 'price' => '125.000F', 'old' => '145.000F', 'badge' => '-14%', 'img' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=700&h=700&fit=crop'],
                ['name' => 'Table Basse – Verre & Métal', 'desc' => 'Moderne • Facile à nettoyer • Stable', 'price' => '85.000F', 'old' => null, 'badge' => 'New', 'img' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=700&h=700&fit=crop'],
            ],
            'multi-media' => [
                ['name' => 'TV LED 55" 4K Smart – Android', 'desc' => 'Ultra HD • Netflix intégré • HDR', 'price' => '385.000F', 'old' => '450.000F', 'badge' => '-14%', 'img' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=700&h=700&fit=crop'],
                ['name' => 'Barre de Son 2.1 – 300W', 'desc' => 'Bluetooth • Caisson inclus • Puissante', 'price' => '125.000F', 'old' => null, 'badge' => 'Best', 'img' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=700&h=700&fit=crop'],
                ['name' => 'Woofer Bluetooth – Basses Profondes', 'desc' => 'Portable • 12h autonomie • LED RGB', 'price' => '75.000F', 'old' => '89.000F', 'badge' => '-16%', 'img' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=700&h=700&fit=crop'],
                ['name' => 'TV LED 43" Full HD', 'desc' => 'Économique • HDMI x2 • USB', 'price' => '195.000F', 'old' => null, 'badge' => 'New', 'img' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=700&h=700&fit=crop'],
            ],
            default => [
                ['name' => 'Matelas Harmonie – Confort Nuage', 'desc' => 'Mi-ferme • Anti-pression • Ventilation 3D', 'price' => '79.000F', 'old' => '99.000F', 'badge' => '-20%', 'img' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=700&h=700&fit=crop'],
                ['name' => 'Matelas Sérénité – Soutien Premium', 'desc' => 'Ferme • Maintien lombaire • Réveil sans douleur', 'price' => '92.000F', 'old' => null, 'badge' => 'Best', 'img' => 'https://images.unsplash.com/photo-1616627561839-074385245ff6?w=700&h=700&fit=crop'],
                ['name' => 'Surmatelas Douce Brise', 'desc' => 'Moelleux • Housse lavable • Effet hôtel', 'price' => '39.000F', 'old' => '45.000F', 'badge' => '-15%', 'img' => 'https://images.unsplash.com/photo-1615873968403-89e068629265?w=700&h=700&fit=crop'],
                ['name' => 'Pack Duo – Matelas + Oreillers', 'desc' => 'Économisez • Confort complet • Prêt à dormir', 'price' => '119.000F', 'old' => null, 'badge' => 'Pack', 'img' => 'https://images.unsplash.com/photo-1582582429416-03ad554aab0d?w=700&h=700&fit=crop'],
            ],
        };
    @endphp

    @if(true)
        <div class="evc-page">
            <!-- HERO Section - Style EVC -->
            <section class="evc-hero">
                <div class="evc-hero__bg"></div>
                <div class="container">
                    <div class="evc-hero__content">
                        <div class="evc-hero__badge">
                            <svg viewBox="0 0 24 24" width="16" height="16"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="currentColor"/></svg>
                            {{ $page['badge'] }}
                        </div>
                        <h1 class="evc-hero__title">{{ $page['headline'] }}</h1>
                        <p class="evc-hero__subtitle">{{ $page['subtitle'] }}</p>
                        <div class="evc-hero__actions">
                            <a href="#selection" class="evc-btn evc-btn--primary">
                                Découvrir la sélection
                                <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                            </a>
                            <a href="#guide" class="evc-btn evc-btn--outline">Guide d'achat</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="evc-carousel-section" aria-label="Best-sellers">
                <div class="evc-carousel-section__bg"></div>
                <div class="container">
                    <div class="evc-carousel__header">
                        <div class="evc-kicker">Coup de cœur</div>
                        <h2 class="evc-section-title">{{ $page['carousel_title'] ?? 'Nos Best-Sellers' }}</h2>
                        <p class="evc-section-desc">{{ $page['carousel_desc'] ?? 'Les produits préférés de nos clients.' }}</p>
                    </div>

                    <div class="evc-products__grid">
                        @php
                            $carouselProducts = $products->getCollection()->take(8);
                        @endphp

                        @if($carouselProducts->count())
                            @foreach($carouselProducts as $index => $product)
                                <a href="{{ route('product.show', $product->slug) }}" class="evc-carousel-card">
                                    <div class="evc-carousel-card__rank">#{{ $index + 1 }}</div>
                                    @if($product->discount_percent)
                                        <div class="evc-carousel-card__badge">-{{ (int) $product->discount_percent }}%</div>
                                    @elseif($product->badge)
                                        <div class="evc-carousel-card__badge evc-carousel-card__badge--alt">{{ $product->badge }}</div>
                                    @endif
                                    <div class="evc-carousel-card__media">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" loading="lazy" />
                                    </div>
                                    <div class="evc-carousel-card__body">
                                        <h3 class="evc-carousel-card__name">{{ $product->name }}</h3>
                                        <div class="evc-carousel-card__footer">
                                            <div class="evc-carousel-card__prices">
                                                <span class="evc-carousel-card__price">{{ $product->formatted_price }}</span>
                                                @if($product->formatted_old_price)
                                                    <span class="evc-carousel-card__old">{{ $product->formatted_old_price }}</span>
                                                @endif
                                            </div>
                                            <span class="evc-carousel-card__btn" aria-label="Voir le produit">
                                                <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" fill="currentColor"/></svg>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            @foreach(collect($fakeProducts)->take(8) as $index => $fp)
                                <a href="#selection" class="evc-carousel-card">
                                    <div class="evc-carousel-card__rank">#{{ $index + 1 }}</div>
                                    @if($fp['badge'])
                                        <div class="evc-carousel-card__badge">{{ $fp['badge'] }}</div>
                                    @endif
                                    <div class="evc-carousel-card__media">
                                        <img src="{{ $fp['img'] }}" alt="{{ $fp['name'] }}" loading="lazy" />
                                    </div>
                                    <div class="evc-carousel-card__body">
                                        <h3 class="evc-carousel-card__name">{{ $fp['name'] }}</h3>
                                        <div class="evc-carousel-card__footer">
                                            <div class="evc-carousel-card__prices">
                                                <span class="evc-carousel-card__price">{{ $fp['price'] }}</span>
                                                @if($fp['old'])
                                                    <span class="evc-carousel-card__old">{{ $fp['old'] }}</span>
                                                @endif
                                            </div>
                                            <span class="evc-carousel-card__btn" aria-label="Voir le produit">
                                                <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" fill="currentColor"/></svg>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>

            <!-- INSPIRE Section - Grid Layout -->
            <section class="evc-inspire" aria-label="Inspirez-vous">
                <div class="container">
                    <div class="evc-inspire__header">
                        <span class="evc-inspire__badge">✨ Laissez-vous séduire</span>
                        <h2 class="evc-inspire__title">{{ $page['inspire_title'] ?? 'Créez Votre Refuge' }}</h2>
                        <p class="evc-inspire__subtitle">{{ $page['inspire_desc'] ?? 'Découvrez nos univers pensés pour vous.' }}</p>
                    </div>

                    <div class="evc-inspire__grid">
                        @if(isset($page['inspire_cards']))
                            @foreach($page['inspire_cards'] as $index => $card)
                                <a class="evc-inspire__card {{ $index === 0 ? 'evc-inspire__card--large' : '' }}" href="#selection">
                                    <img src="{{ $card['img'] }}" alt="{{ $card['title'] }}" loading="lazy">
                                    <div class="evc-inspire__overlay">
                                        <span class="evc-inspire__tag">{{ $card['tag'] }}</span>
                                        <h3 class="evc-inspire__card-title">{{ $card['title'] }}</h3>
                                        @if(isset($card['text']) && $index === 0)
                                            <p class="evc-inspire__card-text">{{ $card['text'] }}</p>
                                        @endif
                                        <span class="evc-inspire__cta">{{ $index === 0 ? 'Explorer' : 'Découvrir' }} <svg viewBox="0 0 24 24" width="{{ $index === 0 ? '18' : '16' }}" height="{{ $index === 0 ? '18' : '16' }}"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"></path></svg></span>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>

            <!-- MISSION Section - Style EVC -->
            <section class="evc-mission" id="mission">
                <div class="container">
                    <div class="evc-mission__header">
                        <div class="evc-kicker">Notre engagement</div>
                        <h2 class="evc-section-title">{{ $page['mission_title'] ?? 'Notre Mission' }}</h2>
                        <p class="evc-section-desc">{{ $page['mission_desc'] ?? 'Nous sélectionnons les meilleurs produits pour votre confort.' }}</p>
                    </div>
                </div>
            </section>

            <!-- RECOMMANDATIONS Section -->
            <section class="evc-reco" id="selection">
                <div class="evc-reco__bg">
                    <img src="{{ $page['reco_bg'] ?? 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=1920&h=600&fit=crop' }}" alt="" loading="lazy">
                </div>
                <div class="container">
                    <div class="evc-products__header">
                        <div class="evc-kicker evc-kicker--light">Recommandations</div>
                        <h2 class="evc-section-title evc-section-title--light">{{ $page['reco_title'] ?? 'Nos Recommandations' }}</h2>
                        <p class="evc-section-desc evc-section-desc--light">{{ $page['reco_desc'] ?? 'Notre sélection pour vous.' }}</p>
                    </div>

                    <div class="evc-products__grid">
                        @php
                            $recoProducts = $products->getCollection()->take(4);
                        @endphp
                        @if($recoProducts->count())
                            @foreach($recoProducts as $product)
                                <a href="{{ route('product.show', $product->slug) }}" class="evc-product-card">
                                    @if($product->discount_percent)
                                        <div class="evc-product-card__badge evc-product-card__badge--promo">-{{ (int) $product->discount_percent }}%</div>
                                    @elseif($product->badge)
                                        <div class="evc-product-card__badge evc-product-card__badge--alt">{{ $product->badge }}</div>
                                    @endif
                                    <div class="evc-product-card__media">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" loading="lazy" />
                                    </div>
                                    <div class="evc-product-card__body">
                                        <h3 class="evc-product-card__name">{{ $product->name }}</h3>
                                        <div class="evc-product-card__footer">
                                            <div class="evc-product-card__prices">
                                                <span class="evc-product-card__price">{{ $product->formatted_price }}</span>
                                                @if($product->formatted_old_price)
                                                    <span class="evc-product-card__old">{{ $product->formatted_old_price }}</span>
                                                @endif
                                            </div>
                                            <button class="evc-product-card__btn" type="button">
                                                <svg viewBox="0 0 24 24" width="18" height="18"><path d="M17 18c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm0-3l1.1-2h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1v2h2l3.6 7.59L3.62 17H19v-2H7z" fill="currentColor"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            @foreach(collect($fakeProducts)->take(4) as $fp)
                                <article class="evc-product-card">
                                    @if($fp['badge'])
                                        <div class="evc-product-card__badge">{{ $fp['badge'] }}</div>
                                    @endif
                                    <div class="evc-product-card__media">
                                        <img src="{{ $fp['img'] }}" alt="{{ $fp['name'] }}" loading="lazy" />
                                    </div>
                                    <div class="evc-product-card__body">
                                        <h3 class="evc-product-card__name">{{ $fp['name'] }}</h3>
                                        <div class="evc-product-card__footer">
                                            <div class="evc-product-card__prices">
                                                <span class="evc-product-card__price">{{ $fp['price'] }}</span>
                                                @if($fp['old'])
                                                    <span class="evc-product-card__old">{{ $fp['old'] }}</span>
                                                @endif
                                            </div>
                                            <button class="evc-product-card__btn" type="button">
                                                <svg viewBox="0 0 24 24" width="18" height="18"><path d="M17 18c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm0-3l1.1-2h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1v2h2l3.6 7.59L3.62 17H19v-2H7z" fill="currentColor"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>

            <!-- VALEURS Section - Style EVC -->
            <section class="evc-values" id="valeurs">
                <div class="container">
                    <div class="evc-values__header">
                        <div class="evc-kicker">Nos valeurs</div>
                        <h2 class="evc-section-title">Nos Valeurs Fondamentales</h2>
                    </div>
                    <div class="evc-values__grid">
                        @foreach($page['benefits'] as $i => $benefit)
                            <div class="evc-value-card">
                                <div class="evc-value-card__icon">
                                    @if($i === 0)
                                        <svg viewBox="0 0 24 24" width="28" height="28"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="currentColor"/></svg>
                                    @elseif($i === 1)
                                        <svg viewBox="0 0 24 24" width="28" height="28"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z" fill="currentColor"/></svg>
                                    @else
                                        <svg viewBox="0 0 24 24" width="28" height="28"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" fill="currentColor"/></svg>
                                    @endif
                                </div>
                                <h3 class="evc-value-card__title">{{ $benefit['title'] }}</h3>
                                <p class="evc-value-card__text">{{ $benefit['text'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- ATOUTS Section - Persuasive UI/UX Design -->
            <section class="evc-why" id="guide">
                <div class="container">
                    <div class="evc-why__grid">
                        <!-- Left: Stats & Social Proof -->
                        <div class="evc-why__proof">
                            <div class="evc-kicker evc-kicker--light">Pourquoi nous ?</div>
                            <h2 class="evc-why__title">{!! $page['why_title'] ?? 'Rejoignez <span>+2 500</span> clients satisfaits' !!}</h2>
                            <p class="evc-why__subtitle">{{ $page['why_subtitle'] ?? 'Ils nous ont fait confiance. À votre tour !' }}</p>

                            <div class="evc-why__stats">
                                @if(isset($page['why_stats']))
                                    @foreach($page['why_stats'] as $stat)
                                        <div class="evc-stat">
                                            <div class="evc-stat__number">{{ $stat['number'] }}</div>
                                            <div class="evc-stat__label">{{ $stat['label'] }}</div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <a href="#selection" class="evc-btn evc-btn--primary evc-btn--lg">
                                Découvrir la sélection
                                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                            </a>
                        </div>

                        <!-- Right: Benefits Cards -->
                        <div class="evc-why__benefits">
                            @if(isset($page['why_benefits']))
                                @foreach($page['why_benefits'] as $index => $benefit)
                                    <div class="evc-benefit">
                                        <div class="evc-benefit__icon">
                                            @if($index === 0)
                                                <svg viewBox="0 0 24 24" width="24" height="24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" fill="currentColor"/></svg>
                                            @elseif($index === 1)
                                                <svg viewBox="0 0 24 24" width="24" height="24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="currentColor"/></svg>
                                            @elseif($index === 2)
                                                <svg viewBox="0 0 24 24" width="24" height="24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z" fill="currentColor"/></svg>
                                            @else
                                                <svg viewBox="0 0 24 24" width="24" height="24"><path d="M18 18.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM19.5 9.5l1.96 2.5H17V9.5h2.5zM6 18.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM20 8l3 4v5h-2c0 1.66-1.34 3-3 3s-3-1.34-3-3H9c0 1.66-1.34 3-3 3s-3-1.34-3-3H1V6c0-1.11.89-2 2-2h14v4h3zM3 6v9h.76c.55-.61 1.35-1 2.24-1s1.69.39 2.24 1H15V6H3z" fill="currentColor"/></svg>
                                            @endif
                                        </div>
                                        <div class="evc-benefit__content">
                                            <h3 class="evc-benefit__title">{{ $benefit['title'] }}</h3>
                                            <p class="evc-benefit__text">{{ $benefit['text'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <!-- PROMOS Section -->
            @if($promoProducts->count() || collect($fakeProducts)->filter(fn ($p) => !empty($p['old']))->count())
            <section class="evc-promos" id="promos">
                <div class="container">
                    <div class="evc-promos__header">
                        <div class="evc-kicker evc-kicker--light">Offres spéciales</div>
                        <h2 class="evc-section-title evc-section-title--light">Produits en Promotion</h2>
                        <p class="evc-section-desc evc-section-desc--light">Des prix exceptionnels sur une sélection limitée — jusqu'à épuisement des stocks.</p>
                    </div>

                    <div class="evc-products__grid">
                        @if($promoProducts->count())
                            @foreach($promoProducts as $product)
                                <a href="{{ route('product.show', $product->slug) }}" class="evc-product-card evc-product-card--promo">
                                    @if($product->discount_percent)
                                        <div class="evc-product-card__badge evc-product-card__badge--promo">-{{ (int) $product->discount_percent }}%</div>
                                    @endif
                                    <div class="evc-product-card__media">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" loading="lazy" />
                                    </div>
                                    <div class="evc-product-card__body">
                                        <h3 class="evc-product-card__name">{{ $product->name }}</h3>
                                        <div class="evc-product-card__footer">
                                            <div class="evc-product-card__prices">
                                                <span class="evc-product-card__price">{{ $product->formatted_price }}</span>
                                                @if($product->formatted_old_price)
                                                    <span class="evc-product-card__old">{{ $product->formatted_old_price }}</span>
                                                @endif
                                            </div>
                                            <button class="evc-product-card__btn" type="button">
                                                <svg viewBox="0 0 24 24" width="18" height="18"><path d="M17 18c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm0-3l1.1-2h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1v2h2l3.6 7.59L3.62 17H19v-2H7z" fill="currentColor"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            @foreach(collect($fakeProducts)->filter(fn ($p) => !empty($p['old']))->take(4) as $fp)
                                <article class="evc-product-card evc-product-card--promo">
                                    @if($fp['badge'])
                                        <div class="evc-product-card__badge evc-product-card__badge--promo">{{ $fp['badge'] }}</div>
                                    @endif
                                    <div class="evc-product-card__media">
                                        <img src="{{ $fp['img'] }}" alt="{{ $fp['name'] }}" loading="lazy" />
                                    </div>
                                    <div class="evc-product-card__body">
                                        <h3 class="evc-product-card__name">{{ $fp['name'] }}</h3>
                                        <div class="evc-product-card__footer">
                                            <div class="evc-product-card__prices">
                                                <span class="evc-product-card__price">{{ $fp['price'] }}</span>
                                                @if($fp['old'])
                                                    <span class="evc-product-card__old">{{ $fp['old'] }}</span>
                                                @endif
                                            </div>
                                            <button class="evc-product-card__btn" type="button">
                                                <svg viewBox="0 0 24 24" width="18" height="18"><path d="M17 18c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm0-3l1.1-2h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1v2h2l3.6 7.59L3.62 17H19v-2H7z" fill="currentColor"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>
            @endif

            <!-- TESTIMONIALS Section -->
            <section class="evc-testimonials" id="avis">
                <div class="container">
                    <div class="evc-testimonials__header">
                        <div class="evc-kicker">Témoignages</div>
                        <h2 class="evc-section-title">Ce Que Disent Nos Clients</h2>
                        <p class="evc-section-desc">Du style, du silence, et une vraie sensation premium.</p>
                    </div>

                    <div class="evc-testimonials__grid">
                        @foreach($testimonials as $t)
                            <div class="evc-testimonial-card">
                                <div class="evc-testimonial-card__stars">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" fill="currentColor"/></svg>
                                    @endfor
                                </div>
                                <p class="evc-testimonial-card__text">{{ $t['text'] }}</p>
                                <div class="evc-testimonial-card__author">{{ $t['meta'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- CTA FINAL Section - Style EVC -->
            <section class="evc-cta-final">
                <div class="evc-cta-final__bg"></div>
                <div class="container">
                    <div class="evc-cta-final__content">
                        <h2 class="evc-cta-final__title">Prêt à Transformer Votre Chambre ?</h2>
                        <p class="evc-cta-final__text">Rejoignez des centaines de clients satisfaits qui ont déjà fait le choix de la qualité. Découvrez notre sélection et offrez-vous le lit de vos rêves.</p>
                        <div class="evc-cta-final__actions">
                            <a href="#selection" class="evc-btn evc-btn--primary evc-btn--lg">
                                Je découvre la sélection
                                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                            </a>
                            <a href="#" class="evc-btn evc-btn--outline evc-btn--lg">Nous contacter</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @else

    <div class="univers-page">
        <section class="univers-hero" aria-label="Univers">
            <div class="container">
                <nav class="univers-breadcrumb" aria-label="Fil d'ariane">
                    <a href="{{ route('home') }}">Accueil</a>
                    <span>/</span>
                    <span aria-current="page">{{ $pageTitle }}</span>
                </nav>

                <div class="univers-hero__grid">
                    <div class="univers-hero__content">
                        <div class="univers-hero__badge">{{ $page['badge'] }}</div>
                        <h1 class="univers-hero__title">{{ $page['headline'] }}</h1>
                        <p class="univers-hero__subtitle">{{ $page['subtitle'] }}</p>

                        <div class="univers-hero__nav" aria-label="Aller à une section">
                            <a class="univers-pill" href="#benefices">Bénéfices</a>
                            <a class="univers-pill" href="#recommandations">Recommandations</a>
                            <a class="univers-pill" href="#guide">Guide</a>
                            <a class="univers-pill" href="#comparatif">Comparatif</a>
                            <a class="univers-pill" href="#avis">Avis</a>
                            <a class="univers-pill" href="#produits">Produits</a>
                            <a class="univers-pill" href="#faq">FAQ</a>
                        </div>

                        <div class="univers-hero__actions">
                            <a class="univers-btn univers-btn--primary" href="#produits">
                                Découvrir la sélection
                                <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                            </a>
                            <a class="univers-btn univers-btn--ghost" href="#guide">Guide d'achat</a>
                        </div>

                        <div class="univers-trust">
                            <div class="univers-trust__item">
                                <div class="univers-trust__label">Livraison</div>
                                <div class="univers-trust__value">48h</div>
                            </div>
                            <div class="univers-trust__item">
                                <div class="univers-trust__label">Paiement</div>
                                <div class="univers-trust__value">Flexible</div>
                            </div>
                            <div class="univers-trust__item">
                                <div class="univers-trust__label">Garantie</div>
                                <div class="univers-trust__value">10 ans</div>
                            </div>
                        </div>

                        <div class="univers-hero__proof" aria-label="Preuves sociales">
                            <div class="univers-hero__proof-item">
                                <div class="univers-hero__proof-top">4.9/5</div>
                                <div class="univers-hero__proof-bottom">Satisfaction</div>
                            </div>
                            <div class="univers-hero__proof-item">
                                <div class="univers-hero__proof-top">Top ventes</div>
                                <div class="univers-hero__proof-bottom">Sélection sûre</div>
                            </div>
                            <div class="univers-hero__proof-item">
                                <div class="univers-hero__proof-top">Support</div>
                                <div class="univers-hero__proof-bottom">Conseil rapide</div>
                            </div>
                        </div>
                    </div>

                    <div class="univers-hero__media" aria-hidden="true">
                        <img src="{{ $page['hero_card'] }}" alt="" loading="eager" />
                        <div class="univers-hero__stamp">
                            <div class="univers-hero__stamp-top">{{ $page['hero_card_badge_top'] }}</div>
                            <div class="univers-hero__stamp-bottom">{{ $page['hero_card_badge_bottom'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="univers-features" id="benefices" aria-label="Bénéfices">
            <div class="container">
                <div class="univers-section__head">
                    <div class="univers-section__kicker">Pensé pour vous</div>
                    <h2 class="univers-section__title">{{ $featuresTitle }}</h2>
                    <p class="univers-section__subtitle">{{ $featuresSubtitle }}</p>
                </div>

                <div class="univers-features__panel">
                    <div class="univers-features__grid">
                        @foreach($page['benefits'] as $i => $benefit)
                            <div class="univers-card">
                                <div class="univers-card__icon" aria-hidden="true">
                                    @if($i % 3 === 0)
                                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 21s-7-4.4-7-11a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 6.6-7 11-7 11z" fill="currentColor"/></svg>
                                    @elseif($i % 3 === 1)
                                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2a8 8 0 1 0 8 8c0-1.2-.3-2.4-.8-3.4L22 4l-2 6h-6l2.2-2.2A6 6 0 1 1 6 10H4a8 8 0 0 0 8-8z" fill="currentColor"/></svg>
                                    @else
                                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M9 21h6v-2H9v2zm3-19a7 7 0 0 0-4 12.7V17a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-2.3A7 7 0 0 0 12 2zm3 11.6-1 .7V16h-4v-1.7l-1-.7A5 5 0 1 1 15 13.6z" fill="currentColor"/></svg>
                                    @endif
                                </div>
                                <div class="univers-card__title">{{ $benefit['title'] }}</div>
                                <div class="univers-card__text">{{ $benefit['text'] }}</div>
                                <div class="univers-card__note">Une sensation simple, qui se remarque dès les premières utilisations.</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="univers-products-teaser" id="recommandations" aria-label="Produits en vedette">
            <div class="container">
                <div class="univers-products-teaser__head">
                    <div>
                        <div class="univers-section__kicker">Sélection</div>
                        <h2 class="univers-section__title">{{ $teaserTitle }}</h2>
                        <p class="univers-section__subtitle">{{ $teaserSubtitle }}</p>
                    </div>
                    <a class="univers-btn univers-btn--ghost" href="#produits">Voir toute la sélection</a>
                </div>

                <div class="univers-products-teaser__panel">
                    <div class="best-modern__grid">
                        @php
                            $teaserProducts = $products->getCollection()->take(4);
                        @endphp

                        @if($teaserProducts->count())
                            @foreach($teaserProducts as $product)
                                <a href="{{ route('product.show', $product->slug) }}" class="product-card">
                                @if($product->discount_percent)
                                    <div class="product-card__badge">-{{ (int) $product->discount_percent }}%</div>
                                @elseif($product->badge)
                                    <div class="product-card__badge">{{ $product->badge }}</div>
                                @endif

                                <div class="product-card__media">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" loading="lazy" />
                                </div>
                                <div class="product-card__body">
                                    <h3 class="product-card__name">{{ $product->name }}</h3>
                                    <div class="product-card__footer">
                                        <div class="product-card__prices">
                                            <span class="product-card__price">{{ $product->formatted_price }}</span>
                                            @if($product->formatted_old_price)
                                                <span class="product-card__old">{{ $product->formatted_old_price }}</span>
                                            @endif
                                        </div>
                                        <button class="product-card__btn" type="button">
                                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M7 4h-2l-1 2H1v2h2l3.6 7.6-1.35 2.45A1.99 1.99 0 0 0 6 22h12v-2H6l1.1-2H15a2 2 0 0 0 1.8-1.1L20.4 9H6.2L5.3 7H21V5H6.3L5.6 4z" fill="currentColor"/></svg>
                                        </button>
                                    </div>
                                </div>
                                </a>
                            @endforeach
                        @else
                            @foreach(collect($fakeProducts)->take(4) as $fp)
                                <article class="product-card">
                                @if($fp['badge'])
                                    <div class="product-card__badge">{{ $fp['badge'] }}</div>
                                @endif
                                <div class="product-card__media">
                                    <img src="{{ $fp['img'] }}" alt="{{ $fp['name'] }}" loading="lazy" />
                                </div>
                                <div class="product-card__body">
                                    <h3 class="product-card__name">{{ $fp['name'] }}</h3>
                                    <div class="product-card__footer">
                                        <div class="product-card__prices">
                                            <span class="product-card__price">{{ $fp['price'] }}</span>
                                            @if($fp['old'])
                                                <span class="product-card__old">{{ $fp['old'] }}</span>
                                            @endif
                                        </div>
                                        <button class="product-card__btn" type="button">
                                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M7 4h-2l-1 2H1v2h2l3.6 7.6-1.35 2.45A1.99 1.99 0 0 0 6 22h12v-2H6l1.1-2H15a2 2 0 0 0 1.8-1.1L20.4 9H6.2L5.3 7H21V5H6.3L5.6 4z" fill="currentColor"/></svg>
                                        </button>
                                    </div>
                                </div>
                                </article>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="univers-guide" id="guide" aria-label="Guide d'achat">
            <div class="container">
                <div class="univers-section__head">
                    <div class="univers-section__kicker">Conseil</div>
                    <h2 class="univers-section__title">{{ $guideTitle }}</h2>
                    <p class="univers-section__subtitle">{{ $guideSubtitle }}</p>
                </div>

                <div class="univers-guide__panel">
                    <div class="univers-steps">
                        @foreach($guideSteps as $i => $step)
                            <div class="univers-step">
                                <div class="univers-step__n">{{ $i + 1 }}</div>
                                <div class="univers-step__body">
                                    <div class="univers-step__title">{{ $step['title'] }}</div>
                                    <div class="univers-step__text">{{ $step['text'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="univers-cta">
                        <div class="univers-cta__text">
                            <div class="univers-cta__title">{{ $page['cta_title'] }}</div>
                            <div class="univers-cta__subtitle">{{ $page['cta_text'] }}</div>
                        </div>
                        <a class="univers-btn univers-btn--primary" href="#produits">
                            {{ $page['cta_button'] }}
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="univers-compare" id="comparatif" aria-label="Comparatif">
            <div class="container">
                <div class="univers-section__head">
                    <div class="univers-section__kicker">Comparatif</div>
                    <h2 class="univers-section__title">{{ $compareTitle }}</h2>
                    <p class="univers-section__subtitle">{{ $compareSubtitle }}</p>
                </div>

                <div class="univers-compare__panel">
                    <div class="univers-compare__grid">
                        @foreach($compareCards as $card)
                            @php
                                $isHighlight = (bool) ($card['highlight'] ?? false);
                            @endphp
                            <div class="univers-compare__card @if($isHighlight) univers-compare__card--highlight @endif">
                                @if($isHighlight)
                                    <div class="univers-compare__tag">Recommandé</div>
                                @endif
                                <div class="univers-compare__title">{{ $card['title'] }}</div>
                                <div class="univers-compare__text">{{ $card['text'] }}</div>
                                <div class="univers-compare__list">
                                    @foreach($card['list'] as $li)
                                        <div class="univers-compare__li">{{ $li }}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="univers-testimonials" id="avis" aria-label="Témoignages">
            <div class="container">
                <div class="univers-section__head">
                    <h2 class="univers-section__title">{{ $testimonialsTitle }}</h2>
                    <p class="univers-section__subtitle">{{ $testimonialsSubtitle }}</p>
                </div>

                <div class="univers-testimonials__grid">
                    @foreach($testimonials as $t)
                        <div class="univers-quote">
                            <div class="univers-quote__text">{{ $t['text'] }}</div>
                            <div class="univers-quote__meta">{{ $t['meta'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="univers-products" id="produits" aria-label="Produits">
            <div class="container">
                <div class="univers-section__head">
                    <h2 class="univers-section__title">La sélection {{ $pageTitle }}</h2>
                    <p class="univers-section__subtitle">Choisis le modèle qui te correspond — et passe à l’action en toute confiance.</p>
                </div>

                <div class="univers-products__toolbar">
                    <div class="univers-products__count">
                        @if(method_exists($products, 'total'))
                            {{ number_format((int) $products->total(), 0, ',', '.') }} produit(s)
                        @else
                            {{ number_format((int) $products->count(), 0, ',', '.') }} produit(s)
                        @endif
                    </div>
                    <a class="univers-products__jump" href="#faq">Voir la FAQ</a>
                </div>

                <div class="univers-products__grid">
                @if($products->count())
                    @foreach($products as $product)
                        <a href="{{ route('product.show', $product->slug) }}" class="product-card">
                            @if($product->discount_percent)
                                <div class="product-card__badge">-{{ (int) $product->discount_percent }}%</div>
                            @elseif($product->badge)
                                <div class="product-card__badge">{{ $product->badge }}</div>
                            @endif

                            <div class="product-card__media">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" loading="lazy" />
                            </div>
                            <div class="product-card__body">
                                <h3 class="product-card__name">{{ $product->name }}</h3>
                                <div class="product-card__footer">
                                    <div class="product-card__prices">
                                        <span class="product-card__price">{{ $product->formatted_price }}</span>
                                        @if($product->formatted_old_price)
                                            <span class="product-card__old">{{ $product->formatted_old_price }}</span>
                                        @endif
                                    </div>
                                    <button class="product-card__btn" type="button">
                                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M7 4h-2l-1 2H1v2h2l3.6 7.6-1.35 2.45A1.99 1.99 0 0 0 6 22h12v-2H6l1.1-2H15a2 2 0 0 0 1.8-1.1L20.4 9H6.2L5.3 7H21V5H6.3L5.6 4z" fill="currentColor"/></svg>
                                    </button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    @foreach($fakeProducts as $fp)
                        <article class="product-card">
                            @if($fp['badge'])
                                <div class="product-card__badge">{{ $fp['badge'] }}</div>
                            @endif
                            <div class="product-card__media">
                                <img src="{{ $fp['img'] }}" alt="{{ $fp['name'] }}" loading="lazy" />
                            </div>
                            <div class="product-card__body">
                                <h3 class="product-card__name">{{ $fp['name'] }}</h3>
                                <div class="product-card__footer">
                                    <div class="product-card__prices">
                                        <span class="product-card__price">{{ $fp['price'] }}</span>
                                        @if($fp['old'])
                                            <span class="product-card__old">{{ $fp['old'] }}</span>
                                        @endif
                                    </div>
                                    <button class="product-card__btn" type="button">
                                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M7 4h-2l-1 2H1v2h2l3.6 7.6-1.35 2.45A1.99 1.99 0 0 0 6 22h12v-2H6l1.1-2H15a2 2 0 0 0 1.8-1.1L20.4 9H6.2L5.3 7H21V5H6.3L5.6 4z" fill="currentColor"/></svg>
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @endif
            </div>

            @if($products->count())
                <div class="univers-pagination">
                    {{ $products->links() }}
                </div>
            @endif
            </div>
        </section>

        <section class="univers-faq" id="faq" aria-label="FAQ">
            <div class="container">
                <div class="univers-section__head univers-section__head--dark">
                    <h2 class="univers-section__title">Questions fréquentes</h2>
                    <p class="univers-section__subtitle">Des réponses claires pour acheter sereinement.</p>
                </div>

                <div class="accordion" id="universFaq" style="--bs-accordion-bg: rgba(255,255,255,.06); --bs-accordion-color: #fff; --bs-accordion-border-color: rgba(255,255,255,.12);">
                @foreach($page['faq'] as $i => $item)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q{{ $i }}">
                            <button class="accordion-button @if($i !== 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#a{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}" aria-controls="a{{ $i }}">
                                {{ $item['q'] }}
                            </button>
                        </h2>
                        <div id="a{{ $i }}" class="accordion-collapse collapse @if($i === 0) show @endif" aria-labelledby="q{{ $i }}" data-bs-parent="#universFaq">
                            <div class="accordion-body" style="opacity:.9;">
                                {{ $item['a'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

                <div class="univers-faq__cta">
                    <a class="univers-btn univers-btn--primary" href="#produits">
                        Revenir à la sélection
                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                    </a>
                </div>
            </div>
        </section>
    </div>
    @endif

@push('styles')
<style>
    .univers-products{padding:70px 0;background:radial-gradient(circle at 20% 0%,rgba(236,72,153,.10),transparent 55%),radial-gradient(circle at 80% 20%,rgba(59,130,246,.10),transparent 45%)}
    .univers-products__toolbar{display:flex;align-items:center;justify-content:space-between;gap:16px;margin:18px 0 26px;padding:12px 14px;border:1px solid rgba(15,23,42,.08);background:rgba(255,255,255,.75);backdrop-filter:blur(10px);border-radius:14px}
    .univers-products__count{font-weight:700;color:#0f172a;font-size:13px;letter-spacing:.2px}
    .univers-products__jump{font-size:13px;font-weight:600;color:#be185d;text-decoration:none;padding:8px 10px;border-radius:10px;background:rgba(236,72,153,.10)}
    .univers-products__jump:hover{background:rgba(236,72,153,.16);color:#9d174d}
    .univers-products__grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:18px}
    @media (max-width:1200px){.univers-products__grid{grid-template-columns:repeat(3,minmax(0,1fr))}}
    @media (max-width:900px){.univers-products__grid{grid-template-columns:repeat(2,minmax(0,1fr));gap:14px}.univers-products__toolbar{flex-direction:column;align-items:flex-start}}
    @media (max-width:520px){.univers-products__grid{grid-template-columns:1fr}}

    .univers-products .product-card{background:#fff;border-radius:18px;box-shadow:0 12px 30px rgba(15,23,42,.08);border:1px solid rgba(15,23,42,.06);overflow:hidden;transition:transform .18s ease,box-shadow .18s ease,border-color .18s ease;text-decoration:none;color:inherit}
    .univers-products .product-card:hover{transform:translateY(-3px);box-shadow:0 18px 44px rgba(15,23,42,.12);border-color:rgba(236,72,153,.25)}
    .univers-products .product-card__media{aspect-ratio:1/1;background:#f8fafc}
    .univers-products .product-card__media img{width:100%;height:100%;object-fit:cover}
    .univers-products .product-card__body{padding:14px 14px 16px}
    .univers-products .product-card__name{font-size:14px;line-height:1.25;font-weight:800;color:#0f172a;margin:0 0 10px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;min-height:36px}
    .univers-products .product-card__footer{display:flex;align-items:center;justify-content:space-between;gap:12px}
    .univers-products .product-card__prices{display:flex;align-items:baseline;gap:8px}
    .univers-products .product-card__price{color:#ec4899;font-weight:900;font-size:16px}
    .univers-products .product-card__old{color:#94a3b8;font-weight:700;font-size:12px;text-decoration:line-through}
    .univers-products .product-card__btn{width:40px;height:40px;border-radius:999px;display:grid;place-items:center;background:linear-gradient(135deg,#ec4899,#be185d);border:0;box-shadow:0 10px 18px rgba(236,72,153,.22)}
    .univers-products .product-card__btn svg{color:#fff}
    .univers-products .product-card__badge{position:absolute;top:12px;left:12px;z-index:2;background:rgba(15,23,42,.88);color:#fff;font-weight:800;font-size:12px;padding:6px 10px;border-radius:999px}
    .univers-products .product-card{position:relative}

    .univers-pagination{margin-top:28px}
    .univers-pagination .pagination{gap:8px;justify-content:center}
    .univers-pagination .page-link{border-radius:12px;border:1px solid rgba(15,23,42,.10);background:rgba(255,255,255,.70);color:#0f172a;font-weight:700;min-width:44px;text-align:center;padding:10px 12px}
    .univers-pagination .page-link:hover{background:rgba(236,72,153,.10);border-color:rgba(236,72,153,.25);color:#9d174d}
    .univers-pagination .page-item.active .page-link{background:linear-gradient(135deg,#ec4899,#be185d);border-color:transparent;color:#fff}
</style>
@endpush

@push('scripts')
@endpush
@endsection
