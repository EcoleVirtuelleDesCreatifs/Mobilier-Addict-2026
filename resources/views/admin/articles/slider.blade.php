@extends('layouts.admin')

@section('content')

<style>
    .blinking-green-dot {
        height: 10px;
        width: 10px;
        background-color: #28a745;
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
                    <h4 class="card-title">SLIDER PRINCIPAL</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if($sliders->count() > 0)
                            <table class="table table-responsive-md ck-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Position</th>
                                        <th>Titre</th>
                                        <th>Image</th>
                                        <th>Actif</th>
                                        <th>Période</th>
                                        <th>Ajouté le</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            {{-- ID --}}
                                            <td>{{ $slider->id }}</td>

                                            {{-- Position --}}
                                            <td>
                                                <span class="badge badge-rounded badge-outline-primary">
                                                    #{{ $slider->order }}
                                                </span>
                                            </td>

                                            {{-- Titre --}}
                                            <td>{{ $slider->title }}</td>

                                            {{-- Image --}}
                                            <td>
                                                @if ($slider->image)
                                                    <img src="@image_url($slider->image)" alt="Image slide" width="100" height="80" style="object-fit: cover; border-radius: 4px;">
                                                @else
                                                    <img src="https://placehold.co/60x40?text=Pas+d%27image" alt="Image par défaut" width="100" height="80" style="object-fit: cover; border-radius: 4px;">
                                                @endif
                                            </td>

                                            {{-- Actif --}}
                                            <td>
                                                @if($slider->is_active)
                                                    <span class="badge badge-rounded badge-outline-primary"><span class="blinking-green-dot"></span>Actif</span>
                                                @else
                                                    <span class="badge badge-rounded badge-outline-danger">Inactif</span>
                                                @endif
                                            </td>

                                            {{-- Période --}}
                                            <td>
                                                <span class="badge badge-rounded badge-outline-secondary">
                                                    {{ $slider->start_date ? $slider->start_date->format('d/m/Y') : '—' }}
                                                    →
                                                    {{ $slider->end_date ? $slider->end_date->format('d/m/Y') : '—' }}
                                                </span>
                                            </td>

                                            {{-- Date d'ajout --}}
                                            <td>
                                                {{ $slider->created_at ? $slider->created_at->format('d/m/Y') : 'Non défini' }}
                                            </td>

                                            {{-- Actions --}}
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('admin.slider.edit', $slider) }}" class="btn btn-primary btn-sm me-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.slider.destroy', $slider) }}" method="POST" onsubmit="return confirm('Supprimer ce slide ?')">
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

                            {{ $sliders->links('pagination::bootstrap-5') }}
                        @else
                            <div class="text-center py-5">
                                <i class="fa fa-images fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Aucun slide dans le slider</h5>
                                <p class="text-muted">Commencez par ajouter des slides au slider principal.</p>
                                <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Ajouter le premier slide
                                </a>
                            </div>
                        @endif
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
