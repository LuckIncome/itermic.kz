@extends('site.templates.pages')

@section('content')
    @component('site.component.page')

        @component('site.component.page-main')

            @if ($section->children)
                <div class="row">
                    @foreach($section->children as $children)
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
            @endif

        @endcomponent

    @endcomponent
@endsection
