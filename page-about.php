<?php
/**
 * The template for displaying page about
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
		<?php while ( have_posts() ) : the_post();
			$about_us = get_field('about_us');
		 	$store_image = get_field('store_image');?>

			<h1><?php the_title(); ?></h1>
			
			<section>
				<!-- About us description -->
				<p><?php echo esc_html($about_us); ?></p>
				<!-- echo esc_html(get_field('about_us')); -->

				<!-- Store images -->
				<figure>
					<?php echo wp_get_attachment_image($store_image, 'full'); ?>
				</figure>
			</section>
		<?php endwhile; // end of the loop. ?>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
