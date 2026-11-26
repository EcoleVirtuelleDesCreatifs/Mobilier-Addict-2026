@extends('layouts.admin')

@section('title', 'Statistiques')

@php
    $fmt = fn ($n, $dec = 0) => number_format((float) $n, $dec, ',', ' ');
    $delta = function ($now, $before) {
        if ((float) $before == 0.0) {
            return (float) $now > 0 ? ['txt' => 'nouveau', 'cls' => 'up'] : ['txt' => '—', 'cls' => 'flat'];
        }
        $pct = ($now - $before) / $before * 100;

        return ['txt' => ($pct >= 0 ? '+' : '') . number_format($pct, 0, ',', ' ') . ' %', 'cls' => $pct > 0.5 ? 'up' : ($pct < -0.5 ? 'down' : 'flat')];
    };
    $kpis = [
        ['label' => 'Visiteurs' . ($countryName ? ' (CI)' : ''), 'value' => $fmt($current['visitors']), 'd' => $delta($current['visitors'], $previous['visitors']), 'icon' => 'fa-users', 'tone' => '#2563eb'],
        ['label' => 'Commandes', 'value' => $fmt($current['orders']), 'd' => $delta($current['orders'], $previous['orders']), 'icon' => 'fa-bag-shopping', 'tone' => '#F0286E'],
        ['label' => "Chiffre d'affaires", 'value' => $fmt($current['revenue']) . ' F', 'd' => $delta($current['revenue'], $previous['revenue']), 'icon' => 'fa-coins', 'tone' => '#16a34a'],
        ['label' => 'Taux de conversion', 'value' => $fmt($current['conversion'], 2) . ' %', 'd' => $delta($current['conversion'], $previous['conversion']), 'icon' => 'fa-bullseye', 'tone' => '#7c3aed'],
        ['label' => 'Panier moyen', 'value' => $fmt($current['basket']) . ' F', 'd' => $delta($current['basket'], $previous['basket']), 'icon' => 'fa-receipt', 'tone' => '#d97706'],
        ['label' => 'Pages vues', 'value' => $fmt($current['pages']), 'd' => $delta($current['pages'], $previous['pages']), 'icon' => 'fa-file-lines', 'tone' => '#0891b2'],
    ];

    // Courbe SVG (visiteurs) + barres (commandes)
    $W = 760; $H = 220; $pad = 28;
    $series = $days->values();
    $n = max(1, $series->count() - 1);
    $maxV = max(1, $series->max('visitors'));
    $maxO = max(1, $series->max('orders'));
    $x = fn ($i) => $pad + ($W - 2 * $pad) * $i / $n;
    $y = fn ($v) => $H - $pad - ($H - 2 * $pad) * $v / $maxV;
    $line = $series->map(fn ($r, $i) => round($x($i), 1) . ',' . round($y($r['visitors']), 1))->implode(' ');
    $area = round($x(0), 1) . ',' . ($H - $pad) . ' ' . $line . ' ' . round($x($series->count() - 1), 1) . ',' . ($H - $pad);
    $barW = max(2, ($W - 2 * $pad) / max(1, $series->count()) * 0.45);
    $dayKeys = $days->keys()->values();

    $funnelMax = max(1, $funnel[0]['value']);
@endphp

