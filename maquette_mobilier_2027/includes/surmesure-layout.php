<?php
$smPages = require __DIR__ . '/surmesure-data.php';
$page = $smPages[$smKey] ?? null;
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
    <title><?= $escape($page['title']) ?> — Sur-mesure | Mobilier Addict Côte d’Ivoire</title>
    <meta name="description" content="<?= $escape($page['lead']) ?>">
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
    <style>
        .smp-site { --smp-navy: #00234d; --smp-pink: #d8327f; --smp-pale: #fdf2f8; font-family: 'Poppins', Arial, sans-serif; }
        .smp-site h1, .smp-site h2, .smp-site h3, .smp-site p, .smp-site a, .smp-site span, .smp-site li, .smp-site em, .smp-site strong { font-family: 'Poppins', Arial, sans-serif; }
        .smp-site a:focus-visible, .smp-site button:focus-visible { outline: 3px solid var(--smp-pink); outline-offset: 4px; border-radius: 4px; }
        .smp-hero { background: radial-gradient(circle at 85% 8%, rgba(216,50,127,.35), rgba(216,50,127,0) 48%), linear-gradient(120deg, #00234d 0%, #0b3059 60%, #123e6d 100%); color: #fff; padding: 72px 0 80px; }
        .smp-hero-grid { display: grid; grid-template-columns: minmax(0,1.08fr) minmax(0,.92fr); gap: 56px; align-items: center; }
        .smp-kicker { display: inline-block; color: #f2a6cc; font-size: 12px; font-weight: 600; letter-spacing: 1.8px; text-transform: uppercase; margin-bottom: 18px; }
        .smp-hero h1 { font-size: clamp(34px, 4.4vw, 56px); line-height: 1.12; letter-spacing: -1.5px; font-weight: 600; color: #fff; margin: 0 0 20px; }
        .smp-hero .smp-lead { color: #dbe4f0; font-size: 16px; line-height: 1.9; }
        .smp-hero-actions { display: flex; flex-wrap: wrap; gap: 14px; margin-top: 30px; }
        .smp-btn { display: inline-flex; align-items: center; gap: 10px; padding: 15px 26px; border-radius: 999px; font-size: 14px; font-weight: 600; text-decoration: none; transition: transform .2s ease, box-shadow .2s ease, background-color .2s ease, color .2s ease; }
        .smp-btn-primary { background: var(--smp-pink); color: #fff; box-shadow: 0 8px 22px rgba(216,50,127,.4); }
        .smp-btn-primary:hover { background: #fff; color: var(--smp-navy); transform: translateY(-2px); }
        .smp-btn-ghost { border: 1px solid rgba(255,255,255,.45); color: #fff; }
        .smp-btn-ghost:hover { background: rgba(255,255,255,.12); color: #fff; }
        .smp-badges { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 28px; }
        .smp-badge { border: 1px solid rgba(255,255,255,.3); border-radius: 999px; padding: 7px 16px; font-size: 12px; color: #e6edf6; }
        .smp-hero-media { position: relative; }
        .smp-hero-media::before { content: ''; position: absolute; inset: 18px -18px -18px 18px; border: 2px solid var(--smp-pink); border-radius: 22px; z-index: 0; }
        .smp-hero-media img { position: relative; z-index: 1; width: 100%; aspect-ratio: 5/4; object-fit: cover; border-radius: 18px; box-shadow: 0 28px 60px rgba(0,0,0,.35); display: block; }
        .smp-hero-tag { position: absolute; z-index: 2; left: -14px; bottom: 22px; background: #fff; color: var(--smp-navy); border-radius: 14px; padding: 14px 20px; box-shadow: 0 14px 34px rgba(0,0,0,.3); }
        .smp-hero-tag strong { display: block; font-size: 15px; font-weight: 600; }
        .smp-hero-tag span { font-size: 12px; color: #5a6675; }
        .smp-story { padding: 76px 0 14px; text-align: center; }
        .smp-story .smp-story-inner { max-width: 780px; margin: 0 auto; }
        .smp-sec-kicker { color: var(--smp-pink); font-size: 12px; font-weight: 600; letter-spacing: 1.6px; text-transform: uppercase; margin-bottom: 14px; }
        .smp-story h2 { color: var(--smp-navy); font-size: clamp(26px, 3vw, 38px); line-height: 1.25; letter-spacing: -.8px; font-weight: 600; margin-bottom: 20px; }
        .smp-story p { color: #4a5563; line-height: 1.95; font-size: 15.5px; }
        .smp-modeles { padding: 64px 0 30px; }
        .smp-modeles-head { display: flex; align-items: flex-end; justify-content: space-between; gap: 32px; margin-bottom: 36px; }
        .smp-modeles h2, .smp-equip h2 { color: var(--smp-navy); font-size: clamp(24px, 2.6vw, 34px); letter-spacing: -.6px; font-weight: 600; margin: 0; }
        .smp-modeles-sub { color: #5a6675; max-width: 480px; line-height: 1.8; font-size: 14px; margin: 0; }
        .smp-modeles-grid { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 24px; }
        .smp-modele { position: relative; background: #fff; border: 1px solid #eceef1; border-radius: 18px; overflow: hidden; transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease; }
        .smp-modele:hover { transform: translateY(-6px); border-color: var(--smp-pink); box-shadow: 0 18px 40px rgba(0,35,77,.14); }
        .smp-modele-img { position: relative; }
        .smp-modele-img img { width: 100%; aspect-ratio: 4/3; object-fit: cover; display: block; transition: transform .5s ease; }
        .smp-modele:hover .smp-modele-img img { transform: scale(1.06); }
        .smp-modele-num { position: absolute; top: 16px; left: 16px; z-index: 1; background: var(--smp-pink); color: #fff; font-size: 12px; font-weight: 600; letter-spacing: 1px; padding: 6px 14px; border-radius: 999px; }
        .smp-modele-body { padding: 24px 26px 28px; }
        .smp-modele h3 { color: var(--smp-navy); font-size: 19px; font-weight: 600; margin: 0 0 10px; }
        .smp-modele p { color: #5a6675; font-size: 13px; line-height: 1.8; margin: 0; }
        .smp-equip { background: var(--smp-pale); padding: 70px 0; margin-top: 50px; }
        .smp-equip-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-top: 32px; }
        .smp-equip-item { display: block; background: #fff; border: 1px solid #f0dbe7; border-radius: 14px; padding: 22px 24px; color: inherit; transition: border-color .2s, transform .2s; }
        .smp-equip-item:hover { border-color: var(--smp-pink); transform: translateY(-3px); color: inherit; text-decoration: none; }
        .smp-equip-item strong { display: block; color: var(--smp-navy); font-size: 15px; font-weight: 600; margin-bottom: 8px; }
        .smp-equip-item span { color: #5a6675; font-size: 12.5px; line-height: 1.7; display: block; }
        .smp-equip-item em { display: inline-block; margin-top: 12px; color: var(--smp-pink); font-style: normal; font-size: 12px; font-weight: 600; }
        .smp-gros { padding: 80px 0; }
        .smp-gros-card { display: grid; grid-template-columns: minmax(0,1.5fr) minmax(0,1fr); gap: 48px; align-items: center; background: linear-gradient(115deg, #00234d 0%, #0b3059 55%, #d8327f 140%); border-radius: 24px; padding: 52px 56px; color: #fff; }
        .smp-gros h2 { color: #fff; font-size: clamp(24px, 2.8vw, 36px); letter-spacing: -.8px; font-weight: 600; margin-bottom: 18px; }
        .smp-gros p { color: #dbe4f0; line-height: 1.9; font-size: 14.5px; margin: 0; }
        .smp-gros-side { text-align: center; }
        .smp-gros-side .smp-btn { width: 100%; justify-content: center; margin-bottom: 12px; }
        .smp-gros-tel { color: #fff; font-weight: 600; font-size: 15px; }
        .smp-gros-tel:hover { color: #f2a6cc; }
        .smp-gros-list { list-style: none; padding: 0; margin: 22px 0 0; display: flex; flex-wrap: wrap; gap: 10px 26px; }
        .smp-gros-list li { color: #dbe4f0; font-size: 13px; padding-left: 22px; position: relative; }
        .smp-gros-list li::before { content: ''; position: absolute; left: 0; top: 6px; width: 12px; height: 7px; border-left: 2px solid #f2a6cc; border-bottom: 2px solid #f2a6cc; transform: rotate(-45deg); }
        @media (max-width: 991px) {
            .smp-hero-grid, .smp-gros-card { grid-template-columns: 1fr; gap: 40px; }
            .smp-hero-media { max-width: 560px; }
            .smp-modeles-grid { grid-template-columns: repeat(2, minmax(0,1fr)); }
            .smp-modeles-head { flex-direction: column; align-items: flex-start; gap: 14px; }
            .smp-gros-card { padding: 40px 32px; }
        }
        @media (max-width: 640px) {
            .smp-hero { padding: 56px 0 64px; }
            .smp-modeles-grid { grid-template-columns: 1fr; }
            .smp-hero-tag { left: 8px; }
        }
    </style>
</head>
<body class="smp-site">
    <div class="body-wrapper">
        <?php include __DIR__ . '/announcement.php'; ?>
        <?php include __DIR__ . '/header.php'; ?>
        <nav class="breadcrumb" aria-label="Fil d’Ariane">
            <div class="container">
                <ol class="list-unstyled d-flex align-items-center m-0">
                    <li><a href="index.php">Accueil</a></li>
                    <li aria-current="page"><?= $escape($page['title']) ?></li>
                </ol>
            </div>
        </nav>
        <main id="MainContent" tabindex="-1">
            <section class="smp-hero">
                <div class="container">
                    <div class="smp-hero-grid">
                        <div>
                            <span class="smp-kicker"><?= $escape($page['kicker']) ?></span>
                            <h1><?= $escape($page['title']) ?></h1>
                            <p class="smp-lead"><?= $escape($page['lead']) ?></p>
                            <div class="smp-hero-actions">
                                <a class="smp-btn smp-btn-primary" href="contact.php">Demander un devis →</a>
                                <a class="smp-btn smp-btn-ghost" href="tel:+2250799140356">+225 07 99 14 03 56</a>
                            </div>
                            <div class="smp-badges">
                                <span class="smp-badge">Commandes en gros</span>
                                <span class="smp-badge">Devis personnalisé</span>
                                <span class="smp-badge">Livraison Côte d’Ivoire</span>
                                <span class="smp-badge">Accompagnement dédié</span>
                            </div>
                        </div>
                        <figure class="smp-hero-media">
                            <img src="<?= $escape($page['image']) ?>" alt="<?= $escape($page['image_alt']) ?>" loading="eager" fetchpriority="high" decoding="async">
                            <div class="smp-hero-tag">
                                <strong>Mobilier Addict</strong>
                                <span>Équipement complet · Abidjan</span>
                            </div>
                        </figure>
                    </div>
                </div>
            </section>
            <section class="smp-story">
                <div class="container">
                    <div class="smp-story-inner">
                        <p class="smp-sec-kicker">Notre approche</p>
                        <h2><?= $escape($page['story_title']) ?></h2>
                        <p><?= $escape($page['story']) ?></p>
                    </div>
                </div>
            </section>
            <section class="smp-modeles">
                <div class="container">
                    <div class="smp-modeles-head">
                        <div>
                            <p class="smp-sec-kicker">Nos modèles</p>
                            <h2>Trois ensembles pensés pour vous</h2>
                        </div>
                        <p class="smp-modeles-sub">Chaque ensemble se compose librement : choisissez une base, nous l’ajustons à vos dimensions, vos quantités et votre budget.</p>
                    </div>
                    <div class="smp-modeles-grid">
                        <?php foreach ($page['modeles'] as $i => $modele): ?>
                            <article class="smp-modele">
                                <div class="smp-modele-img">
                                    <span class="smp-modele-num">0<?= $i + 1 ?></span>
                                    <img src="<?= $escape($modele['img']) ?>" alt="<?= $escape($modele['name']) ?>" loading="lazy" decoding="async">
                                </div>
                                <div class="smp-modele-body">
                                    <h3><?= $escape($modele['name']) ?></h3>
                                    <p><?= $escape($modele['desc']) ?></p>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <section class="smp-equip">
                <div class="container">
                    <p class="smp-sec-kicker">Tout l’intérieur, au même endroit</p>
                    <h2>Équipement & accessoires</h2>
                    <div class="smp-equip-grid">
                        <?php foreach ($page['equipement'] as [$label, $url, $desc]): ?>
                            <a class="smp-equip-item" href="<?= $escape($url) ?>">
                                <strong><?= $escape($label) ?></strong>
                                <span><?= $escape($desc) ?></span>
                                <em>Voir la gamme →</em>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <section class="smp-gros">
                <div class="container">
                    <div class="smp-gros-card">
                        <div>
                            <h2>Achats en gros & projets d’envergure</h2>
                            <p><?= $escape($page['gros']) ?></p>
                            <ul class="smp-gros-list">
                                <li>Tarifs dégressifs sur quantité</li>
                                <li>Livraison par lots</li>
                                <li>Un interlocuteur unique</li>
                                <li>Facture claire et détaillée</li>
                            </ul>
                        </div>
                        <div class="smp-gros-side">
                            <a class="smp-btn smp-btn-primary" href="contact.php">Demander un devis</a>
                            <a class="smp-gros-tel" href="tel:+2250799140356">+225 07 99 14 03 56</a>
                        </div>
                    </div>
                </div>
            </section>
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
                        <p><a href="contact.php">Contacter la boutique →</a></p>
                    </div>
                </div>
                <div class="editorial-footer-bottom">
                    <ul class="list-unstyled"><?php $footerGroup = 'legal'; include __DIR__ . '/footer-links.php'; ?></ul>
                    <p>© <?= date('Y') ?> Mobilier Addict.</p>
                </div>
            </div>
        </footer>
    </div>
    <script src="assets/js/vendor.js" defer></script>
    <script src="assets/js/main.min.js" defer></script>
</body>
</html>
