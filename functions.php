<?php
error_reporting(E_ALL);

require_once('wp_bootstrap_navwalker.php');

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
        wp_enqueue_style( 'seohelp-style-opensans','https://fonts.googleapis.com/css?family=Open+Sans:400,600i,700&amp;subset=cyrillic');
        wp_enqueue_style( 'seohelp-style-roboto',  'https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic');
        wp_enqueue_style( 'seohelp-style-roboto2', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=cyrillic');
        wp_enqueue_style( 'seohelp-style',         get_stylesheet_uri() );
        wp_enqueue_style( 'seohelp-style-sl',      get_template_directory_uri() . '/js/slick/slick.css');
        wp_enqueue_style( 'seohelp-style-fancy',   get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css');
        // wp_deregister_script('jquery');
        // wp_deregister_script('jquery-migrate');
        // wp_register_script('jquery', get_template_directory_uri().'/js/vendor/jquery-2.2.4.min.js', false, '2.2.4');
        // wp_enqueue_script('jquery');

    // wp_enqueue_script( 'seohelp-js-ym', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU', array(), '20160630', true );
        wp_enqueue_script( 'seohelp-js-bt',        get_template_directory_uri() . '/js/bootstrap.min.js', array(), '20160630', true );
        wp_enqueue_script( 'seohelp-js-sl',        get_template_directory_uri() . '/js/slick/slick.min.js', array('jquery'), '20160630', true );
        wp_enqueue_script( 'seohelp-js-mask',      get_template_directory_uri() . '/js/jquery.inputmask.bundle.min.js', array('jquery'), '20160630', true );
        wp_enqueue_script( 'seohelp-js-fancy',     get_template_directory_uri() . '/js/fancybox/jquery.fancybox.pack.js', array('jquery'), '20160630', true );
        wp_enqueue_script( 'seohelp-js-parallax',  get_template_directory_uri() . '/js/jquery.stellar.min.js', array('jquery'), '20160630', true );
        wp_enqueue_script( 'seohelp-js-custom',    get_template_directory_uri() . '/js/main.js', array('jquery'), '20160630', true );
        
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
            'footer' => __( 'Футер меню', 'seohelp' ), 
        ) 
    );
    if ( function_exists( 'add_image_size' ) ) { 
    //     add_image_size( 'middle', 300, 300, false ); 
        add_image_size( 'thumb1024', 1024 );
        // add_image_size( 'thumb1920', 1920 );

    }

}

add_action( 'after_setup_theme', 'new_setup' );

