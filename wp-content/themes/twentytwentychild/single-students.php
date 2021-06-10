<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content" role="main">

	<?php
	$current_id = get_the_ID();
	$taxonomy_data = get_the_terms( $current_id, 'students-category' );
	// var_dump( $taxonomy_data );	

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
			
			if ( ! empty( $taxonomy_data ) ) {
				echo '<ul>';
					if ( count( $taxonomy_data ) > 1 ) {
						echo '<h6>' . 'Categories' . '</h6>';
					} else {
						echo '<h6>' . 'Category' . '</h6>';
					}

					foreach( $taxonomy_data as $data ) {
						echo '<li>' . $data->name . '</li>';
					}			
				echo '<ul>';
			}
			
		}
	}

	?>

</main><!-- #site-content -->

<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />

<?php get_footer(); ?>
