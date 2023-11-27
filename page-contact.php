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
<div class="contact__wrap">
        <?php while (have_posts()) : the_post(); ?>
          <h1><?php the_title(); ?></h1>
          <?php
          /* === Contact Info === */
          if (function_exists('get_field')) : 
          ?>
    <section>
        <div class="contact__businesshours">
          <div class="contact__info__wrap">
              <?php if (have_rows('contact_info')) : ?>
                <article class="contact__info">
                  <h2>Contact Info</h2>
                  <?php
                  while (have_rows('contact_info')) : the_row();
                    $store_address = get_sub_field('store_address');
                    $store_phone = get_sub_field('store_phone');
                    $store_email = get_sub_field('store_email');
                    $store_parking_info = get_sub_field('store_parking_info');
                  ?>
                    <address>
                      <p><?php echo esc_html($store_address); ?></p>
                      <p><a href="tel:<?php echo esc_html($store_phone); ?>"><?php echo esc_html($store_phone); ?></a></P>
                      <p><a href="mailto:<?php echo esc_html($store_email); ?>"><?php echo esc_html($store_email); ?></a></p>
                    </address>
                  <?php endwhile; ?>
                </article>
          </div>
              <?php endif;

          /* === Business Hours === */
          if (have_rows('business_hours')) : ?>
          <div class="business__info">
            <table>
              <caption> Business Hours </caption>
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
          </div>
        </div>
      
        <?php
        endif;
        ?>
    </section>
    <div class="map__wrap">
        <!-- Map and Parking Info -->
        <?php
            while (have_rows('contact_info')) : the_row();
              $store_parking_info = get_sub_field('store_parking_info');
        ?>
            <section class="map__section">
              <?php
              $location = get_sub_field('store_location_map'); // Adjust the field name based on your ACF setup
              if ($location) :
              ?>
              <div class="acf-map" data-zoom="13">
                  <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>">
                      <!-- Marker content goes here -->
                  </div>
              </div>
              <h2>Parking Info</h2>
              <p><?php echo esc_html($store_parking_info); ?></p>
              <?php 
              endif; 
              ?>
            </section>
        <?php
        endwhile;
        ?>
  </div>
</div>
    <section>
      <div class="contact__form">
        <?php the_content(); ?>
      </div>
    </section>
  <?php
		endif;
	endwhile; // end of the loop. 
	?>

</main><!-- #main -->

<!-- this is just a random comment to make a commit on git -->

<?php
get_sidebar();
get_footer();
