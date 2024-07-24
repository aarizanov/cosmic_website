<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0.10
 */

// Footer menu
$vixus_menu_footer = vixus_get_nav_menu(
	array(
		'location' => 'menu_footer',
		'class'    => 'sc_layouts_menu sc_layouts_menu_default',
	)
);
if ( ! empty( $vixus_menu_footer ) ) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php vixus_show_layout( $vixus_menu_footer ); ?>
		</div>
	</div>
	<?php
}
