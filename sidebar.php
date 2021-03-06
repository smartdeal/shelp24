<?php

// The Sidebar

?>

<div class="sidebar">
<div class="sidebar__inner js-sidebar__inner">
	<div class="sidebar__top">
		    <?php if ($main_logo = get_field('option_logo','option')): ?>
		    	<div class="sidebar__logo">
			        <?php if (!is_front_page()) { ?><a href="<?php echo home_url(); ?>"><?php } ?>
			            <img class="b-logo b-logo_sidebar" src="<?php echo $main_logo['sizes']['medium']; ?>" alt="logo">
			        <?php if (!is_front_page()) { ?></a><?php } ?>
		    	</div>
		    <?php endif; ?>
		    <?php if ($main_tel = get_field('option_tel','option')): ?>
		    	<div class="sidebar__tel">
			        <a href="tel:<?php echo preg_replace("/[^0-9+]/","",$main_tel); ?>" class="b-tel b-tel_sidebar"><?php echo $main_tel; ?></a>
		        </div>
		    <?php endif; ?>
		    <?php if ($main_email = get_field('option_email','option')): ?>
		    	<div class="sidebar__email">
			        <a href="mailto:<?php echo $main_email; ?>" class="b-email b-email_sidebar"><?php echo $main_email; ?></a>
		        </div>
		    <?php endif; ?>
		    <?php if ($main_time = get_field('option_time','option')): ?>
		    	<div class="sidebar__time"><?php echo $main_time; ?></div>
		    <?php endif; ?>
		</div>
	<nav class="navbar navbar_sidebar navbar_primary" role="navigation">

	    <?php
	        wp_nav_menu( array(
	            'theme_location'    => 'primary',
	            'depth'             => 2,
	            'container'         => 'div',
	            'container_class'   => '',
	            'container_id'      => '',
	            'menu_class'        => 'nav navbar-nav',
	            'walker' => new Texas_Ranger()
	            )
	        );
	    ?>
	
	</nav>
	<nav class="navbar navbar_sidebar navbar_secondary" role="navigation">
	
	    <?php
	        wp_nav_menu( array(
	            'theme_location'    => 'secondary',
	            'depth'             => 2,
	            'container'         => 'div',
	            'container_class'   => '',
	            'container_id'      => '',
	            'menu_class'        => 'nav navbar-nav',
	            'walker' => new Texas_Ranger()
	            )
	        );
	    ?>

	</nav>
	<div class="sidebar__bottom js-sidebar__bottom">
			<form role="search" method="get" class="search-form" action="<?php echo home_url() ?>">
				<input type="search" class="search-form__input" placeholder="Поиск" value="" name="s">
				<input type="submit" class="search-form__submit" value="Поиск">
			</form>
		    <a href="#form-get-offer" class="sidebar__get-offer b-get-offer js-btn-get-offer">Запросить предложение</a>
		    <?php if ($main_adr = get_field('option_adr','option')): ?>
			    <div class="sidebar__adr"><?php echo $main_adr; ?></div>
		    <?php endif; ?>
		    <div class="sidebar__bottom-links">
				<a href="https://seohelp24.bitrix24.ru/" class="sidebar__entry" rel="nofollow">Вход</a>
				<a href="<?php echo home_url(); ?>/garantii" class="sidebar__warranty">100%</a>
			</div>
			<?php if ($option_social = get_field('option_social', 'option')): ?>
				<div class="social">
					<?php $i = 1; ?>
					<?php foreach ($option_social as $value) { ?>
						<div class="social__item social__item_<?php echo $i; ?>">
							<a href="<?php echo $value['option_social_link']; ?>" class="social__icon" target="_blank" style="background-image:url(<?php echo $value['option_social_icon']['sizes']['thumbnail']; ?>)" rel="nofollow"></a>
						</div>
					<?php $i++; } ?>
				</div>
			<?php endif; ?>
	</div>
</div>
<div id="form-get-offer" class="form-get-offer forms">
    <div class="form-get-offer__inner form-wrap js-form-wrap">
	    <a href="#" class="forms__close js-form-get-offer-close">+</a>
    	<?php echo do_shortcode('[contact-form-7 id="782" title="Форма Запросить предложение"]') ?>
    	<div class="form-sent-ok js-form-sent-ok"><div class="form-sent-ok__inner"><div class="form-sent-ok__title">Спасибо!</div><div class="form-sent-ok__subtitle">Заявка принята. Наш специалист позвонит Вам.</div></div></div>
    </div>
</div>
</div>

<?php get_template_part( 'inc/tpl-roll' ); ?>
