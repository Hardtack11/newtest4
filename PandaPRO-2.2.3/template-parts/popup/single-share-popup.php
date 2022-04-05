<?php
$s = new MiShare();
$panda_option = get_option('panda_option');
$share_channel = $panda_option['share_channel'];
$likes_count = pandapro_get_hearts(get_the_ID());
$bigger_cover = get_field('api_generation_poster', 'options');
global $post;

$url = get_the_permalink(get_the_ID());
$title = get_the_title();
$image = pandapro_post_thumbnail_src();
$description = nc_print_excerpt(150, $post, false);

$s->config = array(
    'url' => $url,
    'title' => $title,
    'des'   => $description,
    'pic' => $image
);
?>

<template id="single-share-template">
    <div class="row g-0 text-center justify-content-center py-3 py-md-4 mx-md-0">
        <div class="col-4 col-md-3">
            <a href="javascript:;"  data-clipboard-text="<?php the_permalink() ?>" class="d-inline-block copy-permalink">
                <div class="btn btn-light btn-icon btn-md btn-rounded mb-1">
                    <span><i class="iconfont icon-link"></i></span>
                </div>
                <div class="text-secondary text-xs mt-1"><?php _e('Copy Link', 'pandapro') ?></div>
            </a>
        </div>
        <?php if ($bigger_cover == 1) : ?>
        <div class="col-4 col-md-3">
            <a href="javascript:;" class="d-inline-block btn-bigger-cover" id="btn-bigger-cover"
                data-id="<?php the_ID(); ?>">
                <div class="btn btn-light btn-icon btn-md btn-rounded mb-1">
                    <span><i class="iconfont icon-download"></i></span>
                </div>
                <div class="text-secondary text-xs mt-1"><?php _e('Poster', 'pandapro') ?></div>
            </a>
        </div>
        <?php endif; ?>

        <?php if ($share_channel == 'domestic') : ?>
        <div class="col-4 col-md-3">
            <a href="<?php echo $s->weibo() ?>" class="d-inline-block" target="_blank">
                <div class="btn btn-light btn-icon btn-md btn-rounded btn-weibo mb-1">
                    <span><i class="iconfont icon-weibo"></i></span>
                </div>
                <div class="text-secondary text-xs mt-1"><?php _e('Weibo', 'pandapro') ?></div>
            </a>
        </div>
        <div class="col-4 col-md-3">
            <a href="javascript:;" class="d-inline-block weixin single-popup" data-img="<?php echo $s->weixin() ?>"
                data-title="<?php _e('Open WeChat and Scan QR Code', 'pandapro') ?>"
                data-desc="<?php _e('Tapping to share this post with friends', 'pandapro') ?>">
                <div class="btn btn-light btn-icon btn-md  btn-rounded btn-weixin mb-1">
                    <span><i class="iconfont icon-wechat"></i></span>
                </div>
                <div class="text-secondary text-xs mt-1"><?php _e('WeChat', 'pandapro') ?></div>
            </a>
        </div>
        <?php endif; ?>
        <?php if ($share_channel == 'abroad') : ?>
        <div class="col-4 col-md-3">
            <a href="<?php echo $s->facebook() ?>" class="d-inline-block" target="_blank">
                <div class="btn btn-light btn-icon btn-md btn-rounded btn-facebook mb-1">
                    <span><i class="iconfont icon-facebook1"></i></span>
                </div>
                <div class="text-secondary text-xs mt-1">Facebook</div>
            </a>
        </div>
        <div class="col-4 col-md-3">
            <a href="<?php echo $s->twitter() ?>" class="d-inline-block" target="_blank">
                <div class="btn btn-light btn-icon btn-md btn-rounded btn-twitter mb-1">
                    <span><i class="iconfont icon-twitter"></i></span>
                </div>
                <div class="text-secondary text-xs mt-1">Twitter</div>
            </a>
        </div>
        <?php endif; ?>
    </div>
    <script>
    $(document).ready(function() {
        var clipboard = new ClipboardJS('.copy-permalink');

        clipboard.on('success', function(e) {
            ncPopupTips(true, '<?php _e('Copied!', 'pandapro') ?>');
            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            ncPopupTips(false, '<?php _e('Copied Failed!', 'pandapro') ?>');
        });
    })
    </script>
</template>