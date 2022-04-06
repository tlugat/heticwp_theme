<?php
/*
Template Name: Connexion
*/
$user = wp_get_current_user();
if ($user->ID == 0) {
    $redirect_url = home_url('/login');
    wp_safe_redirect($redirect_url);
}
?>

<?php get_header(); ?>
  
    

<?php get_footer(); ?>