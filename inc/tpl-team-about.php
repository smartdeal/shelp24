        <?php 
            $team_about = get_field('team_about','option');
            $team_digits = get_field('team_digits','option');
        ?>
        <?php if ($team_about || $team_digits): ?>
            <section class="b-team-about js-team-about">
                <div class="b-team-about__bg js-team-about__bg" data-stellar-background-ratio="0.5"></div>
                <div class="container-fluid">
                    <div class="b-team-about__inner">
                        <?php if ($team_about): ?>
                            <div class="b-team-about__txt"><?php echo $team_about; ?></div>
                        <?php endif; ?>
                        <?php if ($team_digits): ?>
                            <div class="b-team-about__digits">
                                <?php foreach ($team_digits as $key => $value): ?>
                                    <div class="b-team-about__item">
                                        <div class="b-team-about__num js-team-about-num" data-max-num="<?php echo $value['team_digits_value'] ?>">0</div>
                                        <div class="b-team-about__desc"><?php echo $value['team_digits_txt'] ?></div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>