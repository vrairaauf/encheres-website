<meta name="viewport" content="width=device-width initiale-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../public/css/principal.css">
	<link rel="stylesheet" type="text/css" href="../public/css/font/fontawesome-free-5.15.3-web/css/all.css">
	<div class="">
		<br>
<?php

if(isset($_COOKIE['auth']) AND !isset($_SESSION['user'])){
	$app=App::get_instance();
	$auth=$_COOKIE['auth'];
	$auth=explode('----', $auth);
	$requete=$app->get_table('user')->get_user($auth[0]);
	$key=sha1($requete->email.$requete->password);
	if($key===$auth[1]){
		$_SESSION['user']=$requete->id_user;

		setcookie('auth', $authentif->id_user.'----'.sha1($authentif->username.$authentif->password),time() + (3600 * 24 * 3), '/', 'localhost', false, true);
		header('location: routeur.php?page=mur');
	}else{
		setcookie('auth', '', time()-3600, '/', 'localhost', false, true);
	}

}
$nbp=1;
if(isset($_GET['nbp'])){
	$nbp=$_GET['nbp'];
}

echo '<div>';
require '../app/views/produit/complements/menu.php';
echo '</div>';

	
echo '<div>';

		//$produits_courant=$app->get_table('produit')->produit_non_vendu();
//echo '<h1>les produit que nous allons vendu pendant quelque jour  :</h1>';
//$app=App::get_instance();
//$produits=$app->get_table('produit')->produit_vendu();
$app=App::get_instance();
//___________nombre de visite du site_
$visite=$app->get_table('produit')->setvisite();
$visiteur=$app->get_table('produit')->set_nombre_visiteur($_SERVER['REMOTE_ADDR']);
$datetime_visite=$app->get_table('produit')->ip_visiteur_avec_date($_SERVER['REMOTE_ADDR']);
//____________________________________
$produits=$app->get_table('produit')->tache_publicitaire();
//$produits_courant=$app->get_table('produit')->produit_non_vendu();

if(!empty($produits)){
foreach($produits as $produit){
	$images=$app->get_table('image')->get_produit_image($produit->id_produit);
	
echo '<div class="produit">';
echo '<h4>'.utf8_encode($produit->titre_produit).'</h4>';
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
echo '<h5>prix original  :'.$produit->prix_original.' TND</h5>';
echo '<h5>prix de vente  :'.$produit->prix_vente.' TND</h5>';
echo '</div>';
echo "<br>";
}
}
echo '</div>';

echo '<div>';


//systeme de pagination
$lignes=$app->get_table('produit')->nb_ligne();

$total=intval($lignes->total);
$perpage=2;
$totalpage=ceil($total/$perpage)+1;
$debut=$nbp*$perpage-$perpage;
$ps=$app->get_table('produit')->get_produit($debut, $perpage);
foreach($ps as $pnv){
	
	$images=$app->get_table('image')->get_produit_image($pnv->id_produit);
echo '<div class="produitnv">';
echo '<h3>'.utf8_encode($pnv->titre_produit).'</h3>';
echo '<p class="pre">';
echo utf8_encode($pnv->desc_produit);
echo '</p>';

foreach ($images as $image){

echo '<a href=""><img src="'.$image->image_path().'" class="imagepub"></a>';

}

echo "<hr>";
echo '<h4>prix original  :'.$pnv->prix_original.' TND</h4>';

echo '<p class="rejoindre"><a href="'.$pnv->vers_offre($_SERVER['REMOTE_ADDR']).'">rejoindre cette offre</a></p>';
echo '</div>';
echo "<br>";

}
echo '<div class="containerpagination">';
for($i=1;$i<$totalpage; $i++){
	if($nbp==$i){
		echo '<span class="pagination">'.$i.'</span>';
	}else{
		echo '<span class="pagination"><a href="index.php?p=principal&nbp='.$i.'">'.$i.'</a></span>';
	}
}
echo '</div>';
echo '</div>';
	?>
	<br>
	<br>
</div>


