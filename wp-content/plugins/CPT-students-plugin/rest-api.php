<?php

    // REST API (Via Postman)
    
    // Get By ID
    function collect_students_data_by_id( $data ) {
        $posts = get_posts( 
            array(
                'post_type' => 'students',
                'p'         => $data['id']
            ) 
        );

        if ( empty( $posts ) ) {
          return 'Not Found!';
        }
       
        return $posts[0];
    }

    add_action( 'rest_api_init', 'custom_route_by_id' ); 
    function custom_route_by_id() {

        register_rest_route( 'single-student', '/id/(?P<id>\d+)',
            array(
                'methods'             => 'GET',
                'callback'            => 'collect_students_data_by_id',
                'permission_callback' => '__return_true',
            ) 
        );
    } 

    // Get All
    function collect_all_students_data() {

        $posts = get_posts( 
            array(
                'post_status'    => 'publish',
                'post_type'      => 'students',
                'posts_per_page' => 4,
                'paged'          => ($_REQUEST['paged'] ? $_REQUEST['paged'] : 1),
            ) 
        );

        if ( empty( $posts ) ) {
          return 'Not Found!';
        }
       
        return $posts;
    }

    add_action( 'rest_api_init', 'custom_route_get_all_data' ); 
    function custom_route_get_all_data() {

        register_rest_route( 'students', '/all',
            array(
                'methods'             => 'GET',
                'callback'            => 'collect_all_students_data',
                'permission_callback' => '__return_true',
            ) 
        );
    } 

    // Add 
    function add_student_data() {
        if ( ! empty( $_POST['post_title'] ) && ! empty( $_POST['post_content'] ) ) {
            $new_student = array(
                'post_type'    => 'students',
                'post_title'   => sanitize_text_field( $_POST['post_title'] ),
                'post_content' => sanitize_text_field( $_POST['post_content'] ),
                'post_status'  => 'publish',
            );

            $student = wp_insert_post( $new_student );
            return 'New student added with ID ' . $student;
        }

        return 'Not Found!';
    }

    add_action( 'rest_api_init', 'custom_route_add_one_student' ); 
    function custom_route_add_one_student() {

        register_rest_route( 'student', '/add', 
            array(
                'methods'             => 'POST',
                'callback'            =>  'add_student_data',
                'permission_callback' => function () { return current_user_can( 'edit_others_pages' ); },
            ) 
        );
    }

    // Edit
    function edit_student_by_id_data( $data ) {      

        var_dump($_POST);
        if ( ! empty( $_POST['post_title'] ) && ! empty( $_POST['post_content'] ) ) {
            $current_student = array(
                    'post_type'    => 'students',
                    'ID'           => $data['id'],
                    'post_title'   => sanitize_text_field( $_POST['post_title'] ),
                    'post_content' => sanitize_text_field( $_POST['post_content'] ),
                    'post_status'  => 'publish',
            );
            
            $edited_student = wp_update_post( $current_student );
            return 'Edited student with ID ' . $edited_student;
        }

        return 'Not Found!';
    }

    add_action( 'rest_api_init', 'custom_route_edit_student' ); 
    function custom_route_edit_student() {

        register_rest_route( 'student', '/edit/(?P<id>\d+)', 
            array(
                'methods'             => 'POST',
                'callback'            =>  'edit_student_by_id_data',
                'permission_callback' => function () { return current_user_can( 'edit_others_pages' ); },
            ) 
        );
    }

    // Delete
    function delete_student_data( $data ) {
        $current_student = get_post(
            array(
                'post_type' => 'students',
                'ID'        => $data['id'],
            )
        );

        if ( empty( $current_student ) ) {
            return 'No such student with this ID';
        } else {
            ?>'Successfuly deleted student'<?php
             return wp_delete_post( $data['id'] );
        }
    }

    add_action( 'rest_api_init', 'custom_route_delete_stident' ); 
    function custom_route_delete_stident() {
        register_rest_route( 'student', 'delete/id/(?P<id>\d+)', 
            array(
                'methods'             => 'DELETE',
                'callback'            =>  'delete_student_data',
                'permission_callback' => function () { return current_user_can( 'edit_others_pages' ); },
            )
        );
    }
   