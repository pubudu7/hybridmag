const hmThemeSwiper = new Swiper( '.hm-swiper', {
    speed: 400,
    effect: 'slide',
    init: true,
    // Navigation arrows
    navigation: {
        disabledClass: 'hm-swiper-button-disabled',
        hiddenClass: 'hm-swiper-button-hidden',
        lockClass: 'hm-swiper-button-lock',
        nextEl: '.hm-swiper-button-next',
        prevEl: '.hm-swiper-button-prev',
    },
    loop: true,
    preloadImages: false,
    autoplay: {
        delay: 6000,
        pauseOnMouseEnter: true,
        disableOnInteraction: false
    },
    containerModifierClass: 'hm-swiper-',
    noSwipingClass: 'hm-swiper-no-swiping',
    slideActiveClass: 'hm-swiper-slide-active',
    slideBlankClass: 'hm-swiper-slide-invisible-blank',
    slideClass: 'hm-swiper-slide',
    slideDuplicateActiveClass: 'hm-swiper-slide-duplicate-active',
    slideDuplicateClass: 'hm-swiper-slide-duplicate',
    slideDuplicateNextClass: 'hm-swiper-slide-duplicate-next',
    slideDuplicatePrevClass: 'hm-swiper-slide-duplicate-prev',
    slideNextClass: 'hm-swiper-slide-next',
    slidePrevClass: 'hm-swiper-slide-prev',
    slideVisibleClass: 'hm-swiper-slide-visible',
    wrapperClass: 'hm-swiper-wrapper'

});