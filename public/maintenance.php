<?php
http_response_code(503);
header('Content-Type: text/html; charset=UTF-8');
?><!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mobilier Addict — Maintenance</title>
    <style>
        :root{--ma-rose:#ff3a7f;--ma-navy:#0b1b3a;}
        *{box-sizing:border-box}
        body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,Noto Sans,sans-serif;background:linear-gradient(180deg,#0b1b3a,#071126);color:#fff;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;}
        .card{width:min(980px,100%);border-radius:24px;border:1px solid rgba(255,255,255,.14);background:radial-gradient(900px 520px at 20% 20%, rgba(255,58,127,.18), rgba(255,58,127,0) 60%), rgba(255,255,255,.04);box-shadow:0 30px 90px rgba(0,0,0,.35);padding:28px;}
        .badge{display:inline-flex;align-items:center;gap:10px;padding:10px 14px;border-radius:999px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.16);font-weight:900;font-size:12px;letter-spacing:.06em;text-transform:uppercase;}
        h1{margin:14px 0 10px;font-size:34px;letter-spacing:-.03em;line-height:1.05}
        p{margin:0;color:rgba(241,245,249,.86);font-weight:700;max-width:70ch;line-height:1.6}
        .actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:18px}
        a.btn{display:inline-flex;align-items:center;justify-content:center;border-radius:999px;padding:12px 16px;text-decoration:none;font-weight:900}
        a.btn-primary{background:linear-gradient(135deg,var(--ma-rose),#ff2e72);color:#fff;box-shadow:0 18px 46px rgba(255,58,127,.25)}
        a.btn-ghost{background:rgba(9,16,34,.65);color:#fff;border:1px solid rgba(255,255,255,.18)}
        .small{margin-top:16px;font-size:12px;color:rgba(241,245,249,.7);font-weight:700}
    </style>
</head>
<body>
    <main class="card">
        <span class="badge">Maintenance en cours</span>
        <h1>Nous revenons très vite.</h1>
        <p>
            Mobilier Addict est temporairement indisponible le temps d'une mise à jour.
            Merci pour votre patience.
        </p>
        <div class="actions">
            <a class="btn btn-primary" href="https://wa.me/2250700000000?text=Bonjour%2C%20le%20site%20est%20en%20maintenance.%20Je%20veux%20passer%20commande.">Commander via WhatsApp</a>
            <a class="btn btn-ghost" href="mailto:contact@mobilier-addict.com">Nous contacter</a>
        </div>
        <div class="small">Code: 503 — Service indisponible</div>
    </main>
</body>
</html>
