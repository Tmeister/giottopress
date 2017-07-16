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
 * @package giotto
 */

get_header(); ?>

    <section id="primary" <?php giotto_primary_content_class(); ?>>
        <main id="main" <?php giotto_main_class() ?>>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', get_post_format() );

				//TODO ADD Post Navigation Option from Customizer
				the_post_navigation();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

        </main><!-- #main -->
    </section><!-- #primary -->

<?php
do_action( 'giotto/sidebars' );
get_footer();