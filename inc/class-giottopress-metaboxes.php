<?php
/**
 * Adds custom meta box and meta fields
 */

/* No direct access */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'GiottoPress_Metaboxes' ) ) :
	class GiottoPress_Metaboxes {

		/**
		 * @var string|array $post_type post types to add meta box to.
		 */
		public $post_type;

		/**
		 * @var string $context side|normal|advanced location of the meta box.
		 */
		public $context;

		/**
		 * @var string $priority high|low position of the meta box.
		 */
		public $priority;

		/**
		 * @var string $hook_priority priority of triggering the hook. Default is 10.
		 */
		public $hook_priority = 10;

		/**
		 * @var array $fields meta fields to be added.
		 */
		public $fields;

		/**
		 * @var string $meta_box_id meta box id.
		 */
		public $meta_box_id;

		/**
		 * @var string $label meta box label.
		 */
		public $label;

		function __construct( $args = null ) {
			$this->meta_box_id   = $args['meta_box_id'] ? $args['meta_box_id'] : 'giottopress_meta_box';
			$this->label         = $args['label'] ? $args['label'] : 'MDC Metabox';
			$this->post_type     = $args['post_type'] ? $args['post_type'] : 'post';
			$this->context       = $args['context'] ? $args['context'] : 'normal';
			$this->priority      = $args['priority'] ? $args['priority'] : 'high';
			$this->hook_priority = $args['hook_priority'] ? $args['hook_priority'] : 10;
			$this->fields        = $args['fields'] ? $args['fields'] : array();

			self::hooks();
		}

		public function hooks() {
			global $pagenow;
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ), $this->hook_priority );
			add_action( 'save_post', array( $this, 'save_meta_fields' ), 1, 2 );
			if ( 'post.php' === $pagenow || 'post-new.php' === $pagenow ) {
				add_action( 'admin_head', array( $this, 'scripts' ) );
			}

		}

		public function add_meta_box() {
			if ( is_array( $this->post_type ) ) {
				foreach ( $this->post_type as $post_type ) {
					if ( 'attachment' !== $post_type ) {
						add_meta_box( $this->meta_box_id, $this->label, array( $this, 'meta_fields_callback' ), $post_type, $this->context, $this->priority );
					}
				}
			} else {
				add_meta_box( $this->meta_box_id, $this->label, array( $this, 'meta_fields_callback' ), $this->post_type, $this->context, $this->priority );
			}
		}

		public function meta_fields_callback() {
			global $post;

			echo '<input type="hidden" name="giottopress_cmb_nonce" id="giottopress_cmb_nonce" value="' . wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

			foreach ( $this->fields as $field ) {

				if ( $field['type'] == 'text' || $field['type'] == 'number' || $field['type'] == 'email' || $field['type'] == 'url' || $field['type'] == 'password' ) {
					echo $this->field_text( $field );
				} elseif ( $field['type'] == 'textarea' ) {
					echo $this->field_textarea( $field );
				} elseif ( $field['type'] == 'radio' ) {
					echo $this->field_radio( $field );
				} elseif ( $field['type'] == 'select' ) {
					echo $this->field_select( $field );
				} elseif ( $field['type'] == 'checkbox' ) {
					echo $this->field_checkbox( $field );
				}
			}
		}

		public function save_meta_fields( $post_id, $post ) {
			if (
				! isset( $_POST['giottopress_cmb_nonce'] ) ||
				! wp_verify_nonce( $_POST['giottopress_cmb_nonce'], plugin_basename( __FILE__ ) ) ||
				! current_user_can( 'edit_post', $post->ID ) ||
				$post->post_type == 'revision'
			) {
				return $post->ID;
			}

			foreach ( $this->fields as $field ) {
				$key                 = $field['name'];
				$meta_values[ $key ] = $_POST[ $key ];
			}

			foreach ( $meta_values as $key => $value ) {
				$value = implode( ',', (array) $value );
				if ( get_post_meta( $post->ID, $key, false ) ) {
					update_post_meta( $post->ID, $key, $value );
				} else {
					add_post_meta( $post->ID, $key, $value );
				}
				if ( ! $value ) {
					delete_post_meta( $post->ID, $key );
				}
			}

		}

		public function field_text( $field ) {
			global $post;
			$field['default'] = ( isset( $field['default'] ) ) ? $field['default'] : '';
			$value            = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr( get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
			$class            = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
			$readonly         = isset( $field['readonly'] ) && ( $field['readonly'] == true ) ? " readonly" : "";
			$disabled         = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

			$html = sprintf( '<fieldset class="giotto-row" id="giottopress_cmb_fieldset_%1$s">', $field['name'] );
			$html .= sprintf( '<label class="giotto-label" for="giottopress_cmb_%1$s">%2$s</label>', $field['name'], $field['label'] );

			$html .= sprintf( '<input type="%1$s" class="%2$s" id="giottopress_cmb_%3$s" name="%3$s" value="%5$s" %6$s %7$s/>', $field['type'], $class, $field['name'], $field['name'], $value,
				$readonly,
				$disabled );

			$html .= $this->field_description( $field );
			$html .= '</fieldset>';

			return $html;
		}

		public function field_textarea( $field ) {
			global $post;
			$value    = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr( get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
			$class    = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
			$cols     = isset( $field['columns'] ) ? $field['columns'] : 24;
			$rows     = isset( $field['rows'] ) ? $field['rows'] : 5;
			$readonly = isset( $field['readonly'] ) && ( $field['readonly'] == true ) ? " readonly" : "";
			$disabled = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

			$html = sprintf( '<fieldset class="giotto-row" id="giottopress_cmb_fieldset_%1$s">', $field['name'] );
			$html .= sprintf( '<label class="giotto-label" for="giottopress_cmb_%1$s">%2$s</label>', $field['name'], $field['label'] );

			$html .= sprintf( '<textarea rows="' . $rows . '" cols="' . $cols . '" class="%1$s-text" id="giottopress_cmb_%2$s" name="%3$s" %4$s %5$s >%6$s</textarea>', $class, $field['name'],
				$field['name'],
				$readonly, $disabled, $value );

			$html .= $this->field_description( $field );
			$html .= '</fieldset>';

			return $html;
		}

		public function field_radio( $field ) {
			global $post;
			$value    = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr( get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
			$class    = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
			$disabled = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

			$html = sprintf( '<fieldset class="giotto-row" id="giottopress_cmb_fieldset_%1$s">', $field['name'] );
			$html .= '<label class="giotto-label">' . $field['label'] . '</label>';
			foreach ( $field['options'] as $key => $label ) {
				$html .= sprintf( '<label for="%1$s[%2$s]">', $field['name'], $key );

				$html .= sprintf( '<input type="radio" class="radio %1$s" id="%2$s[%3$s]" name="%2$s" value="%3$s" %4$s %5$s />', $class, $field['name'], $key, checked( $value, $key, false ),
					$disabled );

				$html .= sprintf( '%1$s</label>', $label );
			}

			$html .= $this->field_description( $field );
			$html .= '</fieldset>';

			return $html;
		}

		public function field_checkbox( $field ) {
			global $post;
			$field['default'] = ( isset( $field['default'] ) ) ? $field['default'] : '';
			$value            = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr( get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
			$class            = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
			$disabled         = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

			$html = sprintf( '<fieldset class="giotto-row" id="giottopress_cmb_fieldset_%1$s">', $field['name'] );
			$html .= sprintf( '<label class="giotto-label" for="giottopress_cmb_%1$s">%2$s</label>', $field['name'], $field['label'] );

			$html .= sprintf( '<input type="checkbox" class="checkbox" id="giottopress_cmb_%1$s" name="%1$s" value="on" %2$s %3$s />', $field['name'], checked( $value, 'on', false ), $disabled );

			$html .= $this->field_description( $field, true ) . '';
			$html .= '</fieldset>';

			return $html;
		}

		public function field_select( $field ) {
			global $post;
			$field['default'] = ( isset( $field['default'] ) ) ? $field['default'] : '';
			$value            = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr( get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
			$class            = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
			$disabled         = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";
			$multiple         = isset( $field['multiple'] ) && ( $field['multiple'] == true ) ? " multiple" : "";
			$name             = isset( $field['multiple'] ) && ( $field['multiple'] == true ) ? $field['name'] . '[]' : $field['name'];

			$html = sprintf( '<fieldset class="giotto-row" id="giottopress_cmb_fieldset_%1$s">', $field['name'] );
			$html .= sprintf( '<label class="giotto-label" for="giottopress_cmb_%1$s">%2$s</label>', $field['name'], $field['label'] );
			$html .= sprintf( '<select class="%1$s" name="%2$s" id="giottopress_cmb_%2$s" %3$s %4$s>', $class, $name, $disabled, $multiple );

			if ( $multiple == '' ) :

				foreach ( $field['options'] as $key => $label ) {
					$html .= sprintf( '<option value="%s"%s>%s</option>', $key, selected( $value, $key, false ), $label );
				}

			else:

				$values = explode( ',', $value );
				foreach ( $field['options'] as $key => $label ) {
					$selected = in_array( $key, $values ) && $key != '' ? ' selected' : '';
					$html     .= sprintf( '<option value="%s"%s>%s</option>', $key, $selected, $label );
				}

			endif;

			$html .= sprintf( '</select>' );
			$html .= $this->field_description( $field );
			$html .= '</fieldset>';

			return $html;
		}

		public function field_description( $args, $no_p = false ) {
			if ( ! empty( $args['desc'] ) ) {
				if ( isset( $args['desc_p'] ) ) {
					$desc = sprintf( '<p class="description">%s</p>', $args['desc'] );
				} else {
					$desc = sprintf( '<small class="giotto-small">%s</small>', $args['desc'] );
				}
			} else {
				$desc = '';
			}

			return $desc;
		}

		function scripts() {
			?>

			<style type="text/css">
				#giotto-post-layout label,
				#giotto-post-sidebar label {
					display: block;
					vertical-align: top;
					width: 100%;
					padding: 5px 0;
				}

				.giotto-meta-field, .giotto-meta-field-text {
					width: 100%;
				}

				.regular-text-text.giotto-url {
					width: calc(100% - 67px);
				}

				#wpbody-content .metabox-holder {
					padding-top: 5px;
				}
			</style>
			<?php
		}
	}
endif; // End Metaboxes Class
/**
 * Main function
 */
if ( ! function_exists( 'giottopress_meta_box' ) ) {
	function giottopress_meta_box( $args ) {
		return new GiottoPress_Metaboxes( $args );
	}
}

/**
 * The Metaboxes
 */
$posts_types = get_post_types( array( 'public' => true ) );

/**
 * Sidebar option metabox
 */
$sidebar_args = array(
	'meta_box_id'   => 'giotto-post-sidebar',
	'label'         => esc_attr__('Sidebar position', 'giottopress'),
	'post_type'     => $posts_types,
	'context'       => 'side',
	'priority'      => 'low',
	'hook_priority' => 10,
	'fields'        => array(
		array(
			'name'    => 'giottopress_post_sidebar',
			'label'   => '',
			'type'    => 'radio',
			'class'   => 'giotto-meta-field',
			'default' => 'global',
			'options' => array(
				'global'       => esc_attr__( 'Default', 'giottopress' ),
				'sidebar'      => esc_attr__( 'Content / Sidebar', 'giottopress' ),
				'no-sidebar'   => esc_attr__( 'Content', 'giottopress' ),
				'left-sidebar' => esc_attr__( 'Sidebar / Content', 'giottopress' ),
			),
		),
	)
);

giottopress_meta_box( $sidebar_args );

/**
 * Layout metabox
 */
$layout_args = array(
	'meta_box_id'   => 'giotto-post-layout',
	'label'         => esc_attr__('Layout', 'giottopress'),
	'post_type'     => $posts_types,
	'context'       => 'side',
	'priority'      => 'low',
	'hook_priority' => 10,
	'fields'        => array(
		array(
			'name'    => 'giottopress_post_layout',
			'label'   => '',
			'type'    => 'radio',
			'class'   => 'giotto-meta-field',
			'default' => 'global',
			'options' => array(
				'global'    => esc_attr__( 'Default', 'giottopress' ),
				'boxed'     => esc_attr__( 'Boxed', 'giottopress' ),
				'wide'      => esc_attr__( 'Wide', 'giottopress' ),
				'fullwidth' => esc_attr__( 'Fullwidth', 'giottopress' ),
			),
		),
	)
);

giottopress_meta_box( $layout_args );