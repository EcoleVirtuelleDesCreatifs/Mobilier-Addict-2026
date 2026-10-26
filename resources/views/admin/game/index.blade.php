@extends('layouts.admin')

@section('title', 'Grand Jeu')

@section('content')
    @php
        $supportsSortUrl = route('admin.game.index', array_merge(request()->except(['sort', 'dir', 'page']), ['sort' => 'supports', 'dir' => request('dir') === 'desc' ? 'asc' : 'desc']));
        $supportsSortIcon = request('sort') === 'supports' ? (request('dir') === 'asc' ? ' ↑' : ' ↓') : '';
    @endphp

    <div class="content-body">
        <div class="container-fluid">
            <x-admin.page-header title="Grand Jeu" subtitle="Participants, badges et soutiens du jeu Mobilier Addict.">
                <a href="{{ route('game.index') }}" target="_blank" rel="noopener" class="btn btn-admin-ghost"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Page publique</a>
            </x-admin.page-header>

            <div class="row g-3 mb-3">
                <div class="col-12 col-md-4">
                    <x-admin.stat label="Participants" :value="number_format($stats['total'], 0, ',', ' ')" icon="fa-solid fa-users" tone="navy" />
                </div>
                <div class="col-12 col-md-4">
                    <x-admin.stat label="Soutiens cumulés" :value="number_format($stats['supports'], 0, ',', ' ')" icon="fa-solid fa-heart" tone="pink" />
                </div>
                <div class="col-12 col-md-4">
                    <x-admin.stat label="Inscrits aujourd'hui" :value="number_format($stats['today'], 0, ',', ' ')" icon="fa-solid fa-user-plus" tone="green" />
                </div>
            </div>

            <div class="ad-card mb-3">
                <div class="ad-card-body d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-3">
                    <div>
                        <h2 class="ad-card-title mb-1"><i class="fa-regular fa-clock me-1"></i> Décompte du jeu</h2>
                        <div class="ad-sub">
                            @if ($gameClosed)
                                <span class="ad-badge is-red me-1">Jeu terminé</span> Les pages publiques sont fermées et le bandeau home est masqué.
                            @elseif ($gameEndsAt)
                                Fin programmée le <strong>{{ \Carbon\Carbon::parse($gameEndsAt)->format('d/m/Y à H:i') }}</strong> — la page se ferme automatiquement.
                            @else
                                Aucune date de fin définie — le jeu reste ouvert.
                            @endif
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.game.settings') }}" class="d-flex flex-wrap gap-2 align-items-end">
                        @csrf
                        <div>
                            <label class="form-label">Date et heure de fin</label>
                            <input type="datetime-local" name="game_ends_at" class="form-control" value="{{ $gameEndsAt ? \Carbon\Carbon::parse($gameEndsAt)->format('Y-m-d\TH:i') : '' }}">
                        </div>
                        <button type="submit" class="btn btn-admin-primary">Enregistrer</button>
                        @if ($gameEndsAt)
                            <button type="submit" name="game_ends_at" value="" class="btn btn-admin-ghost" formnovalidate>Rouvrir sans fin</button>
                        @endif
                    </form>
                </div>
            </div>

            <div class="ad-card mb-3">
                <form method="GET" action="{{ route('admin.game.index') }}" class="ad-filters" data-auto-submit>
                    <div class="ad-filter-grow">
                        <label class="form-label">Recherche</label>
                        <div class="ad-input-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Nom, WhatsApp, ville">
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary">Filtrer</button>
                        @if (request('q'))
                            <a href="{{ route('admin.game.index') }}" class="btn btn-admin-ghost">Réinitialiser</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="ad-card overflow-hidden">
                <div class="table-responsive">
                    <table class="table ad-table align-middle">
                        <thead>
                            <tr>
                                <th>Participant</th>
                                <th>Contact</th>
                                <th>Cadeau souhaité</th>
                                <th class="text-center"><a href="{{ $supportsSortUrl }}">Soutiens{{ $supportsSortIcon }}</a></th>
                                <th>Inscription</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($participants as $p)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            @if ($p->badge_path)
                                                <img src="{{ image_thumb($p->badge_path) }}" alt="" class="ad-thumb" width="48" height="48" loading="lazy" decoding="async">
                                            @else
                                                <span class="ad-thumb ad-thumb-placeholder"><i class="fa-solid fa-id-badge"></i></span>
                                            @endif
                                            <div style="min-width:0">
                                                <div class="ad-strong text-truncate" style="max-width:220px">{{ $p->public_name }}</div>
                                                <div class="ad-sub">{{ $p->firstnames }} {{ $p->lastname }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-nowrap"><i class="fa-brands fa-whatsapp me-1" style="color:#22c55e"></i>{{ $p->whatsapp }}</div>
                                        <div class="ad-sub">{{ $p->city }}</div>
                                    </td>
                                    <td class="ad-sub">{{ \Illuminate\Support\Str::limit($p->prize, 40) }}</td>
                                    <td class="text-center"><span class="badge badge-admin-pink">{{ number_format($p->supports_count) }}</span></td>
                                    <td class="ad-sub text-nowrap">{{ optional($p->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="ad-actions">
                                            <a href="{{ route('game.show', $p->slug) }}" target="_blank" rel="noopener" class="btn btn-sm btn-admin-ghost ad-btn-icon" title="Voir la page"><i class="fa-solid fa-eye"></i></a>
                                            @if (Route::has('admin.game.edit'))
                                                <a href="{{ route('admin.game.edit', $p) }}" class="btn btn-sm btn-admin-ghost ad-btn-icon" title="Modifier"><i class="fa-solid fa-pen"></i></a>
                                            @endif
                                            <form method="POST" action="{{ route('admin.game.destroy', $p) }}" data-confirm="Supprimer « {{ $p->public_name }} » et ses fichiers ?">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-admin-ghost ad-btn-icon text-danger" title="Supprimer"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"><div class="ad-empty"><i class="fa-solid fa-trophy"></i>Aucun participant.</div></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">{{ $participants->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
@endsection
