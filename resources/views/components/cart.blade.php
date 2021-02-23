<!--CART POPUP-->
@csrf
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
                                        @foreach($images as $image)
                                            @if ($image->id == $item->id)
                                                <img src="{{ $image->cover_image }}" alt="{{ $item->name }}">
                                            @endif
                                        @endforeach
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
                                            <input type="number" disabled name="quantity[{{ $item->id }}]"
                                                   value="{{ $item->quantity }}"
                                                   id="form-order-quantity-{{ $item->id }}"
                                                   data-product-unique-id="{{ $item->getUniqueId() }}"
                                                   data-product-id="{{ $item->id }}">
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
                                    <a class="order__item-remove" href="#" data-product-id="{{ $item->getUniqueId() }}" role="button">
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

                    <div class="alert alert-warning" style="display: none">Нет доступных способов доставки, введите город ниже!</div>
                    <div class="field field--type-text order__field">
                        <div class="field__field">
                            <input type="text" name="city" value="" placeholder="Начните вводить название населенного пункта..." id="form-order-city" required="required" data-validator-required-message="Обязательное поле" autocomplete="off">
                            <ul class="dropdown-menu"></ul>
                            <input type="hidden" name="zone_id" value="0" id="form-order-region">
                            <input type="hidden" name="postcode" value="" id="form-order-postcode">
                            <input type="hidden" name="country_id" value="176" id="form-order-country">
                            <input type="hidden" name="zipcode" value="101000" id="city-zipcode">
                        </div>
                    </div>
                    <div class="order__group">

                        <div class="field field--type-radio order__field">
                            <input type="radio" name="shipping_method" id="form-order-delivery-cdek.tariff_137_0" value="cdek.tariff_137_0" checked="checked">
                            <label class="field__label " for="form-order-delivery-cdek.tariff_137_0">
                                <span class="field__check"></span>Доставка курьером СДЭК &nbsp;
                                <span class="color-orange sdek-price">350 руб.</span>
                            </label>
                        </div>

                        <div class="order__radio-extras">
                            <p class="order__radio-hint"> Ориентировочная дата доставки <span class="sdek-delivery-date">27.02.2021</span></p>

                            <div class="field field--type-text order__field-extra">
                                <div class="field__field"><input type="text" name="adres" value="" placeholder="Введите адрес доставки" id="form-order-adres"></div>
                            </div>
                        </div>


                        <div class="field field--type-radio order__field"><input type="radio" name="shipping_method" id="form-order-delivery-russianpost2.rp1" value="russianpost2.rp1"><label class="field__label" for="form-order-delivery-russianpost2.rp1"><span class="field__check"></span>Почта России &nbsp; <span class="color-orange">186 руб.</span></label></div>


                        <p>Стоимость доставки носит справочный характер, может незначительно измениться после подтверждения заказа</p>

                    </div>

                    <div class="order__group">
                        <p>Стоимость доставки носит справочный характер, может незначительно измениться после подтверждения заказа</p>

                    </div>
                </section>
                <section class="order__section" id="cuseiner">
                    <h3 class="order__title-2">Данные покупателя</h3>
                    <div class="field field--type-text order__field">
                        <div class="field__field">
                            <input type="text" name="name" required placeholder="Введите ваше имя" id="form-order-name" value="" required="required" data-validator-required-message="Обязательное поле">
                        </div>
                    </div>
                    <div class="field field--type-tel order__field">
                        <div class="field__field ">
                            <input type="text" name="phone" required placeholder="Введите ваш телефон" id="form-order-phone" value="" required="required" class="field__phone" data-validator-required-message="Обязательное поле">
                        </div>
                    </div>
                    <div class="field field--type-email order__field">
                        <div class="field__field">
                            <input type="text" required class="validation-email" name="email" placeholder="Введите ваш e-mail" id="form-order-email" value="" data-validator-email-message="Неправильный формат Email">
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
                        <div class="order__total-item">
                            <span>Общая стоимость товаров </span>
                            <span class="products-total-price">2980 руб.</span>
                        </div>
                        <div class="order__total-delivery">
                            <span>Стоимость доставки </span>
                            <span class="products-total-price">350 руб.</span>
                        </div>
                        <div class="order__total-item">
                            <div class="field__field">
                                <input type="text" name="coupon" id="input-coupon" placeholder="Введите промо-код">
                                <button class="button" id="button-coupon" type="submit">
                                    <span class="button__caption">Применить</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="order__total-sum">
                        <span>Всего к оплате</span>
                        <span class="all-total-price">2980 руб.</span>
                    </div>

                    <button class="button order__button-submit" id="checkout_button" type="submit">
                        <span class="button__caption">Оформить заказ</span>
                    </button>
                    <div class="alert smp alert-danger alert-dismissible mail-error"></div>
                </section>
                <section class="d-none hidden" id="payment">
                </section>
            </div>
        </div>
    </article>
    <button title="Close (Esc)" type="button" class="mfp-close">×</button>

