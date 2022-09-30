<?php
require '../app/App.php';
App::load();
$page='principal';
if(isset($_GET['p'])){
	$page=$_GET['p'];
}
ob_start();
switch ($page) {
	case 'connexion':
		require '../app/views/produit/connexion.php';
		break;
	case 'commentaire':
		require '../app/views/produit/commentaire.php';
		break;
	case 'créer un compte':
		require '../app/views/produit/inscription.php';
		break;
	
	case 'primaireverif':
		require '../app/views/produit/premierverif.php';
		break;
		
	case 'mot de passe oublier':
		require '../app/views/produit/motdepasseoublier.php';
		break;
	case 'verif code motdepasse oublier':
		require '../app/views/produit/verifmotdepasseoublier.php';
		break;
	case 'change password':
		require '../app/views/produit/changepassword.php';
		break;
		case 'les enchéres terminées':
			require '../app/views/produit/enchereterminer.php';
			break;
	default:
		require '../app/views/produit/principal.php';
		break;
		
}
$contenu=ob_get_clean();
require '../app/views/templates/templates.php';

?>