<?php get_header(); ?>


<div class="content content_news content_with-slider">
    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
        <div class="container">
        <?php if(function_exists('bcn_display'))
        {
            bcn_display();
        }?>
        </div>
    </div>
    <div class="page__title">
        <div class="container">
            <h1><?php the_archive_title(); ?></h1>
        </div>
    </div>    
    <div class="page__content-wrap">
        <div class="container">
            <section class="page__content">
                <div class="content__list content__list_archive">
                <?php if (have_posts()) {while (have_posts()) { the_post(); ?>        
                    <div class="content__item" itemscope itemtype="http://schema.org/Article">
                        <?php if (has_post_thumbnail()) echo '<div class="content__img content__img_archive" style="background-image: url('. wp_get_attachment_image_url(get_post_thumbnail_id(),'large') .');"><a href="'.get_permalink().'"></a></div>'; ?>
                        <div class="content__txt">
                            <div class="content__desc content__desc_archive">
                                <div class="content__title" itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                <div class="content__date"><?php the_date('j F Y'); ?></div>
                                <div class="content__body" itemprop="articleBody"><?php the_excerpt(); ?></div>
                            </div>
                            <div class="content__btn-more"><a href="<?php the_permalink(); ?>" class="btn-more btn-more_articles">Смотреть подробно</a></div>
                        </div>
                    </div>
                <?php }} ?>
                </div>
                <div class="pagination">
                    <?php echo paginate_links(); ?>
                </div>
            </section>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>
