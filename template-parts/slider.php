<?php
/**
 * Template part for Slider
 *
 * @package fesdemo
 */
?>

<?php if( is_front_page() ) :?>

	<!-- Swiper -->
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php foreach ( range( 1, 3 ) as $index ): ?>
				<?php $images = get_theme_mod( 'slide_' . $index, get_parent_theme_file_uri( '/images/' . 'slide_' . $index . '.jpg' ) ); ?>
				<?php if ( $images ): ?>
					<div class="swiper-slide" id="slide_<?php echo esc_attr( $index ); ?>">
						<img src="<?php echo esc_url( $images ); ?>" alt="">
					</div>
				<?php else: ?>
					<div class="swiper-slide" id="slide_<?php echo esc_attr( $index ); ?>" style="display: none"></div>
				<?php endif; ?>

			<?php endforeach; ?>
		</div>
		<!-- Add Pagination -->
		<div class="swiper-pagination"></div>
		<!-- Add Arrows -->
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div>


<?php endif;?>
