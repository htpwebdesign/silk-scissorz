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
	<?php while (have_posts()) : the_post(); ?>

		<h1><?php the_title(); ?></h1>
		<?php
		if (function_exists('get_field')) :
		?>
			<section>
				<?php
				/* === Contact Info === */
				if (have_rows('contact_info')) :
					while (have_rows('contact_info')) : the_row();
						$store_address = get_sub_field('store_address');
						$store_phone = get_sub_field('store_phone');
						$store_email = get_sub_field('store_email');
						$store_parking_info = get_sub_field('store_parking_info');
						$store_location_map = get_sub_field('store_location_map'); ?>

						<address>
							<p><?php echo esc_html($store_address); ?></p>
							<a href="tel:<?php echo esc_html($store_phone); ?>"><?php echo esc_html($store_phone); ?></a>
							<a href="mailto:<?php echo esc_html($store_email); ?>"><?php echo esc_html($store_email); ?></a>
						</address>
						<p><?php echo esc_html($store_parking_info); ?></p>
						<div class="map">
							<?php echo esc_html($store_location_map); ?>
						</div>
					<?php
					endwhile;
				endif;

				/* === Business Hours === */
				if (have_rows('business_hours')) : ?>
					<table>
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
				?>
			</section>
	<?php
		endif;
	endwhile; // end of the loop. 
	?>
	<?php
	function my_acf_google_map_api($api)
	{
		$api['key'] = 'store_location_map';
		return $api;
	}
	add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
	?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
