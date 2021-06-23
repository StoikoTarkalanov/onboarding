<?php

    // Get active/inactive students
    add_action('pre_get_posts', 'filter_students_data_by_active');
    function filter_students_data_by_active( $query ) {
        $orderby = $query->get( 'orderby' );

        if ( 'Activate/Deactivate' == $orderby ) {

            $meta_query = array(
                'relation' => 'OR',
                array(
                    'key' => 'student_status',
                    'compare' => 'NOT EXISTS', 
                ),
                array(
                    'key' => 'student_status',
                ),
            );

            $query->set( 'meta_query', $meta_query );
            $query->set( 'orderby', 'meta_value' );
        }
    }

  