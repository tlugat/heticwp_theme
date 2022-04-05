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



add_action('init', 'marmishlag_add_roles');
add_action('after_setup_theme', "marmishlag_theme_support");
add_action('after_switch_theme', function () {
    flush_rewrite_rules();
});
// add_action('add_meta_boxes', 'marmishlag_add_custom_box');
// add_action('wp_enqueue_script', 'marmishlag_register_assets');
