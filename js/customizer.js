/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	// Primary color.
	wp.customize( 'everbox_primary_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to || '' == to || false == to ) {
				$( '.post-meta .author' ).css( {
					'color': "#3782E7"
				} );
				$( '.site-header' ).css( {
					'background': "#3782E7",
					'border-color': "#2979e5"
				} );
				$( '.site-search-area .searchform #s' ).css( {
					'border-color': "#1a6cdb"
				} );
				$( '.filter-button.active a' ).css( {
					'color': "#3782E7"
				});
				$( '.pagination .current' ).css( {
					'background': "#3782E7",
					'border-color': "#3782E7"
				});
				$( '.post-meta.category-links a' ).hover(function() {
					$(this).css({
						'background-color': "#3782E7"
					});
				}, function() {
					$(this).css({
						'background-color': "#eee"
					});
				});
			} else {
				$( '.post-meta .author' ).css( {
					'color': to
				} );
				$( '.site-header' ).css( {
					'background': to,
					'border-color': "#999"
				} );
				$( '.site-search-area .searchform #s' ).css( {
					'border-color': "rgba(0,0,0,.5)"
				} );
				$( '.filter-button.active a' ).css( {
					'color': to
				});
				$( '.pagination .current' ).css( {
					'background': to,
					'border-color': to
				});
				$( '.post-meta.category-links a' ).hover(function() {
					$(this).css({
						'background-color': to
					});
				}, function() {
					$(this).css({
						'background-color': "#eee"
					});
				});
			}
		} );
	} );
} )( jQuery );
