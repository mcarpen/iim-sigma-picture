<?php
/*
    Template Name: test-mail
*/
    ?>

    <?php get_header(); ?>

    <?php

    $bdd = new PDO('mysql:host=localhost;dbname=iim-sigma', 'root', '');


    ?>

    <!--message d'erreur en rouge -->
    <?php
    if(isset($erreur)) {
    	echo '<font color="red">'.$erreur."</font>";
    }
    ?>

    <!--boite de la où on met les réponses aux questions enregistrées-->
    <div style="top: 30px;" >
    	<h2>Tous les emails clients :</h2>
    	<?php   

		//on va chercher les réponses enregistrées dans la bdd dans la table quiz 
    	$sql = 'SELECT * FROM sp_users';   
    	$req = $bdd->query($sql);   

    	?>

    	<?php while($row = $req->fetch()) {  ?> 



    	<?php 

    	$args = array('orderby' => 'display_name');
    	$wp_user_query = new WP_User_Query($args);
    	$authors = $wp_user_query->get_results();

    	if (!empty($authors)) {
    		echo '<ul>';

    		foreach ($authors as $author) {
    			$author_info = get_userdata($author->ID);
    			echo '<p>-' . $author_info->user_email . '</p>';
    		}

    		echo '</ul>';

    	} else {
    		echo 'No results';
    	} ?>

    	<?php $req->closeCursor(); } ?>


    </div>



    <div style="padding-top:20px;" class="container-fluid">
    	<div class="row">
    		<div class="col-md-12">
    			<?php
    			$args = [
    				'post_type'      => 'files',
    				'posts_per_page' => 9,
    			];

    			$lastFiles = new WP_Query( $args );
    			?>
    			<h4>Derniers fichiers envoyés par les utilisateurs</h4>
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


</body>

<?php get_footer(); ?>
