<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0.22
 */

// If this theme is a free version of premium theme
if ( ! defined( 'VIXUS_THEME_FREE' ) ) {
	define( 'VIXUS_THEME_FREE', false );
}
if ( ! defined( 'VIXUS_THEME_FREE_WP' ) ) {
	define( 'VIXUS_THEME_FREE_WP', false );
}

// If this theme uses multiple skins
if ( ! defined( 'VIXUS_ALLOW_SKINS' ) ) {
	define( 'VIXUS_ALLOW_SKINS', false );
}
if ( ! defined( 'VIXUS_DEFAULT_SKIN' ) ) {
	define( 'VIXUS_DEFAULT_SKIN', 'default' );
}

// Theme storage
// Attention! Must be in the global namespace to compatibility with WP CLI
$GLOBALS['VIXUS_STORAGE'] = array(

	// Theme required plugin's slugs
	'required_plugins'   => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'         => esc_html__( 'ThemeREX Addons', 'vixus' ),

			// Recommended (supported) plugins for both (lite and full) versions
			// If plugin not need - comment (or remove) it
			'elementor'          => esc_html__( 'Elementor', 'vixus' ),
			'contact-form-7'     => esc_html__( 'Contact Form 7', 'vixus' ),
			'mailchimp-for-wp'   => esc_html__( 'MailChimp for WP', 'vixus' ),
			'wp-gdpr-compliance' => esc_html__( 'Cookie Information', 'vixus' ),
			'timeline-widget-addon-for-elementor' => esc_html__( 'Timeline Widget Addon For Elementor', 'vixus' ),
		),
		// List of plugins for the FREE version only
		//-----------------------------------------------------
		VIXUS_THEME_FREE
			? array()

		// List of plugins for the PREMIUM version only
		//-----------------------------------------------------
			: array(
				// Recommended (supported) plugins for the PRO (full) version
				// If plugin not need - comment (or remove) it

				'essential-grid'             => esc_html__( 'Essential Grid', 'vixus' ),
				'revslider'                  => esc_html__( 'Revolution Slider', 'vixus' ),
                'trx_updater'                 => esc_html__( 'ThemeREX Updater', 'vixus' ),
			)
	),

	// Theme-specific blog layouts
	'blog_styles'        => array_merge(
		// Layouts for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			'excerpt' => array(
				'title'   => esc_html__( 'Standard', 'vixus' ),
				'archive' => 'index-excerpt',
				'item'    => 'content-excerpt',
				'styles'  => 'excerpt',
			),
			'classic' => array(
				'title'   => esc_html__( 'Classic', 'vixus' ),
				'archive' => 'index-classic',
				'item'    => 'content-classic',
				'columns' => array( 2, 3 ),
				'styles'  => 'classic',
			),
		),
		// Layouts for the FREE version only
		//-----------------------------------------------------
		VIXUS_THEME_FREE
		? array()

		// Layouts for the PREMIUM version only
		//-----------------------------------------------------
		: array(
			'masonry'   => array(
				'title'   => esc_html__( 'Masonry', 'vixus' ),
				'archive' => 'index-classic',
				'item'    => 'content-classic',
				'columns' => array( 2, 3 ),
				'styles'  => 'masonry',
			),
			'portfolio' => array(
				'title'   => esc_html__( 'Portfolio', 'vixus' ),
				'archive' => 'index-portfolio',
				'item'    => 'content-portfolio',
				'columns' => array( 2, 3, 4 ),
				'styles'  => 'portfolio',
			),
			'gallery'   => array(
				'title'   => esc_html__( 'Gallery', 'vixus' ),
				'archive' => 'index-portfolio',
				'item'    => 'content-portfolio-gallery',
				'columns' => array( 2, 3, 4 ),
				'styles'  => array( 'portfolio', 'gallery' ),
			),
			'chess'     => array(
				'title'   => esc_html__( 'Chess', 'vixus' ),
				'archive' => 'index-chess',
				'item'    => 'content-chess',
				'columns' => array( 1, 2, 3 ),
				'styles'  => 'chess',
			),
		)
	),

	// Key validator: market[env|loc]-vendor[axiom|ancora|themerex]
	'theme_pro_key'      => 'env-themerex',

	// Generate Personal token from Envato to automatic upgrade theme
	'upgrade_token_url'  => vixus_get_protocol() . '://build.envato.com/create-token/?default=t&purchase:download=t&purchase:list=t',

	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url'     => vixus_get_protocol() . '://vixus.themerex.net',
	'theme_doc_url'      => vixus_get_protocol() . '://vixus.themerex.net/doc',

	'theme_rate_url'     => vixus_get_protocol() . '://themeforest.net/download',

	'theme_download_url'=>  vixus_get_protocol() . '://1.envato.market/c/1262870/275988/4415?subId1=themerex&u=themeforest.net/item/vixus-startup-mobile-app-wordpress-landing-page-theme/23294498',

	'theme_custom_url' => 	vixus_get_protocol() . '://themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themedash',                             

	'theme_support_url'  => vixus_get_protocol() . '://themerex.net/support/',                             

	'theme_video_url'    => vixus_get_protocol() . '://www.youtube.com/channel/UCnFisBimrK2aIE-hnY70kCA',  

	'theme_privacy_url'  => vixus_get_protocol() . '://themerex.net/privacy-policy/',                      

	// Comma separated slugs of theme-specific categories (for get relevant news in the dashboard widget)
	// (i.e. 'children,kindergarten')
	'theme_categories'   => '',

	// Responsive resolutions
	// Parameters to create css media query: min, max
	'responsive'         => array(
		// By device
		'wide'       => array(
			'min' => 2160
		),
		'desktop'    => array(
			'min' => 1680,
			'max' => 2159,
		),
		'notebook'   => array(
			'min' => 1280,
			'max' => 1679,
		),
		'tablet'     => array(
			'min' => 768,
			'max' => 1279,
		),
		'not_mobile' => array( 'min' => 768 ),
		'mobile'     => array( 'max' => 767 ),
		// By size
		'xxl'        => array( 'max' => 1679 ),
		'xl'         => array( 'max' => 1439 ),
		'lg'         => array( 'max' => 1279 ),
		'md_over'    => array( 'min' => 1024 ),
		'md'         => array( 'max' => 1023 ),
		'sm'         => array( 'max' => 767 ),
		'sm_wp'      => array( 'max' => 600 ),
		'xs'         => array( 'max' => 479 ),
	),
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( ! function_exists( 'vixus_customizer_theme_setup1' ) ) {
	add_action( 'after_setup_theme', 'vixus_customizer_theme_setup1', 1 );
	function vixus_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		vixus_storage_set(
			'settings', array(

				'duplicate_options'      => 'child',            // none  - use separate options for the main and the child-theme
																// child - duplicate theme options from the main theme to the child-theme only
																// both  - sinchronize changes in the theme options between main and child themes

				'customize_refresh'      => 'auto',             // Refresh method for preview area in the Appearance - Customize:
																// auto - refresh preview area on change each field with Theme Options
																// manual - refresh only obn press button 'Refresh' at the top of Customize frame

				'max_load_fonts'         => 5,                  // Max fonts number to load from Google fonts or from uploaded fonts

				'comment_after_name'     => true,               // Place 'comment' field after the 'name' and 'email'

				'show_author_avatar'     => true,               // Display author's avatar in the post meta

				'icons_selector'         => 'internal',         // Icons selector in the shortcodes:
																// standard VC (very slow) or Elementor's icons selector (not support images and svg)
																// internal - internal popup with plugin's or theme's icons list (fast and support images and svg)

				'icons_type'             => 'icons',            // Type of icons (if 'icons_selector' is 'internal'):
																// icons  - use font icons to present icons
																// images - use images from theme's folder trx_addons/css/icons.png
																// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'socials_type'           => 'icons',            // Type of socials icons (if 'icons_selector' is 'internal'):
																// icons  - use font icons to present social networks
																// images - use images from theme's folder trx_addons/css/icons.png
																// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'check_min_version'      => true,               // Check if exists a .min version of .css and .js and return path to it
																// instead the path to the original file
																// (if debug_mode is off and modification time of the original file < time of the .min file)

				'autoselect_menu'        => false,              // Show any menu if no menu selected in the location 'main_menu'
																// (for example, the theme is just activated)

				'disable_jquery_ui'      => false,              // Prevent loading custom jQuery UI libraries in the third-party plugins

				'use_mediaelements'      => true,               // Load script "Media Elements" to play video and audio

				'tgmpa_upload'           => false,              // Allow upload not pre-packaged plugins via TGMPA

				'allow_no_image'         => false,              // Allow use image placeholder if no image present in the blog, related posts, post navigation, etc.

				'separate_schemes'       => true,               // Save color schemes to the separate files __color_xxx.css (true) or append its to the __custom.css (false)

				'allow_fullscreen'       => false,              // Allow cases 'fullscreen' and 'fullwide' for the body style in the Theme Options
																// In the Page Options this styles are present always
																// (can be removed if filter 'vixus_filter_allow_fullscreen' return false)

				'attachments_navigation' => false,              // Add arrows on the single attachment page to navigate to the prev/next attachment

				'gutenberg_safe_mode'    => array(),            // 'vc', 'elementor' - Prevent simultaneous editing of posts for Gutenberg and other PageBuilders (VC, Elementor)

				'allow_gutenberg_blocks' => true,               // Allow our shortcodes and widgets as blocks in the Gutenberg (not ready yet - in the development now)

				'subtitle_above_title'   => true,               // Put subtitle above the title in the shortcodes

				'add_hide_on_xxx'        => 'replace',          // Add our breakpoints to the Responsive section of each element
																// 'add' - add our breakpoints after Elementor's
																// 'replace' - add our breakpoints instead Elementor's
																// 'none' - don't add our breakpoints (using only Elementor's)
			)
		);

		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------

		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		
		vixus_storage_set(
			'load_fonts', array(
				// Google font
				array(
					'name'   => 'Lato',
					'family' => 'sans-serif',
					'styles' => '300,400,700,900',     // Parameter 'style' used only for the Google fonts
				),
				array(
					'name'   => 'Cabin',
					'family' => 'sans-serif',
					'styles' => '400,500,600,700',     // Parameter 'style' used only for the Google fonts
				),
				array(
					'name'   => 'Source Code Pro',
					'family' => 'monospace',
					'styles' => '400,500,700',     // Parameter 'style' used only for the Google fonts
				),
				// Font-face packed with theme
				array(
					'name'   => 'Montserrat',
					'family' => 'sans-serif',
				),
			)
		);

		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		vixus_storage_set( 'load_fonts_subset', 'latin,latin-ext' );

		// Settings of the main tags
		// Attention! Font name in the parameter 'font-family' will be enclosed in the quotes and no spaces after comma!


		vixus_storage_set(
			'theme_fonts', array(
				'p'       => array(
					'title'           => esc_html__( 'Main text', 'vixus' ),
					'description'     => esc_html__( 'Font settings of the main text of the site. Attention! For correct display of the site on mobile devices, use only units "rem", "em" or "ex"', 'vixus' ),
					'font-family'     => '"Lato",sans-serif',
					'font-size'       => '1rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.62rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '',
					'margin-top'      => '0em',
					'margin-bottom'   => '1.6em',
				),
				'h1'      => array(
					'title'           => esc_html__( 'Heading 1', 'vixus' ),
					'font-family'     => '"Cabin",sans-serif',
					'font-size'       => '3.333rem',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '3.78rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '1.0417em',
					'margin-bottom'   => '0.57em',
				),
				'h2'      => array(
					'title'           => esc_html__( 'Heading 2', 'vixus' ),
					'font-family'     => '"Cabin",sans-serif',
					'font-size'       => '2.667rem',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '3.044rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '1.0952em',
					'margin-bottom'   => '0.58em',
				),
				'h3'      => array(
					'title'           => esc_html__( 'Heading 3', 'vixus' ),
					'font-family'     => '"Cabin",sans-serif',
					'font-size'       => '2rem',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '2.308rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '1.4545em',
					'margin-bottom'   => '0.7879em',
				),
				'h4'      => array(
					'title'           => esc_html__( 'Heading 4', 'vixus' ),
					'font-family'     => '"Cabin",sans-serif',
					'font-size'       => '1.667rem',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.899rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '1.6923em',
					'margin-bottom'   => '1em',
				),
				'h5'      => array(
					'title'           => esc_html__( 'Heading 5', 'vixus' ),
					'font-family'     => '"Cabin",sans-serif',
					'font-size'       => '1.333rem',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.571rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.46px',
					'margin-top'      => '1.7em',
					'margin-bottom'   => '1.1em',
				),
				'h6'      => array(
					'title'           => esc_html__( 'Heading 6', 'vixus' ),
					'font-family'     => '"Cabin",sans-serif',
					'font-size'       => '1rem',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.244rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.34px',
					'margin-top'      => '1.4706em',
					'margin-bottom'   => '1.2412em',
				),
				'logo'    => array(
					'title'           => esc_html__( 'Logo text', 'vixus' ),
					'description'     => esc_html__( 'Font settings of the text case of the logo', 'vixus' ),
					'font-family'     => '"Montserrat",sans-serif',
					'font-size'       => '1.8em',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '1px',
				),
				'button'  => array(
					'title'           => esc_html__( 'Buttons', 'vixus' ),
					'font-family'     => '"Cabin",sans-serif',
					'font-size'       => '16px',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.5rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.22px',
				),
				'input'   => array(
					'title'           => esc_html__( 'Input fields', 'vixus' ),
					'description'     => esc_html__( 'Font settings of the input fields, dropdowns and textareas', 'vixus' ),
					'font-family'     => 'inherit',
					'font-size'       => '16px',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5rem', // Attention! Firefox don't allow line-height less then 1.5em in the select
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'info'    => array(
					'title'           => esc_html__( 'Post meta', 'vixus' ),
					'description'     => esc_html__( 'Font settings of the post meta: date, counters, share, etc.', 'vixus' ),
					'font-family'     => 'inherit',
					'font-size'       => '14px',  // Old value '13px' don't allow using 'font zoom' in the custom blog items
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0.4em',
					'margin-bottom'   => '',
				),
				'menu'    => array(
					'title'           => esc_html__( 'Main menu', 'vixus' ),
					'description'     => esc_html__( 'Font settings of the main menu items', 'vixus' ),
					'font-family'     => '"Cabin",sans-serif',
					'font-size'       => '16px',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.22px',
				),
				'submenu' => array(
					'title'           => esc_html__( 'Dropdown menu', 'vixus' ),
					'description'     => esc_html__( 'Font settings of the dropdown menu items', 'vixus' ),
					'font-family'     => '"Cabin",sans-serif',
					'font-size'       => '16px',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.22px',
				),
			)
		);

		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		vixus_storage_set(
			'scheme_color_groups', array(
				'main'    => array(
					'title'       => esc_html__( 'Main', 'vixus' ),
					'description' => esc_html__( 'Colors of the main content area', 'vixus' ),
				),
				'alter'   => array(
					'title'       => esc_html__( 'Alter', 'vixus' ),
					'description' => esc_html__( 'Colors of the alternative blocks (sidebars, etc.)', 'vixus' ),
				),
				'extra'   => array(
					'title'       => esc_html__( 'Extra', 'vixus' ),
					'description' => esc_html__( 'Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'vixus' ),
				),
				'inverse' => array(
					'title'       => esc_html__( 'Inverse', 'vixus' ),
					'description' => esc_html__( 'Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'vixus' ),
				),
				'input'   => array(
					'title'       => esc_html__( 'Input', 'vixus' ),
					'description' => esc_html__( 'Colors of the form fields (text field, textarea, select, etc.)', 'vixus' ),
				),
			)
		);
		vixus_storage_set(
			'scheme_color_names', array(
				'bg_color'    => array(
					'title'       => esc_html__( 'Background color', 'vixus' ),
					'description' => esc_html__( 'Background color of this block in the normal state', 'vixus' ),
				),
				'bg_hover'    => array(
					'title'       => esc_html__( 'Background hover', 'vixus' ),
					'description' => esc_html__( 'Background color of this block in the hovered state', 'vixus' ),
				),
				'bd_color'    => array(
					'title'       => esc_html__( 'Border color', 'vixus' ),
					'description' => esc_html__( 'Border color of this block in the normal state', 'vixus' ),
				),
				'bd_hover'    => array(
					'title'       => esc_html__( 'Border hover', 'vixus' ),
					'description' => esc_html__( 'Border color of this block in the hovered state', 'vixus' ),
				),
				'text'        => array(
					'title'       => esc_html__( 'Text', 'vixus' ),
					'description' => esc_html__( 'Color of the plain text inside this block', 'vixus' ),
				),
				'text_dark'   => array(
					'title'       => esc_html__( 'Text dark', 'vixus' ),
					'description' => esc_html__( 'Color of the dark text (bold, header, etc.) inside this block', 'vixus' ),
				),
				'text_light'  => array(
					'title'       => esc_html__( 'Text light', 'vixus' ),
					'description' => esc_html__( 'Color of the light text (post meta, etc.) inside this block', 'vixus' ),
				),
				'text_link'   => array(
					'title'       => esc_html__( 'Link', 'vixus' ),
					'description' => esc_html__( 'Color of the links inside this block', 'vixus' ),
				),
				'text_hover'  => array(
					'title'       => esc_html__( 'Link hover', 'vixus' ),
					'description' => esc_html__( 'Color of the hovered state of links inside this block', 'vixus' ),
				),
				'text_link2'  => array(
					'title'       => esc_html__( 'Link 2', 'vixus' ),
					'description' => esc_html__( 'Color of the accented texts (areas) inside this block', 'vixus' ),
				),
				'text_hover2' => array(
					'title'       => esc_html__( 'Link 2 hover', 'vixus' ),
					'description' => esc_html__( 'Color of the hovered state of accented texts (areas) inside this block', 'vixus' ),
				),
				'text_link3'  => array(
					'title'       => esc_html__( 'Link 3', 'vixus' ),
					'description' => esc_html__( 'Color of the other accented texts (buttons) inside this block', 'vixus' ),
				),
				'text_hover3' => array(
					'title'       => esc_html__( 'Link 3 hover', 'vixus' ),
					'description' => esc_html__( 'Color of the hovered state of other accented texts (buttons) inside this block', 'vixus' ),
				),
			)
		);
		$schemes = array(

				// Color scheme: 'default'
				'default' => array(
					'title'    => esc_html__( 'Default', 'vixus' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#ffffff',
						'bd_color'         => '#d5d5de',  //+

						// Text and links colors
						'text'             => '#9d9aad',  //+
						'text_light'       => '#b7b7b7',
						'text_dark'        => '#06263f',  //+
						'text_link'        => '#feb321',  //+
						'text_hover'       => '#0590e4',  //+
						'text_link2'       => '#052036',  //+
						'text_hover2'      => '#0590e4',  //+
						'text_link3'       => '#ffffff',  //+
						'text_hover3'      => '#052036',  //+

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#f1f5fa',  //+
						'alter_bg_hover'   => '#e6e8eb',
						'alter_bd_color'   => '#d5d5de',
						'alter_bd_hover'   => '#dadada',
						'alter_text'       => '#9d9aad',  //+
						'alter_light'      => '#9d9aad',  //+
						'alter_dark'       => '#052036',  //+
						'alter_link'       => '#0590e4',
						'alter_hover'      => '#feb321',  //+
						'alter_link2'      => '#8be77c',
						'alter_hover2'     => '#80d572',
						'alter_link3'      => '#eec432',
						'alter_hover3'     => '#ddb837',

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#feb321',  //+
						'extra_bg_hover'   => '#f4f7fb',  //+
						'extra_bd_color'   => '#bbb9c6',  //+
						'extra_bd_hover'   => '#052036',  //+
						'extra_text'       => '#f1f5fa',  //+
						'extra_light'      => '#d5d5de',  //+
						'extra_dark'       => '#ffffff',
						'extra_link'       => '#feb321',  //+
						'extra_hover'      => '#0590e4',  //+
						'extra_link2'      => '#2a4154',  //+
						'extra_hover2'     => '#8bc0e7',  //+
						'extra_link3'      => '#0590e4',  //+
						'extra_hover3'     => '#f4ae20',  //+

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#ffffff',  //+
						'input_bg_hover'   => '#ffffff',
						'input_bd_color'   => '#dddce2',  //+
						'input_bd_hover'   => '#e0e0e0',
						'input_text'       => '#06263f',  //+
						'input_light'      => '#9d9aad',  //+
						'input_dark'       => '#06263f',

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#67bcc1',
						'inverse_bd_hover' => '#5aa4a9',
						'inverse_text'     => '#06263f',
						'inverse_light'    => '#f1f5fa',  //+
						'inverse_dark'     => '#000000',
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#052036',  //+
					),
				),

				// Color scheme: 'dark'
				'dark'    => array(
					'title'    => esc_html__( 'Dark', 'vixus' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#052036',
						'bd_color'         => '#2e2c33',

						// Text and links colors
						'text'             => '#9d9aad',
						'text_light'       => '#6f6f6f',
						'text_dark'        => '#ffffff',
						'text_link'        => '#0590e4',  //+
						'text_hover'       => '#feb321',  //+
						'text_link2'       => '#feb321',  //+
						'text_hover2'      => '#0590e4',  //+
						'text_link3'       => '#ddb837',
						'text_hover3'      => '#eec432',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#052036',  //+
						'alter_bg_hover'   => '#333333',
						'alter_bd_color'   => '#464646',
						'alter_bd_hover'   => '#4a4a4a',
						'alter_text'       => '#9d9aad',  //+
						'alter_light'      => '#ffffff',  //+
						'alter_dark'       => '#ffffff',
						'alter_link'       => '#0590e4',
						'alter_hover'      => '#0590e4',
						'alter_link2'      => '#8be77c',
						'alter_hover2'     => '#80d572',
						'alter_link3'      => '#eec432',
						'alter_hover3'     => '#ddb837',

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#052036',
						'extra_bg_hover'   => '#28272e',
						'extra_bd_color'   => '#052036',  //+
						'extra_bd_hover'   => '#bbb9c6',  //+
						'extra_text'       => '#ffffff',  //+
						'extra_light'      => '#d5d5de',  //+
						'extra_dark'       => '#ffffff',
						'extra_link'       => '#0590e4',
						'extra_hover'      => '#0590e4',
						'extra_link2'      => '#2a4154',  //+
						'extra_hover2'     => '#8bc0e7',
						'extra_link3'      => '#ddb837',
						'extra_hover3'     => '#eec432',

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#1e374a',
						'input_bg_hover'   => '#1e374a',
						'input_bd_color'   => '#1e374a',
						'input_bd_hover'   => '#353535',
						'input_text'       => '#ffffff',
						'input_light'      => '#6f6f6f',
						'input_dark'       => '#ffffff',

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#e36650',
						'inverse_bd_hover' => '#cb5b47',
						'inverse_text'     => '#06263f',
						'inverse_light'    => '#f1f5fa',  //+
						'inverse_dark'     => '#000000',
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#052036',  //+
					),
				),


		);
		vixus_storage_set( 'schemes', $schemes );
		vixus_storage_set( 'schemes_original', $schemes );

		// Simple scheme editor: lists the colors to edit in the "Simple" mode.
		// For each color you can set the array of 'slave' colors and brightness factors that are used to generate new values,
		// when 'main' color is changed
		// Leave 'slave' arrays empty if your scheme does not have a color dependency
		vixus_storage_set(
			'schemes_simple', array(
				'text_link'        => array(
					'alter_hover'      => 1,
					'extra_link'       => 1,
					'inverse_bd_color' => 0.85,
					'inverse_bd_hover' => 0.7,
				),
				'text_hover'       => array(
					'alter_link'  => 1,
					'extra_hover' => 1,
				),
				'text_link2'       => array(
					'alter_hover2' => 1,
					'extra_link2'  => 1,
				),
				'text_hover2'      => array(
					'alter_link2'  => 1,
					'extra_hover2' => 1,
				),
				'text_link3'       => array(
					'alter_hover3' => 1,
					'extra_link3'  => 1,
				),
				'text_hover3'      => array(
					'alter_link3'  => 1,
					'extra_hover3' => 1,
				),
				'alter_link'       => array(),
				'alter_hover'      => array(),
				'alter_link2'      => array(),
				'alter_hover2'     => array(),
				'alter_link3'      => array(),
				'alter_hover3'     => array(),
				'extra_link'       => array(),
				'extra_hover'      => array(),
				'extra_link2'      => array(),
				'extra_hover2'     => array(),
				'extra_link3'      => array(),
				'extra_hover3'     => array(),
				'inverse_bd_color' => array(),
				'inverse_bd_hover' => array(),
			)
		);

		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		vixus_storage_set(
			'scheme_colors_add', array(
				'bg_color_0'        => array(
					'color' => 'bg_color',
					'alpha' => 0,
				),
				'bg_color_02'       => array(
					'color' => 'bg_color',
					'alpha' => 0.2,
				),
				'bg_color_07'       => array(
					'color' => 'bg_color',
					'alpha' => 0.7,
				),
				'bg_color_08'       => array(
					'color' => 'bg_color',
					'alpha' => 0.8,
				),
				'bg_color_09'       => array(
					'color' => 'bg_color',
					'alpha' => 0.9,
				),
				'alter_bg_color_07' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.7,
				),
				'alter_bg_color_04' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.4,
				),
				'alter_bg_color_02' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.2,
				),
				'alter_bd_color_02' => array(
					'color' => 'alter_bd_color',
					'alpha' => 0.2,
				),
				'alter_link_02'     => array(
					'color' => 'alter_link',
					'alpha' => 0.2,
				),
				'alter_link_07'     => array(
					'color' => 'alter_link',
					'alpha' => 0.7,
				),
				'extra_bg_color_07' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.7,
				),
				'extra_link_02'     => array(
					'color' => 'extra_link',
					'alpha' => 0.2,
				),
				'extra_link_07'     => array(
					'color' => 'extra_link',
					'alpha' => 0.7,
				),
				'text_dark_07'      => array(
					'color' => 'text_dark',
					'alpha' => 0.7,
				),
				'text_link_02'      => array(
					'color' => 'text_link',
					'alpha' => 0.2,
				),
				'text_link_07'      => array(
					'color' => 'text_link',
					'alpha' => 0.9,
				),
				'inverse_text_05'      => array(
					'color' => 'inverse_text',
					'alpha' => 0.5,
				),
				'text_link_blend'   => array(
					'color'      => 'text_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'alter_link_blend'  => array(
					'color'      => 'alter_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
			)
		);

		// Parameters to set order of schemes in the css
		vixus_storage_set(
			'schemes_sorted', array(
				'color_scheme',
				'header_scheme',
				'menu_scheme',
				'sidebar_scheme',
				'footer_scheme',
			)
		);

		// -----------------------------------------------------------------
		// -- Theme specific thumb sizes
		// -----------------------------------------------------------------
		vixus_storage_set(
			'theme_thumbs', apply_filters(
				'vixus_filter_add_thumb_sizes', array(
					// Width of the image is equal to the content area width (without sidebar)
					// Height is fixed
					'vixus-thumb-huge'        => array(
						'size'  => array( 1170, 658, true ),
						'title' => esc_html__( 'Huge image', 'vixus' ),
						'subst' => 'trx_addons-thumb-huge',
					),
					// Width of the image is equal to the content area width (with sidebar)
					// Height is fixed
					'vixus-thumb-big'         => array(
						'size'  => array( 825, 423, true ),
						'title' => esc_html__( 'Large image', 'vixus' ),
						'subst' => 'trx_addons-thumb-big',
					),

					// Width of the image is equal to the 1/3 of the content area width (without sidebar)
					// Height is fixed
					'vixus-thumb-med'         => array(
						'size'  => array( 740, 416, true ),
						'title' => esc_html__( 'Medium image', 'vixus' ),
						'subst' => 'trx_addons-thumb-medium',
					),

					// Small square image (for avatars in comments, etc.)
					'vixus-thumb-tiny'        => array(
						'size'  => array( 160, 160, true ),
						'title' => esc_html__( 'Small square avatar', 'vixus' ),
						'subst' => 'trx_addons-thumb-tiny',
					),

					// Related posts image
					'vixus-thumb-related'        => array(
						'size'  => array( 772, 500, true ),
						'title' => esc_html__( 'Related posts image', 'vixus' ),
						'subst' => 'trx_addons-thumb-related',
					),

					// Team short image
					'vixus-thumb-team'        => array(
						'size'  => array( 594, 680, true ),
						'title' => esc_html__( 'Team short image', 'vixus' ),
						'subst' => 'trx_addons-thumb-team',
					),

					// Team default image
					'vixus-thumb-defteam'        => array(
						'size'  => array( 576, 576, true ),
						'title' => esc_html__( 'Team default image', 'vixus' ),
						'subst' => 'trx_addons-thumb-defteam',
					),

					// Width of the image is equal to the content area width (with sidebar)
					// Height is proportional (only downscale, not crop)
					'vixus-thumb-masonry-big' => array(
						'size'  => array( 760, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry Large (scaled)', 'vixus' ),
						'subst' => 'trx_addons-thumb-masonry-big',
					),

					// Width of the image is equal to the 1/3 of the full content area width (without sidebar)
					// Height is proportional (only downscale, not crop)
					'vixus-thumb-masonry'     => array(
						'size'  => array( 370, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry (scaled)', 'vixus' ),
						'subst' => 'trx_addons-thumb-masonry',
					),
				)
			)
		);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'vixus_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'vixus_importer_set_options', 9 );
	function vixus_importer_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Allow import/export functionality
			$options['allow_import'] = true;
			$options['allow_export'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url( vixus_get_protocol() . '://demofiles.themerex.net/vixus' );
			// Required plugins
			$options['required_plugins'] = array_keys( vixus_storage_get( 'required_plugins' ) );
			// Set number of thumbnails (usually 3 - 5) to regenerate at once when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 0;
			// Default demo
			$options['files']['default']['title']       = esc_html__( 'Vixus Demo', 'vixus' );
			$options['files']['default']['domain_dev']  = esc_url( vixus_get_protocol() . '://vixus.themerex.net' );       // Developers domain
			$options['files']['default']['domain_demo'] = esc_url( vixus_get_protocol() . '://vixus.themerex.net' );       // Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
			

			// Banners
			$options['banners'] = array(
				array(
					'image'        => vixus_get_file_url( 'theme-specific/theme-about/images/frontpage.png' ),
					'title'        => esc_html__( 'Front Page Builder', 'vixus' ),
					'content'      => wp_kses( __( "Create your front page right in the WordPress Customizer. There's no need in any page builder. Simply enable/disable sections, fill them out with content, and customize to your liking.", 'vixus' ), 'vixus_kses_content' ),
					'link_url'     => esc_url( '//www.youtube.com/watch?v=VT0AUbMl_KA' ),
					'link_caption' => esc_html__( 'Watch Video Introduction', 'vixus' ),
					'duration'     => 20,
				),
				array(
					'image'        => vixus_get_file_url( 'theme-specific/theme-about/images/layouts.png' ),
					'title'        => esc_html__( 'Layouts Builder', 'vixus' ),
					'content'      => wp_kses( __( 'Use Layouts Builder to create and customize header and footer styles for your website. With a flexible page builder interface and custom shortcodes, you can create as many header and footer layouts as you want with ease.', 'vixus' ), 'vixus_kses_content' ),
					'link_url'     => esc_url( '//www.youtube.com/watch?v=pYhdFVLd7y4' ),
					'link_caption' => esc_html__( 'Learn More', 'vixus' ),
					'duration'     => 20,
				),
				array(
					'image'        => vixus_get_file_url( 'theme-specific/theme-about/images/documentation.png' ),
					'title'        => esc_html__( 'Read Full Documentation', 'vixus' ),
					'content'      => wp_kses( __( 'Need more details? Please check our full online documentation for detailed information on how to use Vixus.', 'vixus' ), 'vixus_kses_content' ),
					'link_url'     => esc_url( vixus_storage_get( 'theme_doc_url' ) ),
					'link_caption' => esc_html__( 'Online Documentation', 'vixus' ),
					'duration'     => 15,
				),
				array(
					'image'        => vixus_get_file_url( 'theme-specific/theme-about/images/video-tutorials.png' ),
					'title'        => esc_html__( 'Video Tutorials', 'vixus' ),
					'content'      => wp_kses( __( 'No time for reading documentation? Check out our video tutorials and learn how to customize Vixus in detail.', 'vixus' ), 'vixus_kses_content' ),
					'link_url'     => esc_url( vixus_storage_get( 'theme_video_url' ) ),
					'link_caption' => esc_html__( 'Video Tutorials', 'vixus' ),
					'duration'     => 15,
				),
				array(
					'image'        => vixus_get_file_url( 'theme-specific/theme-about/images/studio.jpg' ),
					'title'        => esc_html__( 'Website Customization', 'vixus' ),
					'content'      => wp_kses( __( "Need a website fast? Order our custom service, and we'll build a website based on this theme for a very fair price. We can also implement additional functionality such as website translation, setting up WPML, and much more.", 'vixus' ), 'vixus_kses_content' ),
					'link_url'     => esc_url( '//themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themedash' ),
					'link_caption' => esc_html__( 'Contact Us', 'vixus' ),
					'duration'     => 25,
				),
			);
		}
		return $options;
	}
}


//------------------------------------------------------------------------
// OCDI support
//------------------------------------------------------------------------

// Set theme specific OCDI options
if ( ! function_exists( 'vixus_ocdi_set_options' ) ) {
	add_filter( 'trx_addons_filter_ocdi_options', 'vixus_ocdi_set_options', 9 );
	function vixus_ocdi_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			// Prepare demo data
			$options['demo_url'] = esc_url( vixus_get_protocol() . '://demofiles.themerex.net/vixus' );
			// Required plugins
			$options['required_plugins'] = array_keys( vixus_storage_get( 'required_plugins' ) );
			// Demo-site domain
			$options['files']['ocdi']['title']       = esc_html__( 'Vixus OCDI Demo', 'vixus' );
			$options['files']['ocdi']['domain_demo'] = esc_url( vixus_get_protocol() . '://vixus.themerex.net' );
			// If theme need more demo - just copy 'default' and change required parameter
			

		}
		return $options;
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if ( ! function_exists( 'vixus_create_theme_options' ) ) {

	function vixus_create_theme_options() {

		// Message about options override.
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = esc_html__( 'Attention! Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages. If you changed such parameter and nothing happened on the page, this option may be overridden in the corresponding section or in the Page Options of this page. These options are marked with an asterisk (*) in the title.', 'vixus' );

		// Color schemes number: if < 2 - hide fields with selectors
		$hide_schemes = count( vixus_storage_get( 'schemes' ) ) < 2;

		vixus_storage_set(
			'options', array(

				// 'Logo & Site Identity'
				'title_tagline'                 => array(
					'title'    => esc_html__( 'Logo & Site Identity', 'vixus' ),
					'desc'     => '',
					'priority' => 10,
					'type'     => 'section',
				),
				'logo_info'                     => array(
					'title'    => esc_html__( 'Logo Settings', 'vixus' ),
					'desc'     => '',
					'priority' => 20,
					'qsetup'   => esc_html__( 'General', 'vixus' ),
					'type'     => 'info',
				),
				'logo_text'                     => array(
					'title'    => esc_html__( 'Use Site Name as Logo', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Use the site title and tagline as a text logo if no image is selected', 'vixus' ) ),
					'class'    => 'vixus_column-1_2 vixus_new_row',
					'priority' => 30,
					'std'      => 1,
					'qsetup'   => esc_html__( 'General', 'vixus' ),
					'type'     => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_retina_enabled'           => array(
					'title'    => esc_html__( 'Allow retina display logo', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Show fields to select logo images for Retina display', 'vixus' ) ),
					'class'    => 'vixus_column-1_2',
					'priority' => 40,
					'refresh'  => false,
					'std'      => 0,
					'type'     => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_zoom'                     => array(
					'title'   => esc_html__( 'Logo zoom', 'vixus' ),
					'desc'    => wp_kses(
									__( 'Zoom the logo (set 1 to leave original size).', 'vixus' )
									. ' <br>'
									. __( 'Attention! For this parameter to affect images, their max-height should be specified in "em" instead of "px" when creating a header.', 'vixus' )
									. ' <br>'
									. __( 'In this case maximum size of logo depends on the actual size of the picture.', 'vixus' ), 'vixus_kses_content'
								),
					'std'     => 1,
					'min'     => 0.2,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => VIXUS_THEME_FREE ? 'hidden' : 'slider',
				),
				// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
				'logo_retina'                   => array(
					'title'      => esc_html__( 'Logo for Retina', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'vixus' ) ),
					'class'      => 'vixus_column-1_2',
					'priority'   => 70,
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_mobile_header'            => array(
					'title' => esc_html__( 'Logo for the mobile header', 'vixus' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'vixus' ) ),
					'class' => 'vixus_column-1_2 vixus_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_header_retina'     => array(
					'title'      => esc_html__( 'Logo for the mobile header on Retina', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'vixus' ) ),
					'class'      => 'vixus_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_mobile'                   => array(
					'title' => esc_html__( 'Logo for the mobile menu', 'vixus' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile menu', 'vixus' ) ),
					'class' => 'vixus_column-1_2 vixus_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_retina'            => array(
					'title'      => esc_html__( 'Logo mobile on Retina', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'vixus' ) ),
					'class'      => 'vixus_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_side'                     => array(
					'title' => esc_html__( 'Logo for the side menu', 'vixus' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu', 'vixus' ) ),
					'class' => 'vixus_column-1_2 vixus_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_side_retina'              => array(
					'title'      => esc_html__( 'Logo for the side menu on Retina', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'vixus' ) ),
					'class'      => 'vixus_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'image',
				),

				// 'General settings'
				'general'                       => array(
					'title'    => esc_html__( 'General Settings', 'vixus' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 20,
					'type'     => 'section',
				),

				'general_layout_info'           => array(
					'title'  => esc_html__( 'Layout', 'vixus' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'vixus' ),
					'type'   => 'info',
				),
				'body_style'                    => array(
					'title'    => esc_html__( 'Body style', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select width of the body content', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'qsetup'   => esc_html__( 'General', 'vixus' ),
					'refresh'  => false,
					'std'      => 'wide',
					'options'  => vixus_get_list_body_styles( false ),
					'type'     => 'select',
				),
				'page_width'                    => array(
					'title'      => esc_html__( 'Page width', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Total width of the site content and sidebar (in pixels). If empty - use default width', 'vixus' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed', 'wide' ),
					),
					'std'        => 1278,
					'min'        => 1000,
					'max'        => 1400,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'page',         // SASS variable's name to preview changes 'on fly'
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'slider',
				),
				'boxed_bg_image'                => array(
					'title'      => esc_html__( 'Boxed bg image', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select or upload image, used as background in the boxed body', 'vixus' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed' ),
					),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'std'        => '',
					'qsetup'     => esc_html__( 'General', 'vixus' ),

					'type'       => 'image',
				),
				'remove_margins'                => array(
					'title'    => esc_html__( 'Remove margins', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Remove margins above and below the content area', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'refresh'  => false,
					'std'      => 0,
					'type'     => 'checkbox',
				),

				'general_sidebar_info'          => array(
					'title' => esc_html__( 'Sidebar', 'vixus' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position'              => array(
					'title'    => esc_html__( 'Sidebar position', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page',		// Override parameters for single posts moved to the 'sidebar_position_single'
						'section' => esc_html__( 'Widgets', 'vixus' ),
					),
					'std'      => 'right',
					'qsetup'   => esc_html__( 'General', 'vixus' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_position_mobile'       => array(
					'title'    => esc_html__( 'Sidebar position on mobile', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar on mobile devices - above or below the content', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page',		// Override parameters for single posts moved to the 'sidebar_position_mobile_single'
						'section' => esc_html__( 'Widgets', 'vixus' ),
					),
					'dependency' => array(
						'sidebar_position' => array( '^hide' ),
					),
					'std'      => 'below',
					'qsetup'   => esc_html__( 'General', 'vixus' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets'               => array(
					'title'      => esc_html__( 'Sidebar widgets', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page',		// Override parameters for single posts moved to the 'sidebar_widgets_single'
						'section' => esc_html__( 'Widgets', 'vixus' ),
					),
					'dependency' => array(
						'sidebar_position' => array( 'left', 'right' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'vixus' ),
					'type'       => 'select',
				),
				'sidebar_width'                 => array(
					'title'      => esc_html__( 'Sidebar width', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Width of the sidebar (in pixels). If empty - use default width', 'vixus' ) ),
					'std'        => 370,
					'min'        => 150,
					'max'        => 500,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'sidebar',      // SASS variable's name to preview changes 'on fly'
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'slider',
				),
				'sidebar_gap'                   => array(
					'title'      => esc_html__( 'Sidebar gap', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Gap between content and sidebar (in pixels). If empty - use default gap', 'vixus' ) ),
					'std'        => 40,
					'min'        => 0,
					'max'        => 100,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'gap',          // SASS variable's name to preview changes 'on fly'
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'slider',
				),
				'expand_content'                => array(
					'title'   => esc_html__( 'Expand content', 'vixus' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'vixus' ) ),
					'refresh' => false,
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'vixus' ),
					),
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'general_widgets_info'          => array(
					'title' => esc_html__( 'Additional widgets', 'vixus' ),
					'desc'  => '',
					'type'  => VIXUS_THEME_FREE ? 'hidden' : 'info',
				),
				'widgets_above_page'            => array(
					'title'    => esc_html__( 'Widgets at the top of the page', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'vixus' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_above_content'         => array(
					'title'    => esc_html__( 'Widgets above the content', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'vixus' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_content'         => array(
					'title'    => esc_html__( 'Widgets below the content', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'vixus' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_page'            => array(
					'title'    => esc_html__( 'Widgets at the bottom of the page', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'vixus' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),

				'general_effects_info'          => array(
					'title' => esc_html__( 'Design & Effects', 'vixus' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'border_radius'                 => array(
					'title'      => esc_html__( 'Border radius', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Specify the border radius of the form fields and buttons in pixels', 'vixus' ) ),
					'std'        => 5,
					'min'        => 0,
					'max'        => 20,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'rad',      // SASS name to preview changes 'on fly'
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'slider',
				),

				'general_misc_info'             => array(
					'title' => esc_html__( 'Miscellaneous', 'vixus' ),
					'desc'  => '',
					'type'  => VIXUS_THEME_FREE ? 'hidden' : 'info',
				),
				'seo_snippets'                  => array(
					'title' => esc_html__( 'SEO snippets', 'vixus' ),
					'desc'  => wp_kses_data( __( 'Add structured data markup to the single posts and pages', 'vixus' ) ),
					'std'   => 0,
					'type'  => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'privacy_text' => array(
					"title" => esc_html__("Text with Privacy Policy link", 'vixus'),
					"desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'vixus') ),
					"std"   => wp_kses( __( 'I agree that my submitted data is being collected and stored.', 'vixus'), 'vixus_kses_content' ),
					"type"  => "text"
				),

				// 'Header'
				'header'                        => array(
					'title'    => esc_html__( 'Header', 'vixus' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 30,
					'type'     => 'section',
				),

				'header_style_info'             => array(
					'title' => esc_html__( 'Header style', 'vixus' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type'                   => array(
					'title'    => esc_html__( 'Header style', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'vixus' ),
					),
					'std'      => 'default',
					'options'  => vixus_get_list_header_footer_types(),
					'type'     => VIXUS_THEME_FREE || ! vixus_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'vixus' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'vixus' ), 'vixus_kses_content' ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'vixus' ),
					),
					'dependency' => array(
						'header_type' => array( 'custom' ),
					),
					'std'        => VIXUS_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position'               => array(
					'title'    => esc_html__( 'Header position', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'vixus' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'type'     => VIXUS_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight'             => array(
					'title'    => esc_html__( 'Header fullheight', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'vixus' ),
					),
					'std'      => 0,
					'type'     => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_wide'                   => array(
					'title'      => esc_html__( 'Header fullwidth', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'vixus' ),
					),
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'std'        => 1,
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_zoom'                   => array(
					'title'   => esc_html__( 'Header zoom', 'vixus' ),
					'desc'    => wp_kses_data( __( 'Zoom the header title. 1 - original size', 'vixus' ) ),
					'std'     => 1,
					'min'     => 0.3,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => VIXUS_THEME_FREE ? 'hidden' : 'slider',
				),

				'header_widgets_info'           => array(
					'title' => esc_html__( 'Header widgets', 'vixus' ),
					'desc'  => wp_kses_data( __( 'Here you can place a widget slider, advertising banners, etc.', 'vixus' ) ),
					'type'  => 'info',
				),
				'header_widgets'                => array(
					'title'    => esc_html__( 'Header widgets', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select set of widgets to show in the header on each page', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'vixus' ),
						'desc'    => wp_kses_data( __( 'Select set of widgets to show in the header on this page', 'vixus' ) ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => 'select',
				),
				'header_columns'                => array(
					'title'      => esc_html__( 'Header columns', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'vixus' ),
					),
					'dependency' => array(
						'header_type'    => array( 'default' ),
						'header_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => vixus_get_list_range( 0, 6 ),
					'type'       => 'select',
				),

				'menu_info'                     => array(
					'title' => esc_html__( 'Main menu', 'vixus' ),
					'desc'  => wp_kses_data( __( 'Select main menu style, position and other parameters', 'vixus' ) ),
					'type'  => VIXUS_THEME_FREE ? 'hidden' : 'info',
				),
				'menu_style'                    => array(
					'title'    => esc_html__( 'Menu position', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select position of the main menu', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'vixus' ),
					),
					'std'      => 'top',
					'options'  => array(
						'top'   => esc_html__( 'Top', 'vixus' ),
						'left'  => esc_html__( 'Left', 'vixus' ),
						'right' => esc_html__( 'Right', 'vixus' ),
					),
					'type'     => VIXUS_THEME_FREE || ! vixus_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'menu_side_stretch'             => array(
					'title'      => esc_html__( 'Stretch sidemenu', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Stretch sidemenu to window height (if menu items number >= 5)', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'vixus' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 0,
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_side_icons'               => array(
					'title'      => esc_html__( 'Iconed sidemenu', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'vixus' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 1,
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_mobile_fullscreen'        => array(
					'title' => esc_html__( 'Mobile menu fullscreen', 'vixus' ),
					'desc'  => wp_kses_data( __( 'Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'vixus' ) ),
					'std'   => 1,
					'type'  => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_image_info'             => array(
					'title' => esc_html__( 'Header image', 'vixus' ),
					'desc'  => '',
					'type'  => VIXUS_THEME_FREE ? 'hidden' : 'info',
				),
				'header_image_override'         => array(
					'title'    => esc_html__( 'Header image override', 'vixus' ),
					'desc'     => wp_kses_data( __( "Allow override the header image with the page's/post's/product's/etc. featured image", 'vixus' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'vixus' ),
					),
					'std'      => 0,
					'type'     => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_mobile_info'            => array(
					'title'      => esc_html__( 'Mobile header', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Configure the mobile version of the header', 'vixus' ) ),
					'priority'   => 500,
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'info',
				),
				'header_mobile_enabled'         => array(
					'title'      => esc_html__( 'Enable the mobile header', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Use the mobile version of the header (if checked) or relayout the current header on mobile devices', 'vixus' ) ),
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_additional_info' => array(
					'title'      => esc_html__( 'Additional info', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Additional info to show at the top of the mobile header', 'vixus' ) ),
					'std'        => '',
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'refresh'    => false,
					'teeny'      => false,
					'rows'       => 20,
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'text_editor',
				),
				'header_mobile_hide_info'       => array(
					'title'      => esc_html__( 'Hide additional info', 'vixus' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_logo'       => array(
					'title'      => esc_html__( 'Hide logo', 'vixus' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_login'      => array(
					'title'      => esc_html__( 'Hide login/logout', 'vixus' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_search'     => array(
					'title'      => esc_html__( 'Hide search', 'vixus' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_cart'       => array(
					'title'      => esc_html__( 'Hide cart', 'vixus' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),

				// 'Footer'
				'footer'                        => array(
					'title'    => esc_html__( 'Footer', 'vixus' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 50,
					'type'     => 'section',
				),
				'footer_type'                   => array(
					'title'    => esc_html__( 'Footer style', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'vixus' ),
					),
					'std'      => 'default',
					'options'  => vixus_get_list_header_footer_types(),
					'type'     => VIXUS_THEME_FREE || ! vixus_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'footer_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'vixus' ),
					'desc'       => wp_kses( __( 'Select custom footer from Layouts Builder', 'vixus' ), 'vixus_kses_content' ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'vixus' ),
					),
					'dependency' => array(
						'footer_type' => array( 'custom' ),
					),
					'std'        => VIXUS_THEME_FREE ? 'footer-custom-elementor-footer-default' : 'footer-custom-footer-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_widgets'                => array(
					'title'      => esc_html__( 'Footer widgets', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'vixus' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 'footer_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_columns'                => array(
					'title'      => esc_html__( 'Footer columns', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'vixus' ),
					),
					'dependency' => array(
						'footer_type'    => array( 'default' ),
						'footer_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => vixus_get_list_range( 0, 6 ),
					'type'       => 'select',
				),
				'footer_wide'                   => array(
					'title'      => esc_html__( 'Footer fullwidth', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'vixus' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'logo_in_footer'                => array(
					'title'      => esc_html__( 'Show logo', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Show logo in the footer', 'vixus' ) ),
					'refresh'    => false,
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'logo_footer'                   => array(
					'title'      => esc_html__( 'Logo for footer', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo to display it in the footer', 'vixus' ) ),
					'dependency' => array(
						'footer_type'    => array( 'default' ),
						'logo_in_footer' => array( 1 ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'logo_footer_retina'            => array(
					'title'      => esc_html__( 'Logo for footer (Retina)', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'vixus' ) ),
					'dependency' => array(
						'footer_type'         => array( 'default' ),
						'logo_in_footer'      => array( 1 ),
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'image',
				),
				'socials_in_footer'             => array(
					'title'      => esc_html__( 'Show social icons', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Show social icons in the footer (under logo or footer widgets)', 'vixus' ) ),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => ! vixus_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'copyright'                     => array(
					'title'      => esc_html__( 'Copyright', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'vixus' ) ),
					'translate'  => true,
					'std'        => esc_html__( 'Copyright &copy; {Y} by ThemeREX. All rights reserved.', 'vixus' ),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'refresh'    => false,
					'type'       => 'textarea',
				),

				// 'Blog'
				'blog'                          => array(
					'title'    => esc_html__( 'Blog', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Options of the the blog archive', 'vixus' ) ),
					'priority' => 70,
					'type'     => 'panel',
				),

				// Blog - Posts page
				'blog_general'                  => array(
					'title' => esc_html__( 'Posts page', 'vixus' ),
					'desc'  => wp_kses_data( __( 'Style and components of the blog archive', 'vixus' ) ),
					'type'  => 'section',
				),
				'blog_general_info'             => array(
					'title'  => esc_html__( 'Posts page settings', 'vixus' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'vixus' ),
					'type'   => 'info',
				),
				'blog_style'                    => array(
					'title'      => esc_html__( 'Blog style', 'vixus' ),
					'desc'       => '',
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
                        '.components-select-control:not(.post-author-selector) select' => array( 'blog.php' )
					),
					'std'        => 'excerpt',
					'qsetup'     => esc_html__( 'General', 'vixus' ),
					'options'    => array(),
					'type'       => 'select',
				),
				'first_post_large'              => array(
					'title'      => esc_html__( 'First post large', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Make your first post stand out by making it bigger', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
                        '.components-select-control:not(.post-author-selector) select' => array( 'blog.php' ),
						'blog_style' => array( 'classic', 'masonry' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'blog_content'                  => array(
					'title'      => esc_html__( 'Posts content', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Display either post excerpts or hide post content', 'vixus' ) ),
					'std'        => 'fullpost',
					'dependency' => array(
						'blog_style' => array( 'excerpt' ),
					),
					'options'    => array(
						'excerpt'  => esc_html__( 'Excerpt', 'vixus' ),
						'fullpost' => esc_html__( 'Hide Excerpt', 'vixus' ),
					),
					'type'       => 'switch',
				),
				'excerpt_length'                => array(
					'title'      => esc_html__( 'Excerpt length', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged', 'vixus' ) ),
					'dependency' => array(
						'blog_style'   => array( 'excerpt' ),
						'blog_content' => array( 'excerpt' ),
					),
					'std'        => 60,
					'type'       => 'text',
				),
				'blog_columns'                  => array(
					'title'   => esc_html__( 'Blog columns', 'vixus' ),
					'desc'    => wp_kses_data( __( 'How many columns should be used in the blog archive (from 2 to 4)?', 'vixus' ) ),
					'std'     => 2,
					'options' => vixus_get_list_range( 2, 4 ),
					'type'    => 'hidden',      // This options is available and must be overriden only for some modes (for example, 'shop')
				),
				'post_type'                     => array(
					'title'      => esc_html__( 'Post type', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select post type to show in the blog archive', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
                        '.components-select-control:not(.post-author-selector) select' => array( 'blog.php' )
					),
					'linked'     => 'parent_cat',
					'refresh'    => false,
					'hidden'     => true,
					'std'        => 'post',
					'options'    => array(),
					'type'       => 'select',
				),
				'parent_cat'                    => array(
					'title'      => esc_html__( 'Category to show', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select category to show in the blog archive', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
                        '.components-select-control:not(.post-author-selector) select' => array( 'blog.php' )
					),
					'refresh'    => false,
					'hidden'     => true,
					'std'        => '0',
					'options'    => array(),
					'type'       => 'select',
				),
				'posts_per_page'                => array(
					'title'      => esc_html__( 'Posts per page', 'vixus' ),
					'desc'       => wp_kses_data( __( 'How many posts will be displayed on this page', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
                        '.components-select-control:not(.post-author-selector) select' => array( 'blog.php' )
					),
					'hidden'     => true,
					'std'        => '',
					'type'       => 'text',
				),
				'blog_pagination'               => array(
					'title'      => esc_html__( 'Pagination style', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Show Older/Newest posts or Page numbers below the posts list', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'std'        => 'pages',
					'qsetup'     => esc_html__( 'General', 'vixus' ),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
                        '.components-select-control:not(.post-author-selector) select' => array( 'blog.php' )
					),
					'options'    => array(
						'pages'    => esc_html__( 'Page numbers', 'vixus' ),
						'links'    => esc_html__( 'Older/Newest', 'vixus' ),
						'more'     => esc_html__( 'Load more', 'vixus' ),
						'infinite' => esc_html__( 'Infinite scroll', 'vixus' ),
					),
					'type'       => 'select',
				),
				'blog_animation'                => array(
					'title'      => esc_html__( 'Animation for the posts', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
                        '.components-select-control:not(.post-author-selector) select' => array( 'blog.php' )
					),
					'std'        => 'none',
					'options'    => array(),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),
				'show_filters'                  => array(
					'title'      => esc_html__( 'Show filters', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Show categories as tabs to filter posts', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
                        '.components-select-control:not(.post-author-selector) select' => array( 'blog.php' ),
						'blog_style'     => array( 'portfolio', 'gallery' ),
					),
					'hidden'     => true,
					'std'        => 0,
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'blog_header_info'              => array(
					'title' => esc_html__( 'Header', 'vixus' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type_blog'              => array(
					'title'    => esc_html__( 'Header style', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'vixus' ) ),
					'std'      => 'inherit',
					'options'  => vixus_get_list_header_footer_types( true ),
					'type'     => VIXUS_THEME_FREE || ! vixus_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style_blog'             => array(
					'title'      => esc_html__( 'Select custom layout', 'vixus' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'vixus' ), 'vixus_kses_content' ),
					'dependency' => array(
						'header_type_blog' => array( 'custom' ),
					),
					'std'        => VIXUS_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position_blog'          => array(
					'title'    => esc_html__( 'Header position', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'vixus' ) ),
					'std'      => 'inherit',
					'options'  => array(),
					'type'     => VIXUS_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight_blog'        => array(
					'title'    => esc_html__( 'Header fullheight', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'vixus' ) ),
					'std'      => 0,
					'type'     => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_wide_blog'              => array(
					'title'      => esc_html__( 'Header fullwidth', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'vixus' ) ),
					'dependency' => array(
						'header_type_blog' => array( 'default' ),
					),
					'std'        => 1,
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'blog_sidebar_info'             => array(
					'title' => esc_html__( 'Sidebar', 'vixus' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position_blog'         => array(
					'title'   => esc_html__( 'Sidebar position', 'vixus' ),
					'desc'    => wp_kses_data( __( 'Select position to show sidebar', 'vixus' ) ),
					'std'     => 'inherit',
					'options' => array(),
					'qsetup'     => esc_html__( 'General', 'vixus' ),
					'type'    => 'switch',
				),
				'sidebar_position_mobile_blog'  => array(
					'title'    => esc_html__( 'Sidebar position on mobile', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar on mobile devices - above or below the content', 'vixus' ) ),
					'dependency' => array(
						'sidebar_position_blog' => array( '^hide' ),
					),
					'std'      => 'inherit',
					'qsetup'   => esc_html__( 'General', 'vixus' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets_blog'          => array(
					'title'      => esc_html__( 'Sidebar widgets', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'vixus' ) ),
					'dependency' => array(
						'sidebar_position_blog' => array( '^hide' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'vixus' ),
					'type'       => 'select',
				),
				'expand_content_blog'           => array(
					'title'   => esc_html__( 'Expand content', 'vixus' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'vixus' ) ),
					'refresh' => false,
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'blog_widgets_info'             => array(
					'title' => esc_html__( 'Additional widgets', 'vixus' ),
					'desc'  => '',
					'type'  => VIXUS_THEME_FREE ? 'hidden' : 'info',
				),
				'widgets_above_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the top of the page', 'vixus' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'vixus' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_above_content_blog'    => array(
					'title'   => esc_html__( 'Widgets above the content', 'vixus' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'vixus' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_content_blog'    => array(
					'title'   => esc_html__( 'Widgets below the content', 'vixus' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'vixus' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the bottom of the page', 'vixus' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'vixus' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),

				'blog_advanced_info'            => array(
					'title' => esc_html__( 'Advanced settings', 'vixus' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'no_image'                      => array(
					'title' => esc_html__( 'Image placeholder', 'vixus' ),
					'desc'  => wp_kses_data( __( 'Select or upload an image used as placeholder for posts without a featured image', 'vixus' ) ),
					'std'   => '',
					'type'  => 'image',
				),
				'time_diff_before'              => array(
					'title' => esc_html__( 'Easy Readable Date Format', 'vixus' ),
					'desc'  => wp_kses_data( __( "For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'vixus' ) ),
					'std'   => 0,
					'type'  => 'text',
				),
				'sticky_style'                  => array(
					'title'   => esc_html__( 'Sticky posts style', 'vixus' ),
					'desc'    => wp_kses_data( __( 'Select style of the sticky posts output', 'vixus' ) ),
					'std'     => 'inherit',
					'options' => array(
						'inherit' => esc_html__( 'Decorated posts', 'vixus' ),
						'columns' => esc_html__( 'Mini-cards', 'vixus' ),
					),
					'type'    => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),
				'meta_parts'                    => array(
					'title'      => esc_html__( 'Post meta', 'vixus' ),
					'desc'       => wp_kses_data( __( "If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page. Post counters and Share Links are available only if plugin ThemeREX Addons is active", 'vixus' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
                        '.components-select-control:not(.post-author-selector) select' => array( 'blog.php' )
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'categories=0|author=1|counters=0|date=1|share=0|edit=0',
					'options'    => vixus_get_list_meta_parts(),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checklist',
				),
				'counters'                      => array(
					'title'      => esc_html__( 'Post counters', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Show only selected counters. Attention! Likes and Views are available only if ThemeREX Addons is active', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
                        '.components-select-control:not(.post-author-selector) select' => array( 'blog.php' )
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'views=0|likes=0|comments=0',
					'options'    => vixus_get_list_counters(),
					'type'       => VIXUS_THEME_FREE || ! vixus_exists_trx_addons() ? 'hidden' : 'checklist',
				),

				// Blog - Single posts
				'blog_single'                   => array(
					'title' => esc_html__( 'Single posts', 'vixus' ),
					'desc'  => wp_kses_data( __( 'Settings of the single post', 'vixus' ) ),
					'type'  => 'section',
				),

				'blog_single_header_info'       => array(
					'title' => esc_html__( 'Header', 'vixus' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type_post'              => array(
					'title'    => esc_html__( 'Header style', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'vixus' ) ),
					'std'      => 'inherit',
					'options'  => vixus_get_list_header_footer_types( true ),
					'type'     => VIXUS_THEME_FREE || ! vixus_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style_post'             => array(
					'title'      => esc_html__( 'Select custom layout', 'vixus' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'vixus' ), 'vixus_kses_content' ),
					'dependency' => array(
						'header_type_post' => array( 'custom' ),
					),
					'std'        => VIXUS_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position_post'          => array(
					'title'    => esc_html__( 'Header position', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'vixus' ) ),
					'std'      => 'inherit',
					'options'  => array(),
					'type'     => VIXUS_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight_post'        => array(
					'title'    => esc_html__( 'Header fullheight', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'vixus' ) ),
					'std'      => 0,
					'type'     => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_wide_post'              => array(
					'title'      => esc_html__( 'Header fullwidth', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'vixus' ) ),
					'dependency' => array(
						'header_type_post' => array( 'default' ),
					),
					'std'        => 1,
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'blog_single_sidebar_info'      => array(
					'title' => esc_html__( 'Sidebar', 'vixus' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position_single'       => array(
					'title'   => esc_html__( 'Sidebar position', 'vixus' ),
					'desc'    => wp_kses_data( __( 'Select position to show sidebar on the single posts', 'vixus' ) ),
					'std'     => 'right',
					'override'   => array(
						'mode'    => 'post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'vixus' ),
					),
					'options' => array(),
					'type'    => 'switch',
				),
				'sidebar_position_mobile_single'=> array(
					'title'    => esc_html__( 'Sidebar position on mobile', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar on the single posts on mobile devices - above or below the content', 'vixus' ) ),
					'override' => array(
						'mode'    => 'post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'vixus' ),
					),
					'dependency' => array(
						'sidebar_position_single' => array( '^hide' ),
					),
					'std'      => 'below',
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets_single'        => array(
					'title'      => esc_html__( 'Sidebar widgets', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar on the single posts', 'vixus' ) ),
					'override'   => array(
						'mode'    => 'post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'vixus' ),
					),
					'dependency' => array(
						'sidebar_position_single' => array( '^hide' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'expand_content_post'           => array(
					'title'   => esc_html__( 'Expand content', 'vixus' ),
					'desc'    => wp_kses_data( __( 'Expand the content width on the single posts if the sidebar is hidden', 'vixus' ) ),
					'refresh' => false,
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'blog_single_title_info'      => array(
					'title' => esc_html__( 'Featured image and title', 'vixus' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'hide_featured_on_single'       => array(
					'title'    => esc_html__( 'Hide featured image on the single post', 'vixus' ),
					'desc'     => wp_kses_data( __( "Hide featured image on the single post's pages", 'vixus' ) ),
					'override' => array(
						'mode'    => 'page,post',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'post_thumbnail_type'      => array(
					'title'      => esc_html__( 'Type of post thumbnail', 'vixus' ),
					'desc'       => wp_kses_data( __( "Select type of post thumbnail on the single post's pages", 'vixus' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'dependency' => array(
						'hide_featured_on_single' => array( 'is_empty', 0 ),
					),
					'std'        => 'default',
					'options'    => array(
						'fullwidth'   => esc_html__( 'Fullwidth', 'vixus' ),
						'boxed'       => esc_html__( 'Boxed', 'vixus' ),
						'default'     => esc_html__( 'Default', 'vixus' ),
					),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),
				'post_header_position'          => array(
					'title'      => esc_html__( 'Post header position', 'vixus' ),
					'desc'       => wp_kses_data( __( "Select post header position on the single post's pages", 'vixus' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'dependency' => array(
						'hide_featured_on_single' => array( 'is_empty', 0 ),
					),
					'std'        => 'under',
					'options'    => array(
						'above'      => esc_html__( 'Above the post thumbnail', 'vixus' ),
						'under'      => esc_html__( 'Under the post thumbnail', 'vixus' ),
						'on_thumb'   => esc_html__( 'On the post thumbnail', 'vixus' ),
						'default'    => esc_html__( 'Default', 'vixus' ),
					),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),
				'post_header_align'             => array(
					'title'      => esc_html__( 'Align of the post header', 'vixus' ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'dependency' => array(
						'post_header_position' => array( 'on_thumb' ),
					),
					'std'        => 'mc',
					'options'    => array(
						'ts' => esc_html__('Top Stick Out', 'vixus'),
						'tl' => esc_html__('Top Left', 'vixus'),
						'tc' => esc_html__('Top Center', 'vixus'),
						'tr' => esc_html__('Top Right', 'vixus'),
						'ml' => esc_html__('Middle Left', 'vixus'),
						'mc' => esc_html__('Middle Center', 'vixus'),
						'mr' => esc_html__('Middle Right', 'vixus'),
						'bl' => esc_html__('Bottom Left', 'vixus'),
						'bc' => esc_html__('Bottom Center', 'vixus'),
						'br' => esc_html__('Bottom Right', 'vixus'),
						'bs' => esc_html__('Bottom Stick Out', 'vixus'),
					),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),
				'post_subtitle'                 => array(
					'title' => esc_html__( 'Post subtitle', 'vixus' ),
					'desc'  => wp_kses_data( __( "Specify post subtitle to display it under the post title.", 'vixus' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'std'   => '',
					'hidden' => true,
					'type'  => 'text',
				),
				'show_post_meta'                => array(
					'title' => esc_html__( 'Show post meta', 'vixus' ),
					'desc'  => wp_kses_data( __( "Display block with post's meta: date, categories, counters, etc.", 'vixus' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),
				'meta_parts_post'               => array(
					'title'      => esc_html__( 'Post meta', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Meta parts for single posts. Post counters and Share Links are available only if plugin ThemeREX Addons is active', 'vixus' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'vixus' ) ),
					'dependency' => array(
						'show_post_meta' => array( 1 ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'categories=1|author=1|counters=0|date=1|share=0|edit=0',
					'options'    => vixus_get_list_meta_parts(),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checklist',
				),
				'counters_post'                 => array(
					'title'      => esc_html__( 'Post counters', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Show only selected counters. Attention! Likes and Views are available only if plugin ThemeREX Addons is active', 'vixus' ) ),
					'dependency' => array(
						'show_post_meta' => array( 1 ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'views=0|likes=0|comments=0',
					'options'    => vixus_get_list_counters(),
					'type'       => VIXUS_THEME_FREE || ! vixus_exists_trx_addons() ? 'hidden' : 'checklist',
				),
				'show_share_links'              => array(
					'title' => esc_html__( 'Show share links', 'vixus' ),
					'desc'  => wp_kses_data( __( 'Display share links on the single post', 'vixus' ) ),
					'std'   => 1,
					'type'  => ! vixus_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'show_author_info'              => array(
					'title' => esc_html__( 'Show author info', 'vixus' ),
					'desc'  => wp_kses_data( __( "Display block with information about post's author", 'vixus' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),

				'blog_single_related_info'      => array(
					'title' => esc_html__( 'Related posts', 'vixus' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'show_related_posts'            => array(
					'title'    => esc_html__( 'Show related posts', 'vixus' ),
					'desc'     => wp_kses_data( __( "Show section 'Related posts' on the single post's pages", 'vixus' ) ),
					'override' => array(
						'mode'    => 'page,post',
						'section' => esc_html__( 'Content', 'vixus' ),
					),
					'std'      => 1,
					'type'     => 'checkbox',
				),
				'related_posts'                 => array(
					'title'      => esc_html__( 'Related posts', 'vixus' ),
					'desc'       => wp_kses_data( __( 'How many related posts should be displayed in the single post? If 0 - no related posts are shown.', 'vixus' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'options'    => vixus_get_list_range( 1, 9 ),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),
				'related_columns'               => array(
					'title'      => esc_html__( 'Related columns', 'vixus' ),
					'desc'       => wp_kses_data( __( 'How many columns should be used to output related posts in the single page (from 2 to 4)?', 'vixus' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'options'    => vixus_get_list_range( 1, 4 ),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_style'                 => array(
					'title'      => esc_html__( 'Related posts style', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select style of the related posts output', 'vixus' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'options'    => vixus_get_list_styles( 1, 3 ),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_slider'                => array(
					'title'      => esc_html__( 'Use slider layout', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Use slider layout in case related posts count is more than columns count', 'vixus' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 0,
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'related_slider_controls'       => array(
					'title'      => esc_html__( 'Slider controls', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Show arrows in the slider', 'vixus' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'none',
					'options'    => array(
						'none'    => esc_html__('None', 'vixus'),
						'side'    => esc_html__('Side', 'vixus'),
						'outside' => esc_html__('Outside', 'vixus'),
						'top'     => esc_html__('Top', 'vixus'),
						'bottom'  => esc_html__('Bottom', 'vixus')
					),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'select',
				),
				'related_slider_pagination'       => array(
					'title'      => esc_html__( 'Slider pagination', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Show bullets after the slider', 'vixus' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'bottom',
					'options'    => array(
						'none'    => esc_html__('None', 'vixus'),
						'bottom'  => esc_html__('Bottom', 'vixus')
					),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_slider_space'          => array(
					'title'      => esc_html__( 'Space', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Space between slides', 'vixus' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 30,
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'text',
				),
				'related_position'              => array(
					'title'      => esc_html__( 'Related posts position', 'vixus' ),
					'desc'       => wp_kses_data( __( 'Select position to display the related posts', 'vixus' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 'below_content',
					'options'    => array (
						'below_content' => esc_html__( 'After content', 'vixus' ),
						'below_page'    => esc_html__( 'After content & sidebar', 'vixus' ),
					),
					'type'       => VIXUS_THEME_FREE ? 'hidden' : 'switch',
				),
				'posts_navigation_info'      => array(
					'title' => esc_html__( 'Posts navigation', 'vixus' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'show_posts_navigation'		=> array(
					'title'    => esc_html__( 'Show posts navigation', 'vixus' ),
					'desc'     => wp_kses_data( __( "Show posts navigation on the single post's pages", 'vixus' ) ),
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'fixed_posts_navigation'		=> array(
					'title'    => esc_html__( 'Fixed posts navigation', 'vixus' ),
					'desc'     => wp_kses_data( __( "Make posts navigation fixed position. Display it when the content of the article is inside the window.", 'vixus' ) ),
					'dependency' => array(
						'show_posts_navigation' => array( 1 ),
					),
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'blog_end'                      => array(
					'type' => 'panel_end',
				),

				// 'Colors'
				'panel_colors'                  => array(
					'title'    => esc_html__( 'Colors', 'vixus' ),
					'desc'     => '',
					'priority' => 300,
					'type'     => 'section',
				),

				'color_schemes_info'            => array(
					'title'  => esc_html__( 'Color schemes', 'vixus' ),
					'desc'   => wp_kses_data( __( 'Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'vixus' ) ),
					'hidden' => $hide_schemes,
					'type'   => 'info',
				),
				'color_scheme'                  => array(
					'title'    => esc_html__( 'Site Color Scheme', 'vixus' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'vixus' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'header_scheme'                 => array(
					'title'    => esc_html__( 'Header Color Scheme', 'vixus' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'vixus' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'menu_scheme'                   => array(
					'title'    => esc_html__( 'Sidemenu Color Scheme', 'vixus' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'vixus' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes || VIXUS_THEME_FREE ? 'hidden' : 'switch',
				),
				'sidebar_scheme'                => array(
					'title'    => esc_html__( 'Sidebar Color Scheme', 'vixus' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'vixus' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'footer_scheme'                 => array(
					'title'    => esc_html__( 'Footer Color Scheme', 'vixus' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'vixus' ),
					),
					'std'      => 'dark',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),

				'color_scheme_editor_info'      => array(
					'title' => esc_html__( 'Color scheme editor', 'vixus' ),
					'desc'  => wp_kses_data( __( 'Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'vixus' ) ),
					'type'  => 'info',
				),
				'scheme_storage'                => array(
					'title'       => esc_html__( 'Color scheme editor', 'vixus' ),
					'desc'        => '',
					'std'         => '$vixus_get_scheme_storage',
					'refresh'     => false,
					'colorpicker' => 'tiny',
					'type'        => 'scheme_editor',
				),

				// Internal options.
				// Attention! Don't change any options in the section below!
				// Use huge priority to call render this elements after all options!
				'reset_options'                 => array(
					'title'    => '',
					'desc'     => '',
					'std'      => '0',
					'priority' => 10000,
					'type'     => 'hidden',
				),

				'last_option'                   => array(     // Need to manually call action to include Tiny MCE scripts
					'title' => '',
					'desc'  => '',
					'std'   => 1,
					'type'  => 'hidden',
				),

			)
		);

		// Prepare panel 'Fonts'
		// -------------------------------------------------------------
		$fonts = array(

			// 'Fonts'
			'fonts'             => array(
				'title'    => esc_html__( 'Typography', 'vixus' ),
				'desc'     => '',
				'priority' => 200,
				'type'     => 'panel',
			),

			// Fonts - Load_fonts
			'load_fonts'        => array(
				'title' => esc_html__( 'Load fonts', 'vixus' ),
				'desc'  => wp_kses_data( __( 'Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'vixus' ) )
						. '<br>'
						. wp_kses_data( __( 'Attention! Press "Refresh" button to reload preview area after the all fonts are changed', 'vixus' ) ),
				'type'  => 'section',
			),
			'load_fonts_subset' => array(
				'title'   => esc_html__( 'Google fonts subsets', 'vixus' ),
				'desc'    => wp_kses_data( __( 'Specify comma separated list of the subsets which will be load from Google fonts', 'vixus' ) )
						. '<br>'
						. wp_kses_data( __( 'Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'vixus' ) ),
				'class'   => 'vixus_column-1_3 vixus_new_row',
				'refresh' => false,
				'std'     => '$vixus_get_load_fonts_subset',
				'type'    => 'text',
			),
		);

		for ( $i = 1; $i <= vixus_get_theme_setting( 'max_load_fonts' ); $i++ ) {
			if ( vixus_get_value_gp( 'page' ) != 'theme_options' ) {
				$fonts[ "load_fonts-{$i}-info" ] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					'title' => esc_html( sprintf( __( 'Font %s', 'vixus' ), $i ) ),
					'desc'  => '',
					'type'  => 'info',
				);
			}
			$fonts[ "load_fonts-{$i}-name" ]   = array(
				'title'   => esc_html__( 'Font name', 'vixus' ),
				'desc'    => '',
				'class'   => 'vixus_column-1_3 vixus_new_row',
				'refresh' => false,
				'std'     => '$vixus_get_load_fonts_option',
				'type'    => 'text',
			);
			$fonts[ "load_fonts-{$i}-family" ] = array(
				'title'   => esc_html__( 'Font family', 'vixus' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Select font family to use it if font above is not available', 'vixus' ) )
							: '',
				'class'   => 'vixus_column-1_3',
				'refresh' => false,
				'std'     => '$vixus_get_load_fonts_option',
				'options' => array(
					'inherit'    => esc_html__( 'Inherit', 'vixus' ),
					'serif'      => esc_html__( 'serif', 'vixus' ),
					'sans-serif' => esc_html__( 'sans-serif', 'vixus' ),
					'monospace'  => esc_html__( 'monospace', 'vixus' ),
					'cursive'    => esc_html__( 'cursive', 'vixus' ),
					'fantasy'    => esc_html__( 'fantasy', 'vixus' ),
				),
				'type'    => 'select',
			);
			$fonts[ "load_fonts-{$i}-styles" ] = array(
				'title'   => esc_html__( 'Font styles', 'vixus' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'vixus' ) )
								. '<br>'
								. wp_kses_data( __( 'Attention! Each weight and style increase download size! Specify only used weights and styles.', 'vixus' ) )
							: '',
				'class'   => 'vixus_column-1_3',
				'refresh' => false,
				'std'     => '$vixus_get_load_fonts_option',
				'type'    => 'text',
			);
		}
		$fonts['load_fonts_end'] = array(
			'type' => 'section_end',
		);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = vixus_get_theme_fonts();
		foreach ( $theme_fonts as $tag => $v ) {
			$fonts[ "{$tag}_section" ] = array(
				'title' => ! empty( $v['title'] )
								? $v['title']
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html( sprintf( __( '%s settings', 'vixus' ), $tag ) ),
				'desc'  => ! empty( $v['description'] )
								? $v['description']
								// Translators: Add tag's name to make description
								: wp_kses( sprintf( __( 'Font settings of the "%s" tag.', 'vixus' ), $tag ), 'vixus_kses_content' ),
				'type'  => 'section',
			);

			foreach ( $v as $css_prop => $css_value ) {
				if ( in_array( $css_prop, array( 'title', 'description' ) ) ) {
					continue;
				}
				$options    = '';
				$type       = 'text';
				$load_order = 1;
				$title      = ucfirst( str_replace( '-', ' ', $css_prop ) );
				if ( 'font-family' == $css_prop ) {
					$type       = 'select';
					$options    = array();
					$load_order = 2;        // Load this option's value after all options are loaded (use option 'load_fonts' to build fonts list)
				} elseif ( 'font-weight' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'vixus' ),
						'100'     => esc_html__( '100 (Light)', 'vixus' ),
						'200'     => esc_html__( '200 (Light)', 'vixus' ),
						'300'     => esc_html__( '300 (Thin)', 'vixus' ),
						'400'     => esc_html__( '400 (Normal)', 'vixus' ),
						'500'     => esc_html__( '500 (Semibold)', 'vixus' ),
						'600'     => esc_html__( '600 (Semibold)', 'vixus' ),
						'700'     => esc_html__( '700 (Bold)', 'vixus' ),
						'800'     => esc_html__( '800 (Black)', 'vixus' ),
						'900'     => esc_html__( '900 (Black)', 'vixus' ),
					);
				} elseif ( 'font-style' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'vixus' ),
						'normal'  => esc_html__( 'Normal', 'vixus' ),
						'italic'  => esc_html__( 'Italic', 'vixus' ),
					);
				} elseif ( 'text-decoration' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'      => esc_html__( 'Inherit', 'vixus' ),
						'none'         => esc_html__( 'None', 'vixus' ),
						'underline'    => esc_html__( 'Underline', 'vixus' ),
						'overline'     => esc_html__( 'Overline', 'vixus' ),
						'line-through' => esc_html__( 'Line-through', 'vixus' ),
					);
				} elseif ( 'text-transform' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'    => esc_html__( 'Inherit', 'vixus' ),
						'none'       => esc_html__( 'None', 'vixus' ),
						'uppercase'  => esc_html__( 'Uppercase', 'vixus' ),
						'lowercase'  => esc_html__( 'Lowercase', 'vixus' ),
						'capitalize' => esc_html__( 'Capitalize', 'vixus' ),
					);
				}
				$fonts[ "{$tag}_{$css_prop}" ] = array(
					'title'      => $title,
					'desc'       => '',
					'class'      => 'vixus_column-1_5',
					'refresh'    => false,
					'load_order' => $load_order,
					'std'        => '$vixus_get_theme_fonts_option',
					'options'    => $options,
					'type'       => $type,
				);
			}

			$fonts[ "{$tag}_section_end" ] = array(
				'type' => 'section_end',
			);
		}

		$fonts['fonts_end'] = array(
			'type' => 'panel_end',
		);

		// Add fonts parameters to Theme Options
		vixus_storage_set_array_before( 'options', 'panel_colors', $fonts );

		// Add Header Video if WP version < 4.7
		// -----------------------------------------------------
		if ( ! function_exists( 'get_header_video_url' ) ) {
			vixus_storage_set_array_after(
				'options', 'header_image_override', 'header_video', array(
					'title'    => esc_html__( 'Header video', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select video to use it as background for the header', 'vixus' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'vixus' ),
					),
					'std'      => '',
					'type'     => 'video',
				)
			);
		}

		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is not 'Customize'
		// ------------------------------------------------------
		if ( ! function_exists( 'the_custom_logo' ) || ! vixus_check_current_url( 'customize.php' ) ) {
			vixus_storage_set_array_before(
				'options', 'logo_retina', function_exists( 'the_custom_logo' ) ? 'custom_logo' : 'logo', array(
					'title'    => esc_html__( 'Logo', 'vixus' ),
					'desc'     => wp_kses_data( __( 'Select or upload the site logo', 'vixus' ) ),
					'class'    => 'vixus_column-1_2 vixus_new_row',
					'priority' => 60,
					'std'      => '',
					'qsetup'   => esc_html__( 'General', 'vixus' ),
					'type'     => 'image',
				)
			);
		}

	}
}


// Returns a list of options that can be overridden for CPT
if ( ! function_exists( 'vixus_options_get_list_cpt_options' ) ) {
	function vixus_options_get_list_cpt_options( $cpt, $title = '' ) {
		if ( empty( $title ) ) {
			$title = ucfirst( $cpt );
		}
		return array(
			"content_info_{$cpt}"           => array(
				'title' => esc_html__( 'Content', 'vixus' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"body_style_{$cpt}"             => array(
				'title'    => esc_html__( 'Body style', 'vixus' ),
				'desc'     => wp_kses_data( __( 'Select width of the body content', 'vixus' ) ),
				'std'      => 'inherit',
				'options'  => vixus_get_list_body_styles( true ),
				'type'     => 'select',
			),
			"boxed_bg_image_{$cpt}"         => array(
				'title'      => esc_html__( 'Boxed bg image', 'vixus' ),
				'desc'       => wp_kses_data( __( 'Select or upload image, used as background in the boxed body', 'vixus' ) ),
				'dependency' => array(
					"body_style_{$cpt}" => array( 'boxed' ),
				),
				'std'        => 'inherit',
				'type'       => 'image',
			),
			"header_info_{$cpt}"            => array(
				'title' => esc_html__( 'Header', 'vixus' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"header_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Header style', 'vixus' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'vixus' ) ),
				'std'     => 'inherit',
				'options' => vixus_get_list_header_footer_types( true ),
				'type'    => VIXUS_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'vixus' ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select custom layout to display the site header on the %s pages', 'vixus' ), $title ) ),
				'dependency' => array(
					"header_type_{$cpt}" => array( 'custom' ),
				),
				'std'        => 'inherit',
				'options'    => array(),
				'type'       => VIXUS_THEME_FREE ? 'hidden' : 'select',
			),
			"header_position_{$cpt}"        => array(
				'title'   => esc_html__( 'Header position', 'vixus' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to display the site header on the %s pages', 'vixus' ), $title ) ),
				'std'     => 'inherit',
				'options' => array(),
				'type'    => VIXUS_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_image_override_{$cpt}"  => array(
				'title'   => esc_html__( 'Header image override', 'vixus' ),
				'desc'    => wp_kses_data( __( "Allow override the header image with the post's featured image", 'vixus' ) ),
				'std'     => 'inherit',
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'vixus' ),
					1         => esc_html__( 'Yes', 'vixus' ),
					0         => esc_html__( 'No', 'vixus' ),
				),
				'type'    => VIXUS_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_widgets_{$cpt}"         => array(
				'title'   => esc_html__( 'Header widgets', 'vixus' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select set of widgets to show in the header on the %s pages', 'vixus' ), $title ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => 'select',
			),

			"sidebar_info_{$cpt}"           => array(
				'title' => esc_html__( 'Sidebar', 'vixus' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"sidebar_position_{$cpt}"       => array(
				'title'   => sprintf( esc_html__( 'Sidebar position on the %s list', 'vixus' ), $title ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to show sidebar on the %s list', 'vixus' ), $title ) ),
				'std'     => 'left',
				'options' => array(),
				'type'    => 'switch',
			),
			"sidebar_position_mobile_{$cpt}"=> array(
				'title'    => sprintf( esc_html__( 'Sidebar position on the %s list on mobile', 'vixus' ), $title ),
				'desc'     => wp_kses_data( __( 'Select position to show sidebar on mobile devices - above or below the content', 'vixus' ) ),
				'std'      => 'below',
				'dependency' => array(
					"sidebar_position_{$cpt}" => array( '^hide' ),
				),
				'options'  => array(),
				'type'     => 'switch',
			),
			"sidebar_widgets_{$cpt}"        => array(
				'title'      => sprintf( esc_html__( 'Sidebar widgets on the %s list', 'vixus' ), $title ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select sidebar to show on the %s list', 'vixus' ), $title ) ),
				'dependency' => array(
					"sidebar_position_{$cpt}" => array( '^hide' ),
				),
				'std'        => 'hide',
				'options'    => array(),
				'type'       => 'select',
			),
			"sidebar_position_single_{$cpt}"       => array(
				'title'   => sprintf( esc_html__( 'Sidebar position on the single post', 'vixus' ), $title ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to show sidebar on the single posts of the %s', 'vixus' ), $title ) ),
				'std'     => 'left',
				'options' => array(),
				'type'    => 'switch',
			),
			"sidebar_position_mobile_single_{$cpt}"=> array(
				'title'    => esc_html__( 'Sidebar position on the single post on mobile', 'vixus' ),
				'desc'     => wp_kses_data( __( 'Select position to show sidebar on mobile devices - above or below the content', 'vixus' ) ),
				'dependency' => array(
					"sidebar_position_single_{$cpt}" => array( '^hide' ),
				),
				'std'      => 'below',
				'options'  => array(),
				'type'     => 'switch',
			),
			"sidebar_widgets_single_{$cpt}"        => array(
				'title'      => sprintf( esc_html__( 'Sidebar widgets on the single post', 'vixus' ), $title ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select widgets to show in the sidebar on the single posts of the %s', 'vixus' ), $title ) ),
				'dependency' => array(
					"sidebar_position_single_{$cpt}" => array( '^hide' ),
				),
				'std'        => 'hide',
				'options'    => array(),
				'type'       => 'select',
			),
			"expand_content_{$cpt}"         => array(
				'title'   => esc_html__( 'Expand content', 'vixus' ),
				'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'vixus' ) ),
				'refresh' => false,
				'std'     => 'inherit',
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'vixus' ),
					1         => esc_html__( 'Expand', 'vixus' ),
					0         => esc_html__( 'No', 'vixus' ),
				),
				'type'    => 'switch',
			),

			"footer_info_{$cpt}"            => array(
				'title' => esc_html__( 'Footer', 'vixus' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"footer_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Footer style', 'vixus' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'vixus' ) ),
				'std'     => 'inherit',
				'options' => vixus_get_list_header_footer_types( true ),
				'type'    => VIXUS_THEME_FREE ? 'hidden' : 'switch',
			),
			"footer_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'vixus' ),
				'desc'       => wp_kses_data( __( 'Select custom layout to display the site footer', 'vixus' ) ),
				'std'        => 'inherit',
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'custom' ),
				),
				'options'    => array(),
				'type'       => VIXUS_THEME_FREE ? 'hidden' : 'select',
			),
			"footer_widgets_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer widgets', 'vixus' ),
				'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'vixus' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default' ),
				),
				'std'        => 'footer_widgets',
				'options'    => array(),
				'type'       => 'select',
			),
			"footer_columns_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer columns', 'vixus' ),
				'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'vixus' ) ),
				'dependency' => array(
					"footer_type_{$cpt}"    => array( 'default' ),
					"footer_widgets_{$cpt}" => array( '^hide' ),
				),
				'std'        => 0,
				'options'    => vixus_get_list_range( 0, 6 ),
				'type'       => 'select',
			),
			"footer_wide_{$cpt}"            => array(
				'title'      => esc_html__( 'Footer fullwidth', 'vixus' ),
				'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'vixus' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default' ),
				),
				'std'        => 0,
				'type'       => 'checkbox',
			),

			"widgets_info_{$cpt}"           => array(
				'title' => esc_html__( 'Additional panels', 'vixus' ),
				'desc'  => '',
				'type'  => VIXUS_THEME_FREE ? 'hidden' : 'info',
			),
			"widgets_above_page_{$cpt}"     => array(
				'title'   => esc_html__( 'Widgets at the top of the page', 'vixus' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'vixus' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => VIXUS_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_above_content_{$cpt}"  => array(
				'title'   => esc_html__( 'Widgets above the content', 'vixus' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'vixus' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => VIXUS_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_below_content_{$cpt}"  => array(
				'title'   => esc_html__( 'Widgets below the content', 'vixus' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'vixus' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => VIXUS_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_below_page_{$cpt}"     => array(
				'title'   => esc_html__( 'Widgets at the bottom of the page', 'vixus' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'vixus' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => VIXUS_THEME_FREE ? 'hidden' : 'select',
			),
		);
	}
}


// Return lists with choises when its need in the admin mode
if ( ! function_exists( 'vixus_options_get_list_choises' ) ) {
	add_filter( 'vixus_filter_options_get_list_choises', 'vixus_options_get_list_choises', 10, 2 );
	function vixus_options_get_list_choises( $list, $id ) {
		if ( is_array( $list ) && count( $list ) == 0 ) {
			if ( strpos( $id, 'header_style' ) === 0 ) {
				$list = vixus_get_list_header_styles( strpos( $id, 'header_style_' ) === 0 );
			} elseif ( strpos( $id, 'header_position' ) === 0 ) {
				$list = vixus_get_list_header_positions( strpos( $id, 'header_position_' ) === 0 );
			} elseif ( strpos( $id, 'header_widgets' ) === 0 ) {
				$list = vixus_get_list_sidebars( strpos( $id, 'header_widgets_' ) === 0, true );
			} elseif ( strpos( $id, '_scheme' ) > 0 ) {
				$list = vixus_get_list_schemes( 'color_scheme' != $id );
			} elseif ( strpos( $id, 'sidebar_widgets' ) === 0 ) {
				$list = vixus_get_list_sidebars( 'sidebar_widgets_single' != $id && ( strpos( $id, 'sidebar_widgets_' ) === 0 || strpos( $id, 'sidebar_widgets_single_' ) === 0 ), true );
			} elseif ( strpos( $id, 'sidebar_position_mobile' ) === 0 ) {
				$list = vixus_get_list_sidebars_positions_mobile( strpos( $id, 'sidebar_position_mobile_' ) === 0 );
			} elseif ( strpos( $id, 'sidebar_position' ) === 0 ) {
				$list = vixus_get_list_sidebars_positions( strpos( $id, 'sidebar_position_' ) === 0 );
			} elseif ( strpos( $id, 'widgets_above_page' ) === 0 ) {
				$list = vixus_get_list_sidebars( strpos( $id, 'widgets_above_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_above_content' ) === 0 ) {
				$list = vixus_get_list_sidebars( strpos( $id, 'widgets_above_content_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_page' ) === 0 ) {
				$list = vixus_get_list_sidebars( strpos( $id, 'widgets_below_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_content' ) === 0 ) {
				$list = vixus_get_list_sidebars( strpos( $id, 'widgets_below_content_' ) === 0, true );
			} elseif ( strpos( $id, 'footer_style' ) === 0 ) {
				$list = vixus_get_list_footer_styles( strpos( $id, 'footer_style_' ) === 0 );
			} elseif ( strpos( $id, 'footer_widgets' ) === 0 ) {
				$list = vixus_get_list_sidebars( strpos( $id, 'footer_widgets_' ) === 0, true );
			} elseif ( strpos( $id, 'blog_style' ) === 0 ) {
				$list = vixus_get_list_blog_styles( strpos( $id, 'blog_style_' ) === 0 );
			} elseif ( strpos( $id, 'post_type' ) === 0 ) {
				$list = vixus_get_list_posts_types();
			} elseif ( strpos( $id, 'parent_cat' ) === 0 ) {
				$list = vixus_array_merge( array( 0 => esc_html__( '- Select category -', 'vixus' ) ), vixus_get_list_categories() );
			} elseif ( strpos( $id, 'blog_animation' ) === 0 ) {
				$list = vixus_get_list_animations_in();
			} elseif ( 'color_scheme_editor' == $id ) {
				$list = vixus_get_list_schemes();
			} elseif ( strpos( $id, '_font-family' ) > 0 ) {
				$list = vixus_get_list_load_fonts( true );
			}
		}
		return $list;
	}
}
