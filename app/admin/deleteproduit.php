<?php
if(!isset($_SESSION['admin'])){
	header('location: ?p=login');
}
$app=App::get_instance();
$produits=$app->get_table('produit')->produit_all_vendu();

if(isset($_POST['submit'])){
	
	if(isset($_POST['supprimer'])){
		foreach($_POST['supprimer'] as $k=> $element){
			$delete=$app->get_table('produit')->delete_produit(intval($element));
			$delete_chrono=$app->get_table('chrono')->delete_chrono(intval($element));

		}
		echo 'success';
	}else{
		echo 'selectionner des produit pour le supprimer';
	}
}
if(!empty($produits)){
echo '<form method="post">';
echo '<table>';
foreach($produits as $produit){
	$images=$app->get_table('image')->get_produit_image($produit->id_produit);

echo '<tr>';	
echo '<td>';
echo '<input type="checkbox" name="supprimer[]" value="'.$produit->id_produit.'">';
echo '</td>';
echo '<td>';			
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

echo "<hr>";
echo '<h5>prix original  :'.$produit->prix_original.' TND</h5>';
echo '<h5>prix de vente  :'.$produit->prix_vente.' TND</h5>';
echo '</div>';
echo '<td>';
echo '</tr>';	

}
echo '</table>';
echo '<input type="submit" name="submit" value="supprimer">';
echo '</form>';	
}else{
	echo '<h4>il nyapas des produits pour le supprimer</h4>';
}
//le menue des choix
echo '<hr>';
require '../app/admin/adminmenu.php';
?>