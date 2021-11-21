@extends('site.templates.pages')

@section('content')
    @component('site.component.page')

        @component('site.component.page-main')

            {{-- Каталог » Встраиваемые конвекторы » Конвекторы с естественной конвекцией --}}
            <div class="products products--line">
                <div class="row">
                    <div class="product-card col-md-6 col-lg-4">
                        <div class="product-card__image-wrap">
                            <img src="/site/images/products/item-1.png" alt="">
                        </div>

                        <div class="product-card__info">
                            <h3 class="product-card__title">Конвектор серии ITT</h3>
                            <a
                                class="btn btn--primary btn--lg"
                                href="#"
                            >{{ __('translations.more') }}</a>
                        </div>
                    </div>

                    <div class="product-card col-md-6 col-lg-4">
                        <div class="product-card__image-wrap">
                            <img src="/site/images/products/item-1.png" alt="">
                        </div>

                        <div class="product-card__info">
                            <h3 class="product-card__title">Конвектор серии ITTL</h3>
                            <a
                                class="btn btn--primary btn--lg"
                                href="#"
                            >{{ __('translations.more') }}</a>
                        </div>
                    </div>

                    <div class="product-card col-md-6 col-lg-4">
                        <div class="product-card__image-wrap">
                            <img src="/site/images/products/item-1.png" alt="">
                        </div>

                        <div class="product-card__info">
                            <h3 class="product-card__title">Конвектор серии ITTZ</h3>
                            <a
                                class="btn btn--primary btn--lg"
                                href="#"
                            >{{ __('translations.more') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="catalog-card col-md-4">
                    <a class="catalog-card__link" href="#">
                        <div class="catalog-card__image-wrap ratio">
                            <img class="catalog-card__image" src="/site/images/catalog/item-1.png" alt="">
                        </div>
                        <h3 class="catalog-card__title">Встраиваемые конвекторы</h3>
                    </a>
                </div>

                <div class="catalog-card col-md-4">
                    <a class="catalog-card__link" href="#">
                        <div class="catalog-card__image-wrap ratio">
                            <img class="catalog-card__image" src="/site/images/catalog/item-2.png" alt="">
                        </div>
                        <h3 class="catalog-card__title">Напольные и настенные</h3>
                    </a>
                </div>

                <div class="catalog-card col-md-4">
                    <a class="catalog-card__link" href="#">
                        <div class="catalog-card__image-wrap ratio">
                            <img class="catalog-card__image" src="/site/images/catalog/item-3.png" alt="">
                        </div>
                        <h3 class="catalog-card__title">Решетки конвекторов</h3>
                    </a>
                </div>
            </div>

        @endcomponent

    @endcomponent
@endsection
