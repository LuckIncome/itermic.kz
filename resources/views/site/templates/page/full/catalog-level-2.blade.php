@extends('site.templates.pages')

@section('content')
    @component('site.component.page')

        @component('site.component.page-main')

            {{-- Каталог » Встраиваемые конвекторы --}}
            <div class="catalog">
                @if ($section->children)
                    <div class="row mb-xl-4">
                        @foreach($section->children as $children)
                            <div class="catalog-card catalog-card--wide col-lg-6">
                                <a class="catalog-card__link" href="{{ $children->path }}">
                                    <div class="catalog-card__image-wrap ratio">
                                        <img class="catalog-card__image" src="/site/images/catalog/item-wide-{{ $loop->iteration }}.png" alt="">
                                    </div>
                                    <h3 class="catalog-card__title">{{ $children->name }}</h3>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="formatted-body">
                    {!! $text !!}
                </div>
            </div><!-- /.catalog -->


        @endcomponent

    @endcomponent
@endsection
