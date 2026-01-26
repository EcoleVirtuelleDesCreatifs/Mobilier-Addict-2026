@extends('layouts.admin')

@section('content')




<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">


                <div class="col-lg-12">


        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">CATÉGORIES</h4>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Créer une catégorie
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">



                                <table class="table table-responsive-md ck-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ordre</th>
                                            <th>Titre</th>
                                            <th>Slug</th>
                                            <th>Articles</th>
                                            <th>Créé le</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                {{-- ID --}}
                                                <td>{{ $category->id }}</td>

                                                {{-- Ordre --}}
                                                <td>
                                                    <span class="badge badge-rounded badge-outline-warning">
                                                        #{{ $category->order }}
                                                    </span>
                                                </td>

                                                {{-- Titre --}}
                                                <td>{{ $category->title }}</td>

                                                {{-- Slug --}}
                                                <td>
                                                    <code>{{ $category->slug }}</code>
                                                </td>

                                                {{-- Nombre d'articles --}}
                                                <td>
                                                    <span class="badge badge-rounded badge-outline-info">
                                                        {{ $category->articles_count }} article{{ $category->articles_count > 1 ? 's' : '' }}
                                                    </span>
                                                </td>

                                                {{-- Date de création --}}
                                                <td>
                                                    {{ $category->created_at ? $category->created_at->format('d/m/Y') : 'Non défini' }}
                                                </td>

                                                {{-- Actions --}}
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary btn-sm me-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @if($category->articles_count == 0)
                                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-secondary btn-sm" disabled title="Impossible de supprimer : contient des articles">
                                                                <i class="fas fa-lock"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                                {{ $categories->links('vendor.pagination.bootstrap-4') }}


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
