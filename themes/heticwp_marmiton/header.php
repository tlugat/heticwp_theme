<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body>
    <header>
        <?php $user = wp_get_current_user(); ?>
        <?php if ($user->ID == 0) : ?>
            <a href="<?php echo bloginfo('url'); ?>/login">Se connecter</a>
            <a href="<?php echo bloginfo('url'); ?>/register">S'inscrire</a>
        <?php else : ?>
            salut <?php echo $user->user_login; ?>;
            <a href="<?php echo bloginfo('url'); ?>/profil">Mon profil</a> |
            <a href="<?php echo bloginfo('url'); ?>/logout">Se déconnecter</a>

        <?php endif; ?>
    </header>
    <div class="container">
