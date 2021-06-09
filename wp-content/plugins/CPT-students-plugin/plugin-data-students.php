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

  add_action( 'init', 'cpt_students' );
  function cpt_students() {
 
    register_post_type( 'students',

    array(
            'labels' => array(
                'name'          => 'Students',
                'singular_name' => 'Student'
            ),
            'public'        => true,
            'has_archive'   => true,
            'rewrite'       => array('slug' => 'student'),
            'show_in_rest'  => true,
            'menu_icon'     => 'dashicons-welcome-learn-more'
        )
    );
}
