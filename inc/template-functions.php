<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Giotto
 */

/* No direct access */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function giottopress_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}

add_filter( 'body_class', 'giottopress_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function giottopress_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}

add_action( 'wp_head', 'giottopress_pingback_header' );

/**
 * Global Hooks && Filters
 */

if ( ! function_exists( 'giottopress_body_class' ) ) :
	function giottopress_body_class( $classes ) {
		$header_style = get_theme_mod( 'giottopress_header_general_style', 'minimal' );
		$layout_style = giottopress_get_sidebar_layout();
		$classes[]    = sprintf( 'layout-%s', $layout_style );
		$classes[]    = sprintf( 'header-%s', $header_style );

		return $classes;
	}

	add_filter( 'body_class', 'giottopress_body_class' );
endif;

if ( ! function_exists( 'giottopress_post_class' ) ) :
	function giottopress_post_class( $classes ) {
		global $post;
		$classes[]      = 'content';
		$featured_image = get_the_post_thumbnail_url( $post->ID, 'full' );
		$classes[]      = ( false != $featured_image ) ? 'has-featured-image' : 'has-not-featured-image';

		return $classes;
	}

	add_filter( 'post_class', 'giottopress_post_class' );
endif;

if ( ! function_exists( 'giottopress_excerpt_more' ) ) :
	function giottopress_excerpt_more( $more ) {
		return '...';
	}

	add_filter( 'excerpt_more', 'giottopress_excerpt_more' );
endif;

/**
 * Layout functions
 */

if ( ! function_exists( 'giottopress_body_schema' ) ) :
	/**
	 * Prints the current page Schema
	 *
	 * @since 1.0.0
	 */
	function giottopress_body_schema() {
		$itemtype = 'WebPage';
		$itemtype = ( giottopress_is_blog() ) ? 'Blog' : $itemtype;
		$itemtype = ( is_search() ) ? 'SearchResultsPage' : $itemtype;
		$schema   = apply_filters( 'giottopress_body_schema', "itemtype='http://schema.org/$itemtype' itemscope='itemscope'", $itemtype );
		echo $schema;
	}

endif;

if ( ! function_exists( 'giottopress_is_blog' ) ) :
	/**
	 * Verify is the current page is blog
	 *
	 * @since 1.0.0
	 * @return boolean
	 */
	function giottopress_is_blog() {
		$blog = ( is_home() || is_archive() || is_attachment() || is_tax() || is_single() ) ? true : false;

		return apply_filters( 'giottopress_is_blog', $blog );
	}
endif;

if ( ! function_exists( 'giottopress_page_class' ) ) :
	/**
	 * Prints the proper page classes
	 *
	 * @since 1.0.0
	 */
	function giottopress_page_class() {
		global $post;

		$default_classes  = array( 'container', 'is-clearfix' );
		$settings_classes = array();
		/**
		 * Global container setting
		 */
		$container_type = get_theme_mod( 'giottopress_container_type', 'boxed' );
		/**
		 * Singular container setting
		 */
		$container_single_meta = ( isset( $post ) ) ? get_post_meta( $post->ID, 'giottopress_post_layout', true ) : false;

		if ( 'fullwidth' === $container_type || 'wide' === $container_type ) {
			$settings_classes[] = 'is-fluid';
			$settings_classes[] = 'is-marginless';
		}

		/**
		 * If the container meta exists, override the global setting
		 */
		if ( false !== $container_single_meta && is_singular() ) {
			if ( 'fullwidth' === $container_single_meta || 'wide' === $container_single_meta ) {
				$settings_classes   = array();
				$settings_classes[] = 'is-fluid';
				$settings_classes[] = 'is-marginless';
			}
		}

		$classes = apply_filters( 'giottopress_content_page_class', array_merge( $default_classes, $settings_classes ) );
		echo sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) );
	}
endif;

if ( ! function_exists( 'giottopress_content_class' ) ) :
	/**
	 * Prints the proper content classes
	 *
	 * @since 1.0.0
	 */
	function giottopress_content_class() {
		$default_classes = array( 'site-content' );

		$classes = apply_filters( 'giottopress_content_class', $default_classes );
		echo sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) );
	}
endif;

