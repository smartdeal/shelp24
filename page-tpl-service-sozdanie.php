<?php 
/*
Template Name: Услуга (Создание сайтов)
Template Post Type: page
*/
?>

<?php get_header(); ?>
<div class="pink-bg_seo pink-bg_sozdanie">
    <div class="content__inner <?php if ($is_post_with_meta) echo 'content__inner_with-meta'; ?>" itemscope itemtype="http://schema.org/Article">
            <div class="container-fluid">
    <div class="content__title" itemprop="headline">
                            <h1><?php the_title(); ?></h1>
                        </div>
                        <div class="service2_text"><?php the_field('service2_text'); ?>
                          
                            <div class="no-desk"> <div class="service2_spec"><b>Галина Нигматуллина</b> - Технический директор</div></div>
                            SeoHelp24 - сертифицированный партнер <span style="font-weight: 600; font-size: 20px;">Yandex и Google</span>
                        </div>
                        <div class="service2-form-and-name">
                        <div class="service2_form"><?php echo do_shortcode('[contact-form-7 id="8499" title="Форма в услугах (new)"]'); ?></div>
                       <div class="no-mob"> <div class="service2_spec"><b>Галина Нигматуллина</b><br>Технический директор</div></div></div>
                        <div class="service2_numbers">
                            <div class="service2_num"><span class="num-num">+500</span><span class="text-text">завершенных<br>проектов</span></div>
                            <div class="service2_num"><span class="num-num">20</span><span class="text-text">место в рейтинге<br>рунета 2017</span></div>
                            <div class="service2_num"><span class="num-num">+30</span><span class="text-text">благодарственных<br>писем</span></div>
                        </div>
                        
</div></div></div>


 <div class="content__inner <?php if ($is_post_with_meta) echo 'content__inner_with-meta'; ?>" itemscope itemtype="http://schema.org/Article">
            <div class="container-fluid">
<div class="service-icons">
	<h2>Включено в разработку</h2>
	<div class="service-icon"><img src=/img/service-icon1.png><p>Функция обратного звонка</p></div>
	<div class="service-icon"><img src=/img/service-icon2.png><p>Интерактивная карта</p></div>
	<div class="service-icon"><img src=/img/service-icon3.png><p>Корпоративная почта</p></div>
	<div class="service-icon"><img src=/img/service-icon4.png><p>Удобная система управления</p></div>
	<div class="service-icon"><img src=/img/service-icon5.png><p>SSL сертификат безопасности</p></p></div>
	<div class="service-icon"><img src=/img/service-icon6.png><p>Уникальный дизайн</p></div>
	<div class="service-icon"><img src=/img/service-icon7.png><p>Адаптивная верстка</p></div>
	<div class="service-icon"><img src=/img/service-icon8.png><p>Базовая SEO оптимизация</p></div>


</div>


</div></div>












<?php  
    if (is_singular( array('stati','uslugi') )) $is_post_with_meta = true;
        else $is_post_with_meta = false;
?>

        <div class="content__inner <?php if ($is_post_with_meta) echo 'content__inner_with-meta'; ?>" itemscope itemtype="http://schema.org/Article">
            <div class="container-fluid">
                <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                    <?php if(function_exists('bcn_display')) {bcn_display(); }?>
                </div>
                <?php if (have_posts()) { 
                    // the_service_menu();
                    while (have_posts()) { the_post();
                        $post_title = get_the_title();
                        $post_link = get_the_permalink();
                    ?>
                            
                        <div class="content__body">
                            <div class="content__list">
                                <div class="b-content<?php if (has_post_thumbnail()) echo ' b-content_with-img'?>">
                                    <div class="b-content__inner cf">
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="b-content__img-wrap">
                                                <?php if (is_archive()): ?>
                                                    <a href="<?php echo $post_link; ?>" title="Перейти на страницу <?php echo $post_title; ?>">
                                                <?php endif; ?>
                                                        <img data-aload="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(),'large'); ?>" alt="">
                                                <?php if (is_archive()): ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="b-content__desc">
                                            <div class="b-content__txt article" itemprop="articleBody">
                                                <?php 
                                                    if (!is_archive()) the_content();
                                                        else the_excerpt();
                                                ?>
                                                <?php if (is_archive()): ?>
                                                    <div class="b-content__btn-wrap"><a href="<?php echo $post_link; ?>" class="b-content__btn" title="Перейти на страницу <?php echo $post_title; ?>">Читать далее</a></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php the_seo_schema_article() ?>
                    <?php }} ?>
            </div>
        </div>
        <?php get_template_part( 'inc/tpl-slider-clients-logo' ); ?>

<?php get_footer(); ?>
