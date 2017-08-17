jQuery( document ).ready( function () {

	/* Tabs in welcome page */
	function giottopress_welcome_page_tabs( event ) {
		jQuery( event ).parent().addClass( "active" );
		jQuery( event ).parent().siblings().removeClass( "active" );
		var tab = jQuery( event ).attr( "href" );
		jQuery( ".giottopress-tab-pane" ).not( tab ).css( "display", "none" );
		jQuery( tab ).fadeIn();
	}

	var giottopress_actions_anchor = location.hash;

	if ( ( typeof giottopress_actions_anchor !== 'undefined' ) && ( giottopress_actions_anchor != '' ) ) {
		giottopress_welcome_page_tabs( 'a[href="' + giottopress_actions_anchor + '"]' );
	}

	jQuery( ".giottopress-nav-tabs a" ).click( function ( event ) {
		event.preventDefault();
		giottopress_welcome_page_tabs( this );
	} );

	/* Tab Content height matches admin menu height for scrolling purpouses */
	$tab = jQuery( '.giottopress-tab-content > div' );
	$admin_menu_height = jQuery( '#adminmenu' ).height();
	if ( ( typeof $tab !== 'undefined' ) && ( typeof $admin_menu_height !== 'undefined' ) ) {
		$newheight = $admin_menu_height - 200;
		$tab.css( 'min-height', $newheight );
	}
} );
