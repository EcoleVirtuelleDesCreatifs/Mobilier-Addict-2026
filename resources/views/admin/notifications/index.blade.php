@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Notifications</h1>
                    <div class="small" style="color: var(--admin-muted);">Consulte et traite les notifications.</div>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    @php
                        $unreadCount = auth()->user()?->unreadNotifications()->count() ?? 0;
                    @endphp
                    @if($unreadCount > 0)
                        <form method="POST" action="{{ route('admin.notifications.read-all') }}">
                            @csrf
                            <button type="submit" class="btn btn-admin-pink">Tout marquer comme lu</button>
                        </form>
                    @endif
                </div>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if(!empty($notificationsMissing))
                <div class="admin-card p-4">
                    <div class="alert alert-warning mb-0">La table <code>notifications</code> n'existe pas ou l'utilisateur n'est pas disponible.</div>
                </div>
            @else
                <div class="admin-card p-3 p-md-4 mb-3">
                    <form method="GET" action="{{ route('admin.notifications.index') }}" class="row g-2 align-items-end">
                        <div class="col-12 col-md-4">
                            <label class="form-label small" style="color: var(--admin-muted);">Lecture</label>
                            <select name="read" class="form-select">
                                <option value="" @selected(request('read') === '')>Toutes</option>
                                <option value="unread" @selected(request('read') === 'unread')>Non lues</option>
                                <option value="read" @selected(request('read') === 'read')>Lues</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label small" style="color: var(--admin-muted);">Traitement</label>
                            <select name="handled" class="form-select">
                                <option value="" @selected(request('handled') === '')>Tous</option>
                                <option value="unhandled" @selected(request('handled') === 'unhandled')>Non traitées</option>
                                <option value="handled" @selected(request('handled') === 'handled')>Traitées</option>
                            </select>
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
                                    <th>Notification</th>
                                    <th>Date</th>
                                    <th class="text-center">Lu</th>
                                    <th class="text-center">Traitée</th>
                                    <th style="width: 320px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notifications as $notification)
                                    @php
                                        $data = is_array($notification->data) ? $notification->data : [];
                                        $title = $data['title'] ?? 'Notification';
                                        $message = $data['message'] ?? '';
                                        $url = $data['url'] ?? null;
                                        $handledAt = $data['handled_at'] ?? null;
                                    @endphp
                                    <tr style="border-top: 1px solid var(--admin-border);">
                                        <td>
                                            <div class="fw-semibold">
                                                @if($url)
                                                    <a href="{{ $url }}" style="color: inherit;">{{ $title }}</a>
                                                @else
                                                    {{ $title }}
                                                @endif
                                            </div>
                                            @if($message)
                                                <div class="small" style="color: var(--admin-muted);">{{ $message }}</div>
                                            @endif
                                            <div class="small" style="color: var(--admin-muted);">#{{ $notification->id }}</div>
                                        </td>
                                        <td>
                                            <div class="small" style="color: var(--admin-muted);">{{ $notification->created_at?->format('d/m/Y H:i') }}</div>
                                        </td>
                                        <td class="text-center">
                                            @if(is_null($notification->read_at))
                                                <span class="badge badge-secondary">Non</span>
                                            @else
                                                <span class="badge badge-success">Oui</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(empty($handledAt))
                                                <span class="badge badge-secondary">Non</span>
                                            @else
                                                <span class="badge badge-success">Oui</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-2 flex-wrap">
                                                @if(is_null($notification->read_at))
                                                    <form method="POST" action="{{ route('admin.notifications.read', $notification->id) }}">
                                                        @csrf
                                                        <input type="hidden" name="redirect_to" value="{{ url()->full() }}">
                                                        <button type="submit" class="btn btn-sm btn-admin-pink">Marquer comme lu</button>
                                                    </form>
                                                @endif

                                                @if(empty($handledAt))
                                                    <form method="POST" action="{{ route('admin.notifications.handled', $notification->id) }}">
                                                        @csrf
                                                        <input type="hidden" name="redirect_to" value="{{ url()->full() }}">
                                                        <button type="submit" class="btn btn-sm btn-admin-ghost">Marquer comme traitée</button>
                                                    </form>
                                                @else
                                                    <form method="POST" action="{{ route('admin.notifications.unhandled', $notification->id) }}">
                                                        @csrf
                                                        <input type="hidden" name="redirect_to" value="{{ url()->full() }}">
                                                        <button type="submit" class="btn btn-sm btn-warning">Annuler le traitement</button>
                                                    </form>
                                                @endif

                                                @if($url)
                                                    <a href="{{ $url }}" class="btn btn-sm btn-admin-ghost">Ouvrir</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5" style="color: var(--admin-muted);">Aucune notification.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(method_exists($notifications, 'links'))
                    <div class="mt-3">
                        {{ $notifications->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
