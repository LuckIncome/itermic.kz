@extends('site.templates.pages')

@section('content')
    @component('site.component.page', ['pageInnerClass' => 'pb-0 pb-xl-4'])

        @component('site.component.page-main')

            @if ($records->count())
                <div class="row">
                    @foreach($records as $record)
                        <div class="portfolio-card col-sm-6 col-lg-4">
                            <div class="portfolio-card__image-wrap ratio">
                                @if (!is_null($record->cover))
                                    <img
                                        class="portfolio-card__image"
                                        src="/image/resize/370/270/{{ $record->cover->link }}"
                                        alt="{{ $record->title }}"
                                    >
                                @endif
                            </div>

                            <div class="portfolio-card__info">
                                <h3 class="portfolio-card__title">{{ $record->title }}</h3>
                                <a
                                    class="btn btn--primary btn--lg"
                                    href="{{ $record->url }}"
                                >{{ __('translations.view') }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                @include('site.blocks.snippets.pagination')
            @else
                @include('site.blocks.snippets.filling')
            @endif

        @endcomponent

    @endcomponent
@endsection
