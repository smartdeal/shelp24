<?php
add_action( 'wp_head', 'seo_header_func' );

function seo_header_func(){
    $rating = get_google_rating();
    echo '<!-- seo -->';
    echo '
    <script type="application/ld+json">
    {
    "@context": "https://schema.org",
    "@type": "Organization",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "'.$rating['rating'].'",
        "reviewCount": "'.$rating['reviewCount'].'"
    },
    "url": "http://seohelp24.ru/",
    "name": "Seohelp24",
    "email": "order@seohelp24.ru",
    "logo": "http://seohelp24.ru/wp-content/uploads/2017/07/logo.png",
    "description": "Seohelp24 - создание и продвижение сайтов","address": {
    "@type": "PostalAddress",
    "addressLocality": "Москва, Россия",
    "streetAddress": "ул. Русаковская, д. 13, оф. 504"
    },
    "contactPoint" : [
    {
    "@type" : "ContactPoint",
    "telephone" : "+7 (499) 398-26-47",
    "contactType" : "customer service"
    },{
    "@type" : "ContactPoint",
    "telephone" : "+7 (926) 520-83-85",
    "contactType" : "customer service"
    }],
    "sameAs" : [
    "http://vk.com/seohelp24ru","https://www.facebook.com/seohelp24ru/","https://www.instagram.com/seohelp24ru/","https://www.youtube.com/channel/UC29sgAwCkl9prtSGnKHCuCQ"]	  
    }	  
    </script>    
    ';
/*
    "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.5",
    "reviewCount": "2"
    },
*/
    echo '<!-- / seo -->';
}

function the_seo_schema_article(){
    $img = get_the_post_thumbnail_url();
    if (!$img)
        $img = esc_url(get_template_directory_uri()) .'/wp-content/uploads/2017/07/logo.png';
    echo '
    <span class="hidden">
        <span itemprop="description">'.get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true).'</span>
        <span itemprop="datePublished">'.get_the_date('Y-m-d').'</span>
        <span itemprop="dateModified">'.get_the_modified_date('Y-m-d').'</span>
        <span itemprop="genre">Техническая</span>
        <span itemprop="author">Seohelp24</span>
        <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
            <div itemprop="logo image" itemscope itemtype="https://schema.org/ImageObject">
                <img itemprop="url contentUrl" src="'. $img .'" alt="logo" />
            </div>
            <meta itemprop="name" content="'. get_bloginfo('name') .'" />
            <meta itemprop="address" content="Москва ул. Русаковская, д. 13, оф. 504" />
            <meta itemprop="telephone" content="+7 (499) 398-26-47" />
        </div>						
        <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                <img itemprop="url contentUrl" src="'. $img .'" alt="logo" />
        </div>
        <link itemprop="mainEntityOfPage" href="'. get_the_permalink() .'">

    </span>
    ';    
}

function get_google_rating() {
    $api_key = 'AIzaSyAipiq2ljfyo4boIpjcTGl6IKVyVqsNrrg';
    $url = 'https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=Digital-%D0%B0%D0%B3%D0%B5%D0%BD%D1%82%D1%81%D1%82%D0%B2%D0%BE+Seohelp24&locationbias=circle:500@55.7840397,37.711602&inputtype=textquery&fields=name,rating,place_id&key='.$api_key;
    // $time_diff = 10;
    $time_diff = 24 * 60 * 60;
    $time_current = time();
    $data_rating = false;
    $data_placeid = '';
    $data_reviewcount = '15';
    $rating = array('rating' => '4.9', 'reviewCount' => $data_reviewcount);
    $data = get_option('seohelp_google_data');
    $data_time = intval($data['time']);
    if (!empty($data) && is_array($data) && ($time_current - $data_time < $time_diff)) {
        $data_placeid = $data['place_id'];
        $data_rating = $data['rating'];
        $data_reviewcount = $data['reviewCount'];
    } else {
        $json = file_get_contents($url);
        if ($json) {
            $json_d = json_decode($json);
            if ($json_d) {
                $data_placeid = $json_d->candidates[0]->place_id;
                $data_rating = $json_d->candidates[0]->rating;
                if (!empty($data_rating)) {
                    update_option('seohelp_google_data', array('place_id' => $data_placeid, 'rating' => $data_rating, 'reviewCount' => $data_reviewcount, 'time' => $time_current));
                }
            }
        }
    }
    $rating = array('rating' => $data_rating, 'reviewCount' => $data_reviewcount);
    return $rating;
}
function set_head_keywords() {
    $id = get_the_ID();
    if (!$id) return;
    $meta = get_post_meta( $id, '_yoast_wpseo_focuskw', true );
    echo '<meta name="keywords" content="'.$meta.'" />';
}
add_action( 'wp_head', 'set_head_keywords' );
