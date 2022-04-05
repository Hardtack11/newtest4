<?php

/**
 * The template for displaying archive pages
 *
 * @package Panda PRO
 */
get_header();
$tax = get_queried_object();
$args = array(
    'post_type' => 'news',
    'orderby' => 'date',
    'order' => 'DESC',
    'tax_query' => array(
        array(
            'taxonomy' => 'news-category',
            'terms'    =>  $tax->term_id,
        )
    )
);
$queryPosts = new WP_Query($args);
delete_option('panda_newscat_prev_date');
?>

<main class="site-main ">
    <div class="container">
        <?php if ($queryPosts->have_posts()) : ?>
        <div class="list-time-header mb-4 mb-lg-5">
            <div class="media media-4x1 rounded">
                <div class="media-content"
                    style="background-image:url('<?php pandapro_the_newscat_cover($tax->term_id) ?>')">
                    <div class="overlay-1"></div>
                </div>
                <div class="media-overlay px-3">
                    <div class="w-100 text-center my-auto">
                        <?php the_archive_title('<h1>', '</h1>'); ?>
                        <?php if ($tax->description) : ?><div class="text-lg h-1x mt-2 mt-md-3">
                            <?php echo $tax->description ?></div><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="content-wrapper col-lg-8">
                <div class="list-time list-time-category">
                    <?php while ($queryPosts->have_posts()) : ?>
                    <?php $queryPosts->the_post(); ?>
                    <?php get_template_part('template-parts/news-category-loop') ?>
                    <?php endwhile; ?>
                </div>
                <?php
                    get_template_part_with_vars('template-parts/post-navigation', array(
                        'ajax_loading' => true,
                        'page' => 'news-category',
                        'query' => $tax->term_id,
                        'append' => 'list-time-category'
                    ));
                    ?>
                <?php get_template_part('template-parts/ad/tax-ad'); ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
        <?php else : ?>
        <?php get_template_part('template-parts/svg/empty-svg'); ?>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();