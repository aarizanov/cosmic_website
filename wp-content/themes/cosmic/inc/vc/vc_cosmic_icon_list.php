<?php
class CosmicIconList extends WPBakeryShortCode {

	public $shortcode_name = 'Cosmic Icon List';
	public $shortcode_slug = 'cosmic_icon_list';

	function __construct() {
		// We safely integrate with VC with this hook
		add_action( 'init', array( $this, 'register_composer_fields' ) );
		// Use this when creating a shortcode output
		add_shortcode( $this->shortcode_slug, array( $this, 'render_shortcode' ) );
		// Register CSS and JS
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	// Load Required Css And Js files
	public function enqueue() {

	}

	public function register_composer_fields() {
		$args = array(
			'name' => $this->shortcode_name,
			'base' => $this->shortcode_slug,
			'class' => '',
			'category' => __( 'Cosmic Widgets', 'cosmic' ),
			'params' => array(
				array(
					'type'		=> 'dropdown',
					'heading'	  => esc_html__( 'List type', 'cosmic' ),
					'param_name'  => 'list_type',
					'value' => array(
						'Vertical' => 'ul',
						'Horizontal' => 'div',
					),
					'admin_label' => false,
					'std' => 'ul',
				),
				array(
					'type'		=> 'dropdown',
					'heading'	  => esc_html__( 'Items per row', 'cosmic' ),
					'param_name'  => 'list_class',
					'value' => array(
						'2 items' => 'vc_col-sm-6',
						'3 items' => 'vc_col-sm-4',
						'4 items' => 'vc_col-sm-3',
						'6 items' => 'vc_col-sm-2',
					),
					'dependency' => array(
						'element' => 'list_type',
						'value' => 'div',
					),
					'std' => 'vc_col-sm-6',
					'admin_label' => false,
					'save_always' => true,
				),
				array(
					'type' => 'param_group',
					'param_name' => 'items_repeater',
					'save_always' => true,
					'heading'	  => esc_html__( 'Add list items', 'cosmic' ),
					'params' => array(
						array(
							'type'		=> 'dropdown',
							'heading'	  => esc_html__( 'Font library: ', 'cosmic' ),
							'param_name'  => 'icon_font_type',
							'admin_label' => true,
							'value'		 => array(
								esc_html( 'Font Awesome' ) => 'fontawesome',
								esc_html( 'Open Iconic' ) => 'openiconic',
								esc_html( 'Typicons' ) => 'typicons',
								esc_html( 'Entypo' ) => 'entypo',
								esc_html( 'Linecons' ) => 'linecons',
								esc_html( 'Mono Social' ) => 'monosocial',
								esc_html( 'Material' ) => 'material',
							),
							'std' => 'fontawesome',
							'admin_label' => true,
							'save_always' => true,
						),
						array(
							'type' => 'iconpicker',
							'heading' => esc_html__( 'Icon', 'cosmic' ),
							'param_name' => 'icon_fontawesome',
							'settings' => array(
								'emptyIcon' => false,
								'type' => 'fontawesome',
								'iconsPerPage' => 200,
							),
							'dependency' => array(
								'element' => 'icon_font_type',
								'value' => 'fontawesome',
							),
						),
						array(
							'type' => 'iconpicker',
							'heading' => esc_html__( 'Icon', 'cosmic' ),
							'param_name' => 'icon_openiconic',
							'settings' => array(
								'emptyIcon' => false,
								'type' => 'openiconic',
								'iconsPerPage' => 200,
							),
							'dependency' => array(
								'element' => 'icon_font_type',
								'value' => 'openiconic',
							),
						),
						array(
							'type' => 'iconpicker',
							'heading' => esc_html__( 'Icon', 'cosmic' ),
							'param_name' => 'icon_typicons',
							'settings' => array(
								'emptyIcon' => false,
								'type' => 'typicons',
								'iconsPerPage' => 200,
							),
							'dependency' => array(
								'element' => 'icon_font_type',
								'value' => 'typicons',
							),
						),
						array(
							'type' => 'iconpicker',
							'heading' => esc_html__( 'Icon', 'cosmic' ),
							'param_name' => 'icon_entypo',
							'settings' => array(
								'emptyIcon' => false,
								'type' => 'entypo',
								'iconsPerPage' => 200,
							),
							'dependency' => array(
								'element' => 'icon_font_type',
								'value' => 'entypo',
							),
						),
						array(
							'type' => 'iconpicker',
							'heading' => esc_html__( 'Icon', 'cosmic' ),
							'param_name' => 'icon_linecons',
							'settings' => array(
								'emptyIcon' => false,
								'type' => 'linecons',
								'iconsPerPage' => 200,
							),
							'dependency' => array(
								'element' => 'icon_font_type',
								'value' => 'linecons',
							),
						),
						array(
							'type' => 'iconpicker',
							'heading' => esc_html__( 'Icon', 'cosmic' ),
							'param_name' => 'icon_monosocial',
							'settings' => array(
								'emptyIcon' => false,
								'type' => 'monosocial',
								'iconsPerPage' => 200,
							),
							'dependency' => array(
								'element' => 'icon_font_type',
								'value' => 'monosocial',
							),
						),
						array(
							'type' => 'iconpicker',
							'heading' => esc_html__( 'Icon', 'cosmic' ),
							'param_name' => 'icon_material',
							'settings' => array(
								'emptyIcon' => false,
								'type' => 'material',
								'iconsPerPage' => 200,
							),
							'dependency' => array(
								'element' => 'icon_font_type',
								'value' => 'material',
							),
						),
						array(
							'type'		=> 'colorpicker',
							'heading'	  => esc_html__( 'Icon color: ', 'cosmic' ),
							'param_name'  => 'color',
							'admin_label' => true,
							'save_always' => true,
						),
						array(
							'type'		=> 'textfield',
							'heading'	  => esc_html__( 'Icon size ( in px ): ', 'cosmic' ),
							'param_name'  => 'icon_size',
							'admin_label' => true,
							'save_always' => true,
						),
						array(
							'type'		=> 'textarea',
							'heading'	  => esc_html__( 'Text', 'cosmic' ),
							'param_name'  => 'text',
							'admin_label' => false,
						),
						array(
							'type'		=> 'colorpicker',
							'heading'	  => esc_html__( 'Text color: ', 'cosmic' ),
							'param_name'  => 'text_color',
							'admin_label' => true,
						),
					),
				),
				array(
					'type' => 'animation_style',
					'heading' => __( 'Animation Style', 'cosmic' ),
					'param_name' => 'animation',
					'description' => __( 'Choose your animation style', 'cosmic' ),
					'admin_label' => false,
				),
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Element Class', 'cosmic' ),
					'param_name'  => 'class',
					'admin_label' => false,
					'description' => 'Additional element css class',
				),
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Element Id', 'cosmic' ),
					'param_name'  => 'id',
					'admin_label' => true,
					'description' => 'Additional element css id',
				),
				array(
					'type' => 'css_editor',
					'heading' => esc_html__( 'Css', 'cosmic' ),
					'param_name' => 'css',
					'group' => esc_html__( 'Design options', 'cosmic' ),
				),
			),
		);
		vc_map( $args );
	}

	// Shortcode logic how it should be rendered
	public function render_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'list_type' => '',
			'list_class' => '',
			'items_repeater' => '',
			'animation' => '',
			'class' => '',
			'id' => '',
			'css' => '',
		), $atts ) );

		// Empty and default vars
		$output = $list_items = $list = $container_tag = $container_class = $parent_class = '';
		$dots = $arrows = 'false';
		$shortcode_id = str_replace( '.', '', uniqid( $this->shortcode_slug, true ) );
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), false , $atts );
		$animation_classes = $this->getCSSAnimation( $animation );

		$css_classes = array();

		// Create css classes
		$css_classes[] = 'widget_'.esc_attr( $this->shortcode_slug );
		$css_classes[] = $css_class;
		$css_classes[] = $class;
		// Additional element id
		if ( $id ) { $shortcode_id = $id; }
		
		ob_start();

		// List type backup
		if ( ! $list_type ) {
			$list_type = 'ul';
		}

		// List class backup
		if ( ! $list_class ) {
			$list_class = 'vc_col-sm-6';
		}

		// Defining list items classes and containers
		if ( 'ul' === $list_type ) {
			$container_tag = 'li';
			$container_class = 'list_item li_list_item';
			$parent_class = 'list-unstyled';
		} elseif ( 'div' === $list_type ) {
			$container_tag = 'div';
			$container_class = 'list_item div_list_item '.$list_class;
			$parent_class = 'vc_row';
		}

		// Defining list items
		if ( $items_repeater ) {
			$items_array = vc_param_group_parse_atts( $items_repeater );
			if ( isset( $items_array ) && ! empty( $items_array ) && is_array( $items_array ) ) {
				foreach ( $items_array as $group_item_array ) {
					if ( isset( $group_item_array ) && ! empty( $group_item_array ) && is_array( $group_item_array ) ) {
						$icon_font_type = $color = $text = $text_color = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_monosocial = $icon_material = $icon_class = $icon_size = '';
						// Defining icon vars
						if ( array_key_exists( 'icon_fontawesome', $group_item_array ) ) {
							$icon_fontawesome = $group_item_array['icon_fontawesome'];
						}
						if ( array_key_exists( 'icon_openiconic', $group_item_array ) ) {
							$icon_openiconic = $group_item_array['icon_openiconic'];
						}
						if ( array_key_exists( 'icon_typicons', $group_item_array ) ) {
							$icon_typicons = $group_item_array['icon_typicons'];
						}
						if ( array_key_exists( 'icon_entypo', $group_item_array ) ) {
							$icon_entypo = $group_item_array['icon_entypo'];
						}
						if ( array_key_exists( 'icon_linecons', $group_item_array ) ) {
							$icon_linecons = $group_item_array['icon_linecons'];
						}
						if ( array_key_exists( 'icon_monosocial', $group_item_array ) ) {
							$icon_monosocial = $group_item_array['icon_monosocial'];
						}
						if ( array_key_exists( 'icon_material', $group_item_array ) ) {
							$icon_material = $group_item_array['icon_material'];
						}
						// Defining icon type
						if ( array_key_exists( 'icon_font_type', $group_item_array ) ) {
							$icon_font_type = $group_item_array['icon_font_type'];
						}
						// Defining icon size
						if ( array_key_exists( 'icon_size', $group_item_array ) ) {
							$icon_size = intval( $group_item_array['icon_size'] );
						}
						if ( ! $icon_size ) {
							$icon_size = 16;
						}
						// Defininng text and text/icon colors
						if ( array_key_exists( 'color', $group_item_array ) ) {
							$color = 'style="color:'.esc_attr( $group_item_array['color'] ).'"';
						}
						if ( array_key_exists( 'text_color', $group_item_array ) ) {
							$text_color = 'style="color:'.esc_attr( $group_item_array['text_color'] ).'"';
						}
						if ( array_key_exists( 'text', $group_item_array ) ) {
							$text = '<div class="text" '.$text_color.'>'.wp_kses_post( $group_item_array['text'] ).'</div>';
						}
						// Switch to enqueue proper icon styles
						switch ( $icon_font_type ) {
							case 'fontawesome':
								vc_icon_element_fonts_enqueue( $icon_font_type );
								if ( isset( $icon_fontawesome ) && ! empty( $icon_fontawesome ) ) { $icon_class = $icon_fontawesome; } else { $icon_class = 'fa fa-instagram'; }
								break;
							case 'openiconic':
								vc_icon_element_fonts_enqueue( $icon_font_type );
								if ( isset( $icon_openiconic ) && ! empty( $icon_openiconic ) ) { $icon_class = $icon_openiconic; } else { $icon_class = 'vc-oi vc-oi-dial'; }
								break;
							case 'typicons':
								vc_icon_element_fonts_enqueue( $icon_font_type );
								if ( isset( $icon_typicons ) && ! empty( $icon_typicons ) ) { $icon_class = $icon_typicons; } else { $icon_class = 'typcn typcn-adjust-brightness'; }
								break;
							case 'entypo':
								vc_icon_element_fonts_enqueue( $icon_font_type );
								if ( isset( $icon_entypo ) && ! empty( $icon_entypo ) ) { $icon_class = $icon_entypo; } else { $icon_class = 'entypo-icon entypo-icon-note'; }
								break;
							case 'linecons':
								vc_icon_element_fonts_enqueue( $icon_font_type );
								if ( isset( $icon_linecons ) && ! empty( $icon_linecons ) ) { $icon_class = $icon_linecons; } else { $icon_class = 'vc_li vc_li-heart'; }
								break;
							case 'monosocial':
								vc_icon_element_fonts_enqueue( $icon_font_type );
								if ( isset( $icon_monosocial ) && ! empty( $icon_monosocial ) ) { $icon_class = $icon_monosocial; } else { $icon_class = 'vc-mono vc-mono-fivehundredpx'; }
								break;
							case 'material':
								vc_icon_element_fonts_enqueue( $icon_font_type );
								if ( isset( $icon_material ) && ! empty( $icon_material ) ) { $icon_class = $icon_material; } else { $icon_class = 'vc-material vc-material-3d_rotation'; }
								break;
							default:
						}
						$icon = '<div class="icon" style="font-size:'.esc_attr( $icon_size ).'px"><i class="'.esc_attr( $icon_class ).'" '.$color.'></i></div>';
						$list_items .= '<'.esc_attr( $container_tag ).' class="'.esc_attr( $container_class ).' '.esc_attr( $animation_classes ).'">'.$icon.$text.'</'.esc_attr( $container_tag ).'>';
					}
				}
			}
		}

		// Defining list
		if ( $list_items ) {
			$list = '<'.esc_attr( $list_type ).' class="'.esc_attr( $parent_class ).'">'.$list_items.'</'.esc_attr( $list_type ).'>';
		}
		
		echo '
			<div class="cosmic_widgets '.esc_attr( return_css_classes( $css_classes ) ).'" id="'.esc_attr( $shortcode_id ).'" >
				<div class="widget-inner">
					'.$list.'
				</div>
			</div>
		';

		$output = ob_get_clean();
		return $output;
	}
}
// Finally initialize code
new CosmicIconList;
