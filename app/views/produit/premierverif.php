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
	$verif='';
	$error='';
	$app=App::get_instance();

if(isset($_POST['submit'])){
	$verif=$_POST['verif'];
	$post=$app->get_table('user')->get_user_mail($_SESSION['user']);
	if($post->code===$_POST['verif']){
		$set_premierverif=$app->get_table('user')->set_premier_verif($post->id_user);

		$notification=$app->get_table('notification')->ajout_base_notification(intval($post->id_user));
		
		$_SESSION['user']=$post->id_user;
		header('location: routeur.php');
		
	}else{
		$error='le code est incorrect';
	}
	
}
	?>
	<form method="post">
		<h1>taper le code de varification</h1>
		<p><?php echo $error; ?></p>
		<p><input type="text" name="verif" autofocus="" value="<?php echo $verif; ?>"></p>

		<p><input type="submit" name="submit" value="valider"></p>
		<div>
	<?php
if(isset($_GET['reverifier'])){
	
	echo $reverifier=$app->get_table('user')->autre_code_verification($_SESSION['user']);
}
	?>
	<p class="reverif"><a href="index.php?p=primaireverif&reverifier=true">un autre code de verification</a></p>
</div>
	</form>
</div>

<br>
<br>
<br>
</div>