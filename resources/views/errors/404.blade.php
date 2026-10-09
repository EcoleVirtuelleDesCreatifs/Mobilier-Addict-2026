<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page introuvable — Mobilier Addict</title>
    <meta name="robots" content="noindex">
    <link rel="icon" href="{{ asset('assets/logo/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: #00234D;
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 24px;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            width: 560px; height: 560px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(236,72,153,.22), transparent 65%);
            top: -160px; right: -160px;
        }
        body::after {
            content: '';
            position: absolute;
            width: 460px; height: 460px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,.07), transparent 65%);
            bottom: -160px; left: -140px;
        }
        .error-wrap { position: relative; z-index: 1; max-width: 620px; width: 100%; }
        .logo { height: 56px; margin-bottom: 40px; }
        .code {
            font-size: clamp(96px, 22vw, 170px);
            font-weight: 800;
            line-height: 1;
            letter-spacing: -4px;
            color: #ec4899;
        }
        .code span { color: #fff; }
        h1 { font-size: clamp(22px, 4vw, 32px); font-weight: 700; margin: 12px 0 14px; }
        p { color: rgba(255,255,255,.72); font-size: 15px; line-height: 1.7; max-width: 460px; margin: 0 auto 34px; }
        .actions { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
        .btn {
            display: inline-block;
            padding: 14px 34px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: .06em;
            transition: transform .15s ease, box-shadow .15s ease;
        }
        .btn:hover { transform: translateY(-2px); }
        .btn-pink { background: #ec4899; color: #fff; box-shadow: 0 10px 30px rgba(236,72,153,.35); }
        .btn-ghost { border: 1px solid rgba(255,255,255,.35); color: #fff; }
        .links { margin-top: 44px; display: flex; gap: 22px; justify-content: center; flex-wrap: wrap; }
        .links a { color: rgba(255,255,255,.55); font-size: 13px; text-decoration: none; }
        .links a:hover { color: #ec4899; }
    </style>
</head>
<body>
    <div class="error-wrap">
        <img src="{{ asset('assets/logo/desktop/logo.png') }}" alt="Mobilier Addict" class="logo">
        <div class="code">4<span>0</span>4</div>
        <h1>Oups ! Cette page est introuvable</h1>
        <p>La page que vous cherchez a peut-être été déplacée, supprimée ou n'a jamais existé. Pas de panique, nos meubles eux sont bien là.</p>
        <div class="actions">
            <a href="{{ url('/') }}" class="btn btn-pink">Retour à l'accueil</a>
            <a href="{{ url()->previous() }}" class="btn btn-ghost">Page précédente</a>
        </div>
        <div class="links">
            <a href="{{ url('/collection') }}">Collection</a>
            <a href="{{ url('/devis-sur-mesure') }}">Devis sur mesure</a>
            <a href="{{ url('/contact') }}">Contact</a>
            <a href="{{ url('/panier') }}">Panier</a>
        </div>
    </div>
</body>
</html>
