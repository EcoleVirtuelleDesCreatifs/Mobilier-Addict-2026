@extends('layouts.front')

@section('title', 'Entretien literie')
@section('meta_description', "Entretien literie : conseils pour prolonger la durée de vie de votre matelas et de votre linge de lit.")

@push('styles')
    <style>
        .cg{background:#0b0b12;padding:36px 0 70px}
        .cg-hero{border-radius:22px;padding:22px;background:linear-gradient(135deg,rgba(255,76,154,.20),rgba(122,92,255,.16));border:1px solid rgba(255,255,255,.12)}
        .cg h1,.cg h2,.cg h3{color:#fff}
        .cg p,.cg li{color:rgba(255,255,255,.72);line-height:1.75}
        .cg-card{border-radius:22px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);padding:18px}
        .cg-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
        .cg-btn{display:inline-flex;gap:10px;align-items:center;justify-content:center;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.16);color:#fff;text-decoration:none;font-weight:800;background:rgba(255,255,255,.10)}
        .cg-btn--primary{background:linear-gradient(135deg,rgba(255,76,154,.94),rgba(122,92,255,.94))}
        .cg-steps{display:grid;gap:12px}
        .cg-step{display:flex;gap:12px;align-items:flex-start;border-radius:18px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);padding:14px}
        .cg-dot{width:40px;height:40px;border-radius:14px;display:grid;place-items:center;background:linear-gradient(135deg,rgba(255,76,154,.86),rgba(122,92,255,.86));color:#fff;font-weight:900;flex:0 0 auto}
        .cg-faq details{border-radius:16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);padding:12px}
        .cg-faq summary{cursor:pointer;color:#fff;font-weight:900;list-style:none}
        .cg-faq summary::-webkit-details-marker{display:none}
        @media(max-width:991.98px){.cg-grid{grid-template-columns:1fr}}
    </style>
@endpush

@section('content')
<div class="cg" aria-label="Guide entretien literie">
    <div class="container">
        <div class="cg-hero">
            <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between" style="gap:14px;">
                <div>
                    <div style="margin-bottom:10px;display:inline-flex;align-items:center;gap:10px;padding:8px 12px;border-radius:999px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.14);color:rgba(255,255,255,.88);font-weight:800;font-size:13px;letter-spacing:.2px;">
                        <i class="fa-solid fa-sparkles"></i>
                        Hygiène • Durabilité • Confort
                    </div>
                    <h1 style="margin:0 0 8px;">Entretien de la literie</h1>
                    <p style="margin:0;">Les bons gestes (simples) qui prolongent la durée de vie de votre matelas, gardent un lit sain et améliorent le confort nuit après nuit.</p>
                </div>
                <div class="d-flex flex-wrap" style="gap:12px;">
                    <a class="cg-btn cg-btn--primary" href="https://wa.me/2250799140356" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Conseils WhatsApp <i class="fa-solid fa-arrow-right"></i></a>
                    <a class="cg-btn" href="{{ route('univers.show', ['slug' => 'protection']) }}"><i class="fa-solid fa-shield"></i> Protège-matelas</a>
                    <a class="cg-btn" href="{{ route('pages.contact') }}"><i class="fa-solid fa-headset"></i> Contact</a>
                </div>
            </div>
        </div>

        <div class="cg-card" style="margin-top:18px;">
            <div class="d-flex flex-column flex-lg-row" style="gap:14px;align-items:flex-start;">
                <div style="flex:1;">
                    <h2 style="margin:0 0 8px;">Les 3 piliers d’une literie saine</h2>
                    <p style="margin:0;">On vise : moins d’humidité, moins d’acariens/poussière, plus de fraîcheur. C’est ce qui protège le matelas et le confort dans le temps.</p>
                </div>
                <div class="cg-grid" style="flex:1;">
                    <div class="cg-card" style="padding:14px;">
                        <h3 style="margin:0 0 6px;font-size:15px;">Aérer</h3>
                        <p style="margin:0;">Laisser respirer le matelas réduit l’humidité.</p>
                    </div>
                    <div class="cg-card" style="padding:14px;">
                        <h3 style="margin:0 0 6px;font-size:15px;">Protéger</h3>
                        <p style="margin:0;">Protège-matelas + linge adapté = durabilité.</p>
                    </div>
                    <div class="cg-card" style="padding:14px;">
                        <h3 style="margin:0 0 6px;font-size:15px;">Nettoyer</h3>
                        <p style="margin:0;">Gestes réguliers = hygiène constante.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="cg-card" style="margin-top:18px;">
            <h2 style="margin:0 0 10px;">Routine simple (au quotidien / semaine)</h2>
            <div class="cg-steps">
                <div class="cg-step"><div class="cg-dot">1</div><div><h3 style="margin:0 0 6px;font-size:16px;">Aérer 10–15 min</h3><p style="margin:0;">Ouvrir la fenêtre et, si possible, laisser le lit ouvert (draps tirés) pour évacuer l’humidité.</p></div></div>
                <div class="cg-step"><div class="cg-dot">2</div><div><h3 style="margin:0 0 6px;font-size:16px;">Changer / laver le linge</h3><p style="margin:0;">Draps et taies régulièrement. Un linge propre limite les allergènes et améliore la sensation de fraîcheur.</p></div></div>
                <div class="cg-step"><div class="cg-dot">3</div><div><h3 style="margin:0 0 6px;font-size:16px;">Aspirer le matelas (si besoin)</h3><p style="margin:0;">Un passage rapide (surtout si allergies) aide à réduire poussière et particules.</p></div></div>
            </div>
        </div>

        <div class="cg-card" style="margin-top:18px;">
            <h2 style="margin:0 0 10px;">Nettoyage en profondeur (mensuel / trimestriel)</h2>
            <p style="margin:0;">Objectif : enlever l’accumulation (poussière/odeurs) sans abîmer les matériaux.</p>
            <p style="margin-top:10px;">Astuce : un protège-matelas facilite énormément l’entretien. Il se lave plus facilement qu’un matelas.</p>
        </div>

        <div class="cg-card" style="margin-top:18px;">
            <h2 style="margin:0 0 10px;">Protection : le meilleur “hack” pour la durabilité</h2>
            <p style="margin:0;">Un protège-matelas limite les taches, l’humidité et la poussière. C’est la différence entre un matelas qui vieillit vite et un matelas qui reste propre longtemps.</p>
            <div class="d-flex flex-wrap" style="gap:12px;margin-top:14px;">
                <a class="cg-btn cg-btn--primary" href="{{ route('univers.show', ['slug' => 'protection']) }}"><i class="fa-solid fa-shield"></i> Choisir une protection <i class="fa-solid fa-arrow-right"></i></a>
                <a class="cg-btn" href="{{ route('univers.show', ['slug' => 'draps-couettes']) }}"><i class="fa-solid fa-shirt"></i> Draps &amp; couettes</a>
            </div>
        </div>

        <div class="cg-card" style="margin-top:18px;">
            <h2 style="margin:0 0 10px;">Checklist rapide</h2>
            <div class="cg-steps">
                <div class="cg-step"><div class="cg-dot">A</div><div><p style="margin:0;">Aération quotidienne.</p></div></div>
                <div class="cg-step"><div class="cg-dot">B</div><div><p style="margin:0;">Linge changé/lavé régulièrement.</p></div></div>
                <div class="cg-step"><div class="cg-dot">C</div><div><p style="margin:0;">Protège-matelas utilisé (et lavé).</p></div></div>
                <div class="cg-step"><div class="cg-dot">D</div><div><p style="margin:0;">Nettoyage doux en profondeur périodique.</p></div></div>
            </div>
        </div>

        <div class="cg-card cg-faq" style="margin-top:18px;">
            <h2 style="margin:0 0 10px;">FAQ (Entretien literie)</h2>
            <details open>
                <summary>Pourquoi mon matelas garde des odeurs ?</summary>
                <p>Souvent à cause de l’humidité. Aère la pièce, laisse le lit ouvert le matin et utilise un protège-matelas lavable.</p>
            </details>
            <details>
                <summary>À quelle fréquence laver les draps ?</summary>
                <p>Plus c’est régulier, mieux c’est. Le but : limiter la poussière et garder un confort propre.</p>
            </details>
            <details>
                <summary>Le protège-matelas est-il vraiment indispensable ?</summary>
                <p>Oui : c’est l’accessoire le plus rentable pour garder un matelas sain et prolonger sa durée de vie.</p>
            </details>
        </div>
    </div>
</div>
@endsection
