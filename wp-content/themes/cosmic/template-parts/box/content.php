<?php
// Default vars
$cats = '';
$img = '<div class="featured-image"></div>';
// Post vars
$id = get_the_ID();
$title_raw = get_the_title( $id );
$title = mb_strimwidth( wp_strip_all_tags( $title_raw ), 0, 54, '...' );
$url = get_permalink( $id );
if ( cosmic_post_categories( $id ) ) {
	$cats = ' in <span class="cats">'.cosmic_post_categories( $id ).'</span>';
}
$date = get_the_date( '', $id );
$featured_url = get_the_post_thumbnail_url( $id, 'large' );
if ( ! $featured_url ) {
	$featured_url = get_template_directory_uri().'/img/default_post_box.jpg';
}
?>

<div id="post-<?php echo esc_attr( $id ); ?>" <?php post_class( 'post_box' ); ?> >
	<a class="featured-image" href="<?php echo esc_url( $url ); ?>">
		<div class="img" style="background-image:url( <?php echo esc_url( $featured_url ); ?> )"></div>
	</a>
	<div class="content">
		<small class="posted"><span class="date"><?php echo esc_html( $date ); ?></span><?php echo $cats; ?></small>
		<h5 class="title"><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $title ); ?></a></h5>
	</div>
</div>
