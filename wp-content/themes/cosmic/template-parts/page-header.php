<?php
$archive_class = new CosmicArchiveClass;
$header_img = $header_url = $title = $description = $cats = '';
$header_url = $archive_class->image_header();

if ( is_singular() ) {
	$id = get_the_ID();
	$title = get_the_title( $id );
	$ptype = get_post_type( $id );
	if ( 'post' === $ptype ) {
		if ( has_post_thumbnail( $id ) ) {
			$header_url = get_the_post_thumbnail_url( $id, 'full' );
		} else {
			$header_url = '';
		}
		$id = get_the_ID();
		if ( cosmic_post_categories( $id ) ) {
			$cats = ' in <span class="cats">'.cosmic_post_categories( $id ).'</span>';
		}
		$date = get_the_date( '', $id );
		$author_name = get_the_author();
		$author_id = get_the_author_meta( 'ID' );
		$author_url = get_author_posts_url( $author_id );
		$author = '<br><i>Author: <a href="'.esc_url( $author_url ).'">'.esc_html( $author_name ).'</a></i>';
        /*
         * todo
         * remove reset below for the
         */
		$cats = ''; // remove after $cats and $author after few post are published
        $author = '';
		$description = '
			<div class="description">
				<h4>'.$date.$cats.$author.'</h4>
			</div>
		';
	} elseif ( 'job_position' === $ptype ) {
		$id = get_the_ID();
        $title = get_the_title( $id );
        $status = get_field('status', $id);
        if ($status && $status !== 'active') {
           $title .= ' (' . $status . ')';
        }
		$header_url = $job_location = $job_expires = '';
		$job_location_raw = get_post_meta( $id, 'location', true );
		$job_expires_raw = get_post_meta( $id, 'expiration', true );
		if ( $job_location_raw ) {
			if ( is_array( $job_location_raw ) ) {
				$job_list_items = $separator = '';
				foreach ( $job_location_raw as $job ) {
					$job_list_items .= '<b class="location">'.esc_html( ucfirst( $job ) ).'</b>, ';
				}
				if ( $job_list_items ) {
					$jobs = substr( $job_list_items, 0, -2 );
					$job_location = '<li><i>Job Location</i>: '.wp_kses_post( $jobs ).'<br></li>';
				}
			} else {
				if ( isset( $job_location_raw ) && ! empty( $job_location_raw ) ) {
					$job_location = '<li><i>Job Location</i>: <b class="location">'.esc_html( ucfirst( $job_location_raw ) ).'</b><br></li>';
				}
			}
		}
		if ( $job_expires_raw ) {
			$cur_date = date( 'Ymd' );
			$job_date = date( 'd/m/Y', strtotime( $job_expires_raw ) );
			if ( $cur_date > $job_expires_raw ) {
				$job_date = '<span style="color:#f62954">Expired</span>';
			}
			$job_expires = '<li><i>Deadline</i>: <b class="expires">'.wp_kses_post( $job_date ).'</b></li>';
		}
		if ( $job_location || $job_expires ) {
			$description = '
				<div class="description">
					<ul>'.$job_location.$job_expires.'</ul>
				</div>
			';
		}
	}
} elseif( is_archive() ) {
	$title_raw = get_the_archive_title();
	if ( $title_raw ) {
		// Remove category from title
		$title = str_replace( 'Category:', '', $title_raw );
	}
	$header_url = $archive_class->image_header();
	if ( get_the_archive_description() ) {
		$description = '
			<div class="description">
				<p>'.esc_html( get_the_archive_description() ).'</p>
			</div>';
	}
} elseif( is_search() ) {
	$title = esc_html__( 'Search Results for: ', 'cosmic' ). '<span>' . esc_html( get_search_query() ) . '</span>';
	$header_url = $archive_class->image_header();
}
if ( $header_url ) {
	$header_img = '<div class="img" style="background-image:url( '.esc_url( $header_url ).' )"></div>';
}
?>
<header class="page-header">
	<div class="page-header-inner">
		<div class="vc_container">
			<div class="vc_col-md-12">
				<h1 class="title big">
						<?php echo $title; ?>
				</h1>
				<?php echo $description; ?>
			</div>
		</div>
		<?php echo $header_img; ?>
	</div>
</header><!-- .page-header -->
