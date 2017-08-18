<?php

/**
 * Getting started template
 */

$customizer_url = wp_customize_url();
?>

<div id="getting_started" class="giottopress-tab-pane active">

	<div class="content-info-about">

		<div class="intro-head">
			<h1 class="giottopress-welcome-title">
				<?php esc_html_e( 'Welcome to GiottoPress!', 'giottopress' ); ?>
				<?php if ( ! empty( $giottopress_lite['Version'] ) ) : ?>
					<sup id="giottopress-theme-version">
						<?php echo esc_attr( $giottopress_lite['Version'] ); ?>
					</sup>
				<?php endif; ?>
			</h1>
			<p><?php esc_html_e( 'I want to make sure you have the best experience using GiottoPress and that is why I gathered here all the necessary information for you. I hope you will enjoy using GiottoPress, as much as I enjoy creating great products.','giottopress' ); ?>
		</div>

		<div class="giottopress-tab-pane-center column column-3">
			<div class="inner-info">
				<h1><?php esc_html_e( 'Getting started', 'giottopress' ); ?></h1>
				<h4><?php esc_html_e( 'Customize everything in a single place.', 'giottopress' ); ?></h4>
				<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'giottopress' ); ?></p>
				<p><a href="<?php echo esc_url( $customizer_url ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'giottopress' ); ?></a></p>
			</div>
		</div>

		<div class="giottopress-tab-pane-center column column-3">
			<div class="inner-info">
				<h1><?php esc_html_e( 'Need more features?', 'giottopress' ); ?></h1>
				<h4><?php esc_html_e( 'Check our premium version for this theme.', 'giottopress' ); ?></h4>
				<p><?php esc_html_e( 'Check out the Premium version of this theme which comes with additional features and advanced customization.', 'giottopress' ); ?></p>
				<p><a href="https://giottopress.io/go/get-pro" class="button button-primary"><?php esc_html_e( 'Get Premium Version', 'giottopress' ); ?></a></p>
			</div>
		</div>

		<div class="giottopress-tab-pane-center column column-3">
			<div class="inner-info">
				<h1><?php esc_html_e( 'Documentation', 'giottopress' ); ?></h1>
				<h4><?php esc_html_e( 'How to install this theme in a few minutes.', 'giottopress' ); ?></h4>
				<p><?php esc_html_e( 'Please read the online documentation page to setup this theme. It only takes a few minutes on a clean WordPress install.', 'giottopress' ); ?></p>
				<p><a href="https://giottopress.io/go/install" class="button button-primary"><?php esc_html_e( 'Read Documentation', 'giottopress' ); ?></a></p>
			</div>
		</div>
	</div>
</div>
