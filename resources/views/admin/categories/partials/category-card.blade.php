<div class="mb-3" style="border: 1px solid var(--admin-border); border-radius: 12px; padding: 16px;">
    <div class="row align-items-center">
        <div class="col-12 col-md-2">
            <div class="rounded-3 overflow-hidden" style="width:80px;height:80px;border:1px solid var(--admin-border);">
                <img src="@image_url($category->image)" alt="" style="width:100%;height:100%;object-fit:cover;">
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="fw-semibold">{{ $category->name }}</div>
            <div class="small" style="color: var(--admin-muted);">{{ $category->slug }}</div>
            @if($category->description)
            <div class="small text-muted mt-1">{{ Str::limit($category->description, 50) }}</div>
            @endif
        </div>
        <div class="col-12 col-md-2">
            <div class="small" style="color: var(--admin-muted);">Couleur</div>
            <div class="d-flex align-items-center gap-2">
                <div style="width:24px;height:24px;border-radius:50%;background:{{ $category->color ?? '#64748b' }};"></div>
                <span class="small">{{ $category->color ?? '#64748b' }}</span>
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="small" style="color: var(--admin-muted);">Produits</div>
            <div class="fw-semibold">{{ $category->products_many_count }}</div>
        </div>
        <div class="col-12 col-md-1">
            <span class="badge {{ $category->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">
                {{ $category->is_active ? 'Actif' : 'Inactif' }}
            </span>
        </div>
        <div class="col-12 col-md-2 text-end">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-admin-ghost">Modifier</a>
                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Supprimer cette catégorie ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
