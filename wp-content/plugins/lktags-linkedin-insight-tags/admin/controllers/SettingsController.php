<?php

namespace Pagup\Lktags\Controllers;

use  Pagup\Lktags\Core\Option ;
use  Pagup\Lktags\Core\Plugin ;
use  Pagup\Lktags\Core\Request ;
class SettingsController
{
    public function add_settings()
    {
        add_options_page(
            'Linkedin Insight Tags Settings',
            'Linkedin Insight Tag',
            'manage_options',
            'lktags',
            array( &$this, 'page' )
        );
    }
    
    public function page()
    {
        $safe = [
            "lktags_event_yes",
            "lktags_event_no",
            "enable_lktags",
            "lktags_woo",
            "lktags-bigta",
            "lktags-mobilook",
            "lktags-vidseo",
            "boost-alt",
            "boost-robot",
            'lktags-settings',
            'lktags-faq',
            "lktags_remove_settings"
        ];
        $success = '';
        
        if ( isset( $_POST['update'] ) ) {
            if ( function_exists( 'current_user_can' ) && !current_user_can( 'manage_options' ) ) {
                die( 'Sorry, not allowed...' );
            }
            check_admin_referer( 'lktags__settings', 'lktags__nonce' );
            if ( !isset( $_POST['lktags__nonce'] ) || !wp_verify_nonce( $_POST['lktags__nonce'], 'lktags__settings' ) ) {
                die( 'Sorry, not allowed. Nonce doesn\'t verify' );
            }
            $options = [
                'enable_lktags'          => Request::post( 'enable_lktags', $safe ),
                'lktags_id'              => ( Request::check( 'lktags_id' ) ? sanitize_text_field( $_POST['lktags_id'] ) : '' ),
                'lktags_woo'             => Request::post( 'lktags_woo', $safe ),
                'lktags_remove_settings' => Request::post( 'lktags_remove_settings', $safe ),
                'boost-robot'            => Request::post( 'boost-robot', $safe ),
                'boost-alt'              => Request::post( 'boost-alt', $safe ),
                'lktags-mobilook'        => Request::post( 'lktags-mobilook', $safe ),
                'lktags-bigta'           => Request::post( 'lktags-bigta', $safe ),
                'lktags-vidseo'          => Request::post( 'lktags-vidseo', $safe ),
            ];
            update_option( 'lktags', $options );
            // update options
            echo  '<div class="notice lktags-notice notice-success is-dismissible"><p><strong>' . esc_html__( 'Settings saved.' ) . '</strong></p></div>' ;
        }
        
        $options = new Option();
        $text_domain = Plugin::domain();
        $notification = new \Pagup\Lktags\Controllers\NotificationController();
        echo  $notification->support() ;
        //set active class for navigation tabs
        $active_tab = ( isset( $_GET['tab'] ) && in_array( $_GET['tab'], $safe ) ? sanitize_key( $_GET['tab'] ) : 'lktags-settings' );
        //Plugin::dd($_POST);
        //var_dump(Option::all());
        // purchase notification
        $purchase_url = "options-general.php?page=lktags-pricing";
        $get_pro = sprintf( wp_kses( __( '<a href="%s">Get Pro version</a> to enable', $text_domain ), array(
            'a' => array(
            'href'   => array(),
            'target' => array(),
        ),
        ) ), esc_url( $purchase_url ) );
        // Return Views
        if ( $active_tab == 'lktags-settings' ) {
            return Plugin::view( 'settings', compact(
                'active_tab',
                'options',
                'text_domain',
                'get_pro',
                'success'
            ) );
        }
        if ( $active_tab == 'lktags-faq' ) {
            return Plugin::view( "faq", compact( 'active_tab', 'text_domain' ) );
        }
    }

}
$settings = new SettingsController();