<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package giotto
 */

/* No direct access */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'giotto_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function giotto_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
		/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'giottopress' ),
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

if ( ! function_exists( 'giotto_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function giotto_entry_footer() {
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

		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'giottopress' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'giotto_entry_title' ) ):
	function giotto_entry_title() {
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
	}
endif;

if ( ! function_exists( 'giotto_entry_meta' ) ):
	function giotto_entry_meta() {
		if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
				<?php giotto_posted_on(); ?>
            </div><!-- .entry-meta -->
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'giotto_get_author_avatar' ) ):
	function giotto_get_author_avatar() {
		//TODO Add customizer setting
		$show_author_avatar = true;
		if ( true === $show_author_avatar ) {
			if ( function_exists( 'get_avatar' ) ) {
				$author_email = get_the_author_meta( 'user_email' );
				$author_link  = get_author_posts_url( get_the_author_meta( 'ID' ) );
				$template     = '<a class="author-avatar" href="%1$s">%2$s</a>';
				echo apply_filters( 'giotto/author_avatar', sprintf( $template, $author_link, get_avatar( $author_email, 60 ) ) );
			}
		}
	}
endif;

if ( ! function_exists( 'giotto_get_entry_featured' ) ):
	function giotto_get_entry_featured() {
		global $post;
		$featured_image = get_the_post_thumbnail_url( $post->ID, 'full' );
		if ( false !== $featured_image ) {
			echo sprintf( 'style="background-image: url(%s)"', $featured_image );
		}
	}
endif;

if ( ! function_exists( 'giotto_posts_navigation' ) ):
	function giotto_posts_navigation() {
		global $wp_query;
		$big        = 999999999;
		$translated = __( 'Page', 'giottopress' );
		$next_link  = '';
		$prev_link  = '';
		$pages      = array();

		$links = paginate_links( array(
			'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'             => '?paged=%#%',
			'current'            => max( 1, get_query_var( 'paged' ) ),
			'total'              => $wp_query->max_num_pages,
			'type'               => 'array',
			'before_page_number' => '<span class="screen-reader-text">' . $translated . ' </span>'
		) );

		foreach ( $links as $link ) {
			if ( strpos( $link, 'next page-numbers' ) > 0 ) {
				$out       = str_replace( 'next page-numbers', 'next page-numbers pagination-next', $link );
				$next_link = $out;
			} elseif ( strpos( $link, 'prev page-numbers' ) > 0 ) {
				$out       = str_replace( 'prev page-numbers', 'prev page-numbers pagination-previous', $link );
				$prev_link = $out;
			} else {
				$out     = str_replace( 'page-numbers', 'page-numbers pagination-next', $link );
				$pages[] = $out;
			}
		}
		?>

        <div <?php giotto_pagination_class() ?>>
            <nav class="pagination is-right">
				<?php echo $prev_link ?>
				<?php echo $next_link ?>
                <ul class="pagination-list">
					<?php foreach ( $pages as $link ): ?>
                        <li><?php echo $link ?></li>
					<?php endforeach; ?>
                </ul>
            </nav>
        </div>
		<?php
	}
endif;

if ( ! function_exists( 'giotto_more_tag' ) ):
	function giotto_more_tag( $link ) {
		return str_replace( 'more-link', 'more-link button is-primary', $link );

	}

	add_filter( 'the_content_more_link', 'giotto_more_tag' );
endif;

if ( ! function_exists( 'giotto_single_post_navigation' ) ):
	function giotto_single_post_navigation( $markup, $class ) {
		$class    .= ' pagination is-centered';
		$template = '
        <nav class="navigation pagination is-centered %1$s" role="navigation">
            <h2 class="screen-reader-text">%2$s</h2>
            %3$s
        </nav>';

		return $template;
	}

	add_filter( 'navigation_markup_template', 'giotto_single_post_navigation', 10, 2 );
endif;
