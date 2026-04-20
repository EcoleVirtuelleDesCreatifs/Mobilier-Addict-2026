@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Modifier catégorie phare</h1>
                    <div class="small" style="color: var(--admin-muted);">{{ $featured_category->title }}</div>
                </div>
                <a href="{{ route('admin.featured_categories.index') }}" class="btn btn-admin-ghost">Retour</a>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
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

            <form method="POST" action="{{ route('admin.featured_categories.update', $featured_category) }}" enctype="multipart/form-data" class="admin-card p-4">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Titre</label>
                        <input type="text" name="title" value="{{ old('title', $featured_category->title) }}" class="form-control" required>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Menu Slug</label>
                        <input type="text" name="menu_slug" value="{{ old('menu_slug', $featured_category->menu_slug) }}" class="form-control">
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Bouton CTA</label>
                        <input type="text" name="cta" value="{{ old('cta', $featured_category->cta) }}" class="form-control">
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Image (laisser vide pour conserver)</label>
                        <input type="file" name="image" class="form-control">
                        @if($featured_category->image)
                            <div class="mt-2 rounded-3 overflow-hidden" style="width:120px;height:120px;border:1px solid var(--admin-border);">
                                <img src="@image_url($featured_category->image)" alt="" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label class="form-label">Texte alternatif (alt)</label>
                        <input type="text" name="image_alt" value="{{ old('image_alt', $featured_category->image_alt) }}" class="form-control">
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Ordre</label>
                        <input type="number" name="order" value="{{ old('order', $featured_category->order) }}" class="form-control">
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Actif</label>
                        <select name="is_active" class="form-select">
                            <option value="1" @selected(old('is_active', $featured_category->is_active ? 1 : 0) == 1)>Oui</option>
                            <option value="0" @selected(old('is_active', $featured_category->is_active ? 1 : 0) == 0)>Non</option>
                        </select>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.featured_categories.index') }}" class="btn btn-admin-ghost">Annuler</a>
                        <button type="submit" class="btn btn-admin-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
