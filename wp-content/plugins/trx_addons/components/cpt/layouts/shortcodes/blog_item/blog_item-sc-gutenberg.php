<?php
/**
 * Shortcode: Blog item parts (Gutenberg support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.50
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}
	

// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_blog_item_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_blog_item_editor_assets' );
	function trx_addons_gutenberg_sc_blog_item_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-blog-item',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'blog_item/gutenberg/blog-item.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'blog_item/gutenberg/blog-item.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_blog_item_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_blog_item_add_in_gutenberg' );
	function trx_addons_sc_blog_item_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/layouts-blog-item', array(
					'attributes'      => array(
						'type'                => array(
							'type'    => 'string',
							'default' => 'title',
						),
						'thumb_bg'            => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'thumb_ratio'         => array(
							'type'    => 'string',
							'default' => '16:9',
						),
						'thumb_mask'          => array(
							'type'    => 'string',
							'default' => '#000',
						),
						'thumb_mask_opacity'  => array(
							'type'    => 'string',
							'default' => '0.3',
						),
						'thumb_hover_mask'    => array(
							'type'    => 'string',
							'default' => '#000',
						),
						'thumb_hover_opacity' => array(
							'type'    => 'string',
							'default' => '0.1',
						),
						'thumb_size'          => array(
							'type'    => 'string',
							'default' => 'full',
						),
						'title_tag'           => array(
							'type'    => 'string',
							'default' => 'h4',
						),
						'meta_parts'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'counters'            => array(
							'type'    => 'string',
							'default' => '',
						),
						'custom_meta_key'     => array(
							'type'    => 'string',
							'default' => '',
						),
						'button_text'         => array(
							'type'    => 'string',
							'default' => esc_html__( 'Read more' ),
						),
						'button_link'         => array(
							'type'    => 'string',
							'default' => 'post',
						),
						'button_type'         => array(
							'type'    => 'string',
							'default' => 'default',
						),
						'seo'                 => array(
							'type'    => 'string',
							'default' => '',
						),
						'position'            => array(
							'type'    => 'string',
							'default' => 'static',
						),
						'hide_overflow'       => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'animation_in'        => array(
							'type'    => 'string',
							'default' => 'none',
						),
						'animation_in_delay'  => array(
							'type'    => 'number',
							'default' => 0,
						),
						'animation_out'       => array(
							'type'    => 'string',
							'default' => 'none',
						),
						'animation_out_delay'  => array(
							'type'    => 'number',
							'default' => 0,
						),
						'text_color'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'text_hover'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'font_zoom'           => array(
							'type'    => 'string',
							'default' => '1',
						),
						'post_type'           => array(
							'type'    => 'string',
							'default' => 'post,',
						),
						// ID, Class, CSS attributes
						'id'                  => array(
							'type'    => 'string',
							'default' => '',
						),
						'class'               => array(
							'type'    => 'string',
							'default' => '',
						),
						'css'                 => array(
							'type'    => 'string',
							'default' => '',
						),
					),
					'render_callback' => 'trx_addons_gutenberg_sc_blog_item_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_blog_item_render_block' ) ) {
	function trx_addons_gutenberg_sc_blog_item_render_block( $attributes = array() ) {
		$output = trx_addons_sc_layouts_blog_item( $attributes );
		if ( ! empty( $output ) ) {
			return $output;
		} else {
			return esc_html__( 'Block is cannot be rendered because has not content. Try to change attributes or add a content.', 'trx_addons' );
		}
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_blog_item_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_blog_item_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_blog_item_get_layouts( $array = array() ) {
		$array['sc_blog_item'] = trx_addons_get_list_sc_layouts_blog_item_parts();
		return $array;
	}
}


// Add shortcode's specific lists to the JS storage
if ( ! function_exists( 'trx_addons_sc_blog_item_gutenberg_sc_params' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_params', 'trx_addons_sc_blog_item_gutenberg_sc_params' );
	function trx_addons_sc_blog_item_gutenberg_sc_params( $vars = array() ) {

		$vars['sc_blog_item_positions'] = array_merge( array('static' => __('Static', 'trx_addons')), trx_addons_get_list_sc_positions());
		$vars['sc_blog_item_animations_in'] = trx_addons_get_list_animations_in();
		$vars['sc_blog_item_animations_out'] = trx_addons_get_list_animations_out();

		return $vars;
	}
}
