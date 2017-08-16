<?php
/**
 * giotto Theme Customizer
 *
 * @package Giotto
 */
/* No direct access */
if ( ! defined('ABSPATH')) {
    exit;
}

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
    wp_enqueue_script('giotto_customizer', get_template_directory_uri() . '/js/customizer-min.js', array('customize-preview'), '20170814', true);
}

add_action('customize_preview_init', 'giotto_customize_preview_js');

/**
 * Add the GET PRO button on the customizer
 */
function giotto_enqueue_controls_scripts()
{
    if ( ! defined('GIOTTO_PRO')) {
        wp_enqueue_script('giotto_pro_customizer', trailingslashit(get_template_directory_uri()) . '/inc/admin/get-pro/customizer-pro-min.js', array('customize-controls'));
        wp_enqueue_style('giotto_pro_customizer', trailingslashit(get_template_directory_uri()) . '/inc/admin/get-pro/customizer-pro.css');
    }
}

add_action('customize_controls_enqueue_scripts', 'giotto_enqueue_controls_scripts', 0);

/**
 * Remove some custom panels
 * @param $wp_customize
 */
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
 * General Options
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

/**
 * General Styling
 */
Giotto_Kirki::add_panel('giotto_panel_general_styles', array(
    'title' => __('General Styling', 'giottopress'),
    'panel' => 'giotto_panel_general_options',
));

