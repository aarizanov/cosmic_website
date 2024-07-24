<?php
namespace Pagup\Lktags;
use Pagup\Lktags\Core\Asset;

class Settings {

    public function __construct()
    {

        $settings = new \Pagup\Lktags\Controllers\SettingsController;
        $metabox = new \Pagup\Lktags\Controllers\MetaboxController;

        // Add settings page
        add_action( 'admin_menu', array( &$settings, 'add_settings' ) );

        // Add metabox to post-types
        add_action( 'add_meta_boxes', array(&$metabox, 'add_metabox') );

        // Save meta data
        add_action( 'save_post', array(&$metabox, 'metadata'));

        // Add setting link to plugin page
        $plugin_base = LKTAGS_PLUGIN_BASE;
        add_filter( "plugin_action_links_{$plugin_base}", array( &$this, 'setting_link' ) );
        
        // Add styles and scripts
        add_action( 'admin_enqueue_scripts', array( &$this, 'assets') );

    }

    public function setting_link( $links ) {

        array_unshift( $links, '<a href="options-general.php?page=lktags">Settings</a>' );

        return $links;
    }

    public function assets() {

        Asset::style_remote('lktags_font', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');
        Asset::style('lktags_styles', 'app.css');
        Asset::script('lktags_script', 'app.js');
    
    }
}

$settings = new Settings;