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
	
	default :
	require '../app/admin/login.php';
	break;

}
$content=ob_get_clean();
require '../app/views/templates/root_template.php';
?>