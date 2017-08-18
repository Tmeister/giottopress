<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Giotto
 */

get_header(); ?>
	<section id="primary" <?php giottopress_primary_content_class(); ?>>
		<main id="main" <?php giottopress_main_class() ?>>
			<section class="error-404 not-found has-text-centered content">
				<div class="page-content">
					<div class="columns is-centered">
						<div class="column is-two-thirds">
							<div class="notification is-info">
								<h2 class="is-size-3"><?php esc_html_e( 'Oops. The page you were looking for doesn\'t exist.', 'giottopress' ) ?></h2>
								<p class="is-size-5"><?php esc_html_e( 'You may have mistyped the address or the page may have moved.', 'giottopress' ); ?></p>
								<p class="is-size-5"><?php esc_html_e( 'You can try a new searching.', 'giottopress' ); ?></p>
								<?php
									get_search_form();
								?>
							</div>
						</div>
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</section><!-- #primary -->
<?php
do_action( 'giottopress_sidebars' );
get_footer();
