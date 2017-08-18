<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GiottoPress
 */

get_header(); ?>
	<section id="primary" <?php giottopress_primary_content_class(); ?>>
		<main id="main" <?php giottopress_main_class() ?>>
			<?php
			if ( have_posts() ) :
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
