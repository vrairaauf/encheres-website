<div>
	<?php
	$cin='';
	$adresse='';
	$phone='';
if(isset($_POST['submit'])){
	
	foreach($_POST as $key=>$element){
		if(empty($element)){
			$erreur['information']='veiller saisissez votre  :'.$key;
			break;
		}
	}
	$cin=$_POST['cin'];
	$adresse=$_POST['adresse'];
	$phone=$_POST['phone'];
	if(empty($erreur['information'])){
		
		if(empty($_FILES)){
		$erreur['information']='veiller sasissez vos images de cin';
	}else{
		if(empty($_FILES['cinrecto']['name'])){
			$erreur['information']='cin recto introuvable';
		}elseif(empty($_FILES['cinverso']['name'])){
			$erreur['information']='cin versi introuvable';
		}else{
			
			$path='../app/views/compte/image/cin/';
			move_uploaded_file($_FILES['cinrecto']['tmp_name'], $path.$_FILES['cinrecto']['name']);
			move_uploaded_file($_FILES['cinverso']['tmp_name'], $path.$_FILES['cinverso']['name']);
			$imgage=$app->get_table('image')->insert_cin_image(intval($_SESSION['user']), $_FILES['cinrecto']['name']);
			$imgage=$app->get_table('image')->insert_cin_image(intval($_SESSION['user']), $_FILES['cinverso']['name']);
			$info=$app->get_table('informationbase')->ajout_information(intval($_SESSION['user']), strip_tags($_POST['cin']), strip_tags($_POST['phone']), strip_tags($_POST['adresse']));
			$notifications=$app->get_table('notification')->ajout_information_notofication(intval($_SESSION['user']));
			$cin='';
	$adresse='';
	$phone='';
	header('location: routeur.php');
			
		}
	}
	}
	

}
	?>
	<form method="post" enctype="multipart/form-data">
		<p>pour veiller realiser des achats sur batta.tn il faut donner quelques informations utiles :</p>
		<p class="btn btn-danger"><?php if(isset($erreur['information'])){echo $erreur['information'];} ?></p>
		<p><input type="text" name="cin" placeholder="cin:" value="<?php echo $cin; ?>"></p>
		<p><input type="text" name="adresse" placeholder="adresse" value="<?php echo $adresse; ?>"></p>
		<p><input type="number" name="phone" placeholder="telephone" value="<?php echo $phone; ?>"></p>

		<p><strong>cin recto</strong><input type="file" name="cinrecto" ></p>
		<p><strong>cin verso</strong><input type="file" name="cinverso" ></p>
		<p><input type="submit" name="submit" value="poster"></p>
	</form>
</div>