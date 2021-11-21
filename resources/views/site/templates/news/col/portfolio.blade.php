@if ($news->count())
    @php $nws = $news->first(); @endphp
    @php
        $images = $nws->media()->where('switch_' . app()->getLocale(), true)
                        ->where('good', true)
                        ->orderBy('main', 'DESC')
                        ->orderBy('sind', 'DESC')
                        ->get();
    @endphp

    <section class="section portfolio">
        <div class="container">
            <div class="section__header">
                <h2 class="title-section mb-sm-0 mr-sm-5">{{ $section->name }}</h2>

                <a class="btn btn--outline-secondary btn--w-170 btn--more" href="{{ $section->path }}">
                    <span>{{ __('translations.all_works') }}</span>
                    {!! icon('icon--arrow', 'icon--arrow-right') !!}
                </a>
            </div><!-- /.section__header -->

            @include('site.blocks.snippets.portfolio-images')
        </div>
    </section>
@endif
