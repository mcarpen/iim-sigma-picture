<?php
/*
    Template Name: Envoi utilisateur existant
*/
?>
<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4>Envoyer fichier à un utilisateur existant</h4>
		        <?php $all_users = get_users(); ?>
                <form action="<?php echo get_template_directory_uri(); ?>/function/front/endpoint.php" id="qq-form" class="form-wrap">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <select class="form-control" name="email" id="email" required>
                            <option value="" disabled selected>Sélectionne un utilisateur</option>
					        <?php
					        foreach ($all_users as $user) {
						        echo '<option value="' . esc_html($user->user_email) . '">' . esc_html($user->user_email) . '</option>';
					        }
					        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div id="fine-uploader-manual-trigger"></div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Ajouter de nouveaux fichiers" class="btn btn-primary btn-upload">
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h4>Fichiers déjà partagés avec l'utilisateur</h4>
		        <ul class="shared-files">
                </ul>
            </div>
        </div>
    </div>


<?php endwhile; endif; ?>

<?php get_footer(); ?>
