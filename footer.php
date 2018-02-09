		<div class="footer js-footer">
			<div class="footer__item footer__left">
		        <?php
		            wp_nav_menu( array(
		                'theme_location'    => 'footer',
		                'depth'             => 2,
		                'container'         => 'div',
		                'menu_class'        => 'nav nav_footer',
		                )
		            );
		        ?>
			</div>
			<div class="footer__item footer__right">
				<div class="footer__right-text">Сертифицированный партнер</div>
				<div class="footer__right-icons"><img src="<?php echo get_template_directory_uri(); ?>/img/icons-footer.png" alt=""></div>
			</div>
		</div>

		</div> <!-- end content -->
    </div>

    <?php wp_footer(); ?>
    <?php the_field('option_code_bottom','option'); ?>
    <script>
    	var home_url="<?php echo home_url(); ?>";
    	var theme_url="<?php echo get_template_directory_uri(); ?>";
	</script>
	<script type="text/javascript" src="//cdn.callbackhunter.com/cbh.js?hunter_code=282179804a9fc288486f39cd913d9636" charset="UTF-8"></script>
</body>
</html>
