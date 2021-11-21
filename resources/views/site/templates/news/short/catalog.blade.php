@extends('site.templates.pages')

@section('content')
    @component('site.component.page')

        @component('site.component.page-main')

            @if ($records->count())
                {{-- Каталог » Встраиваемые конвекторы » Конвекторы с естественной конвекцией --}}
                <div class="products products--line">
                    <div class="row">
                        @foreach($records as $record)
                            <div class="product-card col-md-6 col-lg-4">
                                <div class="product-card__image-wrap">
                                    <img src="/{{ $record->cover->link }}" alt="">
                                </div>

                                <div class="product-card__info">
                                    <h3 class="product-card__title">{{ substr($record->title,0,90) }}...</h3>
                                    <a
                                        class="btn btn--primary btn--lg"
                                        href="{{ $record->url }}"
                                    >{{ __('translations.more') }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @include('site.blocks.snippets.pagination')
            @else
                @include('site.blocks.snippets.filling')
            @endif

            <div class="row">
                @foreach(getChildrenSection(5) as $children)
                    <div class="catalog-card col-md-4">
                        <a class="catalog-card__link" href="{{ $children->path }}">
                            <div class="catalog-card__image-wrap ratio">
                                <img class="catalog-card__image" src="/site/images/catalog/item-{{ $children->id }}.png" alt="">
                            </div>
                            <h3 class="catalog-card__title">{{ $children->name }}</h3>
                        </a>
                    </div>
                @endforeach
            </div>

        @endcomponent

    @endcomponent
@endsection
