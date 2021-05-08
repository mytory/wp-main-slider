<?php
/**
 * @var array $image_id_array
 */
?>
<style>
    .mytory-slider-buttons {
        text-align: center;
        position: absolute;
        bottom: .5rem;
        width: 100%;
        z-index: 2;
    }
    .mytory-slider-button {
        background-color: rgba(255, 255, 255, 0.7);
        padding: 5px .5em;
        border: none;
        -webkit-appearance: none;
        color: black;
        cursor: pointer;
        border-radius: 5px;
        font-size: 0.9rem;
    }
    .mytory-slider-button--active {
        background-color: rgba(0, 0, 0, 0.7);
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
