<?php $panda_option = get_option('panda_option'); ?>
<?php $queryPosts = new WP_Query(array('post__in' => array_column($panda_option['index_featured_posts'], 'post'),'ignore_sticky_posts'	=> 1,'order'=> 'DESC',)); ?>
<?php if ($queryPosts->have_posts()) : ?>
<div class="index-slide slide-style-1 swiper mb-3 mb-xl-4">
    <div class="swiper-wrapper">
        <?php while ($queryPosts->have_posts()) : ?>
        <?php $queryPosts->the_post(); ?>
        <?php global $post; ?>
        <?php $category = get_the_category(); ?>
        <div class="swiper-slide rounded">
            <div class="media media-3x1">
                <div class="media-content" style="background-image: url(<?php pandapro_the_thumbnail() ?>)"></div>
            </div>
            <div class="slide-inner">
                <div class="slide-body">
                    <div class="slide-title h5 mt-lg-1 mb-lg-4 mb-xl-5">
                        <?php the_title() ?>
                    </div>
                    <div class="banner-desc d-none d-lg-block"><?php nc_print_excerpt(60) ?></div>
                </div>
            </div>
            <a href="<?php the_permalink() ?>" target="_blank" class="slide-link"></a>
        </div>
        <?php endwhile; ?>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>
<?php endif; ?>
<?php wp_reset_postdata() ?>