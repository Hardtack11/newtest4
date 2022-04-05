<?php $panda_option = get_option('panda_option'); ?>
<?php $slides = $panda_option['index_featured_slides']; ?>
<?php if (is_array($slides) && count($slides) > 0) : ?>
<div class="index-slide slide-style-3 mb-3 mb-xl-4">
    <div class="row gx-lg-2 gx-xl-3">
        <div class="banner-wrapper col-lg-8">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($slides as $slide) : ?>
                    <div class="swiper-slide rounded overlay-hover">
                        <div class="media media-21x9">
                            <div class="media-content"
                                style="background-image: url(<?php echo timthumb($slide['image']) ?>)"></div>
                            <?php if ($slide['link']) : ?>
                            <div class="media-overlay overlay-bottom p-2 p-md-3">
                                <div class="h4 h-2x"><?php echo $slide['link']['title'] ?></div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo $slide['link']['url'] ?>" target="_blank" class="slide-link"></a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <?php
            $right = $panda_option['index_slides_style3_right'];
            $type = $right['type'] ?? 'post';
            ?>
        <?php if ($type === 'post') : ?>
        <?php global $post;
                $post = get_post($right['post'])  ?>
        <?php if ($post) : ?>
        <?php
                    $category = get_the_category($right['post']);
                    ?>
        <div class="banner-sidebar col-lg-4 d-none d-lg-flex ms-lg-auto">
            <div class="list-item block list-overlay-content overlay-hover d-md-flex flex-md-fill">
                <div class="media d-md-flex flex-md-fill">
                    <div class="media-content" style="background-image: url(<?php pandapro_the_thumbnail($post) ?>);">
                        <div class="overlay-grad"></div>
                    </div>
                </div>
                <div class="list-content">
                    <div class="list-body ">
                        <div class="list-title text-light"><?php echo $category[0]->name; ?></div>
                        <div class="h4 mt-1">
                            <?php the_title() ?>
                        </div>
                    </div>
                </div>
                <a href="<?php the_permalink() ?>" class="list-goto"></a>
            </div>
        </div>
        <?php wp_reset_postdata() ?>
        <?php endif; ?>
        <?php endif; ?>
        <?php if ($type === 'category' || $type === 'special') : ?>
        <?php $term = get_term($right[$type], $type) ?>
        <?php if (!is_wp_error($term)) : ?>
        <div class="banner-sidebar col-lg-4 d-none d-lg-flex ms-lg-auto">
            <div class="list-item block list-overlay-content overlay-hover d-md-flex flex-md-fill">
                <div class="media media-3x2 flex-fill">
                    <div class="media-content"
                        style="background-image: url(<?php pandapro_the_category_cover($term->term_id) ?>);">
                        <div class="overlay-grad"></div>
                    </div>
                </div>
                <div class="list-content">
                    <div class="list-body ">
                        <div class="list-title text-light"><?php echo $term->name ?></div>
                        <?php if ($term->description) : ?>
                        <div class="h4 mt-1">
                            <?php echo $term->description ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <a href="<?php echo get_term_link($term, $type) ?>" class="list-goto"></a>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>