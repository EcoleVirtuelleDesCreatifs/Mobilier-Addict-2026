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
                    <form method="POST" action="{{ route('admin.quotes.destroy', $quote) }}" data-confirm="Supprimer définitivement ce devis ?">
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
                        <form method="POST" action="{{ route('admin.quotes.items.store', $quote) }}" class="px-4 pt-4" id="quoteItemForm">
                            <div id="quoteItemFeedback" class="alert d-none mb-3" role="status" aria-live="polite"></div>
                            @csrf
                            <div class="row g-2 align-items-end">
                                <div class="col-12 col-md-5">
                                    <label class="form-label mb-1">Désignation</label>
                                    <input type="text" name="custom_name" class="form-control" list="quoteProducts" value="{{ old('custom_name') }}" placeholder="Ex : 10 matelas 160×200…" autocomplete="off">
                                    <datalist id="quoteProducts">
                                        @foreach($products as $product)
                                            <option value="{{ $product->name }}" data-id="{{ $product->id }}" data-price="{{ (float) $product->price }}">{{ number_format((float) $product->price, 0, ',', '.') }}F</option>
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
                            <table class="table ad-table align-middle mb-0">
                                <tbody id="quoteItemsBody">
                                    @forelse($quote->items as $item)
                                        <tr style="border-top: 1px solid var(--admin-border);" data-quote-item="{{ $item->id }}">
                                            <td class="fw-semibold">{{ $item->product_name }}</td>
                                            <td class="text-end text-nowrap">{{ number_format((float) $item->unit_price, 0, ',', '.') }}F</td>
                                            <td class="text-center">× {{ $item->quantity }}</td>
                                            <td class="text-end fw-semibold text-nowrap">{{ number_format((float) $item->line_total, 0, ',', '.') }}F</td>
                                            <td class="text-end" style="width:44px;">
                                                <form method="POST" action="{{ route('admin.quotes.items.destroy', [$quote, $item]) }}" class="quote-remove-item">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-admin-ghost text-danger" title="Retirer">✕</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="quoteItemsEmpty">
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
                                        <span style="color: var(--admin-muted); font-size:13px;">Sous-total <strong id="quoteSubtotal">{{ number_format((float) $quote->subtotal, 0, ',', '.') }}F</strong> + livraison =</span>
                                        <span class="fw-bold ms-1" id="quoteTotal" style="font-size:18px;">{{ number_format((float) $quote->total, 0, ',', '.') }}F</span>
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
            const form = document.getElementById('quoteItemForm');
            const body = document.getElementById('quoteItemsBody');
            const feedback = document.getElementById('quoteItemFeedback');
            const nameInput = form?.querySelector('input[name="custom_name"]');
            const qtyInput = form?.querySelector('input[name="quantity"]');
            const priceInput = document.getElementById('quoteUnitPrice');
            const idInput = document.getElementById('quoteProductId');
            const options = document.querySelectorAll('#quoteProducts option');
            const csrf = form?.querySelector('input[name="_token"]')?.value;
            const money = value => new Intl.NumberFormat('fr-FR', { maximumFractionDigits: 0 }).format(Number(value) || 0) + 'F';
            const escapeHtml = value => String(value ?? '').replace(/[&<>'"]/g, char => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#039;', '"': '&quot;' }[char]));

            const showFeedback = (message, type = 'success') => {
                if (!feedback) return;
                feedback.className = `alert alert-${type} mb-3`;
                feedback.textContent = message;
            };

            const updateTotals = data => {
                const subtotal = document.getElementById('quoteSubtotal');
                const total = document.getElementById('quoteTotal');
                if (subtotal) subtotal.textContent = money(data.subtotal);
                if (total) total.textContent = money(data.total);
            };

            const rowHtml = item => `
                <tr style="border-top:1px solid var(--admin-border);" data-quote-item="${item.id}">
                    <td class="fw-semibold">${escapeHtml(item.name)}</td>
                    <td class="text-end text-nowrap">${money(item.unit_price)}</td>
                    <td class="text-center">× ${item.quantity}</td>
                    <td class="text-end fw-semibold text-nowrap">${money(item.line_total)}</td>
                    <td class="text-end" style="width:44px;">
                        <form method="POST" action="${escapeHtml(item.destroy_url)}" class="quote-remove-item">
                            <input type="hidden" name="_token" value="${escapeHtml(csrf)}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-admin-ghost text-danger" title="Retirer">✕</button>
                        </form>
                    </td>
                </tr>`;

            nameInput?.addEventListener('input', function () {
                idInput.value = '';
                options.forEach(function (option) {
                    if (option.value === nameInput.value) {
                        idInput.value = option.dataset.id || '';
                        priceInput.value = option.dataset.price || '';
                    }
                });
            });

            form?.addEventListener('submit', async function (event) {
                event.preventDefault();
                const button = form.querySelector('button[type="submit"]');
                const initialText = button.textContent;
                button.disabled = true;
                button.textContent = 'Ajout…';
                feedback?.classList.add('d-none');

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                        credentials: 'same-origin'
                    });
                    const data = await response.json();
                    if (!response.ok) {
                        const errors = data.errors ? Object.values(data.errors).flat().join(' ') : data.message;
                        throw new Error(errors || 'Impossible d’ajouter cette ligne.');
                    }

                    document.getElementById('quoteItemsEmpty')?.remove();
                    body.insertAdjacentHTML('beforeend', rowHtml(data.item));
                    updateTotals(data);
                    nameInput.value = '';
                    idInput.value = '';
                    qtyInput.value = '1';
                    priceInput.value = '';
                    nameInput.focus();
                    showFeedback(data.message);
                } catch (error) {
                    showFeedback(error.message, 'danger');
                } finally {
                    button.disabled = false;
                    button.textContent = initialText;
                }
            });

            body?.addEventListener('submit', async function (event) {
                const removeForm = event.target.closest('.quote-remove-item');
                if (!removeForm) return;
                event.preventDefault();
                if (!confirm('Retirer cette ligne du devis ?')) return;
                const row = removeForm.closest('[data-quote-item]');
                const button = removeForm.querySelector('button');
                button.disabled = true;

                try {
                    const response = await fetch(removeForm.action, {
                        method: 'DELETE',
                        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrf },
                        credentials: 'same-origin'
                    });
                    const data = await response.json();
                    if (!response.ok) throw new Error(data.message || 'Suppression impossible.');
                    row.remove();
                    updateTotals(data);
                    if (data.items_count === 0) {
                        body.innerHTML = '<tr id="quoteItemsEmpty"><td colspan="5" class="text-center py-4" style="color:var(--admin-muted);">Aucune ligne pour l’instant.</td></tr>';
                    }
                    showFeedback(data.message);
                } catch (error) {
                    button.disabled = false;
                    showFeedback(error.message, 'danger');
                }
            });
        });
    </script>
    @endpush
@endsection
