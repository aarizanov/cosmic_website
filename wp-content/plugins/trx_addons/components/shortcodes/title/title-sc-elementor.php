<?php
/**
 * Shortcode: Content container (Elementor support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4.3
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// Elementor Widget
//------------------------------------------------------
if (!function_exists('trx_addons_sc_title_add_in_elementor')) {
	add_action( 'elementor/widgets/register', 'trx_addons_sc_title_add_in_elementor' );
	function trx_addons_sc_title_add_in_elementor() {
		
		if (!class_exists('TRX_Addons_Elementor_Widget')) return;	

		class TRX_Addons_Elementor_Widget_Title extends TRX_Addons_Elementor_Widget {

			/**
			 * Retrieve widget name.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget name.
			 */
			public function get_name() {
				return 'trx_sc_title';
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
				return __( 'Title', 'trx_addons' );
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
				return 'eicon-t-letter';
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
				return ['trx_addons-elements'];
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
					'section_sc_title',
					[
						'label' => __( 'Title', 'trx_addons' ),
					]
				);

				$this->add_title_param('', [
//					'title_align' => ['default' => 'center'],
					'title' => ['default' => __('Title of the block', 'trx_addons')],
					'subtitle' => ['default' => ''],
					'description' => ['default' => ''],
				]);

				$this->end_controls_section();
			}

			/**
			 * Render widget's template for the editor.
			 *
			 * Written as a Backbone JavaScript template and used to generate the live preview.
			 *
			 * @since 1.6.41
			 * @access protected
			 */
			protected function content_template() {
				trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . "title/tpe.title.php",
										'trx_addons_args_sc_title',
										array('element' => $this)
									);
			}
		}
		
		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new TRX_Addons_Elementor_Widget_Title() );
	}
}


// Disable our widgets (shortcodes) to use in Elementor
// because we create special Elementor's widgets instead
if (!function_exists('trx_addons_sc_title_black_list')) {
	add_action( 'elementor/widgets/black_list', 'trx_addons_sc_title_black_list' );
	function trx_addons_sc_title_black_list($list) {
		$list[] = 'TRX_Addons_SOW_Widget_Title';
		return $list;
	}
}
