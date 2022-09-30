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
$produit=$app->get_table('produit')->produit_specifier($_GET['id_offre']);

$images=$app->get_table('image')->get_produit_image($produit->id_produit);
$inscri=$app->get_table('Produit')->est_il_inscri($produit->id_produit, $_SESSION['user']);

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
if($inscri===false){
echo '<p>'.$produit->inscription_on_offre().'</p>';
}else{
	echo '<p>vous avez deja inscri dans cet evenement</p>';
}
echo '</div>';
echo "<br>";

?>