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
					<!-- Address, Email, Phone Number -->
					<address>
						<p><?php echo esc_html($store_address); ?></p>
						<a href="tel:<?php echo esc_html($store_phone); ?>"><?php echo esc_html($store_phone); ?></a>
						<br>
						<a href="mailto:<?php echo esc_html($store_email); ?>"><?php echo esc_html($store_email); ?></a>
					</address>
					<!-- Google map -->
                    <div class="map">
                        <?php if ($store_location_map) : ?>
                            <gmp-map center="<?php echo esc_attr($store_location_map['lat']); ?>,<?php echo esc_attr($store_location_map['lng']); ?>" zoom="14" map-id="DEMO_MAP_ID">
                                <gmp-advanced-marker position="<?php echo esc_attr($store_location_map['lat']); ?>,<?php echo esc_attr($store_location_map['lng']); ?>" title="My location">
                                </gmp-advanced-marker>
                            </gmp-map>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </section>
    <?php endwhile; // end of the loop. ?>
	
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();