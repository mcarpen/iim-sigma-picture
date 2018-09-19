<?php

add_action('init', 'cpt');
add_action('init', 'taxonomies', 0);

function cpt()
{
    register_post_type('xxx',
        array(
            'labels'      => array(
                'name'          => __('Xxx'),
                'singular_name' => __('Xxx'),
            ),
            'public'      => true,
            'supports'    => array(), //'title', 'editor', 'thumbnail', 'author', 'excerpt', 'revisions', 'page-attributes'
            'rewrite'     => array('slug' => 'xxx'),
            'menu_icon'   => 'xxx',
            'has_archive' => true,
        )
    );
}

function taxonomies()
{
    register_taxonomy('xxx-category',
        'xxx',
        array(
            'label'             => 'Xxx',
            'labels'            => array(
                'name'              => _x('Catégories des xxxx', 'taxonomy general name'),
                'singular_name'     => _x('catégorie', 'taxonomy singular name'),
                'search_items'      => __('Chercher une xxx'),
                'all_items'         => __('Toutes les xxxx'),
                'parent_item'       => __('Catégorie parent'),
                'parent_item_colon' => __('Catégorie parent :'),
                'edit_item'         => __('Modifier la catégorie'),
                'update_item'       => __('Sauvegarder la catégorie'),
                'add_new_item'      => __('Ajouter une catégorie'),
                'new_item_name'     => __('Nouveau nom de catégorie'),
                'menu_name'         => __('Catégories'),
            ),
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'xxx/c'),
        )
    );
}