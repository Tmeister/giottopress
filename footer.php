<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GiottoPress
 */

/* No direct access */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

		</div><!-- #wrapper -->
	</div><!-- #content -->
</div><!-- #page -->

<?php do_action( 'giottopress_before_footer' ); ?>
<?php do_action( 'giottopress_footer' ) ?>
<?php do_action( 'giottopress_after_footer' ); ?>
<?php wp_footer(); ?>
</body><!-- body -->
</html><!-- html -->
