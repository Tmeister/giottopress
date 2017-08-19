'use strict';

/* global wp */

(
	function ( $ ) {
		'use strict';

		wp.customize( 'giottopress_header_contained_type', function ( value ) {
			value.bind( function ( to ) {
				var $header = $( 'header#masthead' );

				if ( 'fullwidth' === to ) {
					$header.addClass( 'is-fluid is-marginless' );
				}

				if ( 'contained' === to ) {
					$header.removeClass( 'is-fluid is-marginless' );
				}
			} );
		} );

		wp.customize( 'giottopress_header_inner_contained_type', function ( value ) {
			value.bind( function ( to ) {
				var $header_inner = $( '.header-inner' );

				if ( 'fullwidth' === to ) {
					$header_inner.addClass( 'is-fluid' );
				}

				if ( 'contained' === to ) {
					$header_inner.removeClass( 'is-fluid' );
				}
			} );
		} );

		wp.customize( 'giottopress_header_bg_color', function ( value ) {
			value.bind( function ( to ) {
				var $header = $( 'header#masthead' );
				$header.css( {
					'background-color': to
				} );
			} );
		} );

		wp.customize( 'giottopress_header_border_bottom_color', function ( value ) {
			value.bind( function ( to ) {
				var $header = $( 'header#masthead' );
				$header.css( {
					'border-bottom-color': to
				} );
			} );
		} );

		wp.customize( 'giottopress_header_border_bottom_height', function ( value ) {
			value.bind( function ( to ) {
				var $header = $( 'header#masthead' );
				$header.css( {
					'border-bottom-width': to + 'px'
				} );
			} );
		} );

		wp.customize( 'giottopress_header_height', function ( value ) {
			value.bind( function ( to ) {
				var $header = $( '#masthead .navbar, #masthead .navbar-brand' );
				$header.height( to + 'em' );
			} );
		} );

		wp.customize( 'giottopress_header_logo_height', function ( value ) {
			value.bind( function ( to ) {
				var $logo = $( '#masthead .navbar-brand .navbar-item img' );
				var $burger = $( '#masthead .navbar-brand .navbar-burger' );
				$logo.css( {
					'height': to + 'em',
					'max-height': to + 'em'
				} );
				$burger.css( {
					'height': to + 'em'
				} );
			} );
		} );

		wp.customize( 'giottopress_body_bg', function ( value ) {
			value.bind( function ( to ) {
				var $body = $( 'body, html' );
				$body.css( {
					'background-color': to
				} );
			} );
		} );

		wp.customize( 'giottopress_content_bg', function ( value ) {
			value.bind( function ( to ) {
				var $content = $( '#page' );
				$content.css( {
					'background-color': to
				} );
			} );
		} );

		wp.customize( 'giottopress_transparent_top_content_padding', function ( value ) {
			value.bind( function ( to ) {
				var $page = $( '#page' );
				$page.css( {
					'padding-top': to + 'px'
				} );
			} );
		} );

		wp.customize( 'giottopress_primary_menu_color', function ( value ) {
			value.bind( function ( to ) {
				var $links = $( '.header-minimal #masthead .navbar .menu-item:not(.is-active), .header-transparent #masthead .navbar .menu-item:not(.is-active)' );
				$links.css( {'color': to} );
			} );
		} );

		wp.customize( 'giottopress_primary_menu_current_color', function ( value ) {
			value.bind( function ( to ) {
				var $links = $( '.header-minimal #masthead .navbar .menu-item.is-active, .header-transparent #masthead .navbar .menu-item.is-active' );
				$links.css( {'color': to} );
			} );
		} );

		wp.customize( 'giottopress_primary_menu_sub_color', function ( value ) {
			value.bind( function ( to ) {
				var $links = $( '.header-minimal #masthead .navbar .navbar-dropdown .menu-item, .header-transparent #masthead .navbar .navbar-dropdown .menu-item' );
				$links.css( {'color': to} );
			} );
		} );

		wp.customize( 'giottopress_header_page_title_color', function ( value ) {
			value.bind( function ( to ) {
				var $links = $( 'section.page-header .page-title' );
				$links.css( {'color': to} );
			} );
		} );

		wp.customize( 'giottopress_header_page_title_bg', function ( value ) {
			value.bind( function ( to ) {
				var $links = $( 'section.page-header' );
				$links.css( {'background-color': to} );
			} );
		} );

		wp.customize( 'giottopress_footer_contained_type', function ( value ) {
			value.bind( function ( to ) {
				var $header = $( '#site-footer' );

				if ( 'fullwidth' === to ) {
					$header.addClass( 'is-fluid is-marginless' );
				}

				if ( 'contained' === to ) {
					$header.removeClass( 'is-fluid is-marginless' );
				}
			} );
		} );

		wp.customize( 'giottopress_footer_inner_contained_type', function ( value ) {
			value.bind( function ( to ) {
				var $header_inner = $( '.footer-inner' );

				if ( 'fullwidth' === to ) {
					$header_inner.addClass( 'is-fluid' );
				}

				if ( 'contained' === to ) {
					$header_inner.removeClass( 'is-fluid' );
				}
			} );
		} );

		wp.customize( 'giottopress_footer_bg_color', function ( value ) {
			value.bind( function ( to ) {
				var $header = $( '#site-footer' );
				$header.css( {
					'background-color': to
				} );
			} );
		} );
	}
)( jQuery );
