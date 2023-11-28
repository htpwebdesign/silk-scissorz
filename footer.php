<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Silk_&_Scissorz
 */

?>

<footer id="colophon" class="site-footer">
    <?php

	// WP Query	for Contact Page
	$args = array(
		'post_type' => 'page',
		'page_id' => 28
	);
	$contact_query = new WP_Query($args);
	if ($contact_query->have_posts()) :
		while ($contact_query->have_posts()) : $contact_query->the_post();
			if (function_exists('get_field')) :
	?>
    <section class="contact-section">
        <?php
					/* === Contact Info === */
					if (have_rows('contact_info')) :
					?>
        <article>
            <h2>Contact Info</h2>
            <?php
							while (have_rows('contact_info')) : the_row();
								$store_address = get_sub_field('store_address');
								$store_phone = get_sub_field('store_phone');
								$store_email = get_sub_field('store_email');
								$store_parking_info = get_sub_field('store_parking_info');
							?>

            <address>
                <span>Address:</span>
                <p><?php echo esc_html($store_address); ?></p>
                <span>Phone:</span>
                <p><a href="tel:<?php echo esc_html($store_phone); ?>"><?php echo esc_html($store_phone); ?></a></p>
                <span>Email:</span>
                <p><a href="mailto:<?php echo esc_html($store_email); ?>"><?php echo esc_html($store_email); ?></a></p>

            </address>
            <?php
							endwhile;
							?>
        </article>
        <?php
					endif;

					/* === Business Hours === */
					if (have_rows('business_hours')) : ?>
        <table>
            <caption>
                Business Hours
            </caption>
            <thead>
                <?php
								$day_of_week_label = get_sub_field_object('day_of_week');
								$open_time_label = get_sub_field_object('opening_hour');
								$close_time_label = get_sub_field_object('closing_hour');
								?>
                <tr>
                    <th><?php echo esc_html($day_of_week_label['label']); ?></th>
                    <th><?php echo esc_html($open_time_label['label']); ?></th>
                    <th><?php echo esc_html($close_time_label['label']); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
								while (have_rows('business_hours')) : the_row();
									$day_of_week = get_sub_field('day_of_week');
									$open_time = get_sub_field('opening_hour');
									$close_time = get_sub_field('closing_hour');
									// if $open_time and $close_time are empty, first td print day, second prints closed, only two tds
									if (empty($open_time) && empty($close_time)) :
								?>
                <tr>
                    <td><?php echo esc_html($day_of_week); ?></td>
                    <td colspan="2">Closed</td>
                </tr>
                <?php
									else :
									?>
                <tr>
                    <td><?php echo esc_html($day_of_week); ?></td>
                    <td><?php echo esc_html($open_time); ?></td>
                    <td><?php echo esc_html($close_time); ?></td>
                </tr>
                <?php
									endif;
								endwhile;
								?>
            </tbody>
        </table>
        <?php
					endif;

					if (has_nav_menu('footer-right')) :
					?>

        <nav class="footer-navigation">
            <header>Quick Links</header>
            <?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer-right',
									'menu_id'        => 'quick-link-menu',
								)
							);
							?>
        </nav>
        <?php
					endif;
					?>
    </section>
    <section class="map-section">
        <div class="map">
            <!-- Map and Parking Info -->
            <?php
						while (have_rows('contact_info')) : the_row();
							$store_parking_info = get_sub_field('store_parking_info');
						?>
            <?php
							$location = get_sub_field('store_location_map'); // Adjust the field name based on your ACF setup
							if ($location) :
							?>
            <h2>Parking Info</h2>
            <p><?php echo esc_html($store_parking_info); ?></p>
            <div class="acf-map" data-zoom="13">
                <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>"
                    data-lng="<?php echo esc_attr($location['lng']); ?>">
                    <!-- Marker content goes here -->
                </div>
            </div>
            <?php
							endif;
							?>
    </section>
    <?php
						endwhile;

					endif;
				endwhile;
				wp_reset_postdata();
			endif;

			if (has_nav_menu('social-media')) :
	?>
    <nav class="social-media-navigation">
        <?php
				wp_nav_menu(
					array(
						'theme_location' => 'social-media',
						'menu_id'        => 'social-media-menu',
					)
				);
		?>
    </nav>
    <?php
			endif;
?>

    <div class="site-info">
        <p>Created by <a href="https://jadielin.com">Jadie</a>, <a href="https://kaorisato.ca">Kaori</a>, <a
                href="https://khushimangla.com">Khushi</a>, and <a href="https://willyhsu.ca">Willy</a>.</p>


    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>