if ( ! function_exists( 'giottopress_wrapper_class' ) ) :
	/**
	 * Prints the proper wrapper classes
	 *
	 * @since 1.0.0
	 */
	function giottopress_wrapper_class() {
		global $post;

		$default_classes       = array( 'columns', 'container' );
		$settings_classes      = array();
		$container_single_meta = ( isset( $post ) ) ? get_post_meta( $post->ID, 'giottopress_post_layout', true ) : false;

		/**
		 * If sidebar on the left set the reverse order
		 */
		if ( 'left-sidebar' === giottopress_get_sidebar_layout() ) {
			$default_classes[] = 'reverse-row-order';
		}

		/**
		 * Global Setting
		 */
		if ( 'fullwidth' === get_theme_mod( 'giottopress_container_type', 'boxed' ) ) {
			$settings_classes[] = 'is-fluid';
			$settings_classes[] = 'is-marginless';
		}

		/**
		 * If the singular settings is set, override the global setting
		 */
		if ( false !== $container_single_meta & is_singular() ) {
			if ( 'fullwidth' === $container_single_meta ) {
				$settings_classes   = array();
				$settings_classes[] = 'is-fluid';
				$settings_classes[] = 'is-marginless';
			}
		}

		$classes = apply_filters( 'giottopress_wrapper_class', array_merge( $default_classes, $settings_classes ) );
		echo sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) );
	}
endif;

if ( ! function_exists( 'giottopress_primary_content_class' ) ) :
	/**
	 * Return the proper content classes for the current configuration.
	 *
	 * @since 1.0.0
	 */
	function giottopress_primary_content_class() {
		$default_classes = array( 'column' );

		if ( 'sidebar' === giottopress_get_sidebar_layout() || 'left-sidebar' === giottopress_get_sidebar_layout() ) {
			$default_classes[] = 'is-three-quarters';
		} else {
			$default_classes[] = 'is-12';
		}

		$classes = apply_filters( 'giottopress_primary_content_class', $default_classes );
		echo sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) );
	}
endif;

if ( ! function_exists( 'giottopress_main_class' ) ) :
	/**
	 * Return the proper main classes for the current configuration.
	 *
	 * @since 1.0.0
	 */
	function giottopress_main_class() {
		$default_classes = array();

		$classes = apply_filters( 'giottopress_main_content_class', $default_classes );
		echo sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) );
	}
endif;

if ( ! function_exists( 'giottopress_sidebar_class' ) ) :
	/**
	 * Return the proper content classes for the current configuration.
	 *
	 * @since 1.0.0
	 */
	function giottopress_sidebar_class() {
		$default_classes = array( 'widget-area' );

		if ( 'sidebar' === giottopress_get_sidebar_layout() || 'left-sidebar' === giottopress_get_sidebar_layout() ) {
			$default_classes[] = 'column';
			$default_classes[] = 'is-one-quarter';
		}

		$classes = apply_filters( 'giottopress_primary_content_class', $default_classes );
		echo sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) );
	}
endif;

if ( ! function_exists( 'giottopress_get_sidebars' ) ) :
	/**
	 * If the layout has sidebars we call the get_sidebar function
	 *
	 * * @since 1.0.0
	 */
	function giottopress_get_sidebars() {
		if ( 'sidebar' === giottopress_get_sidebar_layout() || 'left-sidebar' === giottopress_get_sidebar_layout() ) {
			get_sidebar();
		}
	}

	add_action( 'giottopress_sidebars', 'giottopress_get_sidebars' );
endif;

if ( ! function_exists( 'giottopress_get_sidebar_layout' ) ) :
	/**
	 * Get the sidebar layout according with the settings
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function giottopress_get_sidebar_layout() {
		global $post;

		/**
		 * Get the global blog layout
		 */
		$layout = get_theme_mod( 'giottopress_blog_layout', 'sidebar' );
		/**
		 * Get the global single post layout
		 */
		$layout_single_global = get_theme_mod( 'giottopress_single_layout', 'sidebar' );
		/**
		 * Get the global page layout
		 */
		$layout_page_global = get_theme_mod( 'giottopress_page_layout', 'sidebar' );
		/**
		 * If is post get option from the the post meta
		 */
		$layout_single_meta = ( isset( $post ) ) ? get_post_meta( $post->ID, 'giottopress_post_sidebar', true ) : 'global';

		/**
		 * If is single, get the single posts global option
		 */
		if ( is_single() ) {
			/**
			 * If the post meta option exists and is not set to global or is not false
			 * set the meta option as the layout
			 * The post meta option override all.
			 */
			if ( 'global' !== $layout_single_meta && ! empty( $layout_single_meta ) ) {
				$layout = $layout_single_meta;
			}

			/**
			 * If the option is set to global
			 */
			if ( 'global' === $layout_single_meta || empty( $layout_single_meta ) ) {
				$layout = $layout_single_global;
			}
		}

		/**
		 * If is page, get the page global option
		 */
		if ( is_page() ) {
			/**
			 * If the page meta option exists and is not set to global or is not false
			 * set the meta option as the layout
			 * The page meta option override all.
			 */
			if ( 'global' !== $layout_single_meta && ! empty( $layout_single_meta ) ) {
				$layout = $layout_single_meta;
			}

			/**
			 * If the option is set to global
			 */
			if ( 'global' === $layout_single_meta || empty( $layout_single_meta ) ) {
				$layout = $layout_page_global;
			}
		}

		if ( is_home() || is_archive() || is_tax() || is_category() && false === $layout_single_meta ) {
			$layout = get_theme_mod( 'giottopress_blog_layout', 'sidebar' );
		}

		if ( is_search() ) {
			$layout = get_theme_mod( 'giottopress_results_layout', 'sidebar' );
		}

		if ( is_404() ) {
			$layout = get_theme_mod( 'giottopress_error_layout', 'sidebar' );
		}

		return apply_filters( 'giottopress_sidebar_layout', $layout );
	}
