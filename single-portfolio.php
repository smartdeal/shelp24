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
                                            <div class="content__title case__title_first" itemprop="headline"><h1><?php the_title(); ?></h1></div>
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
                                                                $folio_type_item = array_shift($folio_type);
                                                                echo $folio_type_item->name;
                                                                if (count($folio_type) > 0) {
                                                                    foreach ($folio_type as $value) {
                                                                        echo ', '.$value->name;
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
                                            <div class="case__desc case__desce_first" itemprop="articleBody"><?php the_content(); ?></div>
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
                                            <div class="case__img"><img data-aload="<?php echo $folio_main_img['sizes']['large']; ?>" alt=""></div>
                                        <?php endif; ?>
                                    </div>

                                    <?php $folio_stage = get_field('folio_stage'); ?>
                                    <?php if ($folio_stage): ?>
                                        <?php $folio_counter = 1; ?>
                                        <?php foreach ($folio_stage as $value) { ?>
                                            <div class="case__item">
                                                <div class="case__counter">&mdash; <?php echo sprintf("%02d", $folio_counter); ?></div>
                                                <?php if ($value['folio_stage_title'] || $value['folio_stage_desc'] || $value['folio_stage_block'] ): ?>
                                                    <div class="case__txt">
                                                        <?php if ($value['folio_stage_title']): ?>
                                                            <div class="case__title"><?php echo $value['folio_stage_title']; ?></div>
                                                        <?php endif; ?>

                                                        <?php if ($value['folio_stage_desc']): ?>
                                                            <div class="case__desc"><?php echo $value['folio_stage_desc']; ?></div>
                                                        <?php endif; ?>

                                                        <?php if ($value['folio_stage_block'] && $value['folio_stage_show_block'][0] == 'Да'): ?>
                                                            <div class="case__stage-block">
                                                                <?php foreach ($value['folio_stage_block'] as $value2): ?>
                                                                    <div class="case__stage-title"><?php echo $value2['folio_stage_block_title'] ?></div>
                                                                    <div class="case__stage-desc"><?php echo $value2['folio_stage_block_desc'] ?></div>
                                                                <?php endforeach ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($value['folio_stage_result'] || $value['folio_stage_img']): ?>
                                                    <div class="case__imgs">
                                                        <?php if ($value['folio_stage_result']): ?>
                                                            <?php 
                                                                $folio_request_after = $value['folio_stage_result'][0]['folio_stage_request_after'];
                                                                $folio_request_before = $value['folio_stage_result'][0]['folio_stage_request_before'];
                                                                $folio_visitor_after = $value['folio_stage_result'][0]['folio_stage_visitor_after'];
                                                                $folio_visitor_before = $value['folio_stage_result'][0]['folio_stage_visitor_before'];
                                                            ?>
                                                            <div class="case__result">
                                                                <div class="case-result__graf">
                                                                    <div class="case-result__chart">
                                                                        <div class="case-chart">
                                                                        <?php 
                                                                            $digit_height_visitor_max = 220; // max height visitor's block
                                                                            $digit_height_request_max = 100; // max height request's block
                                                                            $digit_visitor_max = max($folio_visitor_after, $folio_visitor_before); 
                                                                            $digit_request_max = max($folio_request_after, $folio_request_before); 
                                                                        ?>
                                                                            <div class="case-chart__before">
                                                                                <div class="case-chart__before-request" style="height:<?php echo round($digit_height_request_max * $folio_request_before / $digit_request_max ); ?>px"></div>
                                                                                <div class="case-chart__after-request" style="height:<?php echo round($digit_height_request_max * $folio_request_after / $digit_request_max ); ?>px"></div>
                                                                                <div class="case-chart__txt">до</div>
                                                                            </div>
                                                                            <div class="case-chart__after">
                                                                                <div class="case-chart__before-visitor" style="height:<?php echo round($digit_height_visitor_max * $folio_visitor_before / $digit_visitor_max ); ?>px"></div>
                                                                                <div class="case-chart__after-visitor" style="height:<?php echo round($digit_height_visitor_max * $folio_visitor_after / $digit_visitor_max ); ?>px"></div>
                                                                                <div class="case-chart__txt">после</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="case-result__digit">
                                                                        <div class="case-result__request">
                                                                            <div class="case-result__item">
                                                                                <span class="case-result__caption">Заявки:</span>
                                                                                <span class="case-result__counter case-result__red"><?php echo $folio_request_after; ?></span>
                                                                            </div>
                                                                            <div class="case-result__item">
                                                                                <span class="case-result__caption">Заявки:</span>
                                                                                <span class="case-result__counter case-result__grey"><?php echo $folio_request_before; ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="case-result__visitor">
                                                                            <div class="case-result__item">
                                                                                <span class="case-result__caption">Посетители:</span>
                                                                                <span class="case-result__counter case-result__lightred"><?php echo $folio_visitor_after; ?></span>
                                                                            </div>
                                                                            <div class="case-result__item">
                                                                                <span class="case-result__caption">Посетители:</span>
                                                                                <span class="case-result__counter case-result__lightgrey"><?php echo $folio_visitor_before; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if ($value['folio_stage_img']): ?>
                                                            <div class="case__img2">
                                                                <img data-aload="<?php echo $value['folio_stage_img']['sizes']['large']; ?>" alt="">
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <?php $folio_counter++; ?>
                                        <?php } ?>
                                    <?php endif; ?>

                                </div>
                                <div class="case__form"><?php echo do_shortcode('[get_content_form title="Хочу так же!"]' ); ?></div>
                            </div>
                <?php }} ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
