<?php require_once __DIR__ . '/classes/bootstrap_5_wp_nav_menu_walker.php'; ?>
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
        <?php if (is_user_logged_in()) : ?>
            <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
                <div class="container-fluid">
                    <a href="/"><?php bloginfo('name') ?></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <?php wp_nav_menu([
                            'theme_location' => 'header',
                            'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0',
                            'container' => false,
                            'depth' => 2,
                            'fallback_cb' => '__return_false',
                            'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                            'walker' => new bootstrap_5_wp_nav_menu_walker()
                        ]) ?>
                        <?= get_search_form() ?>
                        <div>
                            <?php $user = wp_get_current_user(); ?>
                            <?php if ($user->ID == 0) : ?>
                                <a href="<?= home_url(); ?>/login">Se connecter</a>
                                <a href="<?= home_url(); ?>/register">S'inscrire</a>
                            <?php else : ?>
                                <a href="<?= home_url(); ?>/profil">
                                    <span>Bonjour, <?php echo $user->user_login; ?> </span>
                                    <img src="<?php echo esc_url(get_avatar_url($user->ID)); ?>" alt="" />
                                </a> |
                                <a href="<?= home_url(); ?>/logout">Se déconnecter</a>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </nav>
        <?php endif; ?>
    </header>
    <div class="container">