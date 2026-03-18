@php
    $anchor = $anchor ?? '';
@endphp

@if ($paginator->hasPages())
    <ul class="pagination">

        {{-- LEFT ARROW --}}
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <span>&lt;</span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}{{ $anchor ? '#' . $anchor : '' }}">
                    &lt;
                </a>
            </li>
        @endif

        {{-- PAGE NUMBERS --}}
        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($page == $paginator->currentPage())
                <li class="active">
                    <span>{{ $page }}</span>
                </li>
            @else
                <li>
                    <a href="{{ $url }}{{ $anchor ? '#' . $anchor : '' }}">
                        {{ $page }}
                    </a>
                </li>
            @endif
        @endforeach

        {{-- RIGHT ARROW --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}{{ $anchor ? '#' . $anchor : '' }}">
                    &gt;
                </a>
            </li>
        @else
            <li class="disabled">
                <span>&gt;</span>
            </li>
        @endif

    </ul>
@endif