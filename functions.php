<?php
error_reporting(E_ALL);

require_once('wp_bootstrap_navwalker.php');
require_once('func/func_shortcodes.php');
require_once('func/func_custom_posts.php');
require_once('func/func_table_serm.php');
require_once('func/func_table_tech.php');
require_once('func/func_seo.php');
require_once('func/func_helper.php');

remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action ('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
add_filter('the_generator', '__return_empty_string');
remove_action( 'wp_head', 'dns-prefetch' );
remove_action( 'wp_head', 'wp_resource_hints', 2 );
add_filter( 'emoji_svg_url', '__return_false' );
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
add_filter( 'wpseo_canonical', '__return_false' );

function my_deregister_scripts(){
    wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

function footer_enqueue_scripts(){
    remove_action('wp_head','wp_print_scripts');
    remove_action('wp_head','wp_print_head_scripts',9);
    remove_action('wp_head','wp_enqueue_scripts',1);
    add_action('wp_footer','wp_print_scripts',5);
    add_action('wp_footer','wp_enqueue_scripts',5);
    add_action('wp_footer','wp_print_head_scripts',5);
}
add_action('after_setup_theme','footer_enqueue_scripts');

function seohelp_styles() {
    if ( ! is_admin() && ! is_login_page() ) {
        wp_enqueue_style( 'seohelp-style-main',    get_template_directory_uri() . '/css/main.css');
 
        wp_enqueue_style( 'seohelp-style-cust',    get_template_directory_uri() . '/css/custom.css');
    }
}

add_action( 'wp', 'seohelp_styles' );

function prefix_add_footer_styles() {
    if ( ! is_admin() && ! is_login_page() ) {
    }
}
add_action( 'get_footer', 'prefix_add_footer_styles' );

function my_admin_theme_style() {
    wp_enqueue_style('my-admin-style', get_template_directory_uri() . '/css/adminui.css');
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');

function seohelp_scripts() {

    if( !is_admin()){
        wp_enqueue_style( 'seohelp-style',         get_stylesheet_uri() );
        // wp_deregister_script('jquery-migrate');

        wp_enqueue_script( 'seohelp-js-bt',        get_template_directory_uri() . '/js/plugins.js', array('jquery'), '20170630', true );
        if (is_page_template('page-reviews.php')) wp_enqueue_script( 'seohelp-js-zoom',  get_template_directory_uri() . '/js/jquery.zoom.min.js', array('jquery'), '20170630', true );
        // if (is_page_template('page-contacts.php')) wp_enqueue_script( 'seohelp-js-map',  '', array(), '', true );
        wp_enqueue_script( 'seohelp-js-custom',    get_template_directory_uri() . '/js/main.js', array('jquery'), '20170630', true );


        $map_contact = array('lat' => get_field('option_map_lat','option'), 'long' => get_field('option_map_long','option'));
        wp_localize_script( 'seohelp-js-custom', 'map_contact', $map_contact );
        wp_localize_script( 'seohelp-js-custom', 'ajax_url', admin_url('admin-ajax.php') );
        wp_localize_script( 'seohelp-js-custom', 'user_ip', get_the_user_ip() );
        wp_localize_script( 'seohelp-js-custom', 'site_url', get_site_url_path() );
    }
}
add_action( 'wp_enqueue_scripts', 'seohelp_scripts' );

function new_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );
    register_nav_menus( array(
            'primary' => __( 'Главное меню', 'seohelp' ), 
            'secondary' => __( 'Второстепенное меню', 'seohelp' ), 
            'footer1' => __( 'Футер меню 1', 'seohelp' ),
            'footer2' => __( 'Футер меню 2', 'seohelp' ),
            'footer3' => __( 'Футер меню 3', 'seohelp' ),
            'footer_mob1' => __( 'Футер меню мобильное 1', 'seohelp' ),
            'footer_mob2' => __( 'Футер меню мобильное 2', 'seohelp' ),
             'portfolio' => __( 'Портфолио', 'seohelp' ),
        ) 
    );
    if ( function_exists( 'add_image_size' ) ) { 
        // add_image_size( 'middle', 270, 370, false ); 
        add_image_size( 'thumb1024', 1024 );
        // add_image_size( 'thumb1920', 1920 );

    }

}

add_action( 'after_setup_theme', 'new_setup' );

add_action('init', function () {
     add_rewrite_rule('portfolio/?$','index.php?pagename=portfolio', 'top');
     flush_rewrite_rules();
}, 1000);

function seohelp_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'News Sidebar', 'seohelp' ),
        'id'            => 'sidebar-news',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<div class="widget__title">',
        'after_title'   => '</div>',
    ) );
}
// add_action( 'widgets_init', 'seohelp_widgets_init' );

