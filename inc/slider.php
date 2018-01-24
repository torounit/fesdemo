<?php
/**
 * Sample for custom banner.
 */

/**
 * Add assets for customizer.
 */
function fesdemo_banner_scripts() {
	wp_enqueue_style( 'fesdemo-swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css' );
	wp_enqueue_script( 'fesdemo-swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.jquery.js', array( 'jquery' ), '3.4.2', true );
	wp_enqueue_script( 'fesdemo-banner', get_template_directory_uri() . '/js/banner.js', array( 'fesdemo-swiper' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'fesdemo_banner_scripts' );

/**
 * Banner count.
 *
 * @return int
 */
function fesdemo_banner_count() {
	return 3;
}

/**
 * Customizer Setting for Banner.
 *
 * @param WP_Customize_Manager $wp_customize
 */
function my_banner_customize_register( WP_Customize_Manager $wp_customize ) {

	$wp_customize->add_panel( 'banners', array(
		'title' => 'Banners',
		'priority' => 140,
	) );

	foreach ( range( 1, 3 ) as $index ) {

		$id = 'banner_' . $index;

		/**
		 * Add setting section.
		 */
		$wp_customize->add_section( $id, array(
			'title' => sprintf( 'Banner %s', $index ),
			'panel' => 'banners',
		) );

		/**
		 * Set default value for customizer.
		 */
		$wp_customize->add_setting( $id, array(
			'default'   => get_parent_theme_file_uri( '/images/' . $id . '.jpg'  ),
			'sanitize_callback' => 'esc_url',
			'transport' => 'postMessage',
		) );

		/**
		 * For Selective refresh.
		 */
		$wp_customize->selective_refresh->add_partial( $id, array(
			'selector'            => '#'.$id,
			'render_callback'     => 'my_banner_render',
		) );

		/**
		 * Control form setting.
		 */
		$control = new WP_Customize_Image_Control( $wp_customize, $id, array(
				'label'          => 'Upload an Image',
				'section'        => $id,
//				'width'          => 1920,
//				'height'         => 1080,
			)
		);
		$wp_customize->add_control( $control );

	}
}

add_action( 'customize_register', 'my_banner_customize_register' );

/**
 * Banner markup for customizer preview.
 *
 * @param WP_Customize_Partial $partial
 * @param string $id
 */
function my_banner_render(  $partial = null, $id = '' ) {
	if( isset( $partial->id ) ) {
		$image = get_theme_mod( $partial->id );
	}
	else {
		$image = get_theme_mod( $id );
	}
	if ( $image ): ?>
		<img src="<?php echo esc_url( $image ); ?>" alt="">
	<?php
	endif;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fesdemo_banner_customize_preview_js() {
	wp_enqueue_script( 'fesdemo-banner-customizer', get_template_directory_uri() . '/js/banner-customizer.js', array(
		'customize-preview',
		'fesdemo-banner'
	), false, true );
}

add_action( 'customize_preview_init', 'fesdemo_banner_customize_preview_js' );
