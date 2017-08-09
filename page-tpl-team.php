<?php 
/*
Template Name: Наша команда
Template Post Type: page
*/
?>

<?php get_header(); ?>

<?php  
    if (is_singular( array('stati','uslugi') )) $is_post_with_meta = true;
        else $is_post_with_meta = false;
?>

        <div class="content__inner <?php if ($is_post_with_meta) echo 'content__inner_with-meta'; ?>" itemscope itemtype="http://schema.org/Article">
            <div class="container-fluid">
                <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                    <?php if(function_exists('bcn_display')) {bcn_display(); }?>
                </div>
                <?php if (have_posts()) { 
                    while (have_posts()) { the_post(); ?>
                        <div class="content__title content__title_team" itemprop="headline">
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
                                        <div class="b-content__desc b-content__desc_team">
                                            <div class="b-content__txt article" itemprop="articleBody">
                                                <?php the_content(); ?>
                                            </div>
                                        </div>
                                        <?php if ($arrTeam = get_field('team')): ?>
                                            <div class="b-team">
                                                <?php foreach ($arrTeam as $value) { ?>
                                                    <div class="b-team__item">
                                                        <?php 
                                                            if ($value['team_img']) $team_img_src = ' style="background-image:url('.$value['team_img']['sizes']['large'].')"';
                                                                else $team_img_src = '';
                                                        ?>
                                                        <div class="b-team__img"<?php echo $team_img_src; ?>></div>
                                                        <div class="b-team__desc">
                                                            <div class="b-team__name"><?php echo $value['team_name']; ?></div>
                                                            <?php if ($value['team_position']): ?>
                                                                <div class="b-team__position"><?php echo $value['team_position']; ?></div>
                                                            <?php endif; ?>
                                                            <?php if ($value['team_link_txt']): ?>
                                                                <a class="b-team__link" href="<?php echo $value['team_link']; ?>"><?php echo $value['team_link_txt']; ?></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }} ?>
            </div>
        </div>
        <?php 
            $team_about = get_field('team_about');
            $team_digits = get_field('team_digits');
        ?>
        <?php if ($team_about || $team_digits): ?>
            <div class="b-team-about js-team-about">
                <div class="container-fluid">
                    <div class="b-team-about__inner">
                        <?php if ($team_about): ?>
                            <div class="b-team-about__txt"><?php echo $team_about; ?></div>
                        <?php endif; ?>
                        <?php if ($team_digits): ?>
                            <div class="b-team-about__digits">
                                <?php foreach ($team_digits as $key => $value): ?>
                                    <div class="b-team-about__item">
                                        <div class="b-team-about__num js-team-about-num" data-max-num="<?php echo $value['team_digits_value'] ?>">0</div>
                                        <div class="b-team-about__desc"><?php echo $value['team_digits_txt'] ?></div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if (is_singular( array('uslugi') )) get_template_part( 'inc/tpl-slider-clients-logo' ); ?>

<?php get_footer(); ?>
