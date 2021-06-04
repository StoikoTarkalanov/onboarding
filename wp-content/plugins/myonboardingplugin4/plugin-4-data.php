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

    function add_custom_submenu () {
        add_submenu_page('options-general.php', 'Page Title', 'My Onboarding', 'manage_options', 'onboarding-general' );

    }

    add_action('admin_menu', 'add_custom_submenu');

