<?php 

$clients_title = get_field('clients_title', 'option');
$clients_desc = get_field('clients_desc', 'option');
$clients_logo = get_field('clients_logo', 'option');

?>

<?php if ($clients_title || $clients_desc || $clients_logo): ?>

    <section class="clients-slider js-clients-slider">
        <div class="clients-slider__bg js-clients-slider__bg"></div>
        <div class="container-fluid">
            <div class="clients-slider__inner">
                <?php if ($clients_title): ?>
                    <div class="clients-slider__title"><?php echo $clients_title; ?></div>
                <?php endif; ?>
                <?php if ($clients_desc): ?>
                    <div class="clients-slider__desc"><?php echo $clients_desc; ?></div>
                <?php endif; ?>
                <?php if ($clients_logo): ?>
                    <div class="clients-slider__logo">
                        <div class="b-slider-logo js-slider-logo">
                            <?php $i = 0; $is_open_tag = false; ?>
                            <?php foreach ($clients_logo as $value) { ?>
                                <?php if ($i % 2 == 0): $is_open_tag = true; ?>
                                    <div class="b-slider-logo__item"><div class="b-slider-logo__element">
                                <?php endif; ?>
                                
                                <div class="b-slider-logo__img-wrap"><img class="b-slider-logo__img" data-aload="<?php echo $value['sizes']['medium']; ?>" alt=""></div>
                                
                                <?php if ($i % 2 != 0): $is_open_tag = false; ?>
                                    </div></div>
                                <?php endif; ?>
                                <?php $i++; ?>
                            <?php } ?>
                            <?php if ($is_open_tag == true) echo '</div></div>' ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>