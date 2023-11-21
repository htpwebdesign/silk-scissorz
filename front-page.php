<?php

/**
 * The template for displaying home page
 *
 * This is the template that displays the home page by default.
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
	while (have_posts()) : the_post();
	?>
		<h1 class="home__h1"><?php the_title() ?></h1>

		<?php
		if (function_exists('get_field')) :

			/* === Hero Section === */
			if (get_field('carousel')) :
				if (have_rows('carousel')) : ?>
					<section class="carousel">
						<div class="swiper-hero-section">
							<div class="swiper-wrapper">
								<?php
								while (have_rows('carousel')) : the_row();
									$sub_image = get_sub_field('carousel_img');
									$sub_button_text = get_sub_field('button_text');
									$sub_link = get_sub_field('button_link');
								?>
									<div class="swiper-slide">
										<div>
											<?php echo wp_get_attachment_image($sub_image, 'full'); ?>
										</div>
										<!-- hero section CTA button -->
										<div class="hero-btn">
											<a href="<?php echo esc_url($sub_link); ?>"><?php echo $sub_button_text; ?></a>
										</div>
									</div>
								<?php
								endwhile; ?>
							</div>
							<div class="swiper-pagination"></div>
						</div>
					</section>
					<?php
				endif;
			endif;
			/* === Hero Section End === */

			/* === About Section === */
			// WP Query	for About Page
			$args = array(
				'post_type' => 'page',
				'page_id' => 26
			);
			$about_query = new WP_Query($args);
			if ($about_query->have_posts()) :
				while ($about_query->have_posts()) : $about_query->the_post();
					if (get_field('about_us') && get_field('store_image')) :
						$about_us = get_field('about_us');
						$about_image = get_field('store_image');
					?>
						<section class="about">
							<h2><?php the_title(); ?></h2>
							<figure class="about__image">
								<?php echo wp_get_attachment_image($about_image, 'full'); ?>
							</figure>
							<div class="about__content">
								<p><?php echo esc_html($about_us); ?></p>
								<a href="<?php the_permalink(); ?>">About us</a>
							</div>
						</section>
				<?php
					endif;
				endwhile;
				wp_reset_postdata();
			endif;
			/* === About Section End === */


			/* === Gallery Section === */
			$featured_posts = get_field('gallery');
			if ($featured_posts) : ?>
				<section class="gallery">
					<?php foreach ($featured_posts as $post) :
						setup_postdata($post); ?>
						<a class="gallery__item" href="<?php the_permalink() ?>">
							<?php the_post_thumbnail('large'); ?>
						</a>
					<?php endforeach;
					wp_reset_postdata(); ?>
				</section>

			<?php endif;
			/* === Gallery Section End === */



			/* === Services Section === */
			$args = array(
				'post_type' => 'silk-services',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC',
			);
			$services_query = new WP_Query($args);
			if ($services_query->have_posts()) : ?>
				<section class="services">
					<h2>Our Services</h2>
					<?php
					while ($services_query->have_posts()) : $services_query->the_post();
					?>
						<article>
							<a href="<?php echo esc_url(get_permalink(get_page_by_path('services'))) . '#service-' . get_the_ID(); ?>">
								<?php the_post_thumbnail('medium'); ?>
								<h3><?php the_title() ?></h3>
							</a>
						</article>

					<?php
					endwhile;
					wp_reset_postdata();
					?>
					<a href="<?php echo esc_url(get_page_link(24)) ?>">All Services</a>
				</section>
			<?php
			endif;
			/* === Services Section End === */
			?>


			<section class="products">
				<a href="<?php echo wc_get_page_permalink('shop') ?>">See All Products</a>
				<?php
				/* === Products Section === */
				echo do_shortcode('[products limit="4" columns="4" orderby="popularity" class="quick-sale" on_sale="true" ]');
				?>
			</section>
			<?php

			/* === Products Section End === */



			/* === Testimonials Section === */
			$args = array(
				'post_type' => 'silk-testimonials',
				'posts_per_page' => -1,
				'orderby' => 'rand',
			);
			$testimonials_query = new WP_Query($args);
			if ($testimonials_query->have_posts()) : ?>
				<section class="testimonials">
					<h2>Testimonials</h2>
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php
							while ($testimonials_query->have_posts()) : $testimonials_query->the_post();
								if (get_field('testimonials_text') && get_field('clients_name')) :
									$testimonials_text = get_field('testimonials_text');
									$clients_name = get_field('clients_name');
							?>
									<div class="swiper-slide">
										<article>
											<h3><?php the_title(); ?></h3>
											<blockquote>
												<p><?php echo esc_html($testimonials_text) ?></p>
												<cite><?php echo esc_html($clients_name) ?></cite>
											</blockquote>
										</article>
									</div>
							<?php
								endif;
							endwhile;
							wp_reset_postdata();
							?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
				</section>
	<?php
			endif;
		/* === Testimonials Section End === */


		endif;
	endwhile; // End of the loop.
	?>
</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
