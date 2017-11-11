        <?php 
            $why = get_field('why','option');
        ?>
        <?php if ($why): ?>
            <section class="b-why">
                <div class="b-why__body">
                    <?php foreach ($why as $key => $value): ?>
                        <div class="b-why__item">
                            <div class="b-why__inner">
                                <div class="b-why__caption"><?php echo $value['caption'] ?></div>
                                <div class="b-why__img"><img src="<?php echo $value['img']['sizes']['thumbnail'] ?>" alt=""></div>
                                <div class="b-why__desc"><?php echo $value['desc'] ?></div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </section>
        <?php endif; ?>