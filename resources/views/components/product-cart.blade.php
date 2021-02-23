@if ($product)
@csrf
<div class="popup__top">-
    <a class="popup__link-back js-popup-close" href="#">
        <svg class="svg-icon svg-icon--arrow-left">
            <use xlink:href="#arrow-left"></use>
        </svg>
        <span>Вернуться в каталог</span>
    </a>
    <button class="popup__btn-close js-popup-close" type="button" title="Закрыть"></button>
</div>

<article class="product popup__product" id="popup--product">
    <div class="product__main">
        <div class="product__left">
            <div class="product__slideshow-wrapper">
                <div class="slideshow product__slideshow">
                    <div class="slideshow__items js-popup-gallery">
                        @foreach($product->productVariants as $item)
                            <div class="slideshow__item">
                                <a href="" tabindex="0">
                                    <img src="{{ $item->cover_image }}" alt="{{ $item->title }}">
                                </a>
                            </div
                        @endforeach
                    </div>

                    <div class="slideshow__nav-items">

                        @foreach($product->productVariants as $item)
                            <div class="slideshow__nav-item current" tabindex="0">
                                <img src="{{ $item->cover_image }}" alt="{{ $item->title }}">
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="product__right">
            <div id="product-fox-form">
                <div class="product__header">
                    <h1 class="product__title">{{ $product->title }}</h1>
                    <div class="product__rate">
                        <div class="star-rating product__star-rating" title="5">
                            <span class="star-rating__rating" style="width:100%"></span>
                        </div>
                        <a class="product__reviews-count" href="#reviews">Отзывы ({{ $product->reviews->count() }})</a>
                    </div>
                </div>
                <p class="product__price">
                    <span class="product__price-value">
                        @if ($product->productVariants[0]->sale_price)
                            {{ $product->productVariants[0]->sale_price }}
                        @else
                            {{ $product->productVariants[0]->price }}
                        @endif руб.
                    </span>
                </p>
                <div class="product__size">
                    <h3 class="product__title-3">Выберите вариант:</h3>

                    <div class="product__size-radios" id="input-option230">
                        @foreach($product->productVariants as $item)
                            <div class="radio-size radio-size--{{ $loop->iteration }} product__size-radio" data-product-id="{{ $item->id }}">
                                <input type="radio" name="option[230]" class="product-variant-check" id="product-variant-{{ $loop->iteration }}"
                                       value="{{ $item->id }}" @if ($loop->iteration == 1) checked="checked" @endif>
                                <label class="radio-size__label" for="product-variant-{{ $loop->iteration }}">
                                    <figure class="radio-size__picture">
                                        <img src="{{ $item->cover_image }}" width="150" height="150" alt="S">
                                    </figure>
                                    <span class="radio-size__ribbon">2x больше S</span>
                                    <div class="radio-size__content">
                                        <div class="radio-size__price">
                                            @if ($item->sale_price)
                                                <span class="radio-size__price-full">{{ $item->price }} руб.</span>
                                                <span class="radio-size__price-actual">
                                                    <span class="radio-size__price-value">{{ $item->sale_price }} руб.</span>
                                                </span>
                                            @else
                                                <span class="radio-size__price-value">{{ $item->price }} руб.</span>
                                            @endif
                                        </div>
                                        <ul class="radio-size__list">
                                            <li>Размер - {{ $item->size }}</li>
                                            <li>Цвет - {{ $item->color }}</li>
                                            <li>Тип - {{ $item->type }}</li>
                                        </ul>
                                    </div>
                                </label>

                            </div>
                        @endforeach
                    </div>
                    <h2 class="product__title">Выбрать размер</h2>
                    <div class="popup--sizes__sizes__table">
                        <div class="popup--sizes__col">
                            <div class="popup--sizes__element">Размер</div>
                            <div class="popup--sizes__element popup--sizes__element_b">
                                <div class="form_radio_btn">
                                    <input class="sizes-radio" id="radio-1" type="radio" name="radio" value="xs-s" checked>
                                    <label for="radio-1">xs - s</label>
                                </div>
                            </div>
                            <div class="popup--sizes__element popup--sizes__element_b">
                                <div class="form_radio_btn">
                                    <input class="sizes-radio" id="radio-2" type="radio" name="radio" value="m-l" checked>
                                    <label for="radio-2">m - l</label>
                                </div>
                            </div>
                            <div class="popup--sizes__element popup--sizes__element_b">
                                <div class="form_radio_btn">
                                    <input class="sizes-radio" id="radio-3" type="radio" name="radio" value="l-xl" checked>
                                    <label for="radio-3">l - xl</label>
                                </div>
                            </div>
                        </div>
                        <div class="popup--sizes__col">
                            <div class="popup--sizes__element popup--sizes__element_b">a</div>
                            <div class="popup--sizes__element">66</div>
                            <div class="popup--sizes__element">70</div>
                            <div class="popup--sizes__element">74</div>
                        </div>
                        <div class="popup--sizes__col">
                            <div class="popup--sizes__element popup--sizes__element_b">b</div>
                            <div class="popup--sizes__element">52</div>
                            <div class="popup--sizes__element">56</div>
                            <div class="popup--sizes__element">60</div>
                        </div>
                    </div>
                    <button class="button btn-sizes"  type="submit">
                        <span class="button__caption">Посмотреть размеры</span>
                    </button>
                </div>
                <div class="product__order">
                    <h3 class="product__title-3">Количество:</h3>
                    <div class="product__order-row">
                        <div class="field field--type-spinner product__quantity">
                            <div class="field__field">
                                <button class="field__minus" type="button"></button>
                                <input type="text" disabled name="quantity" value="1" id="product-fox-quantity">
                                <button class="field__plus" type="button"></button>
                            </div>
                        </div>

                        <button class="button product__button-cart add-to-cart" id="button-cart" type="submit">
                                <span class="button__caption">Добавить в корзину</span>
                        </button>

                    </div>
                </div>
                <input type="hidden" name="product_id" value="51">
                <div class="product__advantages">
                    <div class="product__advantage">\
                        <svg class="svg-icon svg-icon--delivery">
                            <use xlink:href="#delivery"></use>
                        </svg>
                        <p>Доставка по России <br>(бесплатно от 4 900 руб.)</p>
                    </div>
                    <div class="product__advantage">
                        <svg class="svg-icon svg-icon--quality">
                            <use xlink:href="#quality"></use>
                        </svg>
                        <p>Премиальное качество <br>продукции</p>
                    </div>
                    <div class="product__advantage">
                        <svg class="svg-icon svg-icon--no-money">
                            <use xlink:href="#no-money"></use>
                        </svg>
                        <p>Заказ без <br>предоплаты</p>
                    </div>
                </div>
                <div class="product__gift">
                    <div class="product__gift-content">
                        <h3 class="product__gift-title">Сразу в подарочной упаковке</h3>
                        <figure class="product__gift-picture">
                            <img src="https://unidragon.ru/image/cache/catalog/products2/fox2/unidragon-wooden-puzzle-jigsaw-puzzle-for-adult-alluring-fox-m-7-4620755023343-380x380x.png" width="380" height="380" alt="">
                        </figure>
                        <p>Подарок, который удивит и запомнится. Каждая головоломка упакована в подарочную деревянную коробку премиум-класса.</p>
                    </div>
                </div>

                <div class="product__features">
                    <div class="product__feature">
                        <figure class="product__feature-picture">
                            <img src="https://unidragon.ru/image/cache/catalog/products2/fox2/2_f6490716-596f-4801-b-382e54801b2c_1024x1024_2x_3b9b6ed5-f565-4f0f-b8ad-0738ddadac35-380x190x.jpg" alt="">
                        </figure>
                        <div class="product__feature-text">Каждый кусочек пазла имеет свою неповторимую форму - это высокая сложность сборки (200 пазлов уникальных форм по сложности соответствуют 1000 обычных картонных пазлов)</div>
                    </div>
                    <div class="product__feature">
                        <figure class="product__feature-picture">
                            <img src="https://unidragon.ru/image/cache/catalog/additional/feature-2-380x190x.jpg" alt="">
                        </figure>
                        <div class="product__feature-text">Интересно для взрослых и детей</div>
                    </div>
                    <div class="product__feature">
                        <figure class="product__feature-picture">
                            <img src="https://unidragon.ru/image/cache/catalog/products2/fox2/SAP_9114_1024x1024_5882bdb7-224b-4c16-a048-9b80df7bda61-380x190x.jpg" alt="">
                        </figure>
                        <div class="product__feature-text">Все детали вырезаны из ХДФ, так что вы можете почувствовать древесный аромат</div>
                    </div>
                </div>
                <div class="product__description">
                    <h3 class="product__title-3">Описание</h3>
                    {!! $product->description !!}
                    </div>
            </div>
        </div>
    </div>
    <section class="reviews product__reviews" id="reviews">
        <h2 class="reviews__title">Отзывы покупателей ({{ $product->reviews->count() }})</h2>
        <div class="reviews__top">
            <div class="rating reviews__rating">
                <div class="rating__rating">
                    <div class="rating__average">5</div>
                    <div class="rating__base">На основе <b>{{ $product->reviews->count() }} отзывов</b></div>
                </div>
                <div class="rating__items">
                    <div class="rating__item">
                        <span class="rating__star">5</span>
                        <span class="rating__progress">
                <span class="rating__progress-in" style="width:88.636363636364%"></span>
              </span>
                        <span class="rating__value rating__value_5">39</span>
                    </div>
                    <div class="rating__item">
                        <span class="rating__star">4</span>
                        <span class="rating__progress">
                <span class="rating__progress-in" style="width:11.363636363636%"></span>
              </span>
                        <span class="rating__value rating__value_4">5</span>
                    </div>
                    <div class="rating__item">
                        <span class="rating__star">3</span>
                        <span class="rating__progress">
                <span class="rating__progress-in" style="width:0%"></span>
              </span>
                        <span class="rating__value rating__value_3">0</span>
                    </div>
                    <div class="rating__item">
                        <span class="rating__star">2</span>
                        <span class="rating__progress">
                <span class="rating__progress-in" style="width:0%"></span>
              </span>
                        <span class="rating__value rating__value_2">0</span>
                    </div>
                    <div class="rating__item">
                        <span class="rating__star">1</span>
                        <span class="rating__progress">
                <span class="rating__progress-in" style="width:0%"></span>
              </span>
                        <span class="rating__value rating__value_1">0</span>
                    </div>
                </div>
            </div>
            <button class="button reviews__add-review-button button--black" type="button">
                <span class="button__caption">Оставить отзыв</span>
            </button>
        </div>
        <div class="reviews__add-review" style="display: none;">
            <h3 class="reviews__add-review-title">Оставьте свой отзыв</h3>
            <div class="form-review reviews__form-review" id="form-review">

                <form method="post" id="review-form" action="/reviews/add" enctype="multipart/form-data">
                    @csrf
{{--                    @include('components.review-errors')--}}
{{--                    @include('components.review-success')--}}
                    <input type="hidden" name="product_id" id="form-product-id" value="{{ $product->id }}">
                    <div class="form-group">
                        <div class="field field--type-rating form-review__rating" data-value="5">
                            <label class="field__label" for="form-review-rating">Ваш рейтинг</label>
                            <div class="field__field">
                                <input type="hidden" name="rating" id="form-review-rating" value="5">
                                <div class="field__stars">
                                    <button class="field__star" type="button" onclick="$('#form-review-rating').val('1');"></button>
                                    <button class="field__star" type="button" onclick="$('#form-review-rating').val('2');"></button>
                                    <button class="field__star" type="button" onclick="$('#form-review-rating').val('3');"></button>
                                    <button class="field__star" type="button" onclick="$('#form-review-rating').val('4');"></button>
                                    <button class="field__star" type="button" onclick="$('#form-review-rating').val('5');"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-review__row">
                            <div class="form-review__col">
                                <div class="field field--type-text form-review__field">
                                    <div class="field__field">
                                        <input type="text" name="name" placeholder="Имя" required id="form-review-name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-review__col">
                                <div class="field field--type-email form-review__field">
                                    <div class="field__field">
                                        <input type="email" name="email" placeholder="Email" id="form-review-email" required  tor-email-message="Неправильный формат Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field field--type-textarea form-review__field">
                            <div class="field__field">
                                <textarea name="text" placeholder="Ваш отзыв" required id="form-review-review" data-validator-required-message="Обязательное поле"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field field--type-file form-review__field">
                            <div class="field__field">
                                <input class="fileupload" type="file" name="file">
                                <button class="field__btn-file" type="button" id="fileupload" onclick="$('.fileupload').trigger('click');">
                                    <svg class="svg-icon svg-icon--upload">
                                        <use xlink:href="#upload"></use>
                                    </svg>
                                    <span>Добавить фото</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="fieldline">
                        <div id="files"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-review__buttons">
                        <button class="button form-review__button button--black" type="submit" id="button-review">
                            <span class="button__caption">Отправить</span>
                        </button>
                        <button class="button form-review__button button--ghost" type="reset" id="button-reset">
                            <span class="button__caption">Очистить</span>
                        </button>
                    </div>
                </form>






            </div>
        </div>
        <div class="reviews__items grid" id="rjax">

            @foreach($product->reviews as $review)
                <div class="reviews__item grid-item" >
                    <div class="c-review">
                        <figure class="c-review__picture js-popup-gallery">
                            <a href="{{ $review->image }}">
                                <img src="{{ $review->image }}" alt="{{ $review->title }}">
                            </a>
                            <a href="{{ $review->image }}"></a>

                        </figure>

                        <div class="c-review__content">
                            <h3 class="c-review__name">{{ $review->title }}</h3>
                            <div class="c-review__info">
                                <div class="star-rating c-review__star-rating" title="{{ $review->rating }}">
                                    @if ($review->rating == 5)
                                        <span class="star-rating__rating" style="width:100%"></span>
                                    @endif
                                    @if ($review->rating == 4)
                                        <span class="star-rating__rating" style="width:80%"></span>
                                    @endif
                                    @if ($review->rating == 3)
                                        <span class="star-rating__rating" style="width:60%"></span>
                                    @endif
                                    @if ($review->rating == 2)
                                        <span class="star-rating__rating" style="width:40%"></span>
                                    @endif
                                    @if ($review->rating == 1)
                                        <span class="star-rating__rating" style="width:20%"></span>
                                    @endif

                                </div>
                                <time class="c-review__date" datetime="19.06.2020">19 июня 2020</time>
                            </div>
                            <div class="c-review__text">
                                <p>{{ $review->message }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="reviews__bottom grid-item" >
                <a class="button reviews__button-more button--ghost"  id="elsereview" role="button">
                    <span class="button__caption">Показать еще</span>
                </a>
            </div>

        </div>
    </section>
    <a class="product__link-top position-link" href="#popup--product">
        <svg class="svg-icon svg-icon--arrow-left">
            <use xlink:href="#arrow-left"></use>
        </svg>
        <span>Наверх</span>
    </a>


</article>
<button title="Close (Esc)" type="button" class="mfp-close">×</button>

@endif

<script type="text/javascript">
</script>

