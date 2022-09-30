<?php
require '../app/App.php';
App::load();
$page='mur';
if(isset($_GET['page'])){
	$page=$_GET['page'];
}
ob_start();
switch($page){
	case 'profil':
	require '../app/views/compte/profil.php';
	break;
	case 'gagnant':
		require '../app/views/compte/gagnant.php';
		break;
		case 'certificat':
			require '../app/views/compte/certificat.php';
			break;
	case 'winner':
	require '../app/views/compte/winner.php';
	break;
	case 'notification':
	require '../app/views/compte/notification.php';
	break;
	case 'achat':
	require '../app/views/compte/acheter.php';
	break;
	case 'rejoindre':
	require '../app/views/compte/rejoindre.php';
	break;
	case 'detail':
	require '../app/views/compte/detail.php';
	break;
	case 'parametre':
	require '../app/views/compte/parametre.php';
	break;	
	case 'event en cour':
	require '../app/views/compte/encour.php';
	break;
	case 'commentaire':
	require '../app/views/compte/commentaire.php';
	break;	
	case 'deconnexion':
	require '../app/views/compte/deconnexion.php';
	break;
	case 'room':
	require '../app/views/compte/tache_ajax/room.php';
	break;	
	default :
	require '../app/views/compte/mur.php';
	break;

}
$content=ob_get_clean();
require '../app/views/templates/default.php';
?>