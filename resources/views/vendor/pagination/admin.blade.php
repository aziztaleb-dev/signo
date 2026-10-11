@if ($paginator->hasPages())

    <nav
        role="navigation"
        aria-label="Pagination"
        style="
            display:flex;
            align-items:center;
            justify-content:space-between;
            flex-wrap:wrap;
            gap:12px;
        "
    >

        <div style="font-size:13px; color:#6b7280;">
            {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }}
            sur {{ $paginator->total() }}
        </div>

        <div class="admin-pagination">

            {{-- Précédent --}}
            @if ($paginator->onFirstPage())
                <span class="admin-page is-disabled" aria-disabled="true" aria-label="Précédent">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                </span>
            @else
                <a class="admin-page" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Précédent">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                </a>
            @endif

            {{-- Numéros --}}
            @foreach ($elements as $element)

                @if (is_string($element))
                    <span class="admin-page is-dots">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="admin-page is-active" aria-current="page">{{ $page }}</span>
                        @else
                            <a class="admin-page" href="{{ $url }}" aria-label="Page {{ $page }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif

            @endforeach

            {{-- Suivant --}}
            @if ($paginator->hasMorePages())
                <a class="admin-page" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Suivant">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </a>
            @else
                <span class="admin-page is-disabled" aria-disabled="true" aria-label="Suivant">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </span>
            @endif

        </div>

    </nav>

@endif
