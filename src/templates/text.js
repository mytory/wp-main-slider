var $ = jQuery;
$('.js-wp-main-slider-buttons button').click(function () {
    $('.js-wp-main-slider-buttons button').removeClass('wp-main-slider-button--active');
    $(this).addClass('wp-main-slider-button--active');

    var index = $(this).index('.js-wp-main-slider-buttons button') + 1;
    swiperMain.slideTo(index);
});

swiperMain.on('slideChangeStart', function () {
    var activeButton = $('.js-wp-main-slider-buttons button')[swiperMain.activeIndex - 1];
    $('.js-wp-main-slider-buttons button').removeClass('wp-main-slider-button--active');
    $(activeButton).addClass('wp-main-slider-button--active');
});
