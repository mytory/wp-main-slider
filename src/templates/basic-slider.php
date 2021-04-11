<?php
$swiper_option = array(
	'loop'                => true,
	'pagination'          => '.swiper-pagination',
	'paginationClickable' => true,
	'nextButton'          => '.swiper-button-next',
	'prevButton'          => '.swiper-button-prev',
);

$autoplay = get_post_meta( $attributes['id'], '_autoplay', true );
if ( $autoplay > 0 ) {
	$swiper_option['autoplay'] = $autoplay;
}

$pagination = get_post_meta( $attributes['id'], '_pagination', true );
if ( $pagination == 'none' ) {
	unset( $swiper_option['pagination'] );
}
if ( $pagination == 'thumbnail' ) {
	$swiper_option['loop'] = false;
}

$image_id_array = explode( ',', $image_ids );
?>
<style>
    .swiper-container {
        width: 600px;
        height: 300px;
    }
</style>
<div class="swiper-container  js-main-slider">
    <div class="swiper-wrapper">
		<?php foreach ( $image_id_array as $image_id ) {
			$image_post = get_post( $image_id );
			?>
            <div class="swiper-slide">
				<?php if ( $image_post->post_excerpt ) { ?>
                <a href="<?php echo $image_post->post_excerpt ?>">
					<?php } ?>
					<?php if ( function_exists( 'wp_get_attachment_image_srcset' ) ) { ?>
						<?php $image_url = wp_get_attachment_image_url( $image_id, 'large' ); ?>
                        <img src="<?php echo $image_url ?>"
                             srcset="<?php echo wp_get_attachment_image_srcset( $image_id ) ?>" alt="">
                        <link rel="preload" href="<?php echo $image_url ?>" as="image">
					<?php } else { ?>
						<?php $image = wp_get_attachment_image_src( $image_id, 'large' ); ?>
                        <img src="<?php echo $image[0] ?>" alt="">
                        <link rel="preload" href="<?php echo $image[0] ?>" as="image">
					<?php } ?>
					<?php if ( $image_post->post_excerpt ) { ?>
                </a>
			<?php } ?>
            </div>
		<?php } ?>
    </div>

    <div class="swiper-pagination"></div>

	<?php // navigation buttons ?>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>

