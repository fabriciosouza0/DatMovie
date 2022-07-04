const swiper = new Swiper(".swiper", {
    breakpoints: {
        375: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        576: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        992: {
            slidesPerView: 4,
            spaceBetween: 10
        },
        1280: {
            slidesPerView: 5,
            spaceBetween: 10
        },
        1920: {
            slidesPerView: 6,
            spaceBetween: 10
        }
    },
    cssMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    mousewheel: true,
    keyboard: true,
});