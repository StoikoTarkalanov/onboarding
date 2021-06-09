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
    function add_custom_menu_side ( ) {
      $menu = add_menu_page( 'AJAX TO PAGE', 'AJAX TO URL',  'manage_options', 'onboarding-markup', 'onboarding_markup' );
      add_action( 'admin_print_scripts-' . $menu, 'trigger_jquery_ajax' );
    }
    
    function onboarding_markup ( ) {
        ?>
      <form method="GET">
        <div>
          <input type="button" id="data_btn" name="data_btn" value="Get Info">
          <input style="width:500px" id="data_input" name="data_input" type="text" placeholder="URL Here..." value="<?php echo get_transient( 'url_transient_cache' ); ?>"> 
        </div>
      </form>
      <label for="transient-expire">Choose Expiration!</label>
        <select id="transient-expire" name="select_data">
          <option value=" <?php 15 * MINUTE_IN_SECONDS ?>" selected>15 Minutes</option>
          <option value=" <?php 30 * MINUTE_IN_SECONDS ?>" selected>30 Minutes</option>
          <option value=" <?php 1 * HOUR_IN_SECONDS ?>" selected>1 Hour</option>
          <option value=" <?php 5 * HOUR_IN_SECONDS ?>" selected>5 Hours</option>
          <option value="" selected disabled hidden>Choose here</option>
        </select>
      <div id="data-receve-elem" style="height: 100px; width: 100px; margin-top: 50px;">
        <?php
          $transient_html = get_transient( 'url_transient_cache' );
          if ( false != $transient_html && ! empty( $transient_html ) ) {
            $response = wp_remote_get( $transient_html );
            echo wp_remote_retrieve_body( $response );
          }
        ?>
      </div> 
      <?php
    }
  
    function trigger_jquery_ajax( ) {
        wp_enqueue_script( 'javascript_file_to', plugins_url() . '/ajax-plugin-to-other-url/script.js', array( 'jquery' ), null, true );
        wp_localize_script( 'javascript_file_to', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    }

    add_action( 'wp_ajax_handle_html_to', 'handle_html_to', 10 );
    function handle_html_to( ) {
        $input_url = $_GET['clicked'];
        $expiratin_result = $_GET['expire'];

        if ( $input_url != '' ) {
            $response = wp_remote_get( $input_url );
            $html = wp_remote_retrieve_body( $response );
            
            set_transient_data( 'url_transient_cache', $input_url, $expiratin_result );
            wp_send_json_success( $html );   
        }

        wp_die();
    }

    function set_transient_data( $transient_name, $transient_value, $expire = 3600 ) {
      set_transient( $transient_name, $transient_value, $expire );
    }
