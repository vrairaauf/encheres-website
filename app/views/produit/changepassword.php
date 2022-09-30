<div class="all">
	<div class="oublierform">

		<?php
if(isset($_POST['submit'])){
	var_dump($_POST);
	if(empty($_POST['password']) || empty($_POST['password2'])){
		$erreur['information']="remplir les champs";
	}elseif($_POST['password']!==$_POST['password2']){
		$erreur['information']="passer le memes mot de passe dans les deux champs";

	}else{
		$app=App::get_instance();
		$set_password=$app->get_table('user')->set_user_password($_SESSION['email'], $_POST['password']);
	}
}
		?>
		<form method="post">
			<h3>Changer le mot de passe</h3>
			<p><?php if(isset($erreur['information'])){echo $erreur['information'];} ?></p>
			<p><input type="password" name="password" placeholder="password" autofocus=""></p>
			<p><input type="password" name="password2" placeholder="verifier password"></p>
			<p><input type="submit" name="submit" value="changer"></p>
		</form>
	</div>
</div>