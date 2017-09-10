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
                            	$reviews = get_field('review_imgs'); 
                            	if ($reviews):
                        	?>
	                            <div class="b-reviews js-reviews">
	                            	<?php foreach ($reviews as $key => $value): ?>
			                            <div class="b-reviews__item">
			                            	<div class="b-reviews__img js-reviews-img" style="background-image:url(<?php echo $value['sizes']['medium']; ?>)" data-img-src="<?php echo $value['sizes']['large']; ?>"></div>
		                            	</div>
	                            	<?php endforeach ?>
	                            </div>
                            <?php endif; ?>
                        </div>
            <?php }} ?>
        </div>
    </div>

<?php get_footer(); ?>
