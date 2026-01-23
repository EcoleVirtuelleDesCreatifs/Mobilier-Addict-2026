@extends('admin.layout')

@section('content')
    <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Modifier catégorie</h1>
            <div class="small" style="color: var(--admin-muted);">{{ $category->name }}</div>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-admin-ghost">Retour</a>
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

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data" class="admin-card p-4">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <label class="form-label">Nom</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" required>
            </div>
            <div class="col-12 col-lg-6">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" class="form-control">
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="col-12 col-lg-6">
                <label class="form-label">Image (laisser vide pour conserver)</label>
                <input type="file" name="image" class="form-control">
                <div class="mt-2 rounded-3 overflow-hidden" style="width:120px;height:120px;border:1px solid var(--admin-border);">
                    <img src="{{ asset($category->image) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <label class="form-label">Texte alternatif (alt)</label>
                <input type="text" name="image_alt" value="{{ old('image_alt', $category->image_alt) }}" class="form-control">
            </div>

            <div class="col-12 col-lg-4">
                <label class="form-label">Parent</label>
                <select name="parent_id" class="form-select">
                    <option value="">—</option>
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-lg-4">
                <label class="form-label">Taille</label>
                <select name="size" class="form-select" required>
                    @foreach(['small' => 'Small', 'medium' => 'Medium', 'large' => 'Large'] as $k => $v)
                        <option value="{{ $k }}" @selected(old('size', $category->size) === $k)>{{ $v }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-lg-2">
                <label class="form-label">Ordre</label>
                <input type="number" name="order" value="{{ old('order', $category->order) }}" class="form-control">
            </div>

            <div class="col-12 col-lg-2">
                <label class="form-label">Actif</label>
                <select name="is_active" class="form-select">
                    <option value="1" @selected(old('is_active', $category->is_active ? 1 : 0) == 1)>Oui</option>
                    <option value="0" @selected(old('is_active', $category->is_active ? 1 : 0) == 0)>Non</option>
                </select>
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" @checked(old('is_featured', $category->is_featured))>
                    <label class="form-check-label" for="is_featured">Mis en avant</label>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-end gap-2">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-admin-ghost">Annuler</a>
                <button type="submit" class="btn btn-admin-primary">Enregistrer</button>
            </div>
        </div>
    </form>
@endsection
