<?php get_header(); ?>

<div class="content__inner content__inner_portfolio content__inner_front" itemscope itemtype="http://schema.org/Article">
	<!--<div class="content__title content__title_front" itemprop="headline">истории успеха</div>-->
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
    <div class="front-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2243.49657039866!2d37.67101611623149!3d55.78461488056184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b53583707e9a69%3A0x7ba4415985d17866!2z0KDRg9GB0LDQutC-0LLRgdC60LDRjyDRg9C7LiwgMTMsIDUwNCwg0JzQvtGB0LrQstCwLCDQoNC-0YHRgdC40Y8sIDEwNzE0MA!5e0!3m2!1sru!2sua!4v1544989578897" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>

<?php get_footer(); ?>

