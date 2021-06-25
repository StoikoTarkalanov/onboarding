<?php

    // Widget -> Displays Active/Inactive
    class Students_Widget extends WP_Widget {
        
        function __construct() {
            parent::__construct(
                'students_widget', 
                'Students Widget', 'students_widget_domain', 
                array( 'description' => 'Monitoring students status', 'students_widget_domain' ) 
            );
        }
        
        public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', $instance['title'] );
            $status = $instance[ 'status' ];
            $data_per_post = $instance['data_per_post'];

            // Check Title
            if ( ! empty( $title ) ) {
                echo $args['before_title'] . $title . $args['after_title'];
            }

            // Set Arguments
            $args = array(
                'post_type'  => 'students',
    			'posts_per_page'    => $data_per_post,
            );

            // Check To Set Properly Meta query
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


            // Set Query And If Post -> Displays Current Data
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) {
                if ( $status == 'active' ) {
                    ?> <h6>Active Now:</h6> <?php
                } else {
                    ?> <h6>Inactive:</h6> <?php
                }
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();

                    ?> <h6> <a href=" <?php the_permalink(); ?> "> <?php the_title(); ?> </a> </h6> <?php
                }
            } else {
                ?> <h6>There are no active students yet!</h6> <?php
            }
        }
        
        // 
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
        register_widget( 'Students_Widget' );
    }

    // Custom Sidebar
    add_action( 'widgets_init', 'custom_students_sidebar' );
    function custom_students_sidebar() {
        register_sidebar(
            array (
                'name'          => 'Custom Students Sidebar', 'twentytwentychild',
                'id'            => 'students-sidebar',
                'description'   => 'Custom Sidebar - Student Information', 'twentytwentychild',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="widget-students">',
                'after_title'   => '</h3>',
            )
        );
    }

    // hook widget data to single post content
    // add_filter( 'the_content', 'filter_students_content', 1 );
    function filter_students_content( $content ) {
        if ( is_singular( 'students' ) && in_the_loop() && is_main_query() ) {
            return $content . get_sidebar( 'Custom Students Sidebar' );
        } else {
            return $content;
        }
    }