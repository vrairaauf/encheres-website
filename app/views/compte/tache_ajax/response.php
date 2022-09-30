<?php
require 'principal.php';
$id_chrono=$_GET['idprod'];
$idproduit=$_GET['idprod'];
$req=$con->query('SELECT * from chrono WHERE id="'.$id_chrono.'"');
$r=$req->fetchAll();
$etat=$r[0]['etat'];
$debuter=$r[0]['debuter'];
$id=$r[0]['id'];

function chronometre($end_time){
	
	global $con;
	$from_time1=date('Y-m-d H:i:s');
	global $id;
	global $idproduit;
	$to_time1=$end_time;

	$timefirst=strtotime($from_time1);
	$timesecond=strtotime($to_time1);
	$difference=$timesecond-$timefirst;
	if($difference<0){
		$v="oui";
	//$update=$app->get_table('chrono')->initial_etat();
		$update=$con->exec('UPDATE chrono SET etat="off" WHERE id="'.$id.'"');
		$vente=$con->exec('UPDATE produit SET vente="'.$v.'" WHERE id_produit="'.$id.'"');
		$winner=$con->prepare('SELECT id_user , MAX(contenu_message) FROM message WHERE id_produit=?');
		$winner->execute([$_GET['idprod']]);
		$personne=$winner->fetchAll();
		$user=$personne[0]['id_user'];
		$date=date('Y-m-d H:i:s');
		$prod=$con->exec('UPDATE produit SET winner="'.$user.'" WHERE id_produit="'.$_GET['idprod'].'"');
		$gagnant=$con->exec('INSERT INTO gagnant SET id_user="'.$user.'" , id_produit="'.$_GET['idprod'].'", date_gagne="'.$date.'"');
		$initiale_chrono=$con->exec('UPDATE chrono SET debuter="non" WHERE id="'.$id.'"');
		$set_situation_even=$con->exec('UPDATE evenement SET situation="fermer" WHERE id_produit="'.$idproduit.'"');
		//header('location: ?page=mur');
		
	}else{
		echo gmdate("s", $difference);
	}
}
//$get_etat

	if($etat==='on' AND $debuter==='oui'){
		chronometre($r[0]['end_time']);
	}

?>