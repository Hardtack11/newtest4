<?php $template_params = isset($template_params) ? $template_params : array() ?>
<?php $category = get_the_category(); ?>
<?php $type_text = $template_params['type'] === 'history_post' ? __('That day', 'pandapro') : __('Random Post', 'pandapro') ?>

<div class="list-item list-overlay-content overlay-hover rounded">
    <div class="media">
        <div class="media-content" style="background-image:url('<?php echo pandapro_the_thumbnail(null, array('w' => 400, 'h' => 400)) ?>')"><span class="overlay-1"></span></div>
        <div class="media-overlay overlay-top p-4">
            <div class="d-flex flex-column font-theme text-center">
                <span class="d-block display-4 text-white text-height-xs"><?php the_time('d') ?></span>
                <time class="d-block text-xs"><?php the_time('M, Y') ?> </time>
            </div>
        </div>
        <?php if ($template_params['type'] === 'random_post'): ?>
        <a href="javascript:" <?php echo isset($template_params['author']) && is_numeric($template_params['author']) ? 'data-id="'.$template_params['author'].'"' : '' ?> class="refresh-random-post text-white text-lg "><i class="d-block iconfont icon-sync"></i></a>
        <?php endif; ?>
    </div>
    <div class="list-content">
        <div class="list-body">
            <div href="<?php the_permalink() ?>" class="list-title h5 h-1x" title="<?php the_title() ?>"><?php the_title() ?></div>
        </div>
    </div>
    <a href="<?php the_permalink() ?>" target="_blank" class="list-goto"></a>
</div>
