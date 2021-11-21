<section class="section mb-0">
    <div class="container">
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
    </div>
</section>
