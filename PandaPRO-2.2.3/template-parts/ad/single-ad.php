<?php $panda_option = get_option('panda_option'); ?>
<?php $ad = $panda_option['single_ad']; ?>
<?php if (!empty($ad['type'] && $ad['type'] != 'closed')): ?>
    <div class="post-business mb-3 mb-lg-4">
        <div class="d-none d-lg-block">
        <?php if ($ad['type'] == 'code'): ?>
            <?php echo $ad['code_pc'] ?>
        <?php else: ?>
            <a href="<?php echo esc_url($ad['link']); ?>" target="_blank"><img src="<?php echo wp_get_attachment_image_url($ad['image_pc'], 'full'); ?>"></a>
        <?php endif; ?>
        </div>
        <div class="d-lg-none">
        <?php if ($ad['type'] == 'code'): ?>
            <?php echo $ad['code_mobile'] ?>
        <?php else: ?>
            <a href="<?php echo esc_url($ad['link']); ?>" target="_blank"><img src="<?php echo wp_get_attachment_image_url($ad['image_mobile'], 'full'); ?>"></a>
        <?php endif; ?>
        </div>
    </div>
<?php endif; ?>