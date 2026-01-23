@extends('admin.layout')

@section('content')
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Commandes</h1>
            <div class="small" style="color: var(--admin-muted);">Cette page est prête, mais il manque encore un modèle/table Order dans le projet.</div>
        </div>
    </div>

    <div class="admin-card p-4">
        <div class="alert alert-info mb-0">
            Pour activer la gestion des commandes, il faut créer:
            <div class="mt-2">
                <div class="small">- une migration <code>orders</code> + éventuellement <code>order_items</code></div>
                <div class="small">- un modèle <code>Order</code></div>
                <div class="small">- et brancher le checkout côté site</div>
            </div>
        </div>
    </div>
@endsection
