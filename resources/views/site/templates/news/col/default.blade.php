@if ($news->count())
    <section class="section useful-posts">
        <div class="useful-posts__inner container">
            <div class="row">
                <div class="col-lg-3 d-none d-lg-block">
                    <img class="useful-posts__preview" src="/site/images/posts/item-preview.png" alt="">
                </div>

                <div class="col-lg-9">
                    <div class="section__header">
                        <h2 class="title-section mb-sm-0 mr-sm-5">{{ $section->name }}</h2>

                        <a class="btn btn--primary btn--w-170 btn--more" href="{{ $section->path }}">
                            <span>{{ __('translations.all_articles') }}</span>
                            {!! icon('icon--arrow', 'icon--arrow-right') !!}
                        </a>
                    </div><!-- /.section__header -->

                    <div class="useful-posts__slider js-useful-posts-slider slick-slider">
                        @foreach ($news as $nws)
                            <div class="post-card mb-0">
                                <a class="post-card__link" href="{{ $nws->url }}">
                                    <div class="post-card__image-wrap ratio">
                                        @if (!is_null($nws->cover))
                                            <img
                                                class="post-card__image"
                                                src="/image/resize/270/185/{{ $nws->cover->link }}"
                                                alt="{{ $nws->title }}"
                                            >
                                        @endif
                                    </div>

                                    <div class="post-card__info">
                                        <div class="post-card__meta">
                                            <time
                                                class="post-card__date"
                                                datetime="{{ date('Y-m-d', strtotime($nws->published_at)) }}"
                                            >{{ formatDate($nws->published_at) }}</time>
                                        </div>

                                        <h3 class="post-card__title">{{ str_limit($nws->title, 100) }}</h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div><!-- /.useful-posts__slider -->
                </div>
            </div>
        </div>
    </section>
@endif
