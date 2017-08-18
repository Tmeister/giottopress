<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
			while ( have_posts() ) : the_post();
				get_template_part( 'templates/content', 'page' );
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
