<?php

/*
* Plugin Name: Lktags - Linkedin Insight Tags
* Description: The linkedin conversion Tracking plugin allows to add strategically your linkedin TAG ID on all your webpages (with the base code). No need to edit your theme files!
* Author: Pagup
* Version: 1.2.6
* Author URI: https://pagup.com/
* Text Domain: lktags-linkedin-insight-tags
* Domain Path: /languages/
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/******************************************
                Freemius Init
*******************************************/

if ( function_exists( 'lktags_fs' ) ) {
    lktags_fs()->set_basename( false, __FILE__ );
} else {
    
    if ( !function_exists( 'lktags_fs' ) ) {
        if ( !defined( 'LKTAGS_PLUGIN_BASE' ) ) {
            define( 'LKTAGS_PLUGIN_BASE', plugin_basename( __FILE__ ) );
        }
        if ( !defined( 'LKTAGS_PLUGIN_DIR' ) ) {
            define( 'LKTAGS_PLUGIN_DIR', plugins_url( '', __FILE__ ) );
        }
        require 'vendor/autoload.php';
        // Create a helper function for easy SDK access.
        function lktags_fs()
        {
            global  $lktags_fs ;
            
            if ( !isset( $lktags_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/vendor/freemius/start.php';
                $lktags_fs = fs_dynamic_init( array(
                    'id'              => '3402',
                    'slug'            => 'lktags-linkedin-insight-tags',
                    'type'            => 'plugin',
                    'public_key'      => 'pk_acb2cca0e443d00ce5ceea7b0e5c3',
                    'is_premium'      => false,
                    'premium_suffix'  => 'Linkedin Insight Tag for Woocommerce',
                    'has_addons'      => false,
                    'has_paid_plans'  => true,
                    'has_affiliation' => 'selected',
                    'trial'           => array(
                    'days'               => 7,
                    'is_require_payment' => true,
                ),
                    'menu'            => array(
                    'slug'           => 'lktags',
                    'override_exact' => true,
                    'first-path'     => 'options-general.php?page=lktags',
                    'support'        => false,
                    'parent'         => array(
                    'slug' => 'options-general.php',
                ),
                ),
                    'is_live'         => true,
                ) );
            }
            
            return $lktags_fs;
        }
        
        // Init Freemius.
        lktags_fs();
        // Signal that SDK was initiated.
        do_action( 'lktags_fs_loaded' );
        function lktags_fs_settings_url()
        {
            return admin_url( 'options-general.php?page=lktags&tab=lktags-settings' );
        }
        
        lktags_fs()->add_filter( 'connect_url', 'lktags_fs_settings_url' );
        lktags_fs()->add_filter( 'after_skip_url', 'lktags_fs_settings_url' );
        lktags_fs()->add_filter( 'after_connect_url', 'lktags_fs_settings_url' );
        lktags_fs()->add_filter( 'after_pending_connect_url', 'lktags_fs_settings_url' );
        function lktags_fs_custom_icon()
        {
            return dirname( __FILE__ ) . '/admin/assets/icon.jpg';
        }
        
        lktags_fs()->add_filter( 'plugin_icon', 'lktags_fs_custom_icon' );
        // freemius opt-in
        // freemius opt-in
        function lktags_fs_custom_connect_message(
            $message,
            $user_first_name,
            $product_title,
            $user_login,
            $site_link,
            $freemius_link
        )
        {
            $break = "<br><br>";
            $more_plugins = '<p><a target="_blank" href="https://wordpress.org/plugins/meta-tags-for-seo/">Meta Tags for SEO</a>, <a target="_blank" href="https://wordpress.org/plugins/automatic-internal-links-for-seo/">Auto internal links for SEO</a>, <a target="_blank" href="https://wordpress.org/plugins/bulk-image-alt-text-with-yoast/">Bulk auto image Alt Text</a>, <a target="_blank" href="https://wordpress.org/plugins/bulk-image-title-attribute/">Bulk auto image Title Tag</a>, <a target="_blank" href="https://wordpress.org/plugins/mobilook/">Mobile view</a>, <a target="_blank" href="https://wordpress.org/plugins/better-robots-txt/">Wordpress Better-Robots.txt</a>, <a target="_blank" href="https://wordpress.org/plugins/wp-google-street-view/">Wp Google Street View</a>, <a target="_blank" href="https://wordpress.org/plugins/vidseo/">VidSeo</a>, ...</p>';
            return sprintf( esc_html__( 'Hey %1$s, %2$s Click on Allow & Continue to activate Linkedin Insight Tag on your website :)! The Linkedin tag (with base & event codes) allows you to track actions people take on your website. %2$s Never miss an important update -- opt-in to our security and feature updates notifications. %2$s See you on the other side.', 'lktags-linkedin-insight-tags' ), $user_first_name, $break ) . $more_plugins;
        }
        
        lktags_fs()->add_filter(
            'connect_message',
            'lktags_fs_custom_connect_message',
            10,
            6
        );
    }
    
    class LkTags
    {
        function __construct()
        {
            register_deactivation_hook( __FILE__, array( &$this, 'deactivate' ) );
            add_action( 'init', array( &$this, 'lktags_textdomain' ) );
        }
        
        public function deactivate()
        {
            if ( \Pagup\Lktags\Core\Option::check( 'lktags_remove_settings' ) ) {
                delete_option( 'lktags' );
            }
        }
        
        function lktags_textdomain()
        {
            load_plugin_textdomain( \Pagup\Lktags\Core\Plugin::domain(), false, basename( dirname( __FILE__ ) ) . '/languages' );
        }
    
    }
    $lktags = new LkTags();
    /*-----------------------------------------
                  TRACK CONTROLLER
      ------------------------------------------*/
    require_once \Pagup\Lktags\Core\Plugin::path( 'admin/controllers/TrackingController.php' );
    /*-----------------------------------------
                      Settings
      ------------------------------------------*/
    if ( is_admin() ) {
        include_once \Pagup\Lktags\Core\Plugin::path( 'admin/Settings.php' );
    }
}
