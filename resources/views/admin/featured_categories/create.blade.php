@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Nouvelle catégorie phare</h1>
                    <div class="small" style="color: var(--admin-muted);">Ajouter une catégorie à afficher sur la home page.</div>
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

            <form method="POST" action="{{ route('admin.featured_categories.store') }}" enctype="multipart/form-data" class="admin-card p-4">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Titre</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Menu Slug</label>
                        <input type="text" name="menu_slug" value="{{ old('menu_slug') }}" class="form-control">
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Bouton CTA</label>
                        <input type="text" name="cta" value="{{ old('cta') ?? 'Découvrir' }}" class="form-control">
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Texte alternatif (alt)</label>
                        <input type="text" name="image_alt" value="{{ old('image_alt') }}" class="form-control">
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Ordre</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" class="form-control">
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Actif</label>
                        <select name="is_active" class="form-select">
                            <option value="1" @selected(old('is_active', 1) == 1)>Oui</option>
                            <option value="0" @selected(old('is_active', 1) == 0)>Non</option>
                        </select>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.featured_categories.index') }}" class="btn btn-admin-ghost">Annuler</a>
                        <button type="submit" class="btn btn-admin-primary">Créer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
