    <section class="page__content page__content_completed">
        <div class="content__list content__list_completed">
            <?php if (have_posts()) {while (have_posts()) { the_post(); ?>        
                <div class="arch-completed__item">
                    <div class="container">
                        <div class="content__title content__title_completed"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                        <div class="content__body content__body_completed"><?php the_excerpt(); ?></div>
                        <div class="arch-completed__imgs">
                            <div class="row">
                                <?php if($compl_imgs_before = get_field('imgs_before')): ?>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="arch-completed__img arch-completed__img_before" style="background-image: url(<?php echo $compl_imgs_before[0]['sizes']['large']; ?>)"><a href="<?php the_permalink(); ?>"></a></div>
                                    </div>
                                <?php endif; ?>
                                <?php if($compl_imgs_after = get_field('imgs_after')): ?>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="arch-completed__img arch-completed__img_after" style="background-image: url(<?php echo $compl_imgs_after[0]['sizes']['large']; ?>)"><a href="<?php the_permalink(); ?>"></a></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }} ?>
        </div>
        <div class="pagination">
            <div class="container">
                <?php echo paginate_links(); ?>
            </div>
        </div>
    </section>