@if ($news->count())
    @php $nws = $news->first(); @endphp
    @php
        $video = $nws->media('video')->where('lang', app()->getLocale())->where('good', 1)->orderBy('sind', 'DESC')->first();
    @endphp

    <section class="section product-preview">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-xl-5 mb-5 mb-lg-0">
                    <div class="product-preview__media rounded">
                        @if ($video)
                            <iframe
                                src="https://www.youtube.com/embed/{{ getCodeVideo($video->link) }}?rel=0"
                                allow="autoplay; encrypted-media"
                                allowfullscreen
                            ></iframe>
                        @endif
                    </div>
                </div>

                <div class="col-lg-7 col-xl-6">
                    <div class="product-preview__content">
                        <h2 class="product-preview__title title-section">{{ $nws->title }}</h2>
                        <div class="product-preview__desc">{!! $nws->short !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