endif;

/**
 * Header functions
 */

if ( ! function_exists( 'giottopress_header_bootstrap' ) ) :
	function giottopress_header_bootstrap() {
		?>
		<header itemtype="http://schema.org/WPHeader" itemscope="itemscope" id="masthead" <?php giottopress_header_class(); ?>>
			<div <?php giottopress_inner_header_class(); ?>>
				<?php do_action( 'giottopress_before_header_content' ); ?>
				<?php giottopress_header_items(); ?>
				<?php do_action( 'giottopress_after_header_content' ); ?>
			</div><!-- #inner-header -->
		</header><!-- #header -->
		<?php
	}

	add_action( 'giottopress_header', 'giottopress_header_bootstrap' );
endif;

if ( ! function_exists( 'giottopress_header_class' ) ) :
	function giottopress_header_class() {
		$container_type    = get_theme_mod( 'giottopress_header_contained_type', 'fullwidth' );
		$menu_style        = get_theme_mod( 'giottopress_menu_style', 'left' );
		$header_style      = get_theme_mod( 'giottopress_header_general_style', 'minimal' );
		$default_classes   = array( 'container' );
		$default_classes[] = sprintf( 'menu-%s', $menu_style );

		if ( 'fullwidth' === $container_type || 'minimal' !== $header_style ) {
			$default_classes[] = 'is-fluid';
			$default_classes[] = 'is-marginless';
		} else {
			$default_classes[] = '';
		}

		$classes = apply_filters( 'giottopress_header_class', $default_classes );
		echo sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) );
	}
endif;

if ( ! function_exists( 'giottopress_inner_header_class' ) ) :
	function giottopress_inner_header_class() {
		$default_classes = array( 'container', 'header-inner' );
		$container_type  = get_theme_mod( 'giottopress_header_inner_contained_type', 'contained' );
		$menu_style      = get_theme_mod( 'giottopress_menu_style', 'left' );

		if ( 'fullwidth' === $container_type ) {
			$default_classes[] = 'is-fluid';
		}

		$classes = apply_filters( 'giottopress_header_inner_class', $default_classes );
		echo sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) );
	}
endif;

if ( ! function_exists( 'giottopress_site_branding' ) ) :
	function giottopress_site_branding() {
		$title_disable   = get_theme_mod( 'giottopress_hide_title', false );
		$tagline_disable = get_theme_mod( 'giottopress_hide_tagline', false );

		/**
		 * If the logo exists do not print the text.
		 */
		$logo = giottopress_get_custom_logo();
		if ( false !== $logo ) {
			return;
		}

		$site_title = apply_filters( 'giottopress_site_title_output', sprintf(
			'<%1$s class="main-title" itemprop="headline">
			<a href="%2$s" rel="home">
				%3$s
			</a>
		</%1$s>',
			( is_front_page() && is_home() ) ? 'h1' : 'p',
			esc_url( apply_filters( 'giottopress_site_title_href', home_url( '/' ) ) ),
			get_bloginfo( 'name' )
		) );

		$site_tagline = apply_filters( 'giottopress_site_description_output', sprintf(
			'<p class="site-description">
			%1$s
		</p>',
			html_entity_decode( get_bloginfo( 'description', 'display' ) )
		) );

		if ( false == $title_disable || false == $tagline_disable ) {
			$branding = apply_filters( 'giottopress_site_branding_output', sprintf(
				'<div %1$s>
				%2$s
				%3$s
			</div>',
				giottopress_site_branding_class(),
				( ! $title_disable ) ? $site_title : '',
				( ! $tagline_disable ) ? $site_tagline : ''
			) );
			echo $branding;
		}
	}
