<style>
    .wp-main-slider-buttons {
        text-align: center;
        padding-top: .5em;
    }
    .wp-main-slider-button {
        background-color: white;
        color: black;
        border: 1px solid #ddd;
    }
    .wp-main-slider-button--active {
        background-color: #ccc;
        color: white;
    }
</style>
<div class="js-wp-main-slider-buttons  wp-main-slider-buttons">
    <?php foreach ($image_id_array as $i => $image_id) { ?>
        <?php $image = get_post($image_id); ?>
        <button class="wp-main-slider-button <?php echo (($i === 0) ? 'wp-main-slider-button--active' : '') ?>">
            <?php echo $image->post_title ?>
        </button>
    <?php } ?>
</div>
