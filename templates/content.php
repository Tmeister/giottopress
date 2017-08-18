<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GiottoPress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php do_action( 'giottopress_entry_custom_styles' ) ?>>
	<?php do_action( 'giottopress_before_entry_header' ); ?>
	<header class="entry-header">
		<?php do_action( 'giottopress_before_entry_title' ); ?>
		<?php giottopress_entry_title() ?>
		<?php do_action( 'giottopress_after_entry_title' ); ?>
		<?php giottopress_entry_meta() ?>
		<?php do_action( 'giottopress_after_entry_meta' ); ?>
	</header><!-- .entry-header -->
	<?php do_action( 'giottopress_after_entry_header' ); ?>
	<div class="entry-content is-clearfix">
		<?php do_action( 'giottopress_before_entry_content' ); ?>
		<?php
		if ( false === giottopress_show_excerpt() ) {
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'giottopress' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'giottopress' ),
				'after' => '</div>',
			) );

		} else {
			the_excerpt();
			giottopress_read_more();
		}// End if().
		?>
		<?php do_action( 'giottopress_after_entry_content' ); ?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php do_action( 'giottopress_before_entry_footer' ); ?>
		<?php giottopress_entry_footer(); ?>
		<?php do_action( 'giottopress_after_entry_footer' ); ?>
	</footer><!-- .entry-footer -->
	<?php do_action( 'giottopress_before_entry_article_close' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
