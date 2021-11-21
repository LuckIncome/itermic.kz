<ul class="{{ $ulClass }}">
    @foreach ($structures as $structure)
        <li>
            @php $name = 'name_' . app()->getLocale(); @endphp

            @if ($structure['type'] != 'link')
                <a href="/{{ app()->getLocale() }}{{ $structure['link'] ?? '' }}">
            @else
                <a
                    @if((substr($structure['link'], 0, 7) == 'http://') || (substr($structure['link'], 0, 8) == 'https://'))
                        {{ 'target="_blank"' }} href="{{ $structure['link'] }}"
                    @else
                        href="/{{ app()->getLocale() }}{{ $structure['link'] ?? '' }}"
                    @endif>
            @endif
                    {{ (isset($structure[$name]) && !is_null($structure[$name])) ? $structure[$name] : $structure['name_ru'] }}
                </a>

                @if(count($structure['children']) > 0)
                    @include('site.blocks.sitemap', ['structures' => $structure['children'], 'ulClass' => '' ])
                @endif
        </li>
    @endforeach
</ul>
