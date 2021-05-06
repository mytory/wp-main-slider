<?php
/**
 * @var array $attributes
 * @var array $image_ids
 */

$pagination = get_post_meta( $attributes['id'], '_pagination', true );

$swiper_option = array(
	'loop'       => true,
	'navigation' => [
		'nextEl' => '.swiper-button-next',
		'prevEl' => '.swiper-button-prev',
	],
);

$autoplay = get_post_meta( $attributes['id'], '_autoplay', true );
if ( $autoplay > 0 ) {
	$swiper_option['autoplay'] = [
		'deplay' => $autoplay
	];
}

if ( $pagination == 'none' ) {
	unset( $swiper_option['pagination'] );
} elseif ( in_array( $pagination, [ 'bullets', 'fraction', 'progressbar' ] ) ) {
	$swiper_option['pagination'] = [
		'el'        => '.swiper-pagination',
		'clickable' => true,
		'type'      => $pagination,
	];
} elseif ( $pagination == 'thumbnail' ) {
	$swiper_option['loop'] = false;
}

$image_id_array = explode( ',', $image_ids );
?>
<div class="swiper-container  js-<?php echo $this->postTypeKey ?>">
    <div class="swiper-wrapper">
		<?php foreach ( $image_id_array as $image_id ) {
			$image_post = get_post( $image_id );
			?>
            <div class="swiper-slide">
				<?php if ( $image_post->post_excerpt ) { ?>
                <a href="<?php echo $image_post->post_excerpt ?>">
					<?php } ?>
					<?php if ( function_exists( 'wp_get_attachment_image_srcset' ) ) { ?>
						<?php $image_url = wp_get_attachment_image_url( $image_id, 'full' ); ?>
                        <img src="<?php echo $image_url ?>"
                             srcset="<?php echo wp_get_attachment_image_srcset( $image_id ) ?>" alt="">
                        <link rel="preload" href="<?php echo $image_url ?>" as="image">
					<?php } else { ?>
						<?php $image = wp_get_attachment_image_src( $image_id, 'full' ); ?>
                        <img src="<?php echo $image[0] ?>" alt="">
                        <link rel="preload" href="<?php echo $image[0] ?>" as="image">
					<?php } ?>
					<?php if ( $image_post->post_excerpt ) { ?>
                </a>
			<?php } ?>
            </div>
		<?php } ?>
    </div>

	<?php if ( in_array( $pagination, [ 'bullets', 'fraction', 'progressbar' ] ) ) { ?>
        <div class="swiper-pagination"></div>
	<?php } elseif ( $pagination == 'thumbnail' ) {
		include 'thumbnail.php';
	} elseif ( $pagination == 'text' ) {
		include 'text.php';
	}
	?>

	<?php // navigation buttons ?>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>


<script>
    jQuery(document).ready(function ($) {
        window.swiperMain = new Swiper('.js-<?php echo $this->postTypeKey ?>', <?php echo json_encode( $swiper_option ) ?>);
		<?php
		if ( $pagination == 'thumbnail' ) {
			require 'thumbnail.js'; // 뚝딱...
		}
		if ( in_array( $pagination, array( 'text' ) ) ) {
			require 'text.js'; // 뚝딱...
		} ?>
    });
</script>

