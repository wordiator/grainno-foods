<?php defined('ABSPATH') || exit; ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site hfeed">
<header id="masthead" class="site-header" role="banner">
    <div class="col-full">
        <p class="site-title">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <?php bloginfo('name'); ?><span>.</span>
            </a>
        </p>
    </div>
</header>
<div id="content" class="site-content"><div class="col-full">
