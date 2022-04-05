<?php
    $panda_option = get_option('panda_option');
    global $post;
?>

<div class="post-author-meta block">
    <div class="author-meta-bg" style="background-image:url('<?php pandapro_the_author_cover(get_the_author_meta('ID')) ?>')"></div>
    <div class="author-meta-inner d-flex flex-fill">
        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>" class="flex-avatar w-56 ">
            <?php echo get_avatar(get_the_author_meta('ID'), 56, '', '') ?>
        </a>
        <div class="author-meta-body flex-fill mt-1 mx-3">
            <div class="d-flex align-items-center mb-1">
                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>" class="h6 text-white"><?php the_author_meta('display_name') ?></a>
                <div class="author-insignia ms-1" tooltip="<?php pandapro_the_author_role_name(get_the_author_meta('ID')) ?>" flow="up"></div>
            </div>
            <?php if(get_the_author_description()): ?>
            <div class="text-white text-sm mb-2"><?php the_author_description(); ?></div>
            <?php else: ?>
            <div class="text-white text-sm mb-2">用自己的眼睛去读世间这一部书。</div>
            <?php endif; ?>
            <?php if ($panda_option['default_donate_image']) : ?>
                <a href="javascript:;" class="btn btn-danger btn-xs btn-rounded btn-w-sm plus-power-popup"><?php _e('Donate', 'pandapro') ?></a>
                <?php get_template_part_with_vars('template-parts/popup/plus-power-popup', array('id' => get_the_author_meta('ID'))) ?>
            <?php endif; ?>
        </div>

        
    </div>
</div>