<?php
/*
Template Name: Connexion
*/
$user = wp_get_current_user();
if($user->ID == 0){
    header('location:login');
}
?>

<?php get_header();?>
  
    

<?php get_footer();?>