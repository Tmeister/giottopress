<?php
/**
 * Template part for Left Logo Menu Style
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GiottoPress
 */

?>
<nav itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" id="site-navigation" <?php giottopress_main_navigation_class(); ?>>
	<div class="navbar-brand">
		<?php giottopress_site_branding() ?>
		<?php giottopress_site_logo() ?>
		<div class="navbar-burger" data-target="main-nav-bar-menu">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<div class="navbar-menu" id="main-nav-bar-menu">
		<div class="navbar-start">
			<?php
			$nav_position = get_theme_mod( 'giottopress_navbar_alignment' );
			if ( 'left' === $nav_position ) {
				add_action( 'giottopress_navbar_start', 'giottopress_create_main_menu' );
			}
			do_action( 'giottopress_navbar_start' );
			?>
		</div>
		<div class="navbar-end">
			<?php
			$nav_position = get_theme_mod( 'giottopress_navbar_alignment', 'right' );
			if ( 'right' === $nav_position ) {
				add_action( 'giottopress_navbar_end', 'giottopress_create_main_menu' );
			}
			do_action( 'giottopress_navbar_end' );
			?>
		</div>
	</div>
</nav><!-- #site-navigation -->
