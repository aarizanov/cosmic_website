<?php

function job_positions_shortcode( $atts ) {

    $category = $atts[0];

    $meta_expiration = array(
        'relation' => 'OR',
        array(
            'key' => 'expiration',
            'value' => date( 'Ymd' ),
            'compare' => '>=',
            'type' => 'DATE',
        ),
        array(
            'key' => 'expiration',
            'compare' => '=',
            'value' => '',
        ),
    );

    $args = array(
        'post_type' => 'job_position',
        'post_status' => 'published',
        'posts_per_page' => 24,
        'ignore_sticky_posts'=> true,
        'no_found_rows' => true,
        'fields' => 'ids',
        'meta_query' => $meta_expiration
    );

    if( $category != '' ){
        $args['category_name'] = $category;
    }


    // if search
    if( $_GET['search'] != '' ){
        $args['s'] = $_GET['search'];
    }

    if( $_GET['search'] ){
        $meta_location = array(
            array(
                'key' => 'location',
                'value'   => $_GET['location'],
                'compare' => 'LIKE'
            ),
        );

        $meta_type = array(
            array(
                'key' => 'type',
                'value'   => $_GET['type'],
                'compare' => '='
            ),
        );
    }

    if( $_GET['location'] != 'all' && $_GET['type'] != 'all' ){
        $args['meta_query'] = array(
            'relation' => 'AND',
            $meta_expiration,
            $meta_location,  
            $meta_type,    
        );
    } else if( $_GET['location'] == 'all' && $_GET['type'] != 'all' ){
        $args['meta_query'] = array(
            'relation' => 'AND',
            $meta_expiration,
            $meta_type,    
        );
    } else if(  $_GET['location'] != 'all' && $_GET['type'] == 'all' ){
        $args['meta_query'] = array(
            'relation' => 'AND',
            $meta_expiration,
            $meta_location,  
        );
    }


    // The Query
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $tag_list = $meta_list_items = $meta_list = $content = '';
            $id = get_the_ID();
            $title = get_the_title( $id );
            $permalink = get_permalink( $id );
            $job_location_raw = get_post_meta( $id, 'location', true );
            $job_expires_raw = get_post_meta( $id, 'expiration', true );
            $status_add_on = '';
            $status = get_field('status', $id);
            
            if ($status && $status !== 'active') {
                $status_add_on = ' (' . $status . ')';
            }
            if ( has_excerpt( $id ) ) {
                $content = get_the_excerpt( $id );
            } else {
                $content_raw = get_the_content( $id );
                $content = mb_strimwidth( wp_strip_all_tags( $content_raw ), 0, 145, '...' );
            }

            $tags_array = wp_get_post_tags( $id );
            if ( is_array( $tags_array ) && ! is_wp_error( $tags_array ) ) {
                foreach ( $tags_array as $tag_object ) {
                    if ( $tag_object->name ) {
                        // $tag_list .= '<span>'.esc_attr( $tag_object->name ).'</span>';
                        $tag_list .= '<span class="post_meta_item post_tags"> 
                                '.esc_attr( $tag_object->name ).'
                            </span> ';
                    }
                }
            }

            if ( isset( $job_location_raw ) && ! empty( $job_location_raw ) ) {
                if ( is_array( $job_location_raw ) ) {
                    $job_position_items = '';
                    foreach ( $job_location_raw as $job ) {
                        $job_position_items .= '<span><b>'.esc_html( ucfirst( $job ) ).'</b></span>, ';
                    }
                    if ( $job_position_items ) {
                        $jobs = substr( $job_position_items, 0, -2 );
                        $meta_list_items .= '<span>Location: </span> '.wp_kses_post( $jobs );
                    }
                } else {
                    $meta_list_items .= '<span>Location:</span><span><b>'.esc_html( $job_location_raw ).'</b></span>';
                }
            }

            if ( $job_expires_raw ) {
                $exp_date = date( 'd/m/Y', strtotime( $job_expires_raw ) );
                $meta_list_items .= '<p><span>Deadline: </span><span><b>'.esc_html( $exp_date ).'</b></span></p>';
            }
            if ( $meta_list_items ) {
                $meta_list = '<div class="meta-list">'.$meta_list_items.'</div>';
            }

            $searchForm = '<div class="elementor-element elementor-element-badcc71 elementor-widget elementor-widget-shortcode" data-id="badcc71" data-element_type="widget" data-widget_type="shortcode.default">
                <div class="elementor-widget-container">
                    <div class="elementor-shortcode">
        <div class="sc_services sc_services_default sc_services_featured_top job-positions"> ' . shapeSpace_display_search_form() . '</div></div></div></div>';

            $job_list_items .= '
                <div class="trx_addons_column-1_3">
                    <div class="sc_services_item no_links with_content with_image sc_services_item_featured_top job_position type-job_position">
                        <div class="sc_services_item no_links with_content sc_services_item_featured_top">                            
                            <div class="sc_services_item_info job-position-info">
                                <div class="sc_services_item_header">
                                    <h5 class="sc_services_item_title">
                                        <a href="'.esc_url( $permalink ).'">'.esc_html( $title ).'</a>
                                    </h5>
                                    <div class="post_meta post_meta_single">
                                        <span class="post_meta_label">Tags: </span>
                                        <span class="post_meta_item post_tags">
                                        '.$tag_list.'   
                                        </span>  
                                    </div>
                                </div>
                                <hr>
                                <div class="sc_services_item_content">
                                    '.wp_kses_post( $content ).'
                                </div>
                                <hr>
                                <div class="meta">
                                    '.$meta_list.'
                                    <div class="link">
                                        <a href="'.esc_url( $permalink ).'">'.esc_html__( 'View Position', 'cosmic' ).'</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        wp_reset_postdata();
    } else {

        return '<style>.hide-no-active{display:none;}</style><div class="sc_services sc_services_default sc_services_featured_top job-positions">
                <div class="sc_services_columns_wrap sc_item_columns sc_item_posts_container sc_item_columns_3 trx_addons_columns_wrap columns_padding_bottom">                    
                    <h3 class="default center-text" style="width: 100%">'.esc_html__( 'Sorry, there are no positions available at this time.', 'cosmic' ).'</h3>
                    <p class="center-text">However, if you are still interested in future opportunities, please feel free to send us your resume <br> using the form below.</p>
                </div>
            </div><div class="apply-form">' . do_shortcode('[contact-form-7 id="7091cf5" title="APPLY-When no active jobs"]') . '</div>';
    }

    return $searchForm . '<div class="sc_services sc_services_default sc_services_featured_top job-positions">
                <div class="sc_services_columns_wrap sc_item_columns sc_item_posts_container sc_item_columns_3 trx_addons_columns_wrap columns_padding_bottom">                    
                    ' . $job_list_items . '
                </div>
            </div>';
}

