<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Giotto
 */

get_header(); ?>

	<section id="primary" <?php giotto_primary_content_class(); ?>>

		<main id="main" <?php giotto_main_class() ?>>

			<?php

			giotto_get_inner_page_title();

			if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'templates/content', 'search' );

				endwhile;

				giotto_posts_navigation();

			else :

				get_template_part( 'templates/content', 'none' );

			endif; ?>

		</main><!-- #main -->

	</section><!-- #primary -->

<?php

do_action( 'giotto/sidebars' );

get_footer();
