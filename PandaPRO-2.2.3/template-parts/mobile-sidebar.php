<?php 
    $panda_option = get_option('panda_option'); 
    $open_login = $panda_option['open_login'] ?? false ;
?>
<div class="mobile-sidebar">
    <div class="mobile-sidebar-inner">
        <?php if (defined('NC_APOLLO_DIR') || $open_login ): ?>
            <?php
                $current_user = wp_get_current_user();
                if (defined('NC_APOLLO_DIR')) {
                    $apollo_pages = get_field('apollo_pages', 'options');
                    $apollo_member_url = get_page_link($apollo_pages['user_member_page'] ?? 0);
                    $apollo_auth_url = get_page_link($apollo_pages['user_member_login_page'] ?? 0); 
                }
            ?>
            <?php if (is_user_logged_in()): ?>
            <?php $redirect_url = !isset($GLOBALS['NC-UC-PAGE']) ? home_url(add_query_arg(array(), $wp->request)) : home_url() ?>
            <div class="mobile-sidebar-header canreg">
                <div class="mobile-sidebar-author-cover">
                    <div class="media media-2x1">
                        <div class="media-content" style="background-image:url('<?php pandapro_the_author_cover($current_user->ID, array('w' => 750, 'h' => 375)) ?>')"></div>
                        <div class="media-overlay overlay-top align-items-center p-2">
                            <a href="<?php echo wp_logout_url($redirect_url) ?>" class="btn btn-text btn-icon text-white" ><span><i class="iconfont icon-export"></i></span></a>
                            <div class="flex-fill"></div>
                            <?php if ($panda_option['dark_mode'] && $panda_option['dark_mode_detail']['frontend']): ?>
                                <button type="button" class="btn btn-text btn-icon switch-dark-mode">
                                    <span class="icon-light-mode"><i class="iconfont icon-night-circle-fill"></i></span>
                                    <span class="icon-dark-mode"><i class="text-warning iconfont icon-night-circle-fill"></i></span>
                                </button>
                            <?php endif; ?>
                                <button type="button" class="btn btn-text btn-icon text-white sidebar-close"><span><i class="iconfont icon-close-circle-fill"></i></span></button>
                        </div>
                    </div>
                </div>
                <div class="mobile-sidebar-author-body">
                    <div class="mobile-sidebar-author-avatar">
                        <a href="<?php echo !defined('NC_APOLLO_DIR') ? get_edit_profile_url() : $apollo_member_url.'/user/profile' ?>" target="_blank" class="flex-avatar w-64 border border-2 border-white" >
                            <?php echo get_avatar( $current_user->ID, 64, '', '' ); ?>
                        </a>
                    </div>
                    <div class="mobile-sidebar-author-meta">
                        <div class="h6 d-flex align-items-center flex-fill justify-content-center mb-3">
                            <a href="<?php echo !defined('NC_APOLLO_DIR') ? get_edit_profile_url() : $apollo_member_url.'/user/profile' ?>">
                                <?php echo get_userdata($current_user->ID)->display_name ?>
                            </a>
                            <div class="author-insignia ms-1" tooltip="<?php pandapro_the_author_role_name($current_user->ID) ?>" flow="up"></div>
                        </div>
                        <div class="row g-0 text-center">
                            <a href="<?php echo !defined('NC_APOLLO_DIR') ? get_author_posts_url($current_user->ID) : $apollo_member_url.'/user/posts'  ?>" class="col">
                                <div class="font-theme h5"><?php echo count_user_posts($current_user->ID) ?></div>
                                <div class="text-xs text-muted"><?php _e('Posts', 'pandapro') ?></div>
                            </a>
                            <a href="<?php echo !defined('NC_APOLLO_DIR') ? get_author_posts_url($current_user->ID) : $apollo_member_url.'/user/comments' ?>" class="col">
                                <div class="font-theme h5"><?php pandapro_the_author_comment_count($current_user->ID); ?></div>
                                <div class="text-xs text-muted"><?php _e('Comments', 'pandapro') ?></div>
                            </a>
                            <a href="<?php echo get_author_posts_url($current_user->ID) ?>" class="col">
                                <div class="font-theme h5"><?php pandapro_the_author_like_count($current_user->ID); ?></div>
                                <div class="text-xs text-muted"><?php _e('Likes', 'pandapro') ?></div>
                            </a>
                            <?php if(defined('NC_APOLLO_DIR')):?>
                            <div class="col">
                                <div class="font-theme h5 points"><?php echo get_user_points($current_user->ID); ?></div>
                                <div class="text-xs text-muted"><?php _e('Credit', 'apollo') ?></div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="mobile-sidebar-author-action">
                        <div class="row g-0 text-center">
                            <a href="<?php echo !defined('NC_APOLLO_DIR') ? admin_url('post-new.php') : $apollo_member_url.'/user/tougao' ?>" class="col">
                                <div>
                                    <i class="text-xl iconfont icon-edit-square"></i>
                                </div>
                                <div class="text-xs text-muted"><?php _e('New Post', 'pandapro') ?></div>
                            </a>
                            <a href="<?php echo !defined('NC_APOLLO_DIR') ? admin_url('edit.php') : $apollo_member_url.'/user/posts' ?>" class="col">
                                <div>
                                    <i class="text-xl iconfont icon-detail"></i>
                                </div>
                                <div class="text-xs text-muted"><?php _e('Posts', 'pandapro') ?></div>
                            </a>
                            <a href="<?php echo !defined('NC_APOLLO_DIR') ? get_edit_profile_url() : $apollo_member_url.'/user/profile' ?>" class="col">
                                <div>
                                    <i class="text-xl iconfont icon-control"></i>
                                </div>
                                <div class="text-xs text-muted"><?php _e('Profile', 'pandapro') ?></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="mobile-sidebar-header canreg">
                <div class="mobile-sidebar-author-cover">
                    <div class="media media-2x1">
                        <div class="media-content" style="background-image:url('<?php pandapro_the_author_cover(0, array('w' => 750, 'h' => 375)) ?>')"></div>
                        <div class="media-overlay overlay-top p-2">
                            <div class="flex-fill"></div>
                        <?php if ($panda_option['dark_mode'] && $panda_option['dark_mode_detail']['frontend']): ?>
                            <button type="button" class="btn btn-text btn-icon switch-dark-mode">
                                <span class="icon-light-mode"><i class="iconfont icon-night-circle-fill "></i></span>
                                <span class="icon-dark-mode"><i class="text-warning iconfont icon-night-circle-fill "></i></span>
                            </button>
                        <?php endif; ?>
                            <button type="button" class="btn btn-text btn-icon text-white sidebar-close"><span><i class="iconfont icon-close-circle-fill"></i></span></button>
                        </div>
                    </div>
                </div>
                <div class="mobile-sidebar-author-body">
                    <div class="mobile-sidebar-author-meta py-4">
                        <a href="<?php echo defined('NC_APOLLO_DIR') ? $apollo_auth_url.'/user/login' : wp_login_url() ?>" class="btn btn-primary btn-sm btn-rounded">
                            <?php _e( 'Login now.', 'pandapro' ) ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php endif ?>
        <?php else: ?>
            <div class="mobile-sidebar-header text-end p-3">
                <?php if ($panda_option['dark_mode'] && $panda_option['dark_mode_detail']['frontend']): ?>               
                <button type="button" class="btn btn-text btn-icon btn-rounded switch-dark-mode me-2">
                    <span class="icon-light-mode">
                        <i class="text-xl iconfont icon-night-circle-fill "></i>
                    </span>
                    <span class="icon-dark-mode">
                        <i class="text-xl text-warning iconfont icon-night-circle-fill "></i>
                    </span>
                </button>
                <?php endif; ?>
                <button type="button" class="btn btn-text btn-icon btn-rounded sidebar-close">
                    <span><i class="text-xl iconfont icon-close-circle-fill"></i></span>
                </button>
            </div>
        <?php endif; ?>
        <div class="mobile-sidebar-menu">
            <ul class="mobile-menu-inner">
                <?php
                    if ( function_exists( 'wp_nav_menu' ) && has_nav_menu('mobile-menu') ) {
                        wp_nav_menu( array( 'container' => false, 'items_wrap' => '%3$s', 'theme_location' => 'mobile-menu' ) );
                    } else {
                        _e('<li><a href="/wp-admin/nav-menus.php">Please set up your first menu at [Admin -> Appearance -> Menus]</a></li>', 'pandapro');
                    }
                ?>
            </ul>
        </div>
        <div class="py-5"></div>
    </div>
</div>