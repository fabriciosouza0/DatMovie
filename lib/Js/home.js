const destaques = new Swiper("#destaques", {
    cssMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
    autoplay: {
        delay: 4000,
    },
});

const populares = new Swiper("#populares .swiper", {
    breakpoints: {
        320: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        480: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        640: {
            slidesPerView: 4,
            spaceBetween: 10
        },
        768: {
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

const series = new Swiper("#series .swiper", {
    breakpoints: {
        320: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        480: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        640: {
            slidesPerView: 4,
            spaceBetween: 10
        },
        768: {
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