function custom_post_type() {

    $labels = array(
        'name'                => _x( 'Полезное', 'Post Type General Name', 'seohelp' ),
        'singular_name'       => _x( 'Полезное', 'Post Type Singular Name', 'seohelp' ),
        'menu_name'           => __( 'Полезное', 'seohelp' ),
        'parent_item_colon'   => __( 'Родит. Статья', 'seohelp' ),
        'all_items'           => __( 'Все Статьи', 'seohelp' ),
        'view_item'           => __( 'Смотреть Статью', 'seohelp' ),
        'add_new_item'        => __( 'Добавить новую Статью', 'seohelp' ),
        'add_new'             => __( 'Добавить новую', 'seohelp' ),
        'edit_item'           => __( 'Редактировать Статью', 'seohelp' ),
        'update_item'         => __( 'Обновить Статью', 'seohelp' ),
        'search_items'        => __( 'Искать Статью', 'seohelp' ),
        'not_found'           => __( 'Не найдено', 'seohelp' ),
        'not_found_in_trash'  => __( 'Не найдено в корзине', 'seohelp' ),
    );

    $args = array(
        'label'               => __( 'Полезное', 'seohelp' ),
        'description'         => __( '', 'seohelp' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', ),
        'taxonomies'          => array('post_tag'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'stati', $args );

    $labels = array(
        'name'                => _x( 'Портфолио', 'Post Type General Name', 'seohelp' ),
        'singular_name'       => _x( 'Портфолио', 'Post Type Singular Name', 'seohelp' ),
        'menu_name'           => __( 'Портфолио', 'seohelp' ),
        'parent_item_colon'   => __( 'Родит. Портфолио', 'seohelp' ),
        'all_items'           => __( 'Все Портфолио', 'seohelp' ),
        'view_item'           => __( 'Смотреть Портфолио', 'seohelp' ),
        'add_new_item'        => __( 'Добавить новою Портфолио', 'seohelp' ),
        'add_new'             => __( 'Добавить новою', 'seohelp' ),
        'edit_item'           => __( 'Редактировать Портфолио', 'seohelp' ),
        'update_item'         => __( 'Обновить Портфолио', 'seohelp' ),
        'search_items'        => __( 'Искать Портфолио', 'seohelp' ),
        'not_found'           => __( 'Не найдено', 'seohelp' ),
        'not_found_in_trash'  => __( 'Не найдено в корзине', 'seohelp' ),
    );

    $args = array(
        'label'               => __( 'Услуги', 'seohelp' ),
        'description'         => __( '', 'seohelp' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', ),
        'taxonomies'          => array('post_tag'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'portfolio', $args );

    $labels = array(
        'name'                => _x( 'Дополнительные услуги', 'Post Type General Name', 'seohelp' ),
        'singular_name'       => _x( 'Доп.услуга', 'Post Type Singular Name', 'seohelp' ),
        'menu_name'           => __( 'Доп.услуги', 'seohelp' ),
        'parent_item_colon'   => __( 'Родит. Доп.услуга', 'seohelp' ),
        'all_items'           => __( 'Все Доп.услуги', 'seohelp' ),
        'view_item'           => __( 'Смотреть Доп.услугу', 'seohelp' ),
        'add_new_item'        => __( 'Добавить новою Доп.услугу', 'seohelp' ),
        'add_new'             => __( 'Добавить новою', 'seohelp' ),
        'edit_item'           => __( 'Редактировать Доп.услугу', 'seohelp' ),
        'update_item'         => __( 'Обновить Доп.услугу', 'seohelp' ),
        'search_items'        => __( 'Искать Доп.услугу', 'seohelp' ),
        'not_found'           => __( 'Не найдено', 'seohelp' ),
        'not_found_in_trash'  => __( 'Не найдено в корзине', 'seohelp' ),
    );

    $args = array(
        'label'               => __( 'Доп.услуги', 'seohelp' ),
        'description'         => __( '', 'seohelp' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', ),
        'taxonomies'          => array('post_tag'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'uslugi', $args );

    // register_taxonomy('race-type', array('team-seohelp'), array(
    //     'labels'                => array(
    //         'name'              => 'Тип гонок',
    //         'singular_name'     => 'Тип гонок',
    //         'search_items'      => 'Искать Тип гонок',
    //         'all_items'         => 'Все Типы гонок',
    //         'parent_item'       => 'Родит. Тип гонок',
    //         'parent_item_colon' => 'Родит. Тип гонок:',
    //         'edit_item'         => 'Ред. Тип гонок',
    //         'update_item'       => 'Обновить Тип гонок',
    //         'add_new_item'      => 'Добавить Тип гонок',
    //         'new_item_name'     => 'Новый Тип гонок',
    //         'menu_name'         => 'Тип гонок',
    //     ),
    //     'description'           => 'Типы гонок',
    //     'public'                => true,
    //     'show_tagcloud'         => true,
    //     'hierarchical'          => true,
    //     'show_admin_column'     => true,
    // ) );    

}

add_action( 'init', 'custom_post_type', 0 );

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
    
    acf_add_options_page(array(
        'page_title'    => 'Настройки сайта',
        'menu_title'    => 'Настройки сайта',
        'redirect'  => false
    ));
    
}

// disable update plugin ACF

function filter_plugin_updates( $value ) {
    unset( $value->response['advanced-custom-fields-pro/acf.php'] );
    return $value;
}
add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );

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
    echo '[get_content_form] - Показать форму заявки на странице<br>';
    echo '[get_content_form title="Заказать перенос сайта"] - Показать форму заявки с новым заголовком<br>';
    echo '[get_team_about] - Показать блок "О НАС" с бегающими цифрами. Блок редактируется на странице <a href="'.home_url().'/wp-admin/admin.php?page=acf-options-nastrojki-sajta">Настройки сайта</a><br>';
    echo '[get_clients] - Показать блок с лого "Наши клиенты". Блок редактируется на странице <a href="'.home_url().'/wp-admin/admin.php?page=acf-options-nastrojki-sajta">Настройки сайта</a><br>';
    echo '<br>Сменить логотип, номер телефона, email, добавить коды счетчиков и сервисов на сайт можно на странице <a href="'.home_url().'/wp-admin/admin.php?page=acf-options-nastrojki-sajta">Настройки сайта</a>.<br>';
}

function get_portfolio($posts_per_page = -1) {
    $out = '<div class="portfolio">';
    $arg =  array(
        'orderby'      => 'menu_order',
        'order'        => 'ASC',
        'posts_per_page' => $posts_per_page,
        'post_type' => 'portfolio',
        'post_status' => 'publish',
    );
    $query = new WP_Query($arg);
    if ($query->have_posts() ):
        while ( $query->have_posts() ): 
            $query->the_post();
            if (!$folio_logo_color = get_field('folio_logo_color'))
                $folio_logo_color = "#fff";
            $folio_logo_bg = '';
            if ($arrFolio_logo_bg = get_field('folio_logo_bg'))
                $folio_logo_bg = ' url('.$arrFolio_logo_bg['sizes']['medium'].') center no-repeat; background-size: cover';
            $out .= '<div class="portfolio__item" data-aload style="background:'.$folio_logo_color.$folio_logo_bg.'">';
            $out .= '<a href="'.get_the_permalink().'" class="portfolio__link">';
            $out .= '<div class="portfolio__caption">'.get_the_title().'</div>';
            if (has_post_thumbnail())
                $out .= '<img src="'.wp_get_attachment_image_url(get_post_thumbnail_id(),'medium').'" alt="'.get_the_title().'" class="portfolio__img">';
            $out .= '</a>';
            $out .= '</div>';
        endwhile;
    endif;
    wp_reset_postdata();
    $out .= '</div>';
    echo $out;
}

// function get_tel_func( $atts, $content = '' ){
//     $out = $content;
//     return $out;
// }

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
    $out = '<div class="form-content">';
    $out .= '<div class="form-content__title">'.$title.'</div>';
    $out .= '<div class="form-content__body">'.do_shortcode('[contact-form-7 id="193" title="Форма в контенте"]').'</div>';
    $out .= '</div>';
    return $out;
}
add_shortcode('get_content_form', 'get_content_form_func');

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

?>
