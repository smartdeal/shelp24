<?php 

    $args = array(
        'posts_per_page' => 6,
        'post_type' => 'completed',
        'orderby' => 'date',
        'order' => 'ASC'
    );

    $query_completed = new WP_Query( $args );
    if ( $query_completed->have_posts() ) { 
    ?>
    <section class="examples-promo">
        <div class="container">
            <div class="examples-promo__title">Выполненные работы</div>
            <div class="examples-promo__list">
            <?php
                while ( $query_completed->have_posts() ) {
                    $query_completed->the_post();
                    if($compl_imgs_after = get_field('imgs_after',$query_completed->post->ID)[0]['sizes']['large']):
                        $compl_img = ' style="background-image: url('.$compl_imgs_after.')"';
                    else:
                        $compl_img = '';
                    endif;
                ?>
                <div class="examples-promo__elem">
                    <div class="examples-promo__item"<?php echo $compl_img; ?>>
                        <div class="examples-promo__item-inner">
                            <div class="examples-promo__item-title"><?php the_title(); ?></div>
                            <div class="examples-promo__item-hover">
                                <div class="item-hover__title"><?php the_excerpt(); ?></div>
                                <a href="<?php the_permalink(); ?>" class="btn view-project">Смотреть проект</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="more-view-wrap">
                <a href="/completed" class="btn-more btn-more_view">Смотреть больше</a>
            </div>
        </div>
    </section>
    <?php
    }
    wp_reset_postdata();
?>
