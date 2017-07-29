<?php get_header(); ?>

<div class="content" itemscope itemtype="http://schema.org/Article">
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
            <h1 itemprop="headline">Страница не найдена</h1>
        </div>
    </div>    
    <section class="page__content">
        <div class="container">
            <div class="content__list">
                <div class="content__item">
                    <div class="content__txt">
                        <div class="content__desc">
                            <div class="content__body" itemprop="articleBody"><a href="/">Перейти на главную</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
