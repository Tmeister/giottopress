<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package giotto
 */

/* No direct access */
if ( ! defined('ABSPATH')) {
    exit;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function giotto_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular()) {
        $classes[] = 'hfeed';
    }

    return $classes;
}

add_filter('body_class', 'giotto_body_classes');

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function giotto_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'giotto_pingback_header');

/**
 * Global Hooks && Filters
 */

if ( ! function_exists('giotto_body_class')):
    function giotto_body_class($classes)
    {
        $header_style = get_theme_mod('giotto_header_general_style', 'minimal');
        $layout_style = giotto_get_sidebar_layout();
        $classes[]    = sprintf('layout-%s', $layout_style);
        $classes[]    = sprintf('header-%s', $header_style);

        return $classes;
    }

    add_filter('body_class', 'giotto_body_class');
endif;

if ( ! function_exists('giotto_post_class')):
    function giotto_post_class($classes)
    {
        global $post;
        $classes[]      = 'content';
        $featured_image = get_the_post_thumbnail_url($post->ID, 'full');
        $classes[]      = (false != $featured_image) ? 'has-featured-image' : 'has-not-featured-image';

        return $classes;
    }

    add_filter('post_class', 'giotto_post_class');
endif;

if ( ! function_exists('giotto_excerpt_more')):
    function giotto_excerpt_more($more)
    {
        return '...';
    }

    add_filter('excerpt_more', 'giotto_excerpt_more');
endif;

/**
 * Layout functions
 */

if ( ! function_exists('giotto_body_schema')) :
    /**
     * Prints the current page Schema
     *
     * @since 1.0.0
     */
    function giotto_body_schema()
    {
        // Set up default itemtype
        $itemtype = 'WebPage';

        // Get itemtype for the blog
        $itemtype = (giotto_is_blog()) ? 'Blog' : $itemtype;

        // Get itemtype for search results
        $itemtype = (is_search()) ? 'SearchResultsPage' : $itemtype;

        // Return the HTML
        echo apply_filters('giotto/body_schema', "itemtype='http://schema.org/$itemtype' itemscope='itemscope'", $itemtype);
    }

endif;

if ( ! function_exists('giotto_is_blog')):
    /**
     * Verify is the current page is blog
     *
     * @since 1.0.0
     * @return boolean
     */
    function giotto_is_blog()
    {
        $blog = (is_home() || is_archive() || is_attachment() || is_tax() || is_single()) ? true : false;

        return apply_filters('giotto/is_blog', $blog);
    }
endif;

if ( ! function_exists('giotto_page_class')):
    /**
     * Prints the proper page classes
     *
     * @since 1.0.0
     */
    function giotto_page_class()
    {
        $default_classes = array('container', 'is-clearfix');
        $container_type  = get_theme_mod('giotto_container_type', 'boxed');

        if ('fullwidth' === $container_type) {
            $default_classes[] = 'is-fluid';
            $default_classes[] = 'is-marginless';
        }

        $classes = apply_filters('giotto/content_page_class', $default_classes);
        echo sprintf('class="%s"', implode(' ', $classes));
    }
endif;

if ( ! function_exists('giotto_content_class')):
    /**
     * Prints the proper content classes
     *
     * @since 1.0.0
     */
    function giotto_content_class()
    {
        $default_classes = array('site-content');

        $classes = apply_filters('giotto/content_class', $default_classes);
        echo sprintf('class="%s"', implode(' ', $classes));
    }
endif;

if ( ! function_exists('giotto_wrapper_class')):
    /**
     * Prints the proper wrapper classes
     *
     * @since 1.0.0
     */
    function giotto_wrapper_class()
    {
        $default_classes = array('columns', 'container');

        if ('left-sidebar' === giotto_get_sidebar_layout()) {
            $default_classes[] = 'reverse-row-order';
        }

        if('fullwidth' === get_theme_mod('giotto_container_type', 'boxed')){
            $default_classes[] = 'is-fluid';
            $default_classes[] = 'is-marginless';
        }

        $classes = apply_filters('giotto/wrapper_class', $default_classes);
        echo sprintf('class="%s"', implode(' ', $classes));
    }
endif;

if ( ! function_exists('giotto_primary_content_class')):
    /**
     * Return the proper content classes for the current configuration.
     *
     * @since 1.0.0
     */
    function giotto_primary_content_class()
    {
        $default_classes = array('column');

        if ('sidebar' === giotto_get_sidebar_layout() || 'left-sidebar' === giotto_get_sidebar_layout()) {
            $default_classes[] = 'is-three-quarters';
        } else {
            $default_classes[] = 'is-12';
        }

        $classes = apply_filters('giotto/primary_content_class', $default_classes);
        echo sprintf('class="%s"', implode(' ', $classes));
    }
