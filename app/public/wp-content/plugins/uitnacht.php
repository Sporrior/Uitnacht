<?php
/*
Plugin Name: Uitnacht
Description: A simple plugin to display the Uitnacht info page and settings.
Version: 1.0
Author: Damien Engelen, kutzooi
*/

add_action('admin_menu', 'uitnacht_info_menu');

function uitnacht_info_menu() {
    add_menu_page(
        'Uitnacht Info Checker', 
        'Uitnacht Info Checker',  
        'manage_options',       
        'uitnacht-info-checker',
        'uitnacht_info_page',     
        'dashicons-admin-generic',
        2                        
    );

    add_submenu_page(
        'uitnacht-info-checker',  
        'Informatie Settings',    
        'Informatie Settings',    
        'manage_options',         
        'uitnacht-informatie-settings', 
        'uitnacht_informatie_settings_page' 
    );
}

function uitnacht_info_page() {
    include(plugin_dir_path(__FILE__) . 'dashboard-view.php');
}

function uitnacht_informatie_settings_page() {
    include(plugin_dir_path(__FILE__) . 'settings-view.php');
}