function is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

add_filter('excerpt_more', function($more) {return '...'; });

// show all tags in admin page
function wpse_64058_all_tags ( $args ) {
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_POST['action'] ) && $_POST['action'] === 'get-tagcloud' )
        unset( $args['number'] );
        $args['hide_empty'] = 0;
    return $args;
}

// show archive tags custom post
function wpa_cpt_tags( $query ) {
    if ( $query->is_tag() && $query->is_main_query() ) {
        $query->set( 'post_type', array( 'post', 'stati' ) );
    }
}
add_action( 'pre_get_posts', 'wpa_cpt_tags' );

add_filter( 'get_terms_args', 'wpse_64058_all_tags' );

## Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива
add_filter('get_the_archive_title', function( $title ){
    return preg_replace('~^[^:]+: ~', '', $title );
});

/* ********************************************* */
// Adding a rich text editor to Excerpt

add_action( 'add_meta_boxes', array ( 'T5_Richtext_Excerpt', 'switch_boxes' ) );

/**
 * Replaces the default excerpt editor with TinyMCE.
 */
class T5_Richtext_Excerpt
{
    /**
     * Replaces the meta boxes.
     *
     * @return void
     */
    public static function switch_boxes()
    {
        if ( ! post_type_supports( $GLOBALS['post']->post_type, 'excerpt' ) )
        {
            return;
        }

        remove_meta_box(
            'postexcerpt' // ID
        ,   ''            // Screen, empty to support all post types
        ,   'normal'      // Context
        );

        add_meta_box(
            'postexcerpt2'     // Reusing just 'postexcerpt' doesn't work.
        ,   __( 'Excerpt' )    // Title
        ,   array ( __CLASS__, 'show' ) // Display function
        ,   null              // Screen, we use all screens with meta boxes.
        ,   'normal'          // Context
        ,   'core'            // Priority
        );
    }

    /**
     * Output for the meta box.
     *
     * @param  object $post
     * @return void
     */
    public static function show( $post )
    {
    ?>
        <label class="screen-reader-text" for="excerpt"><?php
        _e( 'Excerpt' )
        ?></label>
        <?php
        // We use the default name, 'excerpt', so we don’t have to care about
        // saving, other filters etc.
        wp_editor(
            self::unescape( $post->post_excerpt ),
            'excerpt',
            array (
            'textarea_rows' => 15
        ,   'media_buttons' => FALSE
        ,   'teeny'         => TRUE
        ,   'tinymce'       => TRUE
            )
        );
    }

    /**
     * The excerpt is escaped usually. This breaks the HTML editor.
     *
     * @param  string $str
     * @return string
     */
    public static function unescape( $str )
    {
        return str_replace(
            array ( '&lt;', '&gt;', '&quot;', '&amp;', '&nbsp;', '&amp;nbsp;' )
        ,   array ( '<',    '>',    '"',      '&',     ' ', ' ' )
        ,   $str
        );
    }
}

