@extends('layouts.admin')

@php
    $statusMap = ['pending' => ['warning', 'En attente'], 'draft' => ['secondary', 'Brouillon'], 'sent' => ['info', 'Envoyé'], 'accepted' => ['success', 'Accepté'], 'rejected' => ['danger', 'Refusé']];
    [$statusBadge, $statusLabel] = $statusMap[$quote->status] ?? ['secondary', $quote->status];
    $waNumber = preg_replace('/\D/', '', (string) $quote->whatsapp);
    $waText = rawurlencode('Bonjour ' . trim(($quote->firstnames ?? '') . ' ' . ($quote->lastname ?? '')) . ', suite à votre demande de devis ' . $quote->number . ' chez Mobilier Addict :');
@endphp

@section('content')
    <div class="content-body">
        <div class="container-fluid">

            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Devis {{ $quote->number }} <span class="badge text-bg-{{ $statusBadge }} align-middle">{{ $statusLabel }}</span></h1>
                    <div class="small" style="color: var(--admin-muted);">
                        Demande reçue le {{ optional($quote->created_at)->format('d/m/Y à H:i') }}
                        @if($quote->order_id) • Commande <a href="{{ route('admin.orders.show', $quote->order_id) }}">#{{ $quote->order_id }}</a>@endif
                    </div>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    @if($waNumber)
                        <a href="https://wa.me/{{ $waNumber }}?text={{ $waText }}" target="_blank" rel="noopener" class="btn btn-admin-primary">Répondre sur WhatsApp</a>
                    @endif
                    <a href="{{ route('admin.quotes.index') }}" class="btn btn-admin-ghost">Retour</a>
                    <form method="POST" action="{{ route('admin.quotes.destroy', $quote) }}" onsubmit="return confirm('Supprimer définitivement ce devis ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-admin-ghost text-danger">Supprimer</button>
                    </form>
                </div>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
            @endif

            <div class="row g-3">

                {{-- La demande du client --}}
                <div class="col-12 col-lg-4">
                    <div class="admin-card p-4 h-100">
                        <div class="fw-bold mb-3">Demande du client</div>

                        @if($quote->company_name)
                            <div class="mb-2"><span style="color: var(--admin-muted);">Structure :</span> <span class="fw-semibold">{{ $quote->company_name }}</span></div>
                        @endif
                        @if($quote->organization_type)
                            <div class="mb-2"><span style="color: var(--admin-muted);">Type :</span> <span class="fw-semibold">{{ \App\Http\Controllers\DevisController::ORGANIZATION_TYPES[$quote->organization_type] ?? $quote->organization_type }}</span></div>
                        @endif
                        <div class="mb-2"><span style="color: var(--admin-muted);">Contact :</span> <span class="fw-semibold">{{ trim(($quote->lastname ?? '') . ' ' . ($quote->firstnames ?? '')) ?: '—' }}</span></div>
                        <div class="mb-2"><span style="color: var(--admin-muted);">WhatsApp :</span> <span class="fw-semibold">{{ $quote->whatsapp ?: '—' }}</span></div>
                        @if($quote->phone)
                            <div class="mb-2"><span style="color: var(--admin-muted);">Tél. :</span> <span class="fw-semibold">{{ $quote->phone }}</span></div>
                        @endif
                        @if($quote->email)
                            <div class="mb-2"><span style="color: var(--admin-muted);">E-mail :</span> <span class="fw-semibold">{{ $quote->email }}</span></div>
                        @endif
                        @if($quote->delivery_place)
                            <div class="mb-2"><span style="color: var(--admin-muted);">Livraison :</span> <span class="fw-semibold">{{ $quote->delivery_place }}{{ $quote->delivery_day ? ' — ' . $quote->delivery_day->format('d/m/Y') : '' }}</span></div>
                        @endif
                        @if($quote->budget_range)
                            <div class="mb-2"><span style="color: var(--admin-muted);">Budget :</span> <span class="fw-semibold">{{ \App\Http\Controllers\DevisController::BUDGET_RANGES[$quote->budget_range] ?? $quote->budget_range }}</span></div>
                        @endif

                        @if($quote->details)
                            <div class="mt-3">
                                <div class="small fw-semibold mb-1" style="color: var(--admin-muted);">Besoin exprimé</div>
                                <div class="p-3 rounded" style="background: rgba(236,72,153,.06); border: 1px solid rgba(236,72,153,.25); white-space: pre-line; font-size: 14px;">{{ $quote->details }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Le devis à établir : une seule zone de travail --}}
                <div class="col-12 col-lg-8">
                    <div class="admin-card p-0 overflow-hidden">
                        <div class="p-4 d-flex align-items-center justify-content-between" style="border-bottom: 1px solid var(--admin-border);">
                            <div>
                                <div class="fw-bold">Établir le devis</div>
                                <div class="small" style="color: var(--admin-muted);">Ajoutez des lignes d'après la demande, réglez les paramètres, enregistrez.</div>
                            </div>
                        </div>

                        {{-- Ajout rapide d'une ligne --}}
                        <form method="POST" action="{{ route('admin.quotes.items.store', $quote) }}" class="px-4 pt-4">
                            @csrf
                            <div class="row g-2 align-items-end">
                                <div class="col-12 col-md-5">
                                    <label class="form-label mb-1">Désignation</label>
                                    <input type="text" name="custom_name" class="form-control" list="quoteProducts" value="{{ old('custom_name') }}" placeholder="Ex : 10 matelas 160×200…" autocomplete="off">
                                    <datalist id="quoteProducts">
                                        @foreach($products as $product)
                                            <option value="{{ $product->name }}" data-price="{{ (float) $product->price }}">{{ number_format((float) $product->price, 0, ',', '.') }}F</option>
                                        @endforeach
                                    </datalist>
                                    <input type="hidden" name="product_id" id="quoteProductId">
                                </div>
                                <div class="col-4 col-md-2">
                                    <label class="form-label mb-1">Qté</label>
                                    <input type="number" name="quantity" min="1" value="1" class="form-control" required>
                                </div>
                                <div class="col-8 col-md-3">
                                    <label class="form-label mb-1">Prix unitaire (F)</label>
                                    <input type="number" name="unit_price" min="0" step="1" class="form-control" id="quoteUnitPrice" required>
                                </div>
                                <div class="col-12 col-md-2">
                                    <button type="submit" class="btn btn-admin-primary w-100">+ Ligne</button>
                                </div>
                            </div>
                        </form>

                        {{-- Lignes du devis --}}
                        <div class="table-responsive mt-3">
                            <table class="table table-dark table-borderless align-middle mb-0" style="--bs-table-bg: transparent;">
                                <tbody>
                                    @forelse($quote->items as $item)
                                        <tr style="border-top: 1px solid var(--admin-border);">
                                            <td class="fw-semibold">{{ $item->product_name }}</td>
                                            <td class="text-end text-nowrap">{{ number_format((float) $item->unit_price, 0, ',', '.') }}F</td>
                                            <td class="text-center">× {{ $item->quantity }}</td>
                                            <td class="text-end fw-semibold text-nowrap">{{ number_format((float) $item->line_total, 0, ',', '.') }}F</td>
                                            <td class="text-end" style="width:44px;">
                                                <form method="POST" action="{{ route('admin.quotes.items.destroy', [$quote, $item]) }}" onsubmit="return confirm('Retirer cette ligne ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-admin-ghost text-danger" title="Retirer">✕</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4" style="color: var(--admin-muted);">Aucune ligne pour l'instant.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Un seul formulaire : statut + livraison + validité + notes --}}
                        <form method="POST" action="{{ route('admin.quotes.update', $quote) }}" class="p-4" style="border-top: 1px solid var(--admin-border);">
                            @csrf
                            <div class="row g-3">
                                <div class="col-6 col-md-3">
                                    <label class="form-label mb-1">Statut</label>
                                    <select name="status" class="form-select">
                                        @foreach($statusMap as $v => [$b, $l])
                                            <option value="{{ $v }}" @selected($quote->status === $v)>{{ $l }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label mb-1">Livraison (F)</label>
                                    <input type="number" name="shipping_amount" min="0" step="1" value="{{ old('shipping_amount', (float) $quote->shipping_amount) }}" class="form-control">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label mb-1">Valable jusqu'au</label>
                                    <input type="date" name="expires_at" value="{{ old('expires_at', optional($quote->expires_at)->format('Y-m-d')) }}" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label class="form-label mb-1">Notes pour le client</label>
                                    <input type="text" name="notes" class="form-control" value="{{ old('notes', $quote->notes) }}" placeholder="Ex : devis valable 7 jours, montage inclus…">
                                </div>
                                <div class="col-12 d-flex align-items-center justify-content-between flex-wrap gap-3">
                                    <div style="min-width:220px;">
                                        <span style="color: var(--admin-muted); font-size:13px;">Sous-total {{ number_format((float) $quote->subtotal, 0, ',', '.') }}F + livraison =</span>
                                        <span class="fw-bold ms-1" style="font-size:18px;">{{ number_format((float) $quote->total, 0, ',', '.') }}F</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-admin-primary">Enregistrer le devis</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nameInput = document.querySelector('input[name="custom_name"]');
            const priceInput = document.getElementById('quoteUnitPrice');
            const idInput = document.getElementById('quoteProductId');
            const options = document.querySelectorAll('#quoteProducts option');
            if (!nameInput) return;
            nameInput.addEventListener('input', function () {
                idInput.value = '';
                options.forEach(function (o) {
                    if (o.value === nameInput.value) {
                        const p = o.dataset.price;
                        if (p && (!priceInput.value || priceInput.value === '0')) priceInput.value = p;
                    }
                });
            });
        });
    </script>
    @endpush
@endsection
