<?php 
/*
Template Name: Услуги
Template Post Type: page
*/
?>

<?php get_header(); ?>

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
                    the_service_menu();
                    while (have_posts()) { the_post();
                        $post_title = get_the_title();
                        $post_link = get_the_permalink();
                    ?>
                        <div class="content__title" itemprop="headline">
                            <h1><?php the_title(); ?></h1>
                            <?php if ($is_post_with_meta): ?>
                                <?php $arrTags = wp_get_object_terms($post->ID, 'post_tag'); ?>
                                <div class="b-meta">
                                    <?php if ($arrTags): ?>
                                        <div class="b-meta__item b-meta__tags">
                                            <span class="b-meta__icon b-meta__icon_flag"></span>
                                            <?php $is_first = true; ?>
                                            <?php foreach ($arrTags as $tag) { ?>
                                                <?php if (!$is_first) echo '<span>, </span>'; else $is_first = false; ?>
                                                <a href="<?php echo get_term_link($tag->term_id); ?>" class="b-meta__link"><?php echo $tag->name; ?></a>
                                            <?php } ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (is_singular( array('stati') )): ?>
                                        <div class="b-meta__item b-meta__comments">
                                            <img class="b-meta__icon" src="<?php echo get_template_directory_uri().'/img/icon-comments.png'; ?>" alt="">
                                            <a href="#" class="b-meta__link">2</a>
                                        </div>
                                        <div class="b-meta__item b-meta__likes">
                                            <img class="b-meta__icon" src="<?php echo get_template_directory_uri().'/img/icon-likes.png'; ?>" alt="">
                                            <a href="#" class="b-meta__link">2</a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="b-meta__item b-meta__share">
                                        <img class="b-meta__icon" src="<?php echo get_template_directory_uri().'/img/icon-share.png'; ?>" alt="">
                                        <a href="#" class="b-meta__link">Поделиться</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>    
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
                    <?php }} ?>
            </div>
        </div>
        <?php get_template_part( 'inc/tpl-slider-clients-logo' ); ?>

<?php get_footer(); ?>
