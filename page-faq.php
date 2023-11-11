<?php

/**
 * The template for displaying the faq page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Silk_&_Scissorz
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', 'page');

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;

		// Check rows exists.
		if (have_rows('repeater_field_name')) :

			// Loop through rows.
			while (have_rows('repeater_field_name')) : the_row();

				// Load sub field value.
				$sub_value = get_sub_field('sub_field');
			// Do something...
			
			// End loop.
			endwhile;
		// Do something...
		endif;

	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
