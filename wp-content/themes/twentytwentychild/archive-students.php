<?php

get_header(); ?>
<div id="container">
	<div id="content" role="main">

	<?php
	
	if ( have_posts() ) {
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		$args_students_content = array(
		 	'post_type'         => 'students',
		 	'posts_per_page'    => 4,
		 	'paged'          	=> $paged
		);

		$the_query = new WP_Query( $args_students_content );
		if ( $the_query->have_posts() ) {
		
			while ( $the_query->have_posts() ) {
				$the_query->the_post();

				?>

				<div class="entry-header-inner section-inner medium"> 
					<h2 class="entry-title heading-size-1">
						<a href=<?php the_permalink() ?>><?php the_title() ?></a> 
					</h2>
				<p> <?php the_content() ?> </p>
				<span>Posted on: <?php the_time("Y-m-d") ?> </span>
				</div>
				<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />

				<?php
			}
			echo '<div style="text-align: center">' . paginate_links() . '</div>';
			wp_reset_postdata();
		}
	}
	?>

	</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar( 'Custom Students Sidebar' ); ?>
<?php get_footer(); ?>
