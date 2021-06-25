<?php
   /*
   Plugin Name: CPT Students Data
   Plugin URI: 
   description: Wordpress Plugin -> Students 
   Version: 1.2
   Author: SST
   Author URI: None
   License: GPL2
   */
  
   // Plugin Main File
   // Including All Files

  // Custom Post Type ( Registratin )
  include dirname( __FILE__ ) . '/register-cpt.php';
  
  // Dashboard Data
  include dirname( __FILE__ ) . '/add-dashboard-column.php';

  // Show Only Active People
  include dirname( __FILE__ ) . '/active-students-sort.php';

  // Metaboxes
  include dirname( __FILE__ ) . '/meta-data-boxes.php';

   // Widget  
   include dirname( __FILE__ ) . '/widget-data.php';

   // REST API
   include dirname( __FILE__ ) . '/rest-api.php';

  // Shortcode
  include dirname( __FILE__ ) . '/add-shortcode-cpt.php';

 
    