var $ = jQuery;
$('.js-mytory-slider-buttons button').click(function () {
    $('.js-mytory-slider-buttons button').removeClass('mytory-slider-button--active');
    $(this).addClass('mytory-slider-button--active');

    var index = $(this).index('.js-mytory-slider-buttons button') + 1;
    swiperMain.slideTo(index);
});

swiperMain.on('slideChangeStart', function () {
    var activeButton = $('.js-mytory-slider-buttons button')[swiperMain.activeIndex - 1];
    $('.js-mytory-slider-buttons button').removeClass('mytory-slider-button--active');
    $(activeButton).addClass('mytory-slider-button--active');
});
