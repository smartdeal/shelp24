<?php 
/*
Template Name: Отзывы
Template Post Type: page
*/
?>
<?php get_header(); ?>

    <div class="content__inner content__inner_reviews" itemscope itemtype="http://schema.org/Article">
        <div class="container-fluid">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if(function_exists('bcn_display')) {bcn_display(); }?>
            </div>
            <?php 
            	if (have_posts()) { 
                    while (have_posts()) { the_post();
            ?>
                        <div class="content__title" itemprop="headline">
                            <h1><?php the_title(); ?></h1>
                        </div>    
                        <div class="content__body">
                            <div class="b-content article" itemprop="articleBody">
                                <?php the_content(); ?>
                            </div>
                            <?php 
                                $reviews = get_field('review_dips'); 
                                if ($reviews):
                            ?>
                                <div class="b-reviews js-reviews">
                                    <?php foreach ($reviews as $key => $value): ?>
                                        <div class="b-reviews__item">
                                            <div class="b-reviews__img js-reviews-img" style="background-image:url(<?php echo $value['sizes']['large']; ?>)" data-img-src="<?php echo $value['sizes']['large']; ?>"></div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            <?php endif; ?>
                            <?php 
                            	$reviews = get_field('review_imgs'); 
                            	if ($reviews):
                        	?>
                                <hr class="bold">
	                            <div class="b-reviews js-reviews">
	                            	<?php foreach ($reviews as $key => $value): ?>
			                            <div class="b-reviews__item">
			                            	<div class="b-reviews__img js-reviews-img" style="background-image:url(<?php echo $value['sizes']['large']; ?>)" data-img-src="<?php echo $value['sizes']['large']; ?>"></div>
		                            	</div>
	                            	<?php endforeach ?>
	                            </div>
                            <?php endif; ?>
                            <div class="form-wrap js-form-wrap">
                                <?php echo do_shortcode('[get_review_form]' ); ?>
                                <div class="form-sent-ok js-form-sent-ok"><div class="form-sent-ok__inner"><div class="form-sent-ok__title">Спасибо!</div><div class="form-sent-ok__subtitle">Заявка принята. Наш специалист позвонит Вам.</div></div></div>
                            </div>
                        </div>
            <?php }} ?>
        </div>
    </div>

<?php get_footer(); ?>
