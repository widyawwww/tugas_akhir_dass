@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-6 space-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">Prev</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-3 py-1 bg-teal-600 text-white rounded hover:bg-teal-700">Prev</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 bg-teal-600 text-white rounded">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1 bg-white text-gray-700 border rounded hover:bg-gray-100">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-3 py-1 bg-teal-600 text-white rounded hover:bg-teal-700">Next</a>
        @else
            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">Next</span>
        @endif
    </nav>
@endif