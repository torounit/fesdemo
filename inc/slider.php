<?php

/**
 * @param WP_Customize_Manager $wp_customize
 */
function fesdemo_slider_customize_register( WP_Customize_Manager $wp_customize ) {

	$wp_customize->add_panel( 'slides', array(
		'title' => __( 'Slides' ),
	) );

	foreach ( range( 1, 3 ) as $index ) {

		/**
		 * Set default value for customizer.
		 */
		$wp_customize->add_setting( 'slide_' . $index, array(
			'default'   => get_parent_theme_file_uri( '/images/' . $index . '.jpg'  ),
			'transport' => 'postMessage',
		) );

		$wp_customize->selective_refresh->add_partial( 'slide_' . $index, array(
			'selector'            => '#slide_' . $index,
			'container_inclusive' => true,
			'render_callback'     => 'fesdemo_slider_render',
			'fallback_refresh'    => false,
		) );

		$wp_customize->add_section( 'slide_' . $index, array(
			'title' => sprintf( __( 'Slide %s' ), $index ),
			'panel' => 'slides',
		) );

		$control = new WP_Customize_Control( $wp_customize, 'slide_' . $index, array(
				'label'          => __( 'Upload an Image' ),
				'allow_addition' => true,
				'section'        => 'slide_' . $index,
//				'width'          => 1920,
//				'height'         => 1080,
			)
		);
		$wp_customize->add_control( $control );

	}
}

add_action( 'customize_register', 'fesdemo_slider_customize_register' );

/**
 * Get Theme Option.
 *
 * @param WP_Customize_Partial|int $partial
 *
 * @return string
 */
function fesdemo_slider_get_slide( $partial = 0 ) {
	$id = null;
	if ( $partial instanceof WP_Customize_Control ) {
		$id = $partial->id;
	} elseif ( is_integer( $partial ) ) {
		$id = 'slide_' . $partial;
	}

	if ( $id ) {
		return get_theme_mod( $id, get_parent_theme_file_uri( '/images/' . $id . '.jpg' ) );
	}

	return false;
}

function fesdemo_slider_scripts() {

	wp_enqueue_style( 'fesdemo-swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css' );
	wp_enqueue_script( 'fesdemo-swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.jquery.js', array( 'jquery' ), '3.4.2', true );
	wp_enqueue_script( 'fesdemo-slider', get_template_directory_uri() . '/js/slider.js', array( 'fesdemo-swiper' ), false, true );
}

add_action( 'wp_enqueue_scripts', 'fesdemo_slider_scripts' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fesdemo_slider_customize_preview_js() {
	wp_enqueue_script( 'fesdemo-customizer', get_template_directory_uri() . '/js/slider-customizer.js', array(
		'customize-preview',
		'fesdemo-slider'
	), false, true );
}

add_action( 'customize_preview_init', 'fesdemo_slider_customize_preview_js' );
