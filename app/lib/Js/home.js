$(document).ready(function() {
    $('#home').addClass('active');
});

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

    on: {
        init: function (i) {
            var background = $(i.slides[i.activeIndex]).data('background');
            $('#slide_container').css('backgroundImage', 'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(https://image.tmdb.org/t/p/original' + background);
        },
        slideChange: function (i) {
            var background = $(i.slides[i.activeIndex]).data('background');
            $('#slide_container').css('backgroundImage', 'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(https://image.tmdb.org/t/p/original' + background);
        },
    },
});

const populares = new Swiper(".row .swiper", {
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