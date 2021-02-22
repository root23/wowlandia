<!--CART POPUP-->
<div class="popup__top">
    <a class="popup__link-back js-popup-close" href="#">
        <svg class="svg-icon svg-icon--arrow-left">
            <use xlink:href="#arrow-left"></use>
        </svg>
        <span>Вернуться в каталог</span>
    </a>
    <button class="popup__btn-close js-popup-close" type="button" title="Закрыть"></button>
</div>
    <article class="order popup__order">
        <div class="order__main">
            <h2 class="order__title">Оформление заказа</h2>

            <div id="carteiner">
                <div class="order__form js-validate" id="form-order" novalidate="true">
                    <div class="order__table">
                        <div class="order__table-captions">
                            <div class="order__table-caption">Наименование товара</div>
                            <div class="order__table-caption">Цена</div>
                            <div class="order__table-caption">Количество</div>
                            <div class="order__table-caption">Всего</div>
                        </div>
                        <div class="order__items">

                            @foreach($cart as $item)
                                <div class="order__item">
                                    <figure class="order__item-picture">
{{--                                        <img src="{{ $item->image }}" alt="{{ $item->name }}">--}}
                                    </figure>

                                    <div class="order__item-info">
                                        <h3 class="order__item-title">{{ $item->name }}</h3>
                                        <p class="order__item-description">Размер: S (A5) – 15x26 см , Деталей: 101 шт.</p>
                                    </div>

                                    <div class="order__item-price">
                                        <span class="order__item-label">Цена:</span>
                                        @if ($item->options['sale_price'])
                                            {{ $item->options['sale_price'] }}
                                        @else
                                            {{ $item->price }}
                                        @endif
                                        руб.
                                    </div>

                                    <div class="field field--type-spinner order__item-quantity">
                                        <div class="field__field">
                                            <button class="field__minus" type="button"></button>
                                            <input type="number" name="quantity[{{ $item->id }}]" value="{{ $item->quantity }}" id="form-order-quantity-{{ $item->id }}">
                                            <button class="field__plus" type="button"></button>
                                        </div>
                                    </div>

                                    <div class="order__item-price">
                                        <span class="order__item-label">Цена:</span>
                                        @if ($item->options['sale_price'])
                                            {{ $item->options['sale_price'] * $item->quantity }}
                                        @else
                                            {{ $item->price * $item->quantity }}
                                        @endif
                                        руб.
                                    </div>
                                    <a class="order__item-remove" href="#" onclick="removeCart('42295'); return false;" role="button">
                                        <span class="order__item-remove-caption">Удалить</span>
                                    </a>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="alert order__alert">
                    <div class="alert__icon">
                        <svg class="svg-icon svg-icon--exclamation">
                            <use xlink:href="#exclamation"> </use>
                        </svg>
                    </div>
                    <p class="alert__text">До бесплатной доставки осталось добавить товаров на <b> 1920 руб.!</b></p>
                    <button class="alert__close" type="button" title="Закрыть" onclick="$(this).parent().remove();"></button>
                </div>


            </div>
        </div>
        <div class="order__row">
            <div class="order__left">
                <section class="order__section" id="delieiner">
                    <h3 class="order__title-2">Доставка</h3>

                    <div class="alert alert-warning">Нет доступных способов доставки, введите город ниже!</div>
                    <div class="field field--type-text order__field">
                        <div class="field__field">
                            <input type="text" name="city" value="" placeholder="Начните вводить название населенного пункта..." id="form-order-city" required="required" data-validator-required-message="Обязательное поле" autocomplete="off"><ul class="dropdown-menu"></ul>
                            <input type="hidden" name="zone_id" value="0" id="form-order-region">
                            <input type="hidden" name="postcode" value="" id="form-order-postcode">
                            <input type="hidden" name="country_id" value="176" id="form-order-country">
                        </div>
                    </div>

                    <div class="order__group">
                        <p>Стоимость доставки носит справочный характер, может незначительно измениться после подтверждения заказа</p>

                    </div>
                </section>
                <section class="order__section" id="cuseiner">
                    <h3 class="order__title-2">Данные покупателя</h3>
                    <div class="field field--type-text order__field">
                        <div class="field__field">
                            <input type="text" name="name" placeholder="Введите ваше имя" id="form-order-name" value="" required="required" data-validator-required-message="Обязательное поле">
                        </div>
                    </div>
                    <div class="field field--type-tel order__field">
                        <div class="field__field ">
                            <input type="text" name="phone" placeholder="Введите ваш телефон" id="form-order-phone" value="" required="required" class="field__phone" data-validator-required-message="Обязательное поле">
                        </div>
                    </div>
                    <div class="field field--type-email order__field">
                        <div class="field__field">
                            <input type="text" name="email" placeholder="Введите ваш e-mail" id="form-order-email" value="" data-validator-email-message="Неправильный формат Email">
                        </div>
                    </div>
                </section>
                <section class="order__section" id="payeiner">
                    <h3 class="order__title-2">Способ оплаты</h3>
                    <div class="field field--type-radio order__field">
                        <input type="radio" name="payment_method" id="form-order-payment-cod" value="cod" checked="checked">
                        <label class="field__label" for="form-order-payment-cod">
                            <span class="field__check"></span>Оплата при получении
                        </label>
                    </div>
                </section>
            </div>
            <div class="order__right">
                <section class="order__total" id="totaleiner" style="width: 535px;">
                    <h3 class="order__title-2">Итоговая стоимость</h3>

                    <div class="order__total-items">
                        <div class="order__total-item"><span>Общая стоимость товаров </span><span>2980 руб.</span></div>


                        <div class="order__total-item">
                            <div class="field__field">
                                <input type="text" name="coupon" id="input-coupon" placeholder="Введите промо-код">
                                <button class="button" id="button-coupon" type="submit">
                                    <span class="button__caption">Применить</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="order__total-sum"><span>Всего к оплате</span><span>2980 руб.</span></div>

                    <button class="button order__button-submit" id="checkout_button" type="submit">
                        <span class="button__caption">Оформить заказ</span>
                    </button>
                </section>
                <section class="d-none hidden" id="payment">
                </section>
            </div>
        </div>
    </article>
    <button title="Close (Esc)" type="button" class="mfp-close">×</button>

<!--/CART POPUP-->
