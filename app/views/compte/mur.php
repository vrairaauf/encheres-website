<?php

if(!isset($_SESSION['user'])){
	header('location: index.php?p=connexion');
}
$app=App::get_instance();
//___________________systeme de notification______
$base_information=$app->get_table('informationbase')->get_base_information(intval($_SESSION['user']));

if(!$base_information){
	$notifier=$app->get_table('notification')->revoir_base_notification(intval($_SESSION['user']));
}
//_________________________________________________
$user=$app->get_table('user');
$nbp=1;
if(isset($_GET['nbp'])){
	$nbp=$_GET['nbp'];
}
//_____________les notification_________
$notifications=$app->get_table('notification')->get_notification(intval($_SESSION['user']));

if($notifications){
echo '<div>';
	foreach($notifications as $notification){
		echo '<div class="notification">';
		echo '<p class="">'.$notification->lien().'</p>';
		echo '<p>'.$notification->get_extrai().'</p>';
		echo '</div>';
		echo '<br>';
	}
	echo '</div>';
}
//______________________________________
//_________________________________________
//systeme d'en ligne
$en_ligne=$user->en_ligne($_SESSION['user']);

if($en_ligne===false){
$l=$user->add_en_ligne($_SESSION['user']);
}else{
$l=$user->reste_en_ligne($_SESSION['user']);
}
$r=$user->remove_or_ligne();
//________________________________________
$lignes=$app->get_table('produit')->nb_ligne();

$total=intval($lignes->total);
$perpage=2;
$totalpage=ceil($total/$perpage)+1;
$debut=$nbp*$perpage-$perpage;
$produits_courant=$app->get_table('Produit')->produit_non_vendu($debut, $perpage);

foreach($produits_courant as $pnv){

$event_membre=$app->get_table('event')->nb_membre($pnv->id_produit);

$porcentage_event=$event_membre->pourcent_event($pnv->nombre_ouvrir);

$inscri=$app->get_table('Produit')->est_il_inscri($pnv->id_produit, $_SESSION['user']);

	$images=$app->get_table('image')->get_produit_image($pnv->id_produit);
echo '<div class="produitnv">';
echo '<h3><a href="'.$pnv->voir_offre().'">'.utf8_encode($pnv->titre_produit).'</a></h3>';

echo '<pre>';
echo $pnv->get_extrai();
echo '</pre>';
echo '<table>';
echo '<tr>';
foreach ($images as $image){
echo '<td>';

echo '<a href=""><img src="'.$image->image_path().'" class="imagepub"></a>';
echo '</td>';
}
echo '</tr>';
echo '</table>';
echo "<hr>";
echo '<h4>prix original  :'.$pnv->prix_original.' TND</h4>';
echo '<br>';
echo '<h1>'.$porcentage_event.'</h1>';
if($pnv->situation==='not_completed'){
if($inscri===false){
echo '<p>'.$pnv->inscription_on_offre().'</p>';
}else{
	echo '<p>vous avez inscri dans cet evenement  </p>';
}
}else{
	echo '<p>en lattent de louverture  </p>';
	if($inscri===true){
		echo '<p>vous avez inscri dans cet evenement  </p>';
	}
	
}
echo '</div>';
echo "<br>";

}
echo '<hr>';
echo '<div class="containerpagination">';
for($i=1;$i<$totalpage; $i++){
	if($nbp==$i){
		echo '<span class="pagination">'.$i.'</span>';
	}else{
		echo '<span class="pagination"><a href="routeur.php?nbp='.$i.'">'.$i.'</a></span>';
	}
}
echo '</div>';
//__________________________
echo '<h3><a href="routeur.php?page=commentaire">voir les commentaire des visiteur</a></h3>';
?>
