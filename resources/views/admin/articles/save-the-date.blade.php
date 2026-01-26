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

                        <div class="card-header">
                            <h4 class="card-title">ARTICLES SAVE THE DATE</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">



                                <table class="table table-responsive-md ck-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Position</th>
                                            <th>Titre</th>
                                            <th>Image</th>
                                            <th>Catégorie</th>
                                            <th>Vues</th>
                                            <th>Status</th>
                                            <th>Ajouté le</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($saveTheDates as $saveTheDate)
                                            <tr>
                                                {{-- ID --}}
                                                <td>{{ $saveTheDate->id }}</td>

                                                {{-- Position --}}
                                                <td>
                                                    <span class="badge badge-rounded badge-outline-warning">
                                                        #{{ $saveTheDate->order }}
                                                    </span>
                                                </td>

                                                {{-- Titre --}}
                                                <td>{{ $saveTheDate->article->title }}</td>

                                                {{-- Image --}}
                                                <td>
                                                    @if ($saveTheDate->article->image)
                                                        <img src="{{ asset('storage/' . $saveTheDate->article->image) }}" alt="Image article" width="100" height="80" style="object-fit: cover; border-radius: 4px;">
                                                    @else
                                                        <img src="https://placehold.co/60x40?text=Pas+d%27image" alt="Image par défaut" width="100" height="80" style="object-fit: cover; border-radius: 4px;">
                                                    @endif
                                                </td>

                                                {{-- Catégorie --}}
                                                <td>{{ $saveTheDate->article->category->name ?? 'Aucune' }}</td>

                                                {{-- Vues --}}
                                                <td>
                                                    <span class="badge badge-rounded badge-outline-warning">
                                                        {{ $saveTheDate->article->views ?? 0 }}
                                                    </span>
                                                </td>

                                                {{-- Statut --}}
                                                <td>
                                                    @php
                                                        $statusClass = match ($saveTheDate->article->status) {
                                                            'published' => 'badge badge-rounded badge-outline-primary',
                                                            'draft' => 'badge badge-rounded badge-outline-danger',
                                                            default => 'badge badge-rounded badge-outline-secondary',
                                                        };

                                                        $statusLabel = match ($saveTheDate->article->status) {
                                                            'published' => 'En ligne',
                                                            'draft' => 'Brouillon',
                                                            default => ucfirst($saveTheDate->article->status),
                                                        };
                                                    @endphp

                                                    <span class="{{ $statusClass }}">
                                                        {{ $statusLabel }}
                                                    </span>
                                                </td>

                                                {{-- Date d'ajout --}}
                                                <td>
                                                    {{ $saveTheDate->created_at ? $saveTheDate->created_at->format('d/m/Y') : 'Non défini' }}
                                                </td>

                                                {{-- Actions --}}
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.articles.edit', $saveTheDate->article->id) }}" class="btn btn-primary btn-sm me-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.save-the-date.destroy', $saveTheDate) }}" method="POST" onsubmit="return confirm('Retirer cet article de Save The Date ?')">
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


                                {{ $saveTheDates->links('vendor.pagination.bootstrap-4') }}


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
