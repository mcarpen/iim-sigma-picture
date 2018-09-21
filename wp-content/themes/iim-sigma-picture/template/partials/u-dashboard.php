<div class="container-fluid">
	<div class="row">
		<div class="col">
			<?php
			$args = [
				'post_type'      => 'files',
				'posts_per_page' => 10,
			];

			$lastFiles = new WP_Query( $args );
			?>
			<h4>Fichiers envoyés par l'admin</h4>
			<table class="table">
				<thead class="thead-light">
				<tr>
					<th scope="col">Email</th>
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
							<!-- TODO lien vers le profil de l'utilisateur en question -->
							<td><a href=""></a><?php the_title(); ?></td>
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
	</div>
</div>