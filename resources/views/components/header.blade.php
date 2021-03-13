


<div class="header__container"><button class="btn-menu header__btn-menu" type="button" title="Меню"><span class="btn-menu__in"></span></button>
    <div class="logo logo--header header__logo">
        <img src="img/Logo.png"  height="50" alt="unidragon.ru" />
        <img src="img/Logo.png" height="61" alt="unidragon.ru" />
    </div>


    <a class="btn-cart js-popup header__btn-cart" href="#" role="button" title="Корзина">
        <svg class="svg-icon svg-icon--cart">
            <use xlink:href="#cart"></use>
        </svg><span class="btn-cart__quantity"></span>
    </a>

    <div class="header__nav">
        <nav class="menu header__menu">
            <ul class="menu__items">
                <li class="menu__item"><a class="js-scrollto position-link" href="#products">Дизайны вышивок</a></li>
                <li class="menu__item"><a class="js-scrollto position-link" href="#videos">Видео</a></li>
                <li class="menu__item"><a class="js-scrollto position-link" href="#faq">Faq</a></li>
                <li class="menu__item"><a class="js-scrollto position-link" href="#testimonials">Отзывы</a></li>
                <li class="menu__item"><a class="js-scrollto position-link" href="#delivery-block">Доставка и оплата</a></li>
                @foreach($productTypes as $productType)
                    <li class="menu__item"><a class="position-link" href="/compilation?tag_id={{ $productType->id }}">{{ $productType->title }}</a></li>
                @endforeach
            </ul>
        </nav>
        <a class="email email--header header__email" href="mailto:info@wowlandia.ru">
            <svg class="svg-icon svg-icon--email email__icon">
                <use xlink:href="#email"></use>
            </svg>
            <span class="email__label">E-mail:</span>
            <div class="email__email">info@wowlandia.ru</div>
        </a>
        <a class="phone phone--header header__phone" href="tel:+79852795948"><svg class="svg-icon svg-icon--phone phone__icon">
                <use xlink:href="#phone"></use>
            </svg><span class="phone__label">Телефон:</span>
            <div class="phone__phone">+7 985 279 59 48</div>
        </a>
        <div class="social social--header header__social">
            <div class="social__buttons">
                <!--<a class="social__button" href="" role="button" target="_blank" rel="nofollow noopener">
                    <svg class="svg-icon svg-icon--social-vk">
                        <use xlink:href="#social-vk"></use>
                    </svg>
                </a>-->

                <a class="social__button" href="http://instagram.com/wowlandia.ru" role="button" target="_blank" rel="nofollow noopener">
                    <svg class="svg-icon svg-icon--social-instagram">
                        <use xlink:href="#social-instagram"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>

</div>
