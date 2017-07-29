<?php
error_reporting(E_ALL);

require_once('wp_bootstrap_navwalker.php');

remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

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
        add_image_size( 'thumb1920', 1920 );

    }

}

add_action( 'after_setup_theme', 'new_setup' );

function custom_post_type() {

    $labels = array(
        'name'                => _x( 'Позиции', 'Post Type General Name', 'seohelp' ),
        'singular_name'       => _x( 'Позиция', 'Post Type Singular Name', 'seohelp' ),
        'menu_name'           => __( 'Команда seohelp', 'seohelp' ),
        'parent_item_colon'   => __( 'Родит. Позиция', 'seohelp' ),
        'all_items'           => __( 'Все Позиции', 'seohelp' ),
        'view_item'           => __( 'Смотреть Позиции', 'seohelp' ),
        'add_new_item'        => __( 'Добавить новую Позицию', 'seohelp' ),
        'add_new'             => __( 'Добавить новую', 'seohelp' ),
        'edit_item'           => __( 'Редактировать Позицию', 'seohelp' ),
        'update_item'         => __( 'Обновить Позицию', 'seohelp' ),
        'search_items'        => __( 'Искать Позицию', 'seohelp' ),
        'not_found'           => __( 'Не найдено', 'seohelp' ),
        'not_found_in_trash'  => __( 'Не найдено в корзине', 'seohelp' ),
    );

    $args = array(
        'label'               => __( 'Команда seohelp', 'seohelp' ),
        'description'         => __( '', 'seohelp' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', ),
        'taxonomies'          => array('race-type'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 24,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'team-seohelp', $args );

    register_taxonomy('race-type', array('team-seohelp'), array(
        'labels'                => array(
            'name'              => 'Тип гонок',
            'singular_name'     => 'Тип гонок',
            'search_items'      => 'Искать Тип гонок',
            'all_items'         => 'Все Типы гонок',
            'parent_item'       => 'Родит. Тип гонок',
            'parent_item_colon' => 'Родит. Тип гонок:',
            'edit_item'         => 'Ред. Тип гонок',
            'update_item'       => 'Обновить Тип гонок',
            'add_new_item'      => 'Добавить Тип гонок',
            'new_item_name'     => 'Новый Тип гонок',
            'menu_name'         => 'Тип гонок',
        ),
        'description'           => 'Типы гонок',
        'public'                => true,
        'show_tagcloud'         => true,
        'hierarchical'          => true,
        'show_admin_column'     => true,
    ) );    

}

// add_action( 'init', 'custom_post_type', 0 );

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

function seohelp_styles() {
    if ( ! is_admin() && ! is_login_page() ) {
        wp_enqueue_style( 'seohelp-style-opensans','https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=cyrillic');
        wp_enqueue_style( 'seohelp-style-roboto',  'https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic');
        wp_enqueue_style( 'seohelp-style-roboto2', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=cyrillic');
        wp_enqueue_style( 'seohelp-style',         get_stylesheet_uri() );
        wp_enqueue_style( 'seohelp-style-sl',      get_template_directory_uri() . '/js/slick/slick.css');
        wp_enqueue_style( 'seohelp-style-fancy',   get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css');
        wp_enqueue_style( 'seohelp-style-main',    get_template_directory_uri() . '/css/main.css');
    }
}


add_action( 'wp', 'seohelp_styles' );

function my_admin_theme_style() {
    wp_enqueue_style('my-admin-style', get_template_directory_uri() . '/css/adminui.css');
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');

function seohelp_scripts() {
    if( !is_admin()){
        // wp_deregister_script('jquery');
        // wp_deregister_script('jquery-migrate');
        // wp_register_script('jquery', get_template_directory_uri().'/js/vendor/jquery-2.2.4.min.js', false, '2.2.4');
        // wp_enqueue_script('jquery');
    }

    // wp_enqueue_script( 'seohelp-js-ym', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU', array(), '20160630', true );
    wp_enqueue_script( 'seohelp-js-bt',        get_template_directory_uri() . '/js/bootstrap.min.js', array(), '20160630', true );
    wp_enqueue_script( 'seohelp-js-sl',        get_template_directory_uri() . '/js/slick/slick.min.js', array('jquery'), '20160630', true );
    wp_enqueue_script( 'seohelp-js-mask',      get_template_directory_uri() . '/js/jquery.inputmask.bundle.min.js', array('jquery'), '20160630', true );
    wp_enqueue_script( 'seohelp-js-fancy',     get_template_directory_uri() . '/js/fancybox/jquery.fancybox.pack.js', array('jquery'), '20160630', true );
    wp_enqueue_script( 'seohelp-js-custom',    get_template_directory_uri() . '/js/main.js', array('jquery'), '20160630', true );
}
add_action( 'wp_enqueue_scripts', 'seohelp_scripts' );

add_filter('excerpt_more', function($more) {return '...'; });


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

function list_columns_func( $atts, $content = '' ){
    $out = $content;
    $count = $atts['count'];
    $count_class = '';
    if ($count) {
        if (($count) == 1) $count_class = '_1';
            else if (($count) == 2) $count_class = '_2';
                    else if (($count) == 3) $count_class = '_3';
                        else if (($count) == 4) $count_class = '_4';
        if ($count_class) $out = '<div class="list_columns list_columns'.$count_class.'">'.$out.'</div>';
    }
    return $out;
}
add_shortcode('list_columns', 'list_columns_func');

?>
