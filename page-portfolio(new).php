<?php 
/*
Template Name: Портфолио (new)
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
<div class="content__inner content__inner_portfolio">
<div class="portfolio__wrapper"><div class="portfolio portfolio_all js-portfolio-grid">
<?php 
$posts = get_field('projects');
if( $posts ): ?>
    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post); ?>
     <div class="portfolio__item portfolio__item_all portfolio-tax-seo-prodvizhenie">
            <a href="<?php the_permalink(); ?>"class="portfolio__link">
            	<div class="portfolio__caption"><?php the_title(); ?></div>
            	<?php $tax_name_main = get_field('folio_type_tile'); ?>
                <div class="smotret">Смотреть кейс</div>
            	<div class="portfolio__tax-main"><?php echo get_term($tax_name_main)->name; ?></div>
            	<img src=<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(),'medium'); ?>" alt="<?php get_the_title(); ?>" class="portfolio__img"> 
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	<?php echo get_post_meta($post->ID, "textarea", true);?>
            </a>
          </div>
        
    <?php endforeach; ?>
   
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>
</div> </div></div>

<div class="container-fluid portfolio-container-fluid">
</div>
  <div class="container-fluid">
 <div class="b-content article" itemprop="articleBody">
                                <?php the_content(); ?>
                            </div>

</div></div>
<?php get_footer(); ?>