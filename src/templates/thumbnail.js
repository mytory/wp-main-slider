var $ = jQuery;
var $mainSlide = $('.js-main-slider .swiper-slide').first();
var mainWidth = $mainSlide.width();
var mainHeight = $mainSlide.height();

var thumbnailCount = $('.swiper-thumbnail .swiper-slide').length;
var thumbnailContainerWidth = $('.swiper-thumbnail').width();
var thumbnailWidthPercent;

if (thumbnailContainerWidth > 1200) {
    // 썸네일이 6개까지 나오게 한다.
    if (thumbnailCount >= 6) {
        thumbnailWidthPercent = 100/6;
    } else {
        thumbnailWidthPercent = 100/thumbnailCount;
    }
} else if (thumbnailContainerWidth > 900) {
    // 썸네일이 5개까지 나오게 한다.
    if (thumbnailCount >= 5) {
        thumbnailWidthPercent = 100/5;
    } else {
        thumbnailWidthPercent = 100/thumbnailCount;
    }
} else if (thumbnailContainerWidth > 600) {
    // 썸네일이 4개까지 나오게 한다.
    if (thumbnailCount >= 4) {
        thumbnailWidthPercent = 100/4;
    } else {
        thumbnailWidthPercent = 100/thumbnailCount;
    }
} else {
    // 썸네일이 3개까지 나오게 한다.
    thumbnailWidthPercent = 33.333;
}

// $('.swiper-thumbnail .swiper-slide').each(function (i, el) {
//     delete el.style.width;
//     el.style.setProperty('width', thumbnailWidthPercent + '%', 'important');
// });
// var thumbnailWidth = $('.swiper-thumbnail .swiper-slide').width();
// var thumbnailHeight = mainHeight * thumbnailWidth / mainWidth;
// $('.swiper-thumbnail').css('height', thumbnailHeight + spaceBetween * 2);


var spaceBetween = 10;
var swiperThumbnail = new Swiper('.swiper-thumbnail', {
    spaceBetween: spaceBetween,
    slidesPerView: swiperMain.slides.length,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
});
swiperMain.params.thumbs.swiper = swiperThumbnail;
swiperMain.thumbs.init();