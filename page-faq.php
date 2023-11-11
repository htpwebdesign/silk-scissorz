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
	<!-- Dropdown menu -->


	<?php
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', 'page');

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;

		if (function_exists('get_field')) :
			if (get_field('category')) :

				if (have_rows('category')) : ?>

					<label for="cars">Choose a car:</label>
					<select name="cars" id="cars">

						<?php
						while (have_rows('category')) : the_row();
							$category_name = get_sub_field('category_name') ?>

							<option><?php echo $category_name ?></option>

						<?php endwhile; ?>

					</select>

					<?php endif;
				if (have_rows('category')) :
					while (have_rows('category')) : the_row();
						$category_name = get_sub_field('category_name') ?>


						<h3><?php echo $category_name; ?></h3>


						<?php
						if (get_sub_field('faq-qna')) :
							// Loop over sub repeater rows.
							if (have_rows('faq-qna')) :
								while (have_rows('faq-qna')) : the_row();

									// Get sub value.
									$question = get_sub_field('faq-questions');
									$answer = get_sub_field('faq-answers');
						?>


									<p><?php echo $question; ?></p>
									<p><?php echo $answer; ?></p>
									</div>
	<?php
								endwhile;
							endif;
						endif;
					endwhile;
				endif;



			endif;
		endif;
	endwhile; // End of the loop. 
	?>




</main><!-- #main -->

<?php
get_sidebar();
get_footer();
