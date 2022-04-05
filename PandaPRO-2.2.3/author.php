<?php

/**
 * The template for displaying archive pages
 *
 * @package Panda PRO
 */

global $wp_query;

$panda_option = get_option('panda_option');
$author = get_queried_object();

$query = $author->ID;
$tpage = 'author';

get_header();
?>
<div class="user-masthead">
    <div class="media media-5x1">
        <div class="media-content masthead-bg" style="background-image: url('<?php pandapro_the_author_cover($author->ID);?>');">
        </div>
    </div>
    <div class="masthead-inner bg-white">
        <div class="container">
            <div class="masthead-content">
                <div class="flex-avatar w-128 ">
                    <?php echo get_avatar( get_the_author_meta('ID'), 128, '', ''); ?>
                </div>
                <div class="masthead-body">
                    <div class="d-flex flex-fill align-items-center"><div class="h3"><?php echo $author->display_name ?></div><div class="author-insignia ms-2" tooltip="<?php echo pandapro_the_author_role_name($author->ID); ?>" flow="up"></div></div>
                    <div class="text-secondary mt-2"><?php echo $author->description ?></div>
                    <div class="masthead-meta d-flex align-items-center mt-3">
                        <div>
                            <b class="font-theme h5"><?php echo count_user_posts($author->ID) ?></b>
                            <i class="text-xs text-secondary"><?php _e('Posts', 'pandapro') ?></i>
                        </div>
                        <div>
                            <b class="font-theme h5"><?php pandapro_the_author_comment_count($author->ID) ?></b>
                            <i class="text-xs text-secondary"><?php _e('Comments', 'pandapro') ?></i>
                        </div>
                        <div>
                            <b class="font-theme h5"><?php pandapro_the_author_like_count($author->ID) ?></b>
                            <i class="text-xs text-secondary"><?php _e('Likes', 'pandapro') ?></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<main class="site-main">
    <div class="container">
        <div class="row">
            <div class="content-wrapper col-lg-8">
                <div class="list-ajax-menu author-content-menu mb-3">
                    <ul>
                        <li><button class="btn-ajaxpost btn btn-sm btn-light btn-rounded active"
                                data-cid="1"><?php _e('Posts', 'pandapro') ?><small
                                    class="ms-1">(<?php echo count_user_posts($author->ID) ?>)</small></button></li>
                        <li><button class="btn-ajaxpost btn btn-sm btn-light btn-rounded "
                                data-cid="2"><?php _e('Comments', 'pandapro') ?><small
                                    class="ms-1">(<?php pandapro_the_author_comment_count($author->ID) ?>)</small></button>
                        </li>
                    </ul>
                </div>
                <?php if (have_posts()) : ?>
                <div class="list-archive list-author-archive list-grid list-grid-padding">
                    <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part("template-parts/post-cards/card", get_post_format()); ?>
                    <?php endwhile; ?>
                </div>
                <?php
                    get_template_part_with_vars('template-parts/post-navigation', array(
                        'ajax_loading' => true,
                        'page' => $tpage,
                        'query' => $query,
                        'append' => 'list-archive'
                    ));
                    ?>
                <?php else : ?>
                <?php get_template_part('template-parts/svg/empty-svg'); ?>
                <?php endif; ?>
            </div>
            <div class="sidebar d-none d-lg-block col-lg-4">
                <?php
                    dynamic_sidebar('sidebar-author');
                ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();