<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class Qi_Blocks_Admin_Sub_Pages {
	private $base;
	private $menu_slag;
	private $title;
	private $position;
	private $atts = array();

	public function __construct() {
		$this->add_sub_page();
	}

	abstract public function add_sub_page();

	function get_base() {
		return $this->base;
	}

	function set_base( $base ) {
		$this->base = $base;
	}

	function get_menu_slug() {
		return $this->menu_slag;
	}

	function set_menu_slug( $menu_slag ) {
		$this->menu_slag = $menu_slag;
	}

	function get_title() {
		return $this->title;
	}

	function set_title( $title ) {
		$this->title = $title;
	}

    function get_position() {
		return $this->position;
	}

	function set_position( $position ) {
		$this->position = $position;
	}

	function get_atts() {
		return $this->atts;
	}

	function set_atts( $atts ) {
		$this->atts = $atts;
	}

	function render() {
		$args                = $this->get_atts();
		$args['this_object'] = $this;

		qi_blocks_template_part( 'admin/admin-pages', 'templates/holder', '', $args );
	}

	function get_header() {
		Qi_Blocks_Admin_General_Page::get_instance()->get_header( $this );
	}

	function get_footer() {
		Qi_Blocks_Admin_General_Page::get_instance()->get_footer();
	}

	function get_sidebar() {
		Qi_Blocks_Admin_General_Page::get_instance()->get_sidebar();
	}

	function get_content() {
		qi_blocks_template_part( 'admin/admin-pages/sub-pages/' . $this->get_base(), 'templates/' . $this->get_base(), '', $this->get_atts() );
	}
}
