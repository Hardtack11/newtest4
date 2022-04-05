<?php
$panda_option = get_option('panda_option');
$likes_count = pandapro_get_hearts(get_the_ID());
global $post;
?>
<div class="post-actions d-flex align-items-center my-3 my-md-4">
    <?php $is_liked = isset($_COOKIE['suxing_ding_' . $post->ID]); ?>
    <a href="javascript:;"
        class="post-like-button btn btn-light btn-w-md btn-rounded <?php if ($is_liked) echo 'active'; ?> me-2"
        data-action="<?php echo $is_liked ? 'unlike' : 'like' ?>" data-id="<?php the_ID(); ?>">
        <i class="text-lg iconfont icon-like"></i> <span class="like-count"><?php echo $likes_count; ?></span>
    </a>
    <?php get_template_part('/template-parts/apollo-collect-section') ?>
    <div class="flex-fill"></div>
    <a href="javascript:;" class="btn btn-light btn-icon btn-rounded btn-share-toggler">
        <span><i class="iconfont icon-share-square"></i></span>
    </a>
    <?php get_template_part('template-parts/popup/single-share-popup') ?>
</div>

<?php get_template_part('/template-parts/apollo-postlike-section') ?>