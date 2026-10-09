<?php
/**
 * Rendu du menu principal.
 * Variables optionnelles avant l'include :
 *   $menu_class   : classes CSS ajoutées au <ul> (ex. 'justify-content-center')
 *   $menu_mobile  : true pour le drawer mobile (classe active aussi sur le <a>)
 *   $menu_active  : slug de l'entrée active (auto-détecté via le nom du script)
 *   $menu_list    : liste d'entrées alternative (ex. $menu_categories)
 */
require_once __DIR__ . '/config.php';

$menu_class  = $menu_class  ?? '';
$menu_mobile = $menu_mobile ?? false;
$menu_active = $menu_active ?? pathinfo(basename($_SERVER['PHP_SELF']), PATHINFO_FILENAME);
$_items      = $menu_list   ?? $menu_items;
$_link_class = 'nav-link' . (isset($menu_link_class) ? ' ' . $menu_link_class : '');
?>
<ul class="main-menu list-unstyled<?= $menu_class !== '' ? ' ' . $menu_class : '' ?>">
<?php foreach ($_items as $item):
    $active = $menu_active === $item['slug']; ?>
    <li class="menu-list-item nav-item<?= $active ? ' active' : '' ?>">
        <a class="<?= $_link_class ?><?= $active && $menu_mobile ? ' active' : '' ?>" href="<?= $item['url'] ?>"> <?= $item['label'] ?> </a>
    </li>
<?php endforeach; ?>
</ul>
<?php unset($menu_class, $menu_mobile, $menu_link_class, $menu_list, $menu_active); ?>
