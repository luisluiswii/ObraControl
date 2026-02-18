@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="Anterior">
                    <span class="page-link page-arrow" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 18 18" style="vertical-align:middle" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 15L6 9L12 3" stroke="#5a4fcf" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link page-arrow" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Anterior">
                        <svg width="18" height="18" viewBox="0 0 18 18" style="vertical-align:middle" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 15L6 9L12 3" stroke="#5a4fcf" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link page-arrow" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Siguiente">
                        <svg width="18" height="18" viewBox="0 0 18 18" style="vertical-align:middle;transform:scaleX(-1);" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 15L6 9L12 3" stroke="#5a4fcf" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="Siguiente">
                    <span class="page-link page-arrow" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 18 18" style="vertical-align:middle;transform:scaleX(-1);" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 15L6 9L12 3" stroke="#5a4fcf" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
