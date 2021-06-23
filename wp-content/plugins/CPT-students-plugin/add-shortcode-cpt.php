<?php

    // Shortcode
    // Use to call -> [single_student_short_code id=????] 
    // add_shortcode( 'single_student_short_code', 'custom_short_code' );
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
        
        return $data != '' ? $data : '<p> "Could not find students with this ID" </p>';
   }

  