@extends('site.templates.pages')

@section('content')
    @component('site.component.page', ['pageHasAside' => true, 'pageIntroTitle' => $data->title])

        @component('site.component.page-aside')@endcomponent

        @component('site.component.page-main', ['pageHasAside' => true])

            {{-- Каталог » Встраиваемые конвекторы » Конвекторы с естественной конвекцией » Внутрипольные конвекторы серии ITT --}}
            @if(isset($images) && $images->count())
                <div class="product-slider js-product-slider js-lg slick-slider">

                    @foreach($images as $image)
                        <div>
                            <a class="product-card mb-0" href="/{{ $image->link }}" data-lg>
                                <div class="product-card__image-wrap mb-0">
                                    <img src="/{{ $image->link }}" alt="">
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            @endif

            <div class="formatted-body">
                {!! $data->short !!}
                {!! $data->full !!}
            </div>

        @endcomponent

    @endcomponent
@endsection
