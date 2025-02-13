<?php
/**
 * Widget: Custom links
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.0.46
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

// Load widget
if (!function_exists('trx_addons_widget_custom_links_load')) {
	add_action( 'widgets_init', 'trx_addons_widget_custom_links_load' );
	function trx_addons_widget_custom_links_load() {
		register_widget( 'trx_addons_widget_custom_links' );
	}
}

// Widget Class
class trx_addons_widget_custom_links extends TRX_Addons_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_custom_links', 'description' => esc_html__('Custom links with icon, title and description', 'trx_addons') );
		parent::__construct( 'trx_addons_widget_custom_links', esc_html__('ThemeREX Custom Links', 'trx_addons'), $widget_ops );
		add_filter('trx_addons_filter_need_options', array($this, 'meta_box_need_options'));
	}


	// Return true if current screen need to load options scripts and styles
	function meta_box_need_options($need = false) {
		if (!$need) {
			// If current screen is 'Edit Page' with one of ThemeREX Addons custom post types
			$screen = function_exists('get_current_screen') ? get_current_screen() : false;
			$need = is_object($screen) && $screen->id=='widgets';
		}
		return $need;
	}

	// Show widget
	function widget( $args, $instance ) {
		$id = isset($instance['id']) ? $instance['id'] : 'sc_custom_links_'.esc_attr(mt_rand());
		$title = apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : '' );
		$links = isset($instance['links']) ? $instance['links'] : array();
		$icons_animation = isset($instance['icons_animation']) ? $instance['icons_animation'] : 0;
		trx_addons_get_template_part(TRX_ADDONS_PLUGIN_WIDGETS . 'custom_links/tpl.default.php',
									'trx_addons_args_widget_custom_links',
									apply_filters('trx_addons_filter_widget_args',
												array_merge($args, compact('id', 'title', 'links', 'icons_animation')),
												$instance, 'trx_addons_widget_custom_links')
									);
	}

	// Update the widget settings.
	function update( $new_instance, $instance ) {
		$instance = array_merge($instance, $new_instance);
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['icons_animation'] = isset($new_instance['icons_animation']) ? $new_instance['icons_animation'] : 0;
		$instance['links'] = $new_instance['links'];
		if (is_array($instance['links'])) {
			for ($i=0; $i<count($instance['links']); $i++) {
				if (empty($instance['links'][$i]['new_window'])) $instance['links'][$i]['new_window'] = 0;
			}
		}
		return apply_filters('trx_addons_filter_widget_args_update', $instance, $new_instance, 'trx_addons_widget_custom_links');
	}

	// Displays the widget settings controls on the widget panel.
	function form( $instance ) {

		// Remove empty links array
		if (isset($instance['links']) && (!is_array($instance['links']) || count($instance['links']) == 0))
			unset($instance['links']);
		// Set up some default widget settings
		$instance = wp_parse_args( (array) $instance, apply_filters('trx_addons_filter_widget_args_default', array(
			'title' => '',
			'icons_animation' => 0,
			'links' => array(
							array('url'=>'', 'caption'=>'', 'new_window'=>0, 'image'=>'', 'icon'=>'', 'title'=>'', 'description'=>''),
							array('url'=>'', 'caption'=>'', 'new_window'=>0, 'image'=>'', 'icon'=>'', 'title'=>'', 'description'=>''),
							array('url'=>'', 'caption'=>'', 'new_window'=>0, 'image'=>'', 'icon'=>'', 'title'=>'', 'description'=>''),
							array('url'=>'', 'caption'=>'', 'new_window'=>0, 'image'=>'', 'icon'=>'', 'title'=>'', 'description'=>''),
							array('url'=>'', 'caption'=>'', 'new_window'=>0, 'image'=>'', 'icon'=>'', 'title'=>'', 'description'=>'')
							)
			), 'trx_addons_widget_custom_links')
		);
		
		do_action('trx_addons_action_before_widget_fields', $instance, 'trx_addons_widget_custom_links');
		
		$this->show_field(array('name' => 'title',
								'title' => __('Title:', 'trx_addons'),
								'value' => $instance['title'],
								'type' => 'text'));
		$this->show_field(array('name' => "icons_animation",
								'title' => __('Animate icons:', 'trx_addons'),
								'value' => $instance['icons_animation'],
								'type' => 'checkbox'));
		
		do_action('trx_addons_action_after_widget_title', $instance, 'trx_addons_widget_custom_links');

		foreach($instance['links'] as $k=>$link) {
			$this->show_field(array('name' => sprintf('link%d', $k+1),
									'title' => sprintf(__('Link %d', 'trx_addons'), $k+1),
									'type' => 'info'));			
			$this->show_field(array('name' => "links[{$k}][url]",
									'title' => __('Link URL:', 'trx_addons'),
									'value' => $link['url'],
									'type' => 'text'));
			$this->show_field(array('name' => "links[{$k}][new_window]",
									'title' => __('Open in a new window:', 'trx_addons'),
									'value' => $link['new_window'],
									'type' => 'checkbox'));
			$this->show_field(array('name' => "links[{$k}][image]",
									'title' => __('Link image URL:<br>(leave empty if you want to use icon)', 'trx_addons'),
									'value' => $link['image'],
									'type' => 'image'));
			$this->show_field(array('name' => "links[{$k}][icon]",
									'title' => __('Link icon:', 'trx_addons'),
									'value' => $link['icon'],
									'style' => trx_addons_get_setting('icons_type'),
									'options' => trx_addons_get_list_icons(trx_addons_get_setting('icons_type')),
									'type' => 'icons'));
			$this->show_field(array('name' => "links[{$k}][title]",
									'title' => __('Link title:', 'trx_addons'),
									'value' => $link['title'],
									'type' => 'text'));
			$this->show_field(array('name' => "links[{$k}][description]",
									'title' => __('Link description:', 'trx_addons'),
									'value' => $link['description'],
									'type' => 'textarea'));
			$this->show_field(array('name' => "links[{$k}][caption]",
									'title' => __('Button caption:', 'trx_addons'),
									'value' => $link['caption'],
									'type' => 'text'));
		}		

		do_action('trx_addons_action_after_widget_fields', $instance, 'trx_addons_widget_custom_links');
	}
}

	
// Merge widget specific styles into single stylesheet
if ( !function_exists( 'trx_addons_widget_custom_links_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_widget_custom_links_merge_styles');
	function trx_addons_widget_custom_links_merge_styles($list) {
		$list[] = TRX_ADDONS_PLUGIN_WIDGETS . 'custom_links/_custom_links.scss';
		return $list;
	}
}


// Add shortcodes
//----------------------------------------------------------------------------
require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_WIDGETS . 'custom_links/custom_links-sc.php';

// Add shortcodes to Elementor
if ( trx_addons_exists_elementor() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_WIDGETS . 'custom_links/custom_links-sc-elementor.php';
}

// Add shortcodes to Gutenberg
if ( trx_addons_exists_gutenberg() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_WIDGETS . 'custom_links/custom_links-sc-gutenberg.php';
}

// Add shortcodes to VC
if ( trx_addons_exists_vc() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_WIDGETS . 'custom_links/custom_links-sc-vc.php';
}