@push('styles')
<style>
    .st-head{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:16px;margin-bottom:20px}
    .st-month{display:flex;align-items:center;gap:6px}
    .st-month a,.st-month span{display:inline-grid;place-items:center;height:38px;min-width:38px;padding:0 12px;border-radius:999px;border:1px solid var(--admin-border);background:var(--admin-card-bg,#fff);color:inherit;text-decoration:none;font-weight:600}
    .st-month span{text-transform:capitalize;min-width:150px}
    .st-month a:hover{border-color:#F0286E;color:#F0286E}
    .st-kpis{display:grid;grid-template-columns:repeat(6,minmax(0,1fr));gap:14px;margin-bottom:18px}
    .st-kpi{position:relative;padding:18px;border-radius:16px;background:var(--admin-card-bg,#fff);border:1px solid var(--admin-border);overflow:hidden}
    .st-kpi::before{content:'';position:absolute;inset:0 auto 0 0;width:4px;background:var(--tone)}
    .st-kpi i{color:var(--tone);font-size:15px}
    .st-kpi small{display:block;margin-top:8px;font-size:12px;color:var(--admin-muted)}
    .st-kpi b{display:block;font-size:24px;line-height:1.2;letter-spacing:-.02em}
    .st-delta{display:inline-block;margin-top:6px;padding:2px 8px;border-radius:999px;font-size:11.5px;font-weight:700}
    .st-delta.up{background:rgba(22,163,74,.12);color:#16a34a}.st-delta.down{background:rgba(225,29,72,.12);color:#e11d48}.st-delta.flat{background:rgba(100,116,139,.12);color:#64748b}
    .st-card{padding:20px;border-radius:16px;background:var(--admin-card-bg,#fff);border:1px solid var(--admin-border);height:100%}
    .st-card h2{font-size:15px;font-weight:700;margin:0 0 4px}
    .st-card .st-sub{font-size:12px;color:var(--admin-muted);margin-bottom:14px}
    .st-chart svg{width:100%;height:auto;display:block}
    .st-legend{display:flex;gap:16px;font-size:12px;color:var(--admin-muted)}
    .st-legend i{display:inline-block;width:10px;height:10px;border-radius:3px;margin-right:6px;vertical-align:-1px}
    .st-row{display:grid;grid-template-columns:minmax(0,1fr) auto;gap:4px 12px;align-items:center;padding:8px 0;border-top:1px solid var(--admin-border);font-size:13.5px}
    .st-row:first-of-type{border-top:0}
    .st-row .lbl{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-weight:600}
    .st-row .lbl small{font-weight:400;color:var(--admin-muted)}
    .st-row .val{font-weight:700}
    .st-row .bar{grid-column:1/-1;height:6px;border-radius:999px;background:rgba(100,116,139,.12);overflow:hidden}
    .st-row .bar span{display:block;height:100%;border-radius:inherit;background:var(--tone,#F0286E)}
    .st-funnel{display:grid;gap:10px}
    .st-step{display:grid;grid-template-columns:minmax(0,1fr) auto;gap:6px 12px;align-items:baseline;font-size:13.5px}
    .st-step .track{grid-column:1/-1;display:block;height:14px;border-radius:999px;background:rgba(100,116,139,.1);overflow:hidden}
    .st-step .fill{display:block;height:100%;border-radius:999px;background:linear-gradient(90deg,#0B1A3F,#F0286E);min-width:6px}
    .st-step .rate{margin-left:6px;font-size:12px;color:var(--admin-muted)}
    .st-step b{font-size:15px}
    .st-empty{padding:26px 0;text-align:center;color:var(--admin-muted);font-size:13px}
    @media(max-width:1399.98px){.st-kpis{grid-template-columns:repeat(3,minmax(0,1fr))}}
    @media(max-width:767.98px){.st-kpis{grid-template-columns:repeat(2,minmax(0,1fr))}.st-step{grid-template-columns:110px minmax(0,1fr) 70px}}
</style>
@endpush

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="st-head">
            <div>
                <h1 class="h3 fw-bold mb-1">Statistiques</h1>
                <div class="small" style="color: var(--admin-muted);">
                    Comparaison avec {{ $previousMonth }}{{ $isPartialCompare ? ' à la même date' : '' }}.
                    @if($countryName) Audience : visiteurs de {{ $countryName }} uniquement. @endif
                </div>
            </div>
            <nav class="st-month" aria-label="Choisir le mois">
                <a href="{{ route('admin.stats.index', ['month' => $prevMonthValue]) }}" aria-label="Mois précédent">‹</a>
                <span>{{ $currentMonth }}</span>
                @if($nextMonthValue)<a href="{{ route('admin.stats.index', ['month' => $nextMonthValue]) }}" aria-label="Mois suivant">›</a>@endif
                @if($nextMonthValue)<a href="{{ route('admin.stats.index') }}">Ce mois</a>@endif
            </nav>
        </div>

        <div class="st-kpis">
            @foreach($kpis as $k)
                <div class="st-kpi" style="--tone: {{ $k['tone'] }}">
                    <i class="fa-solid {{ $k['icon'] }}"></i>
                    <small>{{ $k['label'] }}</small>
                    <b>{{ $k['value'] }}</b>
                    <span class="st-delta {{ $k['d']['cls'] }}" title="Par rapport à {{ $previousMonth }}">{{ $k['d']['txt'] }}</span>
                </div>
            @endforeach
        </div>

        <div class="row g-3 mb-3">
            <div class="col-12 col-xxl-8">
                <div class="st-card st-chart">
                    <div class="d-flex flex-wrap justify-content-between gap-2">
                        <div><h2>Visiteurs et commandes, jour par jour</h2><div class="st-sub">{{ ucfirst($currentMonth) }}</div></div>
                        <div class="st-legend"><span><i style="background:#2563eb"></i>Visiteurs</span><span><i style="background:#F0286E"></i>Commandes</span></div>
                    </div>
                    <svg viewBox="0 0 {{ $W }} {{ $H }}" role="img" aria-label="Évolution des visiteurs et des commandes">
                        <defs><linearGradient id="stArea" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#2563eb" stop-opacity=".22"/><stop offset="1" stop-color="#2563eb" stop-opacity="0"/></linearGradient></defs>
                        @foreach([0, .5, 1] as $g)
                            <line x1="{{ $pad }}" x2="{{ $W - $pad }}" y1="{{ $y($maxV * $g) }}" y2="{{ $y($maxV * $g) }}" stroke="currentColor" stroke-opacity=".08"/>
                            <text x="{{ $pad - 6 }}" y="{{ $y($maxV * $g) + 4 }}" font-size="10" text-anchor="end" fill="currentColor" fill-opacity=".45">{{ (int) round($maxV * $g) }}</text>
                        @endforeach
                        @foreach($series as $i => $r)
                            @if($r['orders'])
                                <rect x="{{ round($x($i) - $barW / 2, 1) }}" y="{{ round($H - $pad - ($H - 2 * $pad) * 0.55 * $r['orders'] / $maxO, 1) }}" width="{{ round($barW, 1) }}" height="{{ round(($H - 2 * $pad) * 0.55 * $r['orders'] / $maxO, 1) }}" rx="2" fill="#F0286E" fill-opacity=".85"><title>{{ \Carbon\Carbon::parse($dayKeys[$i])->format('d/m') }} : {{ $r['orders'] }} commande(s)</title></rect>
                            @endif
                        @endforeach
                        <polygon points="{{ $area }}" fill="url(#stArea)"/>
                        <polyline points="{{ $line }}" fill="none" stroke="#2563eb" stroke-width="2.5" stroke-linejoin="round" stroke-linecap="round"/>
                        @foreach($series as $i => $r)
                            <circle cx="{{ round($x($i), 1) }}" cy="{{ round($y($r['visitors']), 1) }}" r="3" fill="#2563eb"><title>{{ \Carbon\Carbon::parse($dayKeys[$i])->format('d/m') }} : {{ $r['visitors'] }} visiteur(s)</title></circle>
                            @if($i % 5 === 0 || $i === $series->count() - 1)
                                <text x="{{ round($x($i), 1) }}" y="{{ $H - 8 }}" font-size="10" text-anchor="middle" fill="currentColor" fill-opacity=".45">{{ \Carbon\Carbon::parse($dayKeys[$i])->format('d/m') }}</text>
                            @endif
                        @endforeach
                    </svg>
                </div>
            </div>
            <div class="col-12 col-xxl-4">
                <div class="st-card">
                    <h2>Parcours d'achat</h2>
                    <div class="st-sub">Du premier passage à la commande</div>
                    <div class="st-funnel">
                        @foreach($funnel as $i => $s)
                            <div class="st-step">
                                <span>{{ $s['label'] }}</span>
                                <span class="text-end"><b>{{ $fmt($s['value']) }}</b>@if($i > 0)<span class="rate">{{ $funnel[$i - 1]['value'] ? $fmt(min(100, $s['value'] / $funnel[$i - 1]['value'] * 100), 1) . ' %' : '—' }}</span>@endif</span>
                                <span class="track"><span class="fill" style="width: {{ max(1, min(100, round($s['value'] / $funnelMax * 100))) }}%; opacity: {{ 1 - $i * .15 }}"></span></span>
                            </div>
                        @endforeach
                    </div>
                    <div class="pf-hint small mt-3" style="color: var(--admin-muted);">Le % indique la part de l'étape précédente qui passe à la suivante : la plus faible est le point à améliorer en priorité.</div>
                </div>
            </div>
        </div>

        @php
            $blocks = [
                ['title' => $countryName ? "Villes de {$countryName}" : 'Villes', 'sub' => 'Visiteurs uniques', 'rows' => $cities, 'tone' => '#2563eb'],
                ['title' => 'Régions / districts', 'sub' => 'Visiteurs uniques', 'rows' => $regions, 'tone' => '#0891b2'],
                ['title' => 'Sources de trafic', 'sub' => 'D’où viennent les visiteurs', 'rows' => $sources, 'tone' => '#7c3aed'],
                ['title' => 'Produits les plus vus', 'sub' => 'Pages produit consultées', 'rows' => $topViewed, 'tone' => '#d97706'],
                ['title' => 'Produits les plus vendus', 'sub' => 'Quantités commandées', 'rows' => $topSold, 'tone' => '#F0286E'],
            ];
        @endphp
        <div class="row g-3">
            @foreach($blocks as $b)
                <div class="col-12 col-lg-6 col-xxl-4">
                    <div class="st-card" style="--tone: {{ $b['tone'] }}">
                        <h2>{{ $b['title'] }}</h2>
                        <div class="st-sub">{{ $b['sub'] }} · {{ $currentMonth }}</div>
                        @php($max = max(1, (int) collect($b['rows'])->max('value')))
                        @forelse($b['rows'] as $row)
                            <div class="st-row">
                                <span class="lbl" title="{{ $row['label'] }}">
                                    @if(!empty($row['url']))<a href="{{ $row['url'] }}" class="text-reset text-decoration-none">{{ $row['label'] }}</a>@else{{ $row['label'] }}@endif
                                    @if(!empty($row['detail']))<small> · {{ $row['detail'] }}</small>@endif
                                </span>
                                <span class="val">{{ $fmt($row['value']) }}@if(isset($row['total']))<small class="fw-normal text-muted"> · {{ $fmt($row['total']) }} F</small>@endif</span>
                                <span class="bar"><span style="width: {{ round($row['value'] / $max * 100) }}%"></span></span>
                            </div>
                        @empty
                            <div class="st-empty">Pas encore de données sur cette période.</div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