<!--/CART POPUP-->
<script>
    $('document').ready(function () {
        updateCartCount();
        countTotal();
        let csrf = $('input[name=_token]').val();

        var deliveryDate = new Date();
        deliveryDate.setDate(deliveryDate.getDate() + 1);
        var options = { year: 'numeric', month: 'numeric', day: 'numeric' };

        $('.sdek-delivery-date').text(deliveryDate.toLocaleDateString('ru-RU', options));

        // Minus item
        $('.order__item-quantity').find('.field__minus').on('click', function () {
            let field = $(this).parent().find('input');
            let productId = field.data('product-unique-id')
            $.ajax({
                url: '/cart/1',
                method: 'put',
                data: {
                    'product_uid': productId,
                    'action': 'remove',
                },
                headers: {
                    'X-CSRF-TOKEN': csrf,
                },
                success: function(data) {
                    var magnificPopup = $.magnificPopup.instance;

                    $.ajax({
                        type: 'GET',
                        url: '/ajax/cart',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                        },
                        success: function (data) {
                            $('.mfp-content').empty();
                            $('.mfp-content').append(data);
                            countTotal();
                            updateCartCount()
                        }
                    })

                },
                error: function (data) {
                }
            });
        });

        // Plus item
        $('.order__item-quantity').find('.field__plus').on('click', function () {
            let field = $(this).parent().find('input');
            let productId = field.data('product-id')
            $.ajax({
                url: '/cart/1',
                method: 'put',
                data: {
                    'product_id': productId,
                    'action': 'add',
                    'size': 'm',
                    'quantity': 1,
                },
                headers: {
                    'X-CSRF-TOKEN': csrf,
                },
                success: function(data) {
                    var magnificPopup = $.magnificPopup.instance;

                    $.ajax({
                        type: 'GET',
                        url: '/ajax/cart',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                        },
                        success: function (data) {
                            $('.mfp-content').empty();
                            $('.mfp-content').append(data);
                            countTotal();
                            updateCartCount()
                        }
                    })
                },
                error: function (data) {
                }
            });
        });

        // Remove item from the cart
        $('.order__item-remove').on('click', function () {
            let productId = $(this).data('product-id');
            let item = $(this);

            $.ajax({
                url: '/cart/2',
                method: 'put',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                },
                data: {
                    'action': 'delete',
                    'product_uid': productId,
                },
                success: function(data) {
                    $.ajax({
                        type: 'GET',
                        url: '/ajax/cart',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                        },
                        success: function (data) {
                            $('.mfp-content').empty();
                            $('.mfp-content').append(data);
                            countTotal();
                            updateCartCount()
                        }
                    })
                },
                error: function (data) {
                }
            });
        })
    })

    function updateCartCount() {
        let csrf = $('input[name=_token]').val();
        $.ajax({
            url: '/cart/get-count',
            method: 'get',
            headers: {
                'X-CSRF-TOKEN': csrf,
            },
            success: function (data) {
                $('.btn-cart__quantity').text(data.count);
            }
        })
    }

    // Get cart total sum
    function countTotal() {
        let csrf = $('input[name=_token]').val();
        $.ajax({
            url: '/cart/get-total',
            method: 'get',
            headers: {
                'X-CSRF-TOKEN': csrf,
            },
            success: function (data) {
                $('.order__total-item .products-total-price').text(data.total_final + ' руб.');
                $('.all-total-price').text(data.total_final + ' руб.');

                // alert with free delivery
                var freeDeliveryTotal = 5900;
                if (freeDeliveryTotal - data.total_final <= 0) {
                    $('.order__alert').find('.alert__text').text('Доставка будет бесплатной!');
                } else {
                    let diff = freeDeliveryTotal - data.total_final;
                    $('.order__alert').find('.alert__text').find('b').text(diff + ' руб.');
                }
                getFinal();
            },
        })
    }

    function getFinal() {
        var final = 0;
        var total = $('.order__total-item .products-total-price').text();
        var delivery = $('.order__total-delivery .products-total-price').text();
        total = total.replace(/[^0-9]/gim,'');
        delivery = delivery.replace(/[^0-9]/gim,'');
        if (total >= 5900) {
            final = total;
        } else {
            final = parseInt(total) + parseInt(delivery);
        }
        $('.order__total-sum .all-total-price').text(final + ' руб.');
    }

    // Delivery city suggestion
    $('#form-order-city').on('change paste keyup', function () {
        var city_name = this.value;
        if (city_name == '') {
            $('.dropdown-menu').css('display', 'none');
        }
        $.ajax({
            url: 'cdek/city-autofill?city_name=' + this.value,
            success: function (data) {
                var suggestionsList = '';
                var data = JSON.stringify(data);
                data = JSON.parse(data);
                data = data[0].geonames;
                console.log(data);


                for (var i = 0; i < data.length; i++) {
                    if (data[i].countryIso == 'RU') {
                        let cityName = data[i].cityName;
                        let zipCode = data[i].postCodeArray[0];
                        suggestionsList += '<li data-value="' + cityName + '" data-zipcode="' + zipCode + '"><a class="cityName" href="#">' + cityName + '</a></li>';
                    }
                }
                $('.dropdown-menu').empty();
                $('.dropdown-menu').append(suggestionsList);
                if ($('.dropdown-menu li').length > 0) {
                    $('.dropdown-menu').css('display', 'block');
                }
                $('.cityName').click(function(){
                    $('.dropdown-menu').css('display', 'none');
                    $('#form-order-city').val($(this).text())
                    $('#city-zipcode').val($(this).parent().attr('data-zipcode'))

                    var csrf = $('input[name=_token]').val();
                    $.ajax({
                        url: '/cdek/get-delivery-price',
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                        },
                        data: {
                            'receiver_zip': $('#city-zipcode').val(),
                            'tariff_id': 11,
                        },
                        success: function (data) {
                            var deliveryDate = new Date();
                            deliveryDate.setDate(deliveryDate.getDate() + data.data[0].period_max);
                            var options = { year: 'numeric', month: 'numeric', day: 'numeric' };

                            $('.sdek-price').text(data.data[0].price + ' руб.');
                            $('.sdek-delivery-date').text(deliveryDate.toLocaleDateString('ru-RU', options));

                            $('.order__total-delivery .products-total-price').text(data.data[0].price + ' руб.');
                            getFinal();
                        },
                        fail: function (data) {
                            console.log(data);
                        }
                    })

                })
            }
        })
    })

    $('.validation-email').on('blur', function () {
  let email = $(this).val();

  if (email.length > 0
  && (email.match(/.+?\@.+/g) || []).length !== 1) {
    console.log('invalid');
    $('.mail-error').text('Е-mail адрес введен неверно!')
  } else {
    console.log('valid');
    //alert('Вы ввели корректный e-mail!');
    $('.mail-error').text('')
  }
});

    $('input[name="phone"]').mask('+7 (999) 999-99-99');



</script>
