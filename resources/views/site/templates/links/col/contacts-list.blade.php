@if (count($links))
    <ul class="contacts__list">
        @foreach ($links as $link)
            <li class="contacts__list-item">
                <div class="contacts__list-icon">{!! icon('icon--' . $link->class) !!}</div>
                <div class="contacts__list-text">{!! $link->description !!}</div>
            </li>
        @endforeach
    </ul>
@endif
