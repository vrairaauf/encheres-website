<div class="all">
	<br>
	<?php
echo '<div>';
require '../app/views/produit/complements/menu.php';
echo '</div>';
	?>
<div class="entete">
	<img src="../app/views/produit/image/pexels-photo-1851415.jpeg">
</div>
<div class="inscriptionform">
	<?php
	$nom='';
	$prenom='';
	$email='';
	$password='';
	$vpassword='';
	$erreur['information']='';
	$app=App::get_instance();
if(isset($_POST['submit'])){
	
	foreach ($_POST as $key => $value) {
		if(empty($value)){
			$erreur['information']='veiller terminer votre :'.$key;

			break;
		}
	}
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$vpassword=$_POST['vpassword'];

	if($_POST['password']!==$_POST['vpassword']){
		$erreur['information']='veiller taper le meme mot de passe dans les deux champs password est verif password';
	}
	if(empty($erreur['information'])){
		
		$user=$app->get_table('user')->verif_email($_POST['email']);
		if($user){
			$erreur['information']='cette email <strong>'.$_POST['email'].'</strong> a un compte';
		}else{
		$pseudo=$app->get_table('user')->pseudo($_POST['nom']);
		$add=$app->get_table('user')->add_user(strip_tags($_POST['nom']), strip_tags($_POST['prenom']), $pseudo, strip_tags($_POST['email']), strip_tags($_POST['password']));
			usleep(1000);
		$trace_user=$app->get_table('user')->get_user_avec_email($_POST['email']);
			$trace_ajout_user=$app->get_table('user')->trace_ajout_user($trace_user->id_user, $trace_user->nom_user, $trace_user->prenom_user, $trace_user->pseudo, $trace_user->email, $trace_user->password, $trace_user->nombre_coupon);
			$nom='';
			$prenom='';
			$email='';
			$password='';
			$vpassword='';
			echo 'vous avez recoit un code de verification ';
			$_SESSION['user']=$_POST['email'];
			header('location: ?p=primaireverif');

		
	}
	}

}
	?>
	<form method="post">
		<h1>Create account</h1>
			<p class="erreur"><?php echo $erreur['information']; ?></p>
		
		<p><input type="text" name="nom" placeholder="nom:"  value="<?php echo $nom; ?>"></p>
		<p><input type="text" name="prenom" placeholder="prenom:"   value="<?php echo $prenom; ?>"></p>
		
		<p><input type="email" name="email" placeholder="email"   value="<?php echo $email; ?>"></p>
		<p><input type="password" name="password" placeholder="password"   value="<?php echo $password; ?>"></p>
		<p><input type="password" name="vpassword" placeholder="verif password"   value="<?php echo $vpassword; ?>"></p>
		<p><input type="submit" name="submit" value="inscription"></p>
	</form>
</div>
<br><br><br>
</div>