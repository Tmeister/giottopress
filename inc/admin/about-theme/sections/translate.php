<?php

/**
 * Translate
 */
?>

<div id="translate" class="giottopress-tab-pane">

	<div class="intro-head">
		<h1><?php esc_html_e( 'How can I contribute?', 'giottopress' ); ?></h1>
	</div>

	<div class="giottopress-tab-pane-half">
		<h4><?php esc_html_e( 'Are you enjoying GiottoPress?', 'giottopress' ); ?></h4>

		<p class="review-link">
			<?php
				/* translators: 1: open a tag 2: closing a tag. */
				echo sprintf( esc_html__( 'Rate our theme on %1$sWordPress.org%2$s. I\'d really appreciate it!', 'giottopress' ), '<a href="https://wordpress.org/themes/giottopress">', '</a>' );
			?>
		</p>

		<p>
			<span class="dashicons dashicons-star-filled"></span>
			<span class="dashicons dashicons-star-filled"></span>
			<span class="dashicons dashicons-star-filled"></span>
			<span class="dashicons dashicons-star-filled"></span>
			<span class="dashicons dashicons-star-filled"></span>
		</p>
	</div>

</div>
