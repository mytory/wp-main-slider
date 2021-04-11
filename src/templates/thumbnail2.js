var $ = jQuery;
$('.js-mytory-slider-image-buttons button').click(function () {
    $('.js-mytory-slider-image-buttons button').removeClass('mytory-slider-image-button--active');
    $(this).addClass('mytory-slider-image-button--active');

    var index = $(this).index('.js-mytory-slider-image-buttons button') + 1;
    swiperMain.slideTo(index);
});

swiperMain.on('slideChangeStart', function () {
    var activeButton = $('.js-mytory-slider-image-buttons button')[swiperMain.activeIndex - 1];
    $('.js-mytory-slider-image-buttons button').removeClass('mytory-slider-image-button--active');
    $(activeButton).addClass('mytory-slider-image-button--active');
});
