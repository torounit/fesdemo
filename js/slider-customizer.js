/**
 * File: slider-customizer.js
 *
 * update slider in customizer preview.
 */

(function( $ ) {
	"use strict";
	let api = wp.customize;

	api.bind( 'preview-ready', function() {
		api.selectiveRefresh.bind( 'partial-content-rendered', function( partical ) {
			let index = 0;
			if (partical.addedContent) {
				partical.container.show();
				index = $( window.slider.slides ).index( partical.container );
			}
			else {
				partical.container.hide();
			}
			window.slider.update();
			window.slider.slideTo( index );
		} )
	} );


})( jQuery );
