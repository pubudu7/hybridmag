/* global wp, jQuery */
/**
 * File customizer.js.
 *
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
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a, .site-description' ).css( {
					color: to,
				} );
			}
		} );
	} );

	wp.customize( 'hybridmag_container_width', function( value ) {
		value.bind( function( to ) {
			if( ( 'blank' !== to ) && ( to >= 300 ) && (to <= 2000 ) ) {
				$( '.hm-container' ).css( {
					'width': to + 'px'
				} );
			}
		} )
	} );

	wp.customize( 'hybridmag_boxed_width', function( value ) {
		value.bind( function( to ) {
			if( ( 'blank' !== to ) && ( to >= 300 ) && (to <= 2000 ) ) {
				$( 'body.hm-boxed #page' ).css( {
					'width': to + 'px'
				} );
			}
		} )
	} );

	// Menu height.
	wp.customize( 'hybridmag_pmenu_line_height', function( value ) {
		value.bind( function( to ) {
			if( ( 'blank' !== to ) && ( to >= 20 ) && ( to <= 300 ) ) {
				$( '.hm-h-lg .main-navigation ul li a' ).css( {
					'line-height': to + 'px',
				} );
				$( '.hm-h-lg .hm-main-menu .hm-social-menu li a' ).css( {
					'height': to + 'px',
				} );
				$( '.hm-h-lg #hm-search-toggle' ).css( {
					'height': to + 'px',
				} );
				$( '.hm-h-lg .hm-main-menu .hm-slideout-toggle' ).css( {
					'height': to + 'px',
				} );
				$( '.hm-h-lg .main-navigation ul ul li a' ).css( {
					'line-height': 'initial',
				} );
			}
		} );
	} ); 

	// Menu height.
	wp.customize( 'hybridmag_header_height', function( value ) {
		value.bind( function( to ) {
			if( to && ( to >= 30 ) && ( to <= 600 ) ) {
				$( '.hm-h-de .hm-header-inner' ).css( {
					'min-height': to + 'px',
				} );
			} else {
				$( '.hm-h-de .hm-header-inner' ).css( {
					'min-height': 'inherit',
				} );
			}
		} );
	} ); 

}( jQuery ) );
