/**
 * Live-update changed settings in real time in the Customizer preview.
 */

( function( $ ) {
	var api = wp.customize;
	api.bind( 'ready', function() {
		"use strict";
		api.section( 'slides', function( section ) {
			section.expanded.bind( function( isExpanding ) {
				api.previewer.send( 'section-highlight', { expanded: isExpanding });
			} );
		} );
	});

} )( jQuery );
