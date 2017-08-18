<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GiottoPress
 */

get_header(); ?>
	<section id="primary" <?php giottopress_primary_content_class(); ?>>
		<main id="main" <?php giottopress_main_class() ?>>
			<?php
			giottopress_get_inner_page_title();
			if ( have_posts() ) : ?>
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'templates/content', get_post_format() );
				endwhile;
				the_posts_pagination();
			else :
				get_template_part( 'templates/content', 'none' );
			endif; ?>
		</main><!-- #main -->
	</section><!-- #primary -->
<?php
do_action( 'giottopress_sidebars' );
get_footer();
