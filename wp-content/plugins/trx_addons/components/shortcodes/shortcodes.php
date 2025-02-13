<?php
/**
 * ThemeREX Shortcodes
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

// Define list with shortcodes
if (!function_exists('trx_addons_sc_setup')) {
	add_action( 'after_setup_theme', 'trx_addons_sc_setup', 2 );
	function trx_addons_sc_setup() {
		static $loaded = false;
		if ($loaded) return;
		$loaded = true;
		global $TRX_ADDONS_STORAGE;
		$TRX_ADDONS_STORAGE['sc_list'] = apply_filters('trx_addons_sc_list', array(
			'action' => array(
							'title' => __('Actions', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Default', 'trx_addons'),
								'simple' => esc_html__('Simple', 'trx_addons'),
								'event' => esc_html__('Event', 'trx_addons')
							)
						),
			'anchor' => array(
							'title' => __('Anchor', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Default', 'trx_addons')
							)
						),
			'accordionposts' => array(
						'title' => __('Accordion of posts', 'trx_addons'),
						'layouts_sc' => array(
							'default' => esc_html__('Default', 'trx_addons')
						)
					),
			'blogger' => array(
							'title' => __('Blogger', 'trx_addons'),
							'layouts_sc' => array(

								'default' => esc_html__('Default', 'trx_addons'),
								'modern' => esc_html__('Modern', 'trx_addons'),
								'plain' => esc_html__('Plain', 'trx_addons')
/*
								'default' => trx_addons_get_file_url(TRX_ADDONS_PLUGIN_SHORTCODES . 'blogger/type-default.png'),
								'modern' => trx_addons_get_file_url(TRX_ADDONS_PLUGIN_SHORTCODES . 'blogger/type-modern.png'),
								'plain' => trx_addons_get_file_url(TRX_ADDONS_PLUGIN_SHORTCODES . 'blogger/type-plain.png')
*/
							)
						),
			'button' => array(
							'title' => __('Button', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Default', 'trx_addons'),
								'bordered' => esc_html__('Bordered', 'trx_addons'),
								'simple' => esc_html__('Simple', 'trx_addons')
							),
							// Always enabled!!!
							'std' => 1,
							'hidden' => false
						),
			'content' => array(
							'title' => __('Content', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Default', 'trx_addons'),
							),
							// Always enabled!!!
							'std' => 1,
							'hidden' => true
						),
			'countdown' => array(
							'title' => __('Countdown', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Default', 'trx_addons'),
								'circle' => esc_html__('Circle', 'trx_addons')
							)
						),
			'form' => array(
							'title' => __('Forms', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Default', 'trx_addons'),
								'modern' => esc_html__('Modern', 'trx_addons'),
								'detailed' => esc_html__('Detailed', 'trx_addons')
							),
							// Always enabled!!!
							'std' => 1,
							'hidden' => false
						),
			'googlemap' => array(
							'title' => __('Google map', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Default', 'trx_addons'),
								'detailed' => esc_html__('Detailed', 'trx_addons')
							),
							// Always enabled!!!
							'std' => 1,
							'hidden' => false
						),
			'icons' => array(
							'title' => __('Icons', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Default', 'trx_addons'),
								'modern' => esc_html__('Modern', 'trx_addons')
							)
						),
			'price' => array(
							'title' => __('Price block', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Default', 'trx_addons'),
							)
						),
			'promo' => array(
							'title' => __('Promo', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Default', 'trx_addons'),
								'modern' => esc_html__('Modern', 'trx_addons'),
								'blockquote' => esc_html__('Blockquote', 'trx_addons')
							)
						),
			'skills' => array(
							'title' => __('Skills', 'trx_addons'),
							'layouts_sc' => array(
								'pie' => esc_html__('Pie', 'trx_addons'),
								'counter' => esc_html__('Counter', 'trx_addons')
							)
						),
			'supertitle' => array(
							'title' => __('Super title', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Default', 'trx_addons')
							)
						),
			'socials' => array(
							'title' => __('Socials', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Only icons', 'trx_addons'),
								'names' => esc_html__('Only names', 'trx_addons'),
								'icons_names' => esc_html__('Icon + name', 'trx_addons')
							),
							// Always enabled!!!
							'std' => 1,
							'hidden' => false
						),
			'table' => array(
							'title' => __('Table', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Default', 'trx_addons'),
							)
						),
			'title' => array(
							'title' => __('Title', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Default', 'trx_addons'),
								'shadow' => esc_html__('Shadow', 'trx_addons'),
								'accent' => esc_html__('Accent', 'trx_addons'),
								'gradient' => esc_html__('Gradient', 'trx_addons'),
							),
							// Always enabled!!!
							'std' => 1,
							'hidden' => false
						),
			'yandexmap' => array(
							'title' => __('Yandex map', 'trx_addons'),
							'layouts_sc' => array(
								'default' => esc_html__('Default', 'trx_addons'),
								'detailed' => esc_html__('Detailed', 'trx_addons')
							),
							// Always enabled!!!
							'hidden' => false
						),
			)
		);
	}
}

