<?php get_header(); ?>

    <div class="content__inner content__inner_404" itemscope itemtype="http://schema.org/Article">
        <div class="container-fluid">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if(function_exists('bcn_display')) {bcn_display(); }?>
            </div>
            <div class="content__title" itemprop="headline">
                <h1>Страница не найдена</h1>
            </div>    
            <div class="content__body">
                <div class="b-content article" itemprop="articleBody">
                    <a href="<?= get_home_url()  ?>">Перейти на главную</a>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>

