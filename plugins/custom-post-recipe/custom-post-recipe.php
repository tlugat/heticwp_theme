<?php
/*
Plugin Name: Recipe plugin
*/
require_once(__DIR__ . '/includes/Terms.php');

$terms = new Terms();

function register_custom_post_type()
{
    register_post_type(
        'recipes',
        array(
            'labels' => array(
                'name' => 'Recette',
                'singular_name' => 'Recette',
                'search_items' => 'Rechercher une recette',
                'all_items' => 'Toutes les recettes'
            ),
            'public' => true,
            'show_in_rest' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'has_archive' => true,
            'rewrite'   => array('slug' => 'recettes'),
            'menu_position' => 5,
            'menu_icon' => 'dashicons-food',
            'taxonomies' => array('variety') // this is IMPORTANT
        )
    );
}

add_action('init', 'register_custom_post_type');
