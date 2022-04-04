<?php

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
        'singular_name' => 'Recettes',
        'search_items' => 'Rechercher une recette',
        'all_items' => 'Toutes les recettes'
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-food',
        'supports' => ['title', 'editor', 'author', 'thumbnail', 'comments', 'excerpt'],
        'show_in_rest' => true,
        'has_archive' => true,
    ];

    register_post_type('recipe', $args);
}

add_action('init', 'marmishlag_register_event_cpt');
add_action('after_setup_theme', "marmishlag_theme_support");
// add_action('wp_enqueue_script', 'marmishlag_register_assets');
