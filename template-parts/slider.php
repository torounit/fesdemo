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
				$id = 'slide_' . $index; ?>
				<div  id="<?php echo esc_attr( $id ); ?>">
					<?php my_banner_render( null, $id );?>
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

<?php foreach ( range( 1, 3 ) as $index ): ?>
	<?php
	$id = 'slide_' . $index; ?>
	<div  id="<?php echo esc_attr( $id ); ?>">
		<?php my_banner_render( null, $id );?>
	</div>
<?php endforeach; ?>
