<?php
http_response_code(503);
header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

// Set your expected re-opening time (timezone: UTC by default).
// Example: '2026-02-06 18:00:00'
$reopenAt = '2026-02-06 18:00:00';

try {
    $reopenDate = new DateTime($reopenAt, new DateTimeZone('UTC'));
} catch (Throwable $e) {
    $reopenDate = null;
}

$reopenIso = $reopenDate ? $reopenDate->format('c') : '';
?>
<!doctype html>
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
        .count{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:10px;margin-top:18px}
        .count__item{border-radius:18px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.14);padding:14px 12px;text-align:center}
        .count__n{font-weight:1000;font-size:22px;letter-spacing:-.02em}
        .count__l{margin-top:6px;color:rgba(241,245,249,.72);font-weight:900;font-size:11px;letter-spacing:.08em;text-transform:uppercase}
        @media (max-width: 520px){.count{grid-template-columns:repeat(2,minmax(0,1fr))}}
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

        <div class="count" id="countdown" data-reopen-iso="<?= htmlspecialchars($reopenIso, ENT_QUOTES, 'UTF-8') ?>" aria-label="Compte à rebours">
            <div class="count__item"><div class="count__n" data-dd>--</div><div class="count__l">Jours</div></div>
            <div class="count__item"><div class="count__n" data-hh>--</div><div class="count__l">Heures</div></div>
            <div class="count__item"><div class="count__n" data-mm>--</div><div class="count__l">Minutes</div></div>
            <div class="count__item"><div class="count__n" data-ss>--</div><div class="count__l">Secondes</div></div>
        </div>

        <div class="actions">
            <a class="btn btn-primary" href="https://wa.me/{{ whatsapp_number() }}?text=Bonjour%2C%20le%20site%20est%20en%20maintenance.%20Je%20veux%20passer%20commande.">Commander via WhatsApp</a>
            <a class="btn btn-ghost" href="mailto:contact@mobilier-addict.com">Nous contacter</a>
        </div>
        <div class="small">Code: 503 — Service indisponible</div>
    </main>

    <script>
        (function(){
            const el = document.getElementById('countdown');
            if (!el) return;
            const iso = el.getAttribute('data-reopen-iso') || '';
            if (!iso) return;

            const dd = el.querySelector('[data-dd]');
            const hh = el.querySelector('[data-hh]');
            const mm = el.querySelector('[data-mm]');
            const ss = el.querySelector('[data-ss]');

            const target = new Date(iso);
            if (isNaN(target.getTime())) return;

            function pad(n){
                n = Math.max(0, Number(n) || 0);
                return String(n).padStart(2, '0');
            }

            function tick(){
                const now = new Date();
                let diff = Math.floor((target.getTime() - now.getTime()) / 1000);
                if (diff <= 0) {
                    dd.textContent = '00';
                    hh.textContent = '00';
                    mm.textContent = '00';
                    ss.textContent = '00';
                    return;
                }

                const days = Math.floor(diff / 86400);
                diff -= days * 86400;
                const hours = Math.floor(diff / 3600);
                diff -= hours * 3600;
                const mins = Math.floor(diff / 60);
                diff -= mins * 60;
                const secs = diff;

                dd.textContent = pad(days);
                hh.textContent = pad(hours);
                mm.textContent = pad(mins);
                ss.textContent = pad(secs);
            }

            tick();
            setInterval(tick, 1000);
        })();
    </script>
</body>
</html>
