		<div class="footer">
			<div class="footer__item footer__left">
                <?php if ($main_logo = get_field('option_logo','option')): ?>
                    <?php if (!is_front_page()) { ?><a href="<?php echo home_url(); ?>"><?php } ?>
                        <img class="b-logo b-logo_mob" src="<?php echo $main_logo['sizes']['medium']; ?>" alt="logo">
                    <?php if (!is_front_page()) { ?></a><?php } ?>
                <?php endif; ?>
                <?php if ($main_logo_footer = get_field('option_logo_footer','option')): ?>
                    <?php if (!is_front_page()) { ?><a href="<?php echo home_url(); ?>"><?php } ?>
                        <img class="b-logo b-logo_desc" src="<?php echo $main_logo_footer['sizes']['medium']; ?>" alt="logo">
                    <?php if (!is_front_page()) { ?></a><?php } ?>
                <?php endif; ?>
                <?php $main_tel = get_field('option_tel','option'); ?>
                <a href="tel:<?php echo preg_replace("/[^0-9+]/","",$main_tel); ?>" class="b-tel"><?php echo $main_tel; ?></a>
                <?php if ($main_email = get_field('option_email','option')): ?>
                    <a href="mailto:<?php echo $main_email; ?>" class="b-email"><?php echo $main_email; ?></a>
                <?php endif; ?>
			</div>
			<div class="footer__item footer__center">
				<div class="footer-menu footer-menu_mob">
			        <?php wp_nav_menu( array('theme_location' => 'footer_mob1', 'depth' => 1, 'container' => 'div', 'container_class' => 'nav_footer_container', 'menu_class' => 'nav nav_footer', ) ); ?>
			        <?php wp_nav_menu( array('theme_location' => 'footer_mob2', 'depth' => 1, 'container' => 'div', 'container_class' => 'nav_footer_container', 'menu_class' => 'nav nav_footer', ) ); ?>
				</div>
				<div class="footer-menu footer-menu_desc">
			        <?php wp_nav_menu( array('theme_location' => 'footer1', 'depth' => 1, 'container' => 'div', 'container_class' => 'nav_footer_container', 'menu_class' => 'nav nav_footer', ) ); ?>
			        <?php wp_nav_menu( array('theme_location' => 'footer2', 'depth' => 1, 'container' => 'div', 'container_class' => 'nav_footer_container', 'menu_class' => 'nav nav_footer', ) ); ?>
			        <?php wp_nav_menu( array('theme_location' => 'footer3', 'depth' => 1, 'container' => 'div', 'container_class' => 'nav_footer_container', 'menu_class' => 'nav nav_footer', ) ); ?>
				</div>
			</div>
			<div class="footer__item footer__right">
				<div class="footer__right-text">Сертифицированный партнер</div>
				<div class="footer__right-icons"><img src="<?php echo get_template_directory_uri(); ?>/img/icons-footer.png" alt=""></div>
			</div>
		    <div class="footer__bottom">
			    <div class="sidebar__bottom-links">
					<a href="https://seohelp24.bitrix24.ru/" class="sidebar__entry" rel="nofollow">Вход</a>
					<a href="<?php echo home_url(); ?>/garantii" class="sidebar__warranty">100%</a>
				</div>
				<?php if ($option_social = get_field('option_social', 'option')): ?>
					<div class="social">
						<?php $i = 1; ?>
						<?php foreach ($option_social as $value) { ?>
							<div class="social__item social__item_<?php echo $i; ?>">
								<a href="<?php echo $value['option_social_link']; ?>" class="social__icon" target="_blank" style="background-image:url(<?php echo $value['option_social_icon']['sizes']['thumbnail']; ?>)"></a>
							</div>
						<?php $i++; } ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		</div> <!-- end content -->
    </div>

	<div class="js-scrollup"></div>

    <?php wp_footer(); ?>
    <?php the_field('option_code_bottom','option'); ?>
    <script>
    	var home_url="<?php echo home_url(); ?>";
    	var theme_url="<?php echo get_template_directory_uri(); ?>";
	</script>
	<script type="text/javascript" src="//cdn.callbackhunter.com/cbh.js?hunter_code=282179804a9fc288486f39cd913d9636" charset="UTF-8"></script>
</body>
</html>