// Include files with shortcodes
if (!function_exists('trx_addons_sc_load')) {
	add_action( 'after_setup_theme', 'trx_addons_sc_load', 6 );
	function trx_addons_sc_load() {
		static $loaded = false;
		if ($loaded) return;
		$loaded = true;
		global $TRX_ADDONS_STORAGE;
		if (is_array($TRX_ADDONS_STORAGE['sc_list']) && count($TRX_ADDONS_STORAGE['sc_list']) > 0) {
			foreach ($TRX_ADDONS_STORAGE['sc_list'] as $sc=>$params) {
				if (trx_addons_components_is_allowed('sc', $sc)
					&& ($fdir = trx_addons_get_file_dir(TRX_ADDONS_PLUGIN_SHORTCODES . "{$sc}/{$sc}.php")) != '') { 
					include_once $fdir;
				}
			}
		}
	}
}

// Add 'Shortcodes' block in the ThemeREX Addons Components
if (!function_exists('trx_addons_sc_components')) {
	add_filter( 'trx_addons_filter_components_blocks', 'trx_addons_sc_components');
	function trx_addons_sc_components($blocks=array()) {
		$blocks['sc'] = __('Shortcodes', 'trx_addons');
		return $blocks;
	}
}

	
// Load required styles and scripts for the frontend
if ( !function_exists( 'trx_addons_sc_load_scripts_front' ) ) {
	add_action("wp_enqueue_scripts", 'trx_addons_sc_load_scripts_front');
	function trx_addons_sc_load_scripts_front() {
		if (trx_addons_is_on(trx_addons_get_option('debug_mode'))) {
			wp_enqueue_script( 'trx_addons-sc', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_SHORTCODES . 'shortcodes.js'), array('jquery'), null, true );
		}
	}
}


// Merge shortcode's specific styles to the single stylesheet
if ( !function_exists( 'trx_addons_sc_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_sc_merge_styles');
	function trx_addons_sc_merge_styles($list) {
		$list[] = TRX_ADDONS_PLUGIN_SHORTCODES . '_shortcodes.scss';
		return $list;
	}
}


// Merge shortcode's specific styles to the single stylesheet (responsive)
if ( !function_exists( 'trx_addons_sc_merge_styles_responsive' ) ) {
	add_filter("trx_addons_filter_merge_styles_responsive", 'trx_addons_sc_merge_styles_responsive');
	function trx_addons_sc_merge_styles_responsive($list) {
		$list[] = TRX_ADDONS_PLUGIN_SHORTCODES . '_shortcodes.responsive.scss';
		return $list;
	}
}

	
// Merge shortcode's specific scripts to the single file
if ( !function_exists( 'trx_addons_sc_merge_scripts' ) ) {
	add_action("trx_addons_filter_merge_scripts", 'trx_addons_sc_merge_scripts');
	function trx_addons_sc_merge_scripts($list) {
		$list[] = TRX_ADDONS_PLUGIN_SHORTCODES . 'shortcodes.js';
		return $list;
	}
}


