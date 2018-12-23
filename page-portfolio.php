<?php 
/*
Template Name: Портфолио
Template Post Type: page
*/
?>

<?php get_header(); ?><div class="content__inner content__inner_portfolio" itemscope itemtype="http://schema.org/Article">
   <div class="container-fluid portfolio-container-fluid">

<br>
<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if(function_exists('bcn_display')) {bcn_display(); }?>
            </div>
	


            <div class="content__title" itemprop="headline">
                            <h1><?php the_title(); ?></h1>
                        </div>
<div class="portfolio-menu1">
<?php wp_nav_menu( array('theme_location' => 'portfolio', 'depth' => 1, 'container' => 'div', 'container_class' => 'nav_footer_container', 'menu_class' => 'nav nav_footer', ) ); ?>
</div></div>
<?php get_portfolio(); ?>
 <div class="container-fluid">

 <div class="b-content article" itemprop="articleBody">
                                <?php the_content(); ?>
                            </div>

</div></div>
<?php get_footer(); ?>