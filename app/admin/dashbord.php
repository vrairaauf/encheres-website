<?php
if(!isset($_SESSION['admin'])){
	header('location: ?p=login');
}
$app=App::get_instance();
$produits=$app->get_table('produit')->produit_completed();

foreach($produits as $produit){
	echo '<div>';
	echo '<h3>'.$produit->titre_produit.'</h3>';
	echo '<p>le prix de cet produit dans le boutique est :'.$produit->prix_original.' TND</p>';
	echo '<p>publier le :'.$produit->datepublication.'</p>';
	echo '<p>cet produit atteind le nombre necessaire pour souvrir  : ('.$produit->nombre_ouvrir.') personne</p>';
	echo '<p>'.$produit->definir_date_ouvrir().'</p>';
	echo '</div>';
}
//le menue des choix
require '../app/admin/adminmenu.php';
?>