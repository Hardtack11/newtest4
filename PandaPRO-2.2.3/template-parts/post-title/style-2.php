<?php 
    $panda_option = get_option('panda_option');
    $category = get_the_category();
    $meta_layout = $panda_option['meta_layout'];
    global $post;
?>
<div class="post-title mb-3">
    <?php pandapro_the_sticky_tag();?>
    <h1 class="mb-3"><?php the_title() ?><?php edit_post_link('<i class="iconfont icon-edit-square ms-2"></i>', '', ''); ?></h1>
    <div class="post-meta text-xs">
        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><i class="text-sm iconfont icon-user1 me-1"></i><?php the_author(); ?></a>
        <i class="text-primary iconfont icon-dot mx-2"></i>
        <?php pandapro_the_time(); ?>
    </div>
</div>