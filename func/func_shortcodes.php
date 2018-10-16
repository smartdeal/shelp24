<?php

function sc_banner_func( $atts ){
	$atts = shortcode_atts( array(
		'id' => 1,
    ), $atts );    
    $out = '';
    $code = get_field('sc_banner','option');
    if ( !$code || !is_array($code) || !isset($code[$atts['id']-1])) return;
    $banner = $code[$atts['id']-1];
    $out .= '<div class="sc-banner" style="background-image:url('.kama_thumb_src( array('src' => $banner['img']['url'], 'w' => 1080, ) ).')">';
    $out .= '<div class="sc-banner__title">'.$banner['title'].'</div>';
    $out .= '<ul class="sc-banner__list">';
    foreach ($banner['list'] as $value) {
        $out .= '<li>'.$value['text'];
    }
    $out .= '</ul>';
    $out .= '</div>';
    return $out;
}
add_shortcode('sc_banner', 'sc_banner_func');

function sc_include_func( $atts ){
	$atts = shortcode_atts( array(
		'id' => 1,
    ), $atts );    
    $out = '';
    $code = get_field('sc_include','option');
    if ( !$code || !is_array($code) || !isset($code[$atts['id']-1])) return;
    $banner = $code[$atts['id']-1];
    $out .= '<div class="sc-include">';
    $out .= '<div class="sc-include__title">'.$banner['title'].'</div>';
    $out .= '<div class="sc-include__list">';
    foreach ($banner['list'] as $value) {
        $out .= '<div class="sc-include__item">';
        $out .= '<div class="sc-include__img"><img src="'.$value['img']['sizes']['thumbnail'].'" alt=""></div>';
        $out .= '<div class="sc-include__caption">'.$value['title'].'</div>';
        $out .= '<div class="sc-include__text">'.$value['text'].'</div>';
        $out .= '</div>';
    }
    $out .= '</div>';
    $out .= '</div>';
    return $out;
}
add_shortcode('sc_include', 'sc_include_func');


function sc_works_func( $atts ){
	$atts = shortcode_atts( array(
		'id' => 1,
    ), $atts );    
    $out = '';
    $code = get_field('sc_works','option');
    if ( !$code || !is_array($code) || !isset($code[$atts['id']-1])) return;
    $banner = $code[$atts['id']-1];
    $out .= '<div class="sc-works">';
    $out .= '<div class="sc-works__title">'.$banner['title'].'</div>';
    $out .= '<div class="sc-works__list">';
    foreach ($banner['list'] as $value) {
        $out .= '<div class="sc-works__item"><div class="sc-works__inner">';
        if (!empty($value['text'])) {
            $out .= '<a href="'.$value['text'].'">';
        }
        $out .= '<img src="'.kama_thumb_src( array('src' => $value['img']['url'], 'w' => 200, ) ).'" alt="">';
        if (!empty($value['text'])) {
            $out .= '</a>';
        }
        $out .= '</div></div>';
    }
    $out .= '</div>';
    $out .= '</div>';
    return $out;
}
add_shortcode('sc_works', 'sc_works_func');

function sc_bonus_func( $atts ){
	$atts = shortcode_atts( array(
		'id' => 1,
    ), $atts );    
    $out = '';
    $code = get_field('sc_bonus','option');
    if ( !$code || !is_array($code) || !isset($code[$atts['id']-1])) return;
    $banner = $code[$atts['id']-1];
    $out .= '<div class="sc-bonus">';
    $out .= '<div class="sc-bonus__left">';
    if (!empty($banner['img'])) {
        $out .= '<img src="'.$banner['img']['sizes']['large'].'" alt="">';
    }
    $out .= '<div class="sc-bonus__title">'.$banner['title'].'</div>';
    $out .= '</div>';
    $out .= '<div class="sc-bonus__list">';
    foreach ($banner['list'] as $value) {
        $out .= '<div class="sc-bonus__item">';
        $out .= '<div class="sc-bonus__caption">'.$value['title'].'</div>';
        $out .= '<div class="sc-bonus__text">'.$value['text'].'</div>';
        $out .= '</div>';
    }
    $out .= '</div>';
    $out .= '</div>';
    return $out;
}
add_shortcode('sc_bonus', 'sc_bonus_func');

