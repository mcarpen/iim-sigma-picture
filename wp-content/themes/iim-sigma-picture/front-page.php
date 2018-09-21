<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post();?>

    <form name="loginform" id="loginform" action="<?php bloginfo('url'); ?>/wp-login.php" method="post">
        <p>
            <label for="user_login">Identifiant<br>
                <input type="text" name="log" id="user_login" class="input" value="" size="20" tabindex="10"></label>
        </p>
        <p>
            <label for="user_pass">Mot de passe<br>
                <input type="password" name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20"></label>
        </p>
        <p class="forgetmenot">
            <label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"
                                           tabindex="90"> Se souvenir de moi</label>
        </p>
        <p class="submit">
            <input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Se connecter"
                   tabindex="100">
        </p>
    </form>

<?php endwhile; endif; ?>

<?php get_footer(); ?>

