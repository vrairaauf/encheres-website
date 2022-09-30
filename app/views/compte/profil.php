
<?php
if(!isset($_SESSION['user'])){
	header('location: index.php?p=connexion');
}
$app=App::get_instance();
//_________________________________________
//systeme d'en ligne
$user=$app->get_table('user');
$en_ligne=$user->en_ligne($_SESSION['user']);

if($en_ligne===false){
$l=$user->add_en_ligne($_SESSION['user']);
}else{
$l=$user->reste_en_ligne($_SESSION['user']);
}
$r=$user->remove_or_ligne();
//_________________________________________
$user =$app->get_table('user')->get_user($_SESSION['user']);

$images=$app->get_table('image')->get_user_image($user->id_user);

echo '<div class="userspace">';
echo '<h2>la page de profil</h2>';
echo '<table>';
echo '<tr>';
echo '<td>';
if($images){
echo '<p><img src="'.$images->path_image.$images->nom_image.'"></p>';
}else{
echo '<p><img src="../app/views/produit/image/40395162_902678353254404_1408934987473879040_n.jpg"></p>';

}
echo '</td>';
echo '<td>';
echo '<h2>'.$user->pseudo.'</h2>';
echo '</td>';
echo '</tr>';
echo '</table>';
echo '</div>';

echo '<hr>';
echo '<div>';
echo '<h3>les evenement en attente </h3>';
$events=$app->get_table('event')->trouve_event($_SESSION['user']);

foreach($events as $event){
	$produit=$app->get_table('produit')->produit_specifier($event->id_produit);
	
	$images=$app->get_table('image')->get_produit_image($produit->id_produit);
	echo '<div class="produit">';
echo '<h3>'.utf8_encode($produit->titre_produit).'</h3>';
echo '<p>';
echo utf8_encode($produit->desc_produit);
echo '</p>';
echo '<table>';
echo '<tr>';
foreach ($images as $image){
echo '<td>';
//'.$image->voir().'
echo '<a href=""><img src="'.$image->image_path().'" class="imagepub"></a>';
echo '</td>';
}
echo '</tr>';
echo '</table>';
/*echo '<pre>';
echo utf8_encode($produit->desc_produit);
echo '</pre>';*/
echo "<hr>";
echo '<h4>prix original  :'.$produit->prix_original.' TND</h4>';
echo '</div>';
echo '<br>';
}
$gagnant=$app->get_table('gagnant')->event_gagnee($_SESSION['user']);
if($gagnant){
	echo '<hr>';
	echo '<h2>les produit gagnée</h2>';
	
	foreach($gagnant as $element){
		$produit_gagnant=$app->get_table('produit')->produit_specifier($element->id_produit);
		$images_prod_gagnant=$app->get_table('image')->get_produit_image($produit_gagnant->id_produit);
		echo '<div class="produit">';
echo '<h3>'.utf8_encode($produit_gagnant->titre_produit).'</h3>';
echo '<p>';
echo utf8_encode($produit_gagnant->desc_produit);
echo '</p>';
echo '<table>';
echo '<tr>';
foreach ($images_prod_gagnant as $image){
echo '<td>';

echo '<a href=""><img src="'.$image->image_path().'" class="imagepub"></a>';
echo '</td>';
}
echo '</tr>';
echo '</table>';
echo '<p><a href="?page=profil&tache=pdf&idprod='.$produit_gagnant->id_produit.'">telecharger certificat</a></P>';
if(isset($_GET['tache']) AND $_GET['tache']==='pdf'){
    $winner=$app->get_table('gagnant')->get_event_winner($_GET['idprod']);

    header('location: pdf_files.php?gagnant='.$winner->id_gagnant);
}
echo '</div>';
	}
	echo '<br>';
	echo '<hr>';
}

echo '<h2>le nombre de coupons :</h2>';
$nb=$app->get_table('user')->get_nombre_decoupon($_SESSION['user']);

echo '<h1>'.$nb->coupon.'</h1>';
echo '<hr>';

$achats=$app->get_table('achat')->get_achat($_SESSION['user']);
if(!empty($achats)){
	echo '<h2>les achats réalisée :</h2>';
echo '<div class="facture">';
echo '<table>';
echo '<thead>';

echo '<td>';
echo '<h4>date de l\'achat</h4>';
echo '</td>';
echo '<td>';
echo '<h4>type de l\'achat</h4>';
echo '</td>';
echo '<td>';
echo '<h4>nombre de coupon acheter</h4>';
echo '</td>';
echo '<td>';
echo '<h4>montant de l\'achat</h4>';
echo '</td>';

echo '</thead>';

foreach($achats as $achat){
	
echo '<tr class="bodtable">';
echo '<td>';
echo '<h4>'.$achat->date_achat.'</h4>';
echo '</td>';
if($achat->id_produit!=='0'){
		$produit=$app->get_table('produit')->produit_specifier($achat->id_produit);

	echo '<td>';
	echo '<h4>'.$produit->titre_produit.'</h4>';
	echo '</td>';
}else{
	echo '<td>';
	echo '<h4>acheter des coupons</h4>';
	echo '</td>';
}	
echo '<td>';
echo '<h4>'.$achat->nb_coupon.'</h4>';
echo '</td>';
echo '<td>';
echo '<h4>'.$achat->montant.'</h4>';
echo '</td>';
echo '</tr>';
	
}
echo '</table>';
echo '</div>';
}else{
	echo '<p>aucune achat realiser !!!</p>';
}
echo '</div>';
?>