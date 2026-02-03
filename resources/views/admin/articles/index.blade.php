@extends('layouts.admin')

@section('content')




<style>
    .blinking-green-dot {
        height: 10px;
        width: 10px;
        background-color: #28a745; /* vert bootstrap */
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
        animation: blink 1.2s infinite;
        vertical-align: middle;
      }

      @keyframes blink {
        0%, 50%, 100% { opacity: 1; }
        25%, 75% { opacity: 0; }
      }

</style>






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

                        <div class="card-header">
                            <h4 class="card-title">LISTE DES ARTICLES CRÉES</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">



                                <table class="table table-responsive-md ck-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Rédacteur</th>
                                            <th>Titre</th>
                                            <th>Image</th> {{-- Nouvelle colonne Image --}}
                                            <th>Catégorie</th>
                                            <th>Vues</th>
                                            <th>En vedette</th>
                                            <th>Status</th>
                                            <th>Publié le</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($articles as $article)
                                            <tr>
                                                {{-- ID --}}
                                                <td>{{ $article->id }}</td>

                                                {{-- Auteur --}}
                                                <td>{{ $article->user->name ?? 'Non défini' }}</td>
                                                {{-- Titre --}}
                                                <td>{{ $article->title }}</td>



                                                     {{-- Image --}}
                                            <td>
                                                @if ($article->image)
                                                    <img src="{{ asset('storage/' . $article->image) }}" alt="Image article" width="100" height="80" style="object-fit: cover; border-radius: 4px;">
                                                @else
                                                    <img src="https://placehold.co/60x40?text=Pas+d%27image" alt="Image par défaut" width="100" height="80" style="object-fit: cover; border-radius: 4px;">
                                                @endif
                                            </td>


                                                {{-- Catégorie --}}
                                                <td>{{ $article->category->title ?? 'Aucune' }}</td>

                                                {{-- Vues --}}
                                                <td>
                                                    <span class="badge badge-rounded badge-outline-warning">
                                                        {{ $article->views }}
                                                    </span>
                                                </td>

                                                {{-- En vedette --}}
                                                <td>
                                                    @if ($article->is_featured)
                                                        <span class="badge badge-rounded badge-outline-primary">À la une</span>
                                                    @else
                                                        <span class="badge badge-rounded badge-outline-info">Non</span>
                                                    @endif
                                                </td>

                                               {{-- Statut --}}
                                                <td>
                                                    @php
                                                        $statusClass = match ($article->status) {
                                                            'published' => 'badge badge-rounded badge-outline-primary',
                                                            'draft' => 'badge badge-rounded badge-outline-danger',
                                                            default => 'badge badge-rounded badge-outline-secondary',
                                                        };

                                                        $statusLabel = match ($article->status) {
                                                            'published' => 'En ligne',
                                                            'draft' => 'Brouillon',
                                                            default => ucfirst($article->status),
                                                        };
                                                    @endphp

                                                    <span class="{{ $statusClass }}">
                                                        @if ($article->status === 'published')
                                                            <span class="blinking-green-dot"></span>
                                                        @endif
                                                        {{ $statusLabel }}
                                                    </span>
                                                </td>


                                                {{-- Date de publication --}}
                                                <td>
                                                    {{ $article->published_at ? $article->published_at->format('d/m/Y') : 'Non publié' }}
                                                </td>

                                                {{-- Actions --}}
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-primary btn-sm me-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                                {{ $articles->links('pagination::bootstrap-5') }}


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
