<?php

/**
 * The template for displaying archive pages
 *
 * @package Panda PRO
 */

global $wp_query;

$panda_option = get_option('panda_option');
$cat_cover = $panda_option['cat_cover'];
$ajax_loading = $panda_option['archive_ajax_loading'];
$category = get_queried_object();
$theme = get_field('theme', $category) ?: 'category-style-1';
get_header();
?>
<main class="site-main ">
    <div class="container">
        <?php if (have_posts()) : ?>
        <?php if (!$cat_cover && $theme !== 'category-style-1' ) : ?>
            <div class="archive-header block p-4 p-xl-5 mb-4 mb-lg-5">
                <span class="archive-icon btn btn-primary btn-icon btn-md btn-rounded"><span><i
                            class="iconfont icon-calendar-fill"></i></span></span>
                <div class="archive-body">
                    <div class="h1"><?php echo $category->name; ?><sup
                            class="text-muted mx-1"><?php echo pandapro_get_cat_postcount($category->term_id) ?></sup>
                    </div>
                    <?php if ($category->description) : ?>
                    <div class="text-secondary h-2x mt-1 mt-md-2"><?php echo $category->description ?></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php elseif($theme == 'category-style-2') : ?>
        <div class="list-time-header mb-4 mb-lg-5">
            <div class="media media-4x1 rounded">
                <div class="media-content" style="background-image:url('<?php pandapro_the_category_cover($category->term_id) ?>')"><div class="overlay-1"></div></div>
                <div class="media-overlay px-3">
                    <div class="w-100 text-center my-auto">
                        <h1><?php echo $category->name; ?><sup class="text-light mx-1"><?php echo pandapro_get_cat_postcount($category->term_id) ?></sup></h1>
                        <?php if ( $category->description ) : ?><div class="text-lg h-1x mt-2 mt-md-3"><?php echo $category->description ?></div><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="content-wrapper col-lg-8">
                <?php if (!$cat_cover && $theme !== 'category-style-2' ) : ?>
                <div class="archive-header block p-4 p-xl-5 mb-3 mb-md-4">
                    <span class="archive-icon btn btn-primary btn-icon btn-md btn-rounded"><span><i
                                class="iconfont icon-read-fill"></i></span></span>
                    <div class="archive-body">
                        <h1><?php echo $category->name; ?><sup class="text-muted mx-1"><?php echo pandapro_get_cat_postcount($category->term_id) ?></sup>
                        </h1>
                        <?php if ($category->description) : ?>
                        <div class="cover-footer mt-1 mt-md-2"><div class="text-secondary h-2x"><?php echo $category->description ?></div></div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php elseif($theme == 'category-style-1') : ?>
                    <div class="list-cover rounded mb-3">
                        <div class="media media-21x9">
                            <div class="media-content"
                                style="background-image:url('<?php pandapro_the_category_cover($category->term_id) ?>')">
                                <div class="overlay-grad"></div>
                            </div>
                        </div>
                        <div class="cover-body">
                            <h1 class="cover-title"><?php echo $category->name; ?><sup class="text-light mx-1"><?php echo pandapro_get_cat_postcount($category->term_id) ?></sup></h1>
                            <?php if ($category->description) : ?>
                            <div class="cover-footer mt-1 mt-md-2">
                                <div class="h-2x"><?php echo $category->description ?></div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($theme == 'category-style-1') : ?>
                <div class="list-category list-archive list-grid list-grid-padding">
                    <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part("template-parts/post-cards/card", get_post_format()); ?>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
                <?php if ($theme == 'category-style-2') : ?>
                <div class="list-category list-time list-time-category">
                    <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/news-category-loop') ?>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
                <?php
                    get_template_part_with_vars('template-parts/post-navigation', array(
                        'ajax_loading' => $ajax_loading,
                        'page' => 'cat',
                        'query' => $cat,
                        'append' => 'list-category'
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