endif;

if ( ! function_exists('giotto_main_class')):
    /**
     * Return the proper main classes for the current configuration.
     *
     * @since 1.0.0
     */
    function giotto_main_class()
    {
        $default_classes = array();

        $classes = apply_filters('giotto/main_content_class', $default_classes);
        echo sprintf('class="%s"', implode(' ', $classes));
    }
endif;

if ( ! function_exists('giotto_sidebar_class')):
    /**
     * Return the proper content classes for the current configuration.
     *
     * @since 1.0.0
     */
    function giotto_sidebar_class()
    {
        $default_classes = array('widget-area');

        if ('sidebar' === giotto_get_sidebar_layout() || 'left-sidebar' === giotto_get_sidebar_layout()) {
            $default_classes[] = 'column';
            $default_classes[] = 'is-one-quarter';
        }

        $classes = apply_filters('giotto/primary_content_class', $default_classes);
        echo sprintf('class="%s"', implode(' ', $classes));
    }
endif;

if ( ! function_exists('giotto_get_sidebars')):
    /**
     * If the layout has sidebars we call the get_sidebar function
     *
     * * @since 1.0.0
     */
    function giotto_get_sidebars()
    {
        if ('sidebar' === giotto_get_sidebar_layout() || 'left-sidebar' === giotto_get_sidebar_layout()) {
            get_sidebar();
        }
    }

    add_action('giotto/sidebars', 'giotto_get_sidebars');
endif;

if ( ! function_exists('giotto_get_sidebar_layout')):
    /**
     * Get the sidebar layout according with the settings
     *
     * @since 1.0.0
     * @return string
     */
    function giotto_get_sidebar_layout()
    {
        global $post;

        $layout        = get_theme_mod('giotto_blog_layout', 'sidebar');
        $layout_single = (isset($post)) ? get_post_meta($post->ID, 'giotto/post_layout', true) : false;

        if (is_single()) {
            $layout = get_theme_mod('giotto_single_layout', 'sidebar');
        }

        if (false !== $layout_single && ! empty($layout_single)) {
            $layout = $layout_single;
        }

        if (is_home() || is_archive() || is_tax() || is_search() || is_category() && $layout_single === false) {
            $layout = get_theme_mod('giotto_blog_layout', 'sidebar');
        }

        return apply_filters('giotto/sidebar_layout', $layout);
    }
endif;

/**
 * Header functions
 */

if ( ! function_exists('giotto_header_bootstrap')):
    function giotto_header_bootstrap()
    {
        ?>
        <header itemtype="http://schema.org/WPHeader" itemscope="itemscope" id="masthead" <?php giotto_header_class(); ?>>
            <div <?php giotto_inner_header_class(); ?>>
                <?php do_action('giotto/before_header_content'); ?>
                <?php giotto_header_items(); ?>
                <?php do_action('giotto/after_header_content'); ?>
            </div><!-- #inner-header -->
        </header><!-- #header -->
        <?php
    }

    add_action('giotto/header', 'giotto_header_bootstrap');
endif;

if ( ! function_exists('giotto_header_class')):
    function giotto_header_class()
    {
        $container_type    = get_theme_mod('giotto_header_contained_type', 'fullwidth');
        $menu_style        = get_theme_mod('giotto_menu_style', 'left');
        $default_classes   = array('container');
        $default_classes[] = sprintf('menu-%s', $menu_style);

        if ('fullwidth' === $container_type) {
            $default_classes[] = 'is-fluid';
            $default_classes[] = 'is-marginless';
        } else {
            $default_classes[] = '';
        }


        $classes = apply_filters('giotto/header_class', $default_classes);
        echo sprintf('class="%s"', implode(' ', $classes));
    }
endif;

if ( ! function_exists('giotto_inner_header_class')):
    function giotto_inner_header_class()
    {
        //giotto_header_inner_contained_type
        $default_classes = array('container', 'header-inner');
        $container_type  = get_theme_mod('giotto_header_inner_contained_type', 'fullwidth');
        $menu_style      = get_theme_mod('giotto_menu_style', 'left');

//		if( 'center' == $menu_style ){
//			$default_classes[] = 'is-marginless';
//        }

        if ('fullwidth' === $container_type) {
            $default_classes[] = 'is-fluid';
        }

        $classes = apply_filters('giotto/header_inner_class', $default_classes);
        echo sprintf('class="%s"', implode(' ', $classes));
    }
endif;

