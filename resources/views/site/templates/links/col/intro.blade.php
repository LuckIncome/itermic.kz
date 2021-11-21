@if (count($links))
    <section class="section intro">
        <div class="intro__inner js-intro-inner">

            <div class="intro-slider js-intro-slider slick-slider">
                @foreach ($links as $link)
                    <div class="intro-slider__item">
                        <div
                            class="intro-slider__inner"
                            @if ($link->photo)
                            style="background-image:url('/image/resize/1552/446/{{ $link->photo }}');"
                            @endif
                        >
                            <div class="intro-slider__content container">
                                <div class="intro-slider__title">
                                    {!! strip_tags($link->description, '<br><b><strong>') !!}
                                </div>
                                <a
                                    class="btn btn--outline-white font-weight-700"
                                    href="{{ $link->link }}" {!! $link->target !!}
                                >Перейти в каталог</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="intro__aside">
                <div class="intro__aside-inner">
                    {!! getLinks('col-socials', 'socials') !!}

                    <ul class="intro-slider-dots js-intro-slider-dots">
                        @foreach ($links as $link)
                            <li class="intro-slider-dots__item" data-slide="{{ $loop->index }}">
                                <span class="intro-slider-dots__btn"></span>
                                <svg class="intro-slider-dots__progress" viewBox="0 0 94 94">
                                    <circle fill="none" cx="47" cy="47" r="46.5" stroke-dasharray="360" style="stroke-dashoffset: 360;"></circle>
                                </svg>
                            </li>
                        @endforeach
                    </ul><!-- /.intro-slider-dots -->
                </div>
            </div>

        </div><!-- /.intro__aside -->
    </section>
@endif
