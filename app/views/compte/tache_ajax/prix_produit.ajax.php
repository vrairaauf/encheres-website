<?php
require 'principal.php';
$produit=$con->prepare('SELECT * FROM produit WHERE id_produit=?');
$produit->execute([$_GET['idprod']]);
$result=$produit->fetchAll();
$prix=$result[0]['prix_vente'];
//___________________
$winner=$con->prepare('SELECT id_user , MAX(contenu_message) FROM message WHERE id_produit=?');
		$winner->execute([$_GET['idprod']]);
		$personne=$winner->fetchAll();
		$user=$personne[0]['id_user'];


//____________________
echo $prix ."&nbsp TND";
if($user){
	
	$p=$con->prepare('SELECT pseudo FROM user WHERE id_user=?');
	$p->execute([$user]);
	$pe=$p->fetchAll();
	echo '<p>'.$pe[0]['pseudo'].'</p>';
}
?>