if( function_exists('acf_add_options_page') ) {
    
    $parent = acf_add_options_page(array(
        'page_title'    => 'Настройки сайта',
        'menu_title'    => 'Настройки сайта',
        'redirect'  => false
    ));
    
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Шорткоды',
		'menu_title' 	=> 'Шорткоды',
		'parent_slug' 	=> $parent['menu_slug'],
	));
    
}

// disable update plugin ACF

function filter_plugin_updates( $value ) {
    unset( $value->response['advanced-custom-fields-pro/acf.php'] );
    return $value;
}
add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );

// Service menu
function the_service_menu(){
    $page_id = get_the_ID();
    $page_parent_first = $page_id;
    if (get_page_template_slug($page_id) != 'page-tpl-service.php') return;
    $page_parent = wp_get_post_parent_id($page_id);
    $args = array(
        'post_parent' => $page_id,
        'post_type'   => 'page', 
        'numberposts' => -1,
        'post_status' => 'publish' 
    );
    $page_children = get_children( $args );
    if (!$page_children && !$page_parent) return;
    if (!$page_children) {
        $args = array(
            'post_parent' => $page_parent,
            'post_type'   => 'page', 
            'numberposts' => -1,
            'post_status' => 'publish' 
        );
        $page_children = get_children( $args );
        $page_parent_first = $page_parent;
    }
    if ($page_children) {
        $out = '<div class="service-menu"><div class="service-menu__title">';
        if ($page_parent != 0) $out .= '<a href="'.get_permalink($page_parent_first).'">';
        $out .= get_the_title($page_parent_first);
        if ($page_parent != 0) $out .= '</a>';
        $out .= '</div>';
        $out .= '<ul class="service-menu__body">';
        foreach ($page_children as $key => $value) {
            $out .= '<li class="service-menu_item">';
            if ($value->ID != $page_id) $out .= '<a class="service-menu_link" href="'.get_permalink($value->ID).'">';
            $out .= $value->post_title;
            if ($value->ID != $page_id) $out .= '</a>';
            $out .= '</li>';
        }
        $out .= '</ul></div>';
        echo $out;
    }
}

// Add a widget to the dashboard.
function shortcodes_add_dashboard_widgets() {
    wp_add_dashboard_widget(
                 'shortcodes_dashboard_widget',         // Widget slug.
                 'Полезная информация',         // Title.
                 'shortcodes_dashboard_widget_function' // Display function.
        );  
}
add_action( 'wp_dashboard_setup', 'shortcodes_add_dashboard_widgets' );