function get_service_result_func( $atts ){
    $out = '';
    if (is_array($atts) && array_key_exists('title', $atts) && $atts['title'] != '') $title = $atts['title'];
        else $title = 'Результаты наших клиентов';

    $arg =  array(
        'posts_per_page'=> 100,
        'post_type'     => 'portfolio',
        'post_status'   => 'publish',
    );
    
    if ( !empty($atts) && isset($atts['ids']) ) {
        $arr_ids = explode(',', $atts['ids']);
        $arg['post__in'] = $arr_ids;
    } else {
        $arg['tag_id'] = 7; // Категория "Продвижение"
        $arg['orderby'] = 'menu_order';
        $arg['order'] = 'ASC';
    }
    
    $query = new WP_Query($arg);
    if ($query->have_posts() ):
        $out .= '<div class="b-result">';
        $out .= '<div class="b-result__title">'.$title.'</div><div class="b-result__body js-result-slider">';
        while ( $query->have_posts() ): 
            $query->the_post();
            if (!$folio_logo_color = get_field('folio_logo_color'))
                $folio_logo_color = "#fff";
            $folio_logo_bg = '';
            if ($arrFolio_logo_bg = get_field('folio_logo_bg'))
                $folio_logo_bg = ' url('.$arrFolio_logo_bg['sizes']['medium'].') center no-repeat; background-size: cover';

            $folio_res_check = get_field('folio_res_check');
            if (!is_null($folio_res_check) && $folio_res_check[0] == 'yes') continue;
            $out .= '<div class="b-result__item"><div class="b-result__top"><div class="b-result__desc">';
            $out .= '<div class="b-result__name">'.get_the_title().'</div>';
            if ($folio_res_desc = get_field('folio_res_desc'))
                $out .= '<div class="b-result__txt">'.$folio_res_desc.'</div>';
            $out .= '</div>';
            if ($folio_res_txt = get_field('folio_res_txt'))
                $out .= '<div class="b-result__middle">'.$folio_res_txt.'</div>';
            $out .= '<div class="b-result__graf">';

            $folio_request_before = get_field('folio_res_graf_before');
            $folio_request_after = get_field('folio_res_graf_after');
            
            if ($folio_request_before != '' && $folio_request_after != ''):
                $out .= '<div class="case-result__graf"><div class="case-result__chart"><div class="case-chart">';
                $digit_height_request_max = 100; // max height request's block
                $digit_request_max = max($folio_request_after, $folio_request_before); 
                $out .= '<div class="case-chart__before">';
                $out .= '<div class="case-chart__before-request" style="height:'.round($digit_height_request_max * $folio_request_before / $digit_request_max ).'px"></div>';
                $out .= '<div class="case-chart__after-request" style="height:'.round($digit_height_request_max * $folio_request_after / $digit_request_max ).'px"></div>';
                $out .= '</div></div></div>';
                $out .= '<div class="case-result__txt"><span class="case-result__caption">до</span><span class="case-result__caption">после</span></div>';
                $out .= '</div>';
            endif;

            if ($folio_res_graf =get_field('folio_res_graf'))
                $out .= '<div class="b-result__graf-txt">'.$folio_res_graf.'</div>';
            $out .= '</div>';
            $out .= '</div>';
            $out .= '<div class="b-result__bottom">';

            $out .= '<div class="b-result__pic" data-aload style="background:'.$folio_logo_color.$folio_logo_bg.'">';
            $out .= '<a href="'.get_the_permalink().'" class="b-result__link">';
            if (has_post_thumbnail())
                $out .= '<img src="'.kama_thumb_src( array('src' => wp_get_attachment_image_url(get_post_thumbnail_id(),'full'), 'w' => 180, ) ).'" alt="'.get_the_title().'" class="b-result__img">';
            $out .= '</a>';
            $out .= '</div>';

            $folio_stage_img = '';
            $folio_stage = get_field('folio_stage');
            if ($folio_stage):
                foreach ($folio_stage as $key => $value) {
                    if ($value['folio_stage_img'])
                        $folio_stage_img = $value['folio_stage_img']['sizes']['large'];
                }
            endif;

            if ($folio_stage_img)
                $out .= '<div class="b-result__res-img"><img data-aload="'.kama_thumb_src( array('src' => $folio_stage_img, 'w' => 649, ) ).'" alt=""></div>';

            $out .= '</div>';
            $out .= '</div>';
        endwhile;
        $out .= '</div></div>';
    endif;
    wp_reset_postdata();
    return $out;
}
add_shortcode('get_service_result', 'get_service_result_func');

