<?php
/**
 * Shortcode: Blogger (Widget)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// TRX_Addons Widget
//------------------------------------------------------
if ( ! class_exists('TRX_Addons_SOW_Widget') ) {

	class TRX_Addons_SOW_Widget_Blogger extends TRX_Addons_Widget {
	
		function __construct() {
			$widget_ops = array('classname' => 'widget_blogger', 'description' => esc_html__('Show blog posts', 'trx_addons'));
			parent::__construct( 'trx_addons_sow_widget_blogger', esc_html__('ThemeREX Blogger', 'trx_addons'), $widget_ops );
		}
	
		// Show widget
		function widget($args, $instance) {
			extract($args);
	
			$widget_title = apply_filters('widget_title', isset($instance['widget_title']) ? $instance['widget_title'] : '');
	
			$output = trx_addons_sc_blogger(apply_filters('trx_addons_filter_widget_args',
															$instance,
															$instance, 'trx_addons_sow_widget_blogger')
															);
	
			if (!empty($output)) {
		
				// Before widget (defined by themes)
				trx_addons_show_layout($before_widget);
				
				// Display the widget title if one was input (before and after defined by themes)
				if ($widget_title) trx_addons_show_layout($before_title . $widget_title . $after_title);
		
				// Display widget body
				trx_addons_show_layout($output);
				
				// After widget (defined by themes)
				trx_addons_show_layout($after_widget);
			}
		}
	
		// Update the widget settings
		function update($new_instance, $instance) {
			$instance = array_merge($instance, $new_instance);
			$instance['hide_excerpt'] = isset( $new_instance['hide_excerpt'] ) ? 1 : 0;
			$instance['no_links'] = isset( $new_instance['no_links'] ) ? 1 : 0;
			$instance['slider'] = isset( $new_instance['slider'] ) ? 1 : 0;
			$instance['slides_centered'] = isset( $new_instance['slides_centered'] ) ? 1 : 0;
			$instance['slides_overflow'] = isset( $new_instance['slides_overflow'] ) ? 1 : 0;
			$instance['slider_mouse_wheel'] = isset( $new_instance['slider_mouse_wheel'] ) ? 1 : 0;
			$instance['slider_autoplay'] = isset( $new_instance['slider_autoplay'] ) ? 1 : 0;
			return apply_filters('trx_addons_filter_widget_args_update', $instance, $new_instance, 'trx_addons_sow_widget_blogger');
		}
	
		// Displays the widget settings controls on the widget panel
		function form($instance) {
			// Set up some default widget settings
			$instance = wp_parse_args( (array) $instance, apply_filters('trx_addons_filter_widget_args_default', array(
				'widget_title' => '',
				// Layout params
				"type" => "default",
				"hide_excerpt" => 0,
				"no_links" => 0,
				"more_text" => __('Read more', 'trx_addons'),
				// Query params
				'pagination' => 'none',
				'post_type' => 'post',
				'taxonomy' => 'category',
				"cat" => '',
				"count" => 3,
				"columns" => '',
				"offset" => 0,
				"orderby" => 'date',
				"order" => 'desc',
				"ids" => '',
				//Filter
				"show_filters" => 0,
				"taxonomy_filters" => 'category',
				"ids_filters" => '',
				"show_all_filters" => 1,
				"all_btn_text_filters" => __( "All", 'trx_addons' ),
				// Slider params
				"slider" => 0,
				"slider_pagination" => "none",
				"slider_controls" => "none",
				"slides_space" => 0,
				"slides_centered" => 0,
				"slides_overflow" => 0,
				"slider_mouse_wheel" => 0,
				"slider_autoplay" => 1,
				// Title params
				"title" => "",
				"subtitle" => "",
				"description" => "",
				"link" => '',
				"link_style" => 'default',
				"link_image" => '',
				"link_text" => __('Learn more', 'trx_addons'),
				"title_align" => "left",
				"title_style" => "default",
				"title_tag" => '',
				"title_color" => '',
				"title_color2" => '',
				"gradient_direction" => '',
				// Common params
				"id" => "",
				"class" => "",
				"css" => ""
				), 'trx_addons_sow_widget_blogger')
			);
		
			do_action('trx_addons_action_before_widget_fields', $instance, 'trx_addons_sow_widget_blogger');
			
			$this->show_field(array('name' => 'widget_title',
									'title' => __('Widget title:', 'trx_addons'),
									'value' => $instance['widget_title'],
									'type' => 'text'));
		
			do_action('trx_addons_action_after_widget_title', $instance, 'trx_addons_sow_widget_blogger');
			
			$this->show_field(array('title' => __('Layout parameters', 'trx_addons'),
									'type' => 'info'));

			$this->show_field(array('name' => 'type',
									'title' => __('Layout:', 'trx_addons'),
									'value' => $instance['type'],
									'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'blogger'), 'trx_sc_blogger'),
									'params' => array(
													"mode" => 'inline',
													"return" => 'slug',
													"style" => "images"
													),
									'type' => 'icons'));
			
			$this->show_field(array('name' => 'hide_excerpt',
									'title' => '',
									'label' => __('Hide excerpt', 'trx_addons'),
									'value' => (int) $instance['hide_excerpt'],
									'type' => 'checkbox'));

			$this->show_field(array('name' => 'no_links',
									'title' => '',
									'label' => __('Disable links', 'trx_addons'),
									'value' => (int) $instance['no_links'],
									'type' => 'checkbox'));
			
			$this->show_field(array('name' => 'more_text',
									'title' => __("'More' text", 'trx_addons'),
									'value' => (int) $instance['more_text'],
									'type' => 'text'));

			$this->show_field(array('title' => __('Query parameters', 'trx_addons'),
									'type' => 'info'));

			$this->show_field(array('name' => 'pagination',
									'title' => __('Pagination:', 'trx_addons'),
									'value' => $instance['pagination'],
									'options' => trx_addons_get_list_sc_paginations(),
									'type' => 'select'));

			$this->show_field(array('name' => 'post_type',
									'title' => __('Post type:', 'trx_addons'),
									'value' => $instance['post_type'],
									'options' => trx_addons_get_list_posts_types(),
									'class' => 'trx_addons_post_type_selector',
									'type' => 'select'));

			$this->show_field(array('name' => 'taxonomy',
									'title' => __('Taxonomy:', 'trx_addons'),
									'value' => $instance['taxonomy'],
									'options' => trx_addons_get_list_taxonomies(false, $instance['post_type']),
									'class' => 'trx_addons_taxonomy_selector',
									'type' => 'select'));


			$tax_obj = get_taxonomy($instance['taxonomy']);

			$this->show_field(array('name' => 'cat',
									'title' => __('Category:', 'trx_addons'),
									'value' => $instance['cat'],
									'options' => trx_addons_array_merge(
											array(0 => sprintf(__('- %s -', 'trx_addons'), $tax_obj->label)),
											trx_addons_get_list_terms(false, $instance['taxonomy'], array('pad_counts' => true))),
									'class' => 'trx_addons_terms_selector',
									'type' => 'select'));

			$this->show_field(array('name' => 'show_filters',
				'title' => '',
				'label' => __('Show filters', 'trx_addons'),
				'value' => (int) $instance['show_filters'],
				'type' => 'checkbox'));

			$this->show_field(array('name' => 'taxonomy_filters',
				'title' => __('Filters taxonomy:', 'trx_addons'),
				'value' => $instance['taxonomy_filters'],
				'options' => trx_addons_get_list_taxonomies(false, $instance['post_type']),
				'class' => 'trx_addons_taxonomy_selector',
				'type' => 'select'));

			$this->show_field(array('name' => 'ids_filters',
				'title' => __("Comma separated IDs list to show. IDs have to belong to the selected taxonomy. Filters taxonomy to show:", 'trx_addons'),
				'value' => $instance['ids_filters'],
				'type' => 'text'));

			$this->show_field(array('name' => 'show_all_filters',
				'title' => '',
				'label' => __('Display the "All Filters" tab', 'trx_addons'),
				'value' => (int) $instance['show_all_filters'],
				'type' => 'checkbox'));

			$this->show_field(array('name' => 'all_btn_text_filters',
				'title' => __('"All Filters" tab text', 'trx_addons'),
				'value' => $instance['all_btn_text_filters'],
				'type' => 'text'));



			$this->show_fields_query_param($instance, '');
			$this->show_fields_slider_param($instance);
			$this->show_fields_title_param($instance);
			$this->show_fields_id_param($instance);
		
			do_action('trx_addons_action_after_widget_fields', $instance, 'trx_addons_sow_widget_blogger');
		}
	}

	// Load widget
	if (!function_exists('trx_addons_sow_widget_blogger_load')) {
		add_action( 'widgets_init', 'trx_addons_sow_widget_blogger_load' );
		function trx_addons_sow_widget_blogger_load() {
			register_widget('TRX_Addons_SOW_Widget_Blogger');
		}
	}
}
