<?php 

add_shortcode('get_table_tech', 'get_table_tech_func');

function get_table_tech_func( $atts ){
    $data = array();
    $data_title = ['','Базовый','Стандарт','Объемный'];
    $btn = '<a class="table-price__btn js-table-price-btn-mobile" href="#">Оставить заявку</a>';
    
    $price_tech_title = get_field('price_tech_title', 'option');
    $price_tech = get_field('price_tech', 'option');
    if ($price_tech) {
        foreach ($price_tech as $value) {
            $data[] = [$value['work'],$value['col_1'],$value['col_2'],$value['col_3']]; 
        }
    }
    $out = '<div class="table-price table-price_tech">';
    $out .= '<div class="table-price__title">'.$price_tech_title.'</div>';

    $out .= '<div class="table-price__table table-price__table_mobile">';
    for ($i=1; $i <= 3 ; $i++) { 
        $count_data = count($table);
        $out .= '<table>';
        $out .= '<tr><th colspan=2>'.$data_title[$i].'</th></tr>';
        foreach ($data as $key => $value) {
            $out .= '<tr><td>'.$value[0].'</td><td>'.$value[$i].'</td></tr>';
        }
        $out .= '<tr><td colspan=2>'.$btn.'</td></tr>';
        $out .= '</table>';
    }
    $out .= '</div>';

    $out .= '<div class="table-price__table table-price__table_desktop">';
    $out .= '<table>';
    $out .= '<tr><th></th><th>'.$data_title[1].'</th><th>'.$data_title[2].'</th><th>'.$data_title[3].'</th></tr>';
    $count_data = count($data);
    foreach ($data as $key => $value) {
        $btn = '';
        if ($key == $count_data-1 ) {
            $btn = '<a class="table-price__btn js-table-price-btn" href="#">Заказать</a>';
        }
        $out .= '<tr><td>'.$value[0].'</td><td>'.$value[1].$btn.'</td><td>'.$value[2].$btn.'</td><td>'.$value[3].$btn.'</td></tr>';
    }
    $out .= '</table>';
    $out .= '</div>';
    $out .= '</div>';

    return $out;
}
