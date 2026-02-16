@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Gérer la section</h1>
                    <div class="small" style="color: var(--admin-muted);">{{ $section->title }}</div>
                </div>
                <a href="{{ route('admin.space_sections.index') }}" class="btn btn-admin-ghost">Retour</a>
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

            <form method="POST" action="{{ route('admin.space_sections.update', $section) }}" class="row g-3">
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
                            <label class="form-label">Sous-titre</label>
                            <textarea name="subtitle" class="form-control" rows="4">{{ old('subtitle', $section->subtitle) }}</textarea>
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
            </form>

            <div class="row g-3 mt-1">
                <div class="col-12">
                    <div class="admin-card p-4">
                        <div class="d-flex align-items-center justify-content-between gap-3 mb-3">
                            <div>
                                <div class="fw-bold">Cartes</div>
                                <div class="small" style="color: var(--admin-muted);">Gère les cartes (image, lien, texte, ordre).</div>
                            </div>
                        </div>

                        <div class="row g-3">
                            @foreach(($section->cards ?? collect()) as $card)
                                <div class="col-12">
                                    <div class="admin-card p-3" style="box-shadow:none;">
                                        <div class="d-flex flex-column flex-md-row gap-3">
                                            <div class="rounded-3 overflow-hidden" style="width: 220px; height: 120px; border: 1px solid var(--admin-border); flex: 0 0 auto;">
                                                <img src="@image_url($card->image)" alt="" style="width:100%;height:100%;object-fit:cover;">
                                            </div>

                                            <div class="flex-grow-1">
                                                <form method="POST" action="{{ route('admin.space_sections.cards.update', [$section, $card]) }}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="row g-2">
                                                    <div class="col-12 col-md-6">
                                                        <label class="form-label">Titre</label>
                                                        <input type="text" name="title" value="{{ old('title', $card->title) }}" class="form-control" required>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label class="form-label">Taille</label>
                                                        <select name="size" class="form-select">
                                                            <option value="small" @selected(old('size', $card->size) === 'small')>Small</option>
                                                            <option value="large" @selected(old('size', $card->size) === 'large')>Large</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" class="form-control" rows="2">{{ old('description', $card->description) }}</textarea>
                                                    </div>

                                                    <div class="col-12 col-md-6">
                                                        <label class="form-label">Texte CTA</label>
                                                        <input type="text" name="cta_text" value="{{ old('cta_text', $card->cta_text) }}" class="form-control">
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label class="form-label">URL CTA</label>
                                                        <input type="text" name="cta_url" value="{{ old('cta_url', $card->cta_url) }}" class="form-control">
                                                    </div>

                                                    <div class="col-12 col-md-6">
                                                        <label class="form-label">Image (optionnel)</label>
                                                        <input type="file" name="image" class="form-control" accept="image/*">
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label class="form-label">Alt image</label>
                                                        <input type="text" name="image_alt" value="{{ old('image_alt', $card->image_alt) }}" class="form-control">
                                                    </div>

                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label">Ordre</label>
                                                        <input type="number" name="order" value="{{ old('order', $card->order) }}" class="form-control">
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label">Active</label>
                                                        <select name="is_active" class="form-select">
                                                            <option value="1" @selected(old('is_active', $card->is_active ? 1 : 0) == 1)>Oui</option>
                                                            <option value="0" @selected(old('is_active', $card->is_active ? 1 : 0) == 0)>Non</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-md-6 d-flex align-items-end justify-content-end gap-2">
                                                        <button type="submit" class="btn btn-admin-primary">Enregistrer</button>
                                                    </div>
                                                    </div>
                                                </form>

                                                <form method="POST" action="{{ route('admin.space_sections.cards.destroy', [$section, $card]) }}" class="mt-2 d-flex justify-content-end">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-admin-ghost">Supprimer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr style="border-color: var(--admin-border);" class="my-4">

                        <div class="fw-bold mb-2">Ajouter une carte</div>
                        <form method="POST" action="{{ route('admin.space_sections.cards.store', $section) }}" enctype="multipart/form-data" class="row g-2">
                            @csrf

                            <div class="col-12 col-md-6">
                                <label class="form-label">Titre</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Taille</label>
                                <select name="size" class="form-select">
                                    <option value="small">Small</option>
                                    <option value="large">Large</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Alt image</label>
                                <input type="text" name="image_alt" class="form-control">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Texte CTA</label>
                                <input type="text" name="cta_text" class="form-control">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">URL CTA</label>
                                <input type="text" name="cta_url" class="form-control">
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label">Ordre</label>
                                <input type="number" name="order" class="form-control" value="0">
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label">Active</label>
                                <select name="is_active" class="form-select">
                                    <option value="1">Oui</option>
                                    <option value="0">Non</option>
                                </select>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-admin-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
