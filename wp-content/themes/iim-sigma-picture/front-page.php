<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <form name="loginform" id="loginform" action="<?php bloginfo( 'url' ); ?>/wp-login.php" method="post" class="form-wrap">
                    <div class="form-group">
                    <label for="user_login">Identifiant<br>
                        <input type="text" name="log" id="user_login" class="input form-control" value="" size="20" tabindex="10"></label>
                    </div>
                    <div class="form-group">
                    <label for="user_pass">Mot de passe<br>
                        <input type="password" name="pwd" id="user_pass" class="input form-control" value="" size="20" tabindex="20"></label>

                    </div>
                    <div class="form-group">
                        <label for="rememberme">
                            <input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90"> Se souvenir de moi</label>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-primary" value="Se connecter" tabindex="100">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>

