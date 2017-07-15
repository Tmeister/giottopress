<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package giotto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php giotto_get_entry_featured() ?>>

	<?php do_action( 'giotto/before_entry_header' ); ?>

    <header class="entry-header">
		<?php giotto_get_author_avatar() ?>
		<?php do_action( 'giotto/before_entry_title' ); ?>
		<?php giotto_entry_title() ?>
		<?php do_action( 'giotto/after_entry_title' ); ?>
		<?php giotto_entry_meta() ?>
    </header><!-- .entry-header -->

	<?php do_action( 'giotto/after_entry_header' ); ?>

    <div class="entry-content">
		<?php
		if ( false === giotto_show_excerpt() ) {
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'giottopress' ),
				'after'  => '</div>',
			) );
		} else {
			the_excerpt();
		}
		?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
		<?php giotto_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
