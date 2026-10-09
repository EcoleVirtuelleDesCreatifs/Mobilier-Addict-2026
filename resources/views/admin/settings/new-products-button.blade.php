@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Bouton "Nouveaux produits"</h1>
                    <div class="small" style="color: var(--admin-muted);">Configure le bouton "Voir plus de nouveau produit" dans la section Nouveaux produits.</div>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-admin-ghost">Retour</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="fw-semibold mb-1">Veuillez corriger les erreurs :</div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.new-products-button.update') }}">
                        @csrf

                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label d-block">Activation</label>
                                <div class="form-check form-switch">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        role="switch"
                                        id="buttonEnabled"
                                        name="button_enabled"
                                        value="1"
                                        {{ $buttonEnabled ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="buttonEnabled">Afficher le bouton "Voir plus de nouveau produit"</label>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label class="form-label">Texte du bouton</label>
                                <input
                                    type="text"
                                    name="button_text"
                                    value="{{ $buttonText }}"
                                    class="form-control"
                                    placeholder="Ex: Voir plus de nouveaux produits"
                                >
                            </div>

                            <div class="col-12 col-lg-6">
                                <label class="form-label">URL du bouton</label>
                                <input
                                    type="text"
                                    name="button_url"
                                    value="{{ $buttonUrl }}"
                                    class="form-control"
                                    placeholder="Ex: /nouveautes"
                                >
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-admin-pink">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
