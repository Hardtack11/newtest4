<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @package Suxing2019
 */
$panda_option = get_option('panda_option');
if (defined('NC_APOLLO_DIR')) {
    $apollo_pages    = get_field('apollo_pages', 'options');
    $apollo_auth_url = get_page_link($apollo_pages['user_member_login_page']);
}
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
$user_ID = get_current_user_id();
if (isset($_POST['action']) && $_POST['action'] == 'ajax_load_comments') {
    wp_list_comments('avatar_size=48&type=comment&callback=pandapro_comment&end-callback=pandapro_end_comment&max_depth=2');
    die();
}

?>
<div id="comments" class="comments card card-md mt-3 mt-md-4 mt-lg-3">
    <div class="card-body">
        <div class="h5 mb-3">
            <i class="text-primary text-lg iconfont icon-kefu me-1"></i><?php $pandapro_comment_count = get_comments_number();
            echo esc_html__('Comments', 'pandapro');
            echo ' (' . number_format_i18n($pandapro_comment_count) . ')'; ?>
        </div>

        <?php if (comments_open()) : ?>
        <div id="respond" class="comment-respond">
            <?php if (get_option('comment_registration') && !$user_ID) : ?>
            <div class="logged-in-as rounded bg-light text-center p-4 p-md-5 ">
                <div class="text-muted text-sm mb-3"><?php _e('Please login to leave a comment.', 'pandapro') ?></div>
                <?php if (!defined('NC_APOLLO_DIR')) : ?>
                <a class="btn btn-primary btn-sm btn-rounded"
                    href="<?php echo esc_url(wp_login_url()); ?>"><?php _e('Login now.', 'pandapro') ?></a>
                <?php else : ?>
                <a class="btn btn-primary btn-sm btn-rounded"
                    href="<?php echo $apollo_auth_url; ?>"><?php _e('Login now.', 'pandapro') ?></a>
                <?php endif; ?>
            </div>
            <?php else : ?>
            <form method="post" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" id="commentform"
                class="comment-form mb-4">
                <div class="comment-from-author d-flex flex-fill">

                    <div class="comment-avatar-author flex-avatar w-32 me-3 ">
                        <?php
                                if ($user_ID) {
                                    echo get_avatar($user_ID, 32);
                                } else if ($comment_author_email != '') {
                                    echo get_avatar($comment_author_email, 32);
                                } else {
                                    echo  '<img src="' . get_template_directory_uri() . '/images/default-avatar.png' . '" class="avatar w-32">';
                                }
                                ?>
                    </div>

                    <div class="comment-form-body flex-fill">
                        <div class="comment-form-name mb-2">
                            <?php if ($user_ID) : ?>
                            <?php echo $user_identity; ?>
                            <a href="<?php echo wp_logout_url(get_the_permalink()); ?>"
                                class="text-muted ms-2"><?php _e('Logout', 'pandapro') ?></a>
                            <?php elseif ('' != $comment_author) : ?>
                            <?php printf(__('%s'), $comment_author); ?><a href="javascript:toggleCommentAuthorInfo();"
                                class="text-muted ms-2"
                                id="toggle-comment-author-info"><?php _e('Edit Profile', 'pandapro') ?></a>
                            <?php endif; ?>
                        </div>
                        <div class="comment-form-text">
                            <?php if (!$user_ID) : ?>
                            <div class="comment-form-info row g-2 g-md-3 mb-3">
                                <div class="col-12">
                                    <input class="form-control" id="author"
                                        placeholder="<?php _e('Nickname', 'pandapro') ?>" name="author" type="text"
                                        value="<?php echo $comment_author; ?>" required="required">
                                </div>
                                <?php $req = get_option('require_name_email'); if ($req) : ?>
                                <div class="col-12">
                                    <input id="email" class="form-control" name="email"
                                        placeholder="<?php _e('Email', 'pandapro') ?>" type="email"
                                        value="<?php echo $comment_author_email; ?>" required="required">
                                </div>
                                <?php endif; ?>
                                <div class="col-12">
                                    <input class="form-control " placeholder="<?php _e('Website', 'pandapro') ?>" id="url"
                                        name="url" type="url" value="<?php echo $comment_author_url; ?>">
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="comment-textarea mb-3">
                                <textarea id="comment" name="comment" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-submit text-end">
                                <a rel="nofollow" id="cancel-comment-reply-link" style="display: none" href="javascript:;"
                                    class="btn btn-light me-2"><?php _e('Back', 'pandapro') ?></a>
                                <button type="submit" id="submit"
                                    class="btn btn-dark"><?php _e('Submit', 'pandapro') ?></button>
                                <?php comment_id_fields(); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <?php endif; ?>
        </div>
        <ul class="comment-list mt-3 mt-md-5">
            <?php
                if (get_comments_number() > 0) :
                    wp_list_comments('type=comment&callback=pandapro_comment&end-callback=pandapro_end_comment&max_depth=2');
                else :
                ?>
            <div class="text-center py-5 ">
                <div class="icon-svg svg-nocomment svg-sm"></div>
                <div class="text-muted text-sm mt-3"><?php _e('Leave a comment', 'pandapro'); ?></div>
            </div>
            <?php endif; ?>
        </ul><!-- .comment-list -->
        <?php if (get_comment_pages_count() > 1) { ?>
        <div class="comment-ajax-load text-center mt-4">
            <button id="comments-next-button" <?php if (is_page()) : ?> data-type="page" <?php endif; ?>
                <?php if (is_single()) : ?> data-type="post" <?php endif; ?> data-query="<?php the_ID(); ?>"
                data-action="ajax_load_comments" data-paged="<?php echo get_next_page_number(); ?>"
                data-commentcount="<?php echo get_comment_pages_count(); ?>"
                data-commentspage="<?php echo get_option('default_comments_page'); ?>" data-append="comment-list"
                class="btn btn-dark btn-w-lg"><?php esc_html_e('Load more...', 'pandapro'); ?></button>
        </div>
        <?php } ?>
        <?php else : ?>
        <div class="no-comments alert alert-danger"><?php esc_html_e('Comments are closed.', 'pandapro'); ?></div>
        <?php endif; ?>
    </div>
</div>
<!-- #comments -->