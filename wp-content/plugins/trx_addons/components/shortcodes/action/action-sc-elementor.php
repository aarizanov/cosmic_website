<?php
/**
 * Shortcode: Action (Elementor support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }




// Elementor Widget
//------------------------------------------------------
if (!function_exists('trx_addons_sc_action_add_in_elementor')) {
	add_action( 'elementor/widgets/register', 'trx_addons_sc_action_add_in_elementor' );
	function trx_addons_sc_action_add_in_elementor() {
		
		if (!class_exists('TRX_Addons_Elementor_Widget')) return;	

		class TRX_Addons_Elementor_Widget_Action extends TRX_Addons_Elementor_Widget {

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
					'height' => 'size+unit'
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
				return 'trx_sc_action';
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
				return __( 'Actions', 'trx_addons' );
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
				return 'eicon-call-to-action';
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
					'section_sc_action',
					[
						'label' => __( 'Actions', 'trx_addons' ),
					]
				);

				$this->add_control(
					'type',
					[
						'label' => __( 'Layout', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'action'), 'trx_sc_action'),
						'default' => 'default'
					]
				);

				$this->add_control(
					'columns',
					[
						'label' => __( 'Columns', 'trx_addons' ),
						'description' => wp_kses_data( __("Specify number of columns for actions. If empty or 0 - auto detect by items number", 'trx_addons') ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'default' => [
							'size' => 0
						],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 12
							]
						]
					]
				);

				$this->add_control(
					'full_height',
					[
						'label' => __( 'Full height', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_off' => __( 'Off', 'trx_addons' ),
						'label_on' => __( 'On', 'trx_addons' ),
						'return_value' => '1'
					]
				);
				
				$this->add_control(
					'actions',
					[
						'label' => '',
						'type' => \Elementor\Controls_Manager::REPEATER,
						'default' => apply_filters('trx_addons_sc_param_group_value', [
							[
								'position' => 'mc',
								'height' => ['size' => 0, 'unit' => 'px'],
								'title' => esc_html__( 'First action', 'trx_addons' ),
								'subtitle' => $this->get_default_subtitle(),
								'date' => '',
								'info' => '',
								'description' => $this->get_default_description(),
								'link' => ['url' => ''],
								'link_text' => '',
								'icon' => 'icon-star-empty',
								'image' => ['url' => ''],
								'color' => '',
								'bg_color' => '#aa0000',
								'bg_image' => ['url' => ''],
							],
							[
								'position' => 'mc',
								'height' => ['size' => 0, 'unit' => 'px'],
								'title' => esc_html__( 'Second action', 'trx_addons' ),
								'subtitle' => $this->get_default_subtitle(),
								'date' => '',
								'info' => '',
								'description' => $this->get_default_description(),
								'link' => ['url' => ''],
								'link_text' => '',
								'icon' => 'icon-heart-empty',
								'image' => ['url' => ''],
								'color' => '',
								'bg_color' => '#00aa00',
								'bg_image' => ['url' => ''],
							],
							[
								'position' => 'mc',
								'height' => ['size' => 0, 'unit' => 'px'],
								'title' => esc_html__( 'Third action', 'trx_addons' ),
								'subtitle' => $this->get_default_subtitle(),
								'date' => '',
								'info' => '',
								'description' => $this->get_default_description(),
								'link' => ['url' => ''],
								'link_text' => '',
								'icon' => 'icon-clock-empty',
								'image' => ['url' => ''],
								'color' => '',
								'bg_color' => '#0000aa',
								'bg_image' => ['url' => ''],
							]
						], 'trx_sc_action'),
						'fields' => apply_filters('trx_addons_sc_param_group_params', array_merge(
							[
								[
									'name' => 'position',
									'label' => __( 'Position', 'trx_addons' ),
									'label_block' => false,
									'type' => \Elementor\Controls_Manager::SELECT,
									'options' => trx_addons_get_list_sc_positions(),
									'default' => 'mc',
									// Not work in the group params - hide always!
									//'condition' => [
									//	'type' => ['default', 'simple']
									//]
								],
								[
									'name' => 'height',
									'label' => __( 'Height', 'trx_addons' ),
									'type' => \Elementor\Controls_Manager::SLIDER,
									'default' => [
										'size' => 0,
										'unit' => 'px'
									],
									'range' => [
										'px' => [
											'min' => 0,
											'max' => 1000
										],
										'em' => [
											'min' => 0,
											'max' => 100,
											'step' => 0.1
										],
									],
									'size_units' => [ 'px', 'em' ]
								],
								[
									'name' => 'title',
									'label' => __( 'Title', 'trx_addons' ),
									'label_block' => false,
									'type' => \Elementor\Controls_Manager::TEXT,
									'placeholder' => __( "Item's title", 'trx_addons' ),
									'default' => ''
								],
								[
									'name' => 'subtitle',
									'label' => __( 'Subtitle', 'trx_addons' ),
									'label_block' => false,
									'type' => \Elementor\Controls_Manager::TEXT,
									'placeholder' => __( "Item's subtitle", 'trx_addons' ),
									'default' => ''
								],
								[
									'name' => 'date',
									'label' => __( 'Date', 'trx_addons' ),
									'label_block' => false,
									'type' => \Elementor\Controls_Manager::TEXT,
									'placeholder' => __( "Event's date", 'trx_addons' ),
									'default' => '',
									'condition' => ['type' => 'event']
								],
								[
									'name' => 'info',
									'label' => __( 'Additional info', 'trx_addons' ),
									'label_block' => true,
									'type' => \Elementor\Controls_Manager::TEXT,
									'placeholder' => __( "Additional info about this item", 'trx_addons' ),
									'default' => ''
								],
								[
									'name' => 'description',
									'label' => __( 'Description', 'trx_addons' ),
									'label_block' => true,
									'type' => \Elementor\Controls_Manager::TEXTAREA,
									'placeholder' => __( "Short description of this item", 'trx_addons' ),
									'default' => '',
									'separator' => 'none',
									'rows' => 10,
									'show_label' => false,
								],
								[
									'name' => 'link',
									'label' => __( 'Link', 'trx_addons' ),
									'label_block' => false,
									'type' => \Elementor\Controls_Manager::URL,
									'default' => ['url' => ''],
									'placeholder' => __( 'http://your-link.com', 'trx_addons' ),
								],
								[
									'name' => 'link_text',
									'label' => __( "Link's text", 'trx_addons' ),
									'label_block' => false,
									'type' => \Elementor\Controls_Manager::TEXT,
									'placeholder' => __( "Link's text", 'trx_addons' ),
									'default' => ''
								],
							],
							$this->get_icon_param(),
							[
								[
									'name' => 'image',
									'label' => __( 'Image', 'trx_addons' ),
									'type' => \Elementor\Controls_Manager::MEDIA,
									'default' => [
										'url' => '',
									],
								],
								[
									'name' => 'color',
									'label' => __( 'Color', 'trx_addons' ),
									'type' => \Elementor\Controls_Manager::COLOR,
									'default' => '',
									'scheme' => [
										'type' => \Elementor\Core\Schemes\Color::get_type(),
										'value' => \Elementor\Core\Schemes\Color::COLOR_1,
									],
								],
								[
									'name' => 'bg_color',
									'label' => __( 'Background Color', 'trx_addons' ),
									'type' => \Elementor\Controls_Manager::COLOR,
									'default' => '',
									'scheme' => [
										'type' => \Elementor\Core\Schemes\Color::get_type(),
										'value' => \Elementor\Core\Schemes\Color::COLOR_2,
									],
								],
								[
									'name' => 'bg_image',
									'label' => __( 'Background Image', 'trx_addons' ),
									'type' => \Elementor\Controls_Manager::MEDIA,
									'default' => [
										'url' => '',
									],
								]
							]),
							'trx_sc_action'),
						'title_field' => '{{{ title }}}',
					]
				);

				$this->end_controls_section();

				$this->add_slider_param();
				$this->add_title_param();
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
				trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . "action/tpe.action.php",
										'trx_addons_args_sc_action',
										array('element' => $this)
									);
			}
		}
		
		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new TRX_Addons_Elementor_Widget_Action() );
	}
}

// Disable our widgets (shortcodes) to use in Elementor
// because we create special Elementor's widgets instead
if (!function_exists('trx_addons_sc_action_black_list')) {
	add_action( 'elementor/widgets/black_list', 'trx_addons_sc_action_black_list' );
	function trx_addons_sc_action_black_list($list) {
		$list[] = 'TRX_Addons_SOW_Widget_Action';
		return $list;
	}
}
