<?php
if(isset($_POST['affichemenue'])){
	$etat=$_POST['affichemenue'];
}else{
	$etat='hiddenmenu';
}

$app=App::get_instance();
$menus=$app->get_table('menu')->menu();
echo '<div class="'.$etat.'">';
echo '<ul>';
foreach($menus as $menu){
	echo '<li>';

	if(!isset($_GET['p'])){
		$_GET['p']='';
	}
	$test=$_GET['p'];
	if(utf8_encode($menu->titre) === $test){
		echo '<p>'.utf8_encode($menu->titre).'</p>';
	}else{
	
	echo '<p><a href="'.$menu->lien().'">'.utf8_encode($menu->titre).'</a></P>';
}
	echo '</li>';
}
echo '</ul>';
echo '</div>';
?>