function shortcodes_dashboard_widget_function() {
    echo 'Шорткоды для отображения информации в контенте страниц, записей и т.д.:<br>';
    echo '[get_tel] - Показать телефон студии<br>';
    echo '[get_email] - Показать email студии<br>';
    echo '[get_content_btns] - Показать кнопки Создать сайт и Продвинуть сайт<br>';
    echo '[get_content_form] - Показать форму заявки на странице<br>';
    echo '[get_content_form title="Заказать перенос сайта"] - Показать форму заявки с новым заголовком<br>';
    echo '[get_service_form] - Показать форму заявки услуги на странице<br>';
    echo '[get_service_form title="Закажите продвижение сайта!"] - Показать форму заявки услуги с новым заголовком<br>';
    echo '[get_service_result title="Результаты клиентов:"] - Показать результаты клиентов в услугах (параметр "title" опциональный)<br>';
    echo '[get_service_form lead="off"] - Показать форму заявки услуги без поля "С бесплатными целевыми посетителями"<br>';
    echo '[get_site_form] - Показать форму на услугу создания сайта,<br>возможные параметры:<br>[get_site_form<br>title="Закажите создание сайта прямо сейчас!"<br>cms="off"<br>type="off"<br>crm="off"<br>1c="off"<br>seo="off"<br>logo="off"<br>firma="off"<br>content="off"<br>]<br>';
    echo '[get_team_about] - Показать блок "О НАС" с бегающими цифрами. Блок редактируется на странице <a href="'.home_url().'/wp-admin/admin.php?page=acf-options-nastrojki-sajta">Настройки сайта</a><br>';
    echo '[get_clients] - Показать блок с лого "Наши клиенты". Блок редактируется на странице <a href="'.home_url().'/wp-admin/admin.php?page=acf-options-nastrojki-sajta">Настройки сайта</a><br>';
    echo '[get_reviews] - Показать блок с отзывами. Блок редактируется на странице <a href="'.home_url().'/wp-admin/post.php?post=104&action=edit">Дипломы и отзывы</a><br>';
    echo '[get_banner_check] [get_banner_report] [get_banner_audit] - Показать баннеры Чеклист и Пример отчета. Файлы добавляются на странице <a href="'.home_url().'/wp-admin/admin.php?page=acf-options-nastrojki-sajta">Настройки сайта</a><br>';
    echo '[get_banner title="Чек-лист" text="по SEO аудиту" file="путь к файлу"] - Универсальный баннер<br>';
    echo '[get_table_tech], [get_table_serm] - Показать прайс лист на услугу, редактирование на странице <a href="'.home_url().'/wp-admin/admin.php?page=acf-options-nastrojki-sajta">Настройки сайта</a><br>';
    echo '<br>Сменить логотип, номер телефона, email, добавить коды счетчиков и сервисов на сайт можно на странице <a href="'.home_url().'/wp-admin/admin.php?page=acf-options-nastrojki-sajta">Настройки сайта</a>.<br>';
}

function get_portfolio($posts_per_page = -1) {
    $arrPortfolio_tax = array();
    $arrPortfolio_tax_one = array();
    $out = '';
    $out_menu = '';
    $tax_name_main = '';
    $portfolio_full = false;
    if ($posts_per_page == -1) $portfolio_full = true;
    if ($portfolio_full) {
        $class_grid = ' portfolio_all js-portfolio-grid'; 
        $class_grid_item = ' portfolio__item_all';
    }
    else {
        $class_grid = ''; 
        $class_grid_item = ''; 
    }
    $arg =  array(
        'orderby'      => 'menu_order',
        'order'        => 'ASC',
        'posts_per_page' => $posts_per_page,
        'post_type' => 'portfolio',
        'post_status' => 'publish',

       
    );
    $query = new WP_Query($arg);
    if ($query->have_posts() ):
        $out .= '<div class="portfolio'.$class_grid.'">';
        while ( $query->have_posts() ): 
            $query->the_post();
            if (!$folio_logo_color = get_field('folio_logo_color'))
                $folio_logo_color = "#fff";
            $folio_logo_bg = '';
            if ($arrFolio_logo_bg = get_field('folio_logo_bg'))
                $folio_logo_bg = ' url('.$arrFolio_logo_bg['sizes']['medium'].') center no-repeat; background-size: cover';
            $port_tax = get_field('folio_type',get_the_ID());
            $class_tax = '';
            if ($port_tax) {
                foreach ($port_tax as $key => $value) {
                    $class_tax .= ' portfolio-tax-'.$value->slug;
                    $arrPortfolio_tax_one['id'] =   $value->term_id;
                    $arrPortfolio_tax_one['name'] = $value->name;
                    $arrPortfolio_tax_one['slug'] = $value->slug;
                    if (!in_array($arrPortfolio_tax_one, $arrPortfolio_tax)) {
                        $arrPortfolio_tax[] = $arrPortfolio_tax_one;
                    }
                }
            }
            $out .= '<div class="portfolio__item'.$class_grid_item.$class_tax.'" data-aload style="background:'.$folio_logo_color.$folio_logo_bg.'">';
            $out .= '<a href="'.get_the_permalink().'" class="portfolio__link" rel="nofollow">';
            $out .= '<div class="portfolio__caption">'.get_the_title().'</div>';
            $tax_name_main = get_field('folio_type_tile');
            if ($tax_name_main) $out .= '<div class="portfolio__tax-main">'.get_term($tax_name_main)->name.'</div>';
            $out .= '<div class="smotret">Смотреть кейс</div>';
            if (has_post_thumbnail())
                $out .= '<img src="'.wp_get_attachment_image_url(get_post_thumbnail_id(),'medium').'" alt="'.get_the_title().'" class="portfolio__img">';
            $out .= '</a>';
            $out .= '</div>';
        endwhile;
        $arrTmp=array();
        foreach($arrPortfolio_tax as $key=>$arr){
            $arrTmp[$key]=$arr['id'];
        }
        array_multisort( $arrTmp, SORT_NUMERIC, $arrPortfolio_tax); // сортирует Таксиномию по ИД
        $out .= '</div>';
        if ($portfolio_full) {
            $out_menu .= '<div class="portfolio-filter js-portfolio-filter" style="display:none;">';
            $out_menu .= '<div class="portfolio-filter__btn js-portfolio-filter-btn"><span></span><span></span><span></span></div>';
            $out_menu .= '<div class="portfolio-menu">';
            $out_menu .= '<a href="#" class="portfolio-menu__link js-portfolio-btn" data-filter=".portfolio__item">Все работы</a>';
            foreach ($arrPortfolio_tax as $key => $value) {
                $out_menu .= '<a href="#" class="portfolio-menu__link js-portfolio-btn" data-filter=".portfolio-tax-'.$value['slug'].'">'.$value['name'].'</a>';
            }
            $out_menu .= '</div>';
            $out_menu .= '</div>';
        }
        $out = '<div class="portfolio__wrapper">'.$out_menu.$out.'</div>';
    endif;
    wp_reset_postdata();
    echo $out;
}

