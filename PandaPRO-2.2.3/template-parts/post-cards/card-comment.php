<?php $template_params = isset($template_params) ? $template_params : array() ?>
<?php
$comment = $template_params['comment'];
$post = get_post($comment->comment_post_ID);
?>
<div class="list-item comment block">
    <div class="comment-quotes"></div>
    <div class="comment-body flex-fill">
        <div class="comment-action text-muted text-xs">
            <div class="h-1x">
                <span class="me-2">
                    <?php echo pandapro_timeago(strtotime($comment->comment_date)) ?>
                </span>
                <span>
                    <i class="text-sm iconfont icon-file-text me-1"></i><a href="<?php echo get_permalink($post->ID) ?>"
                        target="_blank"><?php echo get_the_title($post) ?></a>
                </span>
            </div>
        </div>
        <div class="comment-text mt-2">
            <?php echo $comment->comment_content ?>
        </div>
    </div>
</div>