<?php

namespace Mytory\MainSlider;

/**
 * Class MainSlider
 */
class MainSlider {
	public $version = '1.0';
	public $postTypeKey = 'mytory_slider';
	public $postTypeLabel = 'Mytory 슬라이더';

	/**
	 * @var bool 테마에서 이미 스와이퍼를 사용하고 있다면 굳이 여기서 임포트하지 않는다.
	 */
	public $importSwiperJs = true;

	public function __construct( $args = [] ) {
		$this->postTypeKey   = $args['postTypeKey'] ?? $this->postTypeKey;
		$this->postTypeLabel = $args['postTypeLabel'] ?? $this->postTypeLabel;

		add_action( 'init', array( $this, 'registerPostType' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );
		add_shortcode( $this->postTypeKey, array( $this, 'shortcode' ) );
		add_action( 'save_post', array( $this, 'save' ), 10, 3 );
		add_action( 'after_setup_theme', [ $this, 'textDomain' ] );
		add_filter( "manage_{$this->postTypeKey}_posts_columns", [ $this, 'postColumns' ] );
		add_action( "manage_{$this->postTypeKey}_posts_custom_column", [ $this, 'postCustomColumn' ], 10, 2 );

		if ( is_admin() ) {
			add_action( 'add_meta_boxes', array( $this, 'addMetaBox' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueueScripts' ) );
			add_action( 'current_screen', array( $this, 'removeUselessYoast' ) );
		}
	}

	public function registerPostType() {
		$labels = array(
			'name'               => _x( 'Sliders', 'post type general name', 'wp-main-slider' ),
			'singular_name'      => _x( 'Slider', 'post type singular name', 'wp-main-slider' ),
			'menu_name'          => _x( $this->postTypeLabel, 'admin menu', 'wp-main-slider' ),
			'name_admin_bar'     => _x( 'Slider', 'add new on admin bar', 'wp-main-slider' ),
			'add_new'            => _x( 'Add New', 'wp-main-slider', 'wp-main-slider' ),
			'add_new_item'       => __( 'Add New Slider', 'wp-main-slider' ),
			'new_item'           => __( 'New Slider', 'wp-main-slider' ),
			'edit_item'          => __( 'Edit Slider', 'wp-main-slider' ),
			'view_item'          => __( 'View Slider', 'wp-main-slider' ),
			'all_items'          => __( 'All Sliders', 'wp-main-slider' ),
			'search_items'       => __( 'Search Sliders', 'wp-main-slider' ),
			'parent_item_colon'  => __( 'Parent Sliders:', 'wp-main-slider' ),
			'not_found'          => __( 'No Sliders found.', 'wp-main-slider' ),
			'not_found_in_trash' => __( 'No Sliders found in Trash.', 'wp-main-slider' )
		);

		$args = array(
			'labels'              => $labels,
			'description'         => __( $this->postTypeLabel, 'wp-main-slider' ),
			'public'              => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'capability_type'     => 'post',
			'supports'            => array( 'title' )
		);
		register_post_type( $this->postTypeKey, $args );
	}

	public function adminEnqueueScripts() {
		wp_enqueue_media();

		$src = get_theme_file_uri( str_replace( get_template_directory(), '',
			realpath( __DIR__ . '/../dist/media.js' ) ) );
		wp_enqueue_script( 'wp-main-slider-media', $src, array( 'jquery' ), $this->version, true );

		$style_src = get_theme_file_uri( str_replace( get_template_directory(), '',
			realpath( __DIR__ . '/../src/mytory-slider.css' ) ) );
		wp_enqueue_style('wp-main-slider', $style_src, [], $this->version);
	}

	public function enqueueScripts() {
		if ( $this->importSwiperJs ) {
			$src = get_theme_file_uri( str_replace( get_template_directory(), '',
				realpath( __DIR__ . '/../dist/swiper.js' ) ) );
			wp_enqueue_script( 'swiper-slider', $src, filemtime( realpath( __DIR__ . '/../dist/swiper.js' ) ), true );
		}
	}

	public function addMetaBox() {
		add_meta_box(
			'wp-main-slider-images',
			__( 'Images', 'wp-main-slider' ),
			function () {
				include 'metabox/images.php';
			},
			$this->postTypeKey
		);

		add_meta_box(
			'wp-main-slider-configuration',
			__( 'Configuration', 'wp-main-slider' ),
			function () {
				include 'include/checked-helper.php';
				include 'metabox/configuration.php';
			},
			$this->postTypeKey
		);
	}


	/** @noinspection PhpUnusedParameterInspection */
	public function save( $post_id, $post, $is_update ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( $post->post_type == $this->postTypeKey ) {
			if ( isset( $_POST["_{$this->postTypeKey}_image_ids"] ) ) {
				update_post_meta( $post_id, "_{$this->postTypeKey}_image_ids",
					sanitize_text_field( $_POST["_{$this->postTypeKey}_image_ids"] ) );
			}
			if ( ! empty( $_POST[ $this->postTypeKey ] ) ) {
				foreach ( $_POST[ $this->postTypeKey ] as $k => $v ) {
					if ( $k === '_mytory_slider_is_main' and $v == '1' ) {
						delete_post_meta_by_key( '_mytory_slider_is_main' );
					}
					update_post_meta( $post_id, $k, $v );
				}
			}
		}
	}

	public function shortcode( $attributes ) {
		$attributes = shortcode_atts( array(
			'id' => '',
		), $attributes );

		/** @var array $image_ids */
		/** @noinspection PhpUnusedLocalVariableInspection */
		$image_ids = get_post_meta( $attributes['id'], "_{$this->postTypeKey}_image_ids", true );
		ob_start();
		include 'templates/basic-slider.php';
		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}

	public function removeYoastMetabox() {
		remove_meta_box( 'wpseo_meta', $this->postTypeKey, 'normal' );
	}

	public function removeYoastCustomColumns( $columns ) {
		$yoast_columns = array(
			'wpseo-score',
			'wpseo-score-readability',
			'wpseo-title',
			'wpseo-metadesc',
			'wpseo-focuskw',
		);
		foreach ( $yoast_columns as $yoast_column ) {
			unset( $columns[ $yoast_column ] );
		}

		return $columns;
	}

	public function removeYoastAction() {
		include 'include/wp-filters-extras.php';
		remove_filters_for_anonymous_class( 'restrict_manage_posts', 'WPSEO_Meta_Columns', 'posts_filter_dropdown',
			10 );
	}

	/**
	 * Useless Yoast Plugin.
	 * Do action after current screen is set.
	 */
	public function removeUselessYoast() {
		$current_screen = get_current_screen();
		if ( $current_screen->post_type == $this->postTypeKey ) {
			add_filter( "manage_{$this->postTypeKey}_posts_columns", array( $this, 'removeYoastCustomColumns' ), 100 );
			add_action( 'restrict_manage_posts', array( $this, 'removeYoastAction' ), 1 );
			add_action( 'add_meta_boxes', array( $this, 'removeYoastMetabox' ), 100 );
		}
	}

	public function textDomain() {
		load_theme_textdomain( 'wp-main-slider', __DIR__ );
	}

	public function postColumns( $columns ): array {
		$columns['is_main'] = __( 'Whether the main', 'wp-main-slider' );

		return $columns;
	}

	public function postCustomColumn( $column_name, $post_id ) {
		switch ( $column_name ) {
			case 'is_main':
				$is_main = get_post_meta( $post_id, '_mytory_slider_is_main', true );
				echo $is_main ? '○' : '<span style="color: #ccc">×</span>';
		}
	}

	public function getMainSliderId() {
		$the_query = new \WP_Query([
			'post_type' => $this->postTypeKey,
			'posts_per_page' => 1,
			'meta_query' => [
				[
					'key' => '_mytory_slider_is_main',
					'value' => '1',
					'compare' => '=',
				]
			]
		]);
		if ($the_query->post_count) {
			return $the_query->posts[0]->ID;
		}
		return null;
	}

	public function getMainSliderCode(): string {
		$id = $this->getMainSliderId();
		if ($id) {
			return do_shortcode("[$this->postTypeKey id=$id]");
		}
		return __('Please set the Main Slider.', 'wp-main-slider');
	}
}
