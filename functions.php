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
        wp_enqueue_style( 'seohelp-style',         get_stylesheet_uri() );
        wp_deregister_script('jquery-migrate');

        wp_enqueue_script( 'seohelp-js-bt',        get_template_directory_uri() . '/js/plugins.js', array('jquery'), '20170630', true );
        if (is_page_template('page-reviews.php')) wp_enqueue_script( 'seohelp-js-zoom',  get_template_directory_uri() . '/js/jquery.zoom.min.js', array('jquery'), '20170630', true );
        if (is_page_template('page-contacts.php')) wp_enqueue_script( 'seohelp-js-map',  'https://api-maps.yandex.ru/2.1/?lang=ru_RU', array(), '', true );
        wp_enqueue_script( 'seohelp-js-custom',    get_template_directory_uri() . '/js/main.js', array('jquery'), '20170630', true );
        
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
        // add_image_size( 'middle', 270, 370, false ); 
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
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'comments'),
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
    echo '[get_content_form] - Показать форму заявки на странице<br>';
    echo '[get_content_form title="Заказать перенос сайта"] - Показать форму заявки с новым заголовком<br>';
    echo '[get_service_form] - Показать форму заявки услуги на странице<br>';
    echo '[get_service_form title="Закажите продвижение сайта!"] - Показать форму заявки услуги с новым заголовком<br>';
    echo '[get_service_result title="Результаты клиентов:"] - Показать результаты клиентов в услугах (параметр "title" опциональный)<br>';
    echo '[get_service_form lead="off"] - Показать форму заявки услуги без поля "С бесплатными целевыми посетителями"<br>';
    echo '[get_team_about] - Показать блок "О НАС" с бегающими цифрами. Блок редактируется на странице <a href="'.home_url().'/wp-admin/admin.php?page=acf-options-nastrojki-sajta">Настройки сайта</a><br>';
    echo '[get_clients] - Показать блок с лого "Наши клиенты". Блок редактируется на странице <a href="'.home_url().'/wp-admin/admin.php?page=acf-options-nastrojki-sajta">Настройки сайта</a><br>';
    echo '[get_reviews] - Показать блок с отзывами. Блок редактируется на странице <a href="'.home_url().'/wp-admin/post.php?post=104&action=edit">Дипломы и отзывы</a><br>';
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
            $out .= '<a href="'.get_the_permalink().'" class="portfolio__link">';
            $out .= '<div class="portfolio__caption">'.get_the_title().'</div>';
            $tax_name_main = get_field('folio_type_tile');
            if ($tax_name_main) $out .= '<div class="portfolio__tax-main">'.get_term($tax_name_main)->name.'</div>';
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
            $out_menu .= '<div class="portfolio-filter js-portfolio-filter">';
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

function get_service_result_func( $atts ){
    $out = '';
    if (is_array($atts) && array_key_exists('title', $atts) && $atts['title'] != '') $title = $atts['title'];
        else $title = 'Результаты наших клиентов';

    $arg =  array(
        'orderby'       => 'menu_order',
        'tag_id'        => 7, // Категория "Продвижение"
        'order'         => 'ASC',
        'posts_per_page'=> -1,
        'post_type'     => 'portfolio',
        'post_status'   => 'publish',
    );
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
