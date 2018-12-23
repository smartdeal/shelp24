<?php 
/*
Template Name: Услуга (SEO)
Template Post Type: page
*/
?>

<?php get_header(); ?>
<div class="pink-bg_seo">
    <div class="content__inner <?php if ($is_post_with_meta) echo 'content__inner_with-meta'; ?>" itemscope itemtype="http://schema.org/Article">
            <div class="container-fluid">
    <div class="content__title" itemprop="headline">
                            <h1><?php the_title(); ?></h1>
                        </div>
                        <div class="service2_text"><?php the_field('service2_text'); ?>
                          
                            <div class="no-desk"> <div class="service2_spec"><b>Елизавета Вербенко</b> - Ведущий SEO оптимизатор</div></div>
                            SeoHelp24 - сертифицированный партнер <span style="font-weight: 600; font-size: 20px;">Yandex и Google</span>
                        </div>
                        <div class="service2-form-and-name">
                        <div class="service2_form"><?php echo do_shortcode('[contact-form-7 id="8499" title="Форма в услугах (new)"]'); ?></div>
                       <div class="no-mob"> <div class="service2_spec"><b>Елизавета Вербенко</b><br>Ведущий SEO оптимизатор</div></div></div>
                        <div class="service2_numbers">
                            <div class="service2_num"><span class="num-num">+500</span><span class="text-text">завершенных<br>проектов</span></div>
                            <div class="service2_num"><span class="num-num">20</span><span class="text-text">место в рейтинге<br>рунета 2017</span></div>
                            <div class="service2_num"><span class="num-num">+30</span><span class="text-text">благодарственных<br>писем</span></div>
                        </div>
                        
</div></div></div>


 <div class="content__inner <?php if ($is_post_with_meta) echo 'content__inner_with-meta'; ?>" itemscope itemtype="http://schema.org/Article">
            <div class="container-fluid">
<div class="service2_cases">
	<h2>Кейсы по продвижению интернет-магазинов</h2>
	<div class="case1_0"><div class="case1">
		<?php $image = get_field('case_logo');
              if( !empty($image) ): ?>
                  <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
        <?php endif; ?>
        <div class="case_desc"><?php the_field('case_desc'); ?>
       <?php the_field('case_href'); ?></div>
	</div></div>
	<div class="case2">
		<span class="case2_1">
		<span class="case2_h">Период:</span>
		<?php the_field('case_period'); ?></span>
		<span class="case2_2">
		<span class="case2_h">Рост посетителей сайта:</span>
		<?php the_field('case_rost1'); ?></span>
		<span class="case2_2"><span class="case2_h">Рост колличества заявок:</span>
		<?php the_field('case_rost2'); ?></span>
		<span class="case2_1"><span class="case2_h">Потенциальный доход:</span>
		<?php the_field('case_dohod'); ?></span>

	</div>
	<div class="case3">
		<?php $image = get_field('case_grafik');
              if( !empty($image) ): ?>
                  <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
        <?php endif; ?>
        <div class="case_all"><a href="/kejsy-po-prodvizheniyu/">Смотреть все кейсы</a></div>
	</div>

</div></div></div>












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
