<?php get_header(); ?>


<?php 
// Connecter le site avec la base de donnée 
$bdd = new PDO('mysql:host=localhost;dbname=iim-sigma', 'root', '');
// Connecter le site avec la base de donnée en ligne
//$bdd = new PDO('mysql:host=db737311755.db.1and1.com;dbname=db737311755', 'dbo737311755', 'Mot_de_passe78');
?>
<?php
	//On fait la même chose que pour la partie précedente 
	//si on appuie sur le bouton inscription alors
if(isset($_POST['forminscription'])) 
{
		//creation de variable pseudo, mail, mdp
	$pseudo = htmlspecialchars($_POST['user_login']);
	$mail = htmlspecialchars($_POST['user_email']);
	$mdp = sha1($_POST['user_pass']);
	$a = '';
	$b = '';
	$c = '2018-09-19 16:01:30';
	$d = '';
	$e = 0;
	$f = '';
	$g = 'tel';
	$h = htmlspecialchars($_POST['meta_value']);
	
		//Si il existe des données dans la barre pseudo et dans celle du mdp et dans celle de mail alors
	if(!empty($_POST['user_login']) AND !empty($_POST['user_email']) AND !empty($_POST['meta_value']))
	{
			//si l email est valide alors	
		if(filter_var($mail, FILTER_VALIDATE_EMAIL))
		{
				//on envoie le mail dans la bdd
			$reqmail = $bdd->prepare("SELECT * FROM sp_users WHERE user_email = ?");
			$reqmail->execute(array($mail));
			$mailexist = $reqmail->rowCount();
				//si le mail n existe pas dans la bdd
			if($mailexist == 0) 
			{

				//alors il se crée dans la bdd
				$insertmbr = $bdd->prepare("INSERT INTO sp_users(user_login, user_email, user_pass, user_nicename, user_url, user_registered, user_activation_key, user_status, display_name) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$insertmbr->execute(array($pseudo, $mail, $mdp, $a, $b, $c, $d, $e, $f));

				$insertmbr2 = $bdd->prepare("INSERT INTO sp_usermeta(meta_key, meta_value) VALUES(?, ?)");
				$insertmbr2->execute(array($g, $h));


				$user = get_user_by( 'email', $mail );


				update_field('tel', $h, 'user_' . $user->ID);



				$erreur = "<br><br>Votre compte a bien été créé !";

			}
			else 
				 { //sinon message d'erreur
				$erreur = "Adresse mail déjà utilisée !";
			}
		} 
		else 
		{
				//sinon message d'erreur
			$erreur = "Votre adresse mail n'est pas valide !";
		}

	} 
	else 
	{
			//sinon message d'erreur
		$erreur = "<br><br>Tous les champs doivent être complétés !";
	}
}
?>

<section  class="col-lg-6 mx-auto text-center" style="padding-top:10%;">
	<!--zone d inscription-->
	<div class="inscription" >
		<!--titre-->
		<h2>Inscription</h2>


		<form method="POST" >

			<!--barre de pseudo-->
			<input for="user_login" type="text"  placeholder="pseudo" class="pseudo" id="user_login" name="user_login" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
			<br> <!--<br> = saut à la ligne -->

			<!--barre de mail-->
			<input for="user_email" type="email"  placeholder="Email" class="email" id="user_email" name="user_email" value="<?php if(isset($mail)) { echo $mail; } ?>" />
			<br>

			<!--barre de telephone-->
			<input for="meta_value" type="text"  placeholder="Tel" class="motdepasse" id="meta_value" name="meta_value" value="<?php if(isset($h)) { echo $h; } ?>"/>
			<br>
			<!--bouton inscription-->
			<input for="forminscription" class="inscrire" type="submit" name="forminscription" value="Je m'inscris"/>

				<?php //ce code sert à faire afficher une erreur
				if(isset($erreur)) {
					echo '<font color="red">'.$erreur."</font>";
				}
				?>

			</form>


		</div>

	</section>





</body>

<?php get_footer(); ?>

