<?php

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class GiottoPress_Up_Sell {
	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {
		static $instance = null;
		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function __construct() {
	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {
		if ( ! defined( 'GIOTTO_PRO' ) ) {
			add_action( 'customize_register', array( $this, 'sections' ) );
		}
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param  object $manager
	 *
	 * @return void
	 */
	public function sections( $manager ) {
		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'inc/admin/get-pro/class-giottopress-up-sell-section-pro.php' );
		// Register custom section types.
		$manager->register_section_type( 'GiottoPress_Up_Sell_Section_Pro' );
		// Register sections.
		$manager->add_section(
			new GiottoPress_Up_Sell_Section_Pro(
				$manager,
				'giottopress_up_sell',
				array(
					'title'    => esc_html__( 'Get GiottoPress Pro!', 'giottopress' ),
					'pro_text' => esc_html__( 'Go Pro', 'giottopress' ),
					'pro_url'  => 'https://giottopress.io/go/get-pro',
				)
			)
		);
	}
}

// Doing this customizer thang!
GiottoPress_Up_Sell::get_instance();
