@extends('maquette.layout')

@section('title', 'Grand Jeu Mobilier Addict — Crée ton badge')
@section('meta_description', 'Participe au Grand Jeu Mobilier Addict : crée ton badge personnalisé, partage-le et tente de gagner un cadeau.')

@section('content')
<style>
    .game-hero{background:linear-gradient(120deg,#00234D 60%,#0a3a75);border-radius:24px;padding:56px 40px;color:#fff;position:relative;overflow:hidden;}
    .game-hero::after{content:'';position:absolute;width:420px;height:420px;border-radius:50%;background:radial-gradient(circle,rgba(236,72,153,.28),transparent 65%);top:-120px;right:-120px;}
    .game-kicker{display:inline-flex;align-items:center;gap:10px;color:#ec4899;font-size:13px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;}
    .game-kicker::before{content:'';width:34px;height:2px;background:#ec4899;}
    .game-hero h1{font-size:clamp(28px,4vw,46px);font-weight:800;margin:14px 0 12px;color:#fff;}
    .game-hero h1 .pink{color:#ec4899;}
    .game-hero p{color:rgba(255,255,255,.78);max-width:560px;line-height:1.75;}
    .game-steps{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:18px;margin:44px 0;}
    .game-step{background:#fff;border:1px solid #f0e8ee;border-radius:18px;padding:26px 22px;position:relative;transition:transform .15s ease,box-shadow .15s ease;}
    .game-step:hover{transform:translateY(-4px);box-shadow:0 14px 34px rgba(0,35,77,.10);}
    .game-step-num{position:absolute;top:-14px;left:20px;background:#ec4899;color:#fff;font-weight:700;font-size:13px;padding:4px 14px;border-radius:999px;}
    .game-step h3{font-size:16px;font-weight:700;color:#00234D;margin:10px 0 8px;}
    .game-step p{font-size:13.5px;color:#666;line-height:1.65;margin:0;}
    .game-form-card{background:#fff;border:1px solid #f0e8ee;border-radius:24px;padding:40px;max-width:860px;margin:0 auto;}
    .game-form-card h2{color:#00234D;font-weight:800;font-size:26px;margin-bottom:6px;}
    .game-form-card .sub{color:#777;font-size:14px;margin-bottom:28px;}
    .game-prizes{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px;}
    .game-prize{position:relative;}
    .game-prize input{position:absolute;opacity:0;}
    .game-prize label{display:block;border:2px solid #eee;border-radius:14px;padding:16px 14px;font-size:13.5px;font-weight:600;color:#00234D;text-align:center;cursor:pointer;transition:.15s;margin:0;}
    .game-prize input:checked+label{border-color:#ec4899;background:rgba(236,72,153,.07);color:#ec4899;box-shadow:0 8px 20px rgba(236,72,153,.15);}
    .game-btn{background:#ec4899;color:#fff;border:none;border-radius:999px;padding:16px 44px;font-weight:700;font-size:14px;letter-spacing:.05em;text-transform:uppercase;transition:.15s;}
    .game-btn:hover{background:#d1357f;color:#fff;transform:translateY(-2px);box-shadow:0 12px 28px rgba(236,72,153,.35);}
    .game-btn:disabled{opacity:.7;cursor:not-allowed;transform:none;}
    .game-note{font-size:12.5px;color:#999;margin-top:16px;}
    .game-podium{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:18px;margin-bottom:44px;}
    .game-podium-card{display:flex;align-items:center;gap:18px;background:#fff;border:1px solid #f0e8ee;border-radius:20px;padding:20px 22px;text-decoration:none;transition:.15s;}
    .game-podium-card:hover{transform:translateY(-3px);box-shadow:0 14px 30px rgba(0,35,77,.12);}
    .game-podium-img{width:76px;height:92px;border-radius:14px;object-fit:cover;background:#00234D;flex:0 0 76px;}
    .game-podium-rank{position:absolute;top:-10px;left:-10px;width:32px;height:32px;border-radius:50%;background:#ec4899;color:#fff;font-size:14px;font-weight:800;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 10px rgba(236,72,153,.4);}
    .game-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:18px;margin-bottom:44px;}
    .game-card{background:#fff;border:1px solid #f0e8ee;border-radius:20px;overflow:hidden;text-decoration:none;transition:.15s;display:block;}
    .game-card:hover{transform:translateY(-4px);box-shadow:0 14px 30px rgba(0,35,77,.12);}
    .game-card-img{width:100%;aspect-ratio:4/5;object-fit:cover;background:#00234D;display:flex;align-items:center;justify-content:center;color:#ec4899;font-weight:800;font-size:52px;}
    .game-card-body{padding:16px 18px 18px;}
    .game-card-name{font-weight:800;color:#00234D;font-size:16px;}
    .game-card-meta{display:flex;align-items:center;justify-content:space-between;margin-top:8px;font-size:13px;}
    .game-card-supports{color:#ec4899;font-weight:700;}
    .game-photo-preview{display:none;width:64px;height:64px;border-radius:50%;object-fit:cover;border:3px solid #ec4899;margin-top:10px;}
    #participer{scroll-margin-top:100px;}
    html{scroll-behavior:smooth;}
    .game-cd{display:flex;gap:12px;margin-top:20px;flex-wrap:wrap;}
    .game-cd-box{background:rgba(0,0,0,.35);border:1px solid rgba(236,72,153,.55);border-radius:16px;min-width:88px;padding:14px 10px;text-align:center;box-shadow:0 8px 22px rgba(0,0,0,.3);}
    .game-cd-box b{display:block;font-size:clamp(26px,3.5vw,40px);font-weight:800;color:#fff;line-height:1;font-variant-numeric:tabular-nums;}
    .game-cd-box span{display:block;font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#ec4899;margin-top:6px;}
    .game-cd-label{font-size:12px;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:rgba(255,255,255,.7);display:block;margin-bottom:8px;}
</style>

<div class="container py-5">
    <div class="game-hero mb-4">
        <span class="game-kicker">Grand jeu</span>
        <h1>Crée ton badge, partage-le, <span class="pink">gagne ton cadeau.</span></h1>
        <p>Participe au jeu Mobilier Addict : génère ton badge personnalisé, partage-le sur tes réseaux avec <strong>#MobilierAddict #MatelasAddict</strong> en identifiant la page Facebook Mobilier Addict, et fais voter tes proches.</p>
        <div class="mt-4">
            <a href="#participer" class="game-btn text-decoration-none d-inline-block">Je participe</a>
        </div>
        @if(!empty($endsAt))
            <div class="mt-4" id="gameCountdown" data-ends="{{ $endsAt->toIso8601String() }}">
                <span class="game-cd-label">⏳ Fin du jeu dans</span>
                <div class="game-cd">
                    <div class="game-cd-box"><b data-cd="d">00</b><span>jours</span></div>
                    <div class="game-cd-box"><b data-cd="h">00</b><span>heures</span></div>
                    <div class="game-cd-box"><b data-cd="m">00</b><span>min</span></div>
                    <div class="game-cd-box"><b data-cd="s">00</b><span>sec</span></div>
                </div>
            </div>
        @endif
        @if($participantsCount > 0)
            <div class="mt-3" style="color:rgba(255,255,255,.85);font-size:14px;">
                <strong style="color:#ec4899;">{{ number_format($participantsCount, 0, ',', ' ') }}</strong> participant{{ $participantsCount > 1 ? 's' : '' }} déjà en lice — rejoins-les !
            </div>
        @endif
    </div>

    @if($topParticipants->isNotEmpty() && $topParticipants->max('supports_count') > 0)
        <div class="d-flex align-items-center justify-content-between mb-3 mt-2">
            <h2 class="mb-0" style="color:#00234D;font-weight:800;font-size:20px;">Ils trustent le podium</h2>
        </div>
        <div class="game-podium">
            @foreach($topParticipants as $tp)
                <a href="{{ route('game.show', $tp->slug) }}" class="game-podium-card position-relative">
                    <span class="game-podium-rank">{{ $loop->iteration }}</span>
                    @if($tp->badge_path)
                        <img src="{{ asset($tp->badge_path) }}" alt="Badge de {{ $tp->public_name }}" class="game-podium-img" loading="lazy">
                    @else
                        <div class="game-podium-img d-flex align-items-center justify-content-center" style="color:#ec4899;font-weight:800;font-size:22px;">{{ mb_strtoupper(mb_substr($tp->public_name, 0, 1)) }}</div>
                    @endif
                    <div style="min-width:0;">
                        <div class="fw-bold text-truncate" style="color:#00234D;">{{ $tp->public_name }}</div>
                        <div style="color:#ec4899;font-size:13px;font-weight:600;">{{ number_format($tp->supports_count, 0, ',', ' ') }} soutien(s)</div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

    <div class="game-form-card" id="participer">
        <h2>Inscription au jeu</h2>
        <p class="sub">Tes informations personnelles (WhatsApp, ville) restent privées — seul ton nom public et ta photo apparaissent sur le badge.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form method="POST" action="{{ route('game.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nom</label>
                    <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Prénom(s)</label>
                    <input type="text" name="firstnames" class="form-control" value="{{ old('firstnames') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Numéro WhatsApp <span class="text-muted fw-normal">(privé)</span></label>
                    <input type="tel" name="whatsapp" class="form-control" value="{{ old('whatsapp') }}" placeholder="+225 07 00 00 00 00" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Ville / Commune <span class="text-muted fw-normal">(privé)</span></label>
                    <input type="text" name="city" class="form-control" value="{{ old('city') }}" placeholder="Ex: Abidjan, Cocody" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nom affiché publiquement</label>
                    <input type="text" name="public_name" class="form-control" value="{{ old('public_name') }}" placeholder="Ex: Awa la Boss" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Ta photo</label>
                    <input type="file" name="photo" class="form-control" accept="image/*" id="gamePhotoInput">
                    <img src="" alt="" class="game-photo-preview" id="gamePhotoPreview">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Le cadeau que tu veux gagner</label>
                    <div class="game-prizes">
                        @foreach($prizes as $prize)
                            <div class="game-prize">
                                <input type="radio" name="prize" id="prize{{ $loop->index }}" value="{{ $prize }}" @checked(old('prize') === $prize) required>
                                <label for="prize{{ $loop->index }}">{{ $prize }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="game-btn" id="gameSubmitBtn">Générer mon badge</button>
                    <p class="game-note">En participant, tu acceptes que ton nom public et ta photo apparaissent sur ta page de jeu. Ton numéro WhatsApp et ta ville ne seront jamais affichés.</p>
                </div>
            </div>
        </form>
    </div>

    @if($participants->isNotEmpty())
        <div class="d-flex align-items-center justify-content-between mb-4 mt-5">
            <h2 class="mb-0" style="color:#00234D;font-weight:800;font-size:24px;">Tous les participants</h2>
            <span class="badge rounded-pill" style="background:#ec4899;font-size:13px;padding:8px 16px;">{{ number_format($participantsCount, 0, ',', ' ') }} en lice</span>
        </div>
        <div class="game-grid">
            @foreach($participants as $p)
                <a href="{{ route('game.show', $p->slug) }}" class="game-card">
                    @if($p->badge_path)
                        <img src="{{ asset($p->badge_path) }}" alt="Badge de {{ $p->public_name }}" class="game-card-img" loading="lazy">
                    @else
                        <div class="game-card-img">{{ mb_strtoupper(mb_substr($p->public_name, 0, 1)) }}</div>
                    @endif
                    <div class="game-card-body">
                        <div class="game-card-name text-truncate">{{ $p->public_name }}</div>
                        <div class="small text-truncate" style="color:#888;">{{ $p->prize }}</div>
                        <div class="game-card-meta">
                            <span class="game-card-supports">{{ number_format($p->supports_count, 0, ',', ' ') }} soutien(s)</span>
                            <span style="color:#00234D;font-weight:700;">#{{ $loop->iteration }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

    <h2 class="text-center mb-4 mt-5" style="color:#00234D;font-weight:800;">Fonctionnement du jeu</h2>
    <div class="game-steps">
        <div class="game-step"><span class="game-step-num">Étape 1</span><h3>Découverte</h3><p>Découvre le jeu via une publication, une publicité, une story ou le badge partagé par un participant.</p></div>
        <div class="game-step"><span class="game-step-num">Étape 2</span><h3>Inscription</h3><p>Renseigne ton nom, ton WhatsApp, ta ville, ton nom public, ta photo et le cadeau souhaité.</p></div>
        <div class="game-step"><span class="game-step-num">Étape 3</span><h3>Création du badge</h3><p>Le système génère ton badge personnalisé : ta photo, ton nom public et le logo Mobilier Addict.</p></div>
        <div class="game-step"><span class="game-step-num">Étape 4</span><h3>Partage</h3><p>Télécharge ton badge et partage-le avec les hashtags #MobilierAddict #MatelasAddict en identifiant la page Facebook.</p></div>
        <div class="game-step"><span class="game-step-num">Étape 5</span><h3>Soutien</h3><p>Tes proches cliquent sur ton lien, te soutiennent sur ta page publique et découvrent nos produits.</p></div>
        <div class="game-step"><span class="game-step-num">Étape 6</span><h3>Nouvelle participation</h3><p>Après t'avoir soutenu, chaque visiteur est invité à créer son propre badge et à participer.</p></div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const photoInput = document.getElementById('gamePhotoInput');
        const preview = document.getElementById('gamePhotoPreview');
        if (photoInput && preview) {
            photoInput.addEventListener('change', function () {
                const file = this.files && this.files[0];
                if (file && file.type.startsWith('image/')) {
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                } else {
                    preview.style.display = 'none';
                }
            });
        }

        const whatsapp = document.querySelector('input[name="whatsapp"]');
        if (whatsapp) {
            whatsapp.addEventListener('blur', function () {
                this.value = this.value.replace(/[^\d+]/g, '');
            });
        }

        const cd = document.getElementById('gameCountdown');
        if (cd && cd.dataset.ends) {
            const end = new Date(cd.dataset.ends).getTime();
            const set = (k, v) => { const el = cd.querySelector(`[data-cd="${k}"]`); if (el) el.textContent = String(v).padStart(2, '0'); };
            const tick = () => {
                const diff = end - Date.now();
                if (diff <= 0) { location.reload(); return; }
                set('d', Math.floor(diff / 86400000));
                set('h', Math.floor(diff % 86400000 / 3600000));
                set('m', Math.floor(diff % 3600000 / 60000));
                set('s', Math.floor(diff % 60000 / 1000));
            };
            tick();
            setInterval(tick, 1000);
        }

        const form = document.querySelector('form[action="{{ route('game.store') }}"]');
        const submitBtn = document.getElementById('gameSubmitBtn');
        if (form && submitBtn) {
            form.addEventListener('submit', function () {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Génération en cours…';
            });
        }
    });
</script>
@endpush
@endsection
