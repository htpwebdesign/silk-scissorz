<?php
/**
 * The template for displaying all pages
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

<main id="primary" class="site-main">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            </header>

            <nav class="service-links">
                <?php
                $args = array(
                    'post_type' => 'silk-services',
                    'posts_per_page' => -1,
                    'order' => 'ASC',
                    'orderby' => 'title'
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        echo '<a href="#' . esc_attr(get_the_ID()) . '">' . esc_html(get_the_title()) . '</a>';
                        ?>

                        <div class="service-content">

                            <?php
                            if (have_rows('price_list')) {
                                while (have_rows('price_list')) {
                                    the_row();
                                    // Display content from the repeater subfields
                                    $text = get_sub_field('service_name'); // Replace 'text_field' with the actual subfield name
                                    $number = get_sub_field('service_price'); // Replace 'number_field' with the actual subfield name
                                    echo '<h3>' . esc_html($text) . '</h3>';
                                    echo '<p>' . esc_html($number) . '</p>';
                                }
                            }
                            ?>

                        </div>

                        <?php
                    }
                    wp_reset_postdata();
                }
                ?>
            </nav>

        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
