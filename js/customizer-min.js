"use strict";!function($){wp.customize("giotto_header_contained_type",function(t){t.bind(function(t){var n=$("header#masthead");"fullwidth"===t&&n.addClass("is-fluid is-marginless"),"contained"===t&&n.removeClass("is-fluid is-marginless")})}),wp.customize("giotto_header_inner_contained_type",function(t){t.bind(function(t){var n=$(".header-inner");"fullwidth"===t&&n.addClass("is-fluid"),"contained"===t&&n.removeClass("is-fluid")})}),wp.customize("giotto_header_bg_color",function(t){t.bind(function(t){$("header#masthead").css({"background-color":t})})}),wp.customize("giotto_header_border_bottom_color",function(t){t.bind(function(t){$("header#masthead").css({"border-bottom-color":t})})}),wp.customize("giotto_header_border_bottom_height",function(t){t.bind(function(t){$("header#masthead").css({"border-bottom-width":t+"px"})})}),wp.customize("giotto_header_height",function(t){t.bind(function(t){$("#masthead .navbar, #masthead .navbar-brand").height(t+"em")})}),wp.customize("giotto_header_logo_height",function(t){t.bind(function(t){var n=$("#masthead .navbar-brand .navbar-item img"),o=$("#masthead .navbar-brand .navbar-burger");n.css({height:t+"em","max-height":t+"em"}),o.css({height:t+"em"})})}),wp.customize("giotto_body_bg",function(t){t.bind(function(t){$("body, html").css({"background-color":t})})}),wp.customize("giotto_content_bg",function(t){t.bind(function(t){$("#page").css({"background-color":t})})}),wp.customize("giotto_transparent_top_content_padding",function(t){t.bind(function(t){$("#page").css({"padding-top":t+"px"})})}),wp.customize("giotto_primary_menu_color",function(t){t.bind(function(t){var n=$(".header-minimal #masthead .navbar .menu-item:not(.is-active), .header-transparent #masthead .navbar .menu-item:not(.is-active)");console.log(n),n.css({color:t})})}),wp.customize("giotto_primary_menu_current_color",function(t){t.bind(function(t){$(".header-minimal #masthead .navbar .menu-item.is-active, .header-transparent #masthead .navbar .menu-item.is-active").css({color:t})})}),wp.customize("giotto_primary_menu_sub_color",function(t){t.bind(function(t){$(".header-minimal #masthead .navbar .navbar-dropdown .menu-item, .header-transparent #masthead .navbar .navbar-dropdown .menu-item").css({color:t})})})}(jQuery);