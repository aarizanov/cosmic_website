<?php
$archive_class = new CosmicArchiveClass;
$url = '';
if ( is_category() ) {
	$object_term = get_queried_object();
	if ( $object_term ) {
		$url = get_term_link( $object_term );
	}
}
?>
<div class="sub_menu category_menu">
	<div class="sub_menu-inner">
		<div class="vc_container">
			<div class="vc_col-md-12">
				<ul class="terms">
					<?php 
						$args = array(
							'taxonomy' => 'category',
							'orderby' => 'name',
							'order' => 'ASC',
							'hide_empty' => false,
						);
						$the_query = new WP_Term_Query( $args );
						if ( $the_query ) {
							foreach (  $the_query->get_terms() as $term ) {
								$term_id = $term->term_id;
								$term_name = $term->name;
								$active = '';
								if ( 'Uncategorized' === $term_name ) {
									continue;
								}
								$term_link = '#';
								$term_link_raw = get_term_link( $term_id );
								if ( isset( $term_link_raw ) && ! empty( $term_link_raw ) && ! is_wp_error( $term_link_raw ) ) {
									$term_link = $term_link_raw;
								}
								if ( $archive_class->is_active_category( $term_link ) ) {
									$active = 'active';
								}
								?>
								<li><a class="<?php echo esc_attr( $active ); ?>" href="<?php echo esc_url( $term_link ); ?>"><?php echo esc_html( $term_name ); ?></a></li>
								<?php 
							}
						}
						?>
				</ul>
				<a href="#" class="search">
					<i class="far fa-search"></i>
					<span><?php esc_html_e( 'Search', 'cosmic' ); ?></span>
				</a>
			</div>
		</div>	
	</div>
</div>