<?php
$post_id = get_the_ID();
$post_cats = wp_get_post_categories( $post_id );
$args = array(
	'post_type' => 'post',
	'category__in' => $post_cats,
	'post__not_in' => array( $id ),
	'posts_per_page' => 3,
	'no_found_rows' => true,
	'update_post_meta_cache' => false, 
	'update_post_term_cache' => false, 
	'fields' => 'ids'
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) : ?>
	<h4>RELATED POSTS</h4>
	<ul class="related_posts">
	<?php while ( $the_query->have_posts() ) :
		$the_query->the_post();
		$cats = '';
		$id = get_the_ID();
		$title = get_the_title( $id );
		$url = get_permalink();
		if ( cosmic_post_categories( $id ) ) {
			$cats = ' in <span class="cats">'.cosmic_post_categories( $id ).'</span>';
		}
		$date = get_the_date( '', $id );
		?>
		<li>
			<small class="posted"><span class="date"><?php echo esc_html( $date ); ?></span><?php echo $cats; ?></small>
			<h6><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $title ); ?></a></h6>
		</li>
	<?php endwhile;
	/* Restore original Post Data */
	wp_reset_postdata(); ?>
	</ul>
<?php endif;
