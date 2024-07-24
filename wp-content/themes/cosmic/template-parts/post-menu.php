<?php
$next = '';
$id = get_the_ID();
$home_url = get_site_url();
$blog_url = get_site_url( null, '/blog' );
$current_name = get_the_title( $id );
$next_post_object = get_next_post();
if ( isset( $next_post_object ) && ! empty( $next_post_object ) && ! is_wp_error( $next_post_object ) ) {
	$next_post_id = $next_post_object->ID;
	if ( $next_post_id ) {
		$next_url = get_permalink( $next_post_id );
		$next_name_raw = get_the_title( $next_post_id );
		$next_name = mb_strimwidth( wp_strip_all_tags( $next_name_raw ), 0, 60, '...' );
		$next = '
			<a href="'.esc_url( $next_url ).'">
				<span class="name">'.esc_html( $next_name ).'</span>
				<span class="icon"><i class="fal fa-chevron-right"></i></span>
			</a>';
	}
}
?>
<!--
<nav class="sub_menu post_menu clearfix">
	<div class="sub_menu-inner">
		<div class="vc_container">
			<div class="vc_col-md-9">
				<div class="menu">
					<b><a href="<?php echo esc_url( $home_url ); ?>">Home</a><span>/</span><a href="<?php echo esc_url( $blog_url ); ?>">Blog</a><span>/</span><a href="#" class="current"><?php echo esc_html( $current_name ); ?></a></b>
				</div>
			</div>
		</div>
		<div class="next_link">
			<?php echo $next; ?>
		</div>
	</div>
</nav>
-->