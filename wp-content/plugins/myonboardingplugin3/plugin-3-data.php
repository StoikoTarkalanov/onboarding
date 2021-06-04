<?php
   /*
   Plugin Name: Third Custom Plugin
   Plugin URI: 
   description: My third wordpress plugin 
   Version: 1.2
   Author: SST
   Author URI: None
   License: GPL2
   */

   function custom_nav( $items ) {
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

   add_filter( 'wp_nav_menu_items', 'custom_nav' );
