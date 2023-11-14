<?php
/**
 * The template for displaying page contact
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
		<?php while ( have_posts() ) : the_post(); ?>

			<h1><?php the_title(); ?></h1>
			

			<section>
            <?php if( have_rows('contact_info') ): ?>
                <?php while( have_rows('contact_info') ): the_row(); 
				$store_address = get_sub_field('store_address');
				$store_phone = get_sub_field('store_phone');
				$store_email = get_sub_field('store_email');
				$store_parking_info = get_sub_field('store_parking_info');
				$store_location_map = get_sub_field('store_location_map');?>

					<p><?php echo esc_html($store_address); ?></p>
					<p><?php echo esc_html($store_phone); ?></p>
					<p><?php echo esc_html($store_email); ?></p>
					<p><?php echo esc_html($store_parking_info); ?></p>
                
                    <div class="map">
                        <?php echo esc_html($store_location_map); ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </section>
    <?php endwhile; // end of the loop. ?>
	<?php
	function my_acf_google_map_api( $api ){
		$api['key'] = 'store_location_map';
		return $api;
	}
	add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
	?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();