endif;

if ( ! function_exists( 'giottopress_site_branding_class' ) ) :
	function giottopress_site_branding_class() {
		$default_classes = array();
		$menu_style      = get_theme_mod( 'giottopress_menu_style', 'left' );

		if ( 'left' == $menu_style ) {
			$default_classes[] = 'navbar-item';
		}

		$classes = apply_filters( 'giottopress_site_branding_class', $default_classes );

		return sprintf( 'class="%s"', implode( ' ', $classes ) );
	}
endif;

if ( ! function_exists( 'giottopress_site_logo' ) ) :
	function giottopress_site_logo() {
		$logo = giottopress_get_custom_logo();

		if ( false === $logo ) {
			return;
		}

		do_action( 'giottopress_before_logo' );

		$logo_markup = apply_filters( 'giottopress_logo_output', sprintf(
			'<a href="%2$s" title="%3$s" rel="home" %1$s>
				<img class="header-image" src="%4$s" alt="%3$s" title="%3$s" />
			</a>',
			giottopress_site_branding_class(),
			esc_url( apply_filters( 'giottopress_logo_href', home_url( '/' ) ) ),
			esc_attr( apply_filters( 'giottopress_logo_title', get_bloginfo( 'name', 'display' ) ) ),
			esc_url( apply_filters( 'giottopress_logo', $logo ) )
		), $logo );

		echo $logo_markup;

		do_action( 'giottopress_after_logo' );
	}
endif;

if ( ! function_exists( 'giottopress_header_items' ) ) :
	function giottopress_header_items() {
		$header_style = get_theme_mod( 'giottopress_menu_style', 'left' );
		get_template_part( 'templates/menu', $header_style );
	}
endif;

if ( ! function_exists( 'giottopress_get_custom_logo' ) ) :
	function giottopress_get_custom_logo() {
		$logo = ( function_exists( 'the_custom_logo' ) && get_theme_mod( 'custom_logo' ) ) ? wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' ) : false;

		if ( false === $logo || ! is_array( $logo ) || empty( $logo ) ) {
			return false;
		}

		return $logo[0];
	}
endif;

if ( ! function_exists( 'giottopress_main_navigation_class' ) ) :
	function giottopress_main_navigation_class() {
		$default_classes = array( 'navbar is-marginless' );
		$classes         = apply_filters( 'giottopress_main_navigation_class', $default_classes );
		echo sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) );
	}
endif;

if ( ! function_exists( 'giottopress_create_main_menu' ) ) :
	function giottopress_create_main_menu() {
		wp_nav_menu(
			array(
				'theme_location' => 'main-menu',
				'container'      => '',
				'menu_class'     => '',
				'items_wrap'     => '%3$s',
				'depth'          => 3,
				'walker'         => new GiottoPress_Menu_Walker(),
				'fallback_cb'    => 'GiottoPress_Menu_Walker::fallback',
			)
		);
	}
endif;

/**
 * Page Title Functions
 */

if ( ! function_exists( 'giottopress_page_title_class' ) ) :
	function giottopress_page_title_class() {
		$container_type  = get_theme_mod( 'giottopress_page_title_contained_type', 'fullwidth' );
		$default_classes = array( 'container', 'page-header' );
		if ( 'fullwidth' === $container_type ) {
			$default_classes[] = 'is-fluid';
			$default_classes[] = 'is-marginless';
		}

		$classes = apply_filters( 'giottopress_page_title_class', $default_classes );
		echo sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) );
	}
endif;

if ( ! function_exists( 'giottopress_page_title_inner_class' ) ) :
	function giottopress_page_title_inner_class() {
		$container_type  = get_theme_mod( 'giottopress_page_title_inner_contained_type', 'fullwidth' );
		$default_classes = array( 'container', 'page-tittle-inner', 'content' );

		if ( 'fullwidth' === $container_type ) {
			$default_classes[] = 'is-fluid';
		}

		$classes = apply_filters( 'giottopress_page_title_inner_class', $default_classes );
		echo sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) );
	}
endif;

/**
 * Post Functions
 */

