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
            }
        }
    }
}

?>

<?php get_header(); ?>
<div class="post">
    <h1>Inscription</h1>
    <?php if ($error) : ?>
        <div class="error">
            <?php echo $error; ?>
        </div>
    <?php endif ?>

    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
        <label for="user_login">Votre login</label><br>
        <input type="text" value="<?php echo isset($d['user_login']) ? $d['user_login'] : ''; ?>" name="user_login" id="user_login"><br>

        <label for="user_email">Votre email</label><br>
        <input type="text" value="<?php echo isset($d['user_email']) ? $d['user_login'] : ''; ?>" name="user_email" id="user_email"><br>

        <label for="user_pass">Votre mot de passe</label><br>
        <input type="password" id="user_pass" name="user_pass"><br>

        <label for="user_pass2">Comfirmer votre mot de passe</label><br>
        <input type="password" id="user_pass2" name="user_pass2"><br>
        <input type="submit" value="Se connecter">
    </form>
</div>

<?php get_footer(); ?>