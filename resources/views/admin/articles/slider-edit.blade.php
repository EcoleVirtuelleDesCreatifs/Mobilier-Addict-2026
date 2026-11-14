@extends('layouts.admin')

@section('content')

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MODIFIER LE SLIDE</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ route('admin.slider.update', $slider) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Style d'affichage --}}
                            <div class="form-group mb-3">
                                <label for="layout">Style d'affichage</label>
                                <select id="layout" name="layout" class="form-control">
                                    <option value="classic" {{ old('layout', $slider->layout ?? 'classic') === 'classic' ? 'selected' : '' }}>Classique (image de fond + carte blanche)</option>
                                    <option value="promo" {{ old('layout', $slider->layout ?? 'classic') === 'promo' ? 'selected' : '' }}>Promo — bandeau sombre (type Black Friday)</option>
                                    <option value="banner" {{ old('layout', $slider->layout ?? 'classic') === 'banner' ? 'selected' : '' }}>Bannière — plein écran, texte sur l'image</option>
                                </select>
                                @error('layout')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Titre --}}
                            <div class="form-group mb-3">
                                <label for="title">Titre</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $slider->title) }}" required maxlength="255" />
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Titre accentué --}}
                            <div class="form-group mb-3">
                                <label for="title_highlight">Titre accentué (optionnel)</label>
                                <input type="text" id="title_highlight" name="title_highlight" class="form-control" value="{{ old('title_highlight', $slider->title_highlight) }}" maxlength="255" />
                                @error('title_highlight')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Badge (optionnel) --}}
                            <div class="form-group mb-3">
                                <label for="badge">Badge / Ligne d'offre 1 (optionnel)</label>
                                <input type="text" id="badge" name="badge" class="form-control" value="{{ old('badge', $slider->badge) }}" maxlength="255" />
                                <small class="text-muted">Style promo : première ligne de l'offre, ex. « 1 matelas acheté, »</small>
                                @error('badge')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Offre promo : pastille + suite --}}
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="discount_text">Texte en pastille (promo)</label>
                                    <input type="text" id="discount_text" name="discount_text" class="form-control" value="{{ old('discount_text', $slider->discount_text) }}" maxlength="255" placeholder="ex : 2 oreillers" />
                                    @error('discount_text')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="discount_label">Fin de la ligne d'offre (promo)</label>
                                    <input type="text" id="discount_label" name="discount_label" class="form-control" value="{{ old('discount_label', $slider->discount_label) }}" maxlength="255" placeholder="ex : offerts." />
                                    @error('discount_label')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="form-group mb-3">
                                <label for="description">Description / sous-titre (optionnel)</label>
                                <textarea id="description" name="description" class="form-control" rows="2">{{ old('description', $slider->description) }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Image --}}
                            <div class="form-group mb-3">
                                <label for="image">Image (laisser vide pour conserver)</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                <small class="text-muted">Classique : image de fond plein écran. Promo : visuel affiché à droite (fond transparent ou sombre).</small>
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                                @if($slider->image)
                                    <div class="mt-2">
                                        <img src="@image_url($slider->image)" alt="Image slide" width="160" height="110" style="object-fit: cover; border-radius: 4px;">
                                    </div>
                                @endif
                            </div>

                            {{-- Alt image --}}
                            <div class="form-group mb-3">
                                <label for="image_alt">Texte alternatif de l'image (SEO, optionnel)</label>
                                <input type="text" id="image_alt" name="image_alt" class="form-control" value="{{ old('image_alt', $slider->image_alt) }}" maxlength="255" />
                                @error('image_alt')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Boutons --}}
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="btn_primary_text">Texte du bouton principal</label>
                                    <input type="text" id="btn_primary_text" name="btn_primary_text" class="form-control" value="{{ old('btn_primary_text', $slider->btn_primary_text) }}" maxlength="255" placeholder="ex : J'en profite" />
                                    @error('btn_primary_text')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="btn_primary_url">Lien du bouton principal</label>
                                    <input type="text" id="btn_primary_url" name="btn_primary_url" class="form-control" value="{{ old('btn_primary_url', $slider->btn_primary_url) }}" maxlength="255" placeholder="/menu/matelas" />
                                    @error('btn_primary_url')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="btn_secondary_text">Texte du bouton secondaire (optionnel)</label>
                                    <input type="text" id="btn_secondary_text" name="btn_secondary_text" class="form-control" value="{{ old('btn_secondary_text', $slider->btn_secondary_text) }}" maxlength="255" />
                                    @error('btn_secondary_text')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="btn_secondary_url">Lien du bouton secondaire (optionnel)</label>
                                    <input type="text" id="btn_secondary_url" name="btn_secondary_url" class="form-control" value="{{ old('btn_secondary_url', $slider->btn_secondary_url) }}" maxlength="255" />
                                    @error('btn_secondary_url')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Mention fin d'offre (promo) --}}
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="stat1_label">Mention avant la date (promo, optionnel)</label>
                                    <input type="text" id="stat1_label" name="stat1_label" class="form-control" value="{{ old('stat1_label', $slider->stat1_label) }}" maxlength="255" placeholder="ex : Fin de l'offre :" />
                                    @error('stat1_label')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="stat1_value">Date / texte mis en avant (promo, optionnel)</label>
                                    <input type="text" id="stat1_value" name="stat1_value" class="form-control" value="{{ old('stat1_value', $slider->stat1_value) }}" maxlength="255" placeholder="ex : 31 décembre" />
                                    @error('stat1_value')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Planification --}}
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="start_date">Date de début (optionnel)</label>
                                    <input type="datetime-local" id="start_date" name="start_date" class="form-control" value="{{ old('start_date', optional($slider->start_date)->format('Y-m-d\TH:i')) }}" />
                                    @error('start_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="end_date">Date de fin (optionnel)</label>
                                    <input type="datetime-local" id="end_date" name="end_date" class="form-control" value="{{ old('end_date', optional($slider->end_date)->format('Y-m-d\TH:i')) }}" />
                                    <small class="text-muted">Le slide se masque automatiquement après cette date.</small>
                                    @error('end_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Ordre --}}
                            <div class="form-group mb-3">
                                <label for="order">Ordre d'affichage</label>
                                <input type="number" name="order" id="order" class="form-control" value="{{ old('order', $slider->order ?? 0) }}" min="0" />
                                @error('order')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Actif --}}
                            <div class="form-group mb-3 form-check">
                                <input type="checkbox" id="is_active" name="is_active" class="form-check-input" value="1" {{ old('is_active', $slider->is_active) ? 'checked' : '' }}>
                                <label for="is_active" class="form-check-label">Activer ce slide</label>
                            </div>

                            {{-- Boutons --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Enregistrer
                                </button>
                                <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary ml-2">
                                    <i class="fa fa-times"></i> Annuler
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->

@endsection
