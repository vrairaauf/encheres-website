<div class="all">
	<br>
	<br>
	<div class="oublierform">
		<?php
if(isset($_POST['submit'])){
	if(empty($_POST['code'])){
		$erreur['information']="taper le code de verification";
	}else{
		$app=App::get_instance();
		$verif=$app->get_table('user')->verif_code_mot_depasse_oublier($_POST['sessionid'], $_POST['code']);
		if($verif===false){
			$erreur['information']='code invalide';
		}

	}
}
		?>
		<form method="post">
			<p class="erreur"><?php if(isset($erreur['information'])){echo $erreur['information'];}?></p>
		<p><input type="text" name="code" placeholder="Code" autofocus=""></p>
		<p><input type="hidden" name="sessionid" value="<?php echo session_id(); ?>"></p>
		<p><input type="submit" name="submit" value="valider"></p>			
		</form>

	</div>
	<br>
	<br>

</div>
