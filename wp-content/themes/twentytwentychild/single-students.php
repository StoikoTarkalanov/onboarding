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
	// echo $current_id;
	$taxonomy_data = get_the_terms( $current_id, 'students-category' );

	$status_data = get_post_meta( $current_id, 'student_status', true );
	$lives_in_data = get_post_meta( $current_id, 'student_home', true );
	$address_data = get_post_meta( $current_id, 'student_address', true );
	$birth_data = get_post_meta( $current_id, 'student_birth', true );
	$grade_data = get_post_meta( $current_id, 'student_grade', true );

	
	wp_trim_words( $address_data );
	wp_trim_words( $birth_data );
	wp_trim_words( $grade_data );

	if ( have_posts() ) {

		// ('[single_student_short_code id=1877]');

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
				echo '</ul>';
			}
			
			if ( $status_data == '1' || ! empty( wp_trim_words( $lives_in_data ) ) || ! empty( wp_trim_words( $address_data ) ) || ! empty( wp_trim_words( $birth_data ) ) || ! empty( wp_trim_words( $grade_data ) ) ) {
				echo '<ul>';
					echo '<h6>User Info</h6>';
					if ( ! empty( wp_trim_words( $lives_in_data ) ) ) {
						echo '<li>' . $lives_in_data . '</li>';
					} 	
					if ( ! empty( wp_trim_words( $address_data ) ) ) {
						echo '<li>' . $address_data . '</li>';
					}	
					if ( ! empty( wp_trim_words( $birth_data ) ) ) {
						echo '<li>' . $birth_data . '</li>';
					}	
					if ( ! empty( wp_trim_words( $grade_data ) ) ) {
						echo '<li>' . $grade_data . '</li>';
					}	
					if ( $status_data == '1' ) {
						echo '<li>' . 'Active Now' . '</li>';
					} else {
						echo '<li>' . 'Inactive' . '</li>';
					}	
				echo '</ul>';
			}
		}
	}

	?>

</main><!-- #site-content -->

<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />

<?php get_footer(); ?>
