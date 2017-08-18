<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GiottoPress
 */

/* No direct access */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>
	<body <?php giottopress_body_schema(); ?> <?php body_class(); ?>>
		<?php do_action( 'giottopress_before_header' ); ?>
		<?php do_action( 'giottopress_header' ); ?>
		<?php do_action( 'giottopress_after_header' ); ?>
		<div id="page" <?php giottopress_page_class(); ?>>
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'giottopress' ); ?></a>
			<div id="content" <?php giottopress_content_class(); ?>>
				<?php do_action( 'giottopress_inside_container' ); ?>
				<div id="wrapper" <?php giottopress_wrapper_class(); ?>>
