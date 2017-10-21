<?php
/**
 * Sample for custom slider.
 */

/**
 * Add assets for customizer.
 */
function fesdemo_slider_scripts() {
	wp_enqueue_style( 'fesdemo-swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css' );
	wp_enqueue_script( 'fesdemo-swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.jquery.js', array( 'jquery' ), '3.4.2', true );
	wp_enqueue_script( 'fesdemo-slider', get_template_directory_uri() . '/js/slider.js', array( 'fesdemo-swiper' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'fesdemo_slider_scripts' );

/**
 * Slide count.
 *
 * @return int
 */
function fesdemo_slider_count() {
	return 3;
}

/**
 * Customizer Setting for Slider.
 *
 * @param WP_Customize_Manager $wp_customize
 */
function fesdemo_slider_customize_register( WP_Customize_Manager $wp_customize ) {

	$wp_customize->add_panel( 'slides', array(
		'title' => __( 'Slides' ),
	) );

	foreach ( range( 1, fesdemo_slider_count() ) as $index ) {

		$id = 'slide_' . $index;

		/**
		 * Add setting section.
		 */
		$wp_customize->add_section( $id, array(
			'title' => sprintf( __( 'Slide %s' ), $index ),
			'panel' => 'slides',
		) );

		/**
		 * Set default value for customizer.
		 */
		$wp_customize->add_setting( $id, array(
			'default'   => get_parent_theme_file_uri( '/images/' . $id . '.jpg'  ),
			'transport' => 'postMessage',
		) );

		/**
		 * For Selective refresh.
		 */
		$wp_customize->selective_refresh->add_partial( $id, array(
			'selector'            => '#'.$id,
			'render_callback'     => 'fesdemo_slider_render',
		) );

		/**
		 * Control form setting.
		 */
		$control = new WP_Customize_Image_Control( $wp_customize, $id, array(
				'label'          => __( 'Upload an Image' ),
				'section'        => $id,
				'active_callback' => 'is_front_page',
//				'width'          => 1920,
//				'height'         => 1080,
			)
		);
		$wp_customize->add_control( $control );

	}
}

add_action( 'customize_register', 'fesdemo_slider_customize_register' );

/**
 * Slider markup for customizer preview.
 *
 * @param WP_Customize_Partial $partial
 */
function fesdemo_slider_render( WP_Customize_Partial $partial ) {
	$image = get_theme_mod( $partial->id );
	if ( $image ): ?>
		<img src="<?php echo esc_url( $image ); ?>" alt="">
	<?php
	endif;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fesdemo_slider_customize_preview_js() {
	wp_enqueue_script( 'fesdemo-slider-customizer', get_template_directory_uri() . '/js/slider-customizer.js', array(
		'customize-preview',
		'fesdemo-slider'
	), false, true );
}

add_action( 'customize_preview_init', 'fesdemo_slider_customize_preview_js' );
