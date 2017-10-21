/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	var api = wp.customize;
	api.bind( 'preview-ready', function() {
		"use strict";
		api.selectiveRefresh.bind( 'partial-content-rendered', function( partical ) {

			if( partical.addedContent ) {
				partical.container.show();
			}
			else  {
				partical.container.hide();
			}

			window.slide.update();
			window.slide.slideTo(0);
		} )
	});


} )( jQuery );
