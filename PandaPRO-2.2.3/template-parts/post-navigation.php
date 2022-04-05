<?php $template_params = isset($template_params) ? $template_params : array() ?>
<?php if ($template_params['ajax_loading']) : ?>
<div class="list-ajax-load">
    <button type="button" class="dposts-ajax-load btn btn-dark btn-lg btn-w-lg"
        data-page="<?php echo $template_params['page'] ?>" data-query="<?php echo $template_params['query']; ?>"
        data-action="ajax_load_posts" data-paged="2"
        data-append="<?php echo $template_params['append'] ?>"><?php _e('Load more...', 'pandapro') ?></button>
</div>
<?php else : ?>
<?php
    the_posts_pagination(array(
        'prev_text'          => '<i class="iconfont icon-left"></i>',
        'next_text'          => '<i class="iconfont icon-right"></i>',
        'screen_reader_text' => 'Posts Navigation',
        'mid_size' => 1,
    ));
    ?>
<?php endif; ?>