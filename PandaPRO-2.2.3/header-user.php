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
</head>

<body <?php body_class($dark_mode ? 'nice-dark-mode' : ''); ?>>