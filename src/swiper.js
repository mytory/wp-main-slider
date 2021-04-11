// import Swiper JS
import Swiper from 'swiper';
window.Swiper = Swiper;

setTimeout(() => {
    window.mainSlider = new Swiper('.js-main-slider', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    alert('mainSlider');
}, 1000);
