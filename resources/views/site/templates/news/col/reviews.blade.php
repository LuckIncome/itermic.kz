@if ($news->count())
    <section class="section reviews mb-8">
        <div class="reviews__inner container">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-5">
                <h2 class="title-section text-color-white mb-md-0 mr-md-5">{{ $section->name }}</h2>

                <a class="btn btn--primary btn--w-170 btn--more ml-md-auto" href="{{ $section->path }}">
                    <span>{{ __('translations.all_reviews') }}</span>
                    {!! icon('icon--arrow', 'icon--arrow-right') !!}
                </a>

                <div class="reviews__slider-arrows js-reviews-slider-arrows"></div>
            </div>

            <div class="reviews__slider slick-slider js-reviews-slider rounded">
                @foreach ($news as $nws)
                    @include('site.blocks.snippets.review-card', ['record' => $nws, 'reviewsCardIsSlide' => true])
                @endforeach
            </div>
        </div>
    </section>
@endif
