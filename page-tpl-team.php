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
                                                <?php foreach ($arrTeam as $key => $value) { ?>
                                                    <div class="b-team__item<?php if ($key == 0) echo ' js-team-item-boss'; ?>">
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
                                                            <?php if ($key == 0): ?>
                                                                <a class="b-team__link js-team-call-boss" href="#">Прямая связь</a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <?php if ($key == 0): ?>
                                                        <div class="b-team__form js-team-form-boss">
                                                            <div class="b-team__form-inner js-team-form-inner">
                                                                <div class="b-team__form-title">Связь с директором</div>
                                                                <div class="form-wrap js-form-wrap">
                                                                    <?php echo do_shortcode('[contact-form-7 id="1935"]'); ?>
                                                                    <div class="form-sent-ok js-form-sent-ok"><div class="form-sent-ok__inner"><div class="form-sent-ok__title">Спасибо!</div><div class="form-sent-ok__subtitle">Заявка принята. Наш специалист позвонит Вам.</div></div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
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

        <?php get_template_part( 'inc/tpl-team-about' ); ?>

        <?php // НАД КАЖДЫМ ПРОЕКТОМ РАБОТАЮТ
            $team_project_title = get_field('team_project_title');
            $team_project = get_field('team_project');
        ?>
        <?php if ($team_project): ?>
            <div class="b-team-project">
                <div class="container-fluid">
                <?php if ($team_project_title): ?>
                    <div class="b-team-project__title"><?php echo $team_project_title; ?></div>
                <?php endif ?>
                <div class="b-team-project__body">
                    <?php foreach ($team_project as $key => $value): ?>
                        <div class="b-team-project__item">
                            <div class="b-team-project__img"><img src="<?php echo $value['team_project_img']['sizes']['thumbnail']; ?>" alt=""></div>
                            <div class="b-team-project__txt">
                                <div class="b-team-project__caption"><?php echo $value['team_project_caption']; ?></div>
                                <?php if ($value['team_project_desc']): ?>
                                    <div class="b-team-project__desc"><?php echo $value['team_project_desc']; ?></div>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <div class="b-team-project__our"><img src="<?php echo get_template_directory_uri(); ?>/img/icon-team-0.png" alt=""></div>
                </div>
                </div>
            </div>
        <?php endif ?>

        <?php // Конкурентные преимущества
            $team_advantages_title = get_field('team_advantages_title');
            $team_advantages = get_field('team_advantages');
        ?>
        <?php if ($team_advantages): ?>
            <div class="b-team-advantages">
                <div class="b-team-advantages__inner">
                    <div class="container-fluid">
                    <?php if ($team_advantages_title): ?>
                        <div class="b-team-advantages__title"><?php echo $team_advantages_title; ?></div>
                    <?php endif ?>
                    <div class="b-team-advantages__body">
                        <?php foreach ($team_advantages as $key => $value): ?>
                            <div class="b-team-advantages__item">
                                <div class="b-team-advantages__img"><img src="<?php echo $value['team_advantages_img']['sizes']['thumbnail']; ?>" alt=""></div>
                                <div class="b-team-advantages__txt">
                                    <?php if ($value['team_advantages_desc']): ?>
                                        <div class="b-team-advantages__desc"><?php echo $value['team_advantages_desc']; ?></div>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <?php get_template_part( 'inc/tpl-slider-clients-logo' ); ?>

<?php get_footer(); ?>