// Add common atts like 'id', 'cls'', 'css', title params, etc. to the shortcode's atts
if (!function_exists('trx_addons_sc_common_atts')) {
	function trx_addons_sc_common_atts($common, $atts) {
		if (!is_array($common)) {
			$common = explode(',', $common);
		}
		if ( in_array('id', $common) ) {
			$atts = array_merge($atts, array(
				"id" => "",
				"class" => "",
				"css" => ""
			));
		}
		if ( in_array('title', $common) ) {
			$atts = array_merge($atts, array(
				"title" => "",
				"title_align" => "left",
				"title_style" => "default",
				"title_tag" => '',
				"title_color" => '',
				"title_color2" => '',
				"gradient_direction" => '',
				"subtitle" => "",
				"subtitle_align" => "none",
				"subtitle_position" => trx_addons_get_setting('subtitle_above_title') ? 'above' : 'below',
				"description" => "",
				"link" => '',
				"link_style" => 'default',
				"link_image" => '',
				"link_text" => esc_html__('Learn more', 'trx_addons'),
				"new_window" => 0,
			));
		}
		if ( in_array('slider', $common) ) {
			$atts = array_merge($atts, array(
				"slider" => 0,
				"slider_pagination" => "none",
				"slider_pagination_thumbs" => 0,
				"slider_controls" => "none",
				"slides_space" => 0,
				"slides_centered" => 0,
				"slides_overflow" => 0,
				"slider_mouse_wheel" => 0,
				"slider_autoplay" => 1,
			));
		}
		if ( in_array('query', $common) ) {
			$atts = array_merge($atts, array(
				"cat" => "",
				"columns" => "",
				"count" => 3,
				"offset" => 0,
				"orderby" => '',
				"order" => '',
				"ids" => '',
			));
		}
		if ( in_array('icon', $common) ) {
			$atts = array_merge($atts, array(
				"icon_type" => '',
				"icon_fontawesome" => "",
				"icon_openiconic" => "",
				"icon_typicons" => "",
				"icon_entypo" => "",
				"icon_linecons" => "",
				"icon" => "",
			));
		}
		if ( in_array('hide', $common) ) {
			$atts = array_merge($atts, array(
				"hide_on_wide" => "0",
				"hide_on_desktop" => "0",
				"hide_on_notebook" => "0",
				"hide_on_tablet" => "0",
				"hide_on_mobile" => "0",
				"hide_on_frontpage" => "0",
				"hide_on_singular" => "0",
				"hide_on_other" => "0",
			));
		}
		return $atts;
	}
}


// Prepare Id, custom CSS and other parameters in the shortcode's atts
if (!function_exists('trx_addons_sc_prepare_atts')) {
	function trx_addons_sc_prepare_atts($sc, $atts, $defa) {
		// Push shortcode name to the stack
		trx_addons_sc_stack_push($sc);
		// Add 'xxx_extra' to the default params (its original Elementor's params)
		if (is_array($atts)) {
			foreach($atts as $k=>$v) {
				if (substr($k, -6) == '_extra' && !isset($defa[$k])) $defa[$k] = $v;
			}
		}
		// Merge atts with default values
		$atts = trx_addons_html_decode(shortcode_atts(apply_filters('trx_addons_sc_atts', $defa, $sc), $atts));
		// Unsafe item description
		if (!empty($atts['description']) && function_exists('vc_value_from_safe'))
			$atts['description'] = trim( vc_value_from_safe( $atts['description'] ) );
		// Generate id (if empty)
        if (empty($atts['id']))
        	$atts['id'] = str_replace('trx_', '', $sc) . '_' . str_replace('.', '', mt_rand());
		// Add custom CSS class
		if (!empty($atts['css'])
			&& (trx_addons_sc_stack_check('show_layout_vc') || strpos($atts['css'], '.vc_custom_') !== false)
			&& defined('VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG')
			&& function_exists('vc_shortcode_custom_css_class')
		) {
			$atts['class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,
											(!empty($atts['class']) ? $atts['class'] . ' ' : '') . vc_shortcode_custom_css_class( $atts['css'], ' ' ),
											$sc,
											$atts);
			$atts['css'] = '';
		}
 		return apply_filters('trx_addons_filter_sc_prepare_atts', $atts, $sc);
	}
}

// After all handlers are finished - pop sc from the stack
if (!function_exists('trx_addons_sc_output_finish')) {
	add_filter('trx_addons_sc_output', 'trx_addons_sc_output_finish', 9999, 4);
	function trx_addons_sc_output_finish($output='', $sc='', $atts='', $content='') {
		trx_addons_sc_stack_pop($sc);
		return $output;
	}
}

// Push shortcode name to the stack
if (!function_exists('trx_addons_sc_stack_push')) {
	function trx_addons_sc_stack_push($sc) {
		global $TRX_ADDONS_STORAGE;
		array_push($TRX_ADDONS_STORAGE['sc_stack'], $sc);
	}
}

// Pop shortcode name from the stack
if (!function_exists('trx_addons_sc_stack_pop')) {
	function trx_addons_sc_stack_pop() {
		global $TRX_ADDONS_STORAGE;
		return array_pop($TRX_ADDONS_STORAGE['sc_stack']);
	}
}

// Check if shortcode name is in the stack
if (!function_exists('trx_addons_sc_stack_check')) {
	function trx_addons_sc_stack_check($sc=false) {
		global $TRX_ADDONS_STORAGE;
		return !empty($sc) ? in_array($sc, $TRX_ADDONS_STORAGE['sc_stack']) : count($TRX_ADDONS_STORAGE['sc_stack'] > 0);
	}
}


// Shortcodes parts
//---------------------------------------

