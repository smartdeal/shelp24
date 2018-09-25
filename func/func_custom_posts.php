<?php 

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
        'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes'),
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

    $labels = array(
        'name'                => _x( 'Вакансии', 'Post Type General Name', 'seohelp' ),
        'singular_name'       => _x( 'Вакансия', 'Post Type Singular Name', 'seohelp' ),
        'menu_name'           => __( 'Вакансии', 'seohelp' ),
        'parent_item_colon'   => __( 'Родит. Вакансия', 'seohelp' ),
        'all_items'           => __( 'Все Вакансии', 'seohelp' ),
        'view_item'           => __( 'Смотреть Вакансию', 'seohelp' ),
        'add_new_item'        => __( 'Добавить новою Вакансию', 'seohelp' ),
        'add_new'             => __( 'Добавить новою', 'seohelp' ),
        'edit_item'           => __( 'Редактировать Вакансию', 'seohelp' ),
        'update_item'         => __( 'Обновить Вакансию', 'seohelp' ),
        'search_items'        => __( 'Искать Вакансию', 'seohelp' ),
        'not_found'           => __( 'Не найдено', 'seohelp' ),
        'not_found_in_trash'  => __( 'Не найдено в корзине', 'seohelp' ),
    );

    $args = array(
        'label'               => __( 'Вакансии', 'seohelp' ),
        'description'         => __( '', 'seohelp' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', ),
        'taxonomies'          => array(),
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
    register_post_type( 'vacancy', $args );

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