function mytheme_comment($comment, $args, $depth){
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>">
    <div class="comment-author vcard">
        <?php echo get_avatar( $comment, $size='48', $default='<path_to_url>' ); ?>

        <cite class="fn"><?php echo get_comment_author_link() ?></cite>:
        <?php edit_comment_link('(Редактировать)', '  ', '') ?>
    </div>
    <?php if ($comment->comment_approved == '0') : ?>
        <em>Ваш комментарий ожидает проверки.</em>
        <br />
    <?php endif; ?>

    <?php comment_text() ?>

    <div class="reply">
        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </div>
    </div>
<?php
}

add_filter( 'comment_form_submit_button', function( $submit_button, $args )
{
    // Override the submit button HTML:
    $button = '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn" value="%4$s" />';

    return sprintf(
        $button,
        esc_attr( $args['name_submit'] ),
        esc_attr( $args['id_submit'] ),
        esc_attr( $args['class_submit'] ),
        esc_attr( $args['label_submit'] )
     );

}, 10, 2 );

function acf_load_folio_type_tile_choices( $field ) {
    
    $field['choices'] = array();
    $choices = get_field('folio_type', false, false);
    if( is_array($choices) ) {
        foreach( $choices as $choice ) {
            $field['choices'][ $choice ] = get_term($choice)->name;
        }
        
    }
    return $field;
}

add_filter('acf/load_field/name=folio_type_tile', 'acf_load_folio_type_tile_choices');

// обязательный для темы плагин kama thumbnail
if( ! is_admin() && ! function_exists('kama_thumb_img') ){
    add_action( 'admin_notices', function(){
        echo '<div class="error"><p>'. __( 'This theme requires plugin Kama Thumbnail. Install it please.', 'dom' ) .'</p></div>';
    } );

    function kama_thumb_src(){}

    function kama_thumb_img(){}

    function kama_thumb_a_img(){}

    function kama_thumb(){}
}

// add_action('wpcf7_mail_sent', function ($cf7) {
    // Run code after the email has been sent
// });

// add_filter( 'wpcf7_skip_mail',  '__return_true' );

