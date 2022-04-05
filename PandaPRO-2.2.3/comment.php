<?php $panda_option = get_option('panda_option'); ?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
    <article id="div-comment-<?php comment_ID() ?>" class="comment-body d-flex flex-fill ">
        <div class="comment-avatar-author me-3 ">
            <a href="<?php echo pandapro_get_the_comment_author_url(); ?>" rel="nofollow"
                class="d-block flex-avatar w-32"><?php echo get_avatar($comment, 32); ?></a>
        </div><!-- .comment-author -->
        <div class="comment-text flex-fill text-sm border-bottom border-light pb-4 mt-1 mb-4">
            <div class="comment-info d-flex flex-fill align-items-center mb-2">
                    <?php pandapro_the_comment_author_link() ?>
                    <?php pandapro_comment_official($comment->user_id); ?>
            </div>

            <div class="comment-content text-secondary">
                <?php
                comment_text();
                ?>
                <?php if ($comment->comment_approved == '0') : ?>
                <span
                    class="badge badge-info mt-1"><?php echo esc_html_e('Your comment is awaiting moderation.', 'pandapro') ?></span>
                <?php endif; ?>

            </div><!-- .comment-content -->
            <div class="text-xs text-muted mt-2">
                <?php echo pandapro_timeago(get_comment_time('G', false)) ?>
                <i class="text-primary iconfont icon-dot mx-1"></i>
                <a href="?replytocom=<?php comment_ID() ?>#respond" class="comment-reply-link" rel="nofollow"
                    onclick="return addComment.moveForm( 'comment-<?php comment_ID() ?>','<?php comment_ID() ?>', 'respond','<?php echo $comment->comment_post_ID; ?>' ) "><?php _e('Reply', 'pandapro'); ?></a>
            </div>
        </div><!-- .comment-text -->
    </article><!-- .comment-body -->