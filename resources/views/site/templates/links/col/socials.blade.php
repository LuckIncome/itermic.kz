@if (count($links))
    <div class="socials">
        @foreach ($links as $link)
            @if ($link->class)
                <a
                    class="socials__link"
                    href="{{ $link->link }}"
                    {!! $link->target !!}
                >{!! icon('icon--' . $link->class) !!}</a>
            @endif
        @endforeach
    </div><!-- /.socials -->
@endif