// function get_tel_func( $atts, $content = '' ){
//     $out = $content;
//     return $out;
// }

// Move Yoast to bottom
function yoasttobottom() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

function artabr_opengraph_fix_yandex($lang) {
    $lang_prefix = 'prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article#  profile: http://ogp.me/ns/profile# fb: http://ogp.me/ns/fb#"';
    $lang_fix = preg_replace('!prefix="(.*?)"!si', $lang_prefix, $lang);
    return $lang_fix;
    }
add_filter( 'language_attributes', 'artabr_opengraph_fix_yandex',20,1);

class Texas_Ranger extends Walker_Nav_Menu {

    /**
     * Building the List Item element
     * @param Referenced string $output
     * @param Post Object $item
     * @param int $depth
     * @param array $args
     * @return void
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent         = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );

        // Passed Classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // build html
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . '">';
        $item_page_id = get_post_meta( $item->ID, '_menu_item_object_id', true );

        // If 'noLink' exists in classes, don't HTML anchor tag.
        $is_cat = false;
        if( is_category( $category ) ){
            $category = get_the_category(); 
            if ($category[0]->cat_ID == $item_page_id) $is_cat = true;
        }
        if( $item_page_id == get_the_ID() || $is_cat ) {

            // $item_output = sprintf( '<span>$1$s</span>',apply_filters( 'the_title', $item->title, $item->ID ) );
            $item_output = '<span>'.apply_filters( 'the_title', $item->title, $item->ID ).'</span>';

        } else {

            // link attributes
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

            $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
                $args->before,
                $attributes,
                $args->link_before,
                apply_filters( 'the_title', $item->title, $item->ID ),
                $args->link_after,
                $args->after
            );
        }

        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

function the_roll(){
    $roll = get_field('roll_items','option');
    if ( empty($roll) ) return;
    $out = '<div class="roll">';
    $out .= '<div class="roll__drum js-roll-drum">';
    foreach ($roll as $key => $value) {
        $out .= '<div class="roll__item">';
        $out .= $value['roll_txt'];
        $out .= '</div>';
    }
    $out .= '</div>';
    $out .= '<div class="roll__center"></div><div class="roll__marker"></div>';
    $out .= '</div>';
    echo $out;
}

add_filter('tablepress_print_name_html_tag','tablepress_print_name_html_tag_call');
function tablepress_print_name_html_tag_call(){
    return 'h3';
}

add_action( 'wp_ajax_ajax_ruler_to_log',        'ajax_ruler_to_log_callback' ); // For logged in users
add_action( 'wp_ajax_nopriv_ajax_ruler_to_log', 'ajax_ruler_to_log_callback' ); // For anonymous users

function get_site_url_path() {
    global $wp;
    return home_url( $wp->request );
}

function get_the_user_ip() {
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
    //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
    //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return apply_filters( 'wpb_get_ip', $ip );
}

function ajax_ruler_to_log_callback() {
    $time = time();
    $user_ip = $_POST['user_ip'];
    $site_url = $_POST['site_url'];
    $agent = $_SERVER['HTTP_USER_AGENT'];
    file_put_contents(get_home_path().'/ruler.log', date("d.m.Y H:i", $time+3*3600).' :: '.$user_ip.' :: '.$site_url.' :: '.$agent.PHP_EOL, FILE_APPEND);
    wp_send_json( $user_ip.'-'.$site_url.'-'.get_home_path() );
}



//Загрузка изображений в формате webp

function webp_upload_mimes( $existing_mimes ) {
    // add webp to the list of mime types
    $existing_mimes['webp'] = 'image/webp';

    // return the array back to the function with our added mime type
    return $existing_mimes;
}
add_filter( 'mime_types', 'webp_upload_mimes' );



/*** Функция вывода rel="canonical" ***/
/*remove_action('wp_head', 'rel_canonical');
function mayak_wp_canonical(){
if ( !is_singular() )
        return;
    global $wp_the_query;
    if ( !$id = $wp_the_query->get_queried_object_id() )
        return;
    $link = get_permalink( $id );
    if ( $page = get_query_var('cpage') )
        $link = get_comments_pagenum_link( $page );
    echo "<link rel='canonical' href='$link' />\n";
}
add_action('wp_head', 'mayak_wp_canonical',3);
function mayak_canonical(){
        if (is_home() ) {
            $mayak_chief_link = get_option('home');
            $mayak_home_link = mayak_link_paged($mayak_chief_link);
            {
        echo "".'<link rel="canonical" href="'.$mayak_home_link.'" />'."\n";
    }
} else if (is_category()) {
            $mayak_cat_link = get_category_link(get_query_var('cat'));
            $mayak_category_link = mayak_link_paged($mayak_cat_link);
            {
        echo "".'<link rel="canonical" href="'.$mayak_category_link.'" />'."\n";
    }
} else if (function_exists('is_tag') && is_tag()){
            $tag = get_term_by('slug',get_query_var('tag'),'post_tag');
        if (!empty($tag->term_id)) {
            $tag_link = get_tag_link($tag->term_id);
            }
            $mayak_tag_link = mayak_link_paged($tag_link);
            $mayak_tag_link = trailingslashit($mayak_tag_link);
           {
        echo "".'<link rel="canonical" href="'.$mayak_tag_link.'" />'."\n";
    }
} else if (is_author()){
            global $cache_userdata;
            $userid = get_query_var('author');
            $mayak_auth_link = get_author_posts_url ( 'ID' );
        $mayak_author_link = mayak_link_paged($mayak_auth_link);
        {
        echo "".'<link rel="canonical" href="'.$mayak_author_link.'" />'."\n";
    }
}
else if (is_date()){
if (get_query_var('m')) {
                $m = preg_replace('/[^0-9]/', '', get_query_var('m'));
                switch (strlen($m)) {
                    case 0:
                        $mayak_date_link = get_year_link($m);
                        $mayak_date_link = mayak_link_paged( $mayak_date_link );
                        break;
                    case 1:
                        $mayak_date_link = get_month_link(substr($m, 0, 4), substr($m, 4, 2));
                        $mayak_date_link = mayak_link_paged( $mayak_date_link );
                        break;
                    case 2:
                        $mayak_date_link = get_day_link( substr($m, 0, 4), substr($m, 4, 2), substr($m, 6, 2));
                        $mayak_date_link = mayak_link_paged( $mayak_date_link );                    
                        break;
                    default:
                        $mayak_date_link = '';
                }
                }
                if (is_day()) {
                $mayak_date_link = get_day_link(get_query_var('year'),  get_query_var('monthnum'), get_query_var('day'));
                $mayak_date_link = mayak_link_paged($mayak_date_link);                  
            } else if (is_month()) {
                $mayak_date_link = get_month_link(get_query_var('year'), get_query_var('monthnum'));
                $mayak_date_link = mayak_link_paged($mayak_date_link);                    
            } else if (is_year()) {
                $mayak_date_link = get_year_link(get_query_var('year'));
                $mayak_date_link = mayak_link_paged($mayak_date_link);
            }
        {
        echo "".'<link rel="canonical" href="'.$mayak_date_link.'" />'."\n";
        }
    }
}
function mayak_link_paged($link) {
            $mayak_page = get_query_var('paged');
            $mayak_check = function_exists('user_trailingslashit');
        if ($mayak_page && $mayak_page > 1) {
            $link = trailingslashit($link);
            if ($mayak_check) {
                $link = user_trailingslashit($link, 'paged');
            } else {
                $link .= '/';
            }
        }
            return $link;
    }
add_action('wp_head', 'mayak_canonical');
 */
/*** Конец функции вывода rel="canonical" ***/

