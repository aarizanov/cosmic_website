<?php

if ( ! function_exists( 'cosmic_setup' ) ) :
	function cosmic_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Add tittle tag support
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'cosmic' ),
		) );

		// Switch default core markup for search form, comment form, and comments to html5
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'cosmic_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'cosmic_setup' );

function cosmic_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cosmic_content_width', 1190 );
}
add_action( 'after_setup_theme', 'cosmic_content_width', 0 );

// Register widget area.
function cosmic_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Main Side Menu', 'cosmic' ),
		'id'            => 'side-menu-1',
		'description'   => esc_html__( 'Add side menu widgets here.', 'cosmic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer 1', 'cosmic' ),
		'id'            => 'top-footer-1',
		'description'   => esc_html__( 'Add top footer widgets here.', 'cosmic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer 2', 'cosmic' ),
		'id'            => 'top-footer-2',
		'description'   => esc_html__( 'Add top footer widgets here.', 'cosmic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer 3', 'cosmic' ),
		'id'            => 'top-footer-3',
		'description'   => esc_html__( 'Add top footer widgets here.', 'cosmic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer 4', 'cosmic' ),
		'id'            => 'top-footer-4',
		'description'   => esc_html__( 'Add top footer widgets here.', 'cosmic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Bottom Footer', 'cosmic' ),
		'id'            => 'bottom-footer',
		'description'   => esc_html__( 'Add bottom footer widgets here.', 'cosmic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'cosmic_widgets_init' );

// Enqueue front-end scripts and styles
function cosmic_scripts() {
	wp_enqueue_style( 'cosmic-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
	wp_enqueue_script( 'cosmic-navigation', get_template_directory_uri() . '/js/dist/navigation.min.js', array( 'jquery' ), '20151215', true );
	wp_enqueue_script( 'cosmic-skip-link-focus-fix', get_template_directory_uri() . '/js/dist/skip-link-focus-fix.min.js', array(), '20151215', true );
	wp_enqueue_script( 'cosmic-main', get_template_directory_uri() . '/js/dist/main.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_style( 'google-font-source-sans-pro', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&amp;subset=latin-ext' );
	wp_register_script( 'cosmic-popup-consultation', get_template_directory_uri() . '/js/dist/popup_consultation.min.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'cosmic-popup-blog', get_template_directory_uri() . '/js/dist/popup_blog.min.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'cosmic-popup-thankyou', get_template_directory_uri() . '/js/dist/popup_thankyou.min.js', array( 'jquery' ), '1.0', true );
	if ( defined( 'WPB_VC_VERSION' ) ) {
		wp_enqueue_style( 'js_composer_front', WP_PLUGIN_URL.'/js_composer/assets/css/js_composer.min.css', array( 'cosmic-style' ), WPB_VC_VERSION );
	}
	wp_enqueue_style( 'font-awesome-pro', get_template_directory_uri() . '/vendor/fontawesome-pro/css/all.min.css', array(), '5.3.1' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// Sharing script
	wp_register_script( 'add_to_any', 'https://static.addtoany.com/menu/page.js', array(), '1.0.0', true );
	wp_register_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/vendor/theia-sticky-sidebar/dist/theia-sticky-sidebar.min.js', array( 'jquery' ), '1.7.0', true );
	wp_register_script( 'cosmic-single', get_template_directory_uri() . '/js/dist/single.min.js', array( 'jquery' ), '1.0.1', true );
    wp_register_script( 'fancybox', get_template_directory_uri() . '/vendor/fancybox/dist/jquery.fancybox.min.js', array( 'jquery' ), '3.4.2', true );
    wp_register_style( 'fancybox', get_template_directory_uri() . '/vendor/fancybox/dist/jquery.fancybox.min.css', array(), '3.4.2' );
    wp_register_script( 'selectize', get_template_directory_uri() . '/vendor/selectize/selectize.min.js', array( 'jquery' ), '0.12.6', true );
    wp_register_style( 'selectize', get_template_directory_uri() . '/vendor/selectize/selectize.default.css', array(), '0.12.6' );
    if ( is_singular() && 'post' === get_post_type() ) {
		wp_enqueue_script( 'add_to_any' );
		wp_enqueue_script( 'theia-sticky-sidebar' );
		wp_enqueue_script( 'fancybox' );
		wp_enqueue_style( 'fancybox' );
		wp_enqueue_script( 'cosmic-single' );
	} else if ('job_position' === get_post_type()) {
		wp_enqueue_script( 'add_to_any' );
	}

    if('hire-us' === get_post_field('post_name', get_post())){
        wp_enqueue_script( 'selectize' );
        wp_enqueue_style( 'selectize' );
    }
    // Include script for consult popup only on home (front page)
    // Temporary disabled
    // if(is_front_page()) {
    // 	wp_enqueue_script( 'cosmic-popup-consultation' );
    // }
}
add_action( 'wp_enqueue_scripts', 'cosmic_scripts' );

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Add custom post types
require get_template_directory() . '/inc/custom-post-types.php';

// Implement the Custom Header feature.
require get_template_directory() . '/inc/custom-header.php';

// Customizer additions.
require get_template_directory() . '/inc/customizer.php';

// Required plugins
require_once get_template_directory() . '/inc/TGM-Plugin-Activation/class-tgm-plugin-activation.php';
if ( class_exists( 'TGM_Plugin_Activation' ) ) {
	require get_template_directory() . '/inc/TGM-Plugin-Activation/required_plugins.php';
}

// VC Widgets
if ( defined( 'WPB_VC_VERSION' ) ) {
	function cosmic_vc_set_as_theme() {
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
		if ( function_exists( 'vc_set_as_theme' ) ) {
			vc_set_as_theme();
		}
	}
	add_action( 'init', 'cosmic_vc_set_as_theme' );
	require get_template_directory() . '/extend-vc.php';
	require get_template_directory() . '/inc/vc/widgets.php';
}

// ACF functions
if ( function_exists( 'get_field' ) ) {
	require get_template_directory() . '/inc/acf-functions.php';
}

// Archive customization class
require get_template_directory() . '/inc/archives-class.php';

// Add custom image sizes
add_image_size( 'medium-large', 500, 500 );

// Redirect for the first post, after permalink composition change
function cd_url_redirects() {
    /* in this array: old URLs=>new URLs  */
    $redirect_rules = array(
        array('old'=>'/how-outsourcing-can-benefit-your-business/', 'new'=>'/blog/how-outsourcing-can-benefit-your-business/', 'external' => false),
        array('old'=>'/services/', 'new'=>'/software-development/', 'external' => false),
        array('old'=>'/giveaway/', 'new'=>'https://docs.google.com/forms/d/e/1FAIpQLScs_UdJSv1mrj_1BqHyZI1fZejjjGZq1nSc6FCZAZwb_pobeQ/viewform', 'external' => true),
        array('old'=>'/giveaway', 'new'=>'https://docs.google.com/forms/d/e/1FAIpQLScs_UdJSv1mrj_1BqHyZI1fZejjjGZq1nSc6FCZAZwb_pobeQ/viewform', 'external' => true),
    );
    foreach( $redirect_rules as $rule ) :
        // if URL of request matches with the one from the array, then redirect
        if( urldecode($_SERVER['REQUEST_URI']) == $rule['old']) :
            if($rule['external'] === true) :
                $url = $rule['new'];
            else :
                $url = site_url( $rule['new'] );
            endif;
            wp_redirect( $url, 301 );
            exit();
        endif;
    endforeach;
}

add_action('template_redirect', 'cd_url_redirects');

// MailChimp
require_once get_template_directory() . '/inc/lib/cdMailChimp.php';
add_action('wp_ajax_mailchimp', [(new cdMailChimp), 'callBack']);
add_action('wp_ajax_nopriv_mailchimp', [(new cdMailChimp), 'callBack']);
