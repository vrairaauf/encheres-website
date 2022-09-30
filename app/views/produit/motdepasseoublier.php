<div class="all">
	<br>
	<br>
<div class="oublierform">
<?php
if(isset($_POST['submit'])){
	
	if(empty($_POST['email'])){
		$erreur['information']='veiller taper votre email';
	}else{
		$app=App::get_instance();

		$password=$app->get_table('user')->envoie_email_motdepasse_oublier($_POST['email'], $_POST['sessionid']);
		
	}
}
?>

<form method="post">
	<p class="erreur"><?php if(isset($erreur['information'])){echo $erreur['information'];} ?></p>
	<p><input type="email" autofocus="" name="email" placeholder="Email" required=""></p>
	<p><input type="hidden" name="sessionid" value="<?php echo session_id(); ?>"></p>
	<p><input type="submit" name="submit" value="envoyer"></p>

</form>	
</div>
<br>
	<br>
</div>