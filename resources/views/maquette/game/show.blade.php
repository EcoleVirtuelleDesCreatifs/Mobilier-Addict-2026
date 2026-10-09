@extends('maquette.layout')

@section('title', $participant->public_name . ' participe au Grand Jeu — Mobilier Addict')
@section('meta_description', 'Soutiens ' . $participant->public_name . ' au Grand Jeu Mobilier Addict et découvre la collection.')
@if($participant->badge_path)
    @section('meta_image', image_url($participant->badge_path))
@endif

@section('content')
<style>
    .gshow-hero{background:linear-gradient(120deg,#00234D 55%,#0a3a75);border-radius:24px;color:#fff;overflow:hidden;position:relative;}
    .gshow-hero::after{content:'';position:absolute;width:380px;height:380px;border-radius:50%;background:radial-gradient(circle,rgba(236,72,153,.25),transparent 65%);bottom:-140px;right:-80px;}
    .gshow-grid{display:grid;grid-template-columns:380px 1fr;gap:40px;padding:44px;align-items:center;position:relative;z-index:1;}
    .gshow-badge{border-radius:18px;box-shadow:0 24px 60px rgba(0,0,0,.35);width:100%;height:auto;display:block;}
    .gshow-kicker{display:inline-flex;align-items:center;gap:10px;color:#ec4899;font-size:13px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;}
    .gshow-kicker::before{content:'';width:34px;height:2px;background:#ec4899;}
    .gshow-name{font-size:clamp(28px,4vw,44px);font-weight:800;color:#fff;margin:12px 0;}
    .gshow-name .pink{color:#ec4899;}
    .gshow-prize{color:rgba(255,255,255,.85);font-size:15px;line-height:1.7;}
    .gshow-count{display:inline-flex;align-items:center;gap:10px;background:rgba(236,72,153,.16);border:1px solid rgba(236,72,153,.5);color:#fff;border-radius:999px;padding:8px 20px;font-weight:700;margin:18px 0;}
    .gshow-btn{display:inline-flex;align-items:center;gap:10px;border-radius:999px;padding:14px 32px;font-weight:700;font-size:14px;letter-spacing:.04em;text-transform:uppercase;text-decoration:none;border:none;cursor:pointer;transition:.15s;}
    .gshow-btn:hover{transform:translateY(-2px);}
    .gshow-btn-pink{background:#ec4899;color:#fff;box-shadow:0 10px 26px rgba(236,72,153,.4);}
    .gshow-btn-pink:hover{color:#fff;}
    .gshow-btn-ghost{border:1px solid rgba(255,255,255,.5);color:#fff;}
    .gshow-btn-ghost:hover{color:#ec4899;border-color:#ec4899;}
    .gshow-share{display:flex;gap:10px;flex-wrap:wrap;margin-top:22px;}
    .gshow-share a{display:inline-flex;align-items:center;gap:8px;font-size:12.5px;font-weight:600;color:rgba(255,255,255,.85);border:1px solid rgba(255,255,255,.25);border-radius:999px;padding:8px 16px;text-decoration:none;}
    .gshow-share a:hover{color:#ec4899;border-color:#ec4899;}
    @media (max-width:991.98px){.gshow-grid{grid-template-columns:1fr;padding:28px;} .gshow-badge{max-width:340px;margin:0 auto;}}
</style>

<div class="container py-5">
    @if (session('status'))
        <div class="alert alert-success mb-4">{{ session('status') }}</div>
    @endif

    <div class="gshow-hero mb-5">
        <div class="gshow-grid">
            <div>
                @if($participant->badge_path)
                    <img src="{{ image_url($participant->badge_path) }}" alt="Badge de {{ $participant->public_name }}" class="gshow-badge">
                @endif
            </div>
            <div>
                <span class="gshow-kicker">Grand jeu</span>
                <h1 class="gshow-name">{{ $participant->public_name }} <span class="pink">participe !</span></h1>
                <p class="gshow-prize">et tente de gagner <strong>{{ $participant->prize }}</strong>. Soutiens sa participation en un clic — puis crée ton propre badge pour jouer à ton tour.</p>
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <div class="gshow-count">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 21s-7.5-4.9-9.5-9A5.4 5.4 0 0 1 12 6.5 5.4 5.4 0 0 1 21.5 12c-2 4.1-9.5 9-9.5 9Z" fill="#ec4899"/></svg>
                        {{ number_format($participant->supports_count, 0, ',', ' ') }} soutien(s)
                    </div>
                    <div class="gshow-count" style="background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.25);">
                        #{{ $rank }} au classement
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-3">
                    <form method="POST" action="{{ route('game.support', $participant->slug) }}">
                        @csrf
                        <button type="submit" class="gshow-btn gshow-btn-pink" {{ $alreadySupported ? 'disabled' : '' }}>{{ $alreadySupported ? 'Déjà soutenu ✓' : 'Je soutiens' }}</button>
                    </form>
                    @if($participant->badge_path)
                        <a href="{{ route('game.badge', $participant->slug) }}" class="gshow-btn gshow-btn-ghost">Télécharger le badge</a>
                    @endif
                </div>
                <div class="gshow-share">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($participant->publicUrl()) }}" target="_blank" rel="noopener">Partager sur Facebook</a>
                    <a href="https://wa.me/?text={{ urlencode('Soutiens ma participation au Grand Jeu Mobilier Addict ! ' . $participant->publicUrl() . ' #MobilierAddict #MatelasAddict') }}" target="_blank" rel="noopener">Partager sur WhatsApp</a>
                    <a href="#" id="copyGameLink" role="button">Copier le lien</a>
                    <a href="{{ route('game.index') }}">Créer mon badge →</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mb-4">
        <h2 class="fw-bold" style="color:#00234D;">Participe toi aussi</h2>
        <p class="text-muted">Crée ton badge en 2 minutes et tente de gagner un cadeau Mobilier Addict.</p>
        <a href="{{ route('game.index') }}" class="gshow-btn gshow-btn-pink">Je participe</a>
    </div>

    @if($products->isNotEmpty())
        <div class="mt-5">
            <h3 class="fw-bold mb-4" style="color:#00234D;">Découvre nos produits</h3>
            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-6 col-md-3">
                        <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none">
                            <div class="rounded-4 overflow-hidden mb-2" style="aspect-ratio:1;background:#f6f3f7;">
                                <img src="@image_url($product->image)" alt="{{ $product->name }}" loading="lazy" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                            <div class="fw-semibold" style="color:#00234D;font-size:14px;">{{ Str::limit($product->name, 40) }}</div>
                            <div style="color:#ec4899;font-weight:700;">{{ number_format((float) ($product->price ?? 0), 0, ',', ' ') }} F</div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('copyGameLink');
        if (!btn) return;
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const url = @json($participant->publicUrl());
            const done = () => { btn.textContent = 'Lien copié ✓'; setTimeout(() => btn.textContent = 'Copier le lien', 2500); };
            if (navigator.clipboard) {
                navigator.clipboard.writeText(url).then(done).catch(done);
            } else {
                const i = document.createElement('input');
                i.value = url; document.body.appendChild(i); i.select();
                document.execCommand('copy'); i.remove(); done();
            }
        });
    });
</script>
@endpush
@endsection
