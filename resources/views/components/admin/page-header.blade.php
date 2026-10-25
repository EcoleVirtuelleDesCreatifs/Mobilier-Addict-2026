@props(['title', 'subtitle' => null])

<div class="ad-page-head">
    <div>
        <h1>{{ $title }}</h1>
        @if ($subtitle)
            <p>{{ $subtitle }}</p>
        @endif
    </div>
    @if (trim($slot) !== '')
        <div class="ad-page-actions">{{ $slot }}</div>
    @endif
</div>

@foreach (['status' => 'success', 'success' => 'success', 'error' => 'danger'] as $flashKey => $flashTone)
    @if (session($flashKey))
        <div class="alert alert-{{ $flashTone }} alert-dismissible fade show" role="alert">
            {{ session($flashKey) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif
@endforeach
