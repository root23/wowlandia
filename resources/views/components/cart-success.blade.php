<div class="popup__top" id="cart-success-popup">
    <button class="popup__btn-close js-popup-close" type="button" title="Закрыть"></button>
</div>
<article class="success popup--success">
    <div class="success__icon"></div>
    <h2 class="success__title">Товар добавлен в корзину!</h2>
    <div class="success__text">
        <div class="c-product__bottom w-50a">

            <a class="button c-product__button-view button--white" onclick="$.magnificPopup.close(); return false;" role="button">
                <span class="button__caption">Продолжить покупки</span>
            </a>
            <a class="button c-product__button-size js-popup btn-goto-cart" role="button">
                <span class="button__caption">Перейти в корзину</span>
            </a>
        </div>
    </div>
</article>
<button title="Close (Esc)" type="button" class="mfp-close">×</button>

<script>
    $('.btn-goto-cart').click(function () {
        console.log('ttt');
        $.magnificPopup.close();
        $('.header__btn-cart').click();

    })
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $('#cart-success-popup').offset().top+"px"});
    })
</script>
