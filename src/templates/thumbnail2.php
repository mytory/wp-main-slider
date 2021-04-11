<style>
	.mytory-slider-image-buttons {
		text-align: center;
		padding-top: .5em;
		font-size: 0;
		line-height: 1;
	}
	.mytory-slider-image-button {
		background-color: transparent;
		border: 0;
		opacity: 0.6;
		padding: 0;
		font-size: 1rem;
	}
	.mytory-slider-image-button img {
		display: block;
	}
	.mytory-slider-image-button--active {
		background-color: #ccc;
		opacity: 1;
	}
</style>
<div class="js-mytory-slider-image-buttons  mytory-slider-image-buttons">
	<?php foreach ($image_id_array as $i => $image_id) { ?>
		<button class="mytory-slider-image-button <?php echo (($i === 0) ? 'mytory-slider-image-button--active' : '') ?>"
			style="width: <?= 100/count($image_id_array) ?>%">
			<?= wp_get_attachment_image($image_id) ?>
		</button>
	<?php } ?>
</div>
