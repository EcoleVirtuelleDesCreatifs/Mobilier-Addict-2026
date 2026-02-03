@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Créer une section</h1>
            <div class="small" style="color: var(--admin-muted);">Créer une nouvelle section de la home.</div>
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

    <form method="POST" action="{{ route('admin.home_sections.store') }}" class="row g-3" enctype="multipart/form-data">
        @csrf

        <div class="col-12 col-lg-5">
            <div class="admin-card p-4">
                <div class="fw-bold mb-3">Contenu</div>

                <div class="mb-3">
                    <label class="form-label">Badge</label>
                    <input type="text" name="badge" value="{{ old('badge') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Badge icon (emoji ou texte)</label>
                    <input type="text" name="badge_icon" value="{{ old('badge_icon') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Titre</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Slug (optionnel)</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image de couverture</label>
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Contenu (JSON)</label>
                    <textarea name="content" class="form-control" rows="10">{{ old('content') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Couleur / Background (CSS)</label>
                    <input type="text" name="background_color" value="{{ old('background_color') }}" class="form-control" placeholder="#fde7f3 ou linear-gradient(...)">
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <input type="text" name="type" value="{{ old('type') }}" class="form-control" placeholder="custom, categories, ...">
                </div>

                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-label">Ordre</label>
                        <input type="number" name="order" value="{{ old('order', $nextOrder) }}" class="form-control">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Active</label>
                        <select name="is_active" class="form-select">
                            <option value="1" @selected(old('is_active', 1) == 1)>Oui</option>
                            <option value="0" @selected(old('is_active', 1) == 0)>Non</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="submit" class="btn btn-admin-primary">Créer</button>
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
                                <input class="form-check-input m-0" type="checkbox" name="category_ids[]" value="{{ $category->id }}" @checked(in_array($category->id, old('category_ids', [])))>
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
