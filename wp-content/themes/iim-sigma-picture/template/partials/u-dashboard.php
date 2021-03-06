<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
			<?php
			$user  = wp_get_current_user();
			$email = $user->user_email;

			$args = [
				'post_type'      => 'files',
				'posts_per_page' => - 1,
				's'              => $email,
			];

			$lastFiles = new WP_Query( $args );
			?>

            <h4>Fichiers reçus </h4>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Fichier</th>
                </tr>
                </thead>
                <tbody>
				<?php
				if ( $lastFiles->have_posts() ) : while ( $lastFiles->have_posts() ) : $lastFiles->the_post();
					$isAdmin = get_field( 'is_admin' );
					if ( $isAdmin ) {
						$fileName = get_field( 'name' );
						?>
                        <tr>
                            <!-- TODO lien vers le profil de l'utilisateur en question -->
                            <td><a href="<?php the_field( 'path' ); ?>" download title="Télécharger ce fichier"><?= $fileName; ?></a></td>
                        </tr>
						<?php
					}
				endwhile;
				endif;
				?>

                </tbody>
            </table>
        </div>

        <div class="col-md-6">
            <h4>Fichiers envoyés </h4>
            <table class="table">
                <div class="col-md-6">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Fichier</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php
					if ( $lastFiles->have_posts() ) : while ( $lastFiles->have_posts() ) : $lastFiles->the_post();
						$isAdmin = get_field( 'is_admin' );
						if ( ! $isAdmin ) {
							$fileName = get_field( 'name' );
							?>
                            <tr>
                                <td><a href="<?php the_field( 'path' ); ?>" download title="Télécharger ce fichier"><?= $fileName; ?></a></td>
                            </tr>
							<?php
						}
					endwhile;
					endif;
					?>
                    </tbody>
            </table>
        </div>

        <div class="col order-1">
            <h4> Envoyer un fichier </h4>
            <form action="<?php echo get_template_directory_uri(); ?>/function/front/endpoint.php" id="qq-form" class="form-wrap">
                <div class="form-group">

                    <input for="user_email" type="email" placeholder="Email" class="form-control" id="user_email" name="user_email" hidden value="<?= $email; ?>">
                </div>
                <div class="form-group">
                    <div id="fine-uploader-manual-trigger"></div>
                </div>
                <div class="form-group">
                    <input type="submit" value="Envoyer les fichiers" class="btn btn-primary btn-upload">
                </div>
            </form>
        </div>
    </div>
</div>
</div>