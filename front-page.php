<?php get_header(); ?>

<div class="content__inner content__inner_portfolio content__inner_front" itemscope itemtype="http://schema.org/Article">
	<div class="content__title content__title_front">Наши работы</div>
	<?php get_portfolio(16); ?>
	<?php if (have_posts()) { 
        while (have_posts()) { the_post();
        	if (get_the_content()):
        ?>	
		    <div class="content__body">
			    <div class="container_fluid">
			    	<?php the_content(); ?>
			    </div>
		    </div>
		<?php endif; ?>
    <?php }} ?>
    <div id="map" class="content__map"></div>
</div>

<?php get_footer(); ?>

