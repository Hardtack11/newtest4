<?php $panda_option = get_option('panda_option') ?>
<?php if ($panda_option['related_posts']) : ?>
<?php

    $post_tags = get_the_tags() ? get_the_tags() : array();
    $exclude_id = get_the_ID();
    $cats = get_the_category();

    $args = array(
        'type'                => 'post',
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'post_tag',
                'field' => 'id',
                'terms' => array_column($post_tags, 'term_id'),
            ),
            array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => array_column($cats, 'term_id'),
                'include_children' => false
            )
        ),
        'post__not_in'        => array(get_the_ID()),
        'posts_per_page'      => $panda_option['related_posts_number'],
        'ignore_sticky_posts' => 1,
    );

    $recentPosts = new WP_Query($args);
    ?>
<?php if ($recentPosts->have_posts()) : ?>
<div class="post-related card card-md mt-3 mt-md-4 mt-lg-3">
    <div class="card-body">
        <div class="h5 mb-3"><i
                class="text-primary text-lg iconfont icon-sync me-1"></i><?php _e('Related Posts', 'pandapro') ?></div>
        <ul>
            <?php while ($recentPosts->have_posts()) : ?>
            <?php $recentPosts->the_post(); ?>
            <li>
                <a href="<?php the_permalink() ?>" class=" ">
                    <div class="h-1x"><?php the_title() ?></div>
                </a>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php endif; ?>