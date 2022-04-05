<?php $panda_option = get_option('panda_option') ?>
<?php if ($panda_option['related_posts'] && ($panda_option['news'] ?? true)): ?>
<?php
    $cats = get_the_terms(get_the_ID(), 'news-category');
    $args = array(
        'post_type'  => 'news',
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'news-category',
                'field' => 'id',
                'terms' => is_array($cats) ? array_column($cats, 'term_id') : array(),
                'include_children' => false 
            )
        ),
        'post__not_in'        => array(get_the_ID()),
        'posts_per_page'      => $panda_option['related_posts_number'],
        'ignore_sticky_posts' => 1,
    );
    $recentPosts = new WP_Query($args);
?>
    <?php if ($recentPosts->have_posts()): ?>
    <section class="post-related">
        <div class="mx-1 my-3"><i class="text-xl text-primary iconfont icon-refresh-line me-2"></i><?php _e('Related News', 'pandapro') ?></div>
        <div class="content-related card">
            <div class="card-body">
                <div class="list list-dots my-n2">
                    <?php while ($recentPosts->have_posts()) : ?>
                        <?php $recentPosts->the_post(); ?>
                        <div class="list-item py-2">
                            <a href="<?php the_permalink() ?>" class="list-title h-2x">
                                <?php the_title() ?>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>