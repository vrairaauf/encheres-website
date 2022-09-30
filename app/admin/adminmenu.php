<?php
$app=App::get_instance();
$menues=$app->get_table('adminmenu')->all();

echo '<div>';
echo '<ul>';
$page='';
if(isset($_GET['p'])){
	$page=$_GET['p'];
}
foreach($menues as $menu){
	if(utf8_encode($menu->titre)==$page){
		echo '<li>'.utf8_encode($menu->titre).'</li>';
	}else{
		echo '<li>'.$menu->lien().'</li>';
	}
}
echo '</ul>';
echo '</div>';
?>