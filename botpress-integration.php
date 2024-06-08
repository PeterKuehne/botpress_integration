<?php
/*
Plugin Name: BotPress Integration
Description: Integration of BotPress with your WordPress site.
Version: 1.0
Author: Stefan Kühne, Peter Kühne
*/

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue jQuery in the header
function load_jquery_in_header() {
    // De-register the default jQuery script
    if (!is_admin()) {
        wp_deregister_script('jquery');
        // Register jQuery and specify the URL from Google CDN
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), null, false);
        // Enqueue jQuery
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'load_jquery_in_header');


// Kalender-CSS und JS hinzufügen
function add_calendly_assets_to_buffer($buffer) {
    $insertion = '<link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">';
    $insertion .= '<script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>';
    return preg_replace('/<body[^>]*>/', '$0' . $insertion, $buffer);
}

function buffer_start() { ob_start('add_calendly_assets_to_buffer'); }
function buffer_end() { ob_end_flush(); }

add_action('template_redirect', 'buffer_start', 1);
add_action('wp_footer', 'buffer_end', 100);

// Enqueue JavaScript and CSS files for frontend
function botpress_integration_enqueue_scripts() {
    // Enqueue jQuery
    wp_enqueue_script('jquery');

    // Register and enqueue external BotPress script
    wp_enqueue_script('botpress-inject', 'https://cdn.botpress.cloud/webchat/v1/inject.js', array('jquery'), null, true);

    // Register and enqueue local script
    wp_enqueue_script('botpress-integration-script', plugins_url('script.js', __FILE__), array('jquery', 'botpress-inject'), null, true);

    // Register and enqueue CSS file
    wp_enqueue_style('botpress-integration-style', plugins_url('style.css', __FILE__));

    // Localize script with configuration data
    $botpress_config = get_option('botpress_settings', botpress_get_default_settings());
    wp_localize_script('botpress-integration-script', 'botpressConfig', $botpress_config);
}
add_action('wp_enqueue_scripts', 'botpress_integration_enqueue_scripts');

// Enqueue media uploader and custom script for admin
function botpress_admin_scripts() {
    wp_enqueue_media();
    wp_enqueue_script('botpress-admin-script', plugins_url('script.js', __FILE__), array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'botpress_admin_scripts');

// Default settings
require_once(plugin_dir_path(__FILE__) . 'default-settings.php');

// Add admin menu
function botpress_integration_admin_menu() {
    add_menu_page('BotPress Integration', 'BotPress Integration', 'manage_options', 'botpress-integration', 'botpress_integration_admin_page');
}
add_action('admin_menu', 'botpress_integration_admin_menu');

// Admin page content
require_once(plugin_dir_path(__FILE__) . 'settings.php');
?>
