<?php
$category = get_the_category();
$panda_option = get_option('panda_option');
$meta = $panda_option['meta_layout'] ?: [];
?>
<div class="d-flex flex-fill align-items-center text-xs text-muted">
    <?php
    $category = get_the_category();
    if (!is_category()) {
        if ($category[0]) {
            echo '<a href="' . get_category_link($category[0]->term_id) . '" class="me-2 me-md-3"><i class="text-sm iconfont icon-dots-circle me-1"></i>' . $category[0]->cat_name . '</a>';
        }
    }
    ?>
    <?php if (is_array($meta)) : ?>
        <?php if (in_array('name', $meta)) : ?>
            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>" class="d-none d-md-inline-block">
                <i class="text-sm iconfont icon-user1"></i>
                <?php echo the_author_meta('display_name'); ?>
            </a>
        <?php endif; ?>
        <div class="flex-fill"> </div>


        <?php if (in_array('time', $meta)) : ?>
            <time class="d-none d-md-inline-block ms-2 ms-md-3"><?php pandapro_the_time() ?></time>
        <?php endif; ?>
        <?php if (in_array('view', $meta)) : ?>
            <span class="d-none d-md-inline-block ms-2 ms-md-3"><i class="text-sm iconfont icon-eye me-1"></i><?php pandapro_post_views('', ''); ?></span>
        <?php endif; ?>
        <?php if (in_array('comment', $meta)) : ?>
            <span class="d-none d-md-inline-block ms-2 ms-md-3"><i class="text-sm iconfont icon-message me-1"></i><?php echo $post->comment_count; ?></span>
        <?php endif; ?>
        <?php if (in_array('like', $meta)) : ?>
            <span class="ms-2 ms-md-3"><i class="text-sm iconfont icon-like me-1"></i><?php echo pandapro_get_hearts(get_the_ID()) ?></span>
        <?php endif; ?>
    <?php endif; ?>
</div>