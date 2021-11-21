@if ($paginator->hasPages())
    <div class="pagination d-flex flex-md-wrap align-items-center">
        {{-- Previous Page Link --}}
        <div class="pagination__arrow pagination__arrow--prev">
            <a
                class="pagination__arrow-link{{ $paginator->onFirstPage() ? ' is-disabled' : '' }}"
                href="{{ $paginator->previousPageUrl() }}"
                title="{!! __('translations.page_prev') !!}"
            >{!! icon('icon--arrow', 'icon--arrow-left') !!}</a>
        </div>

        <ul class="pagination__list">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination__item is-disabled">
                        <span class="pagination__link is-disabled">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination__item is-active">
                                <span class="pagination__link is-active">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination__item">
                                <a class="pagination__link link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>

        {{-- Next Page Link --}}
        <div class="pagination__arrow pagination__arrow--next">
            <a
                class="pagination__arrow-link{{ $paginator->hasMorePages() ? '' : ' is-disabled' }}"
                href="{{ $paginator->nextPageUrl() }}"
                title="{!! __('translations.page_next') !!}"
            >{!! icon('icon--arrow', 'icon--arrow-right') !!}</a>
        </div>
    </div>
@endif
