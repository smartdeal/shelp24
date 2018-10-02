<?php get_header(); ?>

<div class="content__inner content__inner_portfolio content__inner_front" itemscope itemtype="http://schema.org/Article">
	<div class="content__title content__title_front" itemprop="headline">истории успеха</div>
	<!--noindex-->
	<?php get_portfolio(12); ?>
	<!--/noindex-->
	<?php if (have_posts()) { 
        while (have_posts()) { the_post();
        	if (get_the_content()):
        ?>	
		    <div class="content__body">
			    <div class="container_fluid">
			    	<?php the_content(); ?>
			    	<?php the_seo_schema_article(); ?>
			    </div>
		    </div>
		<?php endif; ?>
    <?php }} ?>
    <div id="map" class="content__map"></div>
</div>

<?php get_footer(); ?>

