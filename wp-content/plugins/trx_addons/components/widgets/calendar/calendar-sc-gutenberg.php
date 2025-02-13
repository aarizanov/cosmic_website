<?php
/**
 * Widget: Calendar (Gutenberg support)
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
if ( ! function_exists( 'trx_addons_gutenberg_sc_calendar_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_calendar_editor_assets' );
	function trx_addons_gutenberg_sc_calendar_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Scripts
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-calendar',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_WIDGETS . 'calendar/gutenberg/calendar.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_WIDGETS . 'calendar/gutenberg/calendar.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_calendar_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_calendar_add_in_gutenberg' );
	function trx_addons_sc_calendar_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/calendar', array(
					'attributes'      => array(
						'title'    => array(
							'type'    => 'string',
							'default' => esc_html__( 'Calendar', 'trx_addons' ),
						),
						'weekdays' => array(
							'type'    => 'string',
							'default' => 'short',
						),
						// ID, Class, CSS attributes
						'id'       => array(
							'type'    => 'string',
							'default' => '',
						),
						'class'    => array(
							'type'    => 'string',
							'default' => '',
						),
						'css'      => array(
							'type'    => 'string',
							'default' => '',
						),
					),
					'render_callback' => 'trx_addons_gutenberg_sc_calendar_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_calendar_render_block' ) ) {
	function trx_addons_gutenberg_sc_calendar_render_block( $attributes = array() ) {
		return trx_addons_sc_widget_calendar( $attributes );
	}
}
