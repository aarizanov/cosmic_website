<?php
/**
 * Shortcode: Display menu in the Layouts Builder (Elementor support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.08
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// Elementor Widget
//------------------------------------------------------
if (!function_exists('trx_addons_sc_layouts_menu_add_in_elementor')) {
	add_action( 'elementor/widgets/register', 'trx_addons_sc_layouts_menu_add_in_elementor' );
	function trx_addons_sc_layouts_menu_add_in_elementor() {
		
		if (!class_exists('TRX_Addons_Elementor_Layouts_Widget')) return;	

		class TRX_Addons_Elementor_Widget_Layouts_Menu extends TRX_Addons_Elementor_Layouts_Widget {

			/**
			 * Retrieve widget name.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget name.
			 */
			public function get_name() {
				return 'trx_sc_layouts_menu';
			}

			/**
			 * Retrieve widget title.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget title.
			 */
			public function get_title() {
				return __( 'Layouts: Menu', 'trx_addons' );
			}

			/**
			 * Retrieve widget icon.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget icon.
			 */
			public function get_icon() {
				return 'eicon-nav-menu';
			}

			/**
			 * Retrieve the list of categories the widget belongs to.
			 *
			 * Used to determine where to display the widget in the editor.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return array Widget categories.
			 */
			public function get_categories() {
				return ['trx_addons-layouts'];
			}

			/**
			 * Register widget controls.
			 *
			 * Adds different input fields to allow the user to change and customize the widget settings.
			 *
			 * @since 1.6.41
			 * @access protected
			 */
			protected function register_controls() {
				$this->start_controls_section(
					'section_sc_layouts_menu',
					[
						'label' => __( 'Layouts: Menu', 'trx_addons' ),
					]
				);

				$this->add_control(
					'type',
					[
						'label' => __( 'Layout', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => apply_filters('trx_addons_sc_type', trx_addons_get_list_sc_layouts_menu(), 'trx_sc_layouts_menu'),
						'default' => 'default'
					]
				);

				$this->add_control(
					'direction',
					[
						'label' => __( 'Direction', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_sc_directions(),
						'default' => 'horizontal',
						'condition' => [
							'type' => 'default'
						]
					]
				);

				$this->add_control(
					'location',
					[
						'label' => __( 'Location', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_menu_locations(),
						'default' => 'none'
					]
				);

				$this->add_control(
					'menu',
					[
						'label' => __( 'Menu', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_menus(),
						'default' => 'none',
						'condition' => [
							'location' => 'none'
						]
					]
				);

				$this->add_control(
					'hover',
					[
						'label' => __( 'Hover', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_menu_hover(),
						'default' => 'fade',
						'condition' => [
							'type' => 'default'
						]
					]
				);

				$this->add_control(
					'animation_in',
					[
						'label' => __( 'Submenu animation in', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_animations_in(),
						'default' => 'fadeIn',
						'condition' => [
							'type' => 'default'
						]
					]
				);

				$this->add_control(
					'animation_out',
					[
						'label' => __( 'Submenu animation out', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_animations_out(),
						'default' => 'fadeOut',
						'condition' => [
							'type' => 'default'
						]
					]
				);

				$this->add_control(
					'mobile_button',
					[
						'label' => __( 'Mobile button', 'trx_addons' ),
						'label_block' => false,
						'description' => wp_kses_data( __("Add menu button instead menu on mobile devices. When it clicked - open menu", 'trx_addons') ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_off' => __( 'Off', 'trx_addons' ),
						'label_on' => __( 'On', 'trx_addons' ),
						'return_value' => '1'
					]
				);

				$this->add_control(
					'mobile_menu',
					[
						'label' => __( 'Add to the mobile menu', 'trx_addons' ),
						'label_block' => false,
						'description' => wp_kses_data( __("Use this menu items as mobile menu (if mobile menu not selected in the theme)", 'trx_addons') ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_off' => __( 'Off', 'trx_addons' ),
						'label_on' => __( 'On', 'trx_addons' ),
						'return_value' => '1'
					]
				);

				$this->add_control(
					'hide_on_mobile',
					[
						'label' => __( 'Hide on mobile devices', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_off' => __( 'Off', 'trx_addons' ),
						'label_on' => __( 'On', 'trx_addons' ),
						'return_value' => '1'
					]
				);
				
				$this->end_controls_section();
			}
		}
		
		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new TRX_Addons_Elementor_Widget_Layouts_Menu() );
	}
}

// Disable our widgets (shortcodes) to use in Elementor
// because we create special Elementor's widgets instead
if (!function_exists('trx_addons_sc_layouts_menu_black_list')) {
	add_action( 'elementor/widgets/black_list', 'trx_addons_sc_layouts_menu_black_list' );
	function trx_addons_sc_layouts_menu_black_list($list) {
		$list[] = 'TRX_Addons_SOW_Widget_Layouts_Menu';
		return $list;
	}
}
