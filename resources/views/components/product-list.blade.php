@foreach($products as $product)
    <article class="c-product products__item">
        <div class="c-product__images">
            <figure class="c-product__image">
                <img src="{{ $product->cover_image }}" alt="{{ $product->title }}" onclick="openPopup('')"/>
            </figure>
        </div>
        <h3 class="c-product__title">
            <a class="js-popup" data-product-id="{{ $product->id }}" href="#popup--product">{{ $product->title }}</a>
        </h3>
        <p class="c-product__price">
            от 1490 руб. до 3490 руб.
        </p>
        <div class="c-product__bottom">
            <a class="button c-product__button-size js-popup open-cart" href="#popup--product" data-product-id="{{ $product->id }}" role="button">
                <svg class="svg-icon svg-icon--size button__svg-icon">
                    <use xlink:href="#size"></use>
                </svg>
                <span class="button__caption">Выбрать изделие</span>
            </a>
            <div class="c-product__extra">
                <a class="button c-product__button-view js-popup button--black open-cart" href="#popup--product" role="button">
                    <svg class="svg-icon svg-icon--view button__svg-icon">
                        <use xlink:href="#view"></use>
                    </svg>
                    <span class="button__caption">Быстрый просмотр</span>
                </a>
            </div>
        </div>
    </article>
@endforeach
