<?php get_header(); ?>

<?php  
    if (is_post_type_archive( array('uslugi') )) $is_post_with_meta = true;
        else $is_post_with_meta = false;
?>
    <div class="container-fluid">
        <div class="content__inner content__inner_archive">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if(function_exists('bcn_display')) {bcn_display(); }?>
            </div>
            <div class="content__title">
                <h1><?php the_archive_title(); ?></h1>
            </div>    
            <div class="content__body">
                <div class="content__list">
                    <?php if (have_posts()) { ?>
                        <?php while (have_posts()) { the_post(); 
                            $post_title = get_the_title(); 
                            $post_link = get_the_permalink();
                            $is_have_img_class = '';
                        ?>
                            <div class="b-arch-content<?php if (has_post_thumbnail()) echo ' b-arch-content_with-img'?>" itemscope itemtype="http://schema.org/Article">
                                <div class="b-arch-content__inner">
                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="b-arch-content__img-wrap">
                                            <a href="<?php echo $post_link; ?>" title="Перейти на страницу <?php echo $post_title; ?>">
                                                <img data-aload="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(),'medium'); ?>" alt="">
                                            </a>
                                        </div>
                                    <?php else: $is_have_img_class = ' b-arch-content__desc_without-img'; ?>
                                    <?php endif; ?>
                                    <div class="b-arch-content__desc<?php echo  $is_have_img_class; ?>">
                                        <div class="b-arch-content__caption" itemprop="headline">
                                            <a href="<?php echo $post_link; ?>" title="Перейти на страницу <?php echo $post_title; ?>"><?php echo $post_title; ?></a>
                                        </div>
                                        <?php if ($is_post_with_meta): ?>
                                            <?php $arrTags = wp_get_object_terms($post->ID, 'post_tag'); ?>
                                            <div class="b-arch-content__meta">
                                                <div class="b-meta">
                                                    <?php if ($arrTags): ?>
                                                        <div class="b-meta__item b-meta__tags">
                                                            <span class="b-meta__icon b-meta__icon_flag"></span>
                                                            <?php $is_first = true; ?>
                                                            <?php foreach ($arrTags as $tag) { ?>
                                                                <?php if (!$is_first) echo '<span>, </span>'; else $is_first = false; ?>
                                                                <span class="b-meta__link"><?php echo $tag->name; ?></span>
                                                                <?php // <a href="<php echo get_term_link($tag->term_id); >" class="b-meta__link"><php echo $tag->name; ></a> ?>
                                                            <?php } ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="b-meta__item b-meta__share">
                                                        <img class="b-meta__icon" src="<?php echo get_template_directory_uri().'/img/icon-share.png'; ?>" alt="">
                                                        <a href="#" class="b-meta__link b-meta__link_share">Поделиться</a>
                                                        <?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
                                                    </div>
                                                </div>                                        
                                            </div>
                                        <?php endif; ?>
                                        <div class="b-arch-content__txt" itemprop="articleBody">
                                            <?php 
                                                if (!$is_post_with_meta) the_excerpt();
                                                    else echo wp_trim_words(get_the_excerpt(), 20);
                                            ?>
                                            <div class="b-arch-content__btn-wrap">
                                                <?php if ($is_post_with_meta): ?>
                                                    <a href="#" class="b-arch-content__btn b-arch-content__btn_order btn btn_reverse js-arch-content__btn_order" title="Открыть форму">Оставить заявку</a>
                                                <?php endif; ?>
                                                <a href="<?php echo $post_link; ?>" class="b-arch-content__btn btn btn_more" title="Перейти на страницу <?php echo $post_title; ?>">
                                                    <?php if ($is_post_with_meta) echo 'Подробнее'; else echo 'Читать далее'; ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php $pagi = paginate_links(array('prev_text' => '', 'next_text' => '')); ?>
                    <?php if ($pagi): ?>
                        <div class="pagi"><?php echo $pagi; ?></div>
                    <?php endif; ?>
                <?php } ?>
            </div>
            <?php if (is_post_type_archive( array('uslugi') )): ?>
                <div class="hidden">
                    <div class="form_addservice-archive"><?php echo do_shortcode('[get_content_form]' ); ?></div>
                </div>       
            <?php endif; ?>
        </div>
    </div>

<?php get_footer(); ?>
