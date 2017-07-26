<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package giotto
 */

if ( ! is_active_sidebar('sidebar-1')) {

    return;
}

?>

<section id="secondary" <?php giotto_sidebar_class() ?>>

    <?php dynamic_sidebar('sidebar-1'); ?>

</section><!-- #secondary -->