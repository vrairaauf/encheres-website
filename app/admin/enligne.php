<?php
if(!isset($_SESSION['admin'])){
	header('location: ?p=login');
}
$app=App::get_instance();
$enlignes=$app->get_table('enligne')->all();
var_dump($enlignes);
echo '<h1>les personne connectant sur le site:</h1>';
echo '<div>';
echo '<table>';
foreach($enlignes as $personne){

	$user=$app->get_table('user')->get_user($personne->id_user);
	
	echo '<tr>';
	echo '<td>';
	echo '<span>'.$user->nom_user.'  '.$user->prenom_user.'     &nbsp&nbsp</span>';
	echo '</td>';
	echo '<td>';
	echo '<span class="enligne"> ...   </span>';
	echo '</td>';
	     

	
}
echo '</tr>';
echo '</table>';
echo '</div>';
//le menue des choix
echo '<hr>';
require '../app/admin/adminmenu.php';
?>