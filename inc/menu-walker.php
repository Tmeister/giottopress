<?php
/**
 * Giotto_Custom_Walker
 *
 */

/* Check if Class Exists. */
if ( ! class_exists('Giotto_Custom_Walker')) {
    /**
     * Giotto_Custom_Walker class.
     *
     * @extends Walker_Nav_Menu
     */
    class Giotto_Custom_Walker extends Walker_Nav_Menu
    {
        /**
         * Start Level.
         *
         * @see Walker::start_lvl()
         * @since 3.0.0
         *
         * @access public
         *
         * @param mixed $output Passed by reference. Used to append additional content.
         * @param int $depth (default: 0) Depth of page. Used for padding.
         * @param array $args (default: array()) Arguments.
         *
         * @return void
         */
        public function start_lvl(&$output, $depth = 0, $args = array())
        {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<div class=\"navbar-dropdown is-boxed\"><!-- START LEVEL -->\n";
        }

        public function end_lvl(&$output, $depth = 0, $args = array())
        {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</div><!-- END LEVEL -->\n";
        }

        /**
         * Start El.
         *
         * @see Walker::start_el()
         * @since 3.0.0
         *
         * @access public
         *
         * @param mixed $output Passed by reference. Used to append additional content.
         * @param mixed $item Menu item data object.
         * @param int $depth (default: 0) Depth of menu item. Used for padding.
         * @param array $args (default: array()) Arguments.
         * @param int $id (default: 0) Menu item ID.
         *
         * @return void
         */
        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
        {
            $indent      = ($depth) ? str_repeat("\t", $depth) : '';
            $class_names = $this->get_item_classes($item, $args);
            $id          = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
            $id          = $id ? ' id="' . esc_attr($id) . '"' : '';
            $attributes  = $this->get_item_attributes($item, $args);
            //			$output      .= $indent . '<a itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"' . $id . $value . $class_names . '>';
            if ( ! $args->has_children) {
                $classes = empty($item->classes) ? array() : (array)$item->classes;
                if ( ! in_array('navbar-divider', $classes)) {
                    $item_output = $args->before;
                    $item_output .= '<a' . $class_names . $attributes . '>';
                    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
                    $item_output .= $args->after;
                } else {
                    $item_output = '<hr class="navbar-divider">';
                }

                $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
            } else {
                $item_output = $args->before;
                $item_output .= '<div class="navbar-item has-dropdown is-hoverable"><!-- START DROPDOWN-->' . "\n";
                $item_output .= '<a' . $class_names . $attributes . '>';
                $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
                $item_output .= $args->after;
                $item_output .= '</a>';
                $output      .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
            }

        }

        public function end_el(&$output, $item, $depth = 0, $args = array())
        {
            if ( ! in_array('menu-item-has-children', $item->classes)) {
                $output .= "</a>\n";
            } else {
                $output .= "</div><!-- END DROPDOWN-->\n";
            }
        }

        /**
         * Traverse elements to create list from elements.
         *
         * Display one element if the element doesn't have any children otherwise,
         * display the element and its children. Will only traverse up to the max
         * depth and no ignore elements under that depth.
         *
         * This method shouldn't be called directly, use the walk() method instead.
         *
         * @see Walker::start_el()
         * @since 2.5.0
         *
         * @access public
         *
         * @param mixed $element Data object.
         * @param mixed $children_elements List of elements to continue traversing.
         * @param mixed $max_depth Max depth to traverse.
         * @param mixed $depth Depth of current element.
         * @param mixed $args Arguments.
         * @param mixed $output Passed by reference. Used to append additional content.
         *
         * @return null Null on failure with no changes to parameters.
         */
        public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
        {
            if ( ! $element) {
                return;
            }
            $id_field = $this->db_fields['id'];
            // Display this element.
            if (is_object($args[0])) {
                $args[0]->has_children = ! empty($children_elements[$element->$id_field]);
            }
            parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }

        /**
         * Menu Fallback
         * =============
         * If this function is assigned to the wp_nav_menu's fallback_cb variable
         * and a menu has not been assigned to the theme location in the WordPress
         * menu manager the function with display nothing to a non-logged in user,
         * and will add a link to the WordPress menu manager if logged in as an admin.
         *
         * @param array $args passed from the wp_nav_menu function.
         */
        public static function fallback($args = array())
        {
            if (current_user_can('edit_theme_options')) {
                /* Get Arguments. */
                $container       = '';//$args['container'];
                $container_id    = '';//$args['container_id'];
                $container_class = '';//$args['container_class'];
                $menu_class      = '';//$args['menu_class'];
                $menu_id         = '';//$args['menu_id'];
                if ($container) {
                    echo '<' . esc_attr($container);
                    if ($container_id) {
                        echo ' id="' . esc_attr($container_id) . '"';
                    }
                    if ($container_class) {
                        echo ' class="' . sanitize_html_class($container_class) . '"';
                    }
                    echo '>';
                }
                echo '<ul';
                if ($menu_id) {
                    echo ' id="' . esc_attr($menu_id) . '"';
                }
                if ($menu_class) {
                    echo ' class="' . esc_attr($menu_class) . '"';
                }
                echo '>';
                echo '<li><a href="' . esc_url(admin_url('nav-menus.php')) . '" title="">' . esc_attr('Add a menu', '') . '</a></li>';
                echo '</ul>';
                if ($container) {
                    echo '</' . esc_attr($container) . '>';
                }
            }
        }

        private function get_item_classes($item, $args)
        {
            $classes     = empty($item->classes) ? array() : (array)$item->classes;
            $classes[]   = 'menu-item-' . $item->ID;
            $classes[]   = 'navbar-item';
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
            if ($args->has_children) {
                $class_names .= ' dropdown navbar-link';
            }
            if (in_array('current-menu-item', $classes, true)) {
                $class_names .= ' is-active';
            }

            return $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        }

        private function get_item_attributes($item, $args)
        {
            $atts = array();
            if (empty($item->attr_title)) {
                $atts['title'] = ! empty($item->title) ? strip_tags($item->title) : '';
            } else {
                $atts['title'] = $item->attr_title;
            }
            $atts['target'] = ! empty($item->target) ? $item->target : '';
            $atts['rel']    = ! empty($item->xfn) ? $item->xfn : '';
            $atts['href']   = ! empty($item->url) ? $item->url : '';
            $atts           = apply_filters('nav_menu_link_attributes', $atts, $item, $args);
            $attributes     = '';
            foreach ($atts as $attr => $value) {
                if ( ! empty($value)) {
                    $value      = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            return $attributes;
        }
    }
} // End if().