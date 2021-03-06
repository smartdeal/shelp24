<?php 

add_shortcode('get_table_serm', 'get_table_serm_func');

function get_table_serm_func( $atts ){
    $data = [
        ['Кол-во направлений', '1', '1-3', '3-5' ],
        ['Полный сбор негативных отзывов топ_10 Яндекс, Гугл', '-', 'да', 'да' ],
        ['Посев положительных отзывов, шт', '15', '30', '50' ],
        ['Официальные ответы на негативные отзывы', 'да', 'да', 'да' ],
        ['Мониторинг негативных отзывов', 'раз в месяц', 'раз в неделю', 'раз в три дня' ],
        ['Работа с удалением негативных отзывов', 'до 5 / мес', 'до 10 / мес', 'неограниченно' ],
        ['Работа с форумами', '-', 'да', 'да' ],
        ['Создание фотографий для отзывов', '-', 'да', 'да' ],
        ['Обработка фотографий для отзывов', '-', '-', 'да' ],
        ['Стоимость', '30 000 руб.', '50 000 руб.', '80 000  руб.' ],
    ];
    $data_mob = [
        [   
            'Лайт',
            'Одно направление',
            'Посев 15 положительных отзывов',
            'Официальные ответы на негативные отзывы',
            'Мониторинг негативных отзывов <br>раз в месяц',
            'Удаление нагативных отзывов — до&nbsp;5&nbsp;/&nbsp;месяц',
            '30 000 руб.'
        ],
        [   
            'Оптима',
            'Три направления',
            'Полный сбор негативных отзывов<br>топ_10 Яндекс, Гугл',
            'Посев 30 положительных отзывов',
            'Официальные ответы на негативные отзывы',
            'Мониторинг негативных отзывов <br>раз в неделю',
            'Удаление нагативных отзывов —<br>до 10 / месяц',
            'Работа  с формами',
            'Создание фотографий для отзывов',
            '50 000 руб.'
        ],
        [   
            'турбо',
            'Пять направлений',
            'Полный сбор негативных отзывов<br>топ_10 Яндекс, Гугл',
            'Посев 50 положительных отзывов',
            'Официальные ответы на негативные отзывы',
            'Мониторинг негативных отзывов<br>раз в три дня',
            'Удаление нагативных отзывов —<br>неограниченно',
            'Работа  с формами',
            'Создание фотографий для отзывов',
            'Обработка фотографий для отзывов',
            '80 000 руб.'
        ],
    ];
    
    $out = '<div class="table-price table-price_serm">';
    $out .= '<div class="table-price__title">Цены на услугу управления репутацией в интернете (SERM)</div>';

    $out .= '<div class="table-price__table table-price__table_mobile">';
    foreach ($data_mob as $key => $table) {
        $count_data = count($table);
        $out .= '<table>';
        foreach ($table as $key => $value2) {
            $btn = '';
            if ($key == $count_data-1 ) {
                $btn = '<a class="table-price__btn js-table-price-btn-mobile" href="#">Оставить заявку</a>';
            }
            if ($key == 0) {
                $out .= '<tr><th>'.$value2.'</th></tr>';
            } else {
                $out .= '<tr><td>'.$value2.$btn.'</td></tr>';
            }
        }
        $out .= '</table>';
    }
    $out .= '</div>';

    $out .= '<div class="table-price__table table-price__table_desktop">';
    $out .= '<table>';
    $out .= '<tr><th></th><th>Лайт</th><th>Оптима</th><th>Турбо</th></tr>';
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

