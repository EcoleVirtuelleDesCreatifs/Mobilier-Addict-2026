@extends('layouts.admin')

@section('title', 'Facebook Pixel')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="text-black font-w600 mb-1">Facebook Pixel</h1>
                <p class="mb-0">Configure l’identifiant de ton pixel et active/désactive le suivi.</p>
            </div>
        </div>

        <div class="alert alert-info">
            <div class="fw-semibold mb-2">Étapes de configuration (Meta Business Manager)</div>
            <div class="mb-2">1) Récupérer le Pixel ID</div>
            <div class="ms-3">Business Manager → Sources de données → Pixels → sélectionner ton pixel → copier le Pixel ID.</div>
            <div class="mt-2 mb-2">2) Configurer ici</div>
            <div class="ms-3">Coller le Pixel ID dans le champ ci-dessous, activer “Activer Facebook Pixel”, puis Enregistrer.</div>
            <div class="mt-2 mb-2">3) Tester la réception des événements</div>
            <div class="ms-3">Events Manager → ton Pixel → “Test events” (ou “Tester les événements”) → ouvrir ton site sur le front → vérifier que “PageView” remonte.</div>
            <div class="mt-2 mb-0">4) (Optionnel mais recommandé) Vérifier le domaine</div>
            <div class="ms-3">Business Settings → Domains → ajouter et vérifier ton domaine. Nécessaire pour certaines configurations de conversions.</div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <div class="fw-semibold mb-1">Erreur</div>
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.settings.facebook-pixel.update') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Pixel ID</label>
                            <input
                                type="text"
                                name="pixel_id"
                                value="{{ old('pixel_id', $pixelId) }}"
                                class="form-control"
                                placeholder="Ex: 123456789012345"
                            >
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-label d-block">Activation</label>
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    role="switch"
                                    id="fbPixelEnabled"
                                    name="enabled"
                                    value="1"
                                    {{ old('enabled', $enabled ? '1' : '0') ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="fbPixelEnabled">Activer Facebook Pixel</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-admin-pink">Enregistrer</button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-admin-pink-outline">Retour</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
