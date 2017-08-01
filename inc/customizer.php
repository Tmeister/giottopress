<?php
/**
 * giotto Theme Customizer
 *
 * @package giotto
 */
/* No direct access */
if ( ! defined('ABSPATH')) {
    exit;
}
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function giotto_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'giotto_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'giotto_customize_partial_blogdescription',
        ));
    }
}

//add_action( 'customize_register', 'giotto_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function giotto_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function giotto_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function giotto_customize_preview_js()
{
    wp_enqueue_script('giotto_customizer', get_template_directory_uri() . '/js/customizer-min.js', array('customize-preview'), '20170712', true);
}

add_action('customize_preview_init', 'giotto_customize_preview_js');

function giotto_remove_default_panels($wp_customize)
{
    $wp_customize->remove_control('header_image');
    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');
}

add_action('customize_register', 'giotto_remove_default_panels');


/**
 * Add the theme configuration
 */
Giotto_Kirki::add_config('giotto_theme', array(
    'option_type' => 'theme_mod',
    'capability'  => 'edit_theme_options',
));

/**
 * 1) General Options
 */
Giotto_Kirki::add_panel('giotto_panel_general_options', array(
    'title'    => __('General Options', 'giottopress'),
    'priority' => 80,
));

Giotto_Kirki::add_panel('giotto_panel_general_settings', array(
    'title' => __('General Settings', 'giottopress'),
    'panel' => 'giotto_panel_general_options',
));

