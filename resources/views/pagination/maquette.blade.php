@if ($paginator->hasPages())
    <nav class="ma-pagination" role="navigation" aria-label="Pagination des produits">
        <p class="ma-pagination__meta">
            Articles <strong>{{ number_format($paginator->firstItem(), 0, ',', ' ') }}</strong> à
            <strong>{{ number_format($paginator->lastItem(), 0, ',', ' ') }}</strong> sur
            <strong>{{ number_format($paginator->total(), 0, ',', ' ') }}</strong>
        </p>

        <div class="ma-pagination__pages">
            @if ($paginator->onFirstPage())
                <span class="ma-pagination__nav is-disabled" aria-disabled="true">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                    <span>Précédent</span>
                </span>
            @else
                <a class="ma-pagination__nav" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                    <span>Précédent</span>
                </a>
            @endif

            <div class="ma-pagination__numbers">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="ma-pagination__dots" aria-hidden="true">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="ma-pagination__page is-active" aria-current="page" aria-label="Page {{ $page }}">{{ $page }}</span>
                            @else
                                <a class="ma-pagination__page" href="{{ $url }}" aria-label="Aller à la page {{ $page }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            @if ($paginator->hasMorePages())
                <a class="ma-pagination__nav" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <span>Suivant</span>
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                </a>
            @else
                <span class="ma-pagination__nav is-disabled" aria-disabled="true">
                    <span>Suivant</span>
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                </span>
            @endif
        </div>
    </nav>

    @once
        @push('styles')
            <style>
                .ma-pagination{display:flex;align-items:center;justify-content:space-between;gap:24px;padding:22px 26px;background:#fff;border:1px solid #e8edf2;border-radius:20px;box-shadow:0 14px 34px rgba(0,35,77,.07);width:100%;}
                .ma-pagination__meta{margin:0;color:#6b7280;font-size:13px;white-space:nowrap;}.ma-pagination__meta strong{color:#00234D;font-weight:800;}
                .ma-pagination__pages,.ma-pagination__numbers{display:flex;align-items:center;gap:7px;}.ma-pagination__nav,.ma-pagination__page{display:inline-flex;align-items:center;justify-content:center;text-decoration:none;transition:.18s;border:1px solid #dce3eb;color:#00234D;background:#fff;font-weight:700;}
                .ma-pagination__nav{gap:6px;height:42px;padding:0 14px;border-radius:12px;font-size:12px;}.ma-pagination__page{width:42px;height:42px;border-radius:12px;font-size:14px;}.ma-pagination__nav:hover,.ma-pagination__page:hover{color:#ec4899;border-color:#ec4899;transform:translateY(-2px);box-shadow:0 8px 18px rgba(236,72,153,.13);}
                .ma-pagination__page.is-active{background:#ec4899;color:#fff;border-color:#ec4899;box-shadow:0 8px 20px rgba(236,72,153,.28);}.ma-pagination__nav.is-disabled{color:#aeb7c3;background:#f5f7f9;border-color:#edf0f3;cursor:not-allowed;}.ma-pagination__dots{width:28px;text-align:center;color:#98a2b3;}
                @media(max-width:767.98px){.ma-pagination{flex-direction:column;gap:14px;padding:18px 14px}.ma-pagination__meta{font-size:12px}.ma-pagination__pages{width:100%;justify-content:space-between}.ma-pagination__nav{width:42px;padding:0}.ma-pagination__nav span{display:none}.ma-pagination__numbers{gap:5px}.ma-pagination__page{width:38px;height:38px}.ma-pagination__dots{width:18px}}
            </style>
        @endpush
    @endonce
@endif
