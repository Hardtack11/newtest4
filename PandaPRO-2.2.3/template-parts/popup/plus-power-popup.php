<?php $template_params = isset($template_params) ? $template_params : array() ?>
<?php
    $panda_option = get_option('panda_option');
    $donate_image = get_user_meta($template_params['id'], 'donate_image', true);
    $donate_image = empty($donate_image) ? $panda_option['default_donate_image'] : $donate_image;
?>
<div id="plus-power-popup-wrap">
    <div class="popup-inner">
        <div class="text-center p-3 p-md-4">
            <img src="<?php echo timthumb($donate_image) ?>" alt="<?php the_author_meta('display_name') ?>" class="d-inline-block">
        </div>
    </div>
</div>
