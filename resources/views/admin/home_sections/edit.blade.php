@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Gérer la section</h1>
            <div class="small" style="color: var(--admin-muted);">{{ $section->title }} ({{ $section->slug }})</div>
        </div>
        <a href="{{ route('admin.home_sections.index') }}" class="btn btn-admin-ghost">Retour</a>
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

    <form method="POST" action="{{ route('admin.home_sections.update', $section) }}" class="row g-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="col-12 col-lg-5">
            <div class="admin-card p-4">
                <div class="fw-bold mb-3">Contenu</div>

                <div class="mb-3">
                    <label class="form-label">Badge</label>
                    <input type="text" name="badge" value="{{ old('badge', $section->badge) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Badge icon (emoji ou texte)</label>
                    <input type="text" name="badge_icon" value="{{ old('badge_icon', $section->badge_icon) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Titre</label>
                    <input type="text" name="title" value="{{ old('title', $section->title) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $section->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image de couverture</label>
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                    @if($section->cover_image)
                        <div class="rounded-3 overflow-hidden mt-2" style="width:100%;height:140px;border:1px solid var(--admin-border);">
                            <img src="{{ asset($section->cover_image) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                    @endif
                </div>

                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-label">Ordre</label>
                        <input type="number" name="order" value="{{ old('order', $section->order) }}" class="form-control">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Active</label>
                        <select name="is_active" class="form-select">
                            <option value="1" @selected(old('is_active', $section->is_active ? 1 : 0) == 1)>Oui</option>
                            <option value="0" @selected(old('is_active', $section->is_active ? 1 : 0) == 0)>Non</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="submit" class="btn btn-admin-primary">Enregistrer</button>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-7">
            <div class="admin-card p-4">
                <div class="d-flex align-items-center justify-content-between gap-3 mb-3">
                    <div>
                        <div class="fw-bold">Catégories affichées</div>
                        <div class="small" style="color: var(--admin-muted);">Coche les catégories à afficher dans cette section de la home.</div>
                    </div>
                </div>

                <div class="row g-2">
                    @foreach($categories as $category)
                        <div class="col-12 col-md-6">
                            <label class="admin-card p-3 d-flex align-items-center gap-3" style="cursor:pointer; box-shadow:none;">
                                <input class="form-check-input m-0" type="checkbox" name="category_ids[]" value="{{ $category->id }}" @checked(old('category_ids') ? in_array($category->id, old('category_ids', [])) : ($category->section_id === $section->id))>
                                <div class="rounded-3 overflow-hidden" style="width:52px;height:52px;border:1px solid var(--admin-border); flex:0 0 auto;">
                                    <img src="{{ asset($category->image) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                                </div>
                                <div class="min-w-0">
                                    <div class="fw-semibold text-truncate">{{ $category->name }}</div>
                                    <div class="small" style="color: var(--admin-muted);">{{ $category->slug }}</div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
        </div>
    </div>
@endsection
