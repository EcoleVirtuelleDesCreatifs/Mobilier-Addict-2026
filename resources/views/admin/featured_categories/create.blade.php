@extends('admin.layout')

@section('title', 'Créer une Catégorie Phare - Admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Créer une catégorie phare</h1>
            <div class="small" style="color: var(--admin-muted);">Ajouter une nouvelle catégorie à afficher sur la home page.</div>
        </div>
        <a href="{{ route('admin.featured_categories.index') }}" class="btn btn-admin-ghost">Retour</a>
    </div>

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

    <form method="POST" action="{{ route('admin.featured_categories.store') }}" class="row g-4" enctype="multipart/form-data">
        @csrf

        <div class="col-12 col-lg-5">
            <div class="admin-card p-4">
                <div class="fw-bold mb-3">Contenu</div>
                
                <div class="mb-3">
                    <label for="title" class="form-label">Titre *</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label for="menu_slug" class="form-label">Menu Slug</label>
                    <input type="text" class="form-control" id="menu_slug" name="menu_slug" value="{{ old('menu_slug') }}" placeholder="ex: matelas">
                    <small class="text-muted">Le slug du menu auquel cette catégorie est liée.</small>
                </div>

                <div class="mb-3">
                    <label for="cta" class="form-label">Bouton CTA</label>
                    <input type="text" class="form-control" id="cta" name="cta" value="{{ old('cta') ?? 'Découvrir' }}">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <small class="text-muted">Image de la catégorie (max 5MB).</small>
                </div>

                <div class="mb-3">
                    <label for="image_alt" class="form-label">Texte alternatif de l'image</label>
                    <input type="text" class="form-control" id="image_alt" name="image_alt" value="{{ old('image_alt') }}">
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-7">
            <div class="admin-card p-4">
                <div class="fw-bold mb-3">Configuration</div>
                
                <div class="mb-3">
                    <label for="order" class="form-label">Ordre d'affichage</label>
                    <input type="number" class="form-control" id="order" name="order" value="{{ old('order') ?? 0 }}" min="0">
                    <small class="text-muted">Plus le nombre est petit, plus la catégorie apparaîtra tôt.</small>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Activer cette catégorie
                        </label>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-admin-primary">Créer la catégorie</button>
                    <a href="{{ route('admin.featured_categories.index') }}" class="btn btn-admin-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
