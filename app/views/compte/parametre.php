<?php
if(!isset($_SESSION['user'])){
	header('location: index.php?p=connexion');
}
$app=App::get_instance();

$imageprofil=$app->get_table('image')->get_user_image(intval($_SESSION['user']));
$baseinformation=$app->get_table('informationbase')->get_base_information(intval($_SESSION['user']));

if(!$imageprofil){
	require '../app/views/compte/complements/inserimage.php';
}elseif(!$baseinformation){
	require '../app/views/compte/complements/baseinformation.php';
}else{
	if(!$app->get_table('user')->est_il_verifier($_SESSION['user'])){
		echo '<p>attender la verification de votre compte</p>';	
	}

}

echo '<div class="menuparametre">';
$menus=$app->get_table('menuparametre')->get_menu_parametre();

echo '<ul>';
foreach($menus as $menu){
	echo '<li>'.utf8_encode($menu->nom_parametre).'&nbsp&nbsp&nbsp&nbsp&nbsp<a href="'.$menu->lien().'">éditer</a></li>';
}
echo '</ul>';
echo '</div>';
if(isset($_GET['tache'])){
	$root='../app/views/compte/parametre/';
	echo '<div>';
	$tache=$_GET['tache'];
	$tache=str_replace(' ', '', $tache);
	require $root.$tache.'.php';
	echo '</div>';
}

?>
