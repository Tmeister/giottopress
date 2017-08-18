<?php
/**
 * Template part for centered logo / menu
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GiottoPress
 */

?>
<section class="is-centered site-branding">
	<?php giottopress_site_branding() ?>
	<?php giottopress_site_logo() ?>
</section>
<section class="navbar-burger" data-target="main-nav-bar-menu">
	<span></span>
	<span></span>
	<span></span>
</section>
<section class="is-centered">
	<nav itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" id="site-navigation" <?php giottopress_main_navigation_class(); ?>>
		<div class="navbar-menu" id="main-nav-bar-menu">
			<div class="navbar-start">
				<?php
				$nav_position = get_theme_mod( 'giottopress_navbar_alignment' );
				add_action( 'giottopress_navbar_start', 'giottopress_create_main_menu' );
				do_action( 'giottopress_navbar_start' );
				?>
			</div>
		</div>
	</nav><!-- #site-navigation -->
</section>
