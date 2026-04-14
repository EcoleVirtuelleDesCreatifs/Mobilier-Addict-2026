@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="card-title" style="font-size: 1.5rem; font-weight: 700;">Gestion B2B</h4>
                            <p class="text-muted mb-0" style="font-size: 0.9375rem;">Gérez les catégories pour les achats en gros</p>
                        </div>
                        <a href="{{ route('admin.b2b.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Nouvelle catégorie
                        </a>
                    </div>

                    @if($categories->count() > 0)
                    <div class="row">
                        @foreach($categories as $category)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100" style="border: none; box-shadow: 0 2px 15px rgba(0,0,0,0.08); border-radius: 12px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-3">
                                        <div style="width: 60px; height: 60px; background: {{ $category->color }}; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                            <span style="font-size: 1.5rem; font-weight: 950; color: #fff;">{{ $category->name[0] }}</span>
                                        </div>
                                        @if($category->is_active)
                                            <span class="badge bg-success" style="padding: 6px 12px; border-radius: 50px;">Actif</span>
                                        @else
                                            <span class="badge bg-secondary" style="padding: 6px 12px; border-radius: 50px;">Inactif</span>
                                        @endif
                                    </div>

                                    <h5 class="card-title" style="font-weight: 700; margin-bottom: 8px;">{{ $category->name }}</h5>
                                    <p class="card-text text-muted" style="font-size: 0.9375rem; margin-bottom: 16px;">{{ $category->description ?? 'Aucune description' }}</p>

                                    <div class="mb-3">
                                        <small class="text-muted" style="font-size: 0.8125rem;">Clé</small>
                                        <div><code style="background: #f1f5f9; padding: 4px 8px; border-radius: 4px; font-size: 0.875rem;">{{ $category->key }}</code></div>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted" style="font-size: 0.8125rem;">Couleur</small>
                                        <div class="d-flex align-items-center">
                                            <span class="d-inline-block rounded-circle me-2" style="width: 16px; height: 16px; background: {{ $category->color }};"></span>
                                            <span style="font-size: 0.875rem;">{{ $category->color }}</span>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <small class="text-muted" style="font-size: 0.8125rem;">Minimum de produits</small>
                                        <div style="font-size: 1.25rem; font-weight: 700; color: {{ $category->color }};">{{ $category->min_products }}</div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.b2b.edit', $category) }}" class="btn btn-primary flex-grow-1" style="padding: 8px 16px;">
                                            <i class="fas fa-edit me-2"></i>Modifier
                                        </a>
                                        <form action="{{ route('admin.b2b.destroy', $category) }}" method="POST" onsubmit="return confirm('Supprimer cette catégorie ?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="padding: 8px 12px;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                        <div class="text-center py-5">
                            <div style="width: 120px; height: 120px; background: #f1f5f9; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                                <i class="fas fa-box-open" style="font-size: 3rem; color: #94a3b8;"></i>
                            </div>
                            <h5 class="text-muted" style="font-size: 1.25rem;">Aucune catégorie B2B</h5>
                            <p class="text-muted mb-4">Créez votre première catégorie pour commencer à gérer les achats en gros.</p>
                            <a href="{{ route('admin.b2b.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Créer une catégorie
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}
</style>
@endsection
