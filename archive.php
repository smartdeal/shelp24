<?php get_header(); ?>

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
                        ?>
                            <div class="b-arch-content<?php if (has_post_thumbnail()) echo ' b-arch-content_with-img'?>" itemscope itemtype="http://schema.org/Article">
                                <div class="b-arch-content__inner">
                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="b-arch-content__img-wrap">
                                            <a href="<?php echo $post_link; ?>" title="Перейти на страницу <?php echo $post_title; ?>">
                                                <img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(),'large'); ?>" alt="">
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="b-arch-content__desc">
                                        <div class="b-arch-content__caption" itemprop="headline">
                                            <a href="<?php echo $post_link; ?>" title="Перейти на страницу <?php echo $post_title; ?>"><?php echo $post_title; ?></a>
                                        </div>
                                        <div class="b-arch-content__txt" itemprop="articleBody">
                                            <?php 
                                                if (is_single()) the_content();
                                                    else the_excerpt();
                                            ?>
                                            <div class="b-arch-content__btn-wrap"><a href="<?php echo $post_link; ?>" class="b-arch-content__btn btn btn_more" title="Перейти на страницу <?php echo $post_title; ?>">Читать далее</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php $pagi = paginate_links(array('prev_text' => '', 'next_text' => '')); ?>
                    <?php if ($page): ?>
                        <div class="pagi"><?php echo $pagi; ?></div>
                    <?php endif; ?>
                <?php } ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
