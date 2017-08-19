<?php
/**
 * giotto Theme Customizer
 *
 * @package Giotto
 */
/* No direct access */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function giottopress_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function giottopress_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function giottopress_customize_preview_js() {
	wp_enqueue_script( 'giottopress_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20170814', true );
}

add_action( 'customize_preview_init', 'giottopress_customize_preview_js' );

/**
 * Add the GET PRO button on the customizer
 */
function giottopress_enqueue_controls_scripts() {
	if ( ! defined( 'GIOTTO_PRO' ) ) {
		wp_enqueue_script( 'giottopress_pro_customizer', trailingslashit( get_template_directory_uri() ) . '/inc/admin/get-pro/customizer-pro.js', array( 'customize-controls' ) );
		wp_enqueue_style( 'giottopress_pro_customizer', trailingslashit( get_template_directory_uri() ) . '/inc/admin/get-pro/customizer-pro.css' );
	}
}

add_action( 'customize_controls_enqueue_scripts', 'giottopress_enqueue_controls_scripts', 0 );

/**
 * Add the theme configuration
 */
GiottoPress_Kirki::add_config( 'giottopress_theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );

/**
 * General Options
 */
GiottoPress_Kirki::add_panel( 'giottopress_panel_general_options', array(
	'title'    => __( 'General Options', 'giottopress' ),
	'priority' => 80,
) );

GiottoPress_Kirki::add_panel( 'giottopress_panel_general_settings', array(
	'title' => __( 'General Settings', 'giottopress' ),
	'panel' => 'giottopress_panel_general_options',
) );

GiottoPress_Kirki::add_section( 'giottopress_section_general_settings', array(
	'title' => __( 'General Settings', 'giottopress' ),
	'panel' => 'giottopress_panel_general_options',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'giottopress_container_type',
	'label'    => __( 'Content Layout Style', 'giottopress' ),
	'section'  => 'giottopress_section_general_settings',
	'default'  => 'boxed',
	'priority' => 10,
	'multiple' => false,
	'choices'  => array(
		'boxed'     => esc_attr__( 'Boxed', 'giottopress' ),
		'wide'      => esc_attr__( 'Wide', 'giottopress' ),
		'fullwidth' => esc_attr__( 'Fullwidth', 'giottopress' ),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'select',
	'settings' => 'giottopress_blog_layout',
	'label'    => __( 'Blog Layout', 'giottopress' ),
	'section'  => 'giottopress_section_general_settings',
	'default'  => 'sidebar',
	'priority' => 10,
	'multiple' => false,
	'choices'  => array(
		'sidebar'      => esc_attr__( 'Content / Sidebar', 'giottopress' ),
		'no-sidebar'   => esc_attr__( 'Content', 'giottopress' ),
		'left-sidebar' => esc_attr__( 'Sidebar / Content', 'giottopress' ),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'select',
	'settings' => 'giottopress_single_layout',
	'label'    => __( 'Single Post Layout', 'giottopress' ),
	'section'  => 'giottopress_section_general_settings',
	'default'  => 'sidebar',
	'priority' => 10,
	'multiple' => false,
	'choices'  => array(
		'sidebar'      => esc_attr__( 'Content / Sidebar', 'giottopress' ),
		'no-sidebar'   => esc_attr__( 'Content', 'giottopress' ),
		'left-sidebar' => esc_attr__( 'Sidebar / Content', 'giottopress' ),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'select',
	'settings' => 'giottopress_page_layout',
	'label'    => __( 'Single Page Layout', 'giottopress' ),
	'section'  => 'giottopress_section_general_settings',
	'default'  => 'sidebar',
	'priority' => 10,
	'multiple' => false,
	'choices'  => array(
		'sidebar'      => esc_attr__( 'Content / Sidebar', 'giottopress' ),
		'no-sidebar'   => esc_attr__( 'Content', 'giottopress' ),
		'left-sidebar' => esc_attr__( 'Sidebar / Content', 'giottopress' ),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'select',
	'settings' => 'giottopress_results_layout',
	'label'    => __( 'Search Result Layout', 'giottopress' ),
	'section'  => 'giottopress_section_general_settings',
	'default'  => 'sidebar',
	'priority' => 10,
	'multiple' => false,
	'choices'  => array(
		'sidebar'      => esc_attr__( 'Content / Sidebar', 'giottopress' ),
		'no-sidebar'   => esc_attr__( 'Content', 'giottopress' ),
		'left-sidebar' => esc_attr__( 'Sidebar / Content', 'giottopress' ),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'select',
	'settings' => 'giottopress_error_layout',
	'label'    => __( '404 Error Layout', 'giottopress' ),
	'section'  => 'giottopress_section_general_settings',
	'default'  => 'no-sidebar',
	'priority' => 10,
	'multiple' => false,
	'choices'  => array(
		'sidebar'      => esc_attr__( 'Content / Sidebar', 'giottopress' ),
		'no-sidebar'   => esc_attr__( 'Content', 'giottopress' ),
		'left-sidebar' => esc_attr__( 'Sidebar / Content', 'giottopress' ),
	),
) );

/**
 * General Styling
 */
GiottoPress_Kirki::add_panel( 'giottopress_panel_general_styles', array(
	'title' => __( 'General Styling', 'giottopress' ),
	'panel' => 'giottopress_panel_general_options',
) );

GiottoPress_Kirki::add_section( 'giottopress_section_general_styles', array(
	'title' => __( 'General Styling', 'giottopress' ),
	'panel' => 'giottopress_panel_general_options',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'custom',
	'settings' => 'custom-separator-styles-i',
	'label'    => '',
	'section'  => 'giottopress_section_general_styles',
	'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __( 'Site Background', 'giottopress' ) . '</div>',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'      => 'color',
	'settings'  => 'giottopress_body_bg',
	'label'     => __( 'Site Background Color', 'giottopress' ),
	'section'   => 'giottopress_section_general_styles',
	'default'   => '#ffffff',
	'transport' => 'postMessage',
	'output'    => array(
		array(
			'element'  => 'body',
			'property' => 'background-color',
			'exclude'  => array( '#ffffff' ),
		),
		array(
			'element'  => 'html',
			'property' => 'background-color',
			'exclude'  => array( '#ffffff' ),
		),
	),
	'choices'   => array(
		'alpha' => true,
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'      => 'color',
	'settings'  => 'giottopress_content_bg',
	'label'     => __( 'Content Background Color', 'giottopress' ),
	'section'   => 'giottopress_section_general_styles',
	'default'   => '#ffffff',
	'transport' => 'postMessage',
	'output'    => array(
		array(
			'element'  => '#page',
			'property' => 'background-color',
		),
	),
	'choices'   => array(
		'alpha' => true,
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'custom',
	'settings' => 'custom-separator-styles-ii',
	'label'    => '',
	'section'  => 'giottopress_section_general_styles',
	'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __( 'Primary Colors', 'giottopress' ) . '</div>',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'color',
	'settings' => 'giottopress_site_primary_color',
	'label'    => __( 'Primary Color', 'giottopress' ),
	'section'  => 'giottopress_section_general_styles',
	'default'  => '#008cdd',
	'output'   => array(
		array(
			'exclude'  => array( '#008cdd' ),
			'element'  => '.button:focus, input[type="submit"]:focus, #comments .comment-body .reply a:focus, .button.is-focused, input.is-focused[type="submit"], #comments .comment-body .reply a.is-focused, .input:focus, input:focus:not([type="submit"]), .input.is-focused, input.is-focused:not([type="submit"]), .input:active, input:active:not([type="submit"]), .input.is-active, input.is-active:not([type="submit"]), .textarea:focus, textarea:focus, .textarea.is-focused, textarea.is-focused, .textarea:active, textarea:active, .textarea.is-active, textarea.is-active, .input.is-primary, input.is-primary:not([type="submit"]), .textarea.is-primary, textarea.is-primary',
			'property' => 'border-color',
		),
		array(
			'exclude'  => array( '#008cdd' ),
			'element'  => '.button.is-primary, input[type="submit"], #comments .comment-body .reply a.is-primary, .button.is-primary[disabled], input[disabled][type="submit"], #comments .comment-body .reply a.is-primary[disabled], .navbar-burger.is-active span',
			'property' => 'background-color',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'color',
	'settings' => 'giottopress_site_primary_color_hover',
	'label'    => __( 'Hover Primary Color', 'giottopress' ),
	'section'  => 'giottopress_section_general_styles',
	'default'  => '#0084d0',
	'output'   => array(
		array(
			'exclude'  => array( '#0084d0' ),
			'element'  => '.button.is-primary:hover, input[type="submit"]:hover, #comments .comment-body .reply a.is-primary:hover, .button.is-primary.is-hovered, input.is-hovered[type="submit"], #comments .comment-body .reply a.is-primary.is-hovered',
			'property' => 'background-color',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'color',
	'settings' => 'giottopress_site_border_color',
	'label'    => __( 'Main Border Color', 'giottopress' ),
	'section'  => 'giottopress_section_general_styles',
	'default'  => '#eaecee',
	'output'   => array(
		array(
			'exclude'  => array( '#eaecee' ),
			'element'  => '#primary #main .hentry, .single #primary #main .hentry, #comments .comment-reply-title, #comments li.comment.depth-1, #comments .comments-title, #comments .comment-body footer .comment-author img, #comments .comment-content',
			'property' => 'border-color',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'custom',
	'settings' => 'custom-separator-styles-iii',
	'label'    => '',
	'section'  => 'giottopress_section_general_styles',
	'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __( 'Links Color', 'giottopress' ) . '</div>',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'color',
	'settings' => 'giottopress_site_content_link_color',
	'label'    => __( 'Color', 'giottopress' ),
	'section'  => 'giottopress_section_general_styles',
	'default'  => '#008cdd',
	'output'   => array(
		array(
			'exclude'  => array( '#008cdd' ),
			'element'  => 'a, .help.is-primary, .tagcloud a.help, .main-title a:hover, .content .entry-title a:hover, #comments .comment-body footer .comment-author a:hover, #comments .comment-body footer .comment-metadata a:hover, .widget a:hover
',
			'property' => 'color',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'color',
	'settings' => 'giottopress_site_content_link_hover_color',
	'label'    => __( 'Color:Hover', 'giottopress' ),
	'section'  => 'giottopress_section_general_styles',
	'default'  => '#4c555a',
	'output'   => array(
		array(
			'exclude'  => array( '#4c555a' ),
			'element'  => 'a:hover',
			'property' => 'color',
		),
	),
) );

GiottoPress_Kirki::add_panel( 'giottopress_panel_general_typography', array(
	'title' => __( 'General Typography', 'giottopress' ),
	'panel' => 'giottopress_panel_general_options',
) );

GiottoPress_Kirki::add_section( 'giottopress_section_general_typography', array(
	'title'    => __( 'General Typography', 'giottopress' ),
	'priority' => 80,
	'panel'    => 'giottopress_panel_general_options',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'typography',
	'settings' => 'giottopress_site_main_typography',
	'label'    => esc_attr__( 'Body Typography', 'giottopress' ),
	'section'  => 'giottopress_section_general_typography',
	'default'  => array(
		'font-family' => 'Roboto',
		'font-size'   => '16px',
		'variant'     => 'regular',
		'subsets'     => array( 'latin-ext' ),
	),
	'output'   => array(
		array(
			'element' => 'body',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'typography',
	'settings' => 'giottopress_site_heading_typography',
	'label'    => esc_attr__( 'Heading Typography', 'giottopress' ),
	'section'  => 'giottopress_section_general_typography',
	'default'  => array(
		'font-family' => 'Roboto',
		'variant'     => 'regular',
		'subsets'     => array( 'latin-ext' ),
	),
	'output'   => array(
		array(
			'element' => 'h1, h2, h3, h4, h5, h6, .content h1,.content h2,.content h3,.content h4,.content h5,.content h6, .content .entry-title a, h1.page-title, .page-title',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'color',
	'settings' => 'giottopress_site_text_color',
	'label'    => __( 'Site Text Color', 'giottopress' ),
	'section'  => 'giottopress_section_general_typography',
	'default'  => '#4c555a',
	'output'   => array(
		array(
			'element'  => 'body, .main-title a, .content .entry-title a, #comments .comment-body footer .comment-author a, #comments .comment-body footer .comment-metadata a, .widget a, strong, pre, table th, .button.is-link, input.is-link[type="submit"], #comments .comment-body .reply a.is-link,.tag, .tagcloud a, .content h1,.content h2,.content h3,.content h4,.content h5,.content h6, label, .posts-pagination .pagination .page-numbers, .content .entry-title a,#primary #main .hentry .more-tag.button, #primary #main .hentry input.more-tag[type="submit"], #primary #main .hentry #comments .comment-body .reply a.more-tag, #comments .comment-body .reply #primary #main .hentry a.more-tag, #comments .comment-body footer .comment-author a, #comments .comment-body footer .comment-metadata a, .widget a, h1.page-title, .page-title, .widget-title',
			'property' => 'color',
		),
	),
) );

/**
 * Header
 */
GiottoPress_Kirki::add_section( 'giottopress_section_header_general', array(
	'title'    => __( 'Header', 'giottopress' ),
	'priority' => 80,
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'custom',
	'settings' => 'custom-separator-header-iii',
	'label'    => '',
	'section'  => 'giottopress_section_header_general',
	'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __( 'Layout', 'giottopress' ) . '</div>',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'select',
	'settings'        => 'giottopress_header_contained_type',
	'label'           => __( 'Header Width', 'giottopress' ),
	'section'         => 'giottopress_section_header_general',
	'default'         => 'fullwidth',
	'priority'        => 10,
	'multiple'        => false,
	'transport'       => 'postMessage',
	'choices'         => array(
		'fullwidth' => esc_attr__( 'Fullwidth', 'giottopress' ),
		'contained' => esc_attr__( 'Contained', 'giottopress' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_header_general_style',
			'operator' => '==',
			'value'    => 'minimal',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'      => 'select',
	'settings'  => 'giottopress_header_inner_contained_type',
	'label'     => __( 'Header Inner Width', 'giottopress' ),
	'section'   => 'giottopress_section_header_general',
	'default'   => 'contained',
	'priority'  => 10,
	'multiple'  => false,
	'transport' => 'postMessage',
	'choices'   => array(
		'fullwidth' => esc_attr__( 'Fullwidth', 'giottopress' ),
		'contained' => esc_attr__( 'Contained', 'giottopress' ),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'custom',
	'settings' => 'custom-separator-header-iv',
	'label'    => '',
	'section'  => 'giottopress_section_header_general',
	'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __( 'Style', 'giottopress' ) . '</div>',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'select',
	'settings' => 'giottopress_header_general_style',
	'label'    => __( 'Header Style', 'giottopress' ),
	'section'  => 'giottopress_section_header_general',
	'default'  => 'minimal',
	'priority' => 10,
	'multiple' => false,
	'choices'  => array(
		'minimal'     => esc_attr__( 'Minimal', 'giottopress' ),
		'transparent' => esc_attr__( 'Transparent (Over Content)', 'giottopress' ),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'custom',
	'settings' => 'custom-separator-header-v',
	'label'    => '',
	'section'  => 'giottopress_section_header_general',
	'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __( 'Menu', 'giottopress' ) . '</div>',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'select',
	'settings' => 'giottopress_menu_style',
	'label'    => __( 'Menu Position', 'giottopress' ),
	'section'  => 'giottopress_section_header_general',
	'multiple' => false,
	'default'  => 'left',
	'choices'  => array(
		'left'   => esc_attr__( 'Menu on Right', 'giottopress' ),
		'center' => esc_attr__( 'Menu on bottom', 'giottopress' ),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'select',
	'settings'        => 'giottopress_navbar_alignment',
	'label'           => __( 'Navigation  Alignment', 'giottopress' ),
	'section'         => 'giottopress_section_header_general',
	'default'         => 'right',
	'multiple'        => false,
	'choices'         => array(
		'right' => esc_attr__( 'Right', 'giottopress' ),
		'left'  => esc_attr__( 'Left', 'giottopress' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_menu_style',
			'operator' => '==',
			'value'    => 'left',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'custom',
	'settings'        => 'custom-separator-header-vi',
	'label'           => '',
	'section'         => 'giottopress_section_header_general',
	'default'         => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __( 'Height', 'giottopress' ) . '</div>',
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_header_general_style',
			'operator' => '==',
			'value'    => 'minimal',
		),
		array(
			'setting'  => 'giottopress_menu_style',
			'operator' => '==',
			'value'    => 'left',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'slider',
	'settings'        => 'giottopress_header_height',
	'label'           => __( 'Header Height (em) ', 'giottopress' ),
	'section'         => 'giottopress_section_header_general',
	'default'         => '4',
	'priority'        => 10,
	'transport'       => 'postMessage',
	'output'          => array(
		array(
			'exclude'  => array( '4' ),
			'element'  => '#masthead .navbar, #masthead .navbar-brand',
			'property' => 'height',
			'units'    => 'em',
		),
		array(
			'exclude'  => array( '4' ),
			'element'  => '#masthead .navbar-brand .navbar-burger',
			'property' => 'height',
			'units'    => 'em',
		),
	),
	'choices'         => array(
		'min'  => 3.25,
		'max'  => 10,
		'step' => .25,
	),
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_header_general_style',
			'operator' => '==',
			'value'    => 'minimal',
		),
		array(
			'setting'  => 'giottopress_menu_style',
			'operator' => '==',
			'value'    => 'left',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'slider',
	'settings'        => 'giottopress_header_logo_height',
	'label'           => __( 'Logo Height (em) ', 'giottopress' ),
	'section'         => 'giottopress_section_header_general',
	'default'         => '3.5',
	'priority'        => 10,
	'transport'       => 'postMessage',
	'output'          => array(
		array(
			'exclude'  => array( '3.5' ),
			'element'  => '#masthead .navbar-brand .navbar-item img',
			'property' => 'height',
			'units'    => 'em',
		),
		array(
			'exclude'  => array( '2.5' ),
			'element'  => '#masthead .navbar-brand .navbar-item img',
			'property' => 'max-height',
			'units'    => 'em',
		),

	),
	'choices'         => array(
		'min'  => 1.75,
		'max'  => 6,
		'step' => .25,
	),
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_header_general_style',
			'operator' => '==',
			'value'    => 'minimal',
		),
		array(
			'setting'  => 'giottopress_menu_style',
			'operator' => '==',
			'value'    => 'left',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'custom',
	'settings' => 'custom-separator-header-vii',
	'label'    => '',
	'section'  => 'giottopress_section_header_general',
	'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __( 'BG Color & Border', 'giottopress' ) . '</div>',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'color',
	'settings'        => 'giottopress_header_bg_color',
	'label'           => __( 'Header Background Color ', 'giottopress' ),
	'section'         => 'giottopress_section_header_general',
	'default'         => '#ffffff',
	'transport'       => 'postMessage',
	'priority'        => 10,
	'output'          => array(
		'element'  => 'body.header-minimal header#masthead',
		'property' => 'background-color',
	),
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_header_general_style',
			'operator' => '==',
			'value'    => 'minimal',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'slider',
	'settings'        => 'giottopress_header_border_bottom_height',
	'label'           => __( 'Header Border Bottom Height ', 'giottopress' ),
	'section'         => 'giottopress_section_header_general',
	'default'         => '1',
	'priority'        => 10,
	'transport'       => 'postMessage',
	'output'          => array(
		array(
			'exclude'  => array( '1' ),
			'element'  => 'header#masthead',
			'property' => 'border-bottom-width',
			'units'    => 'px',
		),
	),
	'choices'         => array(
		'min'  => 0,
		'max'  => 5,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_header_general_style',
			'operator' => '==',
			'value'    => 'minimal',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'color',
	'settings'        => 'giottopress_header_border_bottom_color',
	'label'           => __( 'Header Border Bottom Color ', 'giottopress' ),
	'section'         => 'giottopress_section_header_general',
	'default'         => '#eaecee',
	'priority'        => 10,
	'transport'       => 'postMessage',
	'output'          => array(
		'exclude'  => array( '#eaecee' ),
		'element'  => 'header#masthead',
		'property' => 'border-bottom-color',
	),
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_header_general_style',
			'operator' => '==',
			'value'    => 'minimal',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'slider',
	'settings'        => 'giottopress_transparent_top_content_padding',
	'label'           => __( 'Content Page Padding ', 'giottopress' ),
	'section'         => 'giottopress_section_header_general',
	'default'         => '90',
	'transport'       => 'postMessage',
	'output'          => array(
		'element'  => '#page',
		'property' => 'padding-top',
		'units'    => 'px',
	),
	'choices'         => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_header_general_style',
			'operator' => '==',
			'value'    => 'transparent',
		),
	),
) );

/**
 * Primary Menu
 */
GiottoPress_Kirki::add_section( 'giottopress_section_primary_menu', array(
	'title'    => __( 'Primary Menu', 'giottopress' ),
	'priority' => 90,
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'custom',
	'settings' => 'custom-separator-menu-links',
	'label'    => '',
	'section'  => 'giottopress_section_primary_menu',
	'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __( 'Links', 'giottopress' ) . '</div>',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'      => 'color',
	'settings'  => 'giottopress_primary_menu_color',
	'label'     => __( 'Link Color', 'giottopress' ),
	'section'   => 'giottopress_section_primary_menu',
	'default'   => '#6b7c93',
	'transport' => 'postMessage',
	'output'    => array(
		array(
			'exclude'  => array( '#6b7c93' ),
			'element'  => '.header-minimal #masthead .navbar .menu-item:not(.is-active)',
			'property' => 'color',
		),
		array(
			'exclude'  => array( '#6b7c93' ),
			'element'  => '.header-transparent #masthead .navbar .menu-item:not(.is-active)',
			'property' => 'color',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'      => 'color',
	'settings'  => 'giottopress_primary_menu_current_color',
	'label'     => __( 'Current Link Color', 'giottopress' ),
	'section'   => 'giottopress_section_primary_menu',
	'default'   => '#008cdd',
	'transport' => 'postMessage',
	'output'    => array(
		array(
			'exclude'  => array( '#008cdd' ),
			'element'  => '.header-minimal #masthead .navbar .menu-item.is-active',
			'property' => 'color',
		),
		array(
			'exclude'  => array( '#008cdd' ),
			'element'  => '.header-trasparent #masthead .navbar .menu-item.is-active',
			'property' => 'color',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'custom',
	'settings' => 'custom-separator-menu-links-hover',
	'label'    => '',
	'section'  => 'giottopress_section_primary_menu',
	'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __( 'Hover', 'giottopress' ) . '</div>',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'color',
	'settings' => 'giottopress_primary_menu_over_bg',
	'label'    => __( 'Background Color', 'giottopress' ),
	'section'  => 'giottopress_section_primary_menu',
	'default'  => '#e7e9ec',
	'output'   => array(
		array(
			'exclude'  => array( '#e7e9ec' ),
			'element'  => '.header-minimal #masthead .navbar .menu-item:hover, .navbar-item.has-dropdown:hover > .navbar-link,
.navbar-item.has-dropdown.is-active > .navbar-link, .header-transparent #masthead .navbar .menu-item:hover, .navbar-item.has-dropdown:hover .navbar-item.has-dropdown:hover',
			'property' => 'background-color',
		),
	),
	'choices'  => array(
		'alpha' => true,
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'color',
	'settings' => 'giottopress_primary_menu_over_color',
	'label'    => __( 'Link Color', 'giottopress' ),
	'section'  => 'giottopress_section_primary_menu',
	'default'  => '#555555',
	'output'   => array(
		array(
			'exclude'  => array( '#555555' ),
			'element'  => '.header-minimal #masthead .navbar .menu-item:hover, .header-transparent #masthead .navbar .menu-item.is-active',
			'property' => 'color',
		),
		array(
			'exclude'  => array(),
			'element'  => '.navbar-item.has-dropdown:hover, .navbar-item.has-dropdown:hover > .navbar-item ',
			'property' => 'color',
			'suffix'   => ' !important',
		),
	),
	'choices'  => array(
		'alpha' => true,
	),
) );

/**
 * Page Title
 */
GiottoPress_Kirki::add_section( 'giottopress_section_page_title', array(
	'title'    => __( 'Page Title', 'giottopress' ),
	'priority' => 90,
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'select',
	'settings' => 'giottopress_page_title_type',
	'label'    => __( 'Page Title Visibility', 'giottopress' ),
	'section'  => 'giottopress_section_page_title',
	'default'  => 'content-inline',
	'choices'  => array(
		'content-inline' => esc_attr__( 'In Content', 'giottopress' ),
		'header-bottom'  => esc_attr__( 'Below Header', 'giottopress' ),
		'hidden'         => esc_attr__( 'Hidden', 'giottopress' ),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'custom',
	'settings'        => 'custom-separator-page-title-i',
	'label'           => '',
	'section'         => 'giottopress_section_page_title',
	'default'         => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __( 'Layout', 'giottopress' ) . '</div>',
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_page_title_type',
			'operator' => '==',
			'value'    => 'header-bottom',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'select',
	'settings'        => 'giottopress_page_title_contained_type',
	'label'           => __( 'Page Title Width', 'giottopress' ),
	'section'         => 'giottopress_section_page_title',
	'default'         => 'fullwidth',
	'multiple'        => false,
	'choices'         => array(
		'fullwidth' => esc_attr__( 'Fullwidth', 'giottopress' ),
		'contained' => esc_attr__( 'Contained', 'giottopress' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_page_title_type',
			'operator' => '==',
			'value'    => 'header-bottom',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'select',
	'settings'        => 'giottopress_page_title_inner_contained_type',
	'label'           => __( 'Page Title Inner Width', 'giottopress' ),
	'section'         => 'giottopress_section_page_title',
	'default'         => 'contained',
	'multiple'        => false,
	'choices'         => array(
		'fullwidth' => esc_attr__( 'Fullwidth', 'giottopress' ),
		'contained' => esc_attr__( 'Contained', 'giottopress' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_page_title_type',
			'operator' => '==',
			'value'    => 'header-bottom',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'custom',
	'settings'        => 'custom-separator-page-title-ii',
	'label'           => '',
	'section'         => 'giottopress_section_page_title',
	'default'         => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __( 'Titles', 'giottopress' ) . '</div>',
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_page_title_type',
			'operator' => '==',
			'value'    => 'header-bottom',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'text',
	'settings'        => 'giottopress_page_title_front_page',
	'label'           => __( 'Blog Home Page Title', 'giottopress' ),
	'description'     => __( 'This label will be displayed on the Blog Home Page.', 'giottopress' ),
	'section'         => 'giottopress_section_page_title',
	'default'         => esc_attr__( 'Latest Posts', 'giottopress' ),
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_page_title_type',
			'operator' => '==',
			'value'    => 'header-bottom',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'text',
	'settings'        => 'giottopress_page_title_blog',
	'label'           => __( 'Blog Title', 'giottopress' ),
	'section'         => 'giottopress_section_page_title',
	'description'     => __( 'This label will be displayed on the blog single posts', 'giottopress' ),
	'default'         => esc_attr__( 'Blog', 'giottopress' ),
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_page_title_type',
			'operator' => '==',
			'value'    => 'header-bottom',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'custom',
	'settings'        => 'custom-page-title-info',
	'label'           => '',
	'section'         => 'giottopress_section_page_title',
	'default'         => '<br/><div class="customize-section-title" style="padding:10px 20px;"><strong>' . __( 'The In-Content page title are visible only on the archives, search results page and single pages.', 'giottopress' ) . '</strong></div>',
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_page_title_type',
			'operator' => '==',
			'value'    => 'content-inline',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'custom',
	'settings'        => 'custom-page-title-info-ii',
	'label'           => '',
	'section'         => 'giottopress_section_page_title',
	'default'         => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __( 'Colors', 'giottopress' ) . '</div>',
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_page_title_type',
			'operator' => '==',
			'value'    => 'header-bottom',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'color',
	'settings'        => 'giottopress_header_page_title_color',
	'label'           => __( 'Title Color', 'giottopress' ),
	'section'         => 'giottopress_section_page_title',
	'default'         => '#6B7C96',
	'transport'       => 'postMessage',
	'output'          => array(
		'element'  => 'section.page-header .page-title',
		'property' => 'color',
		'exclude'  => array( '#6B7C96' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_page_title_type',
			'operator' => '==',
			'value'    => 'header-bottom',
		),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'            => 'color',
	'settings'        => 'giottopress_header_page_title_bg',
	'label'           => __( 'Background Color', 'giottopress' ),
	'section'         => 'giottopress_section_page_title',
	'default'         => '#F8F8F8',
	'transport'       => 'postMessage',
	'output'          => array(
		'element'  => 'section.page-header',
		'property' => 'background-color',
		'exclude'  => array( '#F8F8F8' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'giottopress_page_title_type',
			'operator' => '==',
			'value'    => 'header-bottom',
		),
	),
) );

/**
 * Blog
 */
GiottoPress_Kirki::add_panel( 'giottopress_panel_blog', array(
	'title'    => __( 'Blog', 'giottopress' ),
	'priority' => 95,
) );

GiottoPress_Kirki::add_panel( 'giottopress_panel_blog_entries', array(
	'title'    => __( 'Blog', 'giottopress' ),
	'priority' => 95,
) );

GiottoPress_Kirki::add_section( 'giottopress_section_blog', array(
	'title' => __( 'Blog Entries', 'giottopress' ),
	'panel' => 'giottopress_panel_blog_entries',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'giottopress_blog_entries_content',
	'label'    => __( 'Blog Post Content', 'giottopress' ),
	'section'  => 'giottopress_section_blog',
	'default'  => 'full',
	'choices'  => array(
		'full'    => esc_attr__( 'Show Full Post', 'giottopress' ),
		'excerpt' => esc_attr__( 'Show Excerpt', 'giottopress' ),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'giottopress_blog_entry_featured',
	'label'    => __( 'Blog Post Feature Image', 'giottopress' ),
	'section'  => 'giottopress_section_blog',
	'default'  => 'hide',
	'choices'  => array(
		'show' => esc_attr__( 'Show Image', 'giottopress' ),
		'hide' => esc_attr__( 'Hide Image', 'giottopress' ),
	),
) );

/**
 * Footer
 */

GiottoPress_Kirki::add_panel( 'giottopress_panel_footer', array(
	'title'    => __( 'Footer', 'giottopress' ),
	'priority' => 96,
) );

GiottoPress_Kirki::add_panel( 'giottopress_panel_footer_layout', array(
	'title' => __( 'Layout', 'giottopress' ),
	'panel' => 'giottopress_panel_footer',
) );

GiottoPress_Kirki::add_section( 'giottopress_section_footer', array(
	'title' => __( 'Layout', 'giottopress' ),
	'panel' => 'giottopress_panel_footer',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'      => 'select',
	'settings'  => 'giottopress_footer_contained_type',
	'label'     => __( 'Footer Width', 'giottopress' ),
	'section'   => 'giottopress_section_footer',
	'default'   => 'fullwidth',
	'multiple'  => false,
	'transport' => 'postMessage',
	'choices'   => array(
		'fullwidth' => esc_attr__( 'Fullwidth', 'giottopress' ),
		'contained' => esc_attr__( 'Contained', 'giottopress' ),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'      => 'select',
	'settings'  => 'giottopress_footer_inner_contained_type',
	'label'     => __( 'Footer Inner Width', 'giottopress' ),
	'section'   => 'giottopress_section_footer',
	'default'   => 'contained',
	'multiple'  => false,
	'transport' => 'postMessage',
	'choices'   => array(
		'fullwidth' => esc_attr__( 'Fullwidth', 'giottopress' ),
		'contained' => esc_attr__( 'Contained', 'giottopress' ),
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'      => 'color',
	'settings'  => 'giottopress_footer_bg_color',
	'label'     => __( 'Footer Background Color ', 'giottopress' ),
	'section'   => 'giottopress_section_footer',
	'default'   => '#ffffff',
	'transport' => 'postMessage',
	'output'    => array(
		'exclude'  => array( '#ffffff' ),
		'element'  => '#site-footer',
		'property' => 'background-color',
	),
	'choices'   => array(
		'alpha' => true,
	),
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'spacing',
	'settings' => 'giottopress_footer_spacing',
	'label'    => __( 'Footer Spacing', 'giottopress' ),
	'section'  => 'giottopress_section_footer',
	'default'  => array(
		'top'    => '1em',
		'bottom' => '1em',
		'left'   => '0',
		'right'  => '0',
	),
	'output'   => array(
		'element'  => '#site-footer',
		'property' => 'padding',
	),
) );

GiottoPress_Kirki::add_panel( 'giottopress_panel_footer_widgets', array(
	'title' => __( 'Widgets', 'giottopress' ),
	'panel' => 'giottopress_panel_footer',
) );

GiottoPress_Kirki::add_section( 'giottopress_section_footer_widgets', array(
	'title' => __( 'Widgets', 'giottopress' ),
	'panel' => 'giottopress_panel_footer',
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'slider',
	'settings' => 'giottopress_footer_sidebars',
	'label'    => __( 'Footer Widget Areas ', 'giottopress' ),
	'section'  => 'giottopress_section_footer_widgets',
	'default'  => 0,
	'choices'  => array(
		'min'  => 0,
		'max'  => 5,
		'step' => 1,
	),
) );

for ( $i = 1; $i < 6; $i ++ ) {

	GiottoPress_Kirki::add_field( 'giottopress_theme', array(
		'type'            => 'custom',
		'settings'        => sprintf( 'custom-separator-footer-%s', $i ),
		'label'           => '',
		'section'         => 'giottopress_section_footer_widgets',
		/* translators: 1: Footer Number */
		'default'         => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . sprintf( __( 'Footer %s', 'giottopress' ), $i ) . '</div>',
		'active_callback' => array(
			array(
				'setting'  => 'giottopress_footer_sidebars',
				'operator' => '>=',
				'value'    => $i,
			),
		),
	) );

	GiottoPress_Kirki::add_field( 'giottopress_theme', array(
		'type'            => 'slider',
		'settings'        => sprintf( 'footer-column-width-%s', $i ),
		'label'           => __( 'Columns', 'giottopress' ),
		'section'         => 'giottopress_section_footer_widgets',
		'description'     => __( 'How many columns in the row should the widget area use? Max 12', 'giottopress' ),
		'default'         => 3,
		'choices'         => array(
			'min'  => '1',
			'max'  => '12',
			'step' => '1',
		),
		'active_callback' => array(
			array(
				'setting'  => 'giottopress_footer_sidebars',
				'operator' => '>=',
				'value'    => $i,
			),
		),
	) );

	GiottoPress_Kirki::add_field( 'giottopress_theme', array(
		'type'            => 'text',
		'settings'        => sprintf( 'footer-custom-class-%s', $i ),
		'label'           => __( 'Custom Classes', 'giottopress' ),
		'section'         => 'giottopress_section_footer_widgets',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'giottopress_footer_sidebars',
				'operator' => '>=',
				'value'    => $i,
			),
		),
	) );
}// End for().

/**
 * Site Identity
 */

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'checkbox',
	'settings' => 'giottopress_hide_title',
	'label'    => __( 'Hide Title', 'giottopress' ),
	'section'  => 'title_tagline',
	'default'  => false,
	'priority' => 11,
) );

GiottoPress_Kirki::add_field( 'giottopress_theme', array(
	'type'     => 'checkbox',
	'settings' => 'giottopress_hide_tagline',
	'label'    => __( 'Hide Tagline', 'giottopress' ),
	'section'  => 'title_tagline',
	'default'  => false,
	'priority' => 20,
) );
