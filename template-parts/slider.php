<?php
/**
 * Template part for Slider
 *
 * @package fesdemo
 */
?>

<?php if ( is_front_page() ) : ?>

	<!-- Swiper -->
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php foreach ( range( 1, 3 ) as $index ): ?>
				<?php
				$id = 'slide_' . $index;
				$image = get_theme_mod( $id, get_parent_theme_file_uri( '/images/' . $id. '.jpg' ) ); ?>
				<div class="swiper-slide" id="<?php echo esc_attr( $id ); ?>" <?php if ( ! $image ) : ?> style="display: none" <?php endif; ?>>
					<?php if ( $image ): ?>
						<img src="<?php echo esc_url( $image ); ?>" alt="">
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
		<!-- Add Pagination -->
		<div class="swiper-pagination"></div>
		<!-- Add Arrows -->
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div>


<?php endif; ?>
