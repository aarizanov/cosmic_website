<?php
/**
 * Widget: Recent News (Gutenberg support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.0
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_recent_news_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_recent_news_editor_assets' );
	function trx_addons_gutenberg_sc_recent_news_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Scripts
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-recent-news',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_WIDGETS . 'recent_news/gutenberg/recent-news.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_WIDGETS . 'recent_news/gutenberg/recent-news.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_recent_news_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_recent_news_add_in_gutenberg' );
	function trx_addons_sc_recent_news_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/recent-news', array(
					'attributes'      => array(
						'style'           => array(
							'type'    => 'string',
							'default' => 'news-magazine',
						),
						'count'           => array(
							'type'    => 'number',
							'default' => 3,
						),
						'featured'        => array(
							'type'    => 'number',
							'default' => 3,
						),
						'columns'         => array(
							'type'    => 'number',
							'default' => 3,
						),
						'ids'             => array(
							'type'    => 'string',
							'default' => '',
						),
						'category'        => array(
							'type'    => 'number',
							'default' => 0,
						),
						'offset'          => array(
							'type'    => 'number',
							'default' => 0,
						),
						'orderby'         => array(
							'type'    => 'string',
							'default' => 'date',
						),
						'order'           => array(
							'type'    => 'string',
							'default' => 'desc',
						),
						'widget_title'    => array(
							'type'    => 'string',
							'default' => '',
						),
						'title'           => array(
							'type'    => 'string',
							'default' => '',
						),
						'subtitle'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'show_categories' => array(
							'type'    => 'boolean',
							'default' => false,
						),
						// ID, Class, CSS attributes
						'id'              => array(
							'type'    => 'string',
							'default' => '',
						),
						'class'           => array(
							'type'    => 'string',
							'default' => '',
						),
						'css'             => array(
							'type'    => 'string',
							'default' => '',
						),
					),
					'render_callback' => 'trx_addons_gutenberg_sc_recent_news_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_recent_news_render_block' ) ) {
	function trx_addons_gutenberg_sc_recent_news_render_block( $attributes = array() ) {
		return trx_addons_sc_recent_news( $attributes );
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_recent_news_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_recent_news_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_recent_news_get_layouts( $array = array() ) {
		$array['sc_recent_news'] = apply_filters( 'trx_addons_sc_type', trx_addons_components_get_allowed_layouts( 'widgets', 'recent_news' ), 'trx_widget_recent_news' );
		return $array;
	}
}
