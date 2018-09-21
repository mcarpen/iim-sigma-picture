<?php
/*
    Template Name: Find User
*/
?>
<?php get_header( 'admin' ); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h4>Trouver un utilisateur</h4>
				<?php $all_users = get_users(); ?>
                <div class="form-group">
                    <select class="form-control" name="user_email" id="email" required>
                        <option value="" disabled selected>Sélectionne un utilisateur</option>
						<?php
						foreach ( $all_users as $user ) {
							echo '<option value="' . esc_html( $user->user_email ) . '">' . esc_html( $user->user_email ) . '</option>';
						}
						?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h4>Fichiers déjà partagés avec l'utilisateur</h4>
                <table class="table table-admin">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Fichier</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <h4>Fichiers transmis par l'utilisateur</h4>
                <table class="table table-user">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Fichier</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="<?php echo get_template_directory_uri(); ?>/function/front/endpoint.php" id="qq-form" class="form-wrap" style="display: none;">
                    <div class="form-group">
                        <div id="fine-uploader-manual-trigger"></div>
                    </div>
                    <input type="hidden" name="user_email" value="" required>
                    <div class="form-group">
                        <input type="submit" value="Ajouter de nouveaux fichiers" class="btn btn-primary btn-upload">
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php endwhile; endif; ?>

<?php get_footer(); ?>
