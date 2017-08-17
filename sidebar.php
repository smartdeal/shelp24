<?php

// The Sidebar

?>

<div class="sidebar">
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
		        <a href="tel:<?php echo preg_replace("/[^0-9]/","",$main_tel); ?>" class="b-tel b-tel_sidebar"><?php echo $main_tel; ?></a>
	        </div>
	    <?php endif; ?>
	    <?php if ($main_email = get_field('option_email','option')): ?>
	    	<div class="sidebar__email">
		        <a href="mailto:<?php echo $main_email; ?>" class="b-email b-email_sidebar"><?php echo $main_email; ?></a>
	        </div>
	    <?php endif; ?>
	</div>
    <nav class="navbar navbar_sidebar navbar_primary" role="navigation">
    <!--noindex-->
        <?php
            wp_nav_menu( array(
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => '',
                'container_id'      => '',
                'menu_class'        => 'nav navbar-nav',
                )
            );
        ?>
    <!--/noindex-->
    </nav>
    <nav class="navbar navbar_sidebar navbar_secondary" role="navigation">
    <!--noindex-->
        <?php
            wp_nav_menu( array(
                'theme_location'    => 'secondary',
                'depth'             => 1,
                'container'         => 'div',
                'container_class'   => '',
                'container_id'      => '',
                'menu_class'        => 'nav navbar-nav',
                )
            );
        ?>
    <!--/noindex-->
    </nav>
    <div class="sidebar__bottom js-sidebar__bottom">
	    <a href="#form-get-offer" class="sidebar__get-offer b-get-offer">Запросить предложение</a>
	    <?php if ($main_adr = get_field('option_adr','option')): ?>
		    <div class="sidebar__adr"><?php echo $main_adr; ?></div>
	    <?php endif; ?>
	    <div class="sidebar__bottom-links">
			<a href="https://seohelp24.bitrix24.ru/" class="sidebar__entry">Вход</a>
			<a href="<?php echo home_url(); ?>/garantii" class="sidebar__warranty">100%</a>
		</div>
		<?php if ($option_social = get_field('option_social', 'option')): ?>
			<div class="social">
				<?php $i = 1; ?>
				<?php foreach ($option_social as $value) { ?>
					<div class="social__item social__item_<?php echo $i; ?>">
						<a href="<?php echo $value['option_social_link']; ?>" class="social__icon" style="background-image:url(<?php echo $value['option_social_icon']['sizes']['thumbnail']; ?>)"></a>
					</div>
				<?php $i++; } ?>
			</div>
		<?php endif; ?>
    </div>
</div>
