<?php
   /*
   Plugin Name: AJAX Custom Plugin To Other URL
   Plugin URI: 
   description: Wordpress plugin 
   Version: 1.2
   Author: SST
   Author URI: None
   License: GPL2
   */

    add_action( 'admin_menu', 'add_custom_menu_side' );
    function add_custom_menu_side () {
      $menu = add_menu_page( 'AJAX TO PAGE', 'AJAX TO',  'manage_options', 'onboarding-markup', 'onboarding_markup' );
      add_action( 'admin_print_scripts-' . $menu, 'trigger_jquery_amazon' );
    }
    
    function onboarding_markup () {
        ?>
      <form method="GET">
      <div >
          <input type="button" id="data_btn" name="data_btn" value="Get Info">
          <input style="width:500px" id="data_input" name="data_input" type="text" placeholder="URL Here..."> 
          <label for="checkbox_transient"> Enabled Transient</label> 
          <input type="checkbox" id="checkbox_transient" name="checkbox_transient">
        </div>
      </form>
      <div id="data-receve-elem" style="height: 100px; width: 100px; margin-top: 100px; padding: 100px;"></div> <br>
      <?php
  }
  
  function trigger_jquery_amazon () {
    wp_enqueue_script( 'javascript_file_to', plugins_url() . '/ajax-plugin-to-other-url/script.js', array( 'jquery' ), null, true );
    wp_localize_script( 'javascript_file_to', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}


    add_action( 'wp_ajax_handle_html_to', 'handle_html_to' );
    function handle_html_to () {
        $input_url = $_GET['clicked'];
        
        if ( ! empty( $input_url ) ) {
            $response = wp_remote_get( $input_url );
            $html = wp_remote_retrieve_body( $response );
            wp_send_json_success( $html );
        }

        wp_die();
    }

    