<?php
if(isset($_POST['affichemenue'])){
	$etat=$_POST['affichemenue'];
}else{
	$etat='hiddenmenu';
}
$app=App::get_instance();
$menus=$app->get_table('menu')->menu_site();

echo '<div class="'.$etat.'">';
echo '<ul>';
foreach($menus as $menu){
	echo '<li><a href="'.$menu->site_menu_lien().'">'.utf8_encode($menu->titre).'</a></li>';
}
echo '</ul>';
echo '</div>';
?>