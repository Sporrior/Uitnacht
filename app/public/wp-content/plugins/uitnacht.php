<?php
/*
Plugin Name: Uitnacht
Description: A simple plugin to display the Uitnacht info page, locations, and map.
Version: 1.0
Author: Damien Engelen, Sintayu de Kuiper
*/

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action('admin_menu', 'uitnacht_info_menu');

function uitnacht_info_menu() {
    add_menu_page(
        'Uitnacht Dashboard',   // Page title
        'Uitnacht Dashboard',   // Menu title
        'manage_options',          // Capability
        'uitnacht-info-checker',   // Menu slug
        'uitnacht_info_page',      // Function to display content
        'dashicons-admin-generic', // Icon
        2                          // Position
    );

    add_submenu_page(
        'uitnacht-info-checker',   // Parent slug
        'Gebruikers-Tabel',     // Page title
        'Gebruikers Tabel',     // Menu title
        'manage_options',          // Capability
        'uitnacht-informatie-settings',  // Menu slug
        'uitnacht_informatie_settings_page'  // Function to display content
    );
}

function uitnacht_info_page() {
    include(plugin_dir_path(__FILE__) . 'dashboard-view.php');
}

function uitnacht_informatie_settings_page() {
    include(plugin_dir_path(__FILE__) . 'table-view.php');
}

// Include the form and map shortcodes
include(plugin_dir_path(__FILE__) . 'form-shortcode.php');
include(plugin_dir_path(__FILE__) . 'map-shortcode.php');
?>