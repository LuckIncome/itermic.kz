<div class="page__aside col-xl-4 order-1 order-xl-0 mt-8 mt-xl-0">
    <aside class="aside">
        <div class="row">

            {{-- Catalog --}}
            <div class="col-12 catalog-aside aside-block">
                <div class="row">
                    @foreach(getChildrenSection(5) as $children)
                        <div class="catalog-card col-md-4 col-xl-12 mb-xl-4">
                            <a class="catalog-card__link" href="{{ $children->path }}">
                                <div class="catalog-card__image-wrap ratio">
                                    <img class="catalog-card__image" src="/site/images/catalog/item-{{ $children->id }}.png" alt="">
                                </div>
                                <h3 class="catalog-card__title">{{ $children->name }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            {{ $slot }}
        </div>
    </aside>
</div>