function get_tel_func( $atts ){
    if ($main_tel = get_field('option_tel','option')) $out = $main_tel;
        else $out = '';
    return $out;
}
add_shortcode('get_tel', 'get_tel_func');

function get_email_func( $atts ){
    if ($main_email = get_field('option_email','option')) $out = $main_email;
        else $out = '';
    return $out;
}
add_shortcode('get_email', 'get_email_func');

function get_content_form_func( $atts ){
    if ($atts['title'] != '') $title = $atts['title'];
        else $title = 'Заказать звонок.';
    $out = '<div class="form-content form-wrap js-form-wrap">';
    $out .= '<div class="form-content__title">'.$title.'</div>';
    $out .= '<div class="form-content__body">'.do_shortcode('[contact-form-7 id="193" title="Форма в контенте"]').'</div>';
    $out .= '<div class="form-sent-ok js-form-sent-ok"><div class="form-sent-ok__inner"><div class="form-sent-ok__title">Спасибо!</div><div class="form-sent-ok__subtitle">Заявка принята. Наш специалист позвонит Вам.</div></div></div>';
    $out .= '</div>';
    return $out;
}
add_shortcode('get_content_form', 'get_content_form_func');

function get_service_form_func( $atts ){
    if (is_array($atts) && array_key_exists('title', $atts) && $atts['title'] != '') $title = $atts['title'];
        else $title = 'Заказать звонок';
    if (is_array($atts) && array_key_exists('lead', $atts) && $atts['lead'] == 'off') $class_lead = ' form-content_without-lead';
        else $class_lead = '';
    $out = '<div class="form-content form-content_service'.$class_lead.' form-wrap js-form-wrap">';
    $out .= '<div class="form-content__title">'.$title.'</div>';
    $out .= '<div class="form-content__body">'.do_shortcode('[contact-form-7 id="517" title="Форма в услугах"]').'</div>';
    $out .= '<div class="form-sent-ok js-form-sent-ok"><div class="form-sent-ok__inner"><div class="form-sent-ok__title">Спасибо!</div><div class="form-sent-ok__subtitle">Заявка принята. Наш специалист позвонит Вам.</div></div></div>';
    $out .= '</div>';
    return $out;
}
add_shortcode('get_service_form', 'get_service_form_func');

function get_site_form_func( $atts ){
    $class_add = '';
    if (is_array($atts)){
        if (array_key_exists('title', $atts) && $atts['title'] != '') $title = $atts['title'];
        else $title = 'Закажите создание сайта прямо сейчас!';

        $fields_names = ['cms','type','crm','1c','seo','logo','firma','content'];
        foreach ($fields_names as $name) {
            if (array_key_exists($name, $atts) && $atts[$name] == 'off') 
                $class_add .= ' form-content_without-'.$name;
        }
    } 
    $out = '<div class="form-content form-content_site '.$class_add.' form-wrap js-form-wrap">';
    $out .= '<div class="form-content__title">'.$title.'</div>';
    $out .= '<div class="form-content__body">'.do_shortcode('[contact-form-7 id="7190" title="Форма заказать сайт"]').'</div>';
    $out .= '<div class="form-sent-ok js-form-sent-ok"><div class="form-sent-ok__inner"><div class="form-sent-ok__title">Спасибо!</div><div class="form-sent-ok__subtitle">Заявка принята. Наш специалист позвонит Вам.</div></div></div>';
    $out .= '</div>';
    return $out;
}
add_shortcode('get_site_form', 'get_site_form_func');

