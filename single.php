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
			while ( have_posts() ) : the_post();
				get_template_part( 'templates/content', get_post_format() );
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</section><!-- #primary -->
<?php
do_action( 'giottopress_sidebars' );
get_footer();
