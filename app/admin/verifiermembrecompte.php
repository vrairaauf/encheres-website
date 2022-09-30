<?php
$app=App::get_instance();
if(!isset($_SESSION['admin'])){
	header('location: ?p=login');
}
if(isset($_GET['situation'])){
	if($_GET['situation']=='vrai'){
		$set_verif=$app->get_table('user')->set_verifier($_GET['id']);
		$notifier=$app->get_table('notification')->notification_verif_compte($_GET['id']);
	}else{
		$delete_base_info=$app->get_table('informationbase')->delete_info($_GET['id']);
		$notifier=$app->get_table('notification')->notification_erreur_verification($_GET['id']);
		
	}
}

$base_infos=$app->get_table('informationbase')->all();

foreach($base_infos as $info){
	$user=$app->get_table('user')->get_user(intval($info->id_user));
	if($user->verifier_user==='non'){
		$cin=$app->get_table('image')->get_cin_image(intval($info->id_user));
		$profil_image=$app->get_table('image')->get_user_image(intval($user->id_user));
		echo '<div class="voirprofil">';
		echo '<table>';
		echo '<tr>';
		echo '<td>';
		echo 'photo de profil';
		echo '</td>';
		echo '<td>';
		echo '<img src="'.$profil_image->image_path().'" style="width: 160px;height:160px;">';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
		echo 'nom et prenom';
		echo '</td>';
		echo '<td>';
		echo $user->nom_user.'&nbsp&nbsp'.$user->prenom_user;
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
		echo 'pseudo';
		echo '</td>';
		echo '<td>';
		echo $user->pseudo;
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
		echo 'email';
		echo '</td>';
		echo '<td>';
		echo $user->email;
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
		echo 'cin ';
		echo '</td>';
		echo '<td>';
		echo $info->cin_user;
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
		echo 'telephone';
		echo '</td>';
		echo '<td>';
		echo $info->telephone;
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
		echo 'adresse';
		echo '</td>';
		echo '<td>';
		echo $info->adresse;
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
		echo 'cin recto est verso';
		echo '</td>';
		
		foreach($cin as $image){
			echo '<td>';
			echo '<img src="'.$image->src().'" style="width: 160px;height:160px;">';
			echo '</td>';
		}
		echo '</tr>';
		echo '</table>';
		echo '<button><a href="'.$info->verif_true_info().'">verifier que ce compte est un compte respecte nos regle de securite</a></button>';
		echo '<button><a href="'.$info->verif_false_info().'">refuser les donner ce compte est un compte respecte nos regle de securite</a></button>';
		echo '</div>';
	}
}
echo( '<hr>');
require '../app/admin/adminmenu.php';
?>