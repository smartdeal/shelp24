<?php 
/*
Template Name: Наша команда новая
Template Post Type: page
*/
?>

<?php get_header(); ?>

    <div class="content-wrap content-wrap_team">
        <div class="content__inner" itemscope itemtype="http://schema.org/Article">
            <div class="s-team-employees">
                <div class="container-fluid">
                    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                        <?php if(function_exists('bcn_display')) {bcn_display(); }?>
                    </div>
                    <?php if (have_posts()) { 
                        while (have_posts()) { the_post(); ?>
                            <div class="content__title t-title" itemprop="headline">
                                <h1><?php the_title(); ?></h1>
                            </div>    
                            <div class="b-content__desc" itemprop="articleBody">
                                    <?php the_content(); ?>
                            </div>
                            <?php if ($arrTeam = get_field('employees')): ?>
                                <div class="b-employees">
                                    <div class="b-employees__person b-employees__person_dir">
                                        <div class="b-employees__photo">
                                            <div class="b-employees__img"><img src="<?php echo kama_thumb_src("w=320 &h=470", $arrTeam[0]['photo']['url']) ?>" alt=""><span class="border"></span></div>
                                            <div class="b-employees__text">
                                                <div class="b-employees__name"><?php echo $arrTeam[0]['name'] ?></div>
                                                <div class="b-employees__positon"><?php echo $arrTeam[0]['position'] ?></div>
                                            </div>
                                        </div>
                                        <div class="b-employees__desc-wrap">
                                            <div class="b-employees__desc"><div class="b-employees__desc-inner"><?php echo $arrTeam[0]['text'] ?></div></div>
                                        </div>
                                    </div>
                                    <div class="b-employees__person b-employees__person_tech">
                                        <div class="b-employees__photo">
                                            <div class="b-employees__img"><img src="<?php echo kama_thumb_src("w=320 &h=470", $arrTeam[1]['photo']['url']) ?>" alt=""><span class="border"></span></div>
                                            <div class="b-employees__text">
                                                <div class="b-employees__name"><?php echo $arrTeam[1]['name'] ?><span class="border"></span></div>
                                                <div class="b-employees__positon"><?php echo $arrTeam[1]['position'] ?></div>
                                            </div>
                                        </div>
                                        <div class="b-employees__desc-wrap">
                                            <div class="b-employees__desc"><div class="b-employees__desc-inner"><?php echo $arrTeam[1]['text'] ?></div></div>
                                        </div>
                                    </div>
                                    <div class="b-employees__persons">
                                    <?php for ($i=2; $i < count($arrTeam); $i++): ?>
                                        <div class="b-employees__person">
                                            <div class="b-employees__photo">
                                                <div class="b-employees__img"><img src="<?php echo kama_thumb_src("w=320 &h=470", $arrTeam[$i]['photo']['url']) ?>" alt=""><span class="border"></span></div>
                                                <div class="b-employees__text">
                                                    <div class="b-employees__name"><?php echo $arrTeam[$i]['name'] ?><span class="border"></span></div>
                                                    <div class="b-employees__positon"><?php echo $arrTeam[$i]['position'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                    <?php }} ?>
                </div>
            </div>
            <div class="s-team-advantages">
                <div class="container-fluid">
                    <div class="s-team-advantages__inner">
                        <div class="s-team-advantages__title t-title">КОНКУРЕНТНЫЕ ПРЕИМУЩЕСТВА</div>
                        <?php $advantages = get_field('team-advantages'); ?>
                        <?php if ($advantages): ?>
                            <div class="s-team-advantages__items js-team-advantages">
                                <?php foreach ($advantages as $value): ?>
                                    <div class="s-team-advantages__item">
                                        <div class="s-team-advantages__item-inner equalHeights">
                                            <div class="s-team-advantages__caption"><?= $value['title'] ?></div>
                                            <div class="s-team-advantages__text"><?= $value['text'] ?></div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="s-team-about">
                <div class="container-fluid">
                </div>
            </div>
        </div>
    </div>

    <?php get_template_part( 'inc/tpl-slider-clients-logo' ); ?>

<?php get_footer(); ?>
