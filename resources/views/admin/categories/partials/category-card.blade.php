<div class="mb-3" style="border: 1px solid var(--admin-border); border-radius: 12px; padding: 16px;">
    <div class="row align-items-center">
        <div class="col-12 col-md-2">
            <div class="rounded-3 overflow-hidden" style="width:80px;height:80px;border:1px solid var(--admin-border);">
                @php($thumb = image_thumb($category->image, 240))
                @if(str_contains($thumb, 'product-placeholder'))
                    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-center small" style="background: var(--admin-bg-subtle); color: var(--admin-muted); line-height:1.2;" title="Image absente du serveur : à renvoyer depuis « Modifier »"><i class="fa-regular fa-image mb-1"></i>Image<br>manquante</div>
                @else
                    <img src="{{ $thumb }}" alt="{{ $category->name }}" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;">
                @endif
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
            @if($category->color)
                <div class="small" style="color: var(--admin-muted);">Couleur</div>
                <div class="d-flex align-items-center gap-2">
                    <div style="width:24px;height:24px;border-radius:50%;background:{{ $category->color }};"></div>
                    <span class="small">{{ $category->color }}</span>
                </div>
            @endif
        </div>
        <div class="col-12 col-md-2">
            <div class="small" style="color: var(--admin-muted);">Produits</div>
            <div class="fw-semibold {{ $category->products_many_count ? '' : 'text-warning' }}">{{ $category->products_many_count }}</div>
            @unless($category->products_many_count)<div class="small text-warning">Masquée de Google (vide)</div>@endunless
        </div>
        <div class="col-12 col-md-1">
            <span class="badge {{ $category->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">
                {{ $category->is_active ? 'Actif' : 'Inactif' }}
            </span>
        </div>
        <div class="col-12 col-md-2 text-end">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-admin-ghost">Modifier</a>
                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" data-confirm="Supprimer cette catégorie ?">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
