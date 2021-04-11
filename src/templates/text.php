<style>
    .mytory-slider-buttons {
        text-align: center;
        padding-top: .5em;
    }
    .mytory-slider-button {
        background-color: white;
        color: black;
        border: 1px solid #ddd;
    }
    .mytory-slider-button--active {
        background-color: #ccc;
        color: white;
    }
</style>
<div class="js-mytory-slider-buttons  mytory-slider-buttons">
    <?php foreach ($image_id_array as $i => $image_id) { ?>
        <?php $image = get_post($image_id); ?>
        <button class="mytory-slider-button <?php echo (($i === 0) ? 'mytory-slider-button--active' : '') ?>">
            <?php echo $image->post_title ?>
        </button>
    <?php } ?>
</div>
