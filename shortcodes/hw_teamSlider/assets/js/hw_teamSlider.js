jQuery(function ($) {
    const swiperTeam = new Swiper('.hw-teamSlider-swiper', {
        loop: true,
        slidesPerView: 2,
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 3,
                spaceBetween: 15,
            },
            981: {
                slidesPerView: 5,
                spaceBetween: 20,
            },
        },
    });

})