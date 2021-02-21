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
	$('.slideshow__items').slick({
	  slidesToShow: 1,
	  fade: false
	});

	$('.open-cart_2').magnificPopup({
		type: 'ajax',
		alignTop: true,
		overflowY: 'scroll'
	});

	$('.open-cart').magnificPopup({
		type: 'inline',
		preloader: false,
		focus: '#popup--product',
		modal: true,
		callbacks: {
		    open: function() {

		    	//fillPopup();
		    if($(window).width()>=1024){  
		      $('.grid').masonry({
				itemSelector: '.grid-item',
			  })
			}
		    },
		    close: function() {
		      // Will fire when popup is closed
		    }
		    // e.t.c.
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
	addToCart()
})


var newJson = {
	"mainImg": ["img/test-itom-1_1.png","img/test-itom-1_1.png","img/test-itom-1_1.png","img/test-itom-1_1.png"],
	"navImg": ["img/test-itom-1_1.png","img/test-itom-1_1.png","img/test-itom-1_1.png","img/test-itom-1_1.png"],
	"title" : "Пазл «Чарующая сова»",
	"reiting": 5,
	"reviewsCount": 20,
	"ballsCounts": [5,0,1,1,3,15],//сначала общий балл, поотом сколько каких  1  -> 5
	"price": "1000 руб.",
	"description": ["some description 1", "some description 2", "some description 3"],
	"reviews": [
		{
			"revImg":["img/test-itom-1_1.png","img/test-itom-1_2.jpg"],
			"revName":"Ян Войцеховский",
			"revReiting":5,
			"revDate":"18 августа 2020",
			"revText":"Я доволен своим заказом! Быстрая доставка, изумительное качество, хорошая цена; рекомендую ... Я получил удовольствие от сборки пазла. Хочу заказать еще льва. Буду ждать следующий заказ с нетерпением!"
		},{
			"revImg":["img/test-itom-1_1.png","img/test-itom-1_2.jpg"],
			"revName":"Анна Родионова",
			"revReiting":4,
			"revDate":"8 мая 2020",
			"revText":"Хорошо упакована. Необычная упаковка. Взяла в подарок брату... Он был удивлен необычной формой пазлов. Сказал что получил незабываемое впечатление от сбора пазла. Подарок удался! Я счастлива!"
		},{
			"revImg":["img/test-itom-1_1.png","img/test-itom-1_2.jpg"],
			"revName":"Тарасов Андрей",
			"revReiting":4,
			"revDate":"1 августа 2120",
			"revText":"00% доволен этим товаром. Гарантированно, вы никогда не собирали такую ​​головоломку, как эта! Стоит каждой копейки"
		},{
			"revImg":["img/test-itom-1_1.png","img/test-itom-1_2.jpg"],
			"revName":"Ян Войцеховский",
			"revReiting":5,
			"revDate":"18 августа 2020",
			"revText":"Я доволен своим заказом! Быстрая доставка, изумительное качество, хорошая цена; рекомендую ... Я получил удовольствие от сборки пазла. Хочу заказать еще льва. Буду ждать следующий заказ с нетерпением!"
		},{
			"revImg":["img/test-itom-1_1.png","img/test-itom-1_2.jpg"],
			"revName":"Анна Родионова",
			"revReiting":4,
			"revDate":"8 мая 2020",
			"revText":"Хорошо упакована. Необычная упаковка. Взяла в подарок брату... Он был удивлен необычной формой пазлов. Сказал что получил незабываемое впечатление от сбора пазла. Подарок удался! Я счастлива!"
		},{
			"revImg":["img/test-itom-1_1.png","img/test-itom-1_2.jpg"],
			"revName":"Тарасов Андрей",
			"revReiting":4,
			"revDate":"1 августа 2120",
			"revText":"00% доволен этим товаром. Гарантированно, вы никогда не собирали такую ​​головоломку, как эта! Стоит каждой копейки"
		},{
			"revImg":["img/test-itom-1_1.png","img/test-itom-1_2.jpg"],
			"revName":"Ян Войцеховский",
			"revReiting":5,
			"revDate":"18 августа 2020",
			"revText":"Я доволен своим заказом! Быстрая доставка, изумительное качество, хорошая цена; рекомендую ... Я получил удовольствие от сборки пазла. Хочу заказать еще льва. Буду ждать следующий заказ с нетерпением!"
		},{
			"revImg":["img/test-itom-1_1.png","img/test-itom-1_2.jpg"],
			"revName":"Анна Родионова",
			"revReiting":4,
			"revDate":"8 мая 2020",
			"revText":"Хорошо упакована. Необычная упаковка. Взяла в подарок брату... Он был удивлен необычной формой пазлов. Сказал что получил незабываемое впечатление от сбора пазла. Подарок удался! Я счастлива!"
		},{
			"revImg":["img/test-itom-1_1.png","img/test-itom-1_2.jpg"],
			"revName":"Тарасов Андрей",
			"revReiting":4,
			"revDate":"1 августа 2120",
			"revText":"00% доволен этим товаром. Гарантированно, вы никогда не собирали такую ​​головоломку, как эта! Стоит каждой копейки"
		},{
			"revImg":["img/test-itom-1_1.png","img/test-itom-1_2.jpg"],
			"revName":"Ян Войцеховский",
			"revReiting":5,
			"revDate":"18 августа 2020",
			"revText":"Я доволен своим заказом! Быстрая доставка, изумительное качество, хорошая цена; рекомендую ... Я получил удовольствие от сборки пазла. Хочу заказать еще льва. Буду ждать следующий заказ с нетерпением!"
		},{
			"revImg":["img/test-itom-1_1.png","img/test-itom-1_2.jpg"],
			"revName":"Анна Родионова",
			"revReiting":4,
			"revDate":"8 мая 2020",
			"revText":"Хорошо упакована. Необычная упаковка. Взяла в подарок брату... Он был удивлен необычной формой пазлов. Сказал что получил незабываемое впечатление от сбора пазла. Подарок удался! Я счастлива!"
		},{
			"revImg":["img/test-itom-1_1.png","img/test-itom-1_2.jpg"],
			"revName":"Тарасов Андрей",
			"revReiting":4,
			"revDate":"1 августа 2120",
			"revText":"00% доволен этим товаром. Гарантированно, вы никогда не собирали такую ​​головоломку, как эта! Стоит каждой копейки"
		},
	]
}


function  fillPopup(){
	$('.slideshow__items').empty()
	$('.slideshow__nav-items').empty()
	$('.product__description').empty()
	//$('.reviews__items').empty()

	var sliderLength = newJson.mainImg.length;
	var descriptionLength = newJson.description.length;
	var reviewsLength = newJson.reviews.length;

	for (let i = 0; i < sliderLength; i++) { 
	  	$('.slideshow__items').append('<div calss="slideshow__item">');
	  	$('.slideshow__items div').last().append('<a>');
		$('.slideshow__items a').last().append('<img class="product-img" src="' + newJson.mainImg[i] + '" alt="'+i+'" data-count="'+i+'">');

		$('.slideshow__nav-items').append('<div class="slideshow__nav-item">');
	  	$('.slideshow__nav-items div').last().append('<img src="' + newJson.mainImg[i] + '" alt="'+i+'">');
	}

	$('.product__title').text(newJson.title)
	$('.product__reviews-count').text(newJson.reviewsCount + " отзывов")
	$('.product__price-value').text(newJson.price)
	$('.rating__average').text(newJson.ballsCounts[0])

	$('.reviews__title').text("Отзывы покупателей ("+newJson.reviewsCount+")")
	$('.rating__base b').text(newJson.reviewsCount+' отзывов')

	$('.rating__value_1').text(newJson.ballsCounts[1])
	$('.rating__value_2').text(newJson.ballsCounts[2])
	$('.rating__value_3').text(newJson.ballsCounts[3])
	$('.rating__value_4').text(newJson.ballsCounts[4])
	$('.rating__value_5').text(newJson.ballsCounts[5])


	$('.product__description').append('<h3 class="product__title-3">Описание</h3>');
	for (let i = 0; i < sliderLength; i++) { 	  	
	  	$('.product__description').append('<p>');
	  	$('.product__description p').last().text(newJson.description[i]);
	}


	for (let i = 0; i < reviewsLength; i++) {
		console.log(i)
		$('.reviews__items').append('<div calss="reviews__item grid-item">');
		$('.reviews__items div').last().append('<div calss="c-review">');
		$('.reviews__items div').last().append('<figure class="c-review__picture js-popup-gallery">');
		$('.reviews__items figure').last().append('<a>');

		$('.reviews__items a').last().append('<img src="'+newJson.reviews[i].revImg[0]+'" alt="'+newJson.reviews[i].revName+'">');

		$('.reviews__items div').last().append('<div class="c-review__photos"><span class="c-review__photos-quantity">2</span><svg class="svg-icon svg-icon--photos"><use xlink:href="#photos"></use></svg></div>')

		$('.c-review').append('<div class="c-review__content">')
		$('.reviews__items .c-review__content').last().append('<div class="c-review__name">').text(newJson.reviews[i].revName)
		$('.reviews__items .c-review div').last().append('<div class="c-review__info">')
		$('.reviews__items .c-review__info').last().append('<div class="star-rating c-review__star-rating" title="5"><span class="star-rating__rating" style="width:100%"></span></div><time class="c-review__date" datetime="'+newJson.reviews[i].revDate+'">').text(newJson.reviews[i].revDate)
		$('.reviews__items .c-review__content').last().append('<div class="c-review__text">')
		$('.reviews__items .c-review__text').last().append('<p>').text(newJson.reviews[i].revText)

	}

}



var cartJson = []

function addToCart(){
	var title = $('.product__title').text();
	var productImg = '';
	var price = $('.product__price-value').text();

	$('.product-img').each(function(){
		console.log($(this).attr('data-count'))
		if($(this).attr('data-count') == '0'){
			productImg = $(this).attr('src');
		}
	})

	let product = {
		"title": title,
		"productImg":  productImg,
		"price": price,		
	}

	cartJson.push(product)

	console.log(cartJson)

}
/*
function fillCart(){
	for(let i = 0; i<cartJson.length; i++){
		$('.order__item-title').text
	}
}*/