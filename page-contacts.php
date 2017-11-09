<?php 
/*
Template Name: Контакты
Template Post Type: page
*/
?>
<?php get_header(); ?>

    <div class="content__inner content__inner_contacts" itemscope itemtype="http://schema.org/Article">
        <div class="container-fluid">
            <div class="content__layout">
                <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                    <?php if(function_exists('bcn_display')) {bcn_display(); }?>
                </div>
                <?php 
                	if (have_posts()) { 
                        while (have_posts()) { the_post();
                ?>
                            <div class="content__title content__title_contacts" itemprop="headline">
                                <h1><?php the_title(); ?></h1>
                            </div>    
                            <div class="content__body">
                                <div class="b-content article" itemprop="articleBody">
                                    <?php the_content(); ?>
                                </div>
                                <div class="contact__row">
                                    <div class="b-contact">
                                        <?php 
                                            $option_tel = get_field('option_tel','option'); 
                                            $option_tel_2 = get_field('option_tel_2','option'); 
                                            $option_email = get_field('option_email','option'); 
                                            $option_adr = get_field('option_adr','option'); 
                                            $option_adr_2 = get_field('option_adr_2','option'); 
                                        ?>
                                        <?php if ($option_tel && $option_tel_2): ?>
                                            <div class="b-contact__item b-contact__item_tel">
                                                <div class="b-contact__icon b-contact__icon_tel"></div>
                                                <div class="b-contact__txt">
                                                    <?php if ($option_tel): ?>
                                                        <div class="b-contact__tel"><?= $option_tel ?></div>
                                                    <?php endif; ?>
                                                    <?php if ($option_tel_2): ?>
                                                        <div class="b-contact__tel"><?= $option_tel_2 ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($option_email): ?>
                                            <div class="b-contact__item b-contact__item_email">
                                                    <div class="b-contact__icon b-contact__icon_email"></div>
                                                    <div class="b-contact__txt">
                                                    <?php if ($option_email): ?>
                                                        <div class="b-contact__email">E-mail: <a href="mailto:<?= $option_email ?>"><?= $option_email ?></a></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($option_adr && $option_adr_2): ?>
                                            <div class="b-contact__item b-contact__item_adr">
                                                <div class="b-contact__icon b-contact__icon_adr"></div>
                                                <div class="b-contact__txt">
                                                    <?php if ($option_adr): ?>
                                                        <div class="b-contact__adr"><?= $option_adr ?></div>
                                                    <?php endif; ?>
                                                    <?php if ($option_adr_2): ?>
                                                        <div class="b-contact__adr b-contact__adr_2"><?= $option_adr_2 ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                    </div>
                                    <div class="form-wrap js-form-wrap">
                                        <?php echo do_shortcode('[get_contact_form]' ); ?>
                                        <div class="form-sent-ok js-form-sent-ok"><div class="form-sent-ok__inner"><div class="form-sent-ok__title">Спасибо!</div><div class="form-sent-ok__subtitle">Заявка принята. Наш специалист позвонит Вам.</div></div></div>
                                    </div>
                                </div>
                            </div>
                <?php }} ?>
            </div>
        </div>
        <?php 
            $map_contact = array('lat' => get_field('option_map_lat','option'),
                                 'long' => get_field('option_map_long','option'));
        ?>                        
        <div id="map" class="content__map"></div>
        <script>
            var map_contact = <?php echo json_encode($map_contact); ?>;
        </script>                        
    </div>

<?php get_footer(); ?>
