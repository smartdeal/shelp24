<?php get_header(); ?>

        <div class="content__inner" itemscope itemtype="http://schema.org/Article">
            <div class="container-fluid">
                <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                    <?php if(function_exists('bcn_display')) {bcn_display(); }?>
                </div>
                <?php if (have_posts()) { 
                    while (have_posts()) { the_post(); ?>
                        <div class="content__body">
                            <div class="case">
                                <div class="case__section">
                                    <div class="case__item case__item_first">
                                        <div class="case__txt">
                                            <div class="content__title case__title" itemprop="headline"><h1><?php the_title(); ?></h1></div>
                                            <?php 
                                                $folio_theme = get_field('folio_theme');
                                                $folio_date = get_field('folio_date');
                                                $folio_type = get_field('folio_type');
                                                if ( $folio_theme || $folio_date || $folio_type ): 
                                            ?>
                                                <div class="case-meta">
                                                    <?php if ($folio_theme): ?>
                                                        <div class="case-meta__item case-meta__item_theme">
                                                            <div class="case-meta__title">
                                                                <span class="case-meta__icon case-meta__icon_watch"></span>
                                                                <span class="case-meta__caption">Тематика</span>
                                                            </div>
                                                            <div class="case-meta__body"><?php echo $folio_theme; ?></div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($folio_date): ?>
                                                        <div class="case-meta__item case-meta__item_date">
                                                            <div class="case-meta__title">
                                                                <span class="case-meta__icon case-meta__icon_watch"></span>
                                                                <span class="case-meta__caption">Дата</span>
                                                            </div>
                                                            <div class="case-meta__body"><?php echo $folio_date; ?></div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($folio_type): ?>
                                                        <div class="case-meta__item case-meta__item_type">
                                                            <div class="case-meta__title">
                                                                <span class="case-meta__icon case-meta__icon_flag"></span>
                                                                <span class="case-meta__caption">Услуга</span>
                                                            </div>
                                                            <div class="case-meta__body">
                                                            <?php
                                                                echo array_shift($folio_type);
                                                                if (count($folio_type) > 0) {
                                                                    foreach ($folio_type as $value) {
                                                                        echo ', '.$value;
                                                                    }
                                                                }
                                                            ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="case-meta__item case-meta__item_share">
                                                        <div class="case-meta__title">
                                                            <span class="case-meta__icon case-meta__icon_share"></span>
                                                            <span class="case-meta__caption"><a href="#">Поделиться</a></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="case__desc" itemprop="articleBody"><?php the_content(); ?></div>
                                            <?php if ($folio_task = get_field('folio_task')): ?>
                                                <div class="case__task">
                                                    <div class="case-task">
                                                        <div class="case-task__title">Задача</div>
                                                        <div class="case-task__body"><?php echo $folio_task; ?></div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($folio_main_img = get_field('folio_main_img')): ?>
                                            <div class="case__img"><img src="<?php echo $folio_main_img['sizes']['large']; ?>" alt=""></div>
                                        <?php endif; ?>
                                    </div>
                                    <?php  ?>
                                    <div class="case__item">
                                        <div class="case__txt">
                                            <div class="content__title case__title" itemprop="headline"><h1><?php the_title(); ?></h1></div>
                                            <div class="case__desc"><?php the_content(); ?></div>
                                        </div>
                                        <?php if ($folio_main_img = get_field('folio_main_img')): ?>
                                            <div class="case__img"><img src="<?php echo $folio_main_img['sizes']['large']; ?>" alt=""></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                <?php }} ?>
            </div>
        </div>

<?php get_footer(); ?>
