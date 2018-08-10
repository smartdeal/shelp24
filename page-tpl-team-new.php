<?php 
/*
Template Name: Наша команда новая
Template Post Type: page
*/
?>

<?php get_header(); ?>

    <div class="content-wrap content-wrap_team">
        <div class="content__inner" itemscope itemtype="http://schema.org/Article">
            <div class="container-fluid">
                <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                    <?php if(function_exists('bcn_display')) {bcn_display(); }?>
                </div>
                <?php if (have_posts()) { 
                    while (have_posts()) { the_post(); ?>
                        <div class="content__title" itemprop="headline">
                            <h1><?php the_title(); ?></h1>
                        </div>    
                        <div class="content__body">
                            <div class="content__list">
                                <div class="b-content<?php if (has_post_thumbnail()) echo ' b-content_with-img'?>">
                                    <div class="b-content__inner cf">
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="b-content__img-wrap">
                                                <img data-aload="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(),'large'); ?>" alt="">
                                            </div>
                                        <?php endif; ?>
                                        <div class="b-content__desc" itemprop="articleBody">
                                                <?php the_content(); ?>
                                        </div>
                                        <?php if ($arrTeam = get_field('employees')): ?>
                                            <div class="b-employees">
                                                <div class="b-employees__dir">
                                                    <div class="b-employees__photo">
                                                        <div class="b-employees__img"><img src="<?php echo kama_thumb_src("w=320 &h=470", $arrTeam[0]['photo']) ?>" alt=""></div>
                                                        <div class="b-employees__name">
                                                            <div class="b-employees__name">
                                                        </div>
                                                    </div>
                                                    <div class="b-employees__text-wrap">
                                                        <div class="b-employees__text"><?php $arrTeam[0]['photo'] ?></div>
                                                    </div>
                                                </div>
                                                    <?php 
                                                        if ($value['is_text']) :
                                                            if ($value['is_text']) $team_img_src = ' style="background-image:url('.$value['team_img']['sizes']['large'].')"';
                                                            else $team_img_src = '';
                                                            ?>
                                                    <?php else: ?>
                                                        <div class="b-team__img"<?php echo $team_img_src; ?>></div>
                                                        <div class="b-team__desc">
                                                            <div class="b-team__name"><?php echo $value['team_name']; ?></div>
                                                            <?php if ($value['team_position']): ?>
                                                                <div class="b-team__position"><?php echo $value['team_position']; ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                
                                                <?php for ($i=2; $i < $arrTeam.count(); $i++): ?>
                                                <?php    // $arrTeam
                                                ?>

                                                <?php endfor; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }} ?>
            </div>
        </div>

        <?php get_template_part( 'inc/tpl-slider-clients-logo' ); ?>

<?php get_footer(); ?>
