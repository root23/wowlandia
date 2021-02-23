<div class="popup__top">
    <button class="popup__btn-close js-popup-close" type="button" title="Закрыть"></button>
</div>
<article class="success popup--success">
    <div class="success__icon"></div>
    <h2 class="success__title">Спасибо! Ваш заказ оформлен</h2>
    <div class="success__text">
        <div class="c-product__bottom w-50a">

            <a class="button c-product__button-view button--white" onclick="$.magnificPopup.close(); return false;" role="button">
                <span class="button__caption">Продолжить покупки</span>
            </a>

            @if ($paymentInfo['payment']['payment_type'] == 'bank')
                <p>Для уточнения параметров заказа наши менеджеры свяжутся с Вами в ближайшее время</p>
            @else
                <p>Для перехода к оплате пройдите по <a class="pay--link" href="{{ $paymentInfo['payment']['payment_url'] }}">ссылке</a> </p>
                <p>Идентификатор заказа: <b>{{ $paymentInfo['payment']['payment_id'] }}</b></p>
            @endif
        </div>
    </div>
</article>
<button title="Close (Esc)" type="button" class="mfp-close">×</button>

<script>
</script>
