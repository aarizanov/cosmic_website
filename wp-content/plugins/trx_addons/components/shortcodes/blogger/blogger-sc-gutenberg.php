<?php
/**
 * Shortcode: Blogger (Gutenberg support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_blogger_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_blogger_editor_assets' );
	function trx_addons_gutenberg_sc_blogger_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Scripts
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-blogger',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_SHORTCODES . 'blogger/gutenberg/blogger.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_SHORTCODES . 'blogger/gutenberg/blogger.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_blogger_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_blogger_add_in_gutenberg' );
	function trx_addons_sc_blogger_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/blogger', array(
					'attributes'      => array(
						'type'               => array(
							'type'    => 'string',
							'default' => 'default',
						),
						'pagination'		=> array(
							'type'    => 'string',
							'default' => 'none',
						),
						'hide_excerpt'		=> array(
							'type'    => 'boolean',
							'default' => false,
						),
						'no_links'			=> array(
							'type'    => 'boolean',
							'default' => false,
						),
						'more_text'			=> array(
							'type'    => 'string',
							'default' => esc_html__('Read more', 'trx_addons'),
						),
						'post_type'			=> array(
							'type'    => 'string',
							'default' => 'post',
						),
						'taxonomy'			=> array(
							'type'    => 'string',
							'default' => 'category',
						),
						'cat'				=> array(
							'type'    => 'string',
							'default' => '',
						),
						'show_filters'		=> array(
							'type'    => 'boolean',
							'default' => false,
						),
						'taxonomy_filters'	=> array(
							'type'    => 'string',
							'default' => 'category',
						),
						'ids_filters'		=> array(
							'type'    => 'string',
							'default' => '',
						),
						'show_all_filters'		=> array(
							'type'    => 'boolean',
							'default' => true,
						),
						'all_btn_text_filters'	=> array(
							'type'    => 'string',
							'default' => esc_html__('All','trx_addons')
						),
						// Query attributes
						'ids'             		=> array(
							'type'    => 'string',
							'default' => '',
						),
						'count'					=> array(
							'type'    => 'number',
							'default' => 2,
						),
						'columns'				=> array(
							'type'    => 'number',
							'default' => 2,
						),
						'offset'				=> array(
							'type'    => 'number',
							'default' => 0,
						),
						'orderby'				=> array(
							'type'    => 'string',
							'default' => 'none',
						),
						'order'				=> array(
							'type'    => 'string',
							'default' => 'asc',
						),
						// Slider attributes
						'slider'             => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'slides_space'       => array(
							'type'    => 'number',
							'default' => 0,
						),
						'slides_centered'    => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'slides_overflow'    => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'slider_mouse_wheel' => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'slider_autoplay'    => array(
							'type'    => 'boolean',
							'default' => true,
						),
						'slider_controls'    => array(
							'type'    => 'string',
							'default' => 'none',
						),
						'slider_pagination'  => array(
							'type'    => 'string',
							'default' => 'none',
						),
						// Title attributes
						'title_style'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_tag'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_align'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_color'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_color2'       => array(
							'type'    => 'string',
							'default' => '',
						),
						'gradient_direction' => array(
							'type'    => 'string',
							'default' => '0',
						),
						'title'              => array(
							'type'    => 'string',
							'default' => esc_html__( 'Blogger', 'trx_addons' ),
						),
						'subtitle'           => array(
							'type'    => 'string',
							'default' => '',
						),
						'description'        => array(
							'type'    => 'string',
							'default' => '',
						),
						// Button attributes
						'link'               => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_text'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_style'         => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_image'         => array(
							'type'    => 'number',
							'default' => 0,
						),
						'link_image_url'     => array(
							'type'    => 'string',
							'default' => '',
						),
						// ID, Class, CSS attributes
						'id'                 => array(
							'type'    => 'string',
							'default' => '',
						),
						'class'              => array(
							'type'    => 'string',
							'default' => '',
						),
						'css'                => array(
							'type'    => 'string',
							'default' => '',
						),
						// Rerender
						'reload'             => array(
							'type'    => 'string',
							'default' => '',
						),
					),
					'render_callback' => 'trx_addons_gutenberg_sc_blogger_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_blogger_render_block' ) ) {
	function trx_addons_gutenberg_sc_blogger_render_block( $attributes = array() ) {
		return trx_addons_sc_blogger( $attributes );
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_blogger_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_blogger_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_blogger_get_layouts( $array = array() ) {
		$array['sc_blogger'] = apply_filters( 'trx_addons_sc_type', trx_addons_components_get_allowed_layouts( 'sc', 'blogger' ), 'trx_sc_blogger' );
		return $array;
	}
}
