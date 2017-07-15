<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'giotto_main_navigation_class' ) ):
	function giotto_main_navigation_class() {
		$default_classes = array( 'navbar' );
		$classes         = apply_filters( 'giotto/main_navigation_class', $default_classes );
		echo sprintf( 'class="%s"', implode( ' ', $classes ) );
	}
endif;

if ( ! function_exists( 'giotto_create_main_menu' ) ):
	function giotto_create_main_menu() {
		wp_nav_menu(
			array(
				'theme_location' => 'main-menu',
				'container'      => '',
				'menu_class'     => '',
				'items_wrap'     => '%3$s',
				'walker'         => new Giotto_Custom_Walker()
			)
		);
	}
endif;

if ( ! function_exists( 'giotto_main_site_navigation' ) ):
	function giotto_main_site_navigation() {
		?>
        <nav itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" id="site-navigation" <?php giotto_main_navigation_class(); ?>>
            <div class="navbar-brand">
				<?php giotto_site_branding() ?>
				<?php giotto_site_logo() ?>
                <div class="navbar-burger" data-target="main-nav-bar-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="navbar-menu" id="main-nav-bar-menu">
                <div class="navbar-start">
					<?php
					$nav_position = get_theme_mod( 'giotto_navbar_alignment' );
					if ( 'left' === $nav_position ) {
						add_action( 'giotto/navbar_start', 'giotto_create_main_menu' );
					}
					do_action( 'giotto/navbar_start' );
					?>
                </div>
                <div class="navbar-end">
					<?php
					$nav_position = get_theme_mod( 'giotto_navbar_alignment', 'right' );
					if ( 'right' === $nav_position ) {
						add_action( 'giotto/navbar_end', 'giotto_create_main_menu' );
					}
					do_action( 'giotto/navbar_end' );
					?>
                </div>
            </div>
        </nav><!-- #site-navigation -->
		<?php
	}
endif;
