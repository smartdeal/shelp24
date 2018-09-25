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