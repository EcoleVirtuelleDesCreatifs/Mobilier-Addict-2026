<?php
/**
 * Configuration globale du site Mobilier Addict (maquette)
 */

$site_name  = 'Mobilier Addict';
$site_phone = '+225 07 99 14 03 56';
$site_email = 'contact@mobilier-addict.local';

// Menu principal : slug = nom du fichier cible (sert à l'état "actif")
$menu_items = [
    ['slug' => 'index',               'label' => 'Accueil',                 'url' => 'index.php'],
    ['slug' => 'matelas',             'label' => 'Matelas',                 'url' => 'matelas.php'],
    ['slug' => 'oreillers-et-taies',  'label' => 'Oreillers et taies',      'url' => 'oreillers-et-taies.php'],
    ['slug' => 'drap-et-couettes',    'label' => 'Drap et Couettes',        'url' => 'drap-et-couettes.php'],
    ['slug' => 'mobilier-accessoire', 'label' => 'Mobiliers &amp; Accessoires', 'url' => 'mobilier-accessoire.php'],
    ['slug' => 'electromenager',      'label' => 'Électroménager',          'url' => 'electromenager.php'],
    ['slug' => 'conseils',            'label' => 'Conseils',                'url' => 'conseils.php'],
    ['slug' => 'contact',             'label' => 'Contact',                 'url' => 'contact.php'],
];

// Catégories produits uniquement (sans "Accueil")
$menu_categories = array_slice($menu_items, 1);
