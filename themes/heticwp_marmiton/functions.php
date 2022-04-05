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


add_action('send_headers','site_router');
function site_router(){
  $root = str_replace('index.php','',$_SERVER['SCRIPT_NAME']);
  $url = str_replace($root,'',$_SERVER['REQUEST_URI']);
  $url = explode('/',$url);
  if(count($url) == 1 && $url[0] =='login'){
    require "tpl-login.php";
    die();
  }else
if(count($url) == 1 && $url[0] =='profil'){
    require "tpl-profil.php";
    die();
  }
  if(count($url) == 1 && $url[0] =='logout'){
    wp_logout();
    $redirect_url = home_url();
         wp_safe_redirect( $redirect_url );
         exit;
    
  }
    if(count($url) == 1 && $url[0] =='register'){
     require "tpl-register.php";
    die();
  }
}

add_filter('show_user_bar','__return_true');
add_action('init', ' marmishlag_add_roles');
add_action('after_setup_theme', "marmishlag_theme_support");
add_action('after_switch_theme', function () {
    flush_rewrite_rules();
});

// add_action('wp_enqueue_script', 'marmishlag_register_assets');
