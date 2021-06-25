<?php

    // Activate Feature Image
    function current_get_featured_image( $post_ID ) {
    $post_thumbnail_id = get_post_thumbnail_id( $post_ID );
        if ( $post_thumbnail_id ) {

            $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'featured_preview' );
            return $post_thumbnail_img[0];
        }
    }

    add_filter( 'manage_students_posts_columns', 'image_columns_head' );
    function image_columns_head( $defaults ) {
        $defaults['featured_image'] = 'Featured Image';
        return $defaults;
    }

    add_action( 'manage_students_posts_custom_column', 'image_columns_content', 10, 2 );
    function image_columns_content( $column_name, $post_ID ) {
        if ( $column_name == 'featured_image' ) {
            $post_featured_image = current_get_featured_image( $post_ID );

            if ($post_featured_image) {
                echo '<img src="' . $post_featured_image . '" />';
            }
        }
    }

    // Active/Inactive students colum
    add_filter( 'manage_students_posts_columns', 'is_active_columns_head' );
    add_filter( 'manage_edit-students_sortable_columns', 'is_active_columns_head' );
    function is_active_columns_head( $defaults ) {
        $defaults['activate_deactivate'] = 'Activate/Deactivate';
        return $defaults;
    }

    add_action( 'manage_students_posts_custom_column', 'is_active_columns_content', 10, 2 );
    function is_active_columns_content( $column_name, $post_ID ) {
        if ( $column_name == 'activate_deactivate' ) {
            $checkbox_value = get_post_meta( $post_ID, 'student_status', true );

            ?>
                <input type="checkbox" name="status" value="1" <?php checked( $checkbox_value, '1' ); ?>  disabled/>
            <?php
        }
    }

  