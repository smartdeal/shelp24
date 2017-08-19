<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="ru-RU">
<!--<![endif]-->

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo get_template_directory_uri(); ?>/favicon.png" rel="shortcut icon" type="image/png">
    <?php wp_head(); ?> 
</head>

<body id="to-top" <?php body_class(); ?>>
    <?php the_field('option_code_top','option'); ?>
    <div class="preloader"></div>
    <div class="layout-main">
        <span class="hidden" id="url"><?php // echo get_template_directory_uri(); ?></span>
        <div class="header-mobile">
            <div class="container">
                <div class="header-mobile__inner">
                    <?php if ($main_logo = get_field('option_logo','option')): ?>
                        <?php if (!is_front_page()) { ?><a href="<?php echo home_url(); ?>"><?php } ?>
                            <img class="header-mobile__item b-logo b-logo_header" src="<?php echo $main_logo['sizes']['medium']; ?>" alt="logo">
                        <?php if (!is_front_page()) { ?></a><?php } ?>
                    <?php endif; ?>
                    <?php if ($main_tel = get_field('option_tel','option')): ?>
                        <a href="tel:<?php echo preg_replace("/[^0-9]/","",$main_tel); ?>" class="header-mobile__item b-tel b-tel_header"><?php echo $main_tel; ?></a>
                    <?php endif; ?>
                    <?php if ($main_email = get_field('option_email','option')): ?>
                        <a href="mailto:<?php echo $main_email; ?>" class="header-mobile__item b-email b-email_header"><?php echo $main_email; ?></a>
                    <?php endif; ?>
                    <a href="#form-get-offer" class="header-mobile__item b-get-offer">Запросить предложение</a>
                    <div class="menu-btn navbar-toggle" data-toggle="collapse" data-target="#menu-collapse"><span></span><span></span><span></span></div>
                    <nav class="navbar navbar_seohelp" role="navigation">
                    <!--noindex-->
                        <?php
                            wp_nav_menu( array(
                                'theme_location'    => 'primary',
                                'depth'             => 2,
                                'container'         => 'div',
                                'container_class'   => 'collapse navbar-collapse',
                                'container_id'      => 'menu-collapse',
                                'menu_class'        => 'nav navbar-nav',
                                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                'walker'            => new wp_bootstrap_navwalker())
                            );
                        ?>
                    <!--/noindex-->
                    </nav>
                </div>
            </div>
        </div>

        <?php get_sidebar(); ?>

        <div class="content">
