<?php
/***
 * @package    TGM-Plugin-Activation
 * @version    2.6.1 for parent theme GiottoPress for publication on WordPress.org
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/* No direct access */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'giottopress_register_required_plugins' );


/**
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function giottopress_register_required_plugins() {

	$plugins = array(
		array(
			'name'     => 'Kirki',
			'slug'     => 'kirki',
			'required' => false,
		)
	);

	$config = array(
		'id'           => 'giottopress',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}