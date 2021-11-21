@if (!empty($breadcrumbs))
    <ul class="breadcrumbs">
        <li>
            <a
                class="link"
                href="/"
            >{{ __('translations.home') }}</a>
        </li>
        @foreach($breadcrumbs as $breadcrumb)
            <li>
                <a
                    class="link"
                    href="{{ $breadcrumb['link'] }}"
                >{{ str_limit($breadcrumb['name'], 100) }}</a>
            </li>
        @endforeach
        @if(!is_null($news))
            <li>
                <a
                    class="link"
                    href="{{ $breadcrumb['link'] }}"
                >{{ str_limit($news->title, 100) }}</a>
            </li>
        @endif
    </ul>
@endif


