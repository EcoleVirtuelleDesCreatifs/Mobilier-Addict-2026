@extends('layouts.front')

@section('title', $pageTitle . ' - Mobilier Addict')
@section('meta_description', 'Découvrez nos produits pour ' . $pageTitle . ' sur Mobilier Addict.')

@section('content')
    @php
        $menuSlug = strtolower(trim((string) ($menu->slug ?? '')));
        $isMatelasMenu = in_array($menuSlug, [
            'matelas',
            'lit-canape',
            'electromenager',
            'oreillers-et-taies',
            'drap-et-couettes',
        ]);
        $isProtegeMatelas = $menuSlug === 'protege-matelas';

        $designSlug = match ($menuSlug) {
            'matelas' => 'matelas',
            'oreillers-et-taies' => 'oreillers',
            'meuble-et-fauteuil' => 'lits-sommiers',
            'drap-et-couettes' => 'draps-couettes',
            'electromenager' => 'electromenager',
            'lit-canape' => 'lit-canape',
            default => $menuSlug,
        };

        $pageConfig = match ($designSlug) {
            'matelas' => [
                'badge' => '✨ Retrouvez le sommeil que vous méritez',
                'title' => 'Matelas',
                'headline' => 'Dormez profond. Réveillez-vous léger.',
                'subtitle' =>
                    "Un bon matelas ne se contente pas d'être confortable : il change vos journées. Découvrez des matelas pensés pour soulager, soutenir et apaiser.",
                'hero_bg' => 'https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=900&h=1100&fit=crop',
                'benefits' => [
                    [
                        'title' => 'Soutien qui libère',
                        'text' => "Votre corps s'aligne naturellement. Moins de tensions, plus d'énergie le matin.",
                    ],
                    [
                        'title' => 'Douceur qui apaise',
                        'text' => "Un accueil moelleux, une sensation \"hôtel\" à la maison, nuit après nuit.",
                    ],
                    [
                        'title' => 'Qualité durable',
                        'text' => 'Des matériaux pensés pour durer : confort stable, finitions premium, garantie.',
                    ],
                ],
                'cta_title' => "Besoin d'un conseil rapide ?",
                'cta_text' => 'Dis-nous ta position de sommeil, on te guide vers le bon confort.',
                'cta_button' => 'Je choisis mon confort',
                'faq' => [
                    [
                        'q' => 'Quel confort choisir (ferme, mi-ferme, moelleux) ?',
                        'a' =>
                            'Si tu dors sur le dos ou le ventre, privilégie un soutien plus ferme. Sur le côté, un accueil plus moelleux aide à relâcher les épaules et les hanches.',
                    ],
                    [
                        'q' => 'En combien de temps je ressens la différence ?',
                        'a' =>
                            "Souvent dès les premières nuits : sommeil plus stable, réveil plus facile. Le corps s'adapte ensuite progressivement pour un confort optimal.",
                    ],
                    [
                        'q' => "Et si j'hésite encore ?",
                        'a' =>
                            'Écris-nous : on te recommande le meilleur compromis selon ta morphologie, ta position de sommeil et tes préférences.',
                    ],
                ],
                'hero_card_badge_top' => 'Confort',
                'hero_card_badge_bottom' => 'qui rassure',
                'carousel_title' => 'Nos Best-Sellers Matelas',
                'carousel_desc' => 'Les matelas préférés de nos clients — découvrez pourquoi.',
                'inspire_title' => 'Trouvez Votre Confort Idéal',
                'inspire_desc' => 'Chaque corps est unique. Découvrez nos matelas adaptés à votre morphologie.',
                'mission_title' => 'Un Sommeil Réparateur, Chaque Nuit',
                'mission_desc' =>
                    'Chez Mobilier Addict, nous croyons qu\'un bon matelas transforme vos nuits et vos journées. Nous sélectionnons des matelas qui soulagent, soutiennent et apaisent pour un réveil plein d\'énergie.',
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
                    [
                        'title' => 'Soutien Ergonomique Certifié',
                        'text' => 'Nos matelas épousent votre corps pour un alignement parfait de la colonne.',
                    ],
                    [
                        'title' => 'Essai 100 Nuits Sans Risque',
                        'text' => 'Testez votre matelas chez vous. Pas convaincu ? Retour et remboursement gratuits.',
                    ],
                    [
                        'title' => 'Livraison Express & Installation',
                        'text' => 'Livré chez vous en 48h. Nos experts installent et reprennent l\'ancien matelas.',
                    ],
                    [
                        'title' => 'Matériaux Sains & Certifiés',
                        'text' => 'Mousses certifiées, tissus hypoallergéniques, fabrication responsable.',
                    ],
                ],
            ],
            'oreillers' => [
                'badge' => '💤 Votre nuque vous dira merci',
                'title' => 'Oreillers & Taies',
                'headline' => 'Le petit détail qui change tout.',
                'subtitle' =>
                    "Maintien, douceur, fraîcheur : trouvez l'oreiller qui épouse votre posture et libère vos tensions.",
                'hero_bg' => 'https://images.unsplash.com/photo-1582582429416-03ad554aab0d?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1582582429416-03ad554aab0d?w=900&h=1100&fit=crop',
                'benefits' => [
                    [
                        'title' => 'Maintien précis',
                        'text' => "L'oreiller soutient la nuque sans pousser la tête vers l'avant.",
                    ],
                    [
                        'title' => 'Fraîcheur douce',
                        'text' => 'Des matières respirantes pour moins de chaleur et plus de confort.',
                    ],
                    ['title' => 'Réveil plus léger', 'text' => 'Moins de raideurs, plus de mobilité dès le matin.'],
                ],
                'cta_title' => 'Oreiller idéal, en 30 secondes',
                'cta_text' => 'Dis-nous ta position (dos / côté / ventre) et ta préférence (souple / ferme).',
                'cta_button' => 'Je trouve le bon oreiller',
                'faq' => [
                    [
                        'q' => 'Quel oreiller pour dormir sur le côté ?',
                        'a' => 'Un oreiller plus haut aide à garder la nuque alignée avec la colonne.',
                    ],
                    [
                        'q' => 'Mémoire de forme ou fibres ?',
                        'a' => 'La mémoire de forme épouse la nuque. Les fibres sont plus aérées et modulables.',
                    ],
                    [
                        'q' => 'Comment entretenir mon oreiller ?',
                        'a' =>
                            'Aère-le régulièrement et privilégie une housse protectrice. Suis les consignes de lavage.',
                    ],
                ],
                'hero_card_badge_top' => 'Maintien',
                'hero_card_badge_bottom' => 'sans tension',
                'carousel_title' => 'Nos Best-Sellers Oreillers',
                'carousel_desc' => 'Les oreillers préférés de nos clients — pour des nuits sans tension.',
                'inspire_title' => 'Libérez Votre Nuque',
                'inspire_desc' =>
                    'Un bon oreiller change tout. Trouvez celui qui correspond à votre position de sommeil.',
                'mission_title' => 'Votre Nuque Mérite le Meilleur',
                'mission_desc' =>
                    'Un oreiller adapté à votre morphologie et votre position de sommeil transforme vos nuits. Fini les réveils avec des douleurs cervicales.',
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
                    [
                        'title' => 'Maintien Cervical Optimal',
                        'text' => 'Oreillers ergonomiques qui alignent naturellement votre nuque.',
                    ],
                    [
                        'title' => 'Essai 30 Nuits Satisfait',
                        'text' => 'Testez votre oreiller. Pas adapté ? Échange ou remboursement.',
                    ],
                    ['title' => 'Livraison Rapide & Soignée', 'text' => 'Livré sous 48h dans un emballage protecteur.'],
                    [
                        'title' => 'Matières Hypoallergéniques',
                        'text' => 'Tissus respirants et anti-acariens pour un sommeil sain.',
                    ],
                ],
            ],
            'lit-canape' => [
                'badge' => '🛋️ Confort 2 en 1',
                'title' => 'Lits Canapés',
                'headline' => 'Le jour canapé, la nuit lit.',
                'subtitle' =>
                    "Gagnez de l'espace sans sacrifier le confort. Nos lits canapés allient praticité et qualité de sommeil.",
                'hero_bg' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=900&h=1100&fit=crop',
                'benefits' => [
                    [
                        'title' => 'Gain de place',
                        'text' => "Transformez votre salon en chambre d'amis en quelques secondes.",
                    ],
                    [
                        'title' => 'Confort optimal',
                        'text' => 'Un matelas de qualité pour des nuits reposantes, même en canapé.',
                    ],
                    [
                        'title' => 'Design moderne',
                        'text' => "Des styles variés pour s'intégrer parfaitement à votre intérieur.",
                    ],
                ],
                'cta_title' => 'Trouvez votre lit canapé idéal',
                'cta_text' => 'Choisissez la taille, le style et le confort qui vous conviennent.',
                'cta_button' => 'Je choisis mon lit canapé',
                'faq' => [
                    [
                        'q' => 'Quel type de mécanisme choisir ?',
                        'a' =>
                            'Le clic-clac est simple et rapide. Le convertisseur offre plus de confort avec un vrai matelas.',
                    ],
                    [
                        'q' => 'Est-ce confortable pour dormir ?',
                        'a' => 'Oui, nos modèles sont équipés de vrais matelas pour un sommeil de qualité.',
                    ],
                    [
                        'q' => 'Quelle taille pour mon espace ?',
                        'a' => 'Mesurez votre espace. Les modèles 140-160cm sont idéaux pour 2 personnes.',
                    ],
                ],
                'hero_card_badge_top' => 'Confort',
                'hero_card_badge_bottom' => 'versatile',
                'carousel_title' => 'Nos Best-Sellers Lits Canapés',
                'carousel_desc' => 'Les lits canapés préférés de nos clients — praticité garantie.',
                'inspire_title' => 'Optimisez Votre Espace',
                'inspire_desc' => 'Un salon le jour, une chambre la nuit. Découvrez nos solutions gain de place.',
                'mission_title' => 'Confort et Praticité Réunis',
                'mission_desc' =>
                    'Nos lits canapés sont conçus pour vous offrir un confort optimal tout en maximisant votre espace de vie.',
                'reco_title' => 'Nos Lits Canapés Recommandés',
                'reco_desc' => 'Sélectionnés pour leur confort et leur facilité d\'utilisation.',
                'reco_bg' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1920&h=600&fit=crop',
                'why_title' => 'Rejoignez <span>+1 500</span> clients satisfaits',
                'why_subtitle' => 'Ils ont optimisé leur espace sans sacrifier le confort. À votre tour !',
                'why_stats' => [
                    ['number' => '96%', 'label' => 'Clients satisfaits'],
                    ['number' => '5 ans', 'label' => 'Garantie mécanisme'],
                    ['number' => '48h', 'label' => 'Livraison express'],
                ],
                'why_benefits' => [
                    ['title' => 'Mécanismes Testés', 'text' => 'Mécanismes robustes testés pour 10 000 ouvertures.'],
                    [
                        'title' => 'Matelas de Qualité',
                        'text' => 'Vrais matelas pour un confort optimal nuit après nuit.',
                    ],
                    [
                        'title' => 'Design Varié',
                        'text' => 'Styles modernes, scandinaves, classiques pour tous les goûts.',
                    ],
                    [
                        'title' => 'Garantie Satisfait',
                        'text' => '30 jours pour tester. Retour gratuit si non satisfait.',
                    ],
                ],
            ],
            'electromenager' => [
                'badge' => '⚡ Innovation & performance',
                'title' => 'Électroménager',
                'headline' => 'Simplifiez votre quotidien.',
                'subtitle' =>
                    'Des appareils performants et durables pour faciliter votre vie au quotidien avec style et efficacité.',
                'hero_bg' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=900&h=1100&fit=crop',
                'benefits' => [
                    [
                        'title' => 'Performance optimale',
                        'text' => 'Des appareils puissants pour des résultats professionnels à la maison.',
                    ],
                    [
                        'title' => 'Économie d\'énergie',
                        'text' => 'Technologies éco-responsables pour réduire votre consommation.',
                    ],
                    ['title' => 'Design moderne', 'text' => 'Esthétique soignée pour sublimer votre intérieur.'],
                ],
                'cta_title' => 'Équipez-vous intelligemment',
                'cta_text' => "Découvrez notre sélection d'appareils pour une maison moderne et fonctionnelle.",
                'cta_button' => 'Je découvre l\'électroménager',
                'faq' => [
                    [
                        'q' => 'Quelle classe énergétique choisir ?',
                        'a' => 'Privilégiez les classes A++ ou A+++ pour une consommation minimale.',
                    ],
                    [
                        'q' => 'Les appareils sont-ils garantis ?',
                        'a' => "Oui, tous nos appareils bénéficient d\'une garantie fabricant de 2 ans minimum.",
                    ],
                    [
                        'q' => 'Livraison et installation ?',
                        'a' => 'Livraison gratuite et installation incluse pour les gros électroménagers.',
                    ],
                ],
                'hero_card_badge_top' => 'Performance',
                'hero_card_badge_bottom' => 'éco-responsable',
                'carousel_title' => 'Nos Best-Sellers Électroménager',
                'carousel_desc' => 'Les appareils préférés de nos clients — performance garantie.',
                'inspire_title' => 'Modernisez Votre Maison',
                'inspire_desc' => 'Des appareils innovants pour une vie plus simple et confortable.',
                'mission_title' => 'Innovation au Quotidien',
                'mission_desc' =>
                    "Notre sélection d'électroménager allie performance, économie d'énergie et design moderne pour faciliter votre quotidien.",
                'reco_title' => 'Notre Électroménager Recommandé',
                'reco_desc' => 'Sélectionné pour sa performance et sa durabilité.',
                'reco_bg' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=1920&h=600&fit=crop',
                'why_title' => 'Rejoignez <span>+1 200</span> clients satisfaits',
                'why_subtitle' => 'Ils nous font confiance pour équiper leur maison. À votre tour !',
                'why_stats' => [
                    ['number' => '95%', 'label' => 'Clients satisfaits'],
                    ['number' => '2 ans', 'label' => 'Garantie fabricant'],
                    ['number' => '48h', 'label' => 'Livraison express'],
                ],
                'why_benefits' => [
                    ['title' => 'Haute Performance', 'text' => 'Appareils puissants pour des résultats optimaux.'],
                    ['title' => 'Éco-Responsable', 'text' => 'Technologies économes en énergie A+++'],
                    ['title' => 'Installation Incluse', 'text' => 'Livraison et mise en service par nos experts.'],
                    ['title' => 'Service Après-Vente', 'text' => 'Support technique disponible 7j/7.'],
                ],
            ],
            'lits-sommiers' => [
                'title' => 'Meubles & Fauteuils',
                'headline' => 'Une chambre qui inspire.',
                'subtitle' => "Un lit beau, solide et silencieux : le point de départ d'un intérieur apaisant.",
                'hero_bg' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=900&h=1100&fit=crop',
                'benefits' => [
                    [
                        'title' => 'Silence absolu',
                        'text' => 'Fini les grincements. Un sommeil continu, sans micro-réveils.',
                    ],
                    [
                        'title' => 'Stabilité qui rassure',
                        'text' => 'Une structure solide, un soutien fiable, nuit après nuit.',
                    ],
                    [
                        'title' => 'Style qui apaise',
                        'text' => 'Une chambre élégante qui donne envie de rentrer et souffler.',
                    ],
                ],
                'cta_title' => 'Le lit parfait existe',
                'cta_text' => "Choisis ton style et ta taille : on t'aide à trouver la base idéale pour ton matelas.",
                'cta_button' => 'Je choisis mon lit',
                'faq' => [
                    [
                        'q' => 'Sommiers : lattes ou tapissier ?',
                        'a' =>
                            "Les lattes offrent plus d'aération et de soutien. Le tapissier ajoute un rendu plus décoratif.",
                    ],
                    [
                        'q' => 'Comment éviter un lit qui grince ?',
                        'a' =>
                            'Une structure stable, des fixations de qualité et un bon serrage font toute la différence.',
                    ],
                    [
                        'q' => 'Quelle hauteur de lit choisir ?',
                        'a' =>
                            'Une hauteur confortable facilite le lever et donne une sensation plus premium à la chambre.',
                    ],
                ],
                'hero_card_badge_top' => 'Silence',
                'hero_card_badge_bottom' => 'et style',
                'carousel_title' => 'Nos Best-Sellers Meubles',
                'carousel_desc' => 'Les meubles préférés de nos clients — découvrez pourquoi.',
                'inspire_title' => 'Créez Votre Refuge de Bien-Être',
                'inspire_desc' =>
                    'Chaque nuit mérite d\'être exceptionnelle. Découvrez nos univers pensés pour éveiller vos sens.',
                'mission_title' => 'Transformer Votre Chambre en Sanctuaire',
                'mission_desc' =>
                    'Chez Mobilier Addict, nous croyons qu\'un lit de qualité est le fondement d\'un sommeil réparateur. Nous sélectionnons des structures élégantes, stables et silencieuses qui subliment votre espace.',
                'reco_title' => 'Nos Meubles Recommandés',
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
                    [
                        'title' => 'Qualité Premium Garantie',
                        'text' => 'Sélection rigoureuse des meilleurs fabricants européens.',
                    ],
                    [
                        'title' => 'Conseil Personnalisé Gratuit',
                        'text' => 'Un expert dédié vous guide pour choisir le lit parfait.',
                    ],
                    [
                        'title' => 'Garantie Satisfait ou Remboursé',
                        'text' => '30 jours pour tester. Retour gratuit, remboursement intégral.',
                    ],
                    [
                        'title' => 'Livraison & Montage Inclus',
                        'text' => 'Livré chez vous en 48h avec montage par nos experts.',
                    ],
                ],
            ],
            'draps-couettes' => [
                'badge' => '🧺 Douceur qui rassure',
                'title' => 'Draps & Couettes',
                'headline' => 'Votre cocon, chaque nuit.',
                'subtitle' =>
                    "Des matières respirantes, des finitions premium et une sensation de propre qui donne envie d'aller se coucher.",
                'hero_bg' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=900&h=1100&fit=crop',
                'benefits' => [
                    [
                        'title' => 'Douceur immédiate',
                        'text' => "Une sensation enveloppante, comme à l'hôtel, dès la première nuit.",
                    ],
                    [
                        'title' => 'Respirant',
                        'text' => "Des tissus qui laissent circuler l'air pour un sommeil plus frais.",
                    ],
                    [
                        'title' => 'Élégance simple',
                        'text' => 'Des couleurs et finitions qui transforment la chambre en cocon.',
                    ],
                ],
                'cta_title' => 'Votre lit mérite ce confort',
                'cta_text' => "Choisis la matière et la taille : on t'aide à composer l'ensemble parfait.",
                'cta_button' => 'Je compose mon linge de lit',
                'faq' => [
                    [
                        'q' => 'Quelle taille choisir ?',
                        'a' => 'Vérifie les dimensions de ton matelas et privilégie une housse adaptée (bonnet).',
                    ],
                    [
                        'q' => 'Quelle matière est la plus confortable ?',
                        'a' => 'Le coton est polyvalent. Le percale est plus frais. Le satin est plus doux et soyeux.',
                    ],
                    [
                        'q' => 'Couette chaude ou légère ?',
                        'a' =>
                            'Tout dépend de la saison et de ta sensibilité à la chaleur. Une couette 4 saisons est idéale.',
                    ],
                ],
                'hero_card_badge_top' => 'Douceur',
                'hero_card_badge_bottom' => 'premium',
                'carousel_title' => 'Nos Best-Sellers Draps & Couettes',
                'carousel_desc' => 'Le linge de lit préféré de nos clients — douceur garantie.',
                'inspire_title' => 'Créez Votre Cocon de Douceur',
                'inspire_desc' => 'Des matières nobles et des finitions soignées pour transformer chaque nuit.',
                'mission_title' => 'Le Linge de Lit Qui Fait la Différence',
                'mission_desc' =>
                    'Des draps qui respirent, des couettes qui enveloppent, des matières qui durent. Transformez votre lit en véritable refuge.',
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
                    [
                        'title' => 'Matières Nobles Certifiées',
                        'text' => 'Coton bio, percale 80 fils, satin de qualité hôtelière.',
                    ],
                    [
                        'title' => 'Confort Toutes Saisons',
                        'text' => 'Couettes légères en été, chaudes en hiver, ou 4 saisons.',
                    ],
                    [
                        'title' => 'Livraison Soignée',
                        'text' => 'Emballage premium, livraison rapide et suivi en temps réel.',
                    ],
                    ['title' => 'Entretien Facile', 'text' => 'Lavable en machine, séchage rapide, repassage minimal.'],
                ],
            ],
            default => [
                'badge' => '✨ Qualité premium',
                'title' => $menu->name ?? 'Nos Produits',
                'headline' => 'Découvrez notre sélection.',
                'subtitle' => 'Des produits de qualité supérieure pour votre confort quotidien.',
                'hero_bg' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=900&h=1100&fit=crop',
                'benefits' => [
                    ['title' => 'Qualité', 'text' => 'Produits sélectionnés pour leur qualité exceptionnelle.'],
                    ['title' => 'Confort', 'text' => 'Confort optimal pour votre quotidien.'],
                    ['title' => 'Garantie', 'text' => 'Satisfaction garantie ou remboursement.'],
                ],
                'cta_title' => 'Besoin de conseils ?',
                'cta_text' => 'Notre équipe est là pour vous guider dans votre choix.',
                'cta_button' => 'Contactez-nous',
                'faq' => [
                    ['q' => 'Comment choisir ?', 'a' => 'Notre équipe vous conseille selon vos besoins.'],
                    ['q' => 'Livraison ?', 'a' => 'Livraison rapide partout en Côte d\'Ivoire.'],
                    ['q' => 'Garantie ?', 'a' => 'Tous nos produits sont garantis.'],
                ],
                'hero_card_badge_top' => 'Qualité',
                'hero_card_badge_bottom' => 'garantie',
                'carousel_title' => 'Nos Best-Sellers',
                'carousel_desc' => 'Les produits préférés de nos clients.',
                'inspire_title' => 'Découvrez Notre Collection',
                'inspire_desc' => 'Des produits pensés pour votre confort.',
                'mission_title' => 'Votre Confort, Notre Priorité',
                'mission_desc' => 'Nous sélectionnons des produits de qualité pour améliorer votre quotidien.',
                'reco_title' => 'Nos Produits Recommandés',
                'reco_desc' => 'Sélectionnés pour leur qualité et leur confort.',
                'reco_bg' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=1920&h=600&fit=crop',
                'why_title' => 'Rejoignez <span>+1 000</span> clients satisfaits',
                'why_subtitle' => 'Ils nous font confiance. À votre tour !',
                'why_stats' => [
                    ['number' => '98%', 'label' => 'Clients satisfaits'],
                    ['number' => '2 ans', 'label' => 'Garantie'],
                    ['number' => '48h', 'label' => 'Livraison'],
                ],
                'why_benefits' => [
                    ['title' => 'Qualité Premium', 'text' => 'Produits sélectionnés avec soin.'],
                    ['title' => 'Service Client', 'text' => 'Support réactif et disponible.'],
                    ['title' => 'Livraison Rapide', 'text' => 'Livraison express en 48h.'],
                    ['title' => 'Paiement Sécurisé', 'text' => 'Paiements sécurisés multiples options.'],
                ],
            ],
        };

        // Override images based on menuSlug
        $menuImages = match ($menuSlug) {
            'lit-canape' => [
                'hero_bg' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=900&h=1100&fit=crop',
            ],
            'electromenager' => [
                'hero_bg' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=900&h=1100&fit=crop',
            ],
            'oreillers-et-taies' => [
                'hero_bg' => 'https://images.unsplash.com/photo-1582582429416-03ad554aab0d?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=900&h=1100&fit=crop',
            ],
            'drap-et-couettes' => [
                'hero_bg' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=1920&h=900&fit=crop',
                'hero_card' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=900&h=1100&fit=crop',
            ],
            default => [],
        };

        if (!empty($menuImages)) {
            $pageConfig = array_merge($pageConfig, $menuImages);
        }
    @endphp

    @if ($isMatelasMenu)
        <style>
            .matelas-page {
                --ma-rose: #ec4899;
                --ma-navy: #0f172a;
                --ma-ink: #071126;
                --ma-sky: #6ee7ff;
                --ma-border: #e2e8f0;
                --ma-muted: #64748b;
                background: linear-gradient(180deg, #fff, #f8fafc);
                scroll-behavior: smooth;
            }

            .matelas-hero {
                padding: 160px 0 120px;
                min-height: 600px;
                display: flex;
                align-items: center;
                background: linear-gradient(180deg, var(--ma-navy) 0%, #1e3a8a 100%);
                color: #fff;
                position: relative;
                overflow: hidden;
                animation: heroFadeIn 1.2s cubic-bezier(0.4, 0, 0.2, 1);
            }

            @keyframes heroFadeIn {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .matelas-hero::before {
                content: "";
                position: absolute;
                inset: -2px;
                background: radial-gradient(900px 420px at 30% 20%, rgba(236, 72, 153, .25), rgba(236, 72, 153, 0) 60%), radial-gradient(900px 520px at 80% 10%, rgba(110, 231, 255, .20), rgba(110, 231, 255, 0) 62%);
                pointer-events: none;
                animation: gradientShift 8s ease-in-out infinite;
            }

            @keyframes gradientShift {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.8;
                }
            }

            .matelas-hero::after {
                content: "";
                position: absolute;
                left: 0;
                right: 0;
                bottom: -1px;
                height: 2px;
                background: rgba(255, 255, 255, .10);
                pointer-events: none;
            }

            .matelas-clouds {
                position: absolute;
                inset: 0;
                pointer-events: none;
                opacity: .95;
            }

            .matelas-cloud {
                position: absolute;
                width: 220px;
                height: 86px;
                border-radius: 999px;
                background: rgba(255, 255, 255, .16);
                border: 1px solid rgba(255, 255, 255, .14);
                box-shadow: 0 30px 80px rgba(0, 0, 0, .20);
                backdrop-filter: blur(2px);
                filter: saturate(1.05);
                animation: maCloudFloat 12s ease-in-out infinite;
            }

            .matelas-cloud::before,
            .matelas-cloud::after {
                content: "";
                position: absolute;
                background: inherit;
                border: inherit;
                border-radius: 999px;
            }

            .matelas-cloud::before {
                width: 90px;
                height: 90px;
                left: 18px;
                top: -36px;
                box-shadow: inherit;
            }

            .matelas-cloud::after {
                width: 120px;
                height: 120px;
                left: 92px;
                top: -56px;
                box-shadow: inherit;
            }

            .matelas-cloud--a {
                left: -70px;
                top: 88px;
                transform: rotate(-4deg);
                animation-duration: 14s;
            }

            .matelas-cloud--b {
                right: -90px;
                top: 56px;
                transform: rotate(6deg);
                width: 260px;
                height: 96px;
                animation-duration: 16s;
            }

            .matelas-cloud--c {
                left: 12%;
                bottom: 64px;
                transform: rotate(2deg);
                width: 240px;
                height: 92px;
                animation-duration: 18s;
                opacity: .85;
            }

            .matelas-cloud--d {
                right: 14%;
                bottom: 34px;
                transform: rotate(-3deg);
                width: 190px;
                height: 78px;
                animation-duration: 13s;
                opacity: .75;
            }

            @keyframes maCloudFloat {

                0%,
                100% {
                    transform: translate3d(0, 0, 0) rotate(var(--r, 0deg));
                }

                50% {
                    transform: translate3d(18px, -10px, 0) rotate(var(--r, 0deg));
                }
            }

            .matelas-hero__inner {
                text-align: center;
                max-width: 960px;
                margin: 0 auto;
                position: relative;
            }

            .matelas-hero__title {
                font-size: 46px;
                line-height: 1.06;
                margin: 0 0 10px;
                color: #fff;
                letter-spacing: -.04em;
                font-weight: 1000;
                text-shadow: 0 18px 40px rgba(0, 0, 0, .25);
            }

            .matelas-hero__subtitle {
                font-size: 13px;
                line-height: 1.5;
                color: rgba(241, 245, 249, .86);
                max-width: 62ch;
                margin: 0 auto;
                font-weight: 700;
            }

            .matelas-hero__cta {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
                justify-content: center;
                margin-top: 18px;
            }

            .matelas-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                border-radius: 999px;
                padding: 12px 16px;
                font-weight: 900;
                text-decoration: none;
            }

            .matelas-btn--primary {
                background: linear-gradient(135deg, var(--ma-rose), #ff2e72);
                color: #fff;
                box-shadow: 0 22px 48px rgba(255, 58, 127, .28);
            }

            .matelas-btn--ghost {
                background: rgba(255, 255, 255, .75);
                backdrop-filter: blur(10px);
                color: var(--ma-navy);
                border: 1px solid var(--ma-border);
            }

            .matelas-btn--navy {
                background: rgba(9, 16, 34, .70);
                color: #fff;
                border: 1px solid rgba(255, 255, 255, .18);
                box-shadow: 0 18px 40px rgba(0, 0, 0, .22);
            }

            .matelas-btn--navy:hover {
                filter: brightness(1.06);
            }

            a:focus-visible,
            button:focus-visible,
            [role="tab"]:focus-visible {
                outline: none;
                box-shadow: 0 0 0 3px rgba(255, 58, 127, .22), 0 0 0 6px rgba(11, 27, 58, .14);
                border-radius: 999px;
            }

            .matelas-btn,
            .matelas-tab,
            .product-card,
            .matelas-mini,
            .matelas-banner__media {
                transition: transform .4s cubic-bezier(0.4, 0, 0.2, 1), box-shadow .4s cubic-bezier(0.4, 0, 0.2, 1), filter .4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .product-card {
                position: relative;
                overflow: hidden;
            }

            .product-card:hover {
                transform: translateY(-12px) scale(1.02);
                box-shadow: 0 25px 50px -12px rgba(236, 72, 153, 0.3);
            }

            .product-card::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, rgba(236, 72, 153, 0.1) 0%, transparent 50%);
                opacity: 0;
                transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .product-card:hover::before {
                opacity: 1;
            }

            .matelas-btn:active,
            .matelas-tab:active,
            .matelas-mini__add:active,
            .product-card__btn:active {
                transform: translateY(1px);
            }

            [data-reveal] {
                opacity: 0;
                transform: translateY(10px);
                filter: blur(1.5px);
                transition: opacity .55s ease, transform .55s ease, filter .55s ease;
                will-change: opacity, transform, filter;
            }

            [data-reveal].is-revealed {
                opacity: 1;
                transform: none;
                filter: none;
            }

            .matelas-section {
                padding: 54px 0;
            }

            .matelas-section--alt {
                background: linear-gradient(180deg, var(--ma-navy), #050b18);
            }

            .matelas-section__grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 22px;
                align-items: center;
            }

            .matelas-section__eyebrow {
                font-weight: 950;
                color: var(--ma-muted);
                text-transform: uppercase;
                letter-spacing: .10em;
                font-size: 12px;
            }

            .matelas-section__name {
                font-weight: 1000;
                color: var(--ma-ink);
                font-size: 34px;
                line-height: 1.05;
                letter-spacing: -.02em;
                margin: 10px 0 10px;
            }

            .matelas-section--alt .matelas-section__name {
                color: #fff;
            }

            .matelas-section__desc {
                color: #475569;
                font-weight: 700;
                max-width: 60ch;
                margin: 0;
            }

            .matelas-section--alt .matelas-section__desc {
                color: rgba(241, 245, 249, .82);
            }

            .matelas-bullets {
                display: grid;
                gap: 10px;
                margin: 18px 0 0;
                padding: 0;
                list-style: none;
            }

            .matelas-bullets li {
                display: flex;
                gap: 10px;
                align-items: flex-start;
                font-weight: 800;
                color: #0b1220;
            }

            .matelas-section--alt .matelas-bullets li {
                color: #fff;
            }

            .matelas-bullets li span {
                color: #64748b;
                font-weight: 700;
                display: block;
                margin-top: 2px;
            }

            .matelas-section--alt .matelas-bullets li span {
                color: rgba(241, 245, 249, .72);
            }

            .matelas-media {
                border-radius: 28px;
                overflow: hidden;
                border: 1px solid #e2e8f0;
                background: linear-gradient(135deg, #f8fafc, #fff);
                box-shadow: 0 30px 70px rgba(2, 6, 23, .08);
            }

            .matelas-section--alt .matelas-media {
                border-color: rgba(148, 163, 184, .2);
                box-shadow: 0 30px 70px rgba(0, 0, 0, .35);
            }

            .matelas-media img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                aspect-ratio: 4 / 3;
            }

            .matelas-actions {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
                margin-top: 18px;
            }

            .matelas-link {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-weight: 950;
                text-decoration: none;
                color: var(--ma-rose);
            }

            .matelas-section--alt .matelas-link {
                color: var(--ma-sky);
            }

            .matelas-actions form {
                margin: 0;
            }

            .matelas-cartbtn {
                border: 0;
                cursor: pointer;
            }

            .matelas-block {
                padding: 22px 0;
            }

            .matelas-block__head {
                position: relative;
                text-align: center;
                margin-bottom: 18px;
                padding: 46px 16px 22px;
                border-radius: 28px;
                background: linear-gradient(180deg, rgba(11, 27, 58, .07), rgba(11, 27, 58, 0));
                overflow: hidden;
                border: 1px solid rgba(226, 232, 240, .85);
            }

            .matelas-block__head::before {
                content: "";
                position: absolute;
                inset: -2px;
                background: radial-gradient(760px 260px at 18% 30%, rgba(255, 58, 127, .18), rgba(255, 58, 127, 0) 60%), radial-gradient(760px 320px at 82% 20%, rgba(110, 231, 255, .14), rgba(110, 231, 255, 0) 62%);
                pointer-events: none;
            }

            .matelas-block__head::after {
                content: "PETIT PRIX";
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -55%);
                font-weight: 1000;
                letter-spacing: .18em;
                text-transform: uppercase;
                font-size: 72px;
                line-height: 1;
                color: rgba(11, 27, 58, .06);
                white-space: nowrap;
                pointer-events: none;
            }

            .matelas-block__head>* {
                position: relative;
            }

            .matelas-marquee {
                position: absolute;
                left: -8%;
                right: -8%;
                top: 14px;
                height: 32px;
                display: flex;
                align-items: center;
                overflow: hidden;
                opacity: .9;
                pointer-events: none;
                transform: none;
            }

            .matelas-marquee__track {
                display: flex;
                gap: 18px;
                align-items: center;
                white-space: nowrap;
                will-change: transform;
                animation: maMarquee 16s linear infinite;
                transform: translateY(0);
            }

            .matelas-marquee__item {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                font-weight: 1000;
                letter-spacing: .10em;
                text-transform: uppercase;
                font-size: 11px;
                line-height: 1;
                color: rgba(11, 27, 58, .62);
            }

            .matelas-marquee__dot {
                width: 6px;
                height: 6px;
                border-radius: 999px;
                background: linear-gradient(135deg, var(--ma-rose), rgba(110, 231, 255, .9));
                box-shadow: 0 10px 20px rgba(255, 58, 127, .18);
            }

            .matelas-block__pill {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 10px 16px;
                border-radius: 999px;
                background: linear-gradient(135deg, var(--ma-rose), #ff2e72);
                color: #fff;
                font-weight: 1000;
                text-transform: uppercase;
                letter-spacing: .08em;
                font-size: 10px;
                box-shadow: 0 18px 46px rgba(255, 58, 127, .25);
            }

            .matelas-block__title {
                margin: 18px 0 10px;
                font-weight: 1000;
                letter-spacing: -.06em;
                line-height: .98;
                font-size: 48px;
                color: var(--ma-ink);
            }

            .matelas-block__title span {
                background: linear-gradient(135deg, var(--ma-navy), #0b1b3a 35%, var(--ma-rose));
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }

            .matelas-block__outline {
                display: inline-block;
                -webkit-text-stroke: 1px rgba(11, 27, 58, .25);
                color: transparent;
            }

            .matelas-block__subtitle {
                margin: 0 auto;
                max-width: 70ch;
                color: #475569;
                font-weight: 800;
                font-size: 13px;
                line-height: 1.6;
            }

            .matelas-block__cta {
                display: flex;
                gap: 10px;
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 14px;
            }

            .matelas-block__stats {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 8px;
                margin-top: 14px;
            }

            .matelas-stat {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 9px 12px;
                border-radius: 999px;
                background: rgba(255, 255, 255, .80);
                border: 1px solid rgba(226, 232, 240, .95);
                font-weight: 950;
                color: rgba(11, 27, 58, .92);
                font-size: 12px;
                box-shadow: 0 14px 34px rgba(2, 6, 23, .06);
            }

            .matelas-stat strong {
                font-weight: 1000;
            }

            .matelas-stat i {
                width: 10px;
                height: 10px;
                border-radius: 999px;
                background: linear-gradient(135deg, var(--ma-rose), rgba(110, 231, 255, .9));
                display: inline-block;
            }

            .matelas-block__title::after {
                content: "";
                display: block;
                height: 4px;
                width: min(260px, 70%);
                margin: 14px auto 0;
                border-radius: 999px;
                background: linear-gradient(90deg, rgba(255, 58, 127, 0), rgba(255, 58, 127, .95), rgba(110, 231, 255, .55), rgba(255, 58, 127, 0));
                filter: blur(.2px);
                animation: maSweep 2.8s ease-in-out infinite;
            }

            .matelas-orb {
                position: absolute;
                width: 220px;
                height: 220px;
                border-radius: 999px;
                filter: blur(26px);
                opacity: .55;
                pointer-events: none;
            }

            .matelas-orb--a {
                left: -60px;
                top: -70px;
                background: radial-gradient(circle at 30% 30%, rgba(255, 58, 127, .55), rgba(255, 58, 127, 0) 60%);
                animation: maFloatA 8s ease-in-out infinite;
            }

            .matelas-orb--b {
                right: -70px;
                bottom: -80px;
                background: radial-gradient(circle at 30% 30%, rgba(110, 231, 255, .40), rgba(110, 231, 255, 0) 60%);
                animation: maFloatB 10s ease-in-out infinite;
            }

            @keyframes maSweep {

                0%,
                100% {
                    transform: translateX(-18px);
                    opacity: .75
                }

                50% {
                    transform: translateX(18px);
                    opacity: 1
                }
            }

            @keyframes maMarquee {
                0% {
                    transform: translateX(0)
                }

                100% {
                    transform: translateX(-50%)
                }
            }

            @keyframes maFloatA {

                0%,
                100% {
                    transform: translate(0, 0)
                }

                50% {
                    transform: translate(18px, 22px)
                }
            }

            @keyframes maFloatB {

                0%,
                100% {
                    transform: translate(0, 0)
                }

                50% {
                    transform: translate(-22px, -16px)
                }
            }

            .matelas-quick {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 10px 12px;
                border-radius: 999px;
                background: #0a1733;
                color: #fff;
                font-weight: 950;
                border: 0;
                cursor: pointer;
            }

            .matelas-quick:hover {
                filter: brightness(1.06);
            }

            .matelas-banner {
                padding: 54px 0;
                background: linear-gradient(180deg, var(--ma-navy) 0%, #1e3a8a 100%);
                color: #fff;
                position: relative;
                overflow: hidden;
                animation: fadeUp 1s ease-out 0.3s both;
            }

            @keyframes fadeUp {
                from {
                    opacity: 0;
                    transform: translateY(40px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .matelas-banner::before {
                content: "";
                position: absolute;
                inset: -2px;
                background: radial-gradient(900px 520px at 18% 30%, rgba(255, 58, 127, .16), rgba(255, 58, 127, 0) 62%), radial-gradient(900px 520px at 82% 14%, rgba(110, 231, 255, .10), rgba(110, 231, 255, 0) 60%);
                pointer-events: none;
            }

            .matelas-banner__grid {
                display: grid;
                grid-template-columns: 1.08fr .92fr;
                gap: 18px;
                align-items: center;
                position: relative;
            }

            .matelas-banner__card {
                border-radius: 26px;
                padding: 22px 22px 20px;
                background: rgba(255, 255, 255, .06);
                border: 1px solid rgba(255, 255, 255, .12);
                box-shadow: 0 34px 90px rgba(0, 0, 0, .36);
            }

            .matelas-banner__eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-weight: 950;
                letter-spacing: .12em;
                text-transform: uppercase;
                font-size: 11px;
                color: rgba(241, 245, 249, .80);
            }

            .matelas-banner__eyebrow i {
                width: 8px;
                height: 8px;
                border-radius: 999px;
                background: var(--ma-rose);
                display: inline-block;
            }

            .matelas-banner__title {
                margin: 10px 0 8px;
                font-weight: 1000;
                letter-spacing: -.05em;
                line-height: 1.02;
                font-size: 34px;
            }

            .matelas-banner__title strong {
                color: var(--ma-rose);
                font-weight: 1000;
            }

            .matelas-banner__title::after {
                content: "";
                display: block;
                height: 3px;
                width: 84px;
                margin: 12px 0 0;
                border-radius: 999px;
                background: linear-gradient(90deg, var(--ma-rose), rgba(110, 231, 255, .75));
            }

            .matelas-banner__desc {
                margin: 10px 0 0;
                color: rgba(241, 245, 249, .82);
                font-weight: 750;
                font-size: 13px;
                max-width: 70ch;
            }

            .matelas-banner__meta {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
                margin-top: 14px;
            }

            .matelas-badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 8px 10px;
                border-radius: 999px;
                background: rgba(255, 255, 255, .08);
                border: 1px solid rgba(255, 255, 255, .12);
                font-weight: 950;
                font-size: 11px;
                color: rgba(241, 245, 249, .92);
            }

            .matelas-banner__cta {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
                margin-top: 16px;
                align-items: center;
            }

            .matelas-banner__price {
                font-weight: 1000;
                color: rgba(241, 245, 249, .92);
            }

            .matelas-banner__media {
                border-radius: 26px;
                overflow: hidden;
                border: 1px solid rgba(255, 255, 255, .12);
                background: rgba(255, 255, 255, .04);
                box-shadow: 0 34px 90px rgba(0, 0, 0, .38);
            }

            .matelas-banner__media img {
                width: 100%;
                height: 100%;
                display: block;
                object-fit: cover;
                aspect-ratio: 4 / 3;
            }

            .matelas-tabs {
                padding: 30px 0 10px;
                animation: fadeUp 1s ease-out 0.5s both;
            }

            .matelas-tabs__wrap {
                background: #fff;
                border: 1px solid var(--ma-border);
                border-radius: 26px;
                padding: 18px;
                box-shadow: 0 18px 50px rgba(2, 6, 23, .06);
            }

            .matelas-tabs__head {
                position: relative;
                padding: 34px 18px 18px;
                border-radius: 24px;
                background: linear-gradient(180deg, rgba(11, 27, 58, .06), rgba(11, 27, 58, 0));
                border: 1px solid rgba(226, 232, 240, .92);
                overflow: hidden;
            }

            .matelas-tabs__head::before {
                content: "";
                position: absolute;
                inset: -2px;
                background: radial-gradient(760px 260px at 18% 30%, rgba(255, 58, 127, .12), rgba(255, 58, 127, 0) 60%), radial-gradient(760px 320px at 82% 20%, rgba(110, 231, 255, .12), rgba(110, 231, 255, 0) 62%);
                pointer-events: none;
            }

            .matelas-tabs__head::after {
                content: "CONFORT";
                position: absolute;
                left: 18px;
                top: 14px;
                font-weight: 1000;
                letter-spacing: .20em;
                text-transform: uppercase;
                font-size: 66px;
                line-height: 1;
                color: rgba(11, 27, 58, .06);
                pointer-events: none;
            }

            .matelas-tabs__head>* {
                position: relative;
            }

            .matelas-tabs__headgrid {
                display: grid;
                grid-template-columns: 1.2fr .8fr;
                gap: 14px;
                align-items: center;
            }

            .matelas-tabs__kicker {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-weight: 1000;
                letter-spacing: .12em;
                text-transform: uppercase;
                font-size: 11px;
                color: rgba(11, 27, 58, .70);
            }

            .matelas-tabs__kicker i {
                width: 8px;
                height: 8px;
                border-radius: 999px;
                background: linear-gradient(135deg, var(--ma-rose), rgba(110, 231, 255, .95));
                display: inline-block;
            }

            .matelas-tabs__hero {
                margin: 10px 0 10px;
                font-weight: 1000;
                letter-spacing: -.07em;
                line-height: 1.00;
                font-size: 42px;
                color: var(--ma-ink);
            }

            .matelas-tabs__hero span {
                background: linear-gradient(135deg, var(--ma-navy), #0b1b3a 35%, var(--ma-rose));
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }

            .matelas-tabs__hero::after {
                content: "";
                display: block;
                height: 4px;
                width: min(360px, 92%);
                margin: 14px 0 0;
                border-radius: 999px;
                background: linear-gradient(90deg, rgba(255, 58, 127, 0), rgba(255, 58, 127, .95), rgba(110, 231, 255, .55), rgba(255, 58, 127, 0));
                filter: blur(.2px);
                animation: maSweep 2.8s ease-in-out infinite;
            }

            .matelas-tabs__sub {
                margin: 0;
                max-width: 72ch;
                color: #475569;
                font-weight: 750;
                font-size: 13px;
                line-height: 1.6;
            }

            .matelas-tabs__stats {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .matelas-tabs__stat {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
                padding: 12px 12px;
                border-radius: 18px;
                background: rgba(255, 255, 255, .85);
                border: 1px solid rgba(226, 232, 240, .95);
                font-weight: 950;
                color: rgba(11, 27, 58, .92);
                font-size: 12px;
                box-shadow: 0 14px 34px rgba(2, 6, 23, .06);
                min-height: 74px;
            }

            .matelas-tabs__stat strong {
                font-weight: 1000;
            }

            .matelas-tabs__stat span {
                color: #64748b;
                font-weight: 800;
            }

            .matelas-tabs__title {
                text-align: center;
                margin: 14px 0 0;
                font-weight: 1000;
                color: var(--ma-rose);
                letter-spacing: -.02em;
                font-size: 14px;
            }

            .matelas-tabs__bar {
                display: flex;
                gap: 10px;
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 12px;
            }

            .matelas-tab {
                border: 0;
                background: #eef2ff;
                color: var(--ma-navy);
                font-weight: 1000;
                border-radius: 999px;
                padding: 10px 14px;
                cursor: pointer;
            }

            .matelas-tab.is-active {
                background: var(--ma-rose);
                color: #fff;
            }

            .matelas-tabs__grid {
                margin-top: 16px;
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 14px;
            }

            .matelas-tabs__panel {
                display: none;
            }

            .matelas-tabs__panel.is-active {
                display: block;
                animation: maFadeUp .28s ease both;
            }

            .matelas-page .best-modern__grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 14px;
            }

            .matelas-modal {
                position: fixed;
                inset: 0;
                display: flex;
                align-items: flex-end;
                justify-content: center;
                z-index: 60;
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                transition: opacity .22s ease, visibility 0s linear .22s;
            }

            .matelas-modal.is-open {
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
                transition: opacity .22s ease;
            }

            .matelas-modal__backdrop {
                position: absolute;
                inset: 0;
                background: rgba(2, 6, 23, .55);
                backdrop-filter: blur(6px);
                opacity: 0;
                transition: opacity .22s ease;
            }

            .matelas-modal.is-open .matelas-modal__backdrop {
                opacity: 1;
            }

            .matelas-modal__panel {
                position: relative;
                width: min(860px, calc(100% - 24px));
                margin: 12px 12px 18px;
                border-radius: 24px;
                overflow: hidden;
                background: #fff;
                border: 1px solid var(--ma-border);
                box-shadow: 0 30px 90px rgba(0, 0, 0, .28);
            }

            .matelas-modal__panel {
                transform: translateY(18px) scale(.985);
                opacity: 0;
                transition: transform .24s ease, opacity .24s ease;
            }

            .matelas-modal.is-open .matelas-modal__panel {
                transform: translateY(0) scale(1);
                opacity: 1;
            }

            .matelas-modal__bar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
                padding: 14px 16px;
                background: linear-gradient(135deg, rgba(255, 58, 127, .10), rgba(11, 27, 58, .10));
                border-bottom: 1px solid var(--ma-border);
            }

            .matelas-modal__title {
                font-weight: 1000;
                color: var(--ma-ink);
                margin: 0;
                font-size: 14px;
            }

            .matelas-modal__close {
                border: 0;
                background: #fff;
                color: var(--ma-navy);
                font-weight: 1000;
                border-radius: 999px;
                padding: 10px 12px;
                cursor: pointer;
                border: 1px solid var(--ma-border);
            }

            .matelas-modal__content {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 14px;
                padding: 16px;
            }

            .matelas-modal__media {
                border-radius: 18px;
                overflow: hidden;
                border: 1px solid var(--ma-border);
                background: linear-gradient(135deg, #f8fafc, #fff);
            }

            .matelas-modal__media img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                aspect-ratio: 4 / 3;
            }

            .matelas-modal__form {
                display: grid;
                gap: 10px;
                align-content: start;
            }

            .matelas-field label {
                display: block;
                font-weight: 950;
                color: var(--ma-navy);
                font-size: 12px;
                margin-bottom: 6px;
            }

            .matelas-select {
                width: 100%;
                border: 1px solid var(--ma-border);
                border-radius: 14px;
                padding: 12px 12px;
                font-weight: 800;
                color: var(--ma-ink);
                background: #fff;
            }

            .matelas-modal__cta {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
                margin-top: 4px;
            }

            .matelas-modal__hint {
                color: #64748b;
                font-weight: 800;
                font-size: 12px;
                margin: 0;
            }

            .matelas-modal__price {
                font-weight: 1000;
                color: var(--ma-ink);
                font-size: 18px;
            }

            .matelas-chip.is-active {
                border-color: rgba(255, 58, 127, .45);
                box-shadow: 0 12px 24px rgba(255, 58, 127, .14);
            }

            .matelas-all {
                padding: 40px 0 58px;
            }

            .matelas-all__head {
                position: relative;
                margin-bottom: 16px;
                padding: 26px 18px;
                border-radius: 26px;
                background: linear-gradient(180deg, rgba(11, 27, 58, .08), rgba(11, 27, 58, 0));
                border: 1px solid rgba(226, 232, 240, .92);
                overflow: hidden;
            }

            .matelas-all__head::before {
                content: "";
                position: absolute;
                inset: -2px;
                background: radial-gradient(760px 260px at 18% 30%, rgba(255, 58, 127, .16), rgba(255, 58, 127, 0) 60%), radial-gradient(760px 320px at 82% 20%, rgba(110, 231, 255, .14), rgba(110, 231, 255, 0) 62%);
                pointer-events: none;
            }

            .matelas-all__head::after {
                content: "TOUS";
                position: absolute;
                left: 18px;
                top: 12px;
                font-weight: 1000;
                letter-spacing: .20em;
                text-transform: uppercase;
                font-size: 62px;
                line-height: 1;
                color: rgba(11, 27, 58, .06);
                pointer-events: none;
            }

            .matelas-all__head>* {
                position: relative;
            }

            .matelas-all__kicker {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-weight: 1000;
                letter-spacing: .12em;
                text-transform: uppercase;
                font-size: 11px;
                color: rgba(11, 27, 58, .68);
            }

            .matelas-all__kicker i {
                width: 8px;
                height: 8px;
                border-radius: 999px;
                background: linear-gradient(135deg, var(--ma-rose), rgba(110, 231, 255, .95));
                display: inline-block;
            }

            .matelas-all__title {
                font-size: 34px;
                font-weight: 1000;
                letter-spacing: -.05em;
                color: var(--ma-ink);
                margin: 10px 0 8px;
                line-height: 1.02;
            }

            .matelas-all__title span {
                background: linear-gradient(135deg, var(--ma-navy), #0b1b3a 35%, var(--ma-rose));
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }

            .matelas-all__title::after {
                content: "";
                display: block;
                height: 4px;
                width: min(320px, 80%);
                margin: 12px 0 0;
                border-radius: 999px;
                background: linear-gradient(90deg, rgba(255, 58, 127, 0), rgba(255, 58, 127, .95), rgba(110, 231, 255, .55), rgba(255, 58, 127, 0));
                filter: blur(.2px);
                animation: maSweep 2.8s ease-in-out infinite;
            }

            .matelas-all__desc {
                color: var(--ma-muted);
                font-weight: 750;
                margin: 8px 0 0;
                max-width: 70ch;
            }

            .matelas-all__stats {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
                margin-top: 14px;
            }

            .matelas-all__stat {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 9px 12px;
                border-radius: 999px;
                background: #fff;
                border: 1px solid rgba(226, 232, 240, .95);
                font-weight: 950;
                color: rgba(11, 27, 58, .92);
                font-size: 12px;
                box-shadow: 0 14px 34px rgba(2, 6, 23, .06);
            }

            .matelas-all__stat strong {
                font-weight: 1000;
            }

            .matelas-all__grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 14px;
                margin-top: 18px;
            }

            .matelas-categories__grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
                margin-top: 24px
            }

            .matelas-category-card {
                display: block;
                background: #fff;
                border-radius: 22px;
                overflow: hidden;
                border: 1px solid var(--ma-border);
                box-shadow: 0 12px 32px rgba(2, 6, 23, .08);
                transition: all .3s cubic-bezier(.4, 0, .2, 1);
                text-decoration: none;
                color: inherit
            }

            .matelas-category-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 20px 48px rgba(2, 6, 23, .14);
                border-color: rgba(255, 58, 127, .3)
            }

            .matelas-category-card__media {
                position: relative;
                aspect-ratio: 1;
                background: linear-gradient(135deg, #f8fafc, #fff);
                overflow: hidden
            }

            .matelas-category-card__media img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                transition: transform .5s cubic-bezier(.4, 0, .2, 1)
            }

            .matelas-category-card:hover .matelas-category-card__media img {
                transform: scale(1.08)
            }

            .matelas-category-card__placeholder {
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, rgba(255, 58, 127, .1), rgba(110, 231, 255, .1))
            }

            .matelas-category-card__placeholder span {
                font-size: 48px;
                font-weight: 1000;
                color: var(--ma-navy);
                opacity: .3
            }

            .matelas-category-card__badge {
                position: absolute;
                bottom: 12px;
                right: 12px;
                padding: 8px 14px;
                border-radius: 999px;
                background: linear-gradient(135deg, var(--ma-rose), #be185d);
                color: #fff;
                font-weight: 1000;
                font-size: 11px;
                letter-spacing: .02em;
                text-transform: uppercase;
                box-shadow: 0 8px 20px rgba(255, 58, 127, .3)
            }

            .matelas-category-card__content {
                padding: 16px
            }

            .matelas-category-card__name {
                margin: 0 0 6px;
                font-size: 18px;
                font-weight: 1000;
                color: var(--ma-ink);
                letter-spacing: -.02em;
                line-height: 1.2
            }

            .matelas-category-card__desc {
                margin: 0;
                font-size: 13px;
                font-weight: 700;
                color: #64748b;
                line-height: 1.4
            }

            .matelas-all__products {
                margin-top: 48px
            }

            .matelas-all__products-head {
                margin-bottom: 20px;
                padding: 20px;
                border-radius: 20px;
                background: linear-gradient(180deg, rgba(11, 27, 58, .04), rgba(11, 27, 58, 0));
                border: 1px solid rgba(226, 232, 240, .85)
            }

            .matelas-all__products-title {
                margin: 0 0 4px;
                font-size: 24px;
                font-weight: 1000;
                color: var(--ma-ink);
                letter-spacing: -.03em
            }

            .matelas-all__products-desc {
                margin: 0;
                font-size: 14px;
                font-weight: 700;
                color: #64748b
            }

            .matelas-mini {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 22px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                min-height: 310px;
            }

            .matelas-why__benefit {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 22px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                min-height: 310px;
            }

            .matelas-why__benefit:hover {
                transform: none;
                box-shadow: none;
            }

            .matelas-mini__media {
                aspect-ratio: 1.1 / 1;
                background: linear-gradient(135deg, #f8fafc, #fff);
            }

            .matelas-mini__media img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .matelas-mini__body {
                padding: 14px 14px 16px;
                display: flex;
                flex-direction: column;
                gap: 10px;
                flex: 1;
            }

            .matelas-mini__name {
                font-weight: 1000;
                color: #0b1220;
                margin: 0;
                font-size: 14px;
                line-height: 1.15;
            }

            .matelas-mini__meta {
                color: #64748b;
                font-weight: 700;
                font-size: 12px;
                line-height: 1.25;
                margin: 0;
                min-height: 30px;
            }

            .matelas-mini__footer {
                margin-top: auto;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
            }

            .matelas-mini__price {
                font-weight: 1000;
                color: var(--ma-ink);
                font-size: 16px;
            }

            .matelas-mini__footer form {
                margin: 0;
            }

            .matelas-mini__add {
                position: relative;
                isolation: isolate;
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 10px 14px;
                border-radius: 999px;
                background: linear-gradient(135deg, var(--ma-rose), #ff2e72);
                color: #fff;
                font-weight: 1000;
                border: 0;
                cursor: pointer;
                box-shadow: 0 18px 44px rgba(255, 58, 127, .26);
                overflow: hidden;
            }

            .matelas-mini__add::after {
                content: "+";
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 22px;
                height: 22px;
                border-radius: 999px;
                background: rgba(255, 255, 255, .18);
                border: 1px solid rgba(255, 255, 255, .22);
                font-weight: 1000;
                line-height: 1;
            }

            .matelas-mini__add::before {
                content: "";
                position: absolute;
                inset: -40% -60%;
                background: linear-gradient(120deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, .34) 45%, rgba(255, 255, 255, 0) 70%);
                transform: translateX(-55%) rotate(8deg);
                opacity: .0;
                transition: opacity .22s ease, transform .55s ease;
                z-index: -1;
            }

            .matelas-mini__add:hover {
                filter: saturate(1.06);
                box-shadow: 0 20px 52px rgba(255, 58, 127, .32);
            }

            .matelas-mini__add:hover::before {
                opacity: .9;
                transform: translateX(55%) rotate(8deg);
            }

            .matelas-mini__add:active {
                transform: translateY(1px);
            }

            @keyframes maFadeUp {
                from {
                    opacity: 0;
                    transform: translateY(8px)
                }

                to {
                    opacity: 1;
                    transform: translateY(0)
                }
            }

            @media (max-width: 991px) {
                .matelas-hero {
                    padding: 110px 0 86px;
                    min-height: 460px;
                }

                .matelas-hero__title {
                    font-size: 36px;
                }

                .matelas-section__grid {
                    grid-template-columns: 1fr;
                }

                .matelas-all__grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .matelas-modal__content {
                    grid-template-columns: 1fr;
                }

                .matelas-tabs__grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .matelas-banner__grid {
                    grid-template-columns: 1fr;
                }

                .matelas-cloud--a {
                    top: 70px;
                }

                .matelas-cloud--b {
                    top: 44px;
                }

                .matelas-page .best-modern__grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .matelas-categories__grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 16px
                }
            }

            @media (max-width: 520px) {
                .matelas-hero {
                    padding: 96px 0 66px;
                    min-height: 420px;
                }

                .matelas-hero__title {
                    font-size: 30px;
                }

                .matelas-all__grid {
                    grid-template-columns: 1fr;
                }

                .matelas-tabs__grid {
                    grid-template-columns: 1fr;
                }

                .matelas-page .best-modern__grid {
                    grid-template-columns: 1fr;
                }

                .matelas-block__head {
                    padding: 36px 14px 18px;
                }

                .matelas-block__head::after {
                    font-size: 46px;
                }

                .matelas-marquee {
                    top: 10px;
                    height: 28px;
                }

                .matelas-block__title {
                    font-size: 34px;
                }

                .matelas-cloud {
                    transform: none !important;
                }

                .matelas-cloud--c,
                .matelas-cloud--d {
                    display: none;
                }

                .matelas-all__head {
                    padding: 22px 14px;
                }

                .matelas-all__head::after {
                    font-size: 44px;
                }

                .matelas-all__title {
                    font-size: 28px;
                }

                .matelas-tabs__head {
                    padding: 22px 12px 12px;
                }

                .matelas-tabs__head::after {
                    font-size: 44px;
                }

                .matelas-tabs__headgrid {
                    grid-template-columns: 1fr;
                }

                .matelas-tabs__hero {
                    font-size: 30px;
                }

                .matelas-tabs__stats {
                    grid-template-columns: 1fr;
                }

                .matelas-categories__grid {
                    grid-template-columns: 1fr;
                    gap: 14px
                }

                .matelas-category-card__name {
                    font-size: 16px
                }

                .matelas-category-card__desc {
                    font-size: 12px
                }
            }

            @media (prefers-reduced-motion: reduce) {

                .matelas-orb--a,
                .matelas-orb--b,
                .matelas-block__title::after,
                .matelas-marquee__track,
                .matelas-cloud {
                    animation: none !important;
                }

                .matelas-banner__title::after {
                    animation: none !important;
                }

                .matelas-all__title::after {
                    animation: none !important;
                }

                .matelas-tabs__hero::after {
                    animation: none !important;
                }

                [data-reveal] {
                    opacity: 1 !important;
                    transform: none !important;
                    filter: none !important;
                    transition: none !important;
                }

                .matelas-mini__add::before {
                    transition: none !important;
                }

                .matelas-tabs__panel.is-active {
                    animation: none !important;
                }

                .matelas-modal,
                .matelas-modal__backdrop,
                .matelas-modal__panel {
                    transition: none !important;
                }
            }
        </style>

        <style>
            /* Dynamic Hero Section */
            .matelas-hero {
                position: relative;
                min-height: 600px;
                display: flex;
                align-items: center;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                padding: 100px 0;
            }

            .matelas-hero__overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(30, 58, 138, 0.85) 100%);
            }

            .matelas-hero__container {
                position: relative;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 60px;
                align-items: center;
            }

            .matelas-hero__content {
                color: #fff;
            }

            .matelas-hero__badge {
                display: inline-block;
                padding: 10px 24px;
                background: rgba(236, 72, 153, 0.2);
                border: 1px solid rgba(236, 72, 153, 0.4);
                border-radius: 50px;
                font-size: 0.875rem;
                font-weight: 700;
                letter-spacing: 2px;
                text-transform: uppercase;
                margin-bottom: 24px;
            }

            .matelas-hero__title {
                font-size: clamp(2rem, 5vw, 3.5rem);
                font-weight: 900;
                margin: 0 0 20px;
                letter-spacing: -0.02em;
                line-height: 1.2;
            }

            .matelas-hero__subtitle {
                font-size: 1.125rem;
                line-height: 1.7;
                margin: 0 0 32px;
                color: rgba(255, 255, 255, 0.9);
            }

            .matelas-hero__stats {
                display: flex;
                gap: 40px;
            }

            .matelas-hero__stat {
                text-align: center;
            }

            .matelas-hero__stat strong {
                display: block;
                font-size: 2rem;
                font-weight: 900;
                margin-bottom: 4px;
            }

            .matelas-hero__stat span {
                font-size: 0.875rem;
                color: rgba(255, 255, 255, 0.8);
            }

            .matelas-hero__card {
                position: relative;
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            }

            .matelas-hero__card img {
                width: 100%;
                height: auto;
                display: block;
            }

            .matelas-hero__card-badge-top,
            .matelas-hero__card-badge-bottom {
                position: absolute;
                left: 20px;
                padding: 8px 20px;
                background: rgba(255, 255, 255, 0.95);
                border-radius: 50px;
                font-weight: 700;
                font-size: 0.875rem;
                color: #0f172a;
            }

            .matelas-hero__card-badge-top {
                top: 20px;
            }

            .matelas-hero__card-badge-bottom {
                bottom: 20px;
            }

            /* Benefits Section */
            .matelas-benefits {
                padding: 80px 0;
                background: #f8fafc;
            }

            .matelas-benefits__grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 32px;
            }

            .matelas-benefit-card {
                background: #fff;
                border-radius: 20px;
                padding: 40px;
                text-align: center;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
                transition: all 0.3s ease;
            }

            .matelas-benefit-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
            }

            .matelas-benefit-card__icon {
                width: 64px;
                height: 64px;
                background: linear-gradient(135deg, #ec4899, #be185d);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 24px;
                color: #fff;
            }

            .matelas-benefit-card__title {
                font-size: 1.25rem;
                font-weight: 800;
                color: #0f172a;
                margin: 0 0 12px;
            }

            .matelas-benefit-card__text {
                font-size: 1rem;
                color: #64748b;
                line-height: 1.6;
                margin: 0;
            }

            /* CTA Section */
            .matelas-cta {
                padding: 80px 0;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: #fff;
                text-align: center;
            }

            .matelas-cta__title {
                font-size: clamp(1.75rem, 4vw, 2.5rem);
                font-weight: 800;
                margin: 0 0 16px;
            }

            .matelas-cta__text {
                font-size: 1.125rem;
                color: rgba(255, 255, 255, 0.9);
                margin: 0 0 32px;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
            }

            .matelas-cta__button {
                display: inline-block;
                padding: 16px 32px;
                background: #fff;
                color: #667eea;
                text-decoration: none;
                border-radius: 50px;
                font-weight: 700;
                font-size: 1rem;
                transition: all 0.3s ease;
            }

            .matelas-cta__button:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }

            @media (max-width: 768px) {

                /* Hero Section Mobile */
                .matelas-hero {
                    min-height: auto;
                    padding: 60px 0;
                }

                .matelas-hero__container {
                    grid-template-columns: 1fr;
                    gap: 40px;
                }

                .matelas-hero__stats {
                    gap: 24px;
                    flex-wrap: wrap;
                    justify-content: center;
                }

                .matelas-hero__stat {
                    min-width: 100px;
                }

                .matelas-hero__card {
                    order: -1;
                    max-width: 300px;
                    margin: 0 auto;
                }

                .matelas-hero__title {
                    font-size: 2rem;
                }

                .matelas-hero__subtitle {
                    font-size: 1rem;
                }

                /* Benefits Section Mobile */
                .matelas-benefits {
                    padding: 60px 0;
                }

                .matelas-benefits__grid {
                    grid-template-columns: 1fr;
                    gap: 24px;
                }

                .matelas-benefit-card {
                    padding: 32px 24px;
                }

                /* Categories Section Mobile */
                .matelas-categories-simple {
                    padding: 60px 0;
                }

                .matelas-categories-simple__head {
                    margin-bottom: 40px;
                }

                .matelas-categories-simple__title {
                    font-size: 2rem;
                }

                .matelas-categories-simple__desc {
                    font-size: 1rem;
                }

                .matelas-categories-simple__grid {
                    display: grid;
                    grid-template-columns: 1fr !important;
                    max-width: 100%;
                    gap: 24px;
                }

                .matelas-category-simple-card {
                    display: block;
                }

                .matelas-category-simple-card__media {
                    height: 240px;
                }

                .matelas-category-simple-card__content {
                    padding: 24px;
                }

                .matelas-category-simple-card__name {
                    font-size: 1.5rem;
                }

                /* Products Section Mobile */
                .matelas-products-simple {
                    padding: 60px 0;
                }

                .matelas-products-simple__title {
                    font-size: 2rem;
                }

                .matelas-products-simple__grid {
                    grid-template-columns: 1fr !important;
                    max-width: 100%;
                }

                /* Container padding mobile */
                .container {
                    padding: 0 20px;
                }
            }

            @media (max-width: 480px) {
                .matelas-hero__title {
                    font-size: 1.75rem;
                }

                .matelas-hero__badge {
                    padding: 8px 16px;
                    font-size: 0.75rem;
                }

                .matelas-benefit-card {
                    padding: 24px 20px;
                }

                .matelas-category-simple-card {
                    min-width: 260px;
                }

                .matelas-category-simple-card__media {
                    min-height: 160px;
                }

                .matelas-category-simple-card__content {
                    padding: 16px;
                }

                .matelas-category-simple-card__name {
                    font-size: 1.125rem;
                }
            }

            /* FAQ Section */
            .matelas-faq {
                padding: 80px 0;
                background: #fff;
            }

            .matelas-faq__header {
                text-align: center;
                margin-bottom: 48px;
            }

            .matelas-faq__title {
                font-size: clamp(1.75rem, 4vw, 2.5rem);
                font-weight: 800;
                color: #0f172a;
                margin: 0;
            }

            .matelas-faq__grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 24px;
                max-width: 1000px;
                margin: 0 auto;
            }

            .matelas-faq-item {
                background: #f8fafc;
                border-radius: 16px;
                padding: 32px;
                border: 1px solid #e2e8f0;
            }

            .matelas-faq-item__question {
                font-size: 1.125rem;
                font-weight: 700;
                color: #0f172a;
                margin: 0 0 12px;
            }

            .matelas-faq-item__answer {
                font-size: 1rem;
                color: #64748b;
                line-height: 1.6;
                margin: 0;
            }

            /* Mission Section */
            .matelas-mission {
                padding: 100px 0;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: #fff;
                text-align: center;
            }

            .matelas-mission__content {
                max-width: 800px;
                margin: 0 auto;
            }

            .matelas-mission__title {
                font-size: clamp(2rem, 5vw, 3rem);
                font-weight: 900;
                margin: 0 0 24px;
            }

            .matelas-mission__text {
                font-size: 1.25rem;
                line-height: 1.7;
                color: rgba(255, 255, 255, 0.9);
                margin: 0;
            }

            /* Why Choose Section */
            .matelas-why {
                padding: 100px 0;
                background: #f8fafc;
            }

            .matelas-why__header {
                text-align: center;
                margin-bottom: 60px;
            }

            .matelas-why__title {
                font-size: clamp(1.75rem, 4vw, 2.5rem);
                font-weight: 800;
                color: #0f172a;
                margin: 0 0 16px;
            }

            .matelas-why__subtitle {
                font-size: 1.125rem;
                color: #64748b;
                margin: 0;
            }

            .matelas-why__stats {
                display: flex;
                justify-content: center;
                gap: 60px;
                margin-bottom: 60px;
            }

            .matelas-why__stat {
                text-align: center;
            }

            .matelas-why__stat strong {
                display: block;
                font-size: 3rem;
                font-weight: 900;
                color: #667eea;
                margin-bottom: 8px;
            }

            .matelas-why__stat span {
                font-size: 1rem;
                color: #64748b;
                font-weight: 600;
            }

            .matelas-why__benefits {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 32px;
                max-width: 1200px;
                margin: 0 auto;
            }

            .matelas-why__benefit {
                background: #fff;
                border-radius: 20px;
                padding: 40px;
                border: 1px solid #e2e8f0;
            }

            .matelas-why__benefit-title {
                font-size: 1.25rem;
                font-weight: 800;
                color: #0f172a;
                margin: 0 0 12px;
            }

            .matelas-why__benefit-text {
                font-size: 1rem;
                color: #64748b;
                line-height: 1.6;
                margin: 0;
            }

            @media (max-width: 768px) {
                .matelas-why__stats {
                    flex-direction: column;
                    gap: 32px;
                }
            }
        </style>

        @if (!($isProtegeMatelas ?? false))
            <div class="matelas-page">
                <!-- Dynamic Hero Section -->
                <section class="matelas-hero" style="background-image: url('{{ $pageConfig['hero_bg'] }}')">
                    <div class="matelas-hero__overlay"></div>
                    <div class="container matelas-hero__container">
                        <div class="matelas-hero__content">
                            <div class="matelas-hero__badge">{{ $pageConfig['badge'] }}</div>
                            <h1 class="matelas-hero__title">{{ $pageConfig['headline'] }}</h1>
                            <p class="matelas-hero__subtitle">{{ $pageConfig['subtitle'] }}</p>
                            <div class="matelas-hero__stats">
                                <div class="matelas-hero__stat">
                                    <strong>{{ $products->total() }}</strong>
                                    <span>Produits</span>
                                </div>
                                <div class="matelas-hero__stat">
                                    <strong>Livraison</strong>
                                    <span>Gratuite</span>
                                </div>
                                <div class="matelas-hero__stat">
                                    <strong>Garantie</strong>
                                    <span>2 ans</span>
                                </div>
                            </div>
                        </div>
                        <div class="matelas-hero__card">
                            <div class="matelas-hero__card-badge-top">{{ $pageConfig['hero_card_badge_top'] }}</div>
                            <img src="{{ $pageConfig['hero_card'] }}" alt="{{ $pageConfig['title'] }}" />
                            <div class="matelas-hero__card-badge-bottom">{{ $pageConfig['hero_card_badge_bottom'] }}</div>
                        </div>
                    </div>
                </section>

                <!-- Benefits Section -->
                <section class="matelas-benefits">
                    <div class="container">
                        <div class="matelas-benefits__grid">
                            @foreach ($pageConfig['benefits'] as $benefit)
                                <div class="matelas-benefit-card">
                                    <div class="matelas-benefit-card__icon">
                                        <svg viewBox="0 0 24 24" width="32" height="32">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"
                                                fill="currentColor" />
                                        </svg>
                                    </div>
                                    <h3 class="matelas-benefit-card__title">{{ $benefit['title'] }}</h3>
                                    <p class="matelas-benefit-card__text">{{ $benefit['text'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                @if (strtolower(trim((string) $menu->slug)) === 'lit-canape')
                    @php
                        $litCanapeCategories = [
                            [
                                'key' => 'fauteuil',
                                'label' => 'Fauteuil',
                                'desc' => 'Confort et style',
                                'image' =>
                                    'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=800&h=600&fit=crop',
                                'color' => '#3b82f6',
                            ],
                            [
                                'key' => 'table_manger',
                                'label' => 'Table à manger',
                                'desc' => 'Design fonctionnel',
                                'image' =>
                                    'https://images.unsplash.com/photo-1617806118233-18e1de247200?w=800&h=600&fit=crop',
                                'color' => '#8b5cf6',
                            ],
                            [
                                'key' => 'bureaux',
                                'label' => 'Bureaux',
                                'desc' => 'Espace travail',
                                'image' =>
                                    'https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?w=800&h=600&fit=crop',
                                'color' => '#ec4899',
                            ],
                            [
                                'key' => 'canapes',
                                'label' => 'Canapés',
                                'desc' => 'Détente optimale',
                                'image' =>
                                    'https://images.unsplash.com/photo-1550226891-ef816aed4a98?w=800&h=600&fit=crop',
                                'color' => '#f59e0b',
                            ],
                        ];
                    @endphp

                    <section class="matelas-categories-simple reveal is-visible" id="differents" aria-label="Nos gammes"
                        style="background:#0f172a;padding:100px 0">
                        <div class="container">
                            <div class="matelas-categories-simple__head" style="text-align:center;margin-bottom:80px">
                                <div class="matelas-categories-simple__badge"
                                    style="display:inline-block;padding:12px 28px;background:rgba(236,72,153,.15);border:2px solid rgba(236,72,153,.3);border-radius:50px;margin-bottom:32px">
                                    <span
                                        style="color:#ec4899;font-size:0.875rem;letter-spacing:3px;text-transform:uppercase;font-weight:800">Collection</span>
                                </div>
                                <h2 class="matelas-categories-simple__title"
                                    style="font-size:clamp(2.5rem,5vw,4rem);font-weight:900;color:#fff;margin-bottom:20px;letter-spacing:-.02em;line-height:1.1">
                                    Nos gammes</h2>
                                <p class="matelas-categories-simple__desc"
                                    style="font-size:1.25rem;color:rgba(255,255,255,.7);max-width:600px;margin:0 auto;line-height:1.7">
                                    Découvrez notre sélection de meubles pour votre intérieur</p>
                            </div>
                            <div class="matelas-categories-simple__grid"
                                style="display:grid;grid-template-columns:repeat(4,1fr);gap:32px;max-width:1400px;margin:0 auto">
                                @foreach ($litCanapeCategories as $category)
                                    <a href="#products" class="matelas-category-simple-card"
                                        data-category="{{ $category['key'] }}"
                                        style="text-decoration:none;color:inherit;background:#1e293b;border-radius:24px;overflow:hidden;display:block;position:relative;border:1px solid rgba(255,255,255,.1)">
                                        <div class="matelas-category-simple-card__media"
                                            style="position:relative;height:320px;overflow:hidden">
                                            <img src="{!! $category['image'] !!}" alt="{{ $category['label'] }}"
                                                loading="lazy" style="width:100%;height:100%;object-fit:cover" />
                                        </div>
                                        <div class="matelas-category-simple-card__content"
                                            style="padding:40px;position:relative">
                                            <h3 class="matelas-category-simple-card__name"
                                                style="font-size:2rem;font-weight:900;color:#fff;margin:0 0 12px;letter-spacing:-.01em;line-height:1.1">
                                                {{ $category['label'] }}</h3>
                                            <p class="matelas-category-simple-card__desc"
                                                style="font-size:1.125rem;color:rgba(255,255,255,.6);margin:0;line-height:1.6">
                                                {{ $category['desc'] }}</p>
                                            <div class="matelas-category-simple-card__arrow"
                                                style="display:inline-flex;align-items:center;gap:8px;margin-top:24px;padding:12px 24px;background:rgba(236,72,153,.15);color:#ec4899;border-radius:30px;font-weight:800;font-size:0.9375rem">
                                                Découvrir <span style="font-size:1.1rem;font-weight:900">→</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    <style>
                        .matelas-category-simple-card:hover {
                            transform: none;
                            border-color: rgba(255, 255, 255, .1);
                        }

                        .matelas-category-simple-card:hover .matelas-category-simple-card__media img {
                            transform: none;
                        }

                        .matelas-category-simple-card:hover .matelas-category-simple-card__arrow {
                            background: rgba(236, 72, 153, .15);
                            color: #ec4899;
                            transform: none;
                        }
                    </style>
                @elseif(strtolower(trim((string) $menu->slug)) === 'electromenager')
                    @php
                        $electromenagerCategories = [
                            [
                                'key' => 'gazinieres',
                                'label' => 'Gazinières',
                                'desc' => 'Cuisine au gaz',
                                'image' =>
                                    'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=600&fit=crop',
                                'color' => '#3b82f6',
                            ],
                            [
                                'key' => 'frigo',
                                'label' => 'Frigo',
                                'desc' => 'Conservation optimale',
                                'image' =>
                                    'https://images.unsplash.com/photo-1584568694244-14fbdf83bd30?w=800&h=600&fit=crop',
                                'color' => '#8b5cf6',
                            ],
                            [
                                'key' => 'climatiseurs',
                                'label' => 'Climatiseurs',
                                'desc' => 'Fraîcheur garantie',
                                'image' =>
                                    'https://images.unsplash.com/photo-1631679706909-1844bbd07221?w=800&h=600&fit=crop',
                                'color' => '#ec4899',
                            ],
                            [
                                'key' => 'mixeurs',
                                'label' => 'Mixeurs',
                                'desc' => 'Préparation facile',
                                'image' =>
                                    'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=800&h=600&fit=crop',
                                'color' => '#f59e0b',
                            ],
                        ];
                    @endphp

                    <section class="matelas-categories-simple reveal is-visible" id="differents" aria-label="Nos gammes"
                        style="background:#0f172a;padding:100px 0">
                        <div class="container">
                            <div class="matelas-categories-simple__head" style="text-align:center;margin-bottom:80px">
                                <div class="matelas-categories-simple__badge"
                                    style="display:inline-block;padding:12px 28px;background:rgba(236,72,153,.15);border:2px solid rgba(236,72,153,.3);border-radius:50px;margin-bottom:32px">
                                    <span
                                        style="color:#ec4899;font-size:0.875rem;letter-spacing:3px;text-transform:uppercase;font-weight:800">Collection</span>
                                </div>
                                <h2 class="matelas-categories-simple__title"
                                    style="font-size:clamp(2.5rem,5vw,4rem);font-weight:900;color:#fff;margin-bottom:20px;letter-spacing:-.02em;line-height:1.1">
                                    Nos gammes</h2>
                                <p class="matelas-categories-simple__desc"
                                    style="font-size:1.25rem;color:rgba(255,255,255,.7);max-width:600px;margin:0 auto;line-height:1.7">
                                    Découvrez notre sélection d'électroménager</p>
                            </div>
                            <div class="matelas-categories-simple__grid"
                                style="display:grid;grid-template-columns:repeat(4,1fr);gap:32px;max-width:1400px;margin:0 auto">
                                @foreach ($electromenagerCategories as $category)
                                    <a href="{{ route('category.show', $category['key']) }}"
                                        class="matelas-category-simple-card" data-category="{{ $category['key'] }}"
                                        style="text-decoration:none;color:inherit;background:#1e293b;border-radius:24px;overflow:hidden;display:block;position:relative;border:1px solid rgba(255,255,255,.1)">
                                        <div class="matelas-category-simple-card__media"
                                            style="position:relative;height:320px;overflow:hidden">
                                            <img src="{!! $category['image'] !!}" alt="{{ $category['label'] }}"
                                                loading="lazy" style="width:100%;height:100%;object-fit:cover" />
                                        </div>
                                        <div class="matelas-category-simple-card__content"
                                            style="padding:40px;position:relative">
                                            <h3 class="matelas-category-simple-card__name"
                                                style="font-size:2rem;font-weight:900;color:#fff;margin:0 0 12px;letter-spacing:-.01em;line-height:1.1">
                                                {{ $category['label'] }}</h3>
                                            <p class="matelas-category-simple-card__desc"
                                                style="font-size:1.125rem;color:rgba(255,255,255,.6);margin:0;line-height:1.6">
                                                {{ $category['desc'] }}</p>
                                            <div class="matelas-category-simple-card__arrow"
                                                style="display:inline-flex;align-items:center;gap:8px;margin-top:24px;padding:12px 24px;background:rgba(236,72,153,.15);color:#ec4899;border-radius:30px;font-weight:800;font-size:0.9375rem">
                                                Découvrir <span style="font-size:1.1rem;font-weight:900">→</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    <style>
                        .matelas-category-simple-card:hover {
                            transform: none;
                            border-color: rgba(255, 255, 255, .1);
                        }

                        .matelas-category-simple-card:hover .matelas-category-simple-card__media img {
                            transform: none;
                        }

                        .matelas-category-simple-card:hover .matelas-category-simple-card__arrow {
                            background: rgba(236, 72, 153, .15);
                            color: #ec4899;
                            transform: none;
                        }
                    </style>
                @elseif(in_array(strtolower(trim((string) $menu->slug)), ['matelas', 'oreillers-et-taies', 'drap-et-couettes']))
                    @php
                        $allMatelas = collect($matelasCategoryGroups ?? [])
                            ->flatMap(function ($g) {
                                return $g['products'] ?? [];
                            })
                            ->filter()
                            ->unique('id')
                            ->values();

                        $tabDefs = [
                            [
                                'key' => 'medicosoins',
                                'label' => 'MedicoSoins',
                                'desc' => 'Soutien orthopédique',
                                'tokens' => ['medicosoins'],
                                'color' => '#3b82f6',
                            ],
                            [
                                'key' => 'confort_soft',
                                'label' => 'Confort Soft',
                                'desc' => 'Douceur absolue',
                                'tokens' => ['confort', 'soft'],
                                'color' => '#8b5cf6',
                            ],
                            [
                                'key' => 'addict',
                                'label' => 'Addict',
                                'desc' => 'Le choix passionné',
                                'tokens' => ['addict'],
                                'color' => '#ec4899',
                            ],
                            [
                                'key' => 'luxury',
                                'label' => 'Luxury',
                                'desc' => 'Haut de gamme',
                                'tokens' => ['luxury'],
                                'color' => '#f59e0b',
                            ],
                        ];
                    @endphp

                    <section class="matelas-categories-simple" id="differents" aria-label="Nos gammes"
                        style="background:#0f172a;padding:100px 0">
                        <div class="container">
                            <div class="matelas-categories-simple__head" style="text-align:center;margin-bottom:80px">
                                <div class="matelas-categories-simple__badge"
                                    style="display:inline-block;padding:12px 28px;background:rgba(236,72,153,.15);border:2px solid rgba(236,72,153,.3);border-radius:50px;margin-bottom:32px">
                                    <span
                                        style="color:#ec4899;font-size:0.875rem;letter-spacing:3px;text-transform:uppercase;font-weight:800">Collection</span>
                                </div>
                                <h2 class="matelas-categories-simple__title"
                                    style="font-size:clamp(2.5rem,5vw,4rem);font-weight:900;color:#fff;margin-bottom:20px;letter-spacing:-.02em;line-height:1.1">
                                    Nos gammes</h2>
                                <p class="matelas-categories-simple__desc"
                                    style="font-size:1.25rem;color:rgba(255,255,255,.7);max-width:600px;margin:0 auto;line-height:1.7">
                                    Découvrez notre sélection de gammes premium</p>
                            </div>
                            <div class="matelas-categories-simple__grid"
                                style="display:grid;grid-template-columns:repeat(4,1fr);gap:32px;max-width:1400px;margin:0 auto">
                                @foreach ($tabDefs as $tab)
                                    @php
                                        $items = $allMatelas
                                            ->filter(function ($p) use ($tab) {
                                                $name = \Illuminate\Support\Str::lower((string) ($p->name ?? ''));
                                                foreach ($tab['tokens'] ?? [] as $t) {
                                                    if (!str_contains($name, \Illuminate\Support\Str::lower($t))) {
                                                        return false;
                                                    }
                                                }
                                                return true;
                                            })
                                            ->values();
                                        $count = $items->count();
                                        $firstImage = $items->first()?->image ?? null;
                                    @endphp
                                    <a href="#products" class="matelas-category-simple-card"
                                        data-category="{{ $tab['key'] }}"
                                        style="text-decoration:none;color:inherit;background:#1e293b;border-radius:24px;overflow:hidden;display:block;position:relative;border:1px solid rgba(255,255,255,.1)">
                                        <div class="matelas-category-simple-card__media"
                                            style="position:relative;height:320px;overflow:hidden">
                                            @if ($tab['key'] === 'medicosoins')
                                                <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&h=600&fit=crop"
                                                    alt="MedicoSoins" loading="lazy"
                                                    style="width:100%;height:100%;object-fit:cover" />
                                            @elseif($tab['key'] === 'confort_soft')
                                                <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=800&h=600&fit=crop"
                                                    alt="Confort Soft" loading="lazy"
                                                    style="width:100%;height:100%;object-fit:cover" />
                                            @elseif($tab['key'] === 'addict')
                                                <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=800&h=600&fit=crop"
                                                    alt="Addict" loading="lazy"
                                                    style="width:100%;height:100%;object-fit:cover" />
                                            @elseif($tab['key'] === 'luxury')
                                                <img src="https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800&h=600&fit=crop"
                                                    alt="Luxury" loading="lazy"
                                                    style="width:100%;height:100%;object-fit:cover" />
                                            @else
                                                @if ($firstImage)
                                                    <img src="@image_url($firstImage)" alt="{{ $tab['label'] }}"
                                                        loading="lazy" style="width:100%;height:100%;object-fit:cover" />
                                                @else
                                                    <div
                                                        style="width:100%;height:100%;background:{{ $tab['color'] ?? '#3b82f6' }};display:flex;align-items:center;justify-content:center;font-size:5rem;font-weight:950;color:#fff">
                                                        {{ $tab['label'][0] }}</div>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="matelas-category-simple-card__content"
                                            style="padding:40px;position:relative">
                                            <h3 class="matelas-category-simple-card__name"
                                                style="font-size:2rem;font-weight:900;color:#fff;margin:0 0 12px;letter-spacing:-.01em;line-height:1.1">
                                                {{ $tab['label'] }}</h3>
                                            <p class="matelas-category-simple-card__desc"
                                                style="font-size:1.125rem;color:rgba(255,255,255,.6);margin:0;line-height:1.6">
                                                {{ $tab['desc'] }}</p>
                                            <div class="matelas-category-simple-card__arrow"
                                                style="display:inline-flex;align-items:center;gap:8px;margin-top:24px;padding:12px 24px;background:rgba(236,72,153,.15);color:#ec4899;border-radius:30px;font-weight:800;font-size:0.9375rem">
                                                Découvrir <span style="font-size:1.1rem;font-weight:900">→</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    <style>
                        .matelas-category-simple-card:hover {
                            transform: none;
                            border-color: rgba(255, 255, 255, .1);
                        }

                        .matelas-category-simple-card:hover .matelas-category-simple-card__media img {
                            transform: none;
                        }

                        .matelas-category-simple-card:hover .matelas-category-simple-card__arrow {
                            background: rgba(236, 72, 153, .15);
                            color: #ec4899;
                            transform: none;
                        }
                    </style>
                @elseif(strtolower(trim((string) $menu->slug)) === 'meuble-et-fauteuil')
                    @php
                        $meubleFauteuilCategories = [
                            [
                                'key' => 'meubles',
                                'label' => 'Meubles',
                                'desc' => 'Design et fonctionnalité',
                                'tokens' => ['meuble', 'table', 'bureau', 'commode', 'armoire', 'etagere'],
                            ],
                            [
                                'key' => 'fauteuils',
                                'label' => 'Fauteuils',
                                'desc' => 'Confort et style',
                                'tokens' => ['fauteuil', 'chaise', 'siege'],
                            ],
                        ];
                    @endphp

                    <section class="matelas-categories-simple" id="categories" aria-label="Nos catégories">
                        <div class="container">
                            <div class="matelas-categories-simple__head" data-reveal>
                                <h2 class="matelas-categories-simple__title">Parcourir les catégories</h2>
                                <p class="matelas-categories-simple__desc">Choisissez la catégorie qui correspond à vos
                                    besoins</p>
                            </div>
                            <div class="matelas-categories-simple__grid">
                                @foreach ($meubleFauteuilCategories as $category)
                                    @php
                                        $items = $products
                                            ->filter(function ($p) use ($category) {
                                                $name = \Illuminate\Support\Str::lower((string) ($p->name ?? ''));
                                                foreach ($category['tokens'] ?? [] as $t) {
                                                    if (!str_contains($name, \Illuminate\Support\Str::lower($t))) {
                                                        return false;
                                                    }
                                                }
                                                return true;
                                            })
                                            ->values();
                                        $count = $items->count();
                                        $firstImage = $items->first()?->image ?? null;
                                    @endphp
                                    <a href="#products" class="matelas-category-simple-card"
                                        data-category="{{ $category['key'] }}"
                                        style="text-decoration:none;color:inherit">
                                        <div class="matelas-category-simple-card__media">
                                            @if ($firstImage)
                                                <img src="@image_url($firstImage)" alt="{{ $category['label'] }}"
                                                    loading="lazy" />
                                            @else
                                                <div class="matelas-category-simple-card__placeholder">
                                                    {{ $category['label'][0] }}</div>
                                            @endif
                                            <div class="matelas-category-simple-card__badge">{{ $count }} produits
                                            </div>
                                        </div>
                                        <div class="matelas-category-simple-card__content">
                                            <h3 class="matelas-category-simple-card__name">{{ $category['label'] }}</h3>
                                            <p class="matelas-category-simple-card__desc">{{ $category['desc'] }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif

                <section class="matelas-products-simple is-visible" id="products" aria-label="Tous les produits"
                    style="padding:100px 0;background:linear-gradient(180deg,#fff 0%,#f8fafc 100%)">
                    <div class="container">
                        <div class="matelas-products-simple__head"
                            style="text-align:center;max-width:800px;margin:0 auto 60px">
                            <div class="matelas-products-simple__badge"
                                style="display:inline-block;padding:10px 24px;background:rgba(236,72,153,.15);border-radius:30px;margin-bottom:7px;border:1px solid rgba(236,72,153,.3)">
                                <span
                                    style="color:#ec4899;font-size:0.8125rem;letter-spacing:2px;text-transform:uppercase;font-weight:600">Collection
                                    complète</span>
                            </div>
                            <h2 class="matelas-products-simple__title"
                                style="font-size:clamp(2rem,4vw,3.5rem);font-weight:800;color:#0f172a;margin-bottom:16px;letter-spacing:-.02em">
                                Nos produits</h2>
                            <p class="matelas-products-simple__desc"
                                style="font-size:1.125rem;color:#64748b;max-width:600px;margin:0 auto">
                                {{ $products->total() }} modèles disponibles pour tous vos besoins</p>
                        </div>
                        <div class="matelas-products-simple__grid"
                            style="display:grid;grid-template-columns:repeat(3,1fr);gap:32px;max-width:1400px;margin:0 auto">
                            @foreach ($products as $product)
                                @php
                                    $defaultVariant = $product?->variants?->sortBy('price')->first();
                                    $price = $defaultVariant?->price ?? $product->price;
                                @endphp
                                <article class="matelas-product-simple-card"
                                    style="background:#fff;border-radius:24px;overflow:hidden;border:1px solid #e2e8f0;position:relative">
                                    <a href="{{ route('product.show', $product->slug) }}"
                                        style="text-decoration:none;color:inherit;display:block">
                                        <div class="matelas-product-simple-card__media"
                                            style="position:relative;aspect-ratio:4/3;background:linear-gradient(135deg,#f8fafc,#f1f5f9);overflow:hidden">
                                            <img src="@image_url($product->image)" alt="{{ $product->name }}" loading="lazy"
                                                style="width:100%;height:100%;object-fit:cover" />
                                            <div class="matelas-product-simple-card__overlay"
                                                style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(0,0,0,0) 0%,rgba(0,0,0,0.5) 100%);opacity:0">
                                            </div>
                                        </div>
                                    </a>
                                    <div class="matelas-product-simple-card__body" style="padding:24px">
                                        <a href="{{ route('product.show', $product->slug) }}"
                                            style="text-decoration:none;color:inherit">
                                            <h3 class="matelas-product-simple-card__name"
                                                style="font-weight:800;color:#0f172a;margin:0 0 12px;font-size:1.125rem;line-height:1.4">
                                                {{ $product->name }}</h3>
                                        </a>
                                        <div class="matelas-product-simple-card__price"
                                            style="font-weight:800;color:#ec4899;font-size:1.5rem;margin-bottom:16px">
                                            {{ $price !== null ? number_format((float) $price, 0, ',', '.') . 'F' : '' }}
                                        </div>
                                        <form action="{{ route('cart.add') }}" method="POST" style="margin-top:16px">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="product_variant_id"
                                                value="{{ $defaultVariant?->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button class="matelas-product-simple-card__btn" type="submit"
                                                style="display:inline-flex;align-items:center;justify-content:center;gap:10px;width:100%;background:linear-gradient(135deg,#ec4899,#be185d);color:#fff;padding:14px 24px;border-radius:12px;text-decoration:none;font-weight:700;font-size:0.9375rem;border:0;cursor:pointer">
                                                <svg style="width:18px;height:18px" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                                    </path>
                                                </svg>
                                                Ajouter au panier
                                            </button>
                                        </form>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        @if (method_exists($products, 'links'))
                            <div class="matelas-products-simple__pagination" style="margin-top:60px">
                                {{ $products->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        @endif

        <style>
            .matelas-hero-simple {
                padding: 100px 0 70px;
                background: linear-gradient(135deg, #0b1b3a, #1e293b);
                color: #fff;
                position: relative;
                overflow: hidden
            }

            .matelas-hero-simple::before {
                content: "";
                position: absolute;
                inset: -2px;
                background: radial-gradient(700px 350px at 25% 30%, rgba(255, 58, 127, .12), rgba(255, 58, 127, 0) 50%), radial-gradient(700px 450px at 75% 20%, rgba(110, 231, 255, .10), rgba(110, 231, 255, 0) 55%);
                pointer-events: none
            }

            .matelas-hero-simple__inner {
                max-width: 900px;
                margin: 0 auto;
                text-align: center;
                position: relative
            }

            .matelas-hero-simple__badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 20px;
                border-radius: 999px;
                background: rgba(255, 58, 127, .18);
                border: 1px solid rgba(255, 58, 127, .35);
                font-weight: 900;
                font-size: 11px;
                letter-spacing: .1em;
                text-transform: uppercase;
                margin-bottom: 20px
            }

            .matelas-hero-simple__title {
                font-size: 44px;
                font-weight: 1000;
                letter-spacing: -.04em;
                margin: 0 0 14px;
                line-height: 1.08;
                color: #fff
            }

            .matelas-hero-simple__subtitle {
                font-size: 14px;
                color: rgba(241, 245, 249, .88);
                max-width: 60ch;
                margin: 0 auto 30px;
                font-weight: 700;
                line-height: 1.6
            }

            .matelas-hero-simple__stats {
                display: flex;
                gap: 24px;
                justify-content: center;
                flex-wrap: wrap
            }

            .matelas-hero-simple__stat {
                text-align: center
            }

            .matelas-hero-simple__stat strong {
                display: block;
                font-size: 28px;
                font-weight: 1000;
                color: #fff;
                margin-bottom: 4px
            }

            .matelas-hero-simple__stat span {
                font-size: 12px;
                font-weight: 700;
                color: rgba(241, 245, 249, .7);
                text-transform: uppercase;
                letter-spacing: .05em
            }

            .matelas-categories-simple {
                padding: 60px 0
            }

            .matelas-categories-simple__head {
                text-align: center;
                max-width: 600px;
                margin: 0 auto 40px
            }

            .matelas-categories-simple__title {
                font-size: 28px;
                font-weight: 1000;
                color: #0b1b3a;
                margin: 0 0 10px;
                letter-spacing: -.03em
            }

            .matelas-categories-simple__desc {
                font-size: 14px;
                color: #64748b;
                margin: 0;
                font-weight: 700
            }

            .matelas-categories-simple__grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
                max-width: 1200px;
                margin: 0 auto
            }

            .matelas-category-simple-card {
                display: block;
                background: #fff;
                border-radius: 24px;
                overflow: hidden;
                border: 1px solid #e2e8f0;
                box-shadow: 0 12px 32px rgba(2, 6, 23, .06);
                transition: all .3s cubic-bezier(.4, 0, .2, 1);
                text-decoration: none;
                color: inherit
            }

            .matelas-category-simple-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 24px 56px rgba(2, 6, 23, .12);
                border-color: rgba(255, 58, 127, .25)
            }

            .matelas-category-simple-card__media {
                position: relative;
                aspect-ratio: 1;
                background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
                overflow: hidden
            }

            .matelas-category-simple-card__media img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                transition: transform .5s cubic-bezier(.4, 0, .2, 1)
            }

            .matelas-category-simple-card:hover .matelas-category-simple-card__media img {
                transform: scale(1.08)
            }

            .matelas-category-simple-card__placeholder {
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 48px;
                font-weight: 1000;
                color: #0b1b3a;
                opacity: .2
            }

            .matelas-category-simple-card__badge {
                position: absolute;
                bottom: 14px;
                right: 14px;
                padding: 8px 16px;
                border-radius: 999px;
                background: linear-gradient(135deg, #ff3a7f, #be185d);
                color: #fff;
                font-weight: 1000;
                font-size: 11px;
                letter-spacing: .02em;
                text-transform: uppercase;
                box-shadow: 0 8px 20px rgba(255, 58, 127, .35)
            }

            .matelas-category-simple-card__content {
                padding: 18px
            }

            .matelas-category-simple-card__name {
                margin: 0 0 6px;
                font-size: 17px;
                font-weight: 1000;
                color: #0b1b3a;
                letter-spacing: -.02em;
                line-height: 1.3
            }

            .matelas-category-simple-card__desc {
                margin: 0;
                font-size: 13px;
                font-weight: 700;
                color: #64748b;
                line-height: 1.5
            }

            .matelas-products-simple {
                padding: 100px 0;
                background: linear-gradient(180deg, #fff 0%, #f8fafc 100%);
            }

            .matelas-product-simple-card:hover {
                transform: none;
                box-shadow: none;
            }

            .matelas-product-simple-card:hover .matelas-product-simple-card__name {
                color: #0f172a;
            }

            .matelas-product-simple-card:hover .matelas-product-simple-card__media img {
                transform: none;
            }

            .matelas-product-simple-card:hover .matelas-product-simple-card__overlay {
                opacity: 0;
            }

            .matelas-product-simple-card__btn:hover {
                transform: none;
                box-shadow: none;
            }

            @media (max-width: 991px) {
                .matelas-hero-simple {
                    padding: 80px 0 60px
                }

                .matelas-hero-simple__title {
                    font-size: 36px
                }

                .matelas-hero-simple__stat strong {
                    font-size: 24px
                }

                .matelas-categories-simple__grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 16px
                }

                .matelas-products-simple__grid {
                    grid-template-columns: 1fr
                }
            }

            @media (max-width: 560px) {
                .matelas-hero-simple {
                    padding: 60px 0 50px
                }

                .matelas-hero-simple__title {
                    font-size: 30px
                }

                .matelas-hero-simple__stats {
                    gap: 16px
                }

                .matelas-hero-simple__stat strong {
                    font-size: 22px
                }

                .matelas-categories-simple__grid {
                    grid-template-columns: 1fr;
                    gap: 14px
                }

                .matelas-products-simple__grid {
                    grid-template-columns: 1fr
                }

                .matelas-category-simple-card__name {
                    font-size: 16px
                }
            }
        </style>

        @if ($isProtegeMatelas ?? false)
            <style>
                .protege-page {
                    --pm-rose: #ff3a7f;
                    --pm-navy: #0b1b3a;
                    --pm-ink: #071126;
                    --pm-sky: #6ee7ff;
                    --pm-border: #e2e8f0;
                    --pm-muted: #64748b;
                    --pm-bg: #f8fafc;
                    background: linear-gradient(180deg, #fff, var(--pm-bg));
                    min-height: 100vh
                }

                .protege-hero {
                    padding: 120px 0 80px;
                    background: linear-gradient(135deg, var(--pm-navy), #1e293b);
                    color: #fff;
                    position: relative;
                    overflow: hidden
                }

                .protege-hero::before {
                    content: "";
                    position: absolute;
                    inset: -2px;
                    background: radial-gradient(800px 400px at 25% 30%, rgba(255, 58, 127, .15), rgba(255, 58, 127, 0) 55%), radial-gradient(800px 500px at 75% 20%, rgba(110, 231, 255, .12), rgba(110, 231, 255, 0) 60%);
                    pointer-events: none
                }

                .protege-hero__inner {
                    max-width: 900px;
                    margin: 0 auto;
                    text-align: center;
                    position: relative
                }

                .protege-hero__title {
                    font-size: 42px;
                    font-weight: 1000;
                    letter-spacing: -.04em;
                    margin: 0 0 12px;
                    line-height: 1.08;
                    color: #fff
                }

                .protege-hero__subtitle {
                    font-size: 14px;
                    color: rgba(241, 245, 249, .88);
                    max-width: 60ch;
                    margin: 0 auto;
                    font-weight: 700;
                    line-height: 1.6
                }

                .protege-hero__badge {
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    padding: 10px 18px;
                    border-radius: 999px;
                    background: rgba(255, 58, 127, .15);
                    border: 1px solid rgba(255, 58, 127, .3);
                    font-weight: 900;
                    font-size: 12px;
                    letter-spacing: .08em;
                    text-transform: uppercase;
                    margin-bottom: 20px
                }

                .protege-hero__badge i {
                    width: 8px;
                    height: 8px;
                    border-radius: 999px;
                    background: var(--pm-rose);
                    box-shadow: 0 0 12px rgba(255, 58, 127, .5)
                }

                .protege-categories {
                    padding: 60px 0
                }

                .protege-categories__grid {
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                    gap: 20px;
                    max-width: 1200px;
                    margin: 0 auto
                }

                .protege-category-card {
                    display: block;
                    background: #fff;
                    border-radius: 24px;
                    overflow: hidden;
                    border: 1px solid var(--pm-border);
                    box-shadow: 0 12px 32px rgba(2, 6, 23, .06);
                    transition: all .3s cubic-bezier(.4, 0, .2, 1);
                    text-decoration: none;
                    color: inherit
                }

                .protege-category-card:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 24px 56px rgba(2, 6, 23, .12);
                    border-color: rgba(255, 58, 127, .25)
                }

                .protege-category-card__media {
                    position: relative;
                    aspect-ratio: 1;
                    background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
                    overflow: hidden
                }

                .protege-category-card__media img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                    transition: transform .5s cubic-bezier(.4, 0, .2, 1)
                }

                .protege-category-card:hover .protege-category-card__media img {
                    transform: scale(1.1)
                }

                .protege-category-card__badge {
                    position: absolute;
                    bottom: 14px;
                    right: 14px;
                    padding: 8px 16px;
                    border-radius: 999px;
                    background: linear-gradient(135deg, var(--pm-rose), #be185d);
                    color: #fff;
                    font-weight: 1000;
                    font-size: 11px;
                    letter-spacing: .02em;
                    text-transform: uppercase;
                    box-shadow: 0 8px 20px rgba(255, 58, 127, .35)
                }

                .protege-category-card__content {
                    padding: 18px
                }

                .protege-category-card__name {
                    margin: 0 0 6px;
                    font-size: 17px;
                    font-weight: 1000;
                    color: var(--pm-ink);
                    letter-spacing: -.02em;
                    line-height: 1.3
                }

                .protege-category-card__desc {
                    margin: 0;
                    font-size: 13px;
                    font-weight: 700;
                    color: #64748b;
                    line-height: 1.5
                }

                .protege-products {
                    padding: 60px 0 80px
                }

                .protege-products__head {
                    max-width: 1200px;
                    margin: 0 auto 30px;
                    padding: 24px;
                    border-radius: 24px;
                    background: linear-gradient(180deg, rgba(11, 27, 58, .04), rgba(11, 27, 58, 0));
                    border: 1px solid rgba(226, 232, 240, .85)
                }

                .protege-products__title {
                    margin: 0 0 6px;
                    font-size: 26px;
                    font-weight: 1000;
                    color: var(--pm-ink);
                    letter-spacing: -.03em
                }

                .protege-products__desc {
                    margin: 0;
                    font-size: 14px;
                    font-weight: 700;
                    color: #64748b
                }

                .protege-products__grid {
                    display: grid;
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    gap: 18px;
                    max-width: 1200px;
                    margin: 0 auto
                }

                .protege-product-card {
                    background: #fff;
                    border-radius: 22px;
                    overflow: hidden;
                    border: 1px solid var(--pm-border);
                    box-shadow: 0 12px 32px rgba(2, 6, 23, .06);
                    transition: all .3s cubic-bezier(.4, 0, .2, 1)
                }

                .protege-product-card:hover {
                    transform: translateY(-4px);
                    box-shadow: 0 20px 48px rgba(2, 6, 23, .1)
                }

                .protege-product-card__media {
                    aspect-ratio: 1;
                    background: linear-gradient(135deg, #f8fafc, #f1f5f9)
                }

                .protege-product-card__media img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block
                }

                .protege-product-card__body {
                    padding: 16px
                }

                .protege-product-card__name {
                    font-weight: 1000;
                    color: var(--pm-ink);
                    margin: 0 0 8px;
                    font-size: 15px;
                    line-height: 1.3
                }

                .protege-product-card__price {
                    font-weight: 1000;
                    color: var(--pm-rose);
                    font-size: 18px;
                    margin-bottom: 12px
                }

                .protege-product-card__btn {
                    width: 100%;
                    padding: 12px;
                    border-radius: 999px;
                    background: linear-gradient(135deg, var(--pm-rose), #ff2e72);
                    color: #fff;
                    font-weight: 1000;
                    border: 0;
                    cursor: pointer;
                    transition: all .2s
                }

                .protege-product-card__btn:hover {
                    filter: brightness(1.08);
                    transform: scale(1.02)
                }

                @media (max-width: 991px) {
                    .protege-hero {
                        padding: 100px 0 60px
                    }

                    .protege-hero__title {
                        font-size: 36px
                    }

                    .protege-categories__grid {
                        grid-template-columns: repeat(2, 1fr);
                        gap: 16px
                    }

                    .protege-products__grid {
                        grid-template-columns: repeat(2, minmax(0, 1fr))
                    }
                }

                @media (max-width: 560px) {
                    .protege-hero {
                        padding: 80px 0 50px
                    }

                    .protege-hero__title {
                        font-size: 30px
                    }

                    .protege-categories__grid {
                        grid-template-columns: 1fr;
                        gap: 14px
                    }

                    .protege-products__grid {
                        grid-template-columns: 1fr
                    }

                    .protege-category-card__name {
                        font-size: 16px
                    }
                }
            </style>

            <section class="protege-hero">
                <div class="container">
                    <div class="protege-hero__inner" data-reveal>
                        <div class="protege-hero__badge"><i></i>Protection & Confort</div>
                        <h1 class="protege-hero__title">Protégez votre matelas avec style</h1>
                        <p class="protege-hero__subtitle">Découvrez notre gamme de protections de matelas alliant qualité,
                            confort et design pour prolonger la durée de vie de votre literie.</p>
                    </div>
                </div>
            </section>

            <section class="protege-categories">
                <div class="container">
                    <div class="protege-categories__grid">
                        @php
                            $protegeCategories = [
                                ['name' => 'Alèses', 'desc' => 'Protection imperméable', 'count' => $products->total()],
                                ['name' => 'Housses', 'desc' => 'Design élégant', 'count' => $products->total()],
                                [
                                    'name' => 'Surmatelas',
                                    'desc' => 'Confort additionnel',
                                    'count' => $products->total(),
                                ],
                                ['name' => 'Taies', 'desc' => 'Finition parfaite', 'count' => $products->total()],
                            ];
                        @endphp
                        @foreach ($protegeCategories as $category)
                            <a href="#" class="protege-category-card" style="text-decoration:none;color:inherit">
                                <div class="protege-category-card__media">
                                    @if ($products->first()?->image)
                                        <img src="@image_url($products->first()->image)" alt="{{ $category['name'] }}" loading="lazy" />
                                    @else
                                        <div
                                            style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,rgba(255,58,127,.1),rgba(110,231,255,.1))">
                                            <span
                                                style="font-size:40px;font-weight:1000;color:var(--pm-navy);opacity:.3">{{ $category['name'][0] }}</span>
                                        </div>
                                    @endif
                                    <div class="protege-category-card__badge">{{ $category['count'] }} produits</div>
                                </div>
                                <div class="protege-category-card__content">
                                    <h3 class="protege-category-card__name">{{ $category['name'] }}</h3>
                                    <p class="protege-category-card__desc">{{ $category['desc'] }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="protege-products">
                <div class="container">
                    <div class="protege-products__head">
                        <h2 class="protege-products__title">Tous nos produits</h2>
                        <p class="protege-products__desc">{{ $products->total() }} protections disponibles</p>
                    </div>
                    <div class="protege-products__grid">
                        @foreach ($products as $product)
                            @php
                                $defaultVariant = $product?->variants?->sortBy('price')->first();
                                $price = $defaultVariant?->price ?? $product->price;
                            @endphp
                            <article class="protege-product-card">
                                <a href="{{ route('product.show', $product->slug) }}"
                                    style="text-decoration:none;color:inherit">
                                    <div class="protege-product-card__media">
                                        <img src="@image_url($product->image)" alt="{{ $product->name }}" loading="lazy" />
                                    </div>
                                </a>
                                <div class="protege-product-card__body">
                                    <a href="{{ route('product.show', $product->slug) }}"
                                        style="text-decoration:none;color:inherit">
                                        <h3 class="protege-product-card__name">{{ $product->name }}</h3>
                                    </a>
                                    <div class="protege-product-card__price">
                                        {{ $price !== null ? number_format((float) $price, 0, ',', '.') . 'F' : '' }}</div>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="product_variant_id"
                                            value="{{ $defaultVariant?->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="protege-product-card__btn" type="submit">Ajouter au
                                            panier</button>
                                    </form>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    @if (method_exists($products, 'links'))
                        <div style="margin-top:30px;text-align:center">
                            {{ $products->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </section>
        @endif

        <script>
            (function() {
                const tabButtons = Array.from(document.querySelectorAll('[data-tab]'));
                const tabPanels = Array.from(document.querySelectorAll('[data-tab-panel]'));
                tabButtons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const key = btn.getAttribute('data-tab');
                        tabButtons.forEach(b => {
                            const isActive = (b === btn);
                            b.classList.toggle('is-active', isActive);
                            b.setAttribute('aria-selected', isActive ? 'true' : 'false');
                            b.setAttribute('tabindex', isActive ? '0' : '-1');
                        });
                        tabPanels.forEach(p => p.classList.toggle('is-active', p.getAttribute(
                            'data-tab-panel') === key));
                    });
                });

                const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                const revealEls = Array.from(document.querySelectorAll('[data-reveal]'));
                if (revealEls.length) {
                    if (prefersReduced || !('IntersectionObserver' in window)) {
                        revealEls.forEach(el => el.classList.add('is-revealed'));
                    } else {
                        const io = new IntersectionObserver((entries, obs) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting) {
                                    entry.target.classList.add('is-revealed');
                                    obs.unobserve(entry.target);
                                }
                            });
                        }, {
                            root: null,
                            rootMargin: '0px 0px -8% 0px',
                            threshold: 0.12
                        });
                        revealEls.forEach(el => io.observe(el));
                    }
                }

                const modal = document.getElementById('matelasQuickAdd');
                const form = document.getElementById('quickForm');
                const title = document.getElementById('quickTitle');
                const img = document.getElementById('quickImage');
                const pid = document.getElementById('quickProductId');
                const vid = document.getElementById('quickVariantId');
                const thick = document.getElementById('quickThickness');
                const places = document.getElementById('quickPlaces');
                const price = document.getElementById('quickPrice');
                const link = document.getElementById('quickLink');
                const whats = document.getElementById('quickWhats');

                const WHATSAPP_NUMBER = '{{ whatsapp_number() }}';

                let currentVariants = [];

                function money(v) {
                    try {
                        return (Number(v) || 0).toLocaleString('fr-FR', {
                            maximumFractionDigits: 0
                        }) + 'F';
                    } catch (e) {
                        return v + 'F';
                    }
                }

                function uniq(arr) {
                    return Array.from(new Set(arr.filter(v => v !== null && v !== undefined && v !== '')));
                }

                function renderOptions(select, values, fmt) {
                    select.innerHTML = '';
                    values.forEach(v => {
                        const opt = document.createElement('option');
                        opt.value = String(v);
                        opt.textContent = fmt ? fmt(v) : String(v);
                        select.appendChild(opt);
                    });
                }

                function findVariant(th, pl) {
                    const t = th === null ? null : String(th);
                    const p = pl === null ? null : String(pl);
                    return currentVariants.find(v => String(v.thickness_cm) === t && String(v.places) === p) || null;
                }

                function syncFromSelection() {
                    if (!currentVariants.length) {
                        vid.value = '';
                        price.textContent = '';
                        return;
                    }

                    let v = findVariant(thick.value, places.value);
                    if (!v) {
                        const first = currentVariants[0];
                        renderOptions(thick, uniq(currentVariants.map(x => x.thickness_cm)).sort((a, b) => Number(a) -
                            Number(b)), (x) => String(x) + ' cm');
                        renderOptions(places, uniq(currentVariants.map(x => x.places)).sort((a, b) => Number(a) - Number(
                            b)), (x) => String(x) + ' places');
                        thick.value = String(first.thickness_cm);
                        places.value = String(first.places);
                        v = first;
                    }

                    vid.value = String(v.id);
                    price.textContent = money(v.price);
                }

                function openModal(btn) {
                    const productId = btn.getAttribute('data-product-id');
                    const productName = btn.getAttribute('data-product-name') || 'Produit';
                    const productImage = btn.getAttribute('data-product-image') || '';
                    const productSlug = btn.getAttribute('data-product-slug') || '';
                    const variantsRaw = btn.getAttribute('data-variants') || '[]';

                    try {
                        currentVariants = JSON.parse(variantsRaw) || [];
                    } catch (e) {
                        currentVariants = [];
                    }

                    title.textContent = 'Ajouter — ' + productName;
                    img.src = productImage;
                    img.alt = productName;
                    pid.value = productId || '';
                    link.href = productSlug ? (window.location.origin + '/produit/' + productSlug) : '#';
                    whats.href = 'https://wa.me/' + WHATSAPP_NUMBER + '?text=' + encodeURIComponent(
                        'Bonjour, je veux commander ' + productName + '.');

                    if (!currentVariants.length) {
                        thick.innerHTML = '<option value="">—</option>';
                        places.innerHTML = '<option value="">—</option>';
                        vid.value = '';
                        price.textContent = '';
                    } else {
                        const thicknesses = uniq(currentVariants.map(v => v.thickness_cm)).sort((a, b) => Number(a) -
                            Number(b));
                        const placesList = uniq(currentVariants.map(v => v.places)).sort((a, b) => Number(a) - Number(b));
                        renderOptions(thick, thicknesses, (v) => String(v) + ' cm');
                        renderOptions(places, placesList, (v) => String(v) + ' places');
                        const cheapest = currentVariants.slice().sort((a, b) => Number(a.price) - Number(b.price))[0];
                        thick.value = String(cheapest.thickness_cm);
                        places.value = String(cheapest.places);
                        syncFromSelection();
                    }

                    modal.classList.add('is-open');
                    modal.setAttribute('aria-hidden', 'false');
                }

                function closeModal() {
                    modal.classList.remove('is-open');
                    modal.setAttribute('aria-hidden', 'true');
                }

                document.addEventListener('click', (e) => {
                    const btn = e.target.closest('[data-quick-add]');
                    if (btn) {
                        e.preventDefault();
                        openModal(btn);
                        return;
                    }
                    if (e.target.closest('[data-quick-close]')) {
                        e.preventDefault();
                        closeModal();
                    }
                });

                thick && thick.addEventListener('change', syncFromSelection);
                places && places.addEventListener('change', syncFromSelection);

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
                });

                if (form) {
                    form.addEventListener('submit', (e) => {
                        if (currentVariants.length && !vid.value) {
                            e.preventDefault();
                        }
                    });
                }
            })();
        </script>
    @else
        <section class="collection" aria-label="{{ $pageTitle }}">
            <div class="container">
                <div class="collection__header">
                    <div class="collection__intro">
                        <span class="collection__badge">📌 Menu</span>
                        <h1 class="collection__title">{{ $pageTitle }}</h1>
                        <p class="collection__subtitle">Découvrez tous les produits disponibles pour cette rubrique.</p>
                    </div>
                </div>

                @if (($products ?? collect())->isEmpty())
                    <div style="padding:24px;border:1px solid #e2e8f0;border-radius:16px;background:#fff">
                        Aucun produit trouvé.
                    </div>
                @endif

                <div class="collection__grid">
                    @foreach ($products ?? collect() as $product)
                        @php
                            $isFeatured = (bool) ($product->is_bestseller ?? false);
                            $tag = $product->firmness ? strtoupper(str_replace('_', '-', $product->firmness)) : null;
                            $specsParts = [];
                            if (!empty($product->size)) {
                                $specsParts[] = $product->size;
                            }
                            if (!empty($product->thickness)) {
                                $specsParts[] = 'Ép. ' . $product->thickness;
                            }
                            if (!empty($product->material)) {
                                $specsParts[] = $product->material;
                            }
                            $specs = implode(' • ', $specsParts);
                        @endphp

                        <article class="collection-card{{ $isFeatured ? ' collection-card--featured' : '' }}">
                            @if ($isFeatured)
                                <div class="collection-card__badge">Best Seller</div>
                            @endif

                            <a href="{{ route('product.show', $product->slug) }}"
                                style="text-decoration:none;color:inherit">
                                <div class="collection-card__media">
                                    <img src="@image_url($product->image)" alt="{{ $product->name }}" loading="lazy" />
                                    @if ($tag)
                                        <span class="collection-card__tag">{{ $tag }}</span>
                                    @endif
                                </div>
                            </a>

                            <div class="collection-card__body">
                                <div class="collection-card__rating">
                                    <span class="collection-card__stars">★★★★★</span>
                                    <span class="collection-card__reviews">({{ (int) ($product->reviews_count ?? 0) }}
                                        avis)</span>
                                </div>

                                <a href="{{ route('product.show', $product->slug) }}"
                                    style="text-decoration:none;color:inherit">
                                    <h2 class="collection-card__name">{{ $product->name }}</h2>
                                </a>

                                @if ($specs)
                                    <p class="collection-card__specs">{{ $specs }}</p>
                                @else
                                    <p class="collection-card__specs">&nbsp;</p>
                                @endif

                                <div class="collection-card__footer">
                                    <span
                                        class="collection-card__price">{{ number_format((float) $product->price, 0, ',', '.') }}<small>F</small></span>

                                    <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="collection-card__btn" type="submit"
                                            aria-label="Ajouter au panier">
                                            <svg viewBox="0 0 24 24" width="18" height="18">
                                                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2"
                                                    fill="none" stroke-linecap="round" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if (method_exists($products, 'links'))
                    <div class="univers-pagination" style="margin-top: 24px">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </section>
    @endif
@endsection
