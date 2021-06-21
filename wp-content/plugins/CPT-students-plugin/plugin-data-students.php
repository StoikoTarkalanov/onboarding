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
                    'supports'      => array( 'editor', 'thumbnail' ),
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

  }

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

    add_filter( 'manage_students_posts_columns', 'is_active_columns_head' );
    function is_active_columns_head( $defaults ) {
        $defaults['activate_deactivate'] = 'Activate/Deactivate';
        return $defaults;
    }

    add_action( 'manage_students_posts_custom_column', 'is_active_columns_content', 10, 2 );
    function is_active_columns_content( $column_name, $post_ID ) {

        if ( $column_name == 'activate_deactivate' ) {
            $checkbox_value = get_post_meta( $post_ID, 'student_status', true );
            

            ?>
                <input type="checkbox" name="status" value='1'<?php checked( $checkbox_value, '1' ); ?> >
            <?php
        }
    }

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

    function student_metabox_markup_status( $post ) {
        $student_status = get_post_meta( $post->ID, 'student_status', true );

        ?>
            <label>Status</label>
            <input name="status" id="status" type="checkbox" value="<?php echo $student_status; ?>">
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
        var_dump( $post->ID );
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

    add_shortcode( 'single_student_short_code', 'custom_short_code' );
    function custom_short_code( $atts ) {
        $atts = shortcode_atts( array(
            'id'    => ''
        ), $atts);
        $args = array( 'post_type' => 'students', 'p' => $atts['id'] );
        $data = '';

        $the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) {

            ob_start();
			while ( $the_query->have_posts() ) {
				$the_query->the_post();

                ?>
                <div class="entry-content">
                    <p> <?php the_title(); ?> </p>
                    <p> <?php echo get_the_content( null, false, $atts['id'] ); ?> </p>
                    <li> <?php echo get_post_meta( $atts['id'], 'student_grade', true ) ?> </li> 
                </div>
                <?php
            }

            $data = ob_get_clean();
		}
        
		// [single_student_short_code id=????] 
        return $data != '' ? $data : '<p> "Could not find students with this ID" </p>';
    }

    class students_widget extends WP_Widget {
  
        function __construct() {
            parent::__construct(
                'students_widget', 
                __('Students Widget', 'students_widget_domain'), 
                array( 'description' => __( 'Monitoring students status', 'students_widget_domain' ), ) 
            );
        }
        
        public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', $instance['title'] );
            $status = $instance[ 'status' ];
            $data_per_post = $instance['data_per_post'];
            
            // echo $args['before_widget'];

            if ( ! empty( $title ) ) {
                echo $args['before_title'] . $title . $args['after_title'];
            }

            $args = array(
                'post_type'  => 'students',
    			'posts_per_page'    => $data_per_post,
            );

            if ( $status == 'active' ) {
                $args['meta_query'] = array(
                    array(
                        'key'   => 'student_status',
                        'value' => '1'
                    )
                );
            } else {
                $args['meta_query'] = array(
                    array(
                        'key'   => 'student_status',
                        'value' => ''
                    )
                );
            }

            $the_query = new WP_Query( $args );

            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();

                    ?>
                        <h6> <a href=" <?php the_permalink(); ?> "> <?php the_title(); ?> </a> </h6>
                    <?php
                }
            } else {
                ?>
                    <h6>There are no active students yet!</h6>
                <?php
            }
            
            // echo $args['after_widget'];
        }
                
        public function form( $instance ) {
            $title = ! empty( $instance['title'] ) ? $instance['title'] : 'Add Title';
            $status = ! empty( $instance['status'] ) ? $instance['status'] : 'active';
            $data_per_post = $instance['data_per_post'];

            ?>
                <p>
                    <label for="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat">Title:</label> 
                    <br>
                    <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />                
                    <br>

                    <label for="<?php echo $this->get_field_id('status'); ?>">Choose Status:</label>
                    <select id="<?php echo $this->get_field_id('status'); ?>" name="<?php echo $this->get_field_name('status'); ?>" class="widefat">
                        <option <?php selected( $status, 'active' )?> value="active">Active</option>
                        <option <?php selected( $status, 'inactive' )?> value="inactive">Inactive</option> 
                    </select>
                    <br>

                    <label for="<?php echo $this->get_field_id('data_per_post'); ?>">Post per page:</label>
                    <select id="<?php echo $this->get_field_id('data_per_post'); ?>" name="<?php echo $this->get_field_name('data_per_post'); ?>" class="widefat" >
                        <option <?php selected( $data_per_post, '5' )?> value="5">5</option>
                        <option <?php selected( $data_per_post, '10' )?> value="10">10</option> 
                        <option <?php selected( $data_per_post, '15' )?> value="15">15</option> 
                        <option <?php selected( $data_per_post, '20' )?> value="20">20</option> 
                    </select>
                </p>
            <?php 
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();

            $instance['title'] = strip_tags( $new_instance['title'] );
            $instance['status'] = strip_tags( $new_instance['status'] );
            $instance['data_per_post'] = strip_tags( $new_instance['data_per_post'] );

            return $instance;
        }
    } 
     
    add_action( 'widgets_init', 'loading_widget' );
    function loading_widget() {
        register_widget( 'students_widget' );
    }

    add_action( 'widgets_init', 'custom_students_sidebar' );
    function custom_students_sidebar() {
        register_sidebar(
            array (
                'name'          => __( 'Custom Students Sidebar', 'twentytwentychild' ),
                'id'            => 'students-sidebar',
                'description'   => __( 'Custom Sidebar - Student Information', 'twentytwentychild' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="widget-students">',
                'after_title'   => '</h3>',
            )
        );
    }

    add_filter( 'the_content', 'filter_students_content', 1 );
    function filter_students_content( $content ) {
        if ( is_singular( 'students' ) && in_the_loop() && is_main_query() ) {
            return $content . get_sidebar( 'Custom Students Sidebar' );
        } else {
            return $content;
        }
    }


