<?php
require '../app/App.php';
App::load();
$page='login';
if(isset($_GET['p'])){
	$page=$_GET['p'];
}
ob_start();
//gerer le sauvegarde
switch($page){
	case 'dashbord':
		require '../app/admin/dashbord.php';
		break;
	case 'envoi des email':
		require '../app/admin/envoiemail.php';
		break;
	case 'gerer le sauvegarde':
	require '../app/admin/sauvegarde.php';
	break;
	case 'single':
	require '../app/admin/single.php';
	break;
	case 'terminer les dates des événements':
	require '../app/admin/dashbord.php';
	break;
	case 'ajouter des produits':
	require '../app/admin/ajoutproduit.php';
	break;
	case 'supprimer les produits ete achetee':
	require '../app/admin/deleteproduit.php';
	break;
	case 'les membre connecte sur le site':
	require '../app/admin/enligne.php';
	break;
	
	case 'verifier les comptesc des membres':
	require '../app/admin/verifiermembrecompte.php';
	break;
	default :
	require '../app/admin/login.php';
	break;

}
$content=ob_get_clean();
require '../app/views/templates/admin.php';
?>