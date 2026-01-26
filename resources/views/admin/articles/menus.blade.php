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
                            <h4 class="card-title">GESTION DES MENUS</h4>
                            <a href="{{ route('admin.menus.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Créer un menu
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">



                                <table class="table table-responsive-md ck-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Position</th>
                                            <th>Titre</th>
                                            <th>Slug</th>
                                            <th>URL</th>
                                            <th>Type</th>
                                            <th>Articles</th>
                                            <th>Créé le</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $menu)
                                            {{-- Menu parent --}}
                                            <tr class="table-primary">
                                                {{-- ID --}}
                                                <td><strong>{{ $menu->id }}</strong></td>

                                                {{-- Position --}}
                                                <td>
                                                    <span class="badge badge-rounded badge-outline-warning">
                                                        #{{ $menu->position }}
                                                    </span>
                                                </td>

                                                {{-- Titre --}}
                                                <td>
                                                    <strong><i class="fa fa-folder"></i> {{ $menu->title }}</strong>
                                                    @if($menu->children->count() > 0)
                                                        <small class="text-muted d-block">
                                                            {{ $menu->children->count() }} sous-menu(s)
                                                        </small>
                                                    @endif
                                                </td>

                                                {{-- Slug --}}
                                                <td>
                                                    <code>{{ $menu->slug }}</code>
                                                </td>

                                                {{-- URL --}}
                                                <td>
                                                    @if($menu->url)
                                                        <a href="{{ $menu->url }}" target="_blank" class="text-primary">
                                                            {{ Str::limit($menu->url, 30) }}
                                                        </a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>

                                                {{-- Type --}}
                                                <td>
                                                    <span class="badge badge-rounded badge-outline-primary">
                                                        Menu principal
                                                    </span>
                                                </td>

                                                {{-- Nombre d'articles --}}
                                                <td>
                                                    <span class="badge badge-rounded badge-outline-success">
                                                        {{ $menu->article_menus_count }}
                                                    </span>
                                                </td>

                                                {{-- Date de création --}}
                                                <td>
                                                    {{ $menu->created_at ? $menu->created_at->format('d/m/Y') : 'Non défini' }}
                                                </td>

                                                {{-- Actions --}}
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-primary btn-sm me-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @if($menu->children->count() == 0 && $menu->article_menus_count == 0)
                                                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Supprimer ce menu ?')" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-secondary btn-sm" disabled title="Impossible de supprimer : contient des sous-menus ou des articles">
                                                                <i class="fas fa-lock"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>

                                            {{-- Sous-menus --}}
                                            @foreach($menu->children as $submenu)
                                                <tr>
                                                    {{-- ID --}}
                                                    <td>{{ $submenu->id }}</td>

                                                    {{-- Position --}}
                                                    <td>
                                                        <span class="badge badge-rounded badge-outline-info">
                                                            #{{ $submenu->position }}
                                                        </span>
                                                    </td>

                                                    {{-- Titre --}}
                                                    <td>
                                                        <span class="ml-3">
                                                            <i class="fa fa-angle-right text-muted"></i> 
                                                            <i class="fa fa-file-o"></i> {{ $submenu->title }}
                                                        </span>
                                                    </td>

                                                    {{-- Slug --}}
                                                    <td>
                                                        <code class="small">{{ $submenu->slug }}</code>
                                                    </td>

                                                    {{-- URL --}}
                                                    <td>
                                                        @if($submenu->url)
                                                            <a href="{{ $submenu->url }}" target="_blank" class="text-primary small">
                                                                {{ Str::limit($submenu->url, 25) }}
                                                            </a>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>

                                                    {{-- Type --}}
                                                    <td>
                                                        <span class="badge badge-rounded badge-outline-secondary">
                                                            Sous-menu
                                                        </span>
                                                    </td>

                                                    {{-- Nombre d'articles --}}
                                                    <td>
                                                        <span class="badge badge-rounded badge-outline-success">
                                                            {{ $submenu->article_menus()->count() }}
                                                        </span>
                                                    </td>

                                                    {{-- Date de création --}}
                                                    <td>
                                                        <small>{{ $submenu->created_at ? $submenu->created_at->format('d/m/Y') : 'Non défini' }}</small>
                                                    </td>

                                                    {{-- Actions --}}
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ route('admin.menus.edit', $submenu) }}" class="btn btn-primary btn-sm me-2">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            @if($submenu->article_menus()->count() == 0)
                                                                <form action="{{ route('admin.menus.destroy', $submenu) }}" method="POST" onsubmit="return confirm('Supprimer ce sous-menu ?')" class="d-inline">
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
                                        @endforeach
                                    </tbody>
                                </table>


                                {{ $menus->links('vendor.pagination.bootstrap-4') }}


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
