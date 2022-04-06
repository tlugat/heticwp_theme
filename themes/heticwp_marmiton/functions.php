<?php

function marmishlag_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'Navigation dans le header');
}

function marmishlag_register_assets()
{
    wp_register_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', []);
    wp_register_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', [], false, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', [], false, true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
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

function site_router()
{
    $root = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
    $url = str_replace($root, '', $_SERVER['REQUEST_URI']);
    $url = explode('/', $url);
    if (count($url) == 1 && $url[0] == 'login') {
        require "tpl-login.php";
        die();
    } else
if (count($url) == 1 && $url[0] == 'profil') {
        $redirect_url = home_url('/wp-admin/profile.php');
        wp_safe_redirect($redirect_url);
        exit;
    }
    if (count($url) == 1 && $url[0] == 'logout') {
        wp_logout();
        $redirect_url = home_url();
        wp_safe_redirect($redirect_url);
        exit;
    }
    if (count($url) == 1 && $url[0] == 'register') {
        require "tpl-register.php";
        die();
    }
}

add_filter('show_user_bar', '__return_true');

add_action('send_headers','site_router');

add_action('init', ' marmishlag_add_roles');
add_action('after_setup_theme', "marmishlag_theme_support");
add_action('after_switch_theme', function () {
    flush_rewrite_rules();
});

// add_action('wp_enqueue_script', 'marmishlag_register_assets');
