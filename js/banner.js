(function( $ ) {
	$( function() {
		window.slider = new Swiper( '.swiper-container', {
			pagination: '.swiper-pagination',
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
			simulateTouch: false,
			slidesPerView: 1,
			centeredSlides: false,
		} );
	} )
})( jQuery );
