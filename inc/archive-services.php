<?php 
    $arrServices = array();
    if (have_posts()) {
        $i = 0;
        while (have_posts()) { 
            the_post();
            $arrServices[$i]['url'] = get_the_permalink();
            $arrServices[$i]['title'] = get_the_title();
            $arrServices[$i]['excerpt'] = get_the_excerpt();
            $arrServices[$i]['price'] = get_field('service_price');
            if (!$service_sort = get_field('sort')) $service_sort = 0;
            $arrServices[$i]['sort'] = $service_sort;
            if (has_post_thumbnail()) $arrServices[$i]['img'] = wp_get_attachment_image_url(get_post_thumbnail_id(),'large');
                else $arrServices[]['img'] = '';
            $i++;
        }
        function cmp($a, $b) {
            if ($a['sort'] == $b['sort']) return 0;
            return ($a['sort'] > $b['sort']) ? -1 : 1;
        }
        usort($arrServices, "cmp");
?>

    <section class="page__content page__content_services">
        <div class="container">
            <div class="content_services">
                <div class="row">
                    <div class="hidden-xs hidden-sm col-md-3">
                      <ul class="nav nav-tabs tabs-left">
                        <?php 
                            $isFirst = true;
                            $key = 0;
                            foreach ($arrServices as $arrService) {
                                if ($isFirst) { $class_active = ' class="active"'; $isFirst = false; }
                                    else { $class_active = ''; }
                                echo '<li'.$class_active.'><a href="#service-'.$key.'" data-toggle="tab">'.$arrService['title'].'</a></li>';
                                $key++;
                            }
                        ?>
                      </ul>
                    </div>
                    <div class="col-xs-12 col-md-9">
                        <div class="tab-content">
                            <?php 
                                $isFirst = true;
                                $key = 0;
                                $out = '';
                                foreach ($arrServices as $arrService) {
                                    if ($isFirst) { $class_active = ' active'; $isFirst = false; }
                                        else { $class_active = ''; }
                                    $out .= '<div class="tab-pane'.$class_active.'" id="service-'.$key.'">';
                                    if ($arrService['img'])
                                         $img_style = ' style="background-image: url('.$arrService['img'].')"';
                                    else 
                                        $img_style = '';
                                    $out .= '<div class="tab-img"'. $img_style.'><a class="tab-link" href="'.$arrService['url'].'"></a></div>';
                                    $out .= '<div class="tab-price"><table class="price__table"><tr>';
                                    $out .= '<td class="price__name">'.$arrService['title'].'</td>';
                                    if( $arrService['price'] ) {
                                        $out .= '<td class="price__value"><span class="price__from">от </span>'.$arrService['price'].'<span class="price__unit"> руб.</td>';
                                    }
                                    $out .= '</tr></table></div>';
                                    $out .= '<div class="tab-excerpt">'.$arrService['excerpt'].'</div>';
                                    $out .= '<div class="tab-more-wrap"><a class="btn-more btn-more_tab" href="'.$arrService['url'].'">Подробнее...</a></div>';
                                    $out .= '</div>';
                                    $key++;
                                }
                                echo $out;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php     
    } 
?>