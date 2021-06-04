<?php
   /*
   Plugin Name: Fourth Custom Plugin
   Plugin URI: 
   description: My fourth wordpress plugin 
   Version: 1.2
   Author: SST
   Author URI: None
   License: GPL2
   */
    add_action( 'admin_menu', 'add_custom_submenu' );
    function add_custom_submenu () {
        $sub_menu = add_options_page('Onboarding Page', 'My Onboarding', 'manage_options', 'onboarding-elements', 'onboarding_elements');
        add_action( 'admin_print_scripts-' . $sub_menu, 'trigger_jquery' );
    }
    
    function onboarding_elements () {

        ?>
        <form method="POST">
        <div class="section-inner thin error404-content">
            <input type="checkbox" id="data_check" name="data_check">
            <label for="data_check"> Filters Enabled</label> <br>
        </div>
        </form>
        <?php
    }
    
    function trigger_jquery () {
        // wp_register_script( 'javascript_file', plugins_url() . '/myonboardingplugin4/script.js');
        wp_enqueue_script( 'javascript_file', plugins_url() . '/myonboardingplugin4/script.js', array( 'jquery' ), false, true);

        // wp_enqueue_script( 'ajax-script', plugins_url( '/script.js', __FILE__ ), array( 'jquery' ), false, true );
        // wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    }
