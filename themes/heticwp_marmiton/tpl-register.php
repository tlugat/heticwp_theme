<?php
/*
Template Name: Connexion
*/
$error = false;
if (!empty($_POST)) {
    $d = $_POST;
    if ($d['user_pass'] != $d['user_pass2']) {
        $error = 'Les 2 mots de passe ne correspondent pas';
    } else {
        if (!is_email($d['user_email'])) {
            $error = 'Veuillez entrer un email valide';
        } else {
            $user = wp_insert_user(array(
                'user_login' => $d['user_login'],
                'user_pass' => $d['user_pass'],
                'user_email' => $d['user_email'],
            ));
            if (is_wp_error($user)) {
                $error = $user->get_error_message();
            } else {
                $msg = 'Vous êtes maintenant inscrit';
                $headers = 'From :' . get_option('admin_email') . "\r\n";
                wp_mail($d['user_email'], 'Inscription réussie', $msg, $headers);
                $d = array();
                wp_signon($_POST);
                header('location:/profil');
            }
        }
    }
}

?>
<?php get_header(); ?>
<div class="register-main">
    <div class="post">
        <h1>Inscription</h1>
        <h3 class="sub-text">Inscriver vous et acceder au cuisines! </h3>
        <?php if ($error) : ?>
            <div class="error">
                <?php echo $error; ?>
            </div>
        <?php endif ?>

        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="input-group">
                <label for="user_login" class="child-mar">Votre login</label>
                <input type="text" class="login-input" value="<?php echo isset($d['user_login']) ? $d['user_login'] : ''; ?>" name="user_login" id="user_login">
            </div>
            <div class="input-group">
                <label for="user_email" class="child-mar">Votre email</label>
                <input type="text" class="login-input" value="<?php echo isset($d['user_email']) ? $d['user_login'] : ''; ?>" name="user_email" id="user_email">
            </div>

            <div class="input-group">
                <label for="user_pass" class="child-mar">Votre mot de passe</label>
                <input type="password" id="user_pass" name="user_pass" class="login-input">
            </div>
            <div class="input-group">
                <label for="user_pass2" class="child-mar">Comfirmer votre mot de passe</label>
                <input type="password" id="user_pass2" name="user_pass2" class="login-input">
            </div>
            <input type="submit" value="S'inscrire" class="login-btn1">
        </form>
    </div>
    <div class="login-rightside">
        <img class="img-login" src="https://cdn.dribbble.com/users/1731254/screenshots/8346192/italian_food_illustration_tubikarts_4x.png" alt="img login">
    </div>
</div>

<?php get_footer(); ?>