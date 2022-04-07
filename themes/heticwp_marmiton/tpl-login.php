<?php
/*
Template Name: Connexion
*/
$error = false;
if (!empty($_POST)) {
    $user = wp_signon($_POST);
    if (is_wp_error($user)) {
        $error = $user->get_error_message();
    } else {
        $redirect_url = home_url();
        wp_safe_redirect($redirect_url);
    }
}
?>

<?php get_header(); ?>
<div class="login-main">
    <div class="post">
        <div class="input-group">
            <h1>Bon retour sur <span class="title-color">Bento</span></h1>
            <h3 class="sub-text">Veuillez vous connecter vous pour acceder au cuisines! </h3>
        </div>

        <?php if ($error) : ?>
            <div class="error">
                <?php echo $error; ?>
            </div>
        <?php endif ?>

        <form class="test" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="input-group">
                <label for="user_login" class="label-lr">Votre pseudo</label>
                <input type="text" id="user_login" name="user_login" class="login-input" style="text-align:right;">
            </div>
            <div class="input-group">
                <label for="user_password" class="label-lr">Votre mot de passe</label>
                <input type="password" id="user_password" name="user_password" class="login-input">
            </div>
            <div class="checkbox-log">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Se souvenir de moi</label>
            </div>
            <input type="submit" value="Connexion" class="login-btn">


        </form>
    </div>
    <div class="login-rightside">
        <img class="img-login" src="https://cdn.dribbble.com/users/1731254/screenshots/8346192/italian_food_illustration_tubikarts_4x.png" alt="img login">
    </div>
</div>

<?php get_footer(); ?>