@if (isset($images) && $images->count())
    <div class="post-images js-post-images js-lg slick-slider{{ $images->count() > 1 ? ' has-dots' : '' }}">
        @foreach ($images as $image)
            <div class="post-images__slide">
                <a
                    class="post-images__slide-image ratio"
                    href="/{{ $image->link }}"
                    data-lg
                >
                    <picture>
                        <source media="(min-width:768px)" srcset="/image/resize/333/219/{{ $image->link }}">
                        <img src="/image/resize/510/335/{{ $image->link }}" alt="">
                    </picture>
                </a>
            </div>
        @endforeach
    </div>
@endif
