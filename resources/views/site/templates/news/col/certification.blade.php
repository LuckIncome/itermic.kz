@if ($news->count())
    <div class="certificate-slider">
        <h3 class="certificate-slider__title title-section">Сертификаты и свидетельства</h3>

        <div class="certificate-slider__list js-certificate-slider-list slick-slider js-lg">
            @foreach ($news as $nws)
                <div>
                    @include('site.blocks.snippets.certificate', ['record' => $nws, 'certificateIsSlide' => true])
                </div>
            @endforeach
        </div>
    </div>
@endif
