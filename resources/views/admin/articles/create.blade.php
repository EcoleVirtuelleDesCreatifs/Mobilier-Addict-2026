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
                            <h4 class="card-title">AJOUTER UN ARTICLE</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">



                                <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    {{-- Titre --}}
                                    <div class="form-group mb-3">
                                        <label for="title">Titre de l'article</label>
                                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required maxlength="255">
                                        @error('title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    {{-- Excerpt --}}
                                    <div class="form-group mb-3">
                                        <label for="excerpt">Résumé de l'article (optionnel)</label>
                                        <textarea id="excerpt" name="excerpt" rows="3" class="form-control">{{ old('excerpt') }}</textarea>
                                        @error('excerpt')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Image --}}
                                    <div class="form-group mb-3">
                                        <label for="image">Image</label>
                                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>



                                    {{-- Catégorie --}}
                                    <div class="form-group mb-3">
                                        <label for="category_id">Catégorie de l'article</label>
                                        <select id="category_id" name="category_id" class="form-control">
                                            <option value="">-- Sélectionnez une catégorie --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="form-group mb-3">
                                        <label for="status">Statut</label>
                                        <select id="status" name="status" class="form-control" required>
                                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Mettre au brouillon</option>
                                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Mettre en ligne</option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>



                                    {{-- En vedette --}}
                                    <div class="form-group mb-3 form-check">
                                        <input type="checkbox" id="is_featured" name="is_featured" class="form-check-input" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                        <label for="is_featured" class="form-check-label">Mettre à la UNE</label>
                                    </div>

                                    {{-- En slider --}}
                                    <div class="form-group mb-3 form-check">
                                        <input type="checkbox" id="is_slider" name="is_slider" class="form-check-input" value="1" {{ old('is_slider') ? 'checked' : '' }}>
                                        <label for="is_slider" class="form-check-label">Mettre en slider</label>
                                    </div>




                                    {{-- Contenu avec CKEditor --}}
                                    <div class="form-group mb-3">
                                        <label for="content">Description de l'article</label>
                                        <textarea id="content" name="content" rows="30" class="form-control">{{ old('content') }}</textarea>
                                        @error('content')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>



                                    {{-- Bouton --}}
                                    <button type="submit" class="btn btn-primary">Publier l'article</button>
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
