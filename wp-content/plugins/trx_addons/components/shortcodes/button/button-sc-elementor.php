<?php
/**
 * Shortcode: Button (Elementor support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// Elementor Widget
//------------------------------------------------------
if (!function_exists('trx_addons_sc_button_add_in_elementor')) {
	add_action( 'elementor/widgets/register', 'trx_addons_sc_button_add_in_elementor' );
	function trx_addons_sc_button_add_in_elementor() {
		
		if (!class_exists('TRX_Addons_Elementor_Widget')) return;	

		class TRX_Addons_Elementor_Widget_Button extends TRX_Addons_Elementor_Widget {

			/**
			 * Widget base constructor.
			 *
			 * Initializing the widget base class.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @param array      $data Widget data. Default is an empty array.
			 * @param array|null $args Optional. Widget default arguments. Default is null.
			 */
			public function __construct( $data = [], $args = null ) {
				parent::__construct( $data, $args );
				$this->add_plain_params([
					'height' => 'size'
				]);
			}

			/**
			 * Retrieve widget name.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget name.
			 */
			public function get_name() {
				return 'trx_sc_button';
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
				return __( 'Button', 'trx_addons' );
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
				return 'eicon-button';
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
					'section_sc_button',
					[
						'label' => __( 'Button', 'trx_addons' ),
					]
				);

				$this->add_control(
					'type',
					[
						'label' => __( 'Layout', 'trx_addons' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'button'), 'trx_sc_button'),
						'default' => 'default',
					]
				);
				
				$this->add_control(
					'size',
					[
						'label' => __( 'Size', 'trx_addons' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_sc_button_sizes(),
						'default' => 'normal',
					]
				);

				$this->add_control(
					'link',
					[
						'label' => __( 'Button URL', 'trx_addons' ),
						'type' => \Elementor\Controls_Manager::URL,
						'label_block' => false,
						'placeholder' => __( 'http://your-link.com', 'trx_addons' ),
						'default' => [
							'url' => '#'
						]
					]
				);

				$this->add_control(
					'title',
					[
						'label' => __( 'Title', 'trx_addons' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => false,
						'placeholder' => __( "Title", 'trx_addons' ),
						'default' => __('Button', 'trx_addons')
					]
				);

				$this->add_control(
					'subtitle',
					[
						'label' => __( 'Subtitle', 'trx_addons' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => false,
						'placeholder' => __( "Subtitle", 'trx_addons' ),
						'default' => ''
					]
				);

				$this->add_control(
					'align',
					[
						'label' => __( 'Button alignment', 'trx_addons' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_sc_aligns(),
						'default' => 'none',
					]
				);

				$this->add_control(
					'text_align',
					[
						'label' => __( 'Text alignment', 'trx_addons' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_sc_aligns(),
						'default' => 'none',
					]
				);

				$this->add_control(
					'bg_image',
					[
						'label' => __( 'Background Image', 'trx_addons' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => '',
						],
					]
				);

				$this->add_icon_param();

				$this->add_control(
					'image',
					[
						'label' => __( 'or select an image', 'trx_addons' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => '',
						],
					]
				);

				$this->add_control(
					'icon_position',
					[
						'label' => __( 'Icon position', 'trx_addons' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_sc_icon_positions(),
						'default' => 'left',
					]
				);

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
				trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . "button/tpe.button.php",
										'trx_addons_args_sc_button',
										array('element' => $this)
									);
			}

		}
		
		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new TRX_Addons_Elementor_Widget_Button() );
	}
}

// Disable our widgets (shortcodes) to use in Elementor
// because we create special Elementor's widgets instead
if (!function_exists('trx_addons_sc_button_black_list')) {
	add_action( 'elementor/widgets/black_list', 'trx_addons_sc_button_black_list' );
	function trx_addons_sc_button_black_list($list) {
		$list[] = 'TRX_Addons_SOW_Widget_Button';
		return $list;
	}
}
