<?php
/*
/ Default and empty vars
*/
$query_items_big = $query_items = '';
$query_count = 0;
$archive_class = new CosmicArchiveClass;

/*
/ Build quiery args
*/
$args = array(
	'post_type' => 'post',
	'posts_per_page' => 4,
	'no_found_rows' => true,
	'update_post_meta_cache' => false, 
	'update_post_term_cache' => false, 
	'fields' => 'ids'
);
$sticky = get_option( 'sticky_posts' );
if ( $sticky ) {
	$args['post__in'] = $sticky;
}
if ( is_archive() ) {
	$term = get_queried_object();
	if ( $term ) {
		$term_id = $term->term_id;
		$args['cat'] = $term_id;
	}
}

/*
/ Wp Query
*/
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$query_count++;
		// Post vars
		$cats = '';
		$id = get_the_ID();
		$url = get_permalink( $id );
		$title = get_the_title( $id );
		$content_raw = get_the_content();
		$content = wp_trim_words( $content_raw, 60, '...' );
//		$excerpt = get_the_excerpt( $text, 60, '...' );
		$excerpt = get_post_meta($id, '_yoast_wpseo_metadesc', true);;
		if ( cosmic_post_categories( $id ) ) {
			$cats = ' in <span class="cats">'.cosmic_post_categories( $id ).'</span>';
		}
		$date = get_the_date( '', $id );
		if ( 1 === $query_count ) {
			$query_items_big = '
			<div class="post_item post_item-big">
				<div class="post_item-inner">
					<h5 class="post-title">POST OF THE WEEK</h5>
					<h1 class="title"><a href="'.esc_url( $url ).'">'.esc_html( $title ).'</a></h1>
					<small class="posted"><span class="date">'.esc_html( $date ).'</span>'.$cats.'</small>
					<p class="excerpt">'.esc_html( $excerpt ).'</p>
				</div>
			</div>
			';
		} else {
			$query_items .= '
			<div class="post_item post_item-small">
				<div class="post_item-inner">
					<small class="posted"><span class="date">'.esc_html( $date ).'</span>'.$cats.'</small>
					<h4 class="title"><a href="'.esc_url( $url ).'">'.esc_html( $title ).'</a></h4>
				</div>
			</div>
			';
		}
	}
	/* Restore original Post Data */
	wp_reset_postdata();
}

/*
/ Set header image
*/
$header_url = $archive_class->image_top_stories();
$header_img = '';
if ( $header_url ) {
	$header_img = '<div class="img" style="background-image:url( '.esc_url( $header_url ).' )"></div>';
}
?>
<div class="top_stories">
	<div class="top_stories-inner">
		<div class="vc_container">
			<div class="vc_col-md-6">
				<?php echo $query_items_big; ?>
			</div>
			<div class="vc_col-md-6">
				<?php echo $query_items; ?>
			</div>
		</div>
		<?php echo $header_img; ?>
	</div>
</div>