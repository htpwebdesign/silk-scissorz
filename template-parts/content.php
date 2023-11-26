<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Silk_&_Scissorz
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if (is_singular()) :
			the_title('<h1 class="entry-title">', '</h1>');
		else :
			the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		endif;
		?>
	</header><!-- .entry-header -->

	<?php silk_scissorz_post_thumbnail();
	if ('post' === get_post_type()) :
	?>
		<div class="entry-meta">
			<?php
			silk_scissorz_posted_on();
			silk_scissorz_entry_footer();
			// silk_scissorz_posted_by();
			?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
		if (is_single()) :
			the_content();
		else :
			the_excerpt();
		endif;

		/* === Related Products or Posts Section === */
		if (is_single()) :
			if (function_exists('get_field')) :
				$featured_posts = get_field('single_post_products_section');
				if ($featured_posts) :
		?>
					<section class="related-products">
						<h2 class="related-products-heading">Related Products</h2>
						<div class="related-products-wrapper">
							<?php
							foreach ($featured_posts as $post) :
								setup_postdata($post);
							?>
								<article class="related-product">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('medium'); ?>
										<h3><?php the_title(); ?></h3>
										<!-- <?php
												if (function_exists('wc_get_product')) :
													$product = wc_get_product(get_the_ID());
												?>

										<span class="price"><?php echo $product->get_price_html(); ?></span>
										<a href="<?php echo esc_url($product->get_permalink()) ?>">Read More</a>

									<?php
												endif;
									?> -->
									</a>
								</article>
							<?php
							endforeach;
							wp_reset_postdata();
							?>
						</div>
					</section>
		<?php
				endif;
			endif;
		endif;

		/* === Related Products or Posts Section End === */

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'silk-scissorz'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
	<!-- 
	<footer class="entry-footer">
		<?php silk_scissorz_entry_footer(); ?>
	</footer> -->
	<!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->