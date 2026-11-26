{{-- Pagination de la boutique (charte 2027) : en français, gros boutons tactiles, numéros compacts. --}}
@if ($paginator->hasPages())
    @php
        $label = $label ?? 'produit';
        $total = $paginator->total();
        // Page 1 sans « ?page=1 » : une seule adresse pour la première page (pas de contenu dupliqué).
        $clean = fn ($url) => rtrim(preg_replace('/([?&])page=1(?=&|$)&?/', '$1', (string) $url), '?&');
    @endphp
    <nav class="ma27-pg" role="navigation" aria-label="Pagination">
        <p class="ma27-pg-meta">
            <b>{{ number_format($paginator->firstItem(), 0, ',', ' ') }}–{{ number_format($paginator->lastItem(), 0, ',', ' ') }}</b>
            sur {{ number_format($total, 0, ',', ' ') }} {{ $label }}{{ $total > 1 ? 's' : '' }}
        </p>

        <div class="ma27-pg-bar">
            @if ($paginator->onFirstPage())
                <span class="ma27-pg-nav is-off" aria-disabled="true"><span aria-hidden="true">←</span><span class="ma27-pg-txt">Précédent</span></span>
            @else
                <a class="ma27-pg-nav" href="{{ $paginator->currentPage() === 2 ? $clean($paginator->previousPageUrl()) : $paginator->previousPageUrl() }}" rel="prev" aria-label="Page précédente"><span aria-hidden="true">←</span><span class="ma27-pg-txt">Précédent</span></a>
            @endif

            <ul class="ma27-pg-pages">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="ma27-pg-dots" aria-hidden="true">…</li>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li><span class="ma27-pg-page is-on" aria-current="page">{{ $page }}</span></li>
                            @else
                                <li><a class="ma27-pg-page" href="{{ $page == 1 ? $clean($url) : $url }}" aria-label="Page {{ $page }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </ul>
            <span class="ma27-pg-mobile" aria-hidden="true">Page {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>

            @if ($paginator->hasMorePages())
                <a class="ma27-pg-nav is-next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Page suivante"><span class="ma27-pg-txt">Suivant</span><span aria-hidden="true">→</span></a>
            @else
                <span class="ma27-pg-nav is-next is-off" aria-disabled="true"><span class="ma27-pg-txt">Suivant</span><span aria-hidden="true">→</span></span>
            @endif
        </div>
    </nav>
@endif
