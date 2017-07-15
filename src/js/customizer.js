/* global wp */

(function ($) {
    'use strict';

    wp.customize('giotto_header_contained_type', (value) => {
        value.bind((to) => {
            const $header = $('header#masthead');

            if ('fullwidth' === to) {
                $header.addClass('is-fluid is-marginless');
            }

            if ('contained' === to) {
                $header.removeClass('is-fluid is-marginless');
            }
        });
    });

    wp.customize('giotto_header_inner_contained_type', (value) => {
        value.bind((to) => {
            const $header_inner = $('.header-inner');

            if ('fullwidth' === to) {
                $header_inner.addClass('is-fluid');
            }

            if ('contained' === to) {
                $header_inner.removeClass('is-fluid');
            }
        });
    });

    wp.customize('giotto_header_bg_color', (value) => {
        value.bind((to) => {
            const $header = $('header#masthead');
            $header.css({
                'background-color': to
            })
        });
    });

    wp.customize('giotto_header_border_bottom_color', (value) => {
        value.bind((to) => {
            const $header = $('header#masthead');
            $header.css({
                'border-bottom-color': to
            })
        });
    });

    wp.customize('giotto_header_border_bottom_height', (value) => {
        value.bind((to) => {
            const $header = $('header#masthead');
            $header.css({
                'border-bottom-width': to + 'px'
            })
        });
    });


    wp.customize('giotto_header_height', (value) => {
        value.bind((to) => {
            const $header = $('#masthead .navbar, #masthead .navbar-brand');
            $header.height(to + 'em')
        });
    });

    wp.customize('giotto_header_logo_height', (value) => {
        value.bind((to) => {
            const $logo = $('#masthead .navbar-brand .navbar-item img');
            const $burger = $('#masthead .navbar-brand .navbar-burger');
            $logo.css({
                'height': to + 'em',
                'max-height': to + 'em'
            });
            $burger.css({
                'height': to + 'em'
            });
        });
    });

    wp.customize('giotto_body_bg', (value) => {
        value.bind((to) => {
            const $body = $('body, html');
            $body.css({
                'background-color': to
            })
        });
    });

    wp.customize('giotto_content_bg', (value) => {
        value.bind((to) => {
            const $content = $('#page');
            $content.css({
                'background-color': to
            })
        });
    });

}(jQuery));