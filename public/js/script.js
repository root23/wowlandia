let targetScroll = 100; // расстояние до действия / в px
$(window).on('scroll', function(){
  if($(this).scrollTop() >= targetScroll) {
    isScroll = 1;
    $('body').addClass('offset')
    $('.page__header').addClass('fixed')
  } else if($(this).scrollTop() < targetScroll) {
    $('body').removeClass('offset')
    $('.page__header').removeClass('fixed')
  }
});

$(function(){
    $("a[href^='#']").click(function(){
        var _href = $(this).attr("href");
        $("html, body").animate({scrollTop: $(_href).offset().top+"px"});
        return false;
    });

    $('.faq__question').click(function(){
    	var parent = $(this).parent()
    	if(parent.hasClass('active')){
    		parent.removeClass('active')
    		parent.find('.faq__answer').slideUp()
    	}else{
    		parent.addClass('active')
    		parent.find('.faq__answer').slideDown()
    	}
    })
    $('.reviews__add-review-button').click(function(){
    	if($(this).hasClass('active')){
    		$(this).removeClass('active')
    		$('.reviews__add-review').slideUp()
    	}else{
    		$(this).addClass('active')
    		$('.reviews__add-review').slideDown()
    	}
    })

    if($(window).width() <= 980){
    	$('.videos__items').slick({
    		centerPadding: '40px',
    	});
    }
    if($(window).width()<=740){
    	$('.product__size-radios').slick({
    		slidesToShow: 2,
    		infinite:false,
    	});
    }
});



$(document).ready(function(){
	$('.c-product__images').slick({

	  fade: true,
	  cssEase: 'linear'
	});
	$('.package__images').slick({

	  fade: true,
	  cssEase: 'linear',
	  responsive: [
	    {
	      breakpoint: 981,
	      settings: {
		      fade: false,
	      }
	    }
	  ]
	});

	$('.testimonials__items').slick({
	  slidesToShow: 2,
	  fade: false
	});


	$('.open-cart_2').magnificPopup({
		type: 'ajax',
		alignTop: true,
		overflowY: 'scroll'
	});

	$('.open-cart').magnificPopup({
        type: 'ajax',
        modal: true,

        ajax: {
            settings: null,
            tError: 'Ошибка при загрузке данных. Приносим свои извинения.'
        },

        callbacks: {
            parseAjax: function(mfpResponse) {
                // console.log('Ajax content loaded:', mfpResponse);
            },
            ajaxContentAdded: function() {
              // console.log(this.content);
                $('.faq__question').click(function(){
                    var parent = $(this).parent()
                    if(parent.hasClass('active')){
                        parent.removeClass('active')
                        parent.find('.faq__answer').slideUp()
                    }else{
                        parent.addClass('active')
                        parent.find('.faq__answer').slideDown()
                    }
                })
                $('.reviews__add-review-button').click(function(){
                    if($(this).hasClass('active')){
                        $(this).removeClass('active')
                        $('.reviews__add-review').slideUp()
                    }else{
                        $(this).addClass('active')
                        $('.reviews__add-review').slideDown()
                    }
                })


                // Product variant change
                let productId = $('input[type=radio][id=product-variant-1]').val();
                $('input[type=radio][class=product-variant-check]').change(function() {
                    productId = this.value;

                    // Change price
                    let elem = $('.product__size-radio[data-product-id="' + productId + '"]');
                    elem = elem.find('.radio-size__price-value').text();
                    $('.product__price-value').text(elem);
                });

                // Add to cart


                $('.grid').masonry({
                    itemSelector: '.grid-item',
                })
                $('.slideshow__items').slick({
                    slidesToShow: 1,
                    fade: false
                });


            },
            close: function() {
                // Will fire when popup is closed
            }
        }
    });

		$('.btn-cart').magnificPopup({
		type: 'inline',
		preloader: false,
		focus: '#cart-popup',
		modal: true

	});
	$(document).on('click', '.js-popup-close', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});
})

$('.add-to-cart').click(function(){

});


