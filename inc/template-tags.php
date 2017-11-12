<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package GiottoPress
 */

/* No direct access */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'giottopress_posted_on' ) ) :
	function giottopress_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		$posted_on = sprintf(
			'%s',
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
		/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'giottopress' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'giottopress_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function giottopress_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'giottopress' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'giottopress' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'giottopress' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'giottopress' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
					/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'giottopress' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'giottopress_entry_title' ) ) :
	function giottopress_entry_title() {
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
	}
endif;

if ( ! function_exists( 'giottopress_entry_meta' ) ) :
	function giottopress_entry_meta() {
		if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php giottopress_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'giottopress_get_author_avatar' ) ) :
	function giottopress_get_author_avatar() {
		//TODO Add customizer setting
		$show_author_avatar = true;
		if ( true === $show_author_avatar ) {
			if ( function_exists( 'get_avatar' ) ) {
				$author_email = get_the_author_meta( 'user_email' );
				$author_link  = get_author_posts_url( get_the_author_meta( 'ID' ) );
				$template     = '<a class="author-avatar" href="%1$s">%2$s</a>';
				echo apply_filters( 'giottopress_author_avatar', sprintf( $template, $author_link, get_avatar( $author_email, 60 ) ) );
			}
		}
	}
endif;

if ( ! function_exists( 'giottopress_entry_featured' ) ) :
	function giottopress_entry_featured() {
		global $post;

		$show_image = 'show' === get_theme_mod( 'giottopress_blog_entry_featured', 'hide' ) ? true : false;

		if ( ! apply_filters( 'giottopress_show_featured_image', $show_image ) ) {
			return;
		}

		$featured_image = get_the_post_thumbnail_url( $post->ID, 'full' );

		if ( false !== $featured_image ) {
			?>
			<div class="entry-featured-image">
				<img src="<?php echo $featured_image ?>" alt="<?php the_title() ?>">
			</div>
			<?php
		}
	}
endif;

if ( ! function_exists( 'giottopress_more_tag' ) ) :
	function giottopress_more_tag( $link ) {
		return str_replace( 'more-link', 'more-tag button', $link );

	}

	add_filter( 'the_content_more_link', 'giottopress_more_tag' );
endif;

if ( ! function_exists( 'giottopress_single_post_navigation' ) ) :
	function giottopress_single_post_navigation( $markup, $class ) {
		$template = '
        <nav class="navigation is-centered %1$s" role="navigation">
            <h2 class="screen-reader-text">%2$s</h2>
            %3$s
        </nav>';

		return $template;
	}

	add_filter( 'navigation_markup_template', 'giottopress_single_post_navigation', 10, 2 );
endif;

if ( ! function_exists( 'giottopress_get_page_header' ) ) :
	function giottopress_get_page_header() {
		?>
		<section <?php giottopress_page_title_class(); ?>>
			<header <?php giottopress_page_title_inner_class(); ?>>
				<div class="wrapper columns is-vcentered">
					<div class="column is-half-desktop is-12 page-title-left">
						<?php do_action( 'giottopress_before_page_title' ) ?>
						<?php do_action( 'giottopress_page_title' ) ?>
						<?php do_action( 'giottopress_after_page_title' ) ?>
					</div>
					<div class="column is-half-desktop is-12">
						<div class="page-title-right">
							<?php do_action( 'giottopress_page_title_right' ) ?>
						</div>
					</div>
				</div>
			</header><!-- .page-header -->
		</section>
		<?php
	}
endif;

if ( ! function_exists( 'giottopress_read_more' ) ) :
	function giottopress_read_more() {
		global $post;
		$output = '<div class="entry-read-more"><a class="more-tag button" href="%s">%s</a></div>';

		echo sprintf( $output, esc_url( get_permalink( $post->ID ) ), esc_attr( __( 'Continue Reading', 'giottopress' ) ) );
	}
endif;

/**
 * Page Header
 */

if ( ! function_exists( 'giottopress_page_header' ) ) :
	function giottopress_page_header() {
		if ( giottopress_is_page_header_enable() ) {
			giottopress_get_page_header();
		}
	}

	add_action( 'giottopress_after_header', 'giottopress_page_header' );
endif;

if ( ! function_exists( 'giottopress_get_inner_page_title' ) ) :
	function giottopress_get_inner_page_title() {
		$page_title_type = get_theme_mod( 'giottopress_page_title_type', 'content-inline' );
		if ( 'content-inline' !== $page_title_type ) {
			return;
		}

		do_action( 'giottopress_before_page_title' );
		?>
		<div class="inline-page-title">
			<?php giottopress_get_page_title(); ?>
		</div>
		<?php
		do_action( 'giottopress_after_page_title' );

	}
endif;

if ( ! function_exists( 'giottopress_get_page_title' ) ) :
	function giottopress_get_page_title() {
		if ( is_home() ) {
			$output = '<h2 class="page-title">%s</h2>';
			echo sprintf( $output, esc_html__( get_theme_mod( 'giottopress_page_title_front_page' ) ) );

			return;
		}

		if ( is_archive() ) {
			$archive_title       = sprintf( '<h1 class="page-title">%s</h1>', get_the_archive_title() );
			$archive_description = '';
			$description         = get_the_archive_description();

			if ( ! empty( $description ) ) {
				$archive_description = sprintf( '<div class="page-subtitle">%s</div>', $description );
			}

			echo $archive_title . $archive_description;

			return;
		}

		if ( is_search() ) {
			$output = '<h1 class="page-title">%s</h1>';

			echo sprintf(
				$output,
				sprintf(
					esc_html__( 'Search Results for: %s', 'giottopress' ),
					'<span>' . get_search_query() . '</span>'
				)
			);

			return;
		}

		if ( is_404() ) {
			$output = '<h1 class="page-title">%s</h1>';
			echo sprintf( $output, __( '404: Page Not Found', 'giottopress' ) );

			return;
		}

		if ( is_page() ) {

			$output = '<h1 class="page-title">%s</h1>';

			echo sprintf( $output, get_the_title() );

			return;
		}

		echo sprintf( '<h2 class="page-title">%s</h2>', esc_html( get_theme_mod( 'giottopress_page_title_blog', __( 'Blog', 'giottopress' ) ) ) );

	}

	add_action( 'giottopress_page_title', 'giottopress_get_page_title' );
endif;

/**
 * Footer
 */
if ( ! function_exists( 'giottopress_site_credits' ) ) :
	function giottopress_site_credits() {
		if ( apply_filters( 'giottopress_show_credits', true ) === false ) {
			return;
		}
		$credits = apply_filters(
			'giottopress_site_credits',
			sprintf(
				'%1$s %2$s <a href="%3$s">%4$s</a>',
				'GiottoPress',
				__( 'by', 'giottopress' ),
				'https://enriquechavez.co',
				__( 'Enrique Chavez', 'giottopress' )
			)
		);

		$template = '
        <div class="site-credits">
            <div class="container">
                <div class="content has-text-centered">
                    <p>
                        %s
                    </p>
                </div>
            </div>
        </div>';

		echo sprintf( $template, $credits );
	}

	add_action( 'giottopress_after_footer', 'giottopress_site_credits' );
endif;
