<?php
/**
 * @var array $image_id_array
 */
?>
<style>
    .swiper-thumbnail {
        height: 100px;
        box-sizing: border-box;
        padding: 10px 0;
    }

    .swiper-thumbnail .swiper-slide {
        opacity: 0.4;
        background-size: cover;
    }

    .swiper-thumbnail .swiper-slide-thumb-active {
        opacity: 1;
    }
</style>
<div class="swiper-container swiper-thumbnail" style="width: <?php echo count($image_id_array) * 100 ?>px">
    <div class="swiper-wrapper">
        <?php foreach ($image_id_array as $i => $image_id) { ?>
            <?php $image = wp_get_attachment_image_src($image_id); ?>
            <div class="swiper-slide  <?= $i === 0 ? 'swiper-slide-thumb-active': '' ?>" style="background-image: url(<?php echo $image[0] ?>)"></div>
        <?php } ?>
    </div>
</div>