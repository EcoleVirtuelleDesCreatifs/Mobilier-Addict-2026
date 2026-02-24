@extends('layouts.front')

@section('title', 'Choisir son oreiller')
@section('meta_description', "Choisir son oreiller : hauteur, maintien et confort selon votre position de sommeil.")

@push('styles')
    <style>
        .og{background:#0b0b12;padding:36px 0 70px}
        .og-hero{border-radius:22px;padding:22px;background:linear-gradient(135deg,rgba(255,76,154,.22),rgba(122,92,255,.18));border:1px solid rgba(255,255,255,.12)}
        .og h1,.og h2,.og h3{color:#fff}
        .og p,.og li{color:rgba(255,255,255,.72);line-height:1.75}
        .og-card{border-radius:22px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);padding:18px}
        .og-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
        .og-btn{display:inline-flex;gap:10px;align-items:center;justify-content:center;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.16);color:#fff;text-decoration:none;font-weight:800;background:rgba(255,255,255,.10)}
        .og-btn--primary{background:linear-gradient(135deg,rgba(255,76,154,.94),rgba(122,92,255,.94))}
        .og-steps{display:grid;gap:12px}
        .og-step{display:flex;gap:12px;align-items:flex-start;border-radius:18px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);padding:14px}
        .og-dot{width:40px;height:40px;border-radius:14px;display:grid;place-items:center;background:linear-gradient(135deg,rgba(255,76,154,.86),rgba(122,92,255,.86));color:#fff;font-weight:900;flex:0 0 auto}
        .og-faq details{border-radius:16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);padding:12px}
        .og-faq summary{cursor:pointer;color:#fff;font-weight:900;list-style:none}
        .og-faq summary::-webkit-details-marker{display:none}
        @media(max-width:991.98px){.og-grid{grid-template-columns:1fr}}
    </style>
@endpush

@section('content')
<div class="og" aria-label="Guide oreiller">
    <div class="container">
        <div class="og-hero">
            <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between" style="gap:14px;">
                <div>
                    <div class="pg-kicker" style="margin-bottom:10px;display:inline-flex;">
                        <i class="fa-solid fa-moon"></i>
                        Guide sommeil • Cervicales • Confort
                    </div>
                    <h1 style="margin:0 0 8px;">Choisir son oreiller</h1>
                    <p style="margin:0;">Un oreiller bien choisi aligne la nuque et détend les épaules. Résultat : moins de tensions et un sommeil plus profond.</p>
                </div>
                <div class="d-flex flex-wrap" style="gap:12px;">
                    <a class="og-btn og-btn--primary" href="https://wa.me/{{ whatsapp_number() }}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Conseils WhatsApp <i class="fa-solid fa-arrow-right"></i></a>
                    <a class="og-btn" href="{{ route('univers.show', ['slug' => 'oreillers']) }}"><i class="fa-solid fa-store"></i> Voir les oreillers</a>
                    <a class="og-btn" href="{{ route('pages.contact') }}"><i class="fa-solid fa-headset"></i> Contact</a>
                </div>
            </div>
        </div>

        <div class="og-card" style="margin-top:18px;">
            <div class="d-flex flex-column flex-lg-row" style="gap:14px;align-items:flex-start;">
                <div style="flex:1;">
                    <h2 style="margin:0 0 8px;">Les 3 critères qui font tout</h2>
                    <p style="margin:0;">La position de sommeil détermine la hauteur. La morphologie influence le soutien. La matière règle la sensation (moelleux/ferme) et la chaleur.</p>
                </div>
                <div class="og-grid" style="flex:1;">
                    <div class="og-card" style="padding:14px;">
                        <h3 style="margin:0 0 6px;font-size:15px;">Hauteur</h3>
                        <p style="margin:0;">Plus tu dors sur le côté, plus l’oreiller doit être haut.</p>
                    </div>
                    <div class="og-card" style="padding:14px;">
                        <h3 style="margin:0 0 6px;font-size:15px;">Maintien</h3>
                        <p style="margin:0;">Un bon soutien évite les tensions cervicales.</p>
                    </div>
                    <div class="og-card" style="padding:14px;">
                        <h3 style="margin:0 0 6px;font-size:15px;">Matière</h3>
                        <p style="margin:0;">Mousse, fibres, latex… le ressenti et la ventilation changent.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="og-card" style="margin-top:18px;">
            <h2 style="margin:0 0 10px;">1) Choisir selon ta position de sommeil</h2>
            <div class="og-steps">
                <div class="og-step">
                    <div class="og-dot">A</div>
                    <div>
                        <h3 style="margin:0 0 6px;font-size:16px;">Sur le dos</h3>
                        <p style="margin:0;">Vise un oreiller de hauteur moyenne. L’objectif : combler l’espace entre nuque et matelas, sans pousser la tête vers l’avant.</p>
                    </div>
                </div>
                <div class="og-step">
                    <div class="og-dot">B</div>
                    <div>
                        <h3 style="margin:0 0 6px;font-size:16px;">Sur le côté</h3>
                        <p style="margin:0;">Prends plus haut et plus ferme : il faut compenser la largeur d’épaule pour garder la colonne alignée.</p>
                    </div>
                </div>
                <div class="og-step">
                    <div class="og-dot">C</div>
                    <div>
                        <h3 style="margin:0 0 6px;font-size:16px;">Sur le ventre</h3>
                        <p style="margin:0;">Privilégie un oreiller fin et souple (ou parfois pas d’oreiller). Trop haut = nuque en torsion.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="og-card" style="margin-top:18px;">
            <h2 style="margin:0 0 10px;">2) Hauteur &amp; fermeté : le duo gagnant</h2>
            <p style="margin:0;">Si tes épaules sont larges ou si ton matelas est très ferme, tu auras souvent besoin d’un peu plus de hauteur. Si ton matelas est moelleux, la tête “s’enfonce” déjà : l’oreiller peut être un peu moins haut.</p>
            <p style="margin-top:10px;">Conseil simple : tu dois sentir que ton cou est “posé”, pas plié. Si tu te réveilles avec des tensions, ajuste d’abord la hauteur.</p>
        </div>

        <div class="og-card" style="margin-top:18px;">
            <h2 style="margin:0 0 10px;">3) Matières : confort, chaleur, allergies</h2>
            <div class="og-grid">
                <div class="og-card" style="padding:14px;">
                    <h3 style="margin:0 0 6px;font-size:15px;">Mousse</h3>
                    <p style="margin:0;">Soutien stable, sensation enveloppante. Bon choix pour les cervicales.</p>
                </div>
                <div class="og-card" style="padding:14px;">
                    <h3 style="margin:0 0 6px;font-size:15px;">Fibres</h3>
                    <p style="margin:0;">Confort moelleux, souvent plus léger. Idéal si tu aimes le “gonflant”.</p>
                </div>
                <div class="og-card" style="padding:14px;">
                    <h3 style="margin:0 0 6px;font-size:15px;">Technologies hybrides</h3>
                    <p style="margin:0;">Équilibre entre maintien et respirabilité selon les gammes.</p>
                </div>
            </div>
            <p style="margin-top:10px;">Si tu as chaud la nuit, privilégie les matières plus respirantes et une taie adaptée. En cas d’allergies, favorise les solutions faciles à entretenir et aérer.</p>
        </div>

        <div class="og-card" style="margin-top:18px;">
            <h2 style="margin:0 0 10px;">Checklist (avant d’acheter)</h2>
            <div class="og-steps">
                <div class="og-step"><div class="og-dot">1</div><div><p style="margin:0;">Ta position principale de sommeil est identifiée (dos/côté/ventre).</p></div></div>
                <div class="og-step"><div class="og-dot">2</div><div><p style="margin:0;">Tu as choisi une hauteur cohérente avec tes épaules et ton matelas.</p></div></div>
                <div class="og-step"><div class="og-dot">3</div><div><p style="margin:0;">La fermeté apporte un maintien sans points de pression.</p></div></div>
                <div class="og-step"><div class="og-dot">4</div><div><p style="margin:0;">La matière correspond à ton ressenti (moelleux/ferme) et à ta chaleur nocturne.</p></div></div>
            </div>
            <div class="d-flex flex-wrap" style="gap:12px;margin-top:14px;">
                <a class="og-btn og-btn--primary" href="https://wa.me/{{ whatsapp_number() }}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Aide au choix <i class="fa-solid fa-arrow-right"></i></a>
                <a class="og-btn" href="{{ route('univers.show', ['slug' => 'oreillers']) }}"><i class="fa-solid fa-store"></i> Voir la collection</a>
            </div>
        </div>

        <div class="og-card og-faq" style="margin-top:18px;">
            <h2 style="margin:0 0 10px;">FAQ (Oreiller)</h2>
            <details open>
                <summary>J’ai mal à la nuque au réveil, que faire ?</summary>
                <p>La cause est souvent une hauteur inadaptée. Ajuste d’abord la hauteur, puis la fermeté. Si besoin, écris-nous sur WhatsApp avec ta position de sommeil.</p>
            </details>
            <details>
                <summary>Dois-je changer d’oreiller quand je change de matelas ?</summary>
                <p>Souvent oui : un matelas plus ferme ou plus moelleux change l’alignement du cou. Un petit ajustement d’oreiller peut tout améliorer.</p>
            </details>
            <details>
                <summary>Quelle est la meilleure matière ?</summary>
                <p>Il n’y a pas de “meilleure” pour tout le monde. L’idéal est celle qui combine maintien, confort et chaleur adaptée à toi.</p>
            </details>
        </div>
    </div>
</div>
@endsection
