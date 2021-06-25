<?php

    // Add Metaboxes
    add_action( 'add_meta_boxes', 'student_status_add_meta' );
    function student_status_add_meta() {
        add_meta_box( 'student_status', 'Status', 'student_metabox_markup_status', 'students' );
    }

    add_action( 'add_meta_boxes', 'student_home_add_meta' );
    function student_home_add_meta() {
        add_meta_box( 'student_home', 'Lives in', 'student_metabox_markup_home', 'students' );
    }

    add_action( 'add_meta_boxes', 'student_address_add_meta' );
    function student_address_add_meta() {
        add_meta_box( 'student_address', 'Address', 'student_metabox_markup_address', 'students' );
    }

    add_action( 'add_meta_boxes', 'student_birth_add_meta' );
    function student_birth_add_meta() {
        add_meta_box( 'student_birth', 'Birth Date', 'student_metabox_markup_birth', 'students' );
    }

    add_action( 'add_meta_boxes', 'student_grade_add_meta' );
    function student_grade_add_meta() {
        add_meta_box( 'student_grade', 'Grade', 'student_metabox_markup_grade', 'students' );
    }

    // Gets Post Meta And Displays Markup In Edit
    function student_metabox_markup_status( $post ) {
        $student_status = get_post_meta( $post->ID, 'student_status', true );

        ?>
            <label>Status</label>
            <input name="status" id="status" type="checkbox" value="1" <?php checked( $student_status, '1' ); ?>>
        <?php
    }

    function student_metabox_markup_home( $post ) {
        $student_home = get_post_meta( $post->ID, 'student_home', true );

        ?>
            <label>Lives in: Country, City</label>
            <input name="lives" id="lives" type="text" value="<?php echo esc_html( $student_home ); ?>">
        <?php
    }

    function student_metabox_markup_address( $post ) {
        $student_address = get_post_meta( $post->ID, 'student_address', true );

        ?>
        <label>Address</label>
            <input name="address" id="address" type="text" value=" <?php echo esc_html( $student_address ); ?> ">
        <?php
    }

    function student_metabox_markup_birth( $post ) {
        $student_birth = get_post_meta( $post->ID, 'student_birth', true );

        ?>
            <label>Birth Date</label>
            <input name="birth" id="birth" type="text" value=" <?php echo esc_html( $student_birth ); ?> ">
        <?php
    }

    function student_metabox_markup_grade( $post ) {
        $student_grade = get_post_meta( $post->ID, 'student_grade', true );

        ?>        
            <label>Grade</label>
            <input name="grade" id="grade" type="text" value=" <?php echo esc_html( $student_grade ); ?> ">
        <?php
    }

    // Saves Metadata (Based On User Choice)
    add_action( 'save_post', 'save_student_postdata' );
    function save_student_postdata( $post_id ) {
        if ( array_key_exists( 'lives', $_POST ) ) {
            $clean_value = sanitize_meta( 'student_home', $_POST['lives'], 'user' );
            update_post_meta( $post_id, 'student_home', $clean_value );
        } 
        if ( array_key_exists( 'address', $_POST ) ) {
            $clean_value = sanitize_meta( 'student_home', $_POST['address'], 'user' );
            update_post_meta( $post_id, 'student_address', $clean_value );
        } 
        if ( array_key_exists( 'birth', $_POST ) ) {
            $clean_value = sanitize_meta( 'student_home', $_POST['birth'], 'user' );
            update_post_meta( $post_id, 'student_birth', $clean_value );
        } 
        if ( array_key_exists( 'grade', $_POST ) ) {
            $clean_value = sanitize_meta( 'student_home', $_POST['grade'], 'user' );
            update_post_meta( $post_id, 'student_grade', $clean_value );
        }
        if ( isset( $_POST['status'] ) ) {
            update_post_meta( $post_id, 'student_status', TRUE );
        } else {
            update_post_meta( $post_id, 'student_status', FALSE );
        }
    }

