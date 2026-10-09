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
                            <h4 class="card-title">CRÉER UNE CATÉGORIE</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">



                                <form action="{{ route('admin.categories.store') }}" method="POST">
                                    @csrf

                                    {{-- Titre --}}
                                    <div class="form-group mb-3">
                                        <label for="title">Titre de la catégorie</label>
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

                                    {{-- Ordre --}}
                                    <div class="form-group mb-3">
                                        <label for="order">Ordre d'affichage (optionnel)</label>
                                        <input type="number" name="order" id="order" class="form-control" value="{{ old('order') }}" min="0">
                                        <small class="form-text text-muted">Laissez vide pour ordre automatique</small>
                                        @error('order')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Boutons --}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Créer la catégorie
                                        </button>
                                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary ml-2">
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
