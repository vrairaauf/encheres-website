<?php 


if(!isset($_SESSION['admin'])){
	header('location: ?p=login');
}
$app=App::get_instance();
$produit=$app->get_table('produit')->produit_specifier($_GET['id']);

echo '<div>';
	echo '<h3>'.$produit->titre_produit.'</h3>';
	echo '<p>le prix de cet produit dans le boutique est :'.$produit->prix_original.' TND</p>';
	echo '<p>publier le :'.$produit->datepublication.'</p>';
	echo '<p>cet produit atteind le nombre necessaire pour souvrir  : ('.$produit->nombre_ouvrir.') personne</p>';
	
	echo '</div>';
 ?>
 <div>
 	<?php
 	$error['erreur']='';
if(isset($_POST['submit'])){
	
	if(empty($_POST['dateouvrir'])){
		$error['erreur']='veiller saisir une date';
	}else{
		$set_date_ouvrir=$app->get_table('produit')->set_date_ouvrir($_POST['dateouvrir'], $_POST['time'], $_GET['id']);
		$set_chrono=$app->get_table('chrono')->add_chrono($_GET['id']);
	}
}
 	?>
 	<form method="post">
 		<p>ajouter une date pour louvrir de cet événement:</p>
 		<blockquote>cet date ne depasse pas le 48 heure </blockquote>
 		<p><?php echo $error['erreur']; ?></p>
 		<input type="date" name="dateouvrir">
 		<br>
 		<input type="text" name="time">
 		<br>
 		<p><input type="submit" name="submit" value="enregistrer"></p>
 	</form>
 </div>
 <?php
//le menue des choix
require '../app/admin/adminmenu.php';
?>