<?php
/**
 * giotto Theme Customizer
 *
 * @package giotto
 */
/* No direct access */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function giotto_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'giotto_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'giotto_customize_partial_blogdescription',
		) );
	}
}

//add_action( 'customize_register', 'giotto_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function giotto_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function giotto_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function giotto_customize_preview_js() {
	wp_enqueue_script( 'giotto_customizer', get_template_directory_uri() . '/js/customizer-min.js', array( 'customize-preview' ), '20170712', true );
}

add_action( 'customize_preview_init', 'giotto_customize_preview_js' );

function giotto_remove_default_panels( $wp_customize ) {
	$wp_customize->remove_control( 'header_image' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
}

add_action( 'customize_register', 'giotto_remove_default_panels' );


/**
 * Add the theme configuration
 */
Giotto_Kirki::add_config( 'giotto_theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );


/**
 * 1) Layout Panel
 */
Giotto_Kirki::add_panel( 'giotto_panel_layout', array(
	'title'    => __( 'Layout', 'giottopress' ),
	'priority' => 80,
) );

/**
 * Layout -> Header
 */
Giotto_Kirki::add_panel( 'giotto_panel_header', array(
	'title' => __( 'Header', 'giottopress' ),
	'panel' => 'giotto_panel_layout',
) );

Giotto_Kirki::add_section( 'giotto_section_header', array(
	'title' => __( 'Header', 'giottopress' ),
	'panel' => 'giotto_panel_layout'
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'      => 'select',
	'settings'  => 'giotto_header_contained_type',
	'label'     => __( 'Header Width', 'giottopress' ),
	'section'   => 'giotto_section_header',
	'default'   => 'fullwidth',
	'priority'  => 10,
	'multiple'  => false,
	'transport' => 'postMessage',
	'choices'   => array(
		'fullwidth' => esc_attr__( 'Fullwidth', 'giottopress' ),
		'contained' => esc_attr__( 'Contained', 'giottopress' ),
	),
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'      => 'select',
	'settings'  => 'giotto_header_inner_contained_type',
	'label'     => __( 'Header Inner Width', 'giottopress' ),
	'section'   => 'giotto_section_header',
	'default'   => 'fullwidth',
	'priority'  => 10,
	'multiple'  => false,
	'transport' => 'postMessage',
	'choices'   => array(
		'fullwidth' => esc_attr__( 'Fullwidth', 'giottopress' ),
		'contained' => esc_attr__( 'Contained', 'giottopress' ),
	),
) );


/**
 * Layout -> Content Width
 */
Giotto_Kirki::add_panel( 'giotto_panel_container', array(
	'title' => __( 'Content', 'giottopress' ),
	'panel' => 'giotto_panel_layout',
) );

Giotto_Kirki::add_section( 'giotto_section_container', array(
	'title' => __( 'Content', 'giottopress' ),
	'panel' => 'giotto_panel_layout'
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'     => 'select',
	'settings' => 'giotto_container_type',
	'label'    => __( 'Content Width', 'giottopress' ),
	'section'  => 'giotto_section_container',
	'default'  => 'fullwidth',
	'priority' => 10,
	'multiple' => false,
	'choices'  => array(
		'fullwidth' => esc_attr__( 'Full Width', 'giottopress' ),
		'boxed'     => esc_attr__( 'Boxed', 'giottopress' ),
	),
) );

/**
 * Layout -> Sidebar
 */
Giotto_Kirki::add_panel( 'giotto_panel_sidebar', array(
	'title' => __( 'Sidebar', 'giottopress' ),
	'panel' => 'giotto_panel_layout',
) );

Giotto_Kirki::add_section( 'giotto_section_sidebar', array(
	'title' => __( 'Sidebar', 'giottopress' ),
	'panel' => 'giotto_panel_layout'
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'     => 'select',
	'settings' => 'giotto_sidebar_layout',
	'label'    => __( 'Sidebar Layout', 'giottopress' ),
	'section'  => 'giotto_section_sidebar',
	'default'  => 'sidebar',
	'priority' => 10,
	'multiple' => false,
	'choices'  => array(
		'sidebar'      => esc_attr__( 'Content / Sidebar', 'giottopress' ),
		'no-sidebar'   => esc_attr__( 'Content', 'giottopress' ),
		'left-sidebar' => esc_attr__( 'Sidebar / Content', 'giottopress' ),
	),
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'     => 'select',
	'settings' => 'giotto_blog_layout',
	'label'    => __( 'Blog Layout', 'giottopress' ),
	'section'  => 'giotto_section_sidebar',
	'default'  => 'sidebar',
	'priority' => 10,
	'multiple' => false,
	'choices'  => array(
		'sidebar'      => esc_attr__( 'Content / Sidebar', 'giottopress' ),
		'no-sidebar'   => esc_attr__( 'Content', 'giottopress' ),
		'left-sidebar' => esc_attr__( 'Sidebar / Content', 'giottopress' ),
	),
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'     => 'select',
	'settings' => 'giotto_single_layout',
	'label'    => __( 'Single Post/Page Layout', 'giottopress' ),
	'section'  => 'giotto_section_sidebar',
	'default'  => 'sidebar',
	'priority' => 10,
	'multiple' => false,
	'choices'  => array(
		'sidebar'      => esc_attr__( 'Content / Sidebar', 'giottopress' ),
		'no-sidebar'   => esc_attr__( 'Content', 'giottopress' ),
		'left-sidebar' => esc_attr__( 'Sidebar / Content', 'giottopress' ),
	),
) );

/**
 * 2) Header
 */
Giotto_Kirki::add_panel( 'giotto_panel_header', array(
	'title'    => __( 'Header', 'giottopress' ),
	'priority' => 90,
) );

/**
 * 2.1 Header - General
 */
Giotto_Kirki::add_panel( 'giotto_panel_header_general', array(
	'title' => __( 'General', 'giottopress' ),
	'panel' => 'giotto_panel_header',
) );

Giotto_Kirki::add_section( 'giotto_section_header_general', array(
	'title' => __( 'General', 'giottopress' ),
	'panel' => 'giotto_panel_header'
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'     => 'select',
	'settings' => 'giotto_header_general_style',
	'label'    => __( 'Header Style', 'giottopress' ),
	'section'  => 'giotto_section_header_general',
	'default'  => 'minimal',
	'priority' => 10,
	'multiple' => false,
	'choices'  => array(
		'minimal'     => esc_attr__( 'Minimal', 'giottopress' ),
		'transparent' => esc_attr__( 'Transparent (Over Content)', 'giottopress' ),
	),
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'      => 'slider',
	'settings'  => 'giotto_header_height',
	'label'     => __( 'Header Height (em) ', 'giottopress' ),
	'section'   => 'giotto_section_header_general',
	'default'   => '3.25',
	'priority'  => 10,
	'transport' => 'postMessage',
	'output'    => array(
		array(
			'element'  => '#masthead .navbar, #masthead .navbar-brand',
			'property' => 'height',
			'units'    => 'em',
		),
		array(
			'element'  => '#masthead .navbar-brand .navbar-burger',
			'property' => 'height',
			'units'    => 'em',
		)
	),
	'choices'   => array(
		'min'  => 3.25,
		'max'  => 6,
		'step' => .25
	),
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'      => 'slider',
	'settings'  => 'giotto_header_logo_height',
	'label'     => __( 'Logo Height (em) ', 'giottopress' ),
	'section'   => 'giotto_section_header_general',
	'default'   => '1.75',
	'priority'  => 10,
	'transport' => 'postMessage',
	'output'    => array(
		array(
			'element'  => '#masthead .navbar-brand .navbar-item img',
			'property' => 'height',
			'units'    => 'em',
		),
		array(
			'element'  => '#masthead .navbar-brand .navbar-item img',
			'property' => 'max-height',
			'units'    => 'em',
		),

	),
	'choices'   => array(
		'min'  => 1.75,
		'max'  => 6,
		'step' => .25
	),
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'      => 'color',
	'settings'  => 'giotto_header_bg_color',
	'label'     => __( 'Background Color ', 'giottopress' ),
	'section'   => 'giotto_section_header_general',
	'default'   => '#ffffff',
	'transport' => 'postMessage',
	'priority'  => 10,
	'output'    => array(
		'element'  => 'header#masthead',
		'property' => 'background-color'
	),
	'choices'   => array(
		'alpha' => true,
	),
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'      => 'slider',
	'settings'  => 'giotto_header_border_bottom_height',
	'label'     => __( 'Border Bottom Height ', 'giottopress' ),
	'section'   => 'giotto_section_header_general',
	'default'   => '0',
	'priority'  => 10,
	'transport' => 'postMessage',
	'output'    => array(
		array(
			'element'  => 'header#masthead',
			'property' => 'border-bottom-width',
			'units'    => 'px',
		)
	),
	'choices'   => array(
		'min'  => 0,
		'max'  => 5,
		'step' => 1
	),
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'      => 'color',
	'settings'  => 'giotto_header_border_bottom_color',
	'label'     => __( 'Border Bottom Color ', 'giottopress' ),
	'section'   => 'giotto_section_header_general',
	'default'   => '#ffffff',
	'priority'  => 10,
	'transport' => 'postMessage',
	'output'    => array(
		'element'  => 'header#masthead',
		'property' => 'border-bottom-color'
	),
	'choices'   => array(
		'alpha' => true,
	),
) );

/**
 * 2.1
 */
Giotto_Kirki::add_panel( 'giotto_panel_header_nav', array(
	'title' => __( 'Primary Navigation', 'giottopress' ),
	'panel' => 'giotto_panel_header',
) );

Giotto_Kirki::add_section( 'giotto_section_header_nav', array(
	'title' => __( 'Primary Navigation', 'giottopress' ),
	'panel' => 'giotto_panel_header'
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'     => 'select',
	'settings' => 'giotto_navbar_alignment',
	'label'    => __( 'Navigation  Alignment', 'giottopress' ),
	'section'  => 'giotto_section_header_nav',
	'multiple' => false,
	'choices'  => array(
		'right' => esc_attr__( 'Right', 'giottopress' ),
		'left'  => esc_attr__( 'Left', 'giottopress' ),
	),
) );

/**
 * 3 Content
 */
//Giotto_Kirki::add_panel( 'giotto_panel_site_colors', array(
//	'title'    => __( 'Site Colors', 'giottopress' ),
//	'priority' => 90,
//) );

Giotto_Kirki::add_section( 'giotto_section_site_colors', array(
	'title'    => __( 'Site Colors', 'giottopress' ),
	'priority' => 90
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'      => 'color',
	'settings'  => 'giotto_body_bg',
	'label'     => __( 'Background Color', 'giottopress' ),
	'section'   => 'giotto_section_site_colors',
	'default'   => '#F5F7F9',
	'transport' => 'postMessage',
	'output'    => array(
		array(
			'element'  => 'body',
			'property' => 'background-color'
		),
		array(
			'element'  => 'html',
			'property' => 'background-color'
		)
	),
	'choices'   => array(
		'alpha' => true,
	),
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'      => 'color',
	'settings'  => 'giotto_content_bg',
	'label'     => __( 'Page Content Background Color', 'giottopress' ),
	'section'   => 'giotto_section_site_colors',
	'default'   => '#F5F7F9',
	'transport' => 'postMessage',
	'output'    => array(
		array(
			'element'  => '#page',
			'property' => 'background-color'
		)
	),
	'choices'   => array(
		'alpha' => true,
	),
) );


/**
 * Site Identity
 */

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'     => 'checkbox',
	'settings' => 'giotto_hide_title',
	'label'    => __( 'Hide Title', 'giottopress' ),
	'section'  => 'title_tagline',
	'default'  => false,
	'priority' => 11,
) );

Giotto_Kirki::add_field( 'giotto_theme', array(
	'type'     => 'checkbox',
	'settings' => 'giotto_hide_tagline',
	'label'    => __( 'Hide Tagline', 'giottopress' ),
	'section'  => 'title_tagline',
	'default'  => false,
	'priority' => 20,
) );

//Giotto_Kirki::add_field( 'giotto_theme', array(
//	'type'     => 'cropped_image',
//	'settings' => 'giotto_logo',
//	'label'    => __( 'Logo', 'giottopress' ),
//	'section'  => 'title_tagline',
//	'default'  => '',
//	'priority' => 30,
//	'width' => '200',
//	'height' => '100',
//) );
