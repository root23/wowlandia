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
        if (_href == '#') {
            return;
        }
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

    $('.header__btn-menu').click(function(){
    	if($(this).hasClass('active')){
    		$(this).removeClass('active');
    		$('.header__nav').removeClass('active')
    	}else{
			$(this).addClass('active');
    		$('.header__nav').addClass('active')
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


    updateCartCount();

	$('.videos__item').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    });

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

    let csrf = $('input[name=_token]').val();

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

    function loadCart() {
        $.ajax({
            type: 'GET',
            url: '/ajax/cart',
            headers: {
                'X-CSRF-TOKEN': csrf,
            },
            success: function (data) {
                var popup = $.magnificPopup.open({
                    type: 'inline',
                    modal: true,
                    removalDelay: 300,
                    mainClass: 'mfp-fade',
                    items: {
                        src: data
                    },
                    callbacks: {
                        change: function() {

                        },
                        open: function () {
                            // Get cart total price
                            $.ajax({
                                url: '/cart/get-total',
                                method: 'get',
                                headers: {
                                    'X-CSRF-TOKEN': csrf,
                                },
                                success: function(data) {
                                    $('.products-total-price').text(data.total_final + ' руб.');
                                    $('.all-total-price').text(data.total_final + ' руб.');
                                },
                                error: function (data) {
                                    console.log(data);
                                }
                            });
                        }
                    },
                })
            }
        });
    }

    $('.btn-cart').click(function () {
        loadCart();
    });

    $('.btn-goto-cart').click(function () {
        console.log('ttt');
        $.magnificPopup.close();
        loadCart();
    })

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

                // Change product amount
                $('.product__quantity').find('.field__minus').on('click', function () {
                    if ($('input[name=quantity]').val() == 1) {
                        return;
                    } else {
                        $('input[name=quantity]').val(parseInt($('input[name=quantity]').val()) - 1);
                    }
                });
                $('.product__quantity').find('.field__plus').on('click', function () {
                    $('input[name=quantity]').val(parseInt($('input[name=quantity]').val()) + 1);
                });

                // Add to cart
                let csrf = $('input[name=_token]').val();
                $('#button-cart').on('click', function () {
                    $.ajax({
                        url: '/cart/1',
                        method: 'put',
                        data: {
                            'product_id': productId,
                            'size': 'm',
                            'action': 'add',
                            'quantity': $('input[name=quantity]').val(),
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                        },
                        success: function(data) {
                            $('input[name=quantity]').val(1);
                            updateCartCount();

                            $.ajax({
                                type: 'GET',
                                url: '/ajax/cart-success',
                                headers: {
                                    'X-CSRF-TOKEN': csrf,
                                },
                                success: function (data) {
                                    $('.mfp-content').empty();
                                    $('.mfp-content').append(data);
                                }
                            })

                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                });

                function updateCartCount() {
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

	$(document).on('click', '.js-popup-close', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});
})

 $('#form-order-city').on('change paste keyup', function () {
        var city_name = this.value;
        if (city_name == '') {
            $('.dropdown-menu').css('display', 'none');
        }

    })
