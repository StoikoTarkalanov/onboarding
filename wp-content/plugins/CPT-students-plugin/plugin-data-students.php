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
                        'singular_name' => 'Student',
                    ),
                    'public'        => true,
                    'has_archive'   => true,
                    'show_in_rest'  => true, // Enable Gutenberg
                    'menu_icon'     => 'dashicons-welcome-learn-more',
                    'rewrite'       => array( 'slug' => 'student-archive' ),
                )
    );

    register_taxonomy( 'students-category', 'students',

                array(
                    'hierarchical'   => true, 
                    'label'          => 'Categories', 
                    'singular_label' => 'Category', 
                    'show_ui'        => true,
                    'show_in_rest'  => true, // Enable Gutenberg
                    'rewrite'        => array( 'slug' => 'student-category' ),
                )
    );

            // var_dump(get_category_link( 210 ));
}
