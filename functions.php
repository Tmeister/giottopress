<?php
/**
 * GiottoPress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GiottoPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'giottopress_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */

	function giottopress_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on giotto, use a find and replace
		 * to change 'giottopress' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'giottopress', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Primary Menu', 'giottopress' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

	}
endif;
add_action( 'after_setup_theme', 'giottopress_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function giottopress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'giottopress_content_width', 640 );
}

add_action( 'after_setup_theme', 'giottopress_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function giottopress_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'giottopress' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'giottopress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	for ( $i = 1; $i < 6; $i ++ ) {
		register_sidebar( array(
			/* translators: 1: Footer Number. */
			'name'          => sprintf( esc_html__( 'Footer %s', 'giottopress' ), $i ),
			'id'            => sprintf( 'footer-%s', $i ),
			'description'   => esc_html__( 'Add widgets here.', 'giottopress' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}
}

add_action( 'widgets_init', 'giottopress_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function giottopress_scripts() {
	$giottopress_theme = wp_get_theme();
	wp_enqueue_style( 'giottopress-style', get_stylesheet_uri(), array(), $giottopress_theme->get( 'Version' ) );
	wp_enqueue_script( 'giottopress-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $giottopress_theme->get( 'Version' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'giottopress_scripts' );


/**
 * Load the TGMPA Loader
 */
require get_template_directory() . '/inc/tgmpa-loader.php';

/**
 * Load the Kirki Fallback class
 */
require get_template_directory() . '/inc/class-giottopress-kirki.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Metaboxes
 */
require get_template_directory() . '/inc/class-giottopress-metaboxes.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom Menu Walker
 */
require get_template_directory() . '/inc/class-giottopress-menu-walker.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Customizer PRO.
 */
require get_template_directory() . '/inc/admin/get-pro/class-giottopress-up-sell.php';

/**
 * Welcome Screen
 */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/about-theme/class-giottopress-about-theme.php';
}
