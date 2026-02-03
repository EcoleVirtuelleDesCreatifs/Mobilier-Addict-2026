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
                    <h4 class="card-title">AJOUTER UN SLIDE AU SLIDER</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Titre --}}
                            <div class="form-group mb-3">
                                <label for="title">Titre</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required maxlength="255" />
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Badge (optionnel) --}}
                            <div class="form-group mb-3">
                                <label for="badge">Badge (optionnel)</label>
                                <input type="text" id="badge" name="badge" class="form-control" value="{{ old('badge') }}" maxlength="255" />
                                @error('badge')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Image --}}
                            <div class="form-group mb-3">
                                <label for="image">Image</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Ordre --}}
                            <div class="form-group mb-3">
                                <label for="order">Ordre d'affichage (optionnel)</label>
                                <input type="number" name="order" id="order" class="form-control" value="{{ old('order', 0) }}" min="0" />
                                @error('order')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Actif --}}
                            <div class="form-group mb-3 form-check">
                                <input type="checkbox" id="is_active" name="is_active" class="form-check-input" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                                <label for="is_active" class="form-check-label">Activer ce slide</label>
                            </div>

                            {{-- Boutons --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Ajouter au Slider
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
