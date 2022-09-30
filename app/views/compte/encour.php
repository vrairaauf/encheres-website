<p>les evenement en cours</p>
<?php
if(!isset($_SESSION['user'])){
	header('location: index.php?p=connexion');
}

$app=App::get_instance();
$events=$app->get_table('produit')->get_produit_encour();

foreach($events as $event){
	echo '<div>';
	echo '<p>'.$event->titre_produit.'</P>';
	echo '<p>'.$event->date_ouvrir.'</p>';
	echo '<p><a href="'.$event->voir_room_event().'">voir cet evenement</a></p>';
	echo '</div>';
}
?>