@if (isset($images) && $images->count())
    <div class="portfolio-images js-lg">
        @foreach ($images->chunk(2) as $chunk)
            <div class="row">
                @foreach ($chunk as $image)
                    @if ($loop->first)
                        <div class="portfolio-image col-md-5">
                            <a class="portfolio-image__link rounded" href="/{{ $image->link }}" data-lg>
                                <div
                                    class="portfolio-image__image"
                                    style="background-image: url('/image/resize/470/300/{{ $image->link }}');"
                                ></div>
                                <div class="portfolio-image__overlay">{!! icon('icon--magnifier') !!}</div>
                            </a>
                        </div>
                    @else
                        <div class="portfolio-image col-md-7">
                            <a class="portfolio-image__link rounded" href="/{{ $image->link }}" data-lg>
                                <div
                                    class="portfolio-image__image"
                                    style="background-image: url('/image/resize/670/300/{{ $image->link }}');"
                                ></div>
                                <div class="portfolio-image__overlay">{!! icon('icon--magnifier') !!}</div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div><!-- /.portfolio-images -->
@endif
