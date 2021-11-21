<div class="post-card col-sm-6 col-lg-4">
    <a class="post-card__link has-shadow" href="{{ $record->url }}">
        <div class="post-card__image-wrap ratio">
            @if (!is_null($record->cover))
                <img
                    class="post-card__image"
                    src="/image/resize/213/146/{{ $record->cover->link }}"
                    alt="{{ $record->title }}"
                >
            @endif
        </div>

        <div class="post-card__info">
            <div class="post-card__meta">
                <time
                    class="post-card__date"
                    datetime="{{ date('Y-m-d', strtotime($record->published_at)) }}"
                >{{ formatDate($record->published_at) }}</time>
            </div>

            <h3 class="post-card__title">{{ str_limit($record->title, 100) }}</h3>
        </div>
    </a>
</div>
