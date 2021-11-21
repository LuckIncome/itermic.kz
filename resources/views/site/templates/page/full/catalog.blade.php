@extends('site.templates.pages')

@section('content')
    @component('site.component.page', ['pageClass' => 'overflow-hidden', 'pageHasAside' => true])

        @component('site.component.page-aside')@endcomponent

        @component('site.component.page-main', ['pageHasAside' => true])

            {{-- Каталог » Встраиваемые конвекторы » Конвекторы с естественной конвекцией » Внутрипольные конвекторы серии ITT --}}
            <div class="product-slider js-product-slider js-lg slick-slider">

                <div>
                    <a class="product-card mb-0" href="/site/images/products/item-1.png" data-lg>
                        <div class="product-card__image-wrap mb-0">
                            <img src="/site/images/products/item-1.png" alt="">
                        </div>
                    </a>
                </div>

                <div>
                    <a class="product-card mb-0" href="/site/images/products/item-1.png" data-lg>
                        <div class="product-card__image-wrap mb-0">
                            <img src="/site/images/products/item-1.png" alt="">
                        </div>
                    </a>
                </div>

                <div>
                    <a class="product-card mb-0" href="/site/images/products/item-1.png" data-lg>
                        <div class="product-card__image-wrap mb-0">
                            <img src="/site/images/products/item-1.png" alt="">
                        </div>
                    </a>
                </div>

            </div>

            <div class="formatted-body">
                <p>
                    Внутрипольные конвекторы серии ITT с естественной конвекцией – это отопительные приборы,
                    работающие по принципу естественной конвекции. Встраиваемые в пол, они экономят пространство и не нарушают гармонию интерьера.
                    Единственной видимой частью внутрипольного конвектора является декоративная решетка, выполненная из различных видов материалов и цветов.
                </p>

                <p>
                    Небольшая высота конвекторов серии ITT (8см, 9см, 11см, 14см, 19см) позволяет монтировать их в пол малой глубины.
                    Данные конвекторы целесообразно располагать у окон с большой стеклянной поверхностью.
                </p>

                <p>К комплекту поставки можно дополнительно заказать автоматику</p>

                <p>Срок гарантии составляет 10 лет.</p>

                <h3>Габариты</h3>
                <ul>
                    <li>Высота: 8см, 9см, 11см, 14см, 19см</li>
                    <li>Ширина: 20см, 25см, 30см, 35см, 40см</li>
                    <li>Длина: от 60см до 500см с шагом в 10см</li>
                </ul>

                <h3>Короб</h3>
                <p>Материал: оцинкованная сталь толщиной 0.9мм с двух сторон покрашенная полимерным покрытием</p>

                <h3>Теплообменник</h3>
                <ul>
                    <li>Диаметр медных труб 15,88мм</li>
                    <li>Толщина стенок 0,5мм</li>
                    <li>Толщина алюминиевых ламелей 0,3мм</li>
                    <li>Расстояние между ламелями 7-8мм</li>
                    <li>Температура теплоносителя до 130°C</li>
                    <li>Рабочее давление - 16 атм.</li>
                    <li>Прессовочное до - 24 атм.</li>
                    <li>Способы присоединения: боковое, торцевое</li>
                    <li>Размер: G1/2 (внутренняя резьба)</li>
                    <li>Монтаж. Могут монтироваться в системах с медной, стальной и металлопластовой трубой, в однотрубных и двухтрубных системах отопления</li>
                </ul>

                <h3>Комплект поставки</h3>
                <p>Регулировочные ножки с крепежами</p>

                <h3>Опции</h3>
                <p>Данные конвекторы могут быть изготовлены с корпусом из нержавеющей стали</p>
            </div>

        @endcomponent

    @endcomponent
@endsection
