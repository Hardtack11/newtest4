<?php
global $wp;
$panda_option = get_option('panda_option');
$open_login = $panda_option['open_login'] ?? false ;
$current_user = wp_get_current_user();
if (defined('NC_APOLLO_DIR')) {
    $open_apollo_login = true; // get_field('open_apollo_login', 'options');
    $apollo_pages = get_field('apollo_pages', 'options');
    $apollo_contribute = get_field('tougao_status', 'option');
    $apollo_member_url = get_page_link($apollo_pages['user_member_page'] ?? 0);
    $apollo_auth_url = get_page_link($apollo_pages['user_member_login_page'] ?? 0);
}
?>

<?php if (is_user_logged_in()) : ?>
<?php if ( defined('NC_APOLLO_DIR') && $apollo_contribute === 'enable') : ?>
<li class="nav-item me-2 me-md-3">
    <a class="btn btn-link btn-icon btn-sm btn-rounded"
        href="<?php echo $apollo_member_url; ?>/user/tougao"
        target="_blank">
        <span>
            <i class="iconfont icon-edit"></i>
        </span>
    </a>
</li>
<?php endif; ?>
<li class="nav-item dropdown-signin-box ms-md-3">
    <a href="#" class="flex-avatar w-32 " role="button" id="dropdownSignin" data-bs-toggle="dropdown"
        aria-expanded="false">
        <?php echo get_avatar($current_user->data->ID, 32, '', '', array('class' => '')); ?>
    </a>
    <?php $redirect_url = !isset($GLOBALS['NC-UC-PAGE']) ? home_url(add_query_arg(array(), $wp->request)) : home_url() ?>
    <?php if (!defined('NC_APOLLO_DIR')) : ?>
    <div class="dropdown-menu dropdown-signin card" aria-labelledby="dropdownSignin">
        <div class="signin-user-meta d-flex flex-fill align-items-center p-4">
            <div class="flex-avatar w-32 me-3">
                <?php echo get_avatar($current_user->ID, 32) ?>
            </div>
            <div class="flex-fill h5">
                <?php the_author_meta('display_name', $current_user->ID) ?>
            </div>
            <a href="<?php echo wp_logout_url($redirect_url); ?>"><i class="text-md text-muted iconfont icon-export"></i></a>
        </div>
        <div class="signin-user-action row gx-0 text-xs text-center py-4">
            <div class="col">
                <a href="<?php echo admin_url('edit.php') ?>" class="d-block text-secondary">
                    <div class="btn btn-secondary btn-icon btn-md btn-rounded"><span><i class="iconfont icon-container-fill"></i></span></div>
                    <div class="mt-2"><?php _e('My Posts', 'pandapro') ?></div>
                </a>
            </div>
            <div class="col">
                <a href="<?php echo get_edit_profile_url(); ?>" class="d-block text-secondary">
                    <div class="btn btn-secondary btn-icon btn-md btn-rounded"><span><i class="iconfont icon-message-fill"></i></span></div>
                    <div class="mt-2"><?php _e('My Comments', 'pandapro') ?></div>
                </a>
            </div>
            <div class="col">
                <a href="<?php echo get_edit_profile_url(); ?>" class="d-block text-secondary">
                    <div class="btn btn-secondary btn-icon btn-md btn-rounded"><span><i class="iconfont icon-setting-fill"></i></span></div>
                    <div class="mt-2"><?php _e('Profile', 'pandapro') ?></div>
                </a>
            </div>
        </div>
    </div>
    <?php else : ?>
    <div class="dropdown-menu dropdown-signin card" aria-labelledby="dropdownSignin">
        <div class="signin-user-meta d-flex flex-fill align-items-center p-4">
            <div class="flex-avatar w-36 me-3">
                <?php echo get_avatar($current_user->ID, 36) ?>
            </div>
            <div class="flex-fill h5">
                <?php the_author_meta('display_name', $current_user->ID) ?>
            </div>
            <a href="<?php echo wp_logout_url( get_permalink() ); ?>"><i class="text-md text-muted iconfont icon-export"></i></a>
        </div>
        <div class="signin-user-action row gx-0 text-xs text-center py-4">
            <div class="col">
                <a href="<?php echo $apollo_member_url; ?>" class="d-block text-secondary">
                    <div class="btn btn-secondary btn-icon btn-md btn-rounded"><span><i class="iconfont icon-container-fill"></i></span></div>
                    <div class="mt-2"><?php _e('My Posts', 'pandapro') ?></div>
                </a>
            </div>
            <div class="col">
                <a href="<?php echo $apollo_member_url; ?>/user/comments" class="d-block text-secondary">
                    <div class="btn btn-secondary btn-icon btn-md btn-rounded"><span><i class="iconfont icon-message-fill"></i></span></div>
                    <div class="mt-2"><?php _e('My Comments', 'pandapro') ?></div>
                </a>
            </div>
            <div class="col">
                <a href="<?php echo $apollo_member_url; ?>/user/profile" class="d-block text-secondary">
                    <div class="btn btn-secondary btn-icon btn-md btn-rounded"><span><i class="iconfont icon-setting-fill"></i></span></div>
                    <div class="mt-2"><?php _e('Profile', 'pandapro') ?></div>
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</li>
<?php else : ?>
    <?php if (defined('NC_APOLLO_DIR') && $open_apollo_login) : ?>
    <div class="nav-item ms-md-3 me-2">
        <a class="btn btn-outline-primary btn-sm btn-rounded"
            href="<?php echo $apollo_auth_url . '/user/register' ?>"><?php _e('Register', 'pandapro') ?></a>
    </div>
    <div class="nav-item">
        <a class="btn btn-primary btn-sm btn-rounded"
            href="<?php echo $apollo_auth_url . '/user/login' ?>"><?php _e('Sign in', 'pandapro') ?></a>
    </div>
    <?php elseif ($open_login) : ?>
        <?php if (get_option('users_can_register')) : ?>
        <div class="nav-item ms-md-3 me-2">
            <a class="btn btn-outline-primary btn-sm btn-rounded"
                href="<?php echo wp_registration_url(); ?>"><?php _e('Register', 'pandapro') ?></a>
        </div>
        <div class="nav-item">
            <a class="btn btn-primary btn-sm btn-rounded"
                href="<?php echo wp_login_url() ?>"><?php _e('Sign in', 'pandapro') ?></a>
        </div>
        <?php else: ?>
        <div class="nav-item ms-md-3 me-2">
            <a class="btn btn-primary btn-sm btn-rounded"
                href="<?php echo wp_login_url() ?>"><?php _e('Sign in', 'pandapro') ?></a>
        </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>