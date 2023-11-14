<?php

/**
 * The template for displaying booking pages
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
	while (have_posts()) : the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<?php

		$stylists = wc_get_products(array(
			'status'    => 'publish',
			'type'      => 'booking',
			'limit'     => -1,
			'orderby' => 'title',
			'order' => 'ASC',
		));
		// check if any products found
		if (!empty($stylists)) :
			// Loop through an array of the WC_Product objects
			foreach ($stylists as $stylist) :
				// Output stylists info
		?>
				<article>
					<?php echo $stylist->get_image("woocommerce_single"); ?>
					<h2><?php echo esc_html($stylist->get_name()); ?></h2>
					<p><?php echo esc_html($stylist->get_short_description()); ?></p>
					<a href="<?php echo esc_url($stylist->add_to_cart_url()); ?>">Book Now</a>
				</article>
	<?php
			endforeach;
		endif;
	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
