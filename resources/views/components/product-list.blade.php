@foreach($products as $product)
    <article class="c-product products__item">
        <div class="c-product__images">
            <figure class="c-product__image">
                <a class="js-popup open-cart" href="/ajax/product?id={{ $product->id }}"><img src="{{ $product->cover_image }}" alt="{{ $product->title }}" /></a>
            </figure>
        </div>
        <h3 class="c-product__title">
            <a class="js-popup open-cart" data-productId="{{ $product->id }}" href="/ajax/product?id={{ $product->id }}">{{ $product->title }}</a>
        </h3>
        <p class="c-product__price">
            от 1690 руб.
        </p>
        <div class="c-product__bottom">
            <a class="button c-product__button-size js-popup open-cart open-cart--{{ $product->id }}" href="/ajax/product?id={{ $product->id }}" data-productId="{{ $product->id }}" role="button">
                <svg class="svg-icon svg-icon--size button__svg-icon">
                    <use xlink:href="#size"></use>
                </svg>
                <span class="button__caption">Выбрать изделие</span>
            </a>
            <div class="c-product__extra">
                <a class="button c-product__button-view js-popup button--black open-cart" href="/ajax/product?id={{ $product->id }}" role="button">
                    <svg class="svg-icon svg-icon--view button__svg-icon">
                        <use xlink:href="#view"></use>
                    </svg>
                    <span class="button__caption">Быстрый просмотр</span>
                </a>
            </div>
        </div>
    </article>
@endforeach
