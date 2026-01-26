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
                            <h4 class="card-title">CRÉER UN MENU</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">



                                <form action="{{ route('admin.menus.store') }}" method="POST">
                                    @csrf

                                    {{-- Titre --}}
                                    <div class="form-group mb-3">
                                        <label for="title">Titre du menu</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                                        @error('title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Slug --}}
                                    <div class="form-group mb-3">
                                        <label for="slug">Slug (optionnel)</label>
                                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">
                                        <small class="form-text text-muted">Laissez vide pour génération automatique</small>
                                        @error('slug')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- URL --}}
                                    <div class="form-group mb-3">
                                        <label for="url">URL (optionnel)</label>
                                        <input type="text" name="url" id="url" class="form-control" value="{{ old('url') }}" placeholder="https://example.com ou /page">
                                        <small class="form-text text-muted">URL externe ou interne pour ce menu</small>
                                        @error('url')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Menu parent --}}
                                    <div class="form-group mb-3">
                                        <label for="parent_id">Menu parent (optionnel)</label>
                                        <select name="parent_id" id="parent_id" class="form-control">
                                            <option value="">-- Menu principal --</option>
                                            @foreach($parentMenus as $parentMenu)
                                                <option value="{{ $parentMenu->id }}" {{ old('parent_id') == $parentMenu->id ? 'selected' : '' }}>
                                                    {{ $parentMenu->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Sélectionnez un menu parent pour créer un sous-menu</small>
                                        @error('parent_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Position --}}
                                    <div class="form-group mb-3">
                                        <label for="position">Position d'affichage (optionnel)</label>
                                        <input type="number" name="position" id="position" class="form-control" value="{{ old('position') }}" min="0">
                                        <small class="form-text text-muted">Laissez vide pour position automatique</small>
                                        @error('position')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Boutons --}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Créer le menu
                                        </button>
                                        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary ml-2">
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
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->

@endsection