if ( ! function_exists('giotto_site_branding')):
    function giotto_site_branding()
    {
        $title_disable   = get_theme_mod('giotto_hide_title', 'false');
        $tagline_disable = get_theme_mod('giotto_hide_tagline', 'false');

        /**
         * If the logo exists do not print the text.
         */
        $logo = giotto_get_custom_logo();
        if (false !== $logo) {
            return;
        }

        $site_title = apply_filters('giotto/site_title_output', sprintf(
            '<%1$s class="main-title" itemprop="headline">
			<a href="%2$s" rel="home">
				%3$s
			</a>
		</%1$s>',
            (is_front_page() && is_home()) ? 'h1' : 'p',
            esc_url(apply_filters('giotto/site_title_href', home_url('/'))),
            get_bloginfo('name')
        ));

        $site_tagline = apply_filters('giotto/site_description_output', sprintf(
            '<p class="site-description">
			%1$s
		</p>',
            html_entity_decode(get_bloginfo('description', 'display'))
        ));

        if (false == $title_disable || false == $tagline_disable) {
            echo apply_filters('giotto/site_branding_output', sprintf(
                '<div %1$s>
				%2$s
				%3$s
			</div>',
                giotto_site_branding_class(),
                ( ! $title_disable) ? $site_title : '',
                ( ! $tagline_disable) ? $site_tagline : ''
            ));
        }
    }
endif;

if ( ! function_exists('giotto_site_branding_class')):
    function giotto_site_branding_class()
    {
        $default_classes = array();
        $menu_style      = get_theme_mod('giotto_menu_style', 'left');

        if ('left' == $menu_style) {
            $default_classes[] = 'navbar-item';
        }

        $classes = apply_filters('giotto/site_branding_class', $default_classes);


        return sprintf('class="%s"', implode(' ', $classes));
    }
endif;

if ( ! function_exists('giotto_site_logo')):
    function giotto_site_logo()
    {
        $logo = giotto_get_custom_logo();

        if (false === $logo) {
            return;
        }

        do_action('giotto/before_logo');

        echo apply_filters('giotto/logo_output', sprintf(
            '<a href="%2$s" title="%3$s" rel="home" %1$s>
				<img class="header-image" src="%4$s" alt="%3$s" title="%3$s" />
			</a>',
            giotto_site_branding_class(),
            esc_url(apply_filters('giotto/logo_href', home_url('/'))),
            esc_attr(apply_filters('giotto/logo_title', get_bloginfo('name', 'display'))),
            esc_url(apply_filters('giotto/logo', $logo))
        ), $logo);

        do_action('giotto/after_logo');
    }
endif;

if ( ! function_exists('giotto_header_items')):
    function giotto_header_items()
    {
        $header_style = get_theme_mod('giotto_menu_style', 'left');
        get_template_part('templates/menu', $header_style);
    }
endif;

if ( ! function_exists('giotto_get_custom_logo')):
    function giotto_get_custom_logo()
    {
        $logo = (function_exists('the_custom_logo') && get_theme_mod('custom_logo')) ? wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full') : false;

        if (false === $logo || ! is_array($logo) || empty($logo)) {
            return false;
        }

        return $logo[0];
    }
endif;

if ( ! function_exists('giotto_main_navigation_class')):
    function giotto_main_navigation_class()
    {
        $default_classes = array('navbar is-marginless');
        $classes         = apply_filters('giotto/main_navigation_class', $default_classes);
        echo sprintf('class="%s"', implode(' ', $classes));
    }
endif;

if ( ! function_exists('giotto_create_main_menu')):
    function giotto_create_main_menu()
    {
        wp_nav_menu(
            array(
                'theme_location' => 'main-menu',
                'container'      => '',
                'menu_class'     => '',
                'items_wrap'     => '%3$s',
                'walker'         => new Giotto_Custom_Walker()
            )
        );
    }
endif;

/**
 * Post Function
 */

if ( ! function_exists('giotto_show_excerpt')):
    function giotto_show_excerpt()
    {
        global $post;
        $more_tag = apply_filters('giotto/more_tag', strpos($post->post_content, '<!--more-->'));
        $format   = (false !== get_post_format()) ? get_post_format() : 'standard';

        if (is_single()) {
            return false;
        }

        // TODO Get the excerpt setting from the Customizer
        // @kike
        $show_excerpt = false;//( 'excerpt' == $generate_settings['post_content'] ) ? true : false;

        // If our post format isn't standard, show the full content
        $show_excerpt = ('standard' !== $format) ? false : $show_excerpt;

        // If the more tag is found, show the full content
        $show_excerpt = ($more_tag) ? false : $show_excerpt;

        // Return our value
        return apply_filters('giotto/show_excerpt', $show_excerpt);
//		return true;
    }
endif;

if ( ! function_exists('giotto_pagination_class')):
    function giotto_pagination_class()
    {
        $default_classes = array('posts-pagination', 'is-boxed');
        $classes         = apply_filters('giotto/pagination_class', $default_classes);
        echo sprintf('class="%s"', implode(' ', $classes));
    }
endif;

