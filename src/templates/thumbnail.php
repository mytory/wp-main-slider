<style>
    .swiper-thumbnail {
        height: 100px;
        box-sizing: border-box;
        padding: 10px 0;
    }

    .swiper-thumbnail .swiper-slide {
        height: 100%;
        opacity: 0.4;
        width: 25%!important;
        background-size: cover;
    }

    .swiper-thumbnail .swiper-slide-active {
        opacity: 1;
    }
</style>
<div class="swiper-container swiper-thumbnail">
    <div class="swiper-wrapper">
        <?php foreach ($image_id_array as $image_id) { ?>
            <?php $image = wp_get_attachment_image_src($image_id, 'large'); ?>
            <div class="swiper-slide" style="background-image: url(<?php echo $image[0] ?>)"></div>
        <?php } ?>
    </div>
</div>