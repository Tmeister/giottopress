<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GiottoPress
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<section id="secondary" <?php giottopress_sidebar_class() ?>>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</section><!-- #secondary -->
