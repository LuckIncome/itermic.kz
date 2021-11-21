@if (count($links))
    <nav class="footer-nav">
        <ul>
            @foreach ($links as $link)
                <li><a href="{{ $link->link }}">{{ $link->title }}</a></li>
            @endforeach
        </ul>
    </nav>
@endif
