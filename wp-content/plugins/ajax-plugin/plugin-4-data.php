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

   
   // check custom post type for students !!! 

    add_action( 'admin_menu', 'add_custom_submenu' );

    function add_custom_submenu () {
        // $sub_menu = add_options_page( 'Onboarding Page', 'My Onboarding', 'manage_options', 'onboarding-elements', 'onboarding_elements' );
        $sub_menu = add_menu_page('Onboarding Page', 'My Onboarding',  'manage_options', 'onboarding-elements', 'onboarding_elements' );
        add_action( 'admin_print_scripts-' . $sub_menu, 'trigger_jquery' );
    }
    
    function onboarding_elements () {
        ?>
        <form method="POST">
        <div>
            <input type="checkbox" id="data_check" name="data_check" <?php checked( get_option( 'filters_enabled' ), true, false ) ?> >
            <label for="data_check"> Filters Enabled</label> 
        </div>
        </form>
        <?php
    }
    
    function trigger_jquery () {
        wp_enqueue_script( 'javascript_file_unique', plugins_url() . '/ajax-plugin/script.js', array( 'jquery' ), null, true );
    
        wp_localize_script( 'javascript_file_unique', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
    }
    
    add_action( 'wp_ajax_handle_with_options_api', 'handle_with_options_api' );

    function handle_with_options_api () {
        
        if ( ! empty( $_POST['box'] ) ) {
            update_option( 'filters_enabled',  $_POST['box'] );
        } 

        wp_die();
    }
   