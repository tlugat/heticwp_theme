<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body>    
    <div>
        <?php $user = wp_get_current_user(); ?>
        <?php if($user->ID==0): ?>
            <a href="<?php echo bloginfo('url');?>/login">Se connecter</a>
            <a href="<?php echo bloginfo('url');?>/register">S'inscrire</a>
        <?php else: ?>
            salut <?php echo $user->user_login;?>;
            <a href="<?php echo bloginfo('url');?>/profil">Mon profil</a> |
            <a href="<?php echo bloginfo('url');?>/logout">Se déconnecter</a>
            <h1>aaa</h1>
            <?php endif; ?>
    </div>
</body>