<div class="review-card rounded{{ isset($reviewsCardIsSlide) ? ' mb-0' : ' col-md-6' }}">
    <div class="review-card__inner rounded{{ isset($reviewsCardIsSlide) ? '' : ' has-shadow min-h-0 ' }}">
        <h3 class="review-card__title m-0">{{ $record->title }}</h3>
        <div class="review-card__city">{{ $record->rubric->title }}</div>
        <div class="review-card__desc">{!! $record->short !!}</div>
        <div class="review-card__more">
            <a class="review-card__more-btn" href="{{ $record->url }}">
                <span>{{ __('translations.full_text') }}</span>
                {!! icon('icon--arrow', 'icon--arrow-right') !!}
            </a>
        </div>
    </div>
</div>