add_shortcode('job-positions', 'job_positions_shortcode');








function shapeSpace_display_search_form() {
    $search_term = $_GET['search'] ? $_GET['search'] : '';

    $location_skopje = $_GET['location'] && $_GET['location'] == 'skopje' ? 'selected' : '';
    $location_bitola = $_GET['location'] && $_GET['location'] == 'bitola' ? 'selected' : '';
    $location_belgrade = $_GET['location'] && $_GET['location'] == 'belgrade' ? 'selected' : '';

    $type_it = $_GET['type'] && $_GET['type'] == 'it' ? 'selected' : '';
    $type_nonit = $_GET['type'] && $_GET['type'] == 'non-it' ? 'selected' : '';

    $search_form = '
        <div class="sc_services sc_services_default sc_services_featured_top job-positions">                
            <form method="get" id="search-form-alt" action="'. esc_url(home_url('/open-job-positions/')) .'">
                <div class="sc_services_columns_wrap sc_item_columns sc_item_posts_container sc_item_columns_4 trx_addons_columns_wrap columns_padding_bottom">
                    <div class="trx_addons_column-1_4">
                        <select name="location" id="location">
                            <option value="all">All Offices</option>
                            <option '. $location_skopje .' value="skopje">Skopje</option>
                            <option '. $location_bitola .' value="bitola">Bitola</option>
                            <option '. $location_belgrade .' value="belgrade">Blegrade</option>
                        </select>
                    </div>
                    <div class="trx_addons_column-1_4">
                        <select name="type" id="type">
                            <option value="all">All Jobs</option>
                            <option '. $type_it .' value="it">IT</option>
                            <option '. $type_nonit .' value="non-it">NON-IT</option>
                        </select>
                    </div>
                    <div class="trx_addons_column-1_4">
                        <input class="full-width-el" type="text" name="search" id="searchs" placeholder="I\'m looking for..." value="'. $search_term .'">
                    </div>
                    <div class="trx_addons_column-1_4">
                        <input class="full-width-el" type="submit" id="searchsubmit" value="Search" />
                    </div>
                </div>
            </form>
        </div>';

    return $search_form;
}
add_shortcode('display_search_form', 'shapeSpace_display_search_form');



