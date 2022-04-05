<?php

/**
 * The template for displaying archive pages
 *
 * @package Panda PRO
 */

global $wp_query;

$panda_option = get_option('panda_option');

$tpage = 'search';
$query = $wp_query->query['s'];

$ajax_loading = $panda_option['archive_ajax_loading'];

get_header();
?>

<main class="site-main ">
    <div class="container">
        <?php if (have_posts()) : ?>
        <div class="row">
            <div class="content-wrapper col-lg-8">
                    
                <div class="archive-header block p-4 p-xl-5 mb-3">
                    <div class="archive-icon btn btn-primary btn-icon btn-md btn-rounded"><span><i class="iconfont icon-search"></i></span></div>
                    <div class="archive-body">
                        <h1><?php _e('Search', 'pandapro'); ?> <?php echo get_search_query(); ?></h1>
                    </div>
                </div>
                <?php while (have_posts()) : the_post(); ?>
                <div class="list-search list-grid list-grid-padding">
                    <?php get_template_part("template-parts/post-cards/card", get_post_format()); ?>
                </div>
                <?php endwhile; ?>
                <?php
					get_template_part_with_vars('template-parts/post-navigation', array(
						'ajax_loading' => $ajax_loading,
						'page' => $tpage,
						'query' => $query,
						'append' => 'list-search'
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