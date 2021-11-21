<nav class="header__nav nav js-nav">
    <ul class="nav__list">
        @foreach ($structures as $structure)
            @php $isActiveItem = in_array($structure['alias'], getUpperLevels(request()->alias)) ? ' is-active' : ''; @endphp

            <li class="nav__item{{ $isActiveItem }}">
                @php $name = 'name_' . app()->getLocale(); @endphp

                @if ($structure['type'] != 'link')
                    <a class="nav__link{{ $isActiveItem }}" href="{{ $structure['link'] ?? '' }}">
                @else
                    <a class="nav__link{{ $isActiveItem }}"
                   @if ((substr($structure['link'], 0, 7) == 'http://') || (substr($structure['link'], 0, 8) == 'https://'))
                       {{ 'target="_blank"' }} href="{{ $structure['link'] }}"
                   @else
                       href="{{ $structure['link'] ?? '' }}"
                    @endif>
                @endif
                    {{ (isset($structure[$name]) && !is_null($structure[$name])) ? $structure[$name] : $structure['name_ru'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
