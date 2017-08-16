<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Giotto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php do_action('giotto/entry_custom_styles') ?>>

    <?php do_action('giotto/before_entry_header'); ?>

    <header class="entry-header">

        <?php do_action('giotto/before_entry_title'); ?>

        <?php giotto_entry_title() ?>

        <?php do_action('giotto/after_entry_title'); ?>

        <?php giotto_entry_meta() ?>

        <?php do_action('giotto/after_entry_meta'); ?>

    </header><!-- .entry-header -->

    <?php do_action('giotto/after_entry_header'); ?>

    <div class="entry-content">

        <?php do_action('giotto/before_entry_content'); ?>

        <?php

        if (false === giotto_show_excerpt()) {

            the_content(sprintf(

                wp_kses(

                /* translators: %s: Name of current post. Only visible to screen readers */

                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'giottopress'),

                    array(

                        'span' => array(

                            'class' => array(),

                        ),

                    )

                ),

                get_the_title()

            ));

            wp_link_pages(array(

                'before' => '<div class="page-links">' . esc_html__('Pages:', 'giottopress'),

                'after' => '</div>',

            ));

        } else {

            the_excerpt();

            giotto_read_more();

        }

        ?>

        <?php do_action('giotto/after_entry_content'); ?>

    </div><!-- .entry-content -->
    <footer class="entry-footer">
        <?php do_action('giotto/before_entry_footer'); ?>
        <?php giotto_entry_footer(); ?>
        <?php do_action('giotto/after_entry_footer'); ?>
    </footer><!-- .entry-footer -->

    <?php do_action('giotto/before_entry_article_close'); ?>

</article><!-- #post-<?php the_ID(); ?> -->
