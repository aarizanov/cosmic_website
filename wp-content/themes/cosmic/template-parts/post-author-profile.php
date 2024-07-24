<?php
// Bail early if ACF is not present
if ( ! function_exists( 'get_field' ) ) {
	return;
}
// Empty and default vars
$author_description = $author_image = $user_title = '';
$author_name = get_the_author();
$author_id = get_the_author_meta( 'ID' );
$author_url = get_author_posts_url( $author_id );
$author_image_array = get_field( 'image', 'user_'.$author_id );
if ( $author_image_array ) {
	if ( array_key_exists( 'sizes', $author_image_array ) ) {
		$sizes_array = $author_image_array['sizes'];
		if ( is_array( $sizes_array ) && array_key_exists( 'thumbnail', $sizes_array ) ) {
			$img_url = $sizes_array['thumbnail'];
			$author_image = '
				<div class="author_image">
					<a href="'.esc_url( $author_url ).'">
						<img src="'.esc_url( $img_url ).'" alt="'.esc_attr( $author_name ).'">
					</a>
				</div>
			';
		}
	}
}
$author_description_raw = get_the_author_meta( 'description' );
if ( $author_description_raw ) {
	$author_description = wp_trim_words( $author_description_raw, 40, '...' );
}
$user_title_raw = get_field( 'user_title', 'user_'.$author_id );
if ( $user_title_raw ) {
	$user_title = '<b class="title">'.esc_html( $user_title_raw ).'</b>';
} ?>
<div class="author_box">
	<div class="author_box-inner">
		<?php echo $author_image; ?>
		<div class="author_data">
			<h4><a href="<?php echo esc_url( $author_url ); ?>"><?php echo esc_html( $author_name ); ?></a></h4>
			<?php echo $user_title; ?>
			<div class="author_description">
				<p><?php echo esc_html( $author_description ); ?></p>
			</div>
		</div>
	</div>
</div>