Giotto_Kirki::add_section('giotto_section_general_settings', array(
    'title' => __('General Settings', 'giottopress'),
    'panel' => 'giotto_panel_general_options',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'giotto_container_type',
    'label'    => __('Layout Style', 'giottopress'),
    'section'  => 'giotto_section_general_settings',
    'default'  => 'boxed',
    'priority' => 10,
    'multiple' => false,
    'choices'  => array(
        'boxed'     => esc_attr__('Boxed', 'giottopress'),
        'wide'      => esc_attr__('Wide', 'giottopress'),
        'fullwidth' => esc_attr__('Fullwidth', 'giottopress'),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'select',
    'settings' => 'giotto_blog_layout',
    'label'    => __('Blog Layout', 'giottopress'),
    'section'  => 'giotto_section_general_settings',
    'default'  => 'sidebar',
    'priority' => 10,
    'multiple' => false,
    'choices'  => array(
        'sidebar'      => esc_attr__('Content / Sidebar', 'giottopress'),
        'no-sidebar'   => esc_attr__('Content', 'giottopress'),
        'left-sidebar' => esc_attr__('Sidebar / Content', 'giottopress'),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'select',
    'settings' => 'giotto_single_layout',
    'label'    => __('Single Post Layout', 'giottopress'),
    'section'  => 'giotto_section_general_settings',
    'default'  => 'sidebar',
    'priority' => 10,
    'multiple' => false,
    'choices'  => array(
        'sidebar'      => esc_attr__('Content / Sidebar', 'giottopress'),
        'no-sidebar'   => esc_attr__('Content', 'giottopress'),
        'left-sidebar' => esc_attr__('Sidebar / Content', 'giottopress'),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'select',
    'settings' => 'giotto_page_layout',
    'label'    => __('Single Page Layout', 'giottopress'),
    'section'  => 'giotto_section_general_settings',
    'default'  => 'sidebar',
    'priority' => 10,
    'multiple' => false,
    'choices'  => array(
        'sidebar'      => esc_attr__('Content / Sidebar', 'giottopress'),
        'no-sidebar'   => esc_attr__('Content', 'giottopress'),
        'left-sidebar' => esc_attr__('Sidebar / Content', 'giottopress'),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'select',
    'settings' => 'giotto_results_layout',
    'label'    => __('Search Result Layout', 'giottopress'),
    'section'  => 'giotto_section_general_settings',
    'default'  => 'sidebar',
    'priority' => 10,
    'multiple' => false,
    'choices'  => array(
        'sidebar'      => esc_attr__('Content / Sidebar', 'giottopress'),
        'no-sidebar'   => esc_attr__('Content', 'giottopress'),
        'left-sidebar' => esc_attr__('Sidebar / Content', 'giottopress'),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'select',
    'settings' => 'giotto_error_layout',
    'label'    => __('404 Error Layout', 'giottopress'),
    'section'  => 'giotto_section_general_settings',
    'default'  => 'no-sidebar',
    'priority' => 10,
    'multiple' => false,
    'choices'  => array(
        'sidebar'      => esc_attr__('Content / Sidebar', 'giottopress'),
        'no-sidebar'   => esc_attr__('Content', 'giottopress'),
        'left-sidebar' => esc_attr__('Sidebar / Content', 'giottopress'),
    ),
));


Giotto_Kirki::add_panel('giotto_panel_general_styling', array(
    'title' => __('General Styling', 'giottopress'),
    'panel' => 'giotto_panel_general_options',
));

Giotto_Kirki::add_section('giotto_section_general_styling', array(
    'title'    => __('General Styling', 'giottopress'),
    'priority' => 80,
    'panel'    => 'giotto_panel_general_options',
));

//Giotto_Kirki::add_field('giotto_theme', array(
//    'type'     => 'radio-buttonset',
//    'settings' => 'giotto_container_type',
//    'label'    => __('Layout Style', 'giottopress'),
//    'section'  => 'giotto_section_general_settings',
//    'default'  => 'boxed',
//    'priority' => 10,
//    'multiple' => false,
//    'choices'  => array(
//        'fullwidth' => esc_attr__('Wide', 'giottopress'),
//        'boxed'     => esc_attr__('Boxed', 'giottopress'),
//    ),
//));

/**
 * Layout -> Sidebar
 */
Giotto_Kirki::add_panel('giotto_panel_sidebar', array(
    'title' => __('Sidebar', 'giottopress'),
    'panel' => 'giotto_panel_layout',
));

Giotto_Kirki::add_section('giotto_section_sidebar', array(
    'title' => __('Sidebar', 'giottopress'),
    'panel' => 'giotto_panel_layout'
));


/**
 * 2) Header
 */
Giotto_Kirki::add_section('giotto_section_header_general', array(
    'title'    => __('Header', 'giottopress'),
    'priority' => 80,
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'custom',
    'settings' => 'custom-separator-header-iii',
    'label'    => '',
    'section'  => 'giotto_section_header_general',
    'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __('Layout', 'giottopress') . '</div>',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'      => 'select',
    'settings'  => 'giotto_header_contained_type',
    'label'     => __('Header Width', 'giottopress'),
    'section'   => 'giotto_section_header_general',
    'default'   => 'fullwidth',
    'priority'  => 10,
    'multiple'  => false,
    'transport' => 'postMessage',
    'choices'   => array(
        'fullwidth' => esc_attr__('Fullwidth', 'giottopress'),
        'contained' => esc_attr__('Contained', 'giottopress'),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'      => 'select',
    'settings'  => 'giotto_header_inner_contained_type',
    'label'     => __('Header Inner Width', 'giottopress'),
    'section'   => 'giotto_section_header_general',
    'default'   => 'contained',
    'priority'  => 10,
    'multiple'  => false,
    'transport' => 'postMessage',
    'choices'   => array(
        'fullwidth' => esc_attr__('Fullwidth', 'giottopress'),
        'contained' => esc_attr__('Contained', 'giottopress'),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'custom',
    'settings' => 'custom-separator-header-iv',
    'label'    => '',
    'section'  => 'giotto_section_header_general',
    'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __('Style', 'giottopress') . '</div>',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'select',
    'settings' => 'giotto_header_general_style',
    'label'    => __('Header Style', 'giottopress'),
    'section'  => 'giotto_section_header_general',
    'default'  => 'minimal',
    'priority' => 10,
    'multiple' => false,
    'choices'  => array(
        'minimal'     => esc_attr__('Minimal', 'giottopress'),
        'transparent' => esc_attr__('Transparent (Over Content)', 'giottopress'),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'custom',
    'settings' => 'custom-separator-header-v',
    'label'    => '',
    'section'  => 'giotto_section_header_general',
    'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __('Menu', 'giottopress') . '</div>',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'select',
    'settings' => 'giotto_menu_style',
    'label'    => __('Menu Position', 'giottopress'),
    'section'  => 'giotto_section_header_general',
    'multiple' => false,
    'default'  => 'left',
    'choices'  => array(
        'left'   => esc_attr__('Menu on Right', 'giottopress'),
        'center' => esc_attr__('Menu on bottom', 'giottopress'),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'select',
    'settings'        => 'giotto_navbar_alignment',
    'label'           => __('Navigation  Alignment', 'giottopress'),
    'section'         => 'giotto_section_header_general',
    'default'         => 'right',
    'multiple'        => false,
    'choices'         => array(
        'right' => esc_attr__('Right', 'giottopress'),
        'left'  => esc_attr__('Left', 'giottopress'),
    ),
    'active_callback' => array(
        array(
            'setting'  => 'giotto_menu_style',
            'operator' => '==',
            'value'    => 'left'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'custom',
    'settings'        => 'custom-separator-header-vi',
    'label'           => '',
    'section'         => 'giotto_section_header_general',
    'default'         => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __('Height', 'giottopress') . '</div>',
    'active_callback' => array(
        array(
            'setting'  => 'giotto_header_general_style',
            'operator' => '==',
            'value'    => 'minimal'
        ),
        array(
            'setting'  => 'giotto_menu_style',
            'operator' => '==',
            'value'    => 'left'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'slider',
    'settings'        => 'giotto_header_height',
    'label'           => __('Header Height (em) ', 'giottopress'),
    'section'         => 'giotto_section_header_general',
    'default'         => '4',
    'priority'        => 10,
    'transport'       => 'postMessage',
    'output'          => array(
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
    'choices'         => array(
        'min'  => 3.25,
        'max'  => 10,
        'step' => .25
    ),
    'active_callback' => array(
        array(
            'setting'  => 'giotto_header_general_style',
            'operator' => '==',
            'value'    => 'minimal'
        ),
        array(
            'setting'  => 'giotto_menu_style',
            'operator' => '==',
            'value'    => 'left'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'slider',
    'settings'        => 'giotto_header_logo_height',
    'label'           => __('Logo Height (em) ', 'giottopress'),
    'section'         => 'giotto_section_header_general',
    'default'         => '2.5',
    'priority'        => 10,
    'transport'       => 'postMessage',
    'output'          => array(
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
    'choices'         => array(
        'min'  => 1.75,
        'max'  => 6,
        'step' => .25
    ),
    'active_callback' => array(
        array(
            'setting'  => 'giotto_header_general_style',
            'operator' => '==',
            'value'    => 'minimal'
        ),
        array(
            'setting'  => 'giotto_menu_style',
            'operator' => '==',
            'value'    => 'left'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'custom',
    'settings' => 'custom-separator-header-vii',
    'label'    => '',
    'section'  => 'giotto_section_header_general',
    'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __('BG Color & Border', 'giottopress') . '</div>',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'color',
    'settings'        => 'giotto_header_bg_color',
    'label'           => __('Header Background Color ', 'giottopress'),
    'section'         => 'giotto_section_header_general',
    'default'         => '#ffffff',
    'transport'       => 'postMessage',
    'priority'        => 10,
    'output'          => array(
        'element'  => 'header#masthead',
        'property' => 'background-color'
    ),
    'choices'         => array(
        'alpha' => true,
    ),
    'active_callback' => array(
        array(
            'setting'  => 'giotto_header_general_style',
            'operator' => '==',
            'value'    => 'minimal'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'slider',
    'settings'        => 'giotto_header_border_bottom_height',
    'label'           => __('Header Border Bottom Height ', 'giottopress'),
    'section'         => 'giotto_section_header_general',
    'default'         => '1',
    'priority'        => 10,
    'transport'       => 'postMessage',
    'output'          => array(
        array(
            'element'  => 'header#masthead',
            'property' => 'border-bottom-width',
            'units'    => 'px',
        )
    ),
    'choices'         => array(
        'min'  => 0,
        'max'  => 5,
        'step' => 1
    ),
    'active_callback' => array(
        array(
            'setting'  => 'giotto_header_general_style',
            'operator' => '==',
            'value'    => 'minimal'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'color',
    'settings'        => 'giotto_header_border_bottom_color',
    'label'           => __('Header Border Bottom Color ', 'giottopress'),
    'section'         => 'giotto_section_header_general',
    'default'         => '#EAECEE',
    'priority'        => 10,
    'transport'       => 'postMessage',
    'output'          => array(
        'element'  => 'header#masthead',
        'property' => 'border-bottom-color'
    ),
    'choices'         => array(
        'alpha' => true,
    ),
    'active_callback' => array(
        array(
            'setting'  => 'giotto_header_general_style',
            'operator' => '==',
            'value'    => 'minimal'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'slider',
    'settings'        => 'giotto_transparent_top_content_padding',
    'label'           => __('Content Page Padding ', 'giottopress'),
    'section'         => 'giotto_section_header_general',
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
        'step' => 1
    ),
    'active_callback' => array(
        array(
            'setting'  => 'giotto_header_general_style',
            'operator' => '==',
            'value'    => 'transparent'
        )
    )
));

/**
 * Primary Menu
 */
Giotto_Kirki::add_section('giotto_section_primary_menu', array(
    'title'    => __('Primary Menu', 'giottopress'),
    'priority' => 90,
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'custom',
    'settings' => 'custom-separator-menu-links',
    'label'    => '',
    'section'  => 'giotto_section_primary_menu',
    'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __('Links', 'giottopress') . '</div>',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'      => 'color',
    'settings'  => 'giotto_primary_menu_color',
    'label'     => __('Link Color', 'giottopress'),
    'section'   => 'giotto_section_primary_menu',
    'default'   => '#6b7c93',
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => '.header-minimal #masthead .navbar .menu-item:not(.is-active)',
            'property' => 'color',
        ),
        array(
            'element'  => '.header-transparent #masthead .navbar .menu-item:not(.is-active)',
            'property' => 'color',
        )
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'      => 'color',
    'settings'  => 'giotto_primary_menu_current_color',
    'label'     => __('Current Link Color', 'giottopress'),
    'section'   => 'giotto_section_primary_menu',
    'default'   => '#6b7c93',
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => '.header-minimal #masthead .navbar .menu-item.is-active',
            'property' => 'color',
        ),
        array(
            'element'  => '.header-trasparent #masthead .navbar .menu-item.is-active',
            'property' => 'color',
        ),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'custom',
    'settings' => 'custom-separator-menu-links-hover',
    'label'    => '',
    'section'  => 'giotto_section_primary_menu',
    'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __('Hover', 'giottopress') . '</div>',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'color',
    'settings' => 'giotto_primary_menu_over_bg',
    'label'    => __('Background Color', 'giottopress'),
    'section'  => 'giotto_section_primary_menu',
    'default'  => '#E7E9EC',
    'output'   => array(
        array(
            'element'  => '.header-minimal #masthead .navbar .menu-item:hover',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.header-transparent #masthead .navbar .menu-item:hover',
            'property' => 'background-color',
        )

    ),
    'choices'  => array(
        'alpha' => true,
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'color',
    'settings' => 'giotto_primary_menu_over_color',
    'label'    => __('Link Color', 'giottopress'),
    'section'  => 'giotto_section_primary_menu',
    'default'  => '#555555',
    'output'   => array(
        array(
            'element'  => '.header-minimal #masthead .navbar .menu-item:hover',
            'property' => 'color',
        ),
        array(
            'element'  => '.header-transparent #masthead .navbar .menu-item.is-active',
            'property' => 'color',
        )
    ),
    'choices'  => array(
        'alpha' => true,
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'custom',
    'settings' => 'custom-separator-submenu',
    'label'    => '',
    'section'  => 'giotto_section_primary_menu',
    'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">Submenu</div>',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'      => 'color',
    'settings'  => 'giotto_primary_menu_sub_color',
    'label'     => __('Submenus Link Color', 'giottopress'),
    'section'   => 'giotto_section_primary_menu',
    'default'   => '#666',
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => '.header-minimal #masthead .navbar .navbar-dropdown .menu-item',
            'property' => 'color',
        ),
        array(
            'element'  => '.header-transparent #masthead .navbar .navbar-dropdown .menu-item',
            'property' => 'color',
        ),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'color',
    'settings' => 'giotto_primary_submenu_over_bg',
    'label'    => __('Submenu Background Color', 'giottopress'),
    'section'  => 'giotto_section_primary_menu',
    'default'  => '#E7E9EC',
    'output'   => array(
        array(
            'element'  => '.header-minimal #masthead .navbar .navbar-dropdown .menu-item:hover',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.header-transparent #masthead .navbar .navbar-dropdown .menu-item:hover',
            'property' => 'background-color',
        )
    ),
    'choices'  => array(
        'alpha' => true,
    ),
));

/**
 * Page Title
 */
Giotto_Kirki::add_section('giotto_section_page_title', array(
    'title'    => __('Page Title', 'giottopress'),
    'priority' => 90
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'select',
    'settings' => 'giotto_page_title_type',
    'label'    => __('Page Title Visibility', 'giottopress'),
    'section'  => 'giotto_section_page_title',
    'default'  => 'content-inline',
    'choices'  => array(
        'content-inline' => esc_attr__('In Content', 'giottopress'),
        'header-bottom'  => esc_attr__('Below Header', 'giottopress'),
        'hidden'         => esc_attr__('Hidden', 'giottopress'),
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'custom',
    'settings'        => 'custom-separator-page-title-i',
    'label'           => '',
    'section'         => 'giotto_section_page_title',
    'default'         => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __('Layout', 'giottopress') . '</div>',
    'active_callback' => array(
        array(
            'setting'  => 'giotto_page_title_type',
            'operator' => '==',
            'value'    => 'header-bottom'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'select',
    'settings'        => 'giotto_page_title_contained_type',
    'label'           => __('Page Title Width', 'giottopress'),
    'section'         => 'giotto_section_page_title',
    'default'         => 'fullwidth',
    'multiple'        => false,
    'choices'         => array(
        'fullwidth' => esc_attr__('Fullwidth', 'giottopress'),
        'contained' => esc_attr__('Contained', 'giottopress'),
    ),
    'active_callback' => array(
        array(
            'setting'  => 'giotto_page_title_type',
            'operator' => '==',
            'value'    => 'header-bottom'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'select',
    'settings'        => 'giotto_page_title_inner_contained_type',
    'label'           => __('Page Title Inner Width', 'giottopress'),
    'section'         => 'giotto_section_page_title',
    'default'         => 'contained',
    'multiple'        => false,
    'choices'         => array(
        'fullwidth' => esc_attr__('Fullwidth', 'giottopress'),
        'contained' => esc_attr__('Contained', 'giottopress'),
    ),
    'active_callback' => array(
        array(
            'setting'  => 'giotto_page_title_type',
            'operator' => '==',
            'value'    => 'header-bottom'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'custom',
    'settings'        => 'custom-separator-page-title-ii',
    'label'           => '',
    'section'         => 'giotto_section_page_title',
    'default'         => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __('Titles', 'giottopress') . '</div>',
    'active_callback' => array(
        array(
            'setting'  => 'giotto_page_title_type',
            'operator' => '==',
            'value'    => 'header-bottom'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'text',
    'settings'        => 'giotto_page_title_front_page',
    'label'           => __('Frontpage Title', 'giottopress'),
    'description'     => __('This label will be displayed on the frontpage only if the settings are set to show the latest post', 'giottopress'),
    'section'         => 'giotto_section_page_title',
    'default'         => esc_attr__('Latest Posts', 'giottopress'),
    'active_callback' => array(
        array(
            'setting'  => 'giotto_page_title_type',
            'operator' => '==',
            'value'    => 'header-bottom'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'text',
    'settings'        => 'giotto_page_title_blog',
    'label'           => __('Blog Title', 'giottopress'),
    'section'         => 'giotto_section_page_title',
    'description'     => __('This label will be displayed on the blog single posts', 'giottopress'),
    'default'         => esc_attr__('Blog', 'giottopress'),
    'active_callback' => array(
        array(
            'setting'  => 'giotto_page_title_type',
            'operator' => '==',
            'value'    => 'header-bottom'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'custom',
    'settings'        => 'custom-page-title-info',
    'label'           => '',
    'section'         => 'giotto_section_page_title',
    'default'         => '<br/><div class="customize-section-title" style="padding:10px 20px;"><strong>' . __('The In-Content page title are visible only on the archives, search results page and single pages.',
            'giottopress') . '</strong></div>',
    'active_callback' => array(
        array(
            'setting'  => 'giotto_page_title_type',
            'operator' => '==',
            'value'    => 'content-inline'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'custom',
    'settings'        => 'custom-page-title-info-ii',
    'label'           => '',
    'section'         => 'giotto_section_page_title',
    'default'         => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __('Colors') . '</div>',
    'active_callback' => array(
        array(
            'setting'  => 'giotto_page_title_type',
            'operator' => '==',
            'value'    => 'header-bottom'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'color',
    'settings'        => 'giotto_header_page_title_color',
    'label'           => __('Title Color', 'giottopress'),
    'section'         => 'giotto_section_page_title',
    'default'         => '#6B7C96',
    'transport'       => 'postMessage',
    'output'          => array(
        'element'  => 'section.page-header .page-title',
        'property' => 'color',
        'exclude'  => array('#6B7C96')
    ),
    'active_callback' => array(
        array(
            'setting'  => 'giotto_page_title_type',
            'operator' => '==',
            'value'    => 'header-bottom'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'            => 'color',
    'settings'        => 'giotto_header_page_title_bg',
    'label'           => __('Background Color', 'giottopress'),
    'section'         => 'giotto_section_page_title',
    'default'         => '#F8F8F8',
    'transport'       => 'postMessage',
    'output'          => array(
        'element'  => 'section.page-header',
        'property' => 'background-color',
        'exclude'  => array('#F8F8F8')
    ),
    'active_callback' => array(
        array(
            'setting'  => 'giotto_page_title_type',
            'operator' => '==',
            'value'    => 'header-bottom'
        )
    )
));

/**
 * 3 Blog
 */
Giotto_Kirki::add_panel('giotto_panel_blog', array(
    'title'    => __('Blog', 'giottopress'),
    'priority' => 95
));

Giotto_Kirki::add_panel('giotto_panel_blog_entries', array(
    'title'    => __('Blog', 'giottopress'),
    'priority' => 95
));

Giotto_Kirki::add_section('giotto_section_blog', array(
    'title' => __('Blog Entries', 'giottopress'),
    'panel' => 'giotto_panel_blog_entries'
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'giotto_blog_entries_content',
    'label'    => __('Blog Post content', 'giottopress'),
    'section'  => 'giotto_section_blog',
    'default'  => 'full',
    'choices'  => array(
        'full'    => esc_attr__('Show Full Post', 'giottopress'),
        'excerpt' => esc_attr__('Show Excerpt', 'giottopress'),
    ),
));

/**
 * Colors
 */
Giotto_Kirki::add_section('giotto_section_site_colors', array(
    'title'    => __('Site Colors', 'giottopress'),
    'priority' => 110
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'      => 'color',
    'settings'  => 'giotto_body_bg',
    'label'     => __('Background Color', 'giottopress'),
    'section'   => 'giotto_section_site_colors',
    'default'   => '#ffffff',
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
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'      => 'color',
    'settings'  => 'giotto_content_bg',
    'label'     => __('Page Content Background Color', 'giottopress'),
    'section'   => 'giotto_section_site_colors',
    'default'   => '#ffffff',
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
));


/**
 * Site Identity
 */

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'checkbox',
    'settings' => 'giotto_hide_title',
    'label'    => __('Hide Title', 'giottopress'),
    'section'  => 'title_tagline',
    'default'  => false,
    'priority' => 11,
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'checkbox',
    'settings' => 'giotto_hide_tagline',
    'label'    => __('Hide Tagline', 'giottopress'),
    'section'  => 'title_tagline',
    'default'  => false,
    'priority' => 20,
));

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
