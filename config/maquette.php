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

    // Page contact — à compléter par la direction (audit confiance).
    'contact' => [
        'address' => null,      // ex : « Angré, Cocody — près de la station X, Abidjan »
        'hours' => null,        // ex : « Lun–Sam : 9h–18h »
        'maps_url' => null,     // lien Google Maps / fiche Google Business Profile
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
