<?php

/**
 * The template for displaying archive pages
 *
 * @package Panda PRO
 */

global $wp_query;

$panda_option = get_option('panda_option');
$cat_cover = $panda_option['cat_cover'];
if (is_category() || is_archive() && !is_author()) {
    $tpage = 'cat';
    $query = $cat;
}
if (is_tax('special')) {
    $tpage = 'tax';
    $query = $wp_query->queried_object->term_id;
}
if (is_tag()) {
    $tpage = 'tag';
    $query = $wp_query->queried_object->name;
}
$ajax_loading = $panda_option['archive_ajax_loading'];

get_header();
?>
<main class="site-main ">
    <div class="container">
        <?php if (have_posts()) : ?>
        <div class="row">
            <div class="content-wrapper col-lg-8">
                <?php if (is_category()) : ?>
                <?php $category = get_queried_object() ?>
                <?php if ($cat_cover) : ?>
                <div class="list-cover block mb-3">
                    <div class="media media-21x9">
                        <div class="media-content" style="background-image:url('<?php pandapro_the_category_cover($category->term_id) ?>')">
                            <div class="overlay-grad"></div>
                        </div>
                    </div>
                    <div class="cover-body">
                        <h1 class="cover-title"><?php echo $category->name; ?><sup class="text-light mx-1"><?php echo $category->count ?? 0 ?></sup></h1>
                        <?php if ($category->description) : ?>
                        <div class="cover-footer mt-1 mt-md-2">
                            <div class="h-2x"><?php echo $category->description ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php else : ?>
                <div class="archive-header block p-4 p-xl-5 mb-3">
                    <div class="archive-icon btn btn-primary btn-icon btn-md btn-rounded"><span><i class="iconfont icon-read-fill"></i></span></div>
                    <div class="archive-body">
                        <h1><?php echo $category->name; ?><sup class="text-muted mx-1"><?php printf(__('%d'), $wp_query->queried_object->count ?? 0) ?></sup></h1>
                        <?php if ($category->description) : ?>
                        <div class="cover-footer mt-1 mt-md-2">
                            <div class="text-secondary h-2x"><?php echo $category->description ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php elseif (is_tax()) : ?>
                <?php $category = get_queried_object() ?>
                <div class="topic-cover block mb-3">
                    <div class="media media-21x9">
                        <div class="media-content" style="background-image:url('<?php pandapro_the_category_cover($category->term_id) ?>')"></div>
                        <div class="media-overlay overlay-top p-3">
                            <span class="badge badge-dark badge-topic badge-md rounded"><i class="icon-topic-dot iconfont icon-read"></i><?php _e('Column', 'pandapro'); ?></span>
                        </div>
                    </div>
                    <div class="cover-body">
                        <h1 class="cover-title"><?php echo $category->name; ?><sup lass="mx-1"><?php echo $category->count ?></sup></h1>
                        <?php if ($category->description) : ?>
                        <div class="cover-footer mt-1 mt-md-2">
                            <div class="h-2x"><?php echo $category->description ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php elseif (is_tag()) : ?>
                <div class="archive-header block p-4 p-xl-5 mb-3">
                    <div class="archive-icon btn btn-primary btn-icon btn-md btn-rounded"><span><i class="iconfont icon-tag-fill"></i></span></div>
                    <div class="archive-body">
                        <h1><?php single_tag_title(); ?><sup class="text-muted mx-1"><?php printf(__('%d'), $wp_query->queried_object->count ?? 0) ?></sup></h1>
                    </div>
                </div>
                <?php elseif (is_date()) : ?>
                <div class="archive-header block mb-3">
                    <h1 class="font-theme text-center p-4 p-xl-5">
                        <span class="d-inline-block px-3 py-2 border border-2 border-dark">
                            <div><?php echo get_the_date( 'm' ); ?></div>
                            <div class="text-xs"><?php echo get_the_date( 'Y' ); ?></div>
                        </span>
                    </h1>
                </div>
                <?php endif; ?>
                <div class="list-archive list-grid list-grid-padding">
                    <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part("template-parts/post-cards/card", get_post_format()); ?>
                    <?php endwhile; ?>
                </div>
                <?php
                    get_template_part_with_vars('template-parts/post-navigation', array(
                        'ajax_loading' => $ajax_loading,
                        'page' => $tpage,
                        'query' => $query,
                        'append' => 'list-archive'
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