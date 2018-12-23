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
       
        <div id="map" class="content__map"></div>
         <!--  <div class="front-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2243.49657039866!2d37.67101611623149!3d55.78461488056184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b53583707e9a69%3A0x7ba4415985d17866!2z0KDRg9GB0LDQutC-0LLRgdC60LDRjyDRg9C7LiwgMTMsIDUwNCwg0JzQvtGB0LrQstCwLCDQoNC-0YHRgdC40Y8sIDEwNzE0MA!5e0!3m2!1sru!2sua!4v1544989578897" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
</div>
    </div>

<?php get_footer(); ?>
