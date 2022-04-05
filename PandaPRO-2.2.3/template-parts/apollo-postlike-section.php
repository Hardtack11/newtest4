<?php if (defined('NC_APOLLO_DIR')): ?>
    <?php $users_id = get_post_meta(get_the_ID(), 'suxing_ding_users', true); ?>
    <?php if (is_array($users_id) && !empty($users_id)): ?>
    <div id="apollo-postlike-section" class="my-3 my-md-4" >
        <div class="avatar-group">
            <?php foreach(array_slice($users_id, 0, 10) as $user_id): ?>
                <a href="<?php echo get_author_posts_url($user_id) ?>" class="flex-avatar w-24">
                    <?php echo get_avatar( $user_id, 24, '', '' ); ?>
                </a>
            <?php endforeach; ?>
            <div class="text-xs ms-1"><?php printf( __( '%d member(s) like this post', 'pandapro'  ), pandapro_get_hearts(get_the_ID()) ); ?></div>
        </div>
    </div>
    <?php endif; ?>
<?php endif; ?>

