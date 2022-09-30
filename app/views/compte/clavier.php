<?php
$app=App::get_instance();
//________________________
$etat_demarrer=$app->get_table('chrono')->get_demarrer($_GET['id']);
if($etat_demarrer==='init'){
		$demarer=$app->get_table('chrono')->set_demarrer($_GET['id']);
		$end_general=date('Y-m-d H:i:s', strtotime('+'.$_SESSION['general'].'minutes', strtotime($_SESSION['start_general'])));
		$set_endgenral=$app->get_table('chrono')->set_endgeneral($end_general, $_GET['id']);
}
//________________
if(isset($_POST['submit'])){
	
	if(isset($_POST['prix'])){
		$app=App::get_instance();
		$obprix=$app->get_table('produit')->get_prix_vente($_GET['id']);
		$prix=$obprix->prix_vente;
		
		//___________________mise a jour du nombre du coupon de user
		$nombre_du_coupon=$app->get_table('user')->get_nombre_of_coupon($_SESSION['user']);
		//_____________________________________________________________*
		if($nombre_du_coupon){
			$prix+=intval($_POST['prix']);
			$sent=$app->get_table('message')->propose_prix($prix, $_SESSION['user'], $_GET['id']);
			$set_prix=$app->get_table('produit')->set_prix_vente($_POST['prix'], $_GET['id']);
			$set_etat=$app->get_table('chrono')->set_etat($_GET['id']);
			$end_time=date('Y-m-d H:i:s', strtotime('+'.$_SESSION['duration'].'seconds', strtotime($_SESSION['start_time'])));
			$_SESSION['end_time']=$end_time;
			$set_endtime=$app->get_table('chrono')->set_endtime($end_time, $_GET['id']);
		}
		
	}else{
		$erreur['information']="sasissez un prix";
	}
}
?>
<form method="post">
	<p><input type="radio" name="prix" value="1000">1000</p>
	<p><input type="radio" name="prix" value="2000">2000</p>
	<p><?php if(isset($erreur['information'])){
		echo $erreur['information'];
	} ?></p>
	<p><input type="submit" name="submit" value="proposer"></p>
</form>