(function( $ ) {
	$( function() {
		window.slider = new Swiper( '.swiper-container', {
			pagination: '.swiper-pagination',
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
			simulateTouch: false,
			slidesPerView: 'auto',
			centeredSlides: true,
		} );
	} )
})( jQuery );
