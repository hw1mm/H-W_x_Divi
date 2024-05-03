jQuery(function ($) {
    feather.replace();


    const swiperImg = new Swiper('.hw-projectSlider-swiper', {
        loop:true,
        // effect: "fade",
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
    // const swiperText = new Swiper('.hw-projectSlider-swiperText', {
    //     // effect: "fade",
    //     navigation: {
    //         nextEl: '.swiper-button-next',
    //         prevEl: '.swiper-button-prev',
    //     },
    // });
})