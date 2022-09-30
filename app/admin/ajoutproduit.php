<?php
if(!isset($_SESSION['admin'])){
	header('location: ?p=login');
}
?>
<p>ajouter des produits</p>
<div>
	<?php
$error['erreur']='';
$titre='';
	$desc='';
	$prix_original='';
	$participe='';
	$nbouvrir='';
if(isset($_POST['submit'])){
	
	
	foreach($_POST as $k=>$e){
		
		if(empty($e)){
			$error['erreur']='veiller taper votre  :'.$k;
			break;
		}
	}
	$titre=$_POST['titre'];
	$desc=$_POST['description'];
	$prix_original=$_POST['prix_original'];
	$participe=$_POST['participe'];
	$nbouvrir=$_POST['nbouvrir'];
	if(!empty($titre) AND !empty($desc) AND !empty($prix_original) AND !empty($participe) AND !empty($nbouvrir)){
		$app=App::get_instance();
		$req=$app->get_table('produit')->ajouter_produit($titre, $desc, $prix_original, $participe, $nbouvrir);
		
		$error['erreur']='cet produit va inserer avec succes';
		$id=$app->get_table('produit')->produit_de_now($titre, $desc);
		$id_prod=$id->id_produit;
		$sauvegarde_trace=$app->get_table('produit')->trace_dajout_de_produit($id_prod, $titre, $desc, $prix_original, $participe, $nbouvrir);
		/**/
	for($i=0;$i<count($_FILES['image']['name']);$i++){
		$name=basename($_FILES['image']['name'][$i]);
		$tmp_name=$_FILES['image']['tmp_name'][$i];
		$image=$app->get_table('image')->insert_image($name, $id_prod);
		move_uploaded_file($tmp_name, '../app/views/produit/image/'.$name);
	}
	$titre='';
	$desc='';
	$prix_original='';
	$participe='';
	$nbouvrir='';
	}
}
	?>
	<form method="post" enctype="multipart/form-data">
		<p><?php
echo $error['erreur'];
		?></p>
	<p><input type="text" name="titre" placeholder="titre" value="<?php echo $titre; ?>"></p>
	<p><textarea name="description" value="hello"><?php echo $desc; ?></textarea></p>
	<p><input type="number" name="prix_original" placeholder="prix" value="<?php echo $prix_original; ?>"></p>
	<p><input type="number" name="participe" placeholder="prix participe" value="<?php echo $participe; ?>"></p>
	<p><input type="number" name="nbouvrir" placeholder="nombre pour louverture" value="<?php echo $nbouvrir; ?>"></p>
	<p><input type="file" name="image[]" multiple=""></p>
	<p><input type="submit" name="submit" value="enregistrer"></p>	

	</form>

</div>
<?php
//le menue des choix
require '../app/admin/adminmenu.php';

?>