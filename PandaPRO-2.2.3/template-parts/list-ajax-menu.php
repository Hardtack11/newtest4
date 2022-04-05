<?php $panda_option = get_option('panda_option') ?>
<?php $ajax_loading = $panda_option['index_ajax_loading'] ?>
<?php if ($ajax_loading) : ?>
<?php $index_tab = $panda_option['index_tab'] ?>
<?php if (!empty($index_tab['list']) && is_array($index_tab['list'])) : ?>
<div class="list-ajax-menu slide-ajax-menu swiper mb-2 mb-md-3">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <button type="button" class="btn btn-light btn-sm btn-rounded btn-ajaxpost btn-w-md active"
                data-cid="-2.1"><?php echo empty($index_tab['display_name']) ? __('Recommended', 'pandapro') : $index_tab['display_name']; ?></button>
        </div>
        <?php
                foreach ($index_tab['list'] as $index => $tab) {
                    echo sprintf('<div class="swiper-slide"><button type="button" class="btn btn-light btn-sm btn-rounded btn-ajaxpost btn-w-md " data-cid="%s">%s</button></div>', $tab['cat'], $tab['display_name']);
                }
                ?>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>