var $ = jQuery;
$('.js-wp-main-slider-image-buttons button').click(function () {
    $('.js-wp-main-slider-image-buttons button').removeClass('wp-main-slider-image-button--active');
    $(this).addClass('wp-main-slider-image-button--active');

    var index = $(this).index('.js-wp-main-slider-image-buttons button') + 1;
    swiperMain.slideTo(index);
});

swiperMain.on('slideChangeStart', function () {
    var activeButton = $('.js-wp-main-slider-image-buttons button')[swiperMain.activeIndex - 1];
    $('.js-wp-main-slider-image-buttons button').removeClass('wp-main-slider-image-button--active');
    $(activeButton).addClass('wp-main-slider-image-button--active');
});
