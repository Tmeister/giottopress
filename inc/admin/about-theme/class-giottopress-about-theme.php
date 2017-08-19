<?php

/**
 * About Theme GiottoPress
 */
class Giottopress_About_Theme {
	/**
	 * Constructor for the about theme section
	 */
	public function __construct() {
		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'giottopress_about_register_menu' ) );
		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'giottopress_activation_admin_notice' ) );
		/* enqueue script and style for about theme section */
		add_action( 'admin_enqueue_scripts', array( $this, 'giottopress_about_style_and_scripts' ) );
		/* load about theme section */
		add_action( 'giottopress_about', array( $this, 'giottopress_about_getting_started' ), 10 );
		add_action( 'giottopress_about', array( $this, 'giottopress_about_translate' ), 40 );
		/* ajax callback for dismissible required actions */
		add_action( 'wp_ajax_giottopress_dismiss_required_action', array( $this, 'giottopress_dismiss_required_action_callback' ) );
	}

	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 * @since 1.0.0
	 */
	public function giottopress_about_register_menu() {
		add_theme_page( 'GiottoPress', 'GiottoPress', 'activate_plugins', 'giottopress-about', array( $this, 'giottopress_about_screen' ) );
	}

	/**
	 * Adds an admin notice upon successful activation.
	 * @since 1.0.0
	 */
	public function giottopress_activation_admin_notice() {
		global $pagenow;
		if ( is_admin() && ( 'themes.php' == $pagenow ) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'giottopress_about_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the about theme section
	 * @since 1.0.0
	 */
	public function giottopress_about_admin_notice() {
		?>
		<div class="updated notice is-dismissible">
			<p>
				<?php
				echo sprintf(
					/* translators: 1: open a tag 2: close a tag*/
					esc_html__( 'Hi! Thank you for choosing GiottoPress! To fully take advantage of the theme please make sure you visit our %1$swelcome page%2$s.', 'giottopress' ),
					'<a href="' . esc_url( admin_url( 'themes.php?page=giottopress-about' ) ) . '">', '</a>'
				); ?>
			</p>
			<p>
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=giottopress-about' ) ); ?>" class="button" style="text-decoration: none;">
					<?php esc_html_e( 'Get started with GiottoPress', 'giottopress' ); ?>
				</a>
			</p>
		</div>
		<?php
	}

	/**
	 * Load about theme section css and javascript
	 * @since  1.0.0
	 */
	public function giottopress_about_style_and_scripts( $hook_suffix ) {
		if ( 'appearance_page_giottopress-about' == $hook_suffix ) {
			wp_enqueue_style( 'giottopress-about-theme-css', get_template_directory_uri() . '/inc/admin/about-theme/css/about.css' );
			wp_enqueue_script( 'giottopress-about-theme-js', get_template_directory_uri() . '/inc/admin/about-theme/js/about.js', array( 'jquery' ) );
		}
	}

	/**
	 * Welcome screen content
	 * @since 1.0.0
	 */
	public function giottopress_about_screen() {
		?>

		<ul class="giottopress-nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting started', 'giottopress' ); ?></a>
			</li>
			<li role="presentation"><a href="#translate" aria-controls="translate" role="tab" data-toggle="tab"><?php esc_html_e( 'Contribute', 'giottopress' ); ?></a></li>
		</ul>

		<div class="giottopress-tab-content">

			<?php
			/**
			 * @hooked giottopress_about_getting_started - 10
			 * @hooked giottopress_about_actions_required - 20
			 * @hooked giottopress_about_child_themes - 30
			 * @hooked giottopress_about_translate - 40
			 */
			do_action( 'giottopress_about' ); ?>

		</div>
		<div class="clear"></div>
		<div class="giottopress-footer">
			<span>Made with <span style="color:#D04848" class="dashicons dashicons-heart"></span> by Enrique Chavez</span>
		</div>
		<?php
	}

	/**
	 * Getting started
	 * @since 1.0.0
	 */
	public function giottopress_about_getting_started() {
		require_once( get_template_directory() . '/inc/admin/about-theme/sections/getting-started.php' );
	}

	/**
	 * Contribute
	 * @since 1.0.0
	 */
	public function giottopress_about_translate() {
		require_once( get_template_directory() . '/inc/admin/about-theme/sections/translate.php' );
	}
}

new Giottopress_About_Theme();
