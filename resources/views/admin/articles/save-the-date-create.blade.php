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
                            <h4 class="card-title">AJOUTER UN ARTICLE À SAVE THE DATE</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">



                                <form action="{{ route('admin.save-the-date.store') }}" method="POST">
                                    @csrf

                                    {{-- Sélection de l'article --}}
                                    <div class="form-group mb-3">
                                        <label for="article_id">Article à ajouter</label>
                                        <select name="article_id" id="article_id" class="form-control" required>
                                            <option value="">-- Sélectionner un article --</option>
                                            @foreach($articles as $article)
                                                <option value="{{ $article->id }}" {{ old('article_id') == $article->id ? 'selected' : '' }}>
                                                    {{ $article->title }} ({{ $article->category->name ?? 'Non catégorisé' }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('article_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Ordre --}}
                                    <div class="form-group mb-3">
                                        <label for="order">Ordre d'affichage (optionnel)</label>
                                        <select name="order" id="order" class="form-control">
                                            <option value="">-- Ordre automatique --</option>
                                            @for($i = 1; $i <= 8; $i++)
                                                <option value="{{ $i }}" {{ old('order') == $i ? 'selected' : '' }}>
                                                    Position {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('order')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Boutons --}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Ajouter à Save The Date
                                        </button>
                                        <a href="{{ route('admin.save-the-date.index') }}" class="btn btn-secondary ml-2">
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
