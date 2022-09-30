<div>
	<?php
	$erreur['information']='';
	if(isset($_POST['submit'])){
		
		if(!isset($_FILES['fotodeprofil'])){
			$erreur['information']='au debut selectionner une image';
		}elseif($_FILES['fotodeprofil']['size']<3000){
			$erreur['information']='une resolution plus petite';
		}else{
			move_uploaded_file($_FILES['fotodeprofil']['tmp_name'], '../app/views/compte/image/'.$_FILES['fotodeprofil']['name']);
			$image=$app->get_table('image')->insert_user_image($_FILES['fotodeprofil']['name'], intval($_SESSION['user']));
			echo '<p>votre image a bien ajouter</p>';
			header('location: ?page=parametre');
		}
	}
	?>
	<form method="post" enctype="multipart/form-data" >
		<p>ajouter votre image pour votre profil </p>
		<p><?php echo $erreur['information']; ?></p>
		<p><input type="file" name="fotodeprofil"></p>
		<p><input type="submit" name="submit" value="poster"></p>
	</form>
</div>