<?php

return [
    'site_name' => 'Mobilier Addict',
    'site_phone' => '+225 07 99 14 03 56',
    'site_email' => 'contact@mobilier-addict.local',

    // Mentions légales — à compléter par la direction (audit légal).
    'legal' => [
        'company_name' => 'Mobilier Addict',
        'legal_form' => null,   // ex : SARL, SAS
        'rccm' => null,         // ex : CI-ABJ-2024-X-XXXXX
        'tax_id' => null,       // compte contribuable
        'address' => null,      // siège social précis (commune, repère)
        'phone' => '+225 07 99 14 03 56',
        'host' => null,         // nom + coordonnées de l'hébergeur
    ],

    // Statistiques visiteurs de l'admin : seules les visites de ce pays sont comptées
    // (code ISO à 2 lettres). Mettre une valeur vide pour compter tous les pays.
    'analytics_country' => env('ANALYTICS_COUNTRY', 'CI'),
    'analytics_country_name' => env('ANALYTICS_COUNTRY_NAME', "Côte d'Ivoire"),

    // Page contact — à compléter par la direction (audit confiance).
    'contact' => [
        // Renseigner dans .env (SEO local : affiché sur le site + données structurées).
        'address' => env('CONTACT_ADDRESS'),            // ex : « Angré 8e tranche, Cocody, Abidjan »
        'hours' => env('CONTACT_HOURS'),                // ex : « Lun–Sam : 9h–18h »
        'hours_schema' => env('CONTACT_HOURS_SCHEMA'),  // même horaire au format Google : « Mo-Sa 09:00-18:00 »
        'maps_url' => env('GOOGLE_BUSINESS_URL'),       // lien de la fiche Google Business Profile
    ],

    'menu_items' => [
        ['slug' => 'index',               'label' => 'Accueil',                 'url' => 'home'],
        ['slug' => 'matelas',             'label' => 'Matelas',                 'url' => 'menu.show:matelas'],
        ['slug' => 'oreillers-et-taies',  'label' => 'Oreillers et taies',      'url' => 'menu.show:oreillers-et-taies'],
        ['slug' => 'drap-et-couettes',    'label' => 'Drap et Couettes',        'url' => 'menu.show:drap-et-couettes'],
        ['slug' => 'mobilier-accessoire', 'label' => 'Mobiliers &amp; Accessoires', 'url' => 'menu.show:lit-canape'],
        ['slug' => 'electromenager',      'label' => 'Électroménager',          'url' => 'menu.show:electromenager'],
        ['slug' => 'conseils',            'label' => 'Conseils',                'url' => 'blog.index'],
        ['slug' => 'contact',             'label' => 'Contact',                 'url' => 'pages.contact'],
    ],

    'footer_menus' => [
        'about' => [
            ['pages.about', 'À propos de nous'],
            ['blog.index', 'Notre magazine'],
            ['pages.contact', 'Nous contacter'],
        ],
        'shopping' => [
            ['collection.index', 'Tous nos produits'],
            ['nouveautes.index', 'Nouveautés'],
            ['menu.show:matelas', 'Matelas'],
            ['devis.create', 'Devis sur-mesure'],
        ],
        'help' => [
            ['pages.faq', 'Questions fréquentes'],
            ['pages.shipping-returns', 'Livraison & retours'],
            ['pages.customer-service', 'Service client'],
            ['pages.contact', 'Contact'],
        ],
        'legal' => [
            ['pages.privacy', 'Politique de confidentialité'],
            ['pages.cgv', 'Conditions générales'],
        ],
    ],
];
