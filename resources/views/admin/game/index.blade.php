@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Grand Jeu — Participants</h1>
                    <div class="small" style="color: var(--admin-muted);">Participants et soutiens du jeu Mobilier Addict.</div>
                </div>
                <a href="{{ route('game.index') }}" target="_blank" class="btn btn-admin-ghost">Voir la page publique</a>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="row g-3 mb-3">
                <div class="col-12 col-md-4">
                    <div class="admin-card stat-card stat-card--primary p-3">
                        <div class="small" style="color: var(--admin-muted);">Participants</div>
                        <div class="h4 fw-bold mb-0">{{ number_format($stats['total'], 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="admin-card stat-card stat-card--success p-3">
                        <div class="small" style="color: var(--admin-muted);">Soutiens cumulés</div>
                        <div class="h4 fw-bold mb-0">{{ number_format($stats['supports'], 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="admin-card stat-card stat-card--info p-3">
                        <div class="small" style="color: var(--admin-muted);">Inscrits aujourd'hui</div>
                        <div class="h4 fw-bold mb-0">{{ number_format($stats['today'], 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="admin-card p-3 p-md-4 mb-3">
                <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3">
                    <div>
                        <div class="fw-semibold">Décompte du jeu</div>
                        <div class="small" style="color: var(--admin-muted);">
                            @if($gameClosed)
                                <span class="badge bg-danger">Jeu terminé</span> — les pages publiques sont fermées et le bandeau home est masqué.
                            @elseif($gameEndsAt)
                                Fin programmée le <strong>{{ \Carbon\Carbon::parse($gameEndsAt)->format('d/m/Y à H:i') }}</strong> — à cette date, la page se ferme automatiquement.
                            @else
                                Aucune date de fin définie — le jeu reste ouvert.
                            @endif
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.game.settings') }}" class="d-flex gap-2 align-items-end">
                        @csrf
                        <div>
                            <label class="form-label small mb-1" style="color: var(--admin-muted);">Date et heure de fin</label>
                            <input type="datetime-local" name="game_ends_at" class="form-control" value="{{ $gameEndsAt ? \Carbon\Carbon::parse($gameEndsAt)->format('Y-m-d\TH:i') : '' }}">
                        </div>
                        <button type="submit" class="btn btn-admin-primary">Enregistrer</button>
                        @if($gameEndsAt)
                            <button type="submit" name="game_ends_at" value="" class="btn btn-admin-ghost" formnovalidate>Rouvrir sans fin</button>
                        @endif
                    </form>
                </div>
            </div>

            <div class="admin-card p-3 p-md-4 mb-3">
                <form method="GET" action="{{ route('admin.game.index') }}" class="row g-2 align-items-end">
                    <div class="col-12 col-md-6">
                        <label class="form-label small" style="color: var(--admin-muted);">Recherche</label>
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Nom, WhatsApp, ville">
                    </div>
                    <div class="col-12 col-md-auto">
                        <button type="submit" class="btn btn-admin-ghost">Filtrer</button>
                    </div>
                </form>
            </div>

            <div class="admin-card p-0 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-dark table-borderless align-middle mb-0" style="--bs-table-bg: transparent;">
                        <thead style="color: var(--admin-muted);">
                            <tr>
                                <th style="width:72px;">Badge</th>
                                <th>Participant</th>
                                <th>WhatsApp</th>
                                <th>Ville</th>
                                <th>Cadeau souhaité</th>
                                <th class="text-center">
                                    <a href="{{ route('admin.game.index', array_merge(request()->except(['sort','dir','page']), ['sort' => 'supports', 'dir' => request('dir') === 'desc' ? 'asc' : 'desc'])) }}" class="text-reset text-decoration-none">Soutiens{{ request('sort') === 'supports' ? (request('dir') === 'asc' ? ' ↑' : ' ↓') : '' }}</a>
                                </th>
                                <th>Date</th>
                                <th style="width:230px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($participants as $p)
                                <tr style="border-top: 1px solid var(--admin-border);">
                                    <td>
                                        <div class="rounded-3 overflow-hidden" style="width:48px;height:60px;border:1px solid var(--admin-border);">
                                            @if($p->badge_path)
                                                <img src="{{ asset($p->badge_path) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $p->public_name }}</div>
                                        <div class="small" style="color: var(--admin-muted);">{{ $p->firstnames }} {{ $p->lastname }}</div>
                                    </td>
                                    <td class="small">{{ $p->whatsapp }}</td>
                                    <td class="small">{{ $p->city }}</td>
                                    <td class="small">{{ Str::limit($p->prize, 40) }}</td>
                                    <td class="text-center"><span class="badge badge-admin-pink">{{ number_format($p->supports_count) }}</span></td>
                                    <td class="small">{{ optional($p->created_at)->format('d/m/Y H:i') }}</td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('game.show', $p->slug) }}" target="_blank" class="btn btn-sm btn-admin-ghost">Voir</a>
                                            <a href="{{ route('admin.game.edit', $p) }}" class="btn btn-sm btn-admin-primary">Modifier</a>
                                            <form method="POST" action="{{ route('admin.game.destroy', $p) }}" onsubmit="return confirm('Supprimer ce participant et ses fichiers ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="text-center py-5" style="color: var(--admin-muted);">Aucun participant.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">{{ $participants->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
@endsection
