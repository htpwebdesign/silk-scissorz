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
	<?php while (have_posts()) : the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<?php
		if (function_exists('get_field')) : ?>
			<section>
				<?php
				if (get_field('about_us')) :
					$about_us = get_field('about_us'); ?>
					<p><?php echo esc_html($about_us); ?></p>
				<?php
				endif;

				if (get_field('store_image')) :
					$store_image = get_field('store_image');
					echo wp_get_attachment_image($store_image, 'full');
				endif;
				?>
				<!-- echo esc_html(get_field('about_us')); -->
			</section>
		<?php
		endif;



		/* === Stylist Section === */
		$args = array(
			'post_type' => 'bookable_resource',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
		);
		$stylists_query = new WP_Query($args);

		if ($stylists_query->have_posts()) :
		?>
			<section class="stylists">
				<h2>Our Stylists</h2>
				<div class="stylists-container">
					<?php
					while ($stylists_query->have_posts()) : $stylists_query->the_post();
						if (function_exists('get_field')) : ?>

							<arricle class="stylist">
								<?php
								if (get_field('stylist_image')) :
									$stylist_image = get_field('stylist_image');
									echo wp_get_attachment_image($stylist_image, 'full');
								endif;
								?>
								<h3>
									<?php the_title(); ?>
									<?php
									if (get_field('stylist_slogan')) :
										$stylist_slogan = get_field('stylist_slogan');
									?>
										<span> - <?php echo esc_html($stylist_slogan); ?></span>
									<?php
									endif;
									?>
								</h3>
								<?php
								if (get_field('stylist_bio')) :
									$stylist_bio = get_field('stylist_bio');
								?>
									<p><?php echo esc_html($stylist_bio); ?></p>
								<?php
								endif;
								?>
							</arricle>
					<?php
						endif;
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<a href="<?php echo esc_url(get_page_link(141)) ?>">Book Now</a>
			</section>
	<?php
		endif;

	/* === Stylist Section End === */

	endwhile; // end of the loop. 
	?>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