if ( ! function_exists( 'giottopress_show_excerpt' ) ) :
	function giottopress_show_excerpt() {
		global $post;
		$more_tag = apply_filters( 'giottopress_more_tag', strpos( $post->post_content, '<!--more-->' ) );
		$format   = ( false !== get_post_format() ) ? get_post_format() : 'standard';

		if ( is_single() ) {
			return false;
		}

		$show_excerpt = ( 'excerpt' == get_theme_mod( 'giottopress_blog_entries_content', 'full' ) ) ? true : false;
		$show_excerpt = ( 'standard' !== $format ) ? false : $show_excerpt;
		$show_excerpt = ( $more_tag ) ? false : $show_excerpt;

		return apply_filters( 'giottopress_show_excerpt', $show_excerpt );
	}
endif;

if ( ! function_exists( 'giottopress_pagination_class' ) ) :
	function giottopress_pagination_class() {
		$default_classes = array( 'posts-pagination', 'is-boxed' );
		$classes         = apply_filters( 'giottopress_pagination_class', $default_classes );

		echo sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) );
	}
endif;

if ( ! function_exists( 'giottopress_is_page_header_enable' ) ) :
	function giottopress_is_page_header_enable() {
		//Page Title Type
		$page_title_type = get_theme_mod( 'giottopress_page_title_type', 'content-inline' );

		if ( 'header-bottom' !== $page_title_type ) {
			return false;
		}

		//CHECK CURRENT PAGE TYPE
		//CHECK GLOBAL SETTINGS FOR PAGE HEADER

		if ( is_single() ) {
			return true;
		}

		if ( is_page() ) {
			return true;
		}

		return true;
	}
endif;

if ( ! function_exists( 'giottopress_get_featured_image' ) ) :
	function giottopress_get_featured_image() {
		add_action( 'giottopress_after_entry_header', 'giottopress_entry_featured' );
	}

	giottopress_get_featured_image();
endif;

/**
 * Footer
 */

if ( ! function_exists( 'giottopress_footer_class' ) ) :
	function giottopress_footer_class() {
		$container_type  = get_theme_mod( 'giottopress_footer_contained_type', 'fullwidth' );
		$default_classes = array( 'container' );

		if ( 'fullwidth' === $container_type ) {
			$default_classes[] = 'is-fluid';
			$default_classes[] = 'is-marginless';
		} else {
			$default_classes[] = '';
		}

		$classes = apply_filters( 'giottopress_footer_class', $default_classes );
		echo sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) );
	}
endif;

if ( ! function_exists( 'giottopress_inner_footer_class' ) ) :
	function giottopress_inner_footer_class() {
		$default_classes = array( 'container', 'footer-inner' );
		$container_type  = get_theme_mod( 'giottopress_footer_inner_contained_type', 'contained' );

		if ( 'fullwidth' === $container_type ) {
			$default_classes[] = 'is-fluid';
		}

		$classes = apply_filters( 'giottopress_footer_inner_class', $default_classes );
		echo sprintf( 'class="%s"', esc_attr( implode( ' ', $classes ) ) );
	}
endif;

if ( ! function_exists( 'giottopress_footer_bootstrap' ) ) :
	function giottopress_footer_bootstrap() {
		$footer_sidebars     = (int) get_theme_mod( 'giottopress_footer_sidebars', '0' );
		$has_active_sidebars = false;

		for ( $i = 1; $i < $footer_sidebars + 1; $i ++ ) {
			if ( is_active_sidebar( sprintf( 'footer-%1$s', $i ) ) ) {
				$has_active_sidebars = true;
			}
		}

		if ( 0 === $footer_sidebars && ! $has_active_sidebars ) {
			return;
		}
		?>
		<div id="site-footer" <?php giottopress_footer_class(); ?>>
			<div <?php giottopress_inner_footer_class(); ?>>
				<div class="columns is-marginless">
					<?php for ( $i = 1; $i < $footer_sidebars + 1; $i ++ ) : ?>
						<?php
						$column_width = get_theme_mod( sprintf( 'footer-column-width-%s', $i ), '3' );
						$custom_class = get_theme_mod( sprintf( 'footer-custom-class-%s', $i ), '' );
						$column_class = sprintf( 'column is-%s', $column_width );
						?>
						<div <?php echo sprintf( 'class="%1$s %2$s"', esc_attr( $custom_class ), esc_attr( $column_class ) ) ?>>
							<?php dynamic_sidebar( sprintf( 'footer-%1$s', $i ) ); ?>
						</div>
					<?php endfor; ?>
				</div><!-- .columns -->
			</div><!-- #inner-footer -->
		</div><!-- #site-footer -->
		<?php
	}

	add_action( 'giottopress_footer', 'giottopress_footer_bootstrap' );
endif;
