<?php 

$clients_title = get_field('team-clients-title', 5585); // О нас
$clients_logo = get_field('team-clients-imgs', 5585);

?>

<?php if ($clients_title || $clients_logo): ?>

    <section class="s-clients-slider js-s-clients-slider">
        <div class="container-fluid">
            <div class="s-clients-slider__inner">
                <?php if ($clients_title): ?>
                    <div class="s-clients-slider__title t-title"><?php echo $clients_title; ?></div>
                <?php endif; ?>
                <?php if ($clients_logo): ?>
                    <div class="s-clients-slider__logo">
                        <div class="b-slider2-logo js-slider2-logo">
                            <?php $i = 0; $is_open_tag = false; ?>
                            <?php foreach ($clients_logo as $value) { ?>
                                <?php if ($i % 3 == 0): $is_open_tag = true; ?>
                                    <div class="b-slider2-logo__item"><div class="b-slider2-logo__element">
                                <?php endif; ?>
                                
                                <div class="b-slider2-logo__img-wrap"><img class="b-slider2-logo__img" data-aload="<?php echo $value['sizes']['medium']; ?>" alt=""></div>
                                
                                <?php if ($i % 3 == 2): $is_open_tag = false; ?>
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