<?php

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
                    'menu_icon'     => 'dashicons-welcome-learn-more',
                    'rewrite'       => array( 'slug' => 'student-archive' ),
                    'show_in_nav_menus' => true,
                    'supports'      => array( 'title', 'editor', 'thumbnail' ),
                    'show_in_rest'  => true, // Enable Gutenberg
                )
    );

    register_taxonomy( 'students-category', 'students',

                array(
                    'hierarchical'   => true, 
                    'label'          => 'Categories', 
                    'singular_label' => 'Category', 
                    'show_ui'        => true,
                    'show_in_nav_menus' => true,
                    'query_var'         => true,
                    'rewrite'        => array( 'slug' => 'student-category' ),
                    'supports'      => array( 'editor', 'thumbnail' ),
                    'show_in_rest'   => true, // Enable Gutenberg
                )
    );
    }
