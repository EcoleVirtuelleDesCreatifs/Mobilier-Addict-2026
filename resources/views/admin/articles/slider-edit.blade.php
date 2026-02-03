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

                            {{-- Titre --}}
                            <div class="form-group mb-3">
                                <label for="title">Titre</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $slider->title) }}" required maxlength="255" />
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Badge (optionnel) --}}
                            <div class="form-group mb-3">
                                <label for="badge">Badge (optionnel)</label>
                                <input type="text" id="badge" name="badge" class="form-control" value="{{ old('badge', $slider->badge) }}" maxlength="255" />
                                @error('badge')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Image --}}
                            <div class="form-group mb-3">
                                <label for="image">Image (laisser vide pour conserver)</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                                @if($slider->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $slider->image) }}" alt="Image slide" width="160" height="110" style="object-fit: cover; border-radius: 4px;">
                                    </div>
                                @endif
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
