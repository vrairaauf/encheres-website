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
<div class="connexionform">
	<?php
	$error=['erreur'=>''];
if(isset($_POST['submit'])){
	
	$username=$_POST['username'];
	$password=$_POST['paswd'];
	if(empty($username)){
		$error['erreur']='veiller inserer votre username';

	}elseif(empty($password)){
		$error['erreur']='veiller completer votre mot de passe';
	}else{
		$app=App::get_instance();
		$authentif=$app->get_table('user')->authentification($username, $password);
		if($authentif){
			if($_POST['remember']){
				var_dump($_POST);
				setcookie('auth', $authentif->id_user.'----'.sha1($authentif->email.$authentif->password), time() + (3600 * 24 * 3), '/', 'localhost', false, true);
			}
			$_SESSION['user']=$authentif->id_user;
			
			$trace_connexion=$app->get_table('user')->trace_doperation_de_connexion($authentif->id_user);
			$trace_connecteur=$app->get_table('user')->trace_connecteur($_SERVER['REMOTE_ADDR'], $_POST['username'], $authentif->pseudo);
			header('location: routeur.php?page=mur');
		}else{
			$error['erreur']='email ou mot de passe incorrect';
		}

	}

	
}else{
	$username='';
}

	?>
	<form method="post" name="f">
		<h1>Login</h1>
		<?php
echo '<p class="erreur">'.$error['erreur'].'</p>';
		?>
		<p><input type="text" name="username" placeholder="username" autofocus="" value="<?php
echo $username;
		?>" ></p>
		<p><input type="password" name="paswd" placeholder="password"></p>
		<p><input type="checkbox" name="remember" > se souvenir de mois</p>
		<p><input type="submit" name="submit" value="connexion"></p>
		<p class="motdepasseoublier"><a href="index.php?p=mot de passe oublier">mot de passe oublier?</a></p>
	</form>
</div>
<br><br><br>
</div>