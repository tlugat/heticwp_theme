<?php

// require_once './classes/SponsoBox.php';

function marmishlag_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'Navigation dans le header');
}

// function marmishlag_register_assets() {
//     wp_register_style('name', 'path');
//     wp_register_script('name', 'path', [], false, true);
//     wp_enqueue_style('name');
//     wp_enqueue_script('name);
// }


function marmishlag_register_event_cpt()
{
    $labels = [
        'name' => 'Recette',
        'singular_name' => 'Recette',
        'search_items' => 'Rechercher une recette',
        'all_items' => 'Toutes les recettes'
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-food',
        'taxonomies' => array('recipeCategory'),
        'supports' => ['title', 'editor', 'author', 'thumbnail', 'comments', 'excerpt'],
        'show_in_rest' => true,
        'has_archive' => true,
    ];

    register_post_type('recipe', $args);
}

function marmishlag_resister_recipeCategory_taxonomy()
{
    $labels = [
        'name' => 'Catégories',
        'singular_name' => 'Catégorie',
        'search_items' => 'Rechercher une catégorie',
        'all_items' => 'Toutes les catégories'
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true
    ];

    register_taxonomy('recipeCategory', ['recipe'], $args);
}

function marmishlag_insert_terms()
{
    $taxonomy = 'recipeCategory';
    $terms = [
        ['name' => 'Apéritifs', 'slug' => 'aperitifs'],
        ['name' => 'Entrées', 'slug' => 'entrees'],
        ['name' => 'Plats', 'slug' => 'plats'],
        ['name' => 'Desserts', 'slug' => 'desserts'],
        ['name' => 'Boissons', 'slug' => 'boissons'],
    ];
    foreach ($terms as $term) {
        wp_insert_term($term['name'], $taxonomy, ['slug' => $term['slug']]);
    }
    // wp_insert_term('Apéritifs', $taxonomy, ['slug' => 'aperitifs']);
    // wp_insert_term('Entrées', $taxonomy, ['slug' => 'entrees']);
    // wp_insert_term('Plats', $taxonomy, ['slug' => 'plats']);
    // wp_insert_term('Desserts', $taxonomy, ['slug' => 'desserts']);
    // wp_insert_term('Boissons', $taxonomy, ['slug' => 'boissons']);
}

function marmishlag_add_roles()
{
    add_role('moderator', 'Modérateur / Modératrice', [
        'read' => true,

        'edit_posts' => true,

        'edit_other_posts' => true,

        'edit_published_posts' => true,

        'moderate_comments' => true
    ]);
}

function marmishlag_init()
{
    marmishlag_register_event_cpt();
    marmishlag_resister_recipeCategory_taxonomy();
    marmishlag_add_roles();
}

add_action('init', 'marmishlag_init');
add_action('after_setup_theme', "marmishlag_theme_support");
add_action('after_switch_theme', function () {
    marmishlag_insert_terms();
    flush_rewrite_rules();
});
// add_action('wp_enqueue_script', 'marmishlag_register_assets');