function get_review_form_func( $atts ){
    if ($atts['title'] != '') $title = $atts['title'];
        else $title = 'Оставить отзыв';
    $out = '<div class="form-content form-content_review">';
    $out .= '<div class="form-content__title">'.$title.'</div>';
    $out .= '<div class="form-content__body">'.do_shortcode('[contact-form-7 id="713" title="Форма Оставить отзыв"]').'</div>';
    $out .= '</div>';
    return $out;
}
add_shortcode('get_review_form', 'get_review_form_func');

function get_contact_form_func( $atts ){
    $out = '<div class="form-content form-content_contact">';
    $out .= '<div class="form-content__body">'.do_shortcode('[contact-form-7 id="771" title="Форма Контакты"]').'</div>';
    $out .= '</div>';
    return $out;
}
add_shortcode('get_contact_form', 'get_contact_form_func');

function get_seo_standart_func( $atts ){
    $out = '<div class="seost">';
    if ($title = get_field('seost_title','option'))
        $out .= '<div class="seost__title">'.$title.'</div>';
    if ($subtitle = get_field('seost_subtitle','option'))
    $out .= '<div class="seost__subtitle">'.$subtitle.'</div>';
    $files = get_field('seost_files','option');
    if ($files) {
        $first = true;
        $out .= '<div class="seost__files">';
        foreach ($files as $key => $value) {
            if ($first) $btn_class = ' btn_darkgrey';
                    else  $btn_class = '';
            $first = false;
            $out .= '<a href="'.$value['seost_file'].'" class="seost__file btn'.$btn_class.'" target="_blank">'.$value['seost_btn'].'</a>';
        }
        $out .= '</div>';
    }
    $out .= '</div>';
    return $out;
}
add_shortcode('get_seo_standart', 'get_seo_standart_func');

function get_team_about_func( $atts ){
    ob_start();
    get_template_part( 'inc/tpl-team-about' );
    $out = ob_get_contents();
    ob_end_clean();
    return $out;
}
add_shortcode('get_team_about', 'get_team_about_func');

function get_clients_func( $atts ){
    ob_start();
    get_template_part( 'inc/tpl-slider-clients-logo' );
    $out = ob_get_contents();
    ob_end_clean();
    return $out;
}
add_shortcode('get_clients', 'get_clients_func');

function get_why_func( $atts ){
    ob_start();
    get_template_part( 'inc/tpl-why-we' );
    $out = ob_get_contents();
    ob_end_clean();
    return $out;
}
add_shortcode('get_why', 'get_why_func');

function get_content_btns_func( $atts ){
    $out = '';
    $out .= '<div class="content-btns">';
    $out .= '<div class="content-btns__btns">';
    $out .= '<div class="content-btns__btn content-btns__btn_create js-content-btns-btn">Создать сайт</div>';
    $out .= '<div class="content-btns__btn content-btns__btn_seo js-content-btns-btn">Продвинуть сайт</div>';
    $out .= '</div>';
    $out .= '<div class="content-btns__form js-content-btns-form form-wrap js-form-wrap">';
    $out .= do_shortcode('[contact-form-7 id="6043" title="Форма создать сайт на главной"]');
    $out .= '<div class="form-sent-ok js-form-sent-ok"><div class="form-sent-ok__inner"><div class="form-sent-ok__title">Спасибо!</div><div class="form-sent-ok__subtitle">Заявка принята. Наш специалист позвонит Вам.</div></div></div>';
    $out .= '</div>';
    $out .= '</div>';
    return $out;
}
add_shortcode('get_content_btns', 'get_content_btns_func');

