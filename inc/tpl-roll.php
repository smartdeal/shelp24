<div class="form-get-roll-background"></div>
<div id="form-get-roll" class="form-get-roll forms js-form-get-roll">
	<div class="form-get-roll__inner form-wrap js-form-wrap">
		<?php the_roll(); ?>
		<div class="form-get-roll__inside">
			<?php
			$roll__title = get_field('roll_title', 'option');
			$roll__subtitle = get_field('roll_subtitle', 'option');
			?>
			<?php if ($roll__title): ?>
				<div class="form-get-roll__title"><?php echo $roll__title ?></div>
			<?php endif ?>
			<?php if ($roll__subtitle): ?>
				<div class="form-get-roll__subtitle"><?php echo $roll__subtitle ?></div>
			<?php endif ?>
			<a href="#" class="form-get-roll__close forms__close js-form-get-roll-close">+</a>
			<div class="form-get-roll__form">
				<?php echo do_shortcode('[contact-form-7 id="3855" title="Форма Рулетка"]') ?>
				<div class="form-sent-ok js-form-roll-sent-ok">
					<div class="form-sent-ok__inner">
						<div class="form-sent-ok__title">Поздравляем!</div>
						<div class="form-sent-ok__title2">Вы выиграли</div>
						<div class="form-sent-ok__prize js-form-sent-ok-prize"></div>
						<div class="form-sent-ok__subtitle">Наш специалист свяжется с Вами.</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>