// Enqueue iconed fonts
if (!function_exists('trx_addons_load_icons')) {
	function trx_addons_load_icons($list='') {
		if (!empty($list) && function_exists('vc_icon_element_fonts_enqueue')) {
			$list = explode(',', $list);
			foreach ($list as $icon_type)
				vc_icon_element_fonts_enqueue($icon_type);
		}
	}
}

// Display title, subtitle and description for some shortcodes
if (!function_exists('trx_addons_sc_show_titles')) {
	function trx_addons_sc_show_titles($sc, $args, $size='') {
		trx_addons_get_template_part('templates/tpl.sc_titles.php',
										'trx_addons_args_sc_show_titles',
										compact('sc', 'args', 'size')
									);
	}
}

// Display pagination buttons for some shortcodes
if (!function_exists('trx_addons_sc_show_pagination')) {
	function trx_addons_sc_show_pagination($sc, $args, $query) {
		trx_addons_get_template_part('templates/tpl.sc_pagination.php',
										'trx_addons_args_sc_pagination',
										compact('sc', 'args', 'query')
									);
	}
}

// Display link button or image for some shortcodes
if (!function_exists('trx_addons_sc_show_links')) {
	function trx_addons_sc_show_links($sc, $args) {
		trx_addons_get_template_part('templates/tpl.sc_links.php',
										'trx_addons_args_sc_show_links',
										compact('sc', 'args')
									);
	}
}

// Show post meta block: post date, author, categories, counters, etc.
if ( !function_exists('trx_addons_sc_show_post_meta') ) {
	function trx_addons_sc_show_post_meta($sc, $args=array()) {
		$args = array_merge(array(
			'components' => '',	//categories,tags,date,author,counters,share,edit
			'counters' => '',
			'share_type' => 'drop',
			'seo' => false,
			'theme_specific' => true,
			'class' => '',
			'echo' => true
			), $args);
		if (($meta = apply_filters('trx_addons_filter_post_meta', '', array_merge($args, array('echo'=>false)))) != '') {
			if (!empty($args['echo'])) trx_addons_show_layout($meta);
			else return $meta;
		} else {
			if (empty($args['echo'])) ob_start();
			trx_addons_get_template_part('templates/tpl.sc_post_meta.php',
											'trx_addons_args_sc_show_post_meta',
											compact('sc', 'args')
										);
			if (empty($args['echo'])) {
				$meta = ob_get_contents();
				ob_end_clean();
				return $meta;
			}
		}
	}
}

// Display begin of the slider layout for some shortcodes
if (!function_exists('trx_addons_sc_show_slider_wrap_start')) {
	function trx_addons_sc_show_slider_wrap_start($sc, $args) {
		trx_addons_get_template_part('templates/tpl.sc_slider_start.php',
										'trx_addons_args_sc_show_slider_wrap',
										apply_filters('trx_addons_filter_sc_show_slider_args', compact('sc', 'args'))
									);
	}
}

// Display end of the slider layout for some shortcodes
if (!function_exists('trx_addons_sc_show_slider_wrap_end')) {
	function trx_addons_sc_show_slider_wrap_end($sc, $args) {
		trx_addons_get_template_part('templates/tpl.sc_slider_end.php',
										'trx_addons_args_sc_show_slider_wrap', 
										apply_filters('trx_addons_filter_sc_show_slider_args', compact('sc', 'args'))
									);
	}
}


// AJAX Pagination in the shortcodes
//------------------------------------------
if ( !function_exists( 'trx_addons_ajax_sc_pagination' ) ) {
	add_action('wp_ajax_trx_addons_item_pagination',		'trx_addons_ajax_sc_pagination');
	add_action('wp_ajax_nopriv_trx_addons_item_pagination',	'trx_addons_ajax_sc_pagination');
	function trx_addons_ajax_sc_pagination() {

		if ( !wp_verify_nonce( trx_addons_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			die();
	
		$response = array('error'=>'', 'data'=>'', 'css' => '');

		$params = trx_addons_unserialize(wp_unslash($_POST['params']));
		$params['page'] = $_POST['page'];
		if (!empty($_POST['filters_active'])) {
			$params['filters_active'] = $_POST['filters_active'];
		}

		$func_name = 'trx_addons_' . $params['sc'];

		if (function_exists($func_name)) {
			$response['data'] = call_user_func($func_name, $params);
			$response['css'] = apply_filters('trx_addons_filter_inline_css', trx_addons_get_inline_css());
		} else {
			$response['error'] = esc_html__('Unknown shortcode!', 'trx_addons');
		}

		echo json_encode($response);
		die();
	}
}


// Add Gutenberg support
if ( trx_addons_exists_gutenberg() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_SHORTCODES . 'shortcodes-gutenberg.php';
}
