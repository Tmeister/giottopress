<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package giotto
 */

/* No direct access */
if ( ! defined('ABSPATH')) {
    exit;
}
?>

</div><!-- #wrapper -->

</div><!-- #content -->

</div><!-- #page -->

<?php do_action('giotto/before_footer'); ?>

<?php do_action('giotto/footer') ?>

<?php do_action('giotto/after_footer'); ?>

<?php wp_footer(); ?>

</body><!-- body -->

</html><!-- html -->