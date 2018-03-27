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
                                                    <div class="case-meta__item case-meta__item_share b-meta__share js-meta-share">
                                                        <div class="case-meta__title">
                                                            <span class="case-meta__icon case-meta__icon_share"></span>
                                                            <a class="case-meta__caption b-meta__link b-meta__link_share js-link-share" href="#">Поделиться</a>
                                                            <?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
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
                                                <?php if (empty($value['folio_stage_is_result'])) { ?>
                                                    <div class="case__counter">&mdash; <?php echo sprintf("%02d", $folio_counter); ?></div>
                                                    <?php $folio_counter++; ?>
                                                <?php } ?>
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

                                                <?php $show_result = $value['folio_stage_show_result']; ?>
                                                <?php $result_graf = $value['folio_stage_result_graf']; ?>            
                                                <?php if ( $result_graf || $value['folio_stage_img'] ): ?>
                                                    <div class="case__imgs">

                                                        <?php if ($show_result && $result_graf): ?>
                                                            <div class="case__result">
                                                                <div class="case-result__graf">
                                                                    <div class="case-result__chart">
                                                                        <div class="case-chart">

                                                                            <?php 
                                                                                $arrDigits = array();
                                                                                $digit_height_max = 220; // max height block
                                                                                foreach ($result_graf as $key => $value2):
                                                                                    $digit_max = max($value2['after'], $value2['before']);
                                                                                    $arrDigits[$key] = $digit_max;
                                                                                endforeach; 
                                                                                rsort($arrDigits);
                                                                            ?>

                                                                            <?php foreach ($result_graf as $key => $value2): ?>
                                                                                <?php 
                                                                                    $digit_max = max($value2['after'], $value2['before']); 
                                                                                    $chart__item_width = round(100/count($result_graf)) - 4;
                                                                                    $item_weight = array_search($digit_max, $arrDigits);
                                                                                    $item_height_max = round($digit_height_max/($item_weight+1));
                                                                                ?>
                                                                                <div class="case-chart__item case-chart__item_<?php echo $key; ?>" style="width:<?php echo $chart__item_width; ?>%">
                                                                                    <div class="case-chart__item-before" style="height:<?php echo round($item_height_max *  $value2['before'] / $digit_max ); ?>px"></div>
                                                                                    <div class="case-chart__item-after" style="height:<?php echo round($item_height_max * $value2['after'] / $digit_max ); ?>px"></div>
                                                                                    <div class="case-chart__item-txt"><?php echo $value2['param']; ?></div>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="case-result__digit">
                                                                        <table>
                                                                            <thead>
                                                                                <tr><th></th><th>До</th><th>После</th></tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php foreach ($result_graf as $key => $value2): ?>
                                                                                    <tr>
                                                                                        <td><?php echo $value2['param']; ?></td>
                                                                                        <td><?php echo $value2['before']; ?></td>
                                                                                        <td><?php echo $value2['after']; ?></td>
                                                                                    </tr>
                                                                                <?php endforeach; ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if ($value['folio_stage_img']): ?>
                                                            <div class="case__img2">
                                                                <?php if(is_array($value['folio_stage_show_gif']) && $value['folio_stage_show_gif'][0] == 'yes'): ?>
                                                                    <img data-aload="<?php echo $value['folio_stage_img']['url']; ?>" alt="">
                                                                <?php else: ?>
                                                                    <img data-aload="<?php echo kama_thumb_src( array('src' => $value['folio_stage_img']['url'], 'w' => 646, 'q' => 50 ) ); ?>" alt="">
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
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
