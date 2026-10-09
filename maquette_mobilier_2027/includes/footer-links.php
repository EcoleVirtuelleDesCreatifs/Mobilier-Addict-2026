<?php
$footerMenus = [
    'about' => [
        ['about-us.php', 'À propos de nous'],
        ['presse.php', 'Centre de presse'],
        ['blog.php', 'Notre magazine'],
        ['notre-groupe.php', 'Notre groupe'],
        ['recrutement.php', 'Travailler avec nous'],
    ],
    'shopping' => [
        ['marques.php', 'Catalogue des marques'],
        ['codes-promo.php', 'Codes promo'],
        ['mobilier.php', 'Mobilier'],
        ['canapes.php', 'Canapé'],
        ['fauteuils.php', 'Fauteuil'],
    ],
    'help' => [
        ['faq.php', 'Questions fréquentes'],
        ['confidentialite.php', 'Politique de confidentialité'],
        ['assistance.php', 'Assistance'],
        ['contact.php', 'Contact'],
    ],
    'legal' => [
        ['confidentialite.php', 'Politique de confidentialité'],
        ['conditions-generales.php', 'Conditions générales'],
    ],
];
foreach ($footerMenus[$footerGroup] ?? [] as [$url, $label]): ?>
    <li class="footer-menu-item"><a href="<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>"<?= basename($_SERVER['SCRIPT_NAME'] ?? '') === $url ? ' aria-current="page"' : '' ?>><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></a></li>
<?php endforeach; unset($footerGroup); ?>
