<?php

return [
    'site_name' => 'Mobilier Addict',
    'site_phone' => '+225 07 99 14 03 56',
    'site_email' => 'contact@mobilier-addict.local',

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
            ['pages.about', 'Centre de presse'],
            ['blog.index', 'Notre magazine'],
            ['pages.about', 'Notre groupe'],
            ['pages.contact', 'Travailler avec nous'],
        ],
        'shopping' => [
            ['collection.index', 'Catalogue des marques'],
            ['collection.index', 'Codes promo'],
            ['menu.show:lit-canape', 'Mobilier'],
            ['category.show:canapes', 'Canapé'],
            ['category.show:fauteuil', 'Fauteuil'],
        ],
        'help' => [
            ['pages.faq', 'Questions fréquentes'],
            ['pages.privacy', 'Politique de confidentialité'],
            ['pages.contact', 'Assistance'],
            ['pages.contact', 'Contact'],
        ],
        'legal' => [
            ['pages.privacy', 'Politique de confidentialité'],
            ['pages.cgv', 'Conditions générales'],
        ],
    ],
];
