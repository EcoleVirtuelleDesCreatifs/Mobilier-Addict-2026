@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Catégories B2B</h4>
                        <a href="{{ route('admin.b2b.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Ajouter une catégorie
                        </a>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Les catégories B2B permettent aux entreprises de commander en gros. Les clients doivent sélectionner un minimum de produits pour passer commande.
                    </div>

                    @if($categories->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Clé</th>
                                        <th>Description</th>
                                        <th>Couleur</th>
                                        <th>Min. Produits</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td><code>{{ $category->key }}</code></td>
                                            <td>{{ $category->description ?? '—' }}</td>
                                            <td>
                                                <span class="d-inline-block rounded-circle me-2" style="width: 20px; height: 20px; background: {{ $category->color }}"></span>
                                                {{ $category->color }}
                                            </td>
                                            <td>{{ $category->min_products }}</td>
                                            <td>
                                                @if($category->is_active)
                                                    <span class="badge bg-success">Actif</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.b2b.edit', $category) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.b2b.destroy', $category) }}" method="POST" onsubmit="return confirm('Supprimer cette catégorie ?')" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <h5 class="text-muted">Aucune catégorie B2B</h5>
                            <p class="text-muted">Commencez par ajouter une catégorie B2B.</p>
                            <a href="{{ route('admin.b2b.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Ajouter une catégorie
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
