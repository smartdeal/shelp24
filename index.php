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
            <h1 itemprop="headline"><?php the_title(); ?></h1>
        </div>
    </div>    
    <section class="page__content">
        <div class="container">
            <div class="content__list">
            <?php if (have_posts()) {while (have_posts()) { the_post(); ?>        
                <div class="content__item">
                    <?php if (has_post_thumbnail()) echo '<img class="content__img" src="'.wp_get_attachment_image_url(get_post_thumbnail_id(),'large').'">'; ?>
                    <?php if (is_single()): ?>
                        <div class="content__date"><?php the_date('j F Y'); ?></div>
                    <?php endif; ?>
                    <div class="content__txt">
                        <div class="content__desc">
                            <div class="content__body" itemprop="articleBody"><?php the_content(); ?></div>
                        </div>
                    </div>
                </div>
            <?php }} ?>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