Giotto_Kirki::add_section('giotto_section_general_styles', array(
    'title' => __('General Styling', 'giottopress'),
    'panel' => 'giotto_panel_general_options',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'custom',
    'settings' => 'custom-separator-styles-i',
    'label'    => '',
    'section'  => 'giotto_section_general_styles',
    'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __('Site Background', 'giottopress') . '</div>',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'      => 'color',
    'settings'  => 'giotto_body_bg',
    'label'     => __('Site Background Color', 'giottopress'),
    'section'   => 'giotto_section_general_styles',
    'default'   => '#ffffff',
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => 'body',
            'property' => 'background-color',
            'exclude'  => array('#ffffff')
        ),
        array(
            'element'  => 'html',
            'property' => 'background-color',
            'exclude'  => array('#ffffff')
        )
    ),
    'choices'   => array(
        'alpha' => true,
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'      => 'color',
    'settings'  => 'giotto_content_bg',
    'label'     => __('Content Background Color', 'giottopress'),
    'section'   => 'giotto_section_general_styles',
    'default'   => '#ffffff',
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => '#page',
            'property' => 'background-color',
            'exclude'  => array('#ffffff')
        )
    ),
    'choices'   => array(
        'alpha' => true,
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'custom',
    'settings' => 'custom-separator-styles-ii',
    'label'    => '',
    'section'  => 'giotto_section_general_styles',
    'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __('Primary Colors', 'giottopress') . '</div>',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'color',
    'settings' => 'giotto_site_primary_color',
    'label'    => __('Primary Color', 'giottopress'),
    'section'  => 'giotto_section_general_styles',
    'default'  => '#008cdd',
    'output'   => array(
        array(
            'exclude'  => array('#008cdd'),
            'element'  => '.button:focus, input[type="submit"]:focus, #comments .comment-body .reply a:focus, .button.is-focused, input.is-focused[type="submit"], #comments .comment-body .reply a.is-focused, .input:focus, input:focus:not([type="submit"]), .input.is-focused, input.is-focused:not([type="submit"]), .input:active, input:active:not([type="submit"]), .input.is-active, input.is-active:not([type="submit"]), .textarea:focus, textarea:focus, .textarea.is-focused, textarea.is-focused, .textarea:active, textarea:active, .textarea.is-active, textarea.is-active, .input.is-primary, input.is-primary:not([type="submit"]), .textarea.is-primary, textarea.is-primary',
            'property' => 'border-color'
        ),
        array(
            'exclude'  => array('#008cdd'),
            'element'  => '.button.is-primary, input[type="submit"], #comments .comment-body .reply a.is-primary, .button.is-primary[disabled], input[disabled][type="submit"], #comments .comment-body .reply a.is-primary[disabled], .navbar-burger.is-active span',
            'property' => 'background-color'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'color',
    'settings' => 'giotto_site_primary_color_hover',
    'label'    => __('Hover Primary Color', 'giottopress'),
    'section'  => 'giotto_section_general_styles',
    'default'  => '#0084d0',
    'output'   => array(
        array(
            'exclude'  => array('#0084d0'),
            'element'  => '.button.is-primary:hover, input[type="submit"]:hover, #comments .comment-body .reply a.is-primary:hover, .button.is-primary.is-hovered, input.is-hovered[type="submit"], #comments .comment-body .reply a.is-primary.is-hovered',
            'property' => 'background-color'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'color',
    'settings' => 'giotto_site_border_color',
    'label'    => __('Main Border Color', 'giottopress'),
    'section'  => 'giotto_section_general_styles',
    'default'  => '#eaecee',
    'output'   => array(
        array(
            'exclude'  => array('#eaecee'),
            'element'  => '#primary #main .hentry, .single #primary #main .hentry, #comments .comment-reply-title, #comments li.comment.depth-1, #comments .comments-title, #comments .comment-body footer .comment-author img, #comments .comment-content',
            'property' => 'border-color'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'custom',
    'settings' => 'custom-separator-styles-iii',
    'label'    => '',
    'section'  => 'giotto_section_general_styles',
    'default'  => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __('Links Color', 'giottopress') . '</div>',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'color',
    'settings' => 'giotto_site_content_link_color',
    'label'    => __('Color', 'giottopress'),
    'section'  => 'giotto_section_general_styles',
    'default'  => '#008cdd',
    'output'   => array(
        array(
            'exclude'  => array('#008cdd'),
            'element'  => 'a, .help.is-primary, .tagcloud a.help, .main-title a:hover, .content .entry-title a:hover, #comments .comment-body footer .comment-author a:hover, #comments .comment-body footer .comment-metadata a:hover, .widget a:hover
',
            'property' => 'color'
        )
    )
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'color',
    'settings' => 'giotto_site_content_link_hover_color',
    'label'    => __('Color:Hover', 'giottopress'),
    'section'  => 'giotto_section_general_styles',
    'default'  => '#4c555a',
    'output'   => array(
        array(
            'exclude'  => array('#4c555a'),
            'element'  => 'a:hover',
            'property' => 'color'
        )
    )
));

Giotto_Kirki::add_panel('giotto_panel_general_typography', array(
    'title' => __('General Typography', 'giottopress'),
    'panel' => 'giotto_panel_general_options',
));

Giotto_Kirki::add_section('giotto_section_general_typography', array(
    'title'    => __('General Typography', 'giottopress'),
    'priority' => 80,
    'panel'    => 'giotto_panel_general_options',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'typography',
    'settings' => 'giotto_site_main_typography',
    'label'    => esc_attr__('Body Typography', 'giottopress'),
    'section'  => 'giotto_section_general_typography',
    'default'  => array(
        'font-family' => 'Roboto',
        'font-size'   => '16px',
        'variant'     => 'regular',
        'subsets'     => array('latin-ext'),
    ),
    'output'   => array(
        array(
            'element' => 'body',
        ),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'typography',
    'settings' => 'giotto_site_heading_typography',
    'label'    => esc_attr__('Heading Typography', 'giottopress'),
    'section'  => 'giotto_section_general_typography',
    'default'  => array(
        'font-family' => 'Roboto',
        'variant'     => 'regular',
        'subsets'     => array('latin-ext'),
    ),
    'output'   => array(
        array(
            'element' => 'h1, h2, h3, h4, h5, h6, .content h1,.content h2,.content h3,.content h4,.content h5,.content h6, .content .entry-title a, h1.page-title, .page-title',
        ),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'color',
    'settings' => 'giotto_site_text_color',
    'label'    => __('Site Text Color', 'giottopress'),
    'section'  => 'giotto_section_general_typography',
    'default'  => '#4c555a',
    'output'   => array(
        array(
            'element'  => 'body, .main-title a, .content .entry-title a, #comments .comment-body footer .comment-author a, #comments .comment-body footer .comment-metadata a, .widget a, strong, pre, table th, .button.is-link, input.is-link[type="submit"], #comments .comment-body .reply a.is-link,.tag, .tagcloud a, .content h1,.content h2,.content h3,.content h4,.content h5,.content h6, label, .posts-pagination .pagination .page-numbers, .content .entry-title a,#primary #main .hentry .more-tag.button, #primary #main .hentry input.more-tag[type="submit"], #primary #main .hentry #comments .comment-body .reply a.more-tag, #comments .comment-body .reply #primary #main .hentry a.more-tag, #comments .comment-body footer .comment-author a, #comments .comment-body footer .comment-metadata a, .widget a, h1.page-title, .page-title, .widget-title',
            'property' => 'color'
        )
    )
));

/**
 * Header
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
    'type'            => 'select',
    'settings'        => 'giotto_header_contained_type',
    'label'           => __('Header Width', 'giottopress'),
    'section'         => 'giotto_section_header_general',
    'default'         => 'fullwidth',
    'priority'        => 10,
    'multiple'        => false,
    'transport'       => 'postMessage',
    'choices'         => array(
        'fullwidth' => esc_attr__('Fullwidth', 'giottopress'),
        'contained' => esc_attr__('Contained', 'giottopress'),
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
            'exclude'  => array('4'),
            'element'  => '#masthead .navbar, #masthead .navbar-brand',
            'property' => 'height',
            'units'    => 'em',
        ),
        array(
            'exclude'  => array('4'),
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
    'default'         => '3.5',
    'priority'        => 10,
    'transport'       => 'postMessage',
    'output'          => array(
        array(
            'exclude'  => array('3.5'),
            'element'  => '#masthead .navbar-brand .navbar-item img',
            'property' => 'height',
            'units'    => 'em',
        ),
        array(
            'exclude'  => array('2.5'),
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
        'exclude'  => array('#ffffff'),
        'element'  => 'header#masthead',
        'property' => 'background-color',
        'suffix'   => '!important'
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
            'exclude'  => array('1'),
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
    'default'         => '#eaecee',
    'priority'        => 10,
    'transport'       => 'postMessage',
    'output'          => array(
        'exclude'  => array('#eaecee'),
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
            'exclude'  => array('#6b7c93'),
            'element'  => '.header-minimal #masthead .navbar .menu-item:not(.is-active)',
            'property' => 'color',
        ),
        array(
            'exclude'  => array('#6b7c93'),
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
    'default'   => '#008cdd',
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'exclude'  => array('#008cdd'),
            'element'  => '.header-minimal #masthead .navbar .menu-item.is-active',
            'property' => 'color',
        ),
        array(
            'exclude'  => array('#008cdd'),
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
    'default'  => '#e7e9ec',
    'output'   => array(
        array(
            'exclude'  => array('#e7e9ec'),
            'element'  => '.header-minimal #masthead .navbar .menu-item:hover, .navbar-item.has-dropdown:hover > .navbar-link,
.navbar-item.has-dropdown.is-active > .navbar-link, .header-transparent #masthead .navbar .menu-item:hover, .navbar-item.has-dropdown:hover .navbar-item.has-dropdown:hover',
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
            'exclude'  => array('#555555'),
            'element'  => '.header-minimal #masthead .navbar .menu-item:hover, .header-transparent #masthead .navbar .menu-item.is-active',
            'property' => 'color',
        ),
        array(
            'exclude'  => array(),
            'element'  => '.navbar-item.has-dropdown:hover, .navbar-item.has-dropdown:hover > .navbar-item ',
            'property' => 'color',
            'suffix'   => ' !important'
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
    'default'         => '<br/><div class="customize-section-title" style="padding:10px 20px;">' . __('Colors', 'giottopress') . '</div>',
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
 * Blog
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
    'label'    => __('Blog Post Content', 'giottopress'),
    'section'  => 'giotto_section_blog',
    'default'  => 'full',
    'choices'  => array(
        'full'    => esc_attr__('Show Full Post', 'giottopress'),
        'excerpt' => esc_attr__('Show Excerpt', 'giottopress'),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'radio-buttonset',
    'settings' => 'giotto_blog_entry_featured',
    'label'    => __('Blog Post Feature Image', 'giottopress'),
    'section'  => 'giotto_section_blog',
    'default'  => 'hide',
    'choices'  => array(
        'show' => esc_attr__('Show Image', 'giottopress'),
        'hide' => esc_attr__('Hide Image', 'giottopress'),
    ),
));

/**
 * Footer
 */

Giotto_Kirki::add_panel('giotto_panel_footer', array(
    'title'    => __('Footer', 'giottopress'),
    'priority' => 96,
));

Giotto_Kirki::add_panel('giotto_panel_footer_layout', array(
    'title' => __('Layout', 'giottopress'),
    'panel' => 'giotto_panel_footer',
));

Giotto_Kirki::add_section('giotto_section_footer', array(
    'title' => __('Layout', 'giottopress'),
    'panel' => 'giotto_panel_footer',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'      => 'select',
    'settings'  => 'giotto_footer_contained_type',
    'label'     => __('Footer Width', 'giottopress'),
    'section'   => 'giotto_section_footer',
    'default'   => 'fullwidth',
    'multiple'  => false,
    'transport' => 'postMessage',
    'choices'   => array(
        'fullwidth' => esc_attr__('Fullwidth', 'giottopress'),
        'contained' => esc_attr__('Contained', 'giottopress'),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'      => 'select',
    'settings'  => 'giotto_footer_inner_contained_type',
    'label'     => __('Footer Inner Width', 'giottopress'),
    'section'   => 'giotto_section_footer',
    'default'   => 'contained',
    'multiple'  => false,
    'transport' => 'postMessage',
    'choices'   => array(
        'fullwidth' => esc_attr__('Fullwidth', 'giottopress'),
        'contained' => esc_attr__('Contained', 'giottopress'),
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'      => 'color',
    'settings'  => 'giotto_footer_bg_color',
    'label'     => __('Footer Background Color ', 'giottopress'),
    'section'   => 'giotto_section_footer',
    'default'   => '#ffffff',
    'transport' => 'postMessage',
    'output'    => array(
        'exclude'  => array('#ffffff'),
        'element'  => '#site-footer',
        'property' => 'background-color'
    ),
    'choices'   => array(
        'alpha' => true,
    ),
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'spacing',
    'settings' => 'giotto_footer_spacing',
    'label'    => __('Footer Spacing', 'giottopress'),
    'section'  => 'giotto_section_footer',
    'default'  => array(
        'top'    => '1em',
        'bottom' => '1em',
        'left'   => '0',
        'right'  => '0',
    ),
    'output'   => array(
        'element'  => '#site-footer',
        'property' => 'padding'
    )
));

Giotto_Kirki::add_panel('giotto_panel_footer_widgets', array(
    'title' => __('Widgets', 'giottopress'),
    'panel' => 'giotto_panel_footer',
));

Giotto_Kirki::add_section('giotto_section_footer_widgets', array(
    'title' => __('Widgets', 'giottopress'),
    'panel' => 'giotto_panel_footer',
));

Giotto_Kirki::add_field('giotto_theme', array(
    'type'     => 'slider',
    'settings' => 'giotto_footer_sidebars',
    'label'    => __('Footer Widget Areas ', 'giottopress'),
    'section'  => 'giotto_section_footer_widgets',
    'default'  => 0,
    'choices'  => array(
        'min'  => 0,
        'max'  => 5,
        'step' => 1,
    ),
));

for ($i = 1; $i < 6; $i++) {

    Giotto_Kirki::add_field('giotto_theme', array(
        'type'            => 'custom',
        'settings'        => sprintf('custom-separator-footer-%s', $i),
        'label'           => '',
        'section'         => 'giotto_section_footer_widgets',
        'default'         => '<br/><div class="customize-section-title" style="padding:10px 20px;">' .
                             sprintf(__('Footer %s', 'giottopress'), $i)
                             . '</div>',
        'active_callback' => array(
            array(
                'setting'  => 'giotto_footer_sidebars',
                'operator' => '>=',
                'value'    => $i
            )
        )
    ));

    Giotto_Kirki::add_field('giotto_theme', array(
        'type'            => 'slider',
        'settings'        => sprintf('footer-column-width-%s', $i),
        'label'           => __('Columns', 'giottopress'),
        'section'         => 'giotto_section_footer_widgets',
        'description'     => __('How many columns in the row should the widget area use? Max 12', 'giottopress'),
        'default'         => 3,
        'choices'         => array(
            'min'  => '1',
            'max'  => '12',
            'step' => '1',
        ),
        'active_callback' => array(
            array(
                'setting'  => 'giotto_footer_sidebars',
                'operator' => '>=',
                'value'    => $i
            )
        )
    ));

    Giotto_Kirki::add_field('giotto_theme', array(
        'type'            => 'text',
        'settings'        => sprintf('footer-custom-class-%s', $i),
        'label'           => __('Custom Classes', 'giottopress'),
        'section'         => 'giotto_section_footer_widgets',
        'default'         => '',
        'active_callback' => array(
            array(
                'setting'  => 'giotto_footer_sidebars',
                'operator' => '>=',
                'value'    => $i
            )
        )
    ));
}

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
