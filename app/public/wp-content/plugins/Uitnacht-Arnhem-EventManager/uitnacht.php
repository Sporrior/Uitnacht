<?php
/*
Plugin Name: Uitnacht Information & Location Manager
Description: A WordPress plugin for managing and displaying Uitnacht event information, including location mapping, event details, and interactive features. Designed for simplicity and ease of use.
Author: Damien Engelen, Sintayu de Kuiper
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function uitnacht_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'uitnacht_dashboard_widget',                 // Widget slug
        'Uitnacht Overview',                         // Widget title
        'uitnacht_dashboard_widget_display'          // Function to display content
    );
}
add_action('wp_dashboard_setup', 'uitnacht_add_dashboard_widget');

function uitnacht_dashboard_widget_display() {
    $locations = get_option('uitnacht_locations_data', array());
    $location_count = count($locations);

    echo '<h3>Total Locations Saved: ' . esc_html($location_count) . '</h3>';
}

add_action('admin_menu', 'uitnacht_info_menu');

function uitnacht_info_menu() {
    add_menu_page(
        'Uitnacht Dashboard',       // Page title
        'Uitnacht Dashboard',       // Menu title
        'manage_options',           // Capability
        'uitnacht-info-checker',    // Menu slug
        'uitnacht_info_page',       // Function to display content
        'dashicons-admin-generic',  // Icon
        2                           // Position
    );

    add_submenu_page(
        'uitnacht-info-checker',    // Parent slug
        'Gebruikers-Tabel',         // Page title
        'Gebruikers Tabel',         // Menu title
        'manage_options',           // Capability
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

include(plugin_dir_path(__FILE__) . 'form-shortcode.php');
include(plugin_dir_path(__FILE__) . 'map-shortcode.php');

?>