<?php get_header(); ?>

<div class="content">
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
            <h1><?php printf( __( 'Результаты поиска для: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        </div>
    </div>    
    <section class="page__content">
        <div class="container">
            <div class="content__list">
            <?php if (have_posts()) {while (have_posts()) { the_post(); ?>        
                <div class="content__item" itemscope itemtype="http://schema.org/Article">
                    <div class="content__txt">
                        <div class="content__desc content__desc_archive">
                            <div class="content__title" itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                            <div class="content__body" itemprop="articleBody"><?php the_excerpt(); ?></div>
                        </div>
                        <div class="content__btn-more"><a href="<?php the_permalink(); ?>" class="btn-more btn-more_articles">Смотреть подробно</a></div>
                    </div>
                </div>
            <?php }} else { ?>
                <div class="content__item" itemscope itemtype="http://schema.org/Article">
                    <div class="content__txt">
                        <div class="content__desc">
                            <div class="content__body" itemprop="articleBody">К сожалению, на сайте ничего не соответствует критериям поиска.<br>Пожалуйста, попробуйте еще раз с другими ключевыми словами.</div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
            <div class="pagination">
                <?php echo paginate_links(); ?>
            </div>
        </div>
    </section>
</div>


<?php get_footer(); ?>
