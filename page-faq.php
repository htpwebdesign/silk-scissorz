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

<main id="primary" class="site-main-faq">
	<!-- Dropdown menu -->


	<?php
	while (have_posts()) :
		the_post();

		if (function_exists('get_field')) :
			if (get_field('category')) :

				if (have_rows('category')) : ?>
					<div id="category-area">
						<label for="category">Choose a category:</label>
						<select name="categories" id="categories">
							<option selected disabled><?php echo "Select an option" ?></option>
							<?php
							while (have_rows('category')) : the_row();
								$category_name = get_sub_field('category_name') ?>

								<option value="dropdown-<?php echo get_row_index(); ?>"><?php echo $category_name ?></option>

							<?php endwhile; ?>

						</select>
					</div>
					<?php endif;
				if (have_rows('category')) :
					while (have_rows('category')) : the_row();
						$category_name = get_sub_field('category_name') ?>

						<div class="category-content" id="dropdown-<?php echo get_row_index(); ?>">
							<h2><?php echo $category_name; ?></h2>


							<?php
							if (get_sub_field('faq-qna')) :
								// Loop over sub repeater rows.
								if (have_rows('faq-qna')) :
									while (have_rows('faq-qna')) : the_row();

										// Get sub value.
										$question = get_sub_field('faq-questions');
										$answer = get_sub_field('faq-answers');
							?>
										<button class="accordion"><?php echo $question; ?></button>
										<div class="panel">
											<p><?php echo $answer; ?></p>
										</div>

							<?php
									endwhile;
								endif;
							endif; ?>
						</div><?php
							endwhile;
						endif;



					endif;
				endif;
			endwhile; // End of the loop. 
								?>




</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
