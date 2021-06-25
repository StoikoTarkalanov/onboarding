<?php
/**
 * Plugin Name: Gutengerg Custom Widget
 */

	// Creating Custom Gutenberg Block - Widget
	// Add Title, Description, icon, Default Attributes 
	add_action( 'init', 'create_block_gutenpride_block_init' );
	function create_block_gutenpride_block_init() {
		register_block_type_from_metadata( __DIR__ , 
			array(
				'title' 	  => 'Custom Students Block',
				'description' => 'Show Active/Inactive Students',
				'icon' 		  => 'universal-access-alt',
				'attributes'  => array(
					'status'   		   => array( 'type' => 'string', 'default' 	=> 'active' ),
					'students_to_load' => array( 'type' => 'integer', 'default' => 5 ),
					'color_text'	   => array( 'type' => 'string', 'default' 	=> '#ffffff' ),
					'color_background' => array( 'type' => 'string', 'default' 	=> '#000000' ),
					'text_align' 	   => array( 'type' => 'string', 'default' 	=> 'center' ),
				),
				'render_callback' => 'block_data_markup_render_callback',
			) 
		);
	}

	// Define Callback Function
	function block_data_markup_render_callback( $atts ) {
		$status 			= $atts['status'];
		$students_to_load 	= $atts['students_to_load'];
		$color_text		 	= $atts['color_text'];
		$color_background 	= $atts['color_background'];
		$text_align 		= $atts['text_align'];

		// Get Current (Custom) Post Type
		$args = array(
			'post_type'  		=> 'students',
			'posts_per_page'    => $students_to_load,
		);

		// Get Active/Inactive Students
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

			// Check For Posts 
		if ( $the_query->have_posts() ) : ob_start(); ?>
			
			<!-- Add Div Element To Set Background Style -->
			<div style="background-color: <?php echo $color_background; ?>; text-align: <?php echo $text_align ?>;"> 

			<!-- If They Are Active/Inactive Display Proper Message -->
			<?php if ( $status == 'active' ) : ?>
				<h6 style="color: <?php echo $color_text; ?>">Active Now:</h6>
			<?php else : ?>
				<h6 style="color: <?php echo $color_text; ?>">Inactive:</h6>
			<?php endif; ?>
		
			<!-- While Students -> Display Title And Set Link To Single Page -->
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<h6><a style="color: <?php echo $color_text; ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			<?php endwhile; ?>
			
		<?php else : ?>

			<!-- If We Don't Have Students Display Proper Message --> 
			<?php if ( $status == 'active' ) : ?> 
				<h6>There are no active students yet!</h6>
			<?php else : ?>
				<h6>There are no inactive students yet!</h6>
			<?php endif; ?>

		<?php endif; ?>
		</div> 

		<?php
		// Sent Data To Edit.js File
		$collect_data = ob_get_clean();
		return $collect_data;
	}
