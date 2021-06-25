<?php
   /*
   Plugin Name: Set Options Custom Plugin
   Plugin URI: 
   description: My third wordpress plugin 
   Version: 1.2
   Author: SST
   Author URI: None
   License: GPL2
   */

    // Set Custom Option Button To Nav Menue 
   add_filter( 'wp_nav_menu_items', 'custom_nav_optin_to_settings' );
   function custom_nav_optin_to_settings( $items ) {
    $settings_data = admin_url( 'options-general.php' );
    
    if ( is_user_logged_in() ) {
        $items .= '<li id="menu-item-1770">'
                . '<div class="ancestor-wrapper">'
                . '<a href="' . $settings_data . '">Profile settings'
                . '</a>'
                . '</div>'
                . '</li>';
    }
    return $items;
   }

