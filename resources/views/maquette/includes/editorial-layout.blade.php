<?php
$editorialPages = require __DIR__ . '/editorial-data.php';
$page = $editorialPages[$pageKey] ?? null;
if ($page === null) {
    http_response_code(404);
    exit('Page introuvable.');
}
$escape = static function ($value) { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); };
?>
<!doctype html>
<html lang="fr" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $escape($page['title']) ?> | Mobilier Addict Côte d’Ivoire</title>
    <meta name="description" content="<?= $escape($page['intro']) ?>">
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
</head>
<body class="editorial-site">
    <a class="editorial-skip" href="#MainContent">Aller au contenu</a>
    <div class="body-wrapper">
        <div class="announcement-bar bg-1 py-2">
            <div class="container text-center"><a class="announcement-text text-white" href="tel:+2250799140356">Mobilier Addict · Côte d’Ivoire · +225 07 99 14 03 56</a></div>
        </div>
        <?php include __DIR__ . '/header.php'; ?>
        <nav class="breadcrumb" aria-label="Fil d’Ariane">
            <div class="container">
                <ol class="list-unstyled d-flex align-items-center m-0">
                    <li><a href="index.php">Accueil</a></li>
                    <li aria-current="page"><?= $escape($page['title']) ?></li>
                </ol>
            </div>
        </nav>
        <main id="MainContent" class="editorial-page" tabindex="-1">
            <div class="container">
                <header class="editorial-intro">
                    <p class="editorial-kicker"><?= $escape($page['kicker']) ?></p>
                    <h1><?= $escape($page['title']) ?></h1>
                    <p class="editorial-lead"><?= $escape($page['intro']) ?></p>
                </header>
                <?php if (isset($page['notice'])): ?>
                    <p class="editorial-notice"><?= $escape($page['notice']) ?></p>
                <?php endif; ?>
                <div class="editorial-layout">
                    <div class="editorial-article">
                        <?php if (isset($page['image'])): ?>
                            <figure class="editorial-image">
                                <img loading="lazy" decoding="async" src="<?= $escape($page['image']) ?>" alt="Inspiration pour l’aménagement de la maison" width="1000" height="600">
                                <figcaption>Image d’ambiance, non contractuelle.</figcaption>
                            </figure>
                        <?php endif; ?>
                        <?php foreach ($page['sections'] as $index => $section): ?>
                            <section class="editorial-section" id="<?= $escape($section['id'] ?? 'section-' . ($index + 1)) ?>">
                                <h2><?= $escape($section['title']) ?></h2>
                                <p><?= $escape($section['text']) ?></p>
                            </section>
                        <?php endforeach; ?>
                        <nav class="editorial-links" aria-label="Pour aller plus loin">
                            <?php foreach ($page['links'] as [$url, $label]): ?>
                                <a href="<?= $escape($url) ?>"><?= $escape($label) ?> <span aria-hidden="true">→</span></a>
                            <?php endforeach; ?>
                        </nav>
                    </div>
                    <aside class="editorial-aside" aria-label="Repères et contact">
                        <p class="editorial-kicker">Sur cette page</p>
                        <nav aria-label="Sommaire"><ol>
                            <?php foreach ($page['sections'] as $index => $section): ?>
                                <li><a href="#<?= $escape($section['id'] ?? 'section-' . ($index + 1)) ?>"><?= $escape($section['title']) ?></a></li>
                            <?php endforeach; ?>
                        </ol></nav>
                        <div class="editorial-help">
                            <h2>Parlons de votre besoin</h2>
                            <p>Une référence, une question ou un projet d’aménagement ? Contactez la boutique.</p>
                            <a href="tel:+2250799140356">+225 07 99 14 03 56</a>
                            <a href="{{ route('pages.contact') }}">Informations de contact →</a>
                        </div>
                    </aside>
                </div>
            </div>
        </main>
        <footer class="editorial-footer">
            <div class="container">
                <div class="editorial-footer-grid">
                    <?php foreach (['about' => 'À propos', 'shopping' => 'Achats', 'help' => 'Aide'] as $footerGroup => $heading): ?>
                        <nav aria-label="<?= $escape($heading) ?>">
                            <h2><?= $escape($heading) ?></h2>
                            <ul class="list-unstyled"><?php include __DIR__ . '/footer-links.php'; ?></ul>
                        </nav>
                    <?php endforeach; ?>
                    <div>
                        <a class="editorial-footer-brand" href="index.php">Mobilier Addict</a>
                        <p>Mobilier, literie et équipement de la maison en Côte d’Ivoire.</p>
                        <a href="tel:+2250799140356">+225 07 99 14 03 56</a>
                        <p><a href="{{ route('pages.contact') }}">Contacter la boutique →</a></p>
                    </div>
                </div>
                <div class="editorial-footer-bottom">
                    <ul class="list-unstyled"><?php $footerGroup = 'legal'; include __DIR__ . '/footer-links.php'; ?></ul>
                    <p>© <?= date('Y') ?> Mobilier Addict.</p>
                </div>
            </div>
        </footer>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="drawer-menu" aria-labelledby="editorial-menu-title">
            <div class="offcanvas-header">
                <h2 id="editorial-menu-title" class="heading_18">Nos univers</h2>
                <button class="btn-close" type="button" data-bs-dismiss="offcanvas" aria-label="Fermer le menu"></button>
            </div>
            <div class="offcanvas-body">
                <nav class="site-navigation"><?php $menu_mobile = true; include __DIR__ . '/menu.php'; ?></nav>
            </div>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="drawer-cart" aria-labelledby="editorial-cart-title">
            <div class="offcanvas-header">
                <h2 id="editorial-cart-title" class="heading_18">Votre sélection</h2>
                <button class="btn-close" type="button" data-bs-dismiss="offcanvas" aria-label="Fermer le panier"></button>
            </div>
            <div class="offcanvas-body">
                <p>Les disponibilités, les prix et les modalités de commande sont à confirmer auprès de la boutique.</p>
                <a href="cart.php">Consulter la page panier →</a>
            </div>
        </div>
    </div>
    <script src="assets/js/vendor.js" defer></script>
    <script src="assets/js/main.min.js" defer></script>
</body>
</html>