function get_banner_func( $atts ){
    if ($atts && is_array($atts) && isset($atts['file']) && !empty($atts['file']))
        $url = $atts['file'];
    else
        $url = get_field('option_bn_check','option');

    $title = 'Чек-лист';
    $text = 'по SEO аудиту сайта';
    if (!$url) $url = "#";

    if ($atts && is_array($atts) && isset($atts['title']) && !empty($atts['title']))
        $title = $atts['title'];

    if ($atts && is_array($atts) && isset($atts['text']) && !empty($atts['text']))
        $text = $atts['text'];

    $out = '<div class="bnr bnr_html"><a href="'.$url.'" target="_blank">';
    $out .= '<div class="bnr__inner">';
    $out .= '<div class="bnr__title"><span>'.$title.'</span></div>';
    $out .= '<div class="bnr__text">'.$text.'</div>';
    $out .= '<div class="bnr__img"><img src="'.get_template_directory_uri().'/img/bn-check-img1.jpg" alt=""></div>';
    $out .= '<div class="bnr__btn">Смотреть '.$title.'</div>';
    $out .= '</div>';
    $out .= '</a></div>';
    return $out;
}
add_shortcode('get_banner', 'get_banner_func');

function get_banner_check_func( $atts ){
    if ($atts && is_array($atts) && isset($atts['file']) && !empty($atts['file']))
        $url = $atts['file'];
    else
        $url = get_field('option_bn_check','option');
    if ($atts && is_array($atts) && isset($atts['text']) && !empty($atts['text']))
        $text = $atts['text'];
    else
        $text = 'по SEO аудиту сайта';
    if (!$url) $url = "#";
    $title = "Чек-лист";
    $out = '<div class="bnr bnr_html"><a href="'.$url.'" target="_blank">';
    // $out .= '<img src="'.get_template_directory_uri().'/img/bn-check.jpg" alt="">';
    $out .= '<div class="bnr__inner">';
    $out .= '<div class="bnr__title"><span>'.$title.'</span></div>';
    $out .= '<div class="bnr__text">'.$text.'</div>';
    $out .= '<div class="bnr__img"><img src="'.get_template_directory_uri().'/img/bn-check-img1.jpg" alt=""></div>';
    $out .= '<div class="bnr__btn">Смотреть '.$title.'</div>';
    $out .= '</div>';
    $out .= '</a></div>';
    return $out;
}
add_shortcode('get_banner_check', 'get_banner_check_func');

function get_banner_report_func( $atts ){
    $url = get_field('option_bn_report','option');
    if (!$url) $url = "#";
    $out = '<div class="bnr"><a href="'.$url.'" target="_blank">';
    $out .= '<img src="'.get_template_directory_uri().'/img/bn-report.jpg" alt="">';
    $out .= '</a></div>';
    return $out;
}
add_shortcode('get_banner_report', 'get_banner_report_func');

function get_banner_audit_func( $atts ){
	$url = get_field('option_bn_audit','option');
	if (!$url) $url = "#";
    $out = '<div class="bnr"><a href="'.$url.'" target="_blank">';
    $out .= '<img src="'.get_template_directory_uri().'/img/bn-audit.jpg" alt="">';
    $out .= '</a></div>';
    return $out;
}
add_shortcode('get_banner_audit', 'get_banner_audit_func');

function get_reviews_func( $atts ){
    $reviews_page_id = 104;
    $out = '';
    $reviews =  get_field('review_imgs', $reviews_page_id); 
    if (is_array($reviews)) {
        $out .= '<div class="b-widget-reviews">';
        $out .= '<div class="b-widget-reviews__title">Отзывы</div>';
        $out .= '<div class="b-widget-reviews__items js-widget-reviews swiper-container"><div class="swiper-wrapper">';
        foreach ($reviews as $key => $value):
            $out .= '<div class="b-widget-reviews__item swiper-slide">'; // kama_thumb_src( array('src' => $value['url'], 'w' => 270, 'h' => 370, ) ); 
            $out .= '<a href="'.get_permalink($reviews_page_id).'"><img class="b-widget-reviews__img" src="'.$value['sizes']['medium'].'"></a>';
            $out .= '</div>';
        endforeach;
        $out .= '</div></div></div>';
    }
    return $out;
}
add_shortcode('get_reviews', 'get_reviews_func');