<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <?php /*
    <script>
        document.addEventListener("DOMContentLoaded", ready);
        function ready() {
            setTimeout(function() {
                preloader = document.querySelector('.preloader');
                preloader.parentNode.removeChild(preloader);
                document.querySelector('.layout-main').style.opacity = 1;
            }, 2000);        
        }
    </script>    
    */ ?>
    <?php wp_head(); ?> 
</head>

<body id="to-top" <?php body_class(); ?>>
    <div class="test-div"></div>
    <?php the_field('option_code_top','option'); ?>
    <?php /*
    <div class="preloader"></div>
    */ ?>
    <div class="layout-main">
        <span class="hidden" id="url"><?php // echo get_template_directory_uri(); ?></span>
        <div class="header-mobile">
            <div class="container">
                <div class="header-mobile__inner">
                    <div class="header-mobile__top">
                        <?php $main_tel = get_field('option_tel','option'); ?>
                        <button class="menu-btn navbar-toggle" data-toggle="collapse" data-target="#menu-collapse"><span></span><span></span><span></span></button>
                        <div class="menu-mob">
                            <nav class="navbar navbar_seohelp" role="navigation">
                            <!--noindex-->
                            <div id="menu-collapse" class="collapse navbar-collapse">
                                <ul class="nav navbar-nav">
                                  <?php wp_nav_menu( array('theme_location' => 'primary',     'container' => false, 'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 'walker' => new wp_bootstrap_navwalker(), 'items_wrap' => '%3$s' ) ); ?>
                                  <?php wp_nav_menu( array('theme_location' => 'secondary',   'container' => false, 'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 'walker' => new wp_bootstrap_navwalker(), 'items_wrap' => '%3$s' ) ); ?>
                                </ul>
                            </div>
                            <!--/noindex-->
                            </nav>
                        </div>
                        <?php if ($main_logo = get_field('option_logo','option')): ?>
                            <?php if (!is_front_page()) { ?><a href="<?php echo home_url(); ?>"><?php } ?>
                                <img class="header-mobile__logo b-logo b-logo_header" src="<?php echo $main_logo['sizes']['medium']; ?>" alt="logo">
                            <?php if (!is_front_page()) { ?></a><?php } ?>
                        <?php endif; ?>
                        <a href="tel:<?php echo preg_replace("/[^0-9+]/","",$main_tel); ?>" class="header-mobile__call-btn">&nbsp;</a>
                    </div>

                    <?php 
                        $top_slogan = get_field('option_slogan', 'option');
                        if ($top_slogan):
                    ?>

                        <div class="header-mobile__slogan"><?php echo $top_slogan; ?></div>

                    <?php endif; ?>

                    <div class="header-mobile__bottom">
                        <a href="tel:<?php echo preg_replace("/[^0-9+]/","",$main_tel); ?>" class="header-mobile__item b-tel b-tel_header"><?php echo $main_tel; ?></a>
                        <?php if ($main_email = get_field('option_email','option')): ?>
                            <a href="mailto:<?php echo $main_email; ?>" class="header-mobile__item b-email b-email_header"><?php echo $main_email; ?></a>
                        <?php endif; ?>
                        <a href="#form-get-offer" class="header-mobile__item b-get-offer fancybox">Запросить предложение</a>
                    </div>
                </div>
            </div>
        </div>

        <?php get_sidebar(); ?>

        <div id="js-content" class="content">
