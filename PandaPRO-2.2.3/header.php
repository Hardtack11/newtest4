<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until

 *
 * @package Panda PRO
 */
$current_user = wp_get_current_user();
$panda_option = get_option('panda_option');
$dark_mode = pandapro_get_dark_mode_status();
$fonts = $panda_option['cn_font'] ?? false;
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <?php if (defined('NC_APOLLO_DIR')) : ?>
    <meta name="apollo-enabled" content="1" />
    <?php endif; ?>
    <?php wp_head(); ?>
    <?php if ($fonts == 'oppo_font') : ?>
    <style>
    @font-face {
        font-family: OPPOSans-Regular;
        src: url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/OPPOSans-Regular.eot);
        src: url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/OPPOSans-Regular.eot) format("embedded-opentype"),
        url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/OPPOSans-Regular.woff2) format("woff2"),
        url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/OPPOSans-Regular.woff) format("woff"),
        url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/OPPOSans-Regular.ttf) format("truetype");
        font-style: normal;
        font-weight: 200
    }

    body {
        font-family: OPPOSans-Regular, 'pingfang SC', 'helvetica neue', arial, 'hiragino sans gb', 'microsoft yahei ui', 'microsoft yahei', simsun, sans-serif;
    }
    </style>
    <?php elseif ($fonts == 'HarmonyOS_font') : ?>
    <style>
    @font-face {
        font-family: 'HarmonyOS Sans';
        src: url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/HarmonyOS_Sans.eot);
        src: url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/HarmonyOS_Sans.eot) format("embedded-opentype"),
        url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/HarmonyOS_Sans.woff2) format("woff2"),
        url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/HarmonyOS_Sans.woff) format("woff"),
        url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/HarmonyOS_Sans.ttf) format("truetype");
        font-style: normal;
    }

    body {
        font-family: 'HarmonyOS Sans', 'pingfang SC', 'helvetica neue', arial, 'hiragino sans gb', 'microsoft yahei ui', 'microsoft yahei', simsun, sans-serif;
    }
    </style>
    <?php endif; ?>
    <?php $EnFont = $panda_option['en_font'] ?? false ?>
    <?php if ($EnFont) : ?>
    <style>
    @font-face {
        font-family: 'Akrobat-Regular';
        src: url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/Akrobat-Regular.eot);
        src: url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/Akrobat-Regular.eot) format("embedded-opentype"),
        url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/Akrobat-Regular.woff2) format("woff2"),
        url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/Akrobat-Regular.woff) format("woff"),
        url(<?php echo get_stylesheet_directory_uri();
        ?>/fonts/Akrobat-Regular.ttf) format("truetype");
        font-style: normal;
    }

    .font-theme {
        font-family: 'Akrobat-Regular', arial, sans-serif
    }
    </style>
    <?php endif; ?>
    <script>
    window.$ = jQuery;
    </script>
</head>

<body <?php body_class($dark_mode ? 'nice-dark-mode' : ''); ?>>
    <header class="header">
        <nav class="navbar navbar-expand-xl shadow">
            <div class="container">
                <!-- / brand -->
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="logo navbar-brand order-2 order-xl-1">
                    <img src="<?php echo pandapro_get_logo() ?>"
                        class="<?php echo $dark_mode ? 'd-none' : 'd-inline-block' ?> logo-light nc-no-lazy"
                        alt="<?php bloginfo('name'); ?>">
                    <img src="<?php echo pandapro_get_logo('dark') ?>"
                        class="<?php echo $dark_mode ? 'd-inline-block' : 'd-none' ?> logo-dark nc-no-lazy"
                        alt="<?php bloginfo('name'); ?>">
                </a>
                <button class="btn btn-link btn-icon btn-sm btn-rounded navbar-toggler order-1" type="button"
                    id="sidebarCollapse">
                    <span><i class="iconfont icon-menu"></i></span>
                </button>
                <button class="btn btn-link btn-icon btn-sm btn-rounded navbar-toggler nav-search order-3 collapsed"
                    data-bs-target="#navbar-search" data-bs-toggle="collapse" aria-expanded="false"
                    aria-controls="navbar-search">
                    <span>
                        <i class="iconfont icon-search"></i>
                        <i class="iconfont icon-close"></i>
                    </span>
                </button>
                <!-- brand -->
                <div class="collapse navbar-collapse order-xl-2">
                    <ul class="navbar-nav main-menu ms-4 me-auto">
                        <?php
                        if (function_exists('wp_nav_menu') && has_nav_menu('header-menu')) {
                            wp_nav_menu(array('container' => false, 'items_wrap' => '%3$s', 'theme_location' => 'header-menu'));
                        } else {
                            _e('<li><a href="/wp-admin/nav-menus.php">Please set up your first menu at [Admin -> Appearance -> Menus]</a></li>', 'pandapro');
                        }
                        ?>
                    </ul>
                    <ul class="navbar-nav align-items-center">
                        <?php if ($panda_option['dark_mode'] && $panda_option['dark_mode_detail']['frontend']) : ?>
                        <li class="nav-item me-2 me-md-3">
                            <a href="javascript:" class="btn btn-link btn-icon btn-sm btn-rounded switch-dark-mode">
                                <span class="icon-light-mode"><i class="iconfont icon-bulb"></i></span>
                                <span class="icon-dark-mode"><i class="text-warning iconfont icon-bulb-fill"></i></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item me-2 me-md-3">
                            <button class="btn btn-link btn-icon btn-sm btn-rounded nav-search collapsed"
                                data-bs-toggle="collapse" data-bs-target="#navbar-search" aria-expanded="false"
                                aria-controls="navbar-search">
                                <span>
                                    <i class="iconfont icon-search"></i>
                                    <i class="iconfont icon-close"></i>
                                </span>
                            </button>
                        </li>
                        <?php get_template_part('template-parts/header-user') ?>
                    </ul>
                </div>
            </div>
        </nav>
        <?php get_template_part('template-parts/mobile-sidebar') ?>
        <div class="navbar-search collapse " id="navbar-search">
            <div class="container">
                <form method="get" role="search" id="searchform" action="<?php echo home_url('/') ?>">
                    <div class="search-form">
                        <input type="text" class="search-input form-control form-control-lg" name="s" id="s"
                            placeholder="<?php _e('Type anything to search...', 'pandapro') ?>">
                        <i class="search-toggle iconfont icon-search"></i>
                    </div>
                </form>
            </div>
        </div>
    </header>