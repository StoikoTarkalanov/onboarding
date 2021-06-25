<?php
   /*
   Plugin Name: AJAX Checkbox Custom Plugin
   Plugin URI: 
   description: My fourth wordpress plugin 
   Version: 1.2
   Author: SST
   Author URI: None
   License: GPL2
   */

  
    // Check Custom Post Type For Students 
    add_action( 'admin_menu', 'add_custom_submenu' );
    function add_custom_submenu () {
        $sub_menu = add_menu_page( 'Onboarding Page', 'AJAX CHECKBOX',  'manage_options', 'onboarding-elements', 'onboarding_elements' );
        add_action( 'admin_print_scripts-' . $sub_menu, 'trigger_jquery' );
    }
    
    // Display Checkbox Field
    function onboarding_elements () {
        ?>
            <label for="data_check"> Filters </label> 
            <input type="checkbox" id="data_check" name="data_check" <?php checked( get_option( 'filters_enabled' ), 'true', true ) ?> >
        <?php
    }
    
    // Enque JS Script
    function trigger_jquery () {
        wp_enqueue_script( 'javascript_file_unique', plugins_url() . '/ajax-plugin/script.js', array( 'jquery' ), null, true );
        wp_localize_script( 'javascript_file_unique', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );    
    }
    
    // Handle AJAX 
    add_action( 'wp_ajax_handle_with_options_api', 'handle_with_options_api' );
    function handle_with_options_api () {
        
        if ( ! empty( $_POST['box'] ) ) {
            update_option( 'filters_enabled',  $_POST['box'] );
        } 
        
        wp_die();
    }
   