function list_posts_from_category( $atts )    {

    $category = $atts[0];   

    $args = array( 'posts_per_page' => 3, 'category_name' => $category, 'post_status' => 'published',);                  

    $category_posts_query = new WP_Query( $args );

    $content = '
        <div class="elementor-element e-flex e-con-boxed e-con e-parent">
            <div class="e-con-inner">
                <div class="elementor-element elementor-grid-3 elementor-grid-tablet-2 elementor-grid-mobile-1 elementor-posts--thumbnail-top elementor-posts--show-avatar elementor-card-shadow-yes elementor-posts__hover-gradient elementor-widget elementor-widget-posts" style="--grid-column-gap: 30px;
  --grid-row-gap: 35px;">
                        <div class="elementor-widget-container">
                        <link rel="stylesheet" href="https://www.cosmicdevelopment.com/wp-content/plugins/elementor-pro/assets/css/widget-posts.min.css">       
                            <div class="elementor-posts-container elementor-posts elementor-posts--skin-cards elementor-grid elementor-has-item-ratio">
    ';



    while($category_posts_query->have_posts()) {
        $category_posts_query->the_post();
        $id = get_the_ID();
        $link = get_permalink();
        $title = get_the_title();
        $date = get_the_date();   
        $featured = get_the_post_thumbnail( $id, 'large' );       
        $excerpt = substr( get_the_excerpt() , 0, 150) . '...';    


        // $featured = get_the_post_thumbnail(
        //                 null,
        //                 'large',
        //                 array( 
        //                     'srcset' => wp_get_attachment_image_url( get_post_thumbnail_id(), 'neve-blog' ) . ' 480w, ' .
        //                         wp_get_attachment_image_url( get_post_thumbnail_id(), 'thumbnail' ) . ' 640w, ' .
        //                         wp_get_attachment_image_url( get_post_thumbnail_id(), 'MedLarge') . ' 960w'
        //                 )
        //             );               

        // $content .= '
        // <div class="column-1_2">
        //     <article id="post-'.$id.'" class="post_item post_format_standard post_layout_classic post_layout_classic_2">
        //             <div class="post_featured with_thumb hover_icon">
        //                 '.$featured.'                     
        //                 <div class="mask"></div>
        //                 <div class="icons"><a href="'.$link.'" aria-hidden="true" class="icon-link-1"></a></div>
        //             </div>      
        //             <div class="post_header entry-header">
        //                 <h4 class="post_title entry-title">
        //                     <a href="'.$link.'" rel="bookmark">'.$title.'</a>
        //                 </h4>       
        //                 <div class="post_meta">
        //                     <a class="post_meta_item post_author" rel="author" href="http://cosmic.local/author/user1/">
        //                         <span class="post_author_before"> by </span>
        //                         <span class="post_author_avatar">
        //                             <img alt="" src="http://2.gravatar.com/avatar/b7f960663c163aff43f09245fc6c1c23?s=32&amp;d=mm&amp;r=g" srcset="http://2.gravatar.com/avatar/b7f960663c163aff43f09245fc6c1c23?s=64&amp;d=mm&amp;r=g 2x" class="avatar avatar-32 photo" height="32" width="32" loading="lazy" decoding="async">                                    
        //                         </span>
        //                         <span class="post_author_name">User 1</span>
        //                     </a>
        //                     <span class="post_meta_item post_date">
        //                         <a href="http://cosmic.local/the-most-common-problems-with-crm-data-and-how-to-fix-them/">07/06/2018</a>
        //                     </span>
        //                 </div><!-- .post_meta -->
        //             </div><!-- .entry-header -->
                
        //             <div class="post_content entry-content">
        //                 <div class="post_content_inner">
        //                     '.$excerpt.'
        //                 </div>
        //             </div><!-- .entry-content -->
        //     </article>
        // </div>';

        // $content .= '
        // <div class="column-1_3">
        //     <article id="post-'.$id.'" class="post_item post_format_standard post_layout_classic post_layout_classic_2">
        //             <div class="post_featured with_thumb hover_icon">
        //                 '.$featured.'                     
        //                 <div class="mask"></div>
        //                 <div class="icons"><a href="'.$link.'" aria-hidden="true" class="icon-link-1"></a></div>
        //             </div>      
        //             <div class="post_header entry-header">
        //                 <h4 class="post_title entry-title">
        //                     <a href="'.$link.'" rel="bookmark">'.$title.'</a>
        //                 </h4>       
        //             </div><!-- .entry-header -->
                
        //             <div class="post_content entry-content">
        //                 <div class="post_content_inner">
        //                     '.$excerpt.'
        //                 </div>
        //             </div><!-- .entry-content -->
        //     </article>
        // </div>';

        $content .= '
            <article class="elementor-post elementor-grid-item post post-'.$id.'type-post status-publish format-standard has-post-thumbnail hentry">
                <div class="elementor-post__card">
                    <a class="elementor-post__thumbnail__link" href="https://www.cosmicdevelopment.com/improve-acquisition-and-activation-flows/" tabindex="-1">
                            '.$featured.'
                    </a>

                    <div class="elementor-post__text">
                        <h3 class="elementor-post__title">
                            <a href="'.$link.'">'.$title.'</a>           
                        </h3>
                        <div class="elementor-post__excerpt">
                            <p>'.$excerpt.'</p>
                        </div>
                        <a class="elementor-post__read-more" href="'.$link.'" aria-label="Read more about '.$title.'" tabindex="-1">
                            Read More »     
                        </a>
                    </div>
                </div>
            </article>';

    }
    wp_reset_postdata();
    $content .= '</div></div></div></div></div>';

    return $content;
}

add_shortcode('list-posts-from-category', 'list_posts_from_category' );