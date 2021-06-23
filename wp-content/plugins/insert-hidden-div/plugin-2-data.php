<?php
   /*
   Plugin Name: Hidden Div Custom Plugin
   Plugin URI: 
   description: My second wordpress plugin 
   Version: 1.2
   Author: SST
   Author URI: None
   License: GPL2
   */

    add_filter( 'the_content', 'add_div_element' );
    function add_div_element( $content ) {

        if ( is_singular( 'students' ) ) {
            
            if ( get_option( 'filters_enabled' ) === 'true' ) {
                $div_data = '<di class="entry-content">' . '<p>' . 'AAAAAAAAAAAAAAAA' . '</p>' . '</div>';
                // $div_data = '<div></div>';
                return $content . $div_data; 
            }
        }
        
        return $content;
    } 


