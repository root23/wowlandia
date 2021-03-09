<div class="popup__top" id="sizes-popup">
    <a class="popup__link-back js-popup-close" href="#">
        <svg class="svg-icon svg-icon--arrow-left">
            <use xlink:href="#arrow-left"></use>
        </svg>
        <input type="hidden" id='product_id' name="product-id" value="{{ $product_id }}">
        <span>Вернуться в корзину</span>
    </a>
    <button class="popup__btn-close js-popup-close" type="button" title="Закрыть"></button>
</div>

<div class="popup--sizes__img-container">
    <img class="popup--sizes__img" src="img/size-1.jpg" alt="">
</div>


<script>
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $('#sizes-popup').offset().top+"px"});

        $('.js-popup-close').on('click', function () {

            console.log('test1')

            var product_id = $('#product_id').val()

            
            $.magnificPopup.close();
            //$('.open-cart--'+product_id).click();
            //$('.header__btn-cart').click()

            setTimeout(function(){
             $('.open-cart--'+product_id).click();
            }, 100);
            //console.log($('.open-cart--'+product_id))
             //console.log($('.header__btn-cart'))
            //console.log('product_id = '+ product_id)
            /*var btn = null;
            $('.c-product__button-size').each(function () {

                console.log('data = ' + parseInt($(this).attr('data-productId')))
               // console.log($('#product_id').val())  
                if (parseInt($(this).attr('data-productId'), 10) == product_id) {
                    console.log('id = ' + parseInt($(this).attr('data-productId'), 10))
                    $(this).click();

                    //console.log(btn)
                    //btn.trigger('click');
                }
            })*/
            
        })
    })

</script>
