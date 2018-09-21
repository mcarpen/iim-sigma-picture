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
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form">
					<span class="login100-form-title p-b-26">
						Welcome
					</span>
                <span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

                <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
                    <input class="input100" type="text" name="email">
                    <span class="focus-input100" data-placeholder="Email"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                    <input class="input100" type="password" name="pass">
                    <span class="focus-input100" data-placeholder="Password"></span>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </div>

                <div class="text-center p-t-115">
						<span class="txt1">
							Don’t have an account?
						</span>

                    <a class="txt2" href="#">
                        Sign Up
                    </a>
                </div>
            </form>
        </div>
    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>

