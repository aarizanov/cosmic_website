<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package cosmic
 */

// Helper function
// check if multiple array keys exists
if ( ! function_exists( 'array_keys_exists' ) ) {
	function array_keys_exists( array $keys, array $arr ) {
		return ! array_diff_key( array_flip( $keys ), $arr );
	}
}

// Helper function
// return all css classes
if ( ! function_exists( 'return_css_classes' ) ) {
	function return_css_classes( $array ) {
		if ( ( isset( $array ) && ! empty( $array ) && is_array( $array ) ) ) {
			$css_classes_all = '';
			foreach ( $array as $class_name ) {
				if ( $class_name ) {
					$css_classes_all .= $class_name.' ';
				}
			}
			return $css_classes_all;
		} else {
			return null;
		}
	}
}

// Get Post category items in comma sepparated list
function cosmic_post_categories( $post_id ) {
	$cats = $output = '';
	if ( $post_id ) {
		$categories_array = get_the_category( $post_id );
		if ( $categories_array ) {
			foreach ( $categories_array as $cat ) {
				$cat_id = $cat->term_id;
				$cat_name = $cat->name;
				$cat_link = '#';
				$cat_link_raw = get_term_link( $cat_id );
				if ( isset( $cat_link_raw ) && ! empty( $cat_link_raw ) && ! is_wp_error( $cat_link_raw ) ) {
					$cat_link = $cat_link_raw;
				}
				$cats .= '<a href="'.esc_url( $cat_link ).'">'.esc_html( $cat_name ).'</a> ,';
			}
			// Remove last space and comma
			substr( $cats, 0, -2 );
		}
	}
	if ( $cats ) {
		$output = substr( $cats, 0, -2 );
	}
	return $output;
}



// Add "Hire Us" button to admin menu
function cosmic_custom_menu_item( $items, $args ) {
    $services = wp_get_nav_menu_items('Services');
    $services_links = '';
    foreach($services as $service) {
        $services_links .= '<a href="' . $service->url . '">' . $service->title . '</a>';
    }


    $aboutUs = wp_get_nav_menu_items('About Us');
    $aboutus_links = '';
    foreach($aboutUs as $about) {
        $aboutus_links .= '<a href="' . $about->url . '">' . $about->title . '</a>';
    }


    $careers = wp_get_nav_menu_items('Careers');
    $careers_links = '';
    foreach($careers as $career) {
        $careers_links .= '<a href="' . $career->url . '">' . $career->title . '</a>';
    }


    $social_responsibilities = wp_get_nav_menu_items('Social Responsibility');
    $social_responsibility_links = '';
    foreach($social_responsibilities as $responsibility) {
        $social_responsibility_links .= '<a href="' . $responsibility->url . '">' . $responsibility->title . '</a>';
    }


    $menu_entries = wp_get_nav_menu_items('Main Menu');
    $menu_links = '';

    if($aboutus_links !== '') {
        $menu_links .= '
            <li class="services-dropdown">
                <a href="/" onclick="return false" class="services-dropdown-btn">About Us</a>
                <div class="services-dropdown-content">
                ' . $aboutus_links . '
              </div>
            </li>';
    }

    if($services_links !== '') {
        $menu_links .= '
            <li class="services-dropdown">
                <a href="/" onclick="return false" class="services-dropdown-btn">Services</a>
                <div class="services-dropdown-content">
                ' . $services_links . '
              </div>
            </li>';
    }

    if($careers_links !== '') {
        $menu_links .= '
            <li class="services-dropdown">
                <a href="/" onclick="return false" class="services-dropdown-btn">Careers</a>
                <div class="services-dropdown-content">
                ' . $careers_links . '
              </div>
            </li>';
    }


    foreach($menu_entries as $menu_entry) {
        $menu_links .= '
                <li id="menu-item-' . $menu_entry->post_name . '" class="menu-item menu-item-type-' . $menu_entry->type . ' menu-item-object-' . $menu_entry->object . ' menu-item-' . $menu_entry->post_name . '">
                    <a href="' . $menu_entry->url . '">' . $menu_entry->title . '</a>
                </li>';

        
        if($menu_entry->title === 'Gallery' && $social_responsibility_links !== '') {
            $menu_links .= '
                <li class="services-dropdown">
                    <a href="/" onclick="return false" class="services-dropdown-btn">Social Responsibility</a>
                    <div class="services-dropdown-content">
                    ' . $social_responsibility_links . '
                  </div>
                </li>';
        }
        
    }

	if ( $args->theme_location === 'menu-1' ) {
        $menu_links .= '<li class="hire-us"><a href="'.esc_url( get_home_url().'/hire-us' ).'" class="button button-primary btn-md">Book Free Consultation</a></li>';
	}
	return $menu_links;
}
add_filter( 'wp_nav_menu_items', 'cosmic_custom_menu_item', 10, 2 );