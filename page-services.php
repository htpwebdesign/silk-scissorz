<?php

/**
 * The template for displaying services pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
get_header();
?>

<main id="primary" class="site-main services-container">
    <?php while (have_posts()) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
    <?php
        $args = array(
            'post_type' => 'silk-services',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'orderby' => 'title'
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) : ?>
    <nav class="service-links">
        <?php
                while ($query->have_posts()) : $query->the_post();
                ?>
        <a href="#service-<?php echo esc_attr(get_the_ID()) ?>"><?php echo esc_html(get_the_title()) ?></a>
        <?php
                endwhile;
                wp_reset_postdata();
                ?>
    </nav>
    <?php
            while ($query->have_posts()) : $query->the_post();
                if (function_exists('get_field')) :
                    if (get_field('price_list')) :
                        if (have_rows('price_list')) :
            ?>
    <article id="service-<?php the_ID(); ?>">
        <h2><?php echo esc_html(get_the_title()); ?></h2>
        <table>
            <thead>
                <tr>
                    <th> Service Name</th>
                    <th> Service Price </th>
                </tr>
            </thead>
            <tbody>
                <?php
                                        while (have_rows('price_list')) : the_row();
                                            $text   = get_sub_field('service_name');
                                            // Display content from the repeater subfields
                                            $number = get_sub_field('service_price');
                                        ?>
                <tr>
                    <td><?php echo esc_html($text); ?></td>
                    <td>$<?php echo esc_html($number); ?></td>
                </tr>
                <?php
                                        endwhile;
                                        ?>
            </tbody>
        </table>
    </article>
    <?php
                        endif;
                    endif;
                endif;
            endwhile;
            wp_reset_postdata();
        endif
        ?>
    <section class="products">
        <a href="<?php echo wc_get_page_permalink('shop') ?>">See All Products</a>
        <?php
            echo do_shortcode('[products limit="4" columns="4" orderby="rand" category="services" cat_operator="NOT IN" class="random-products"]');
            ?>
    </section>
    <?php endwhile; // End of the loop. 
    ?>
</main>

<?php
get_footer();