<?php
$app=App::get_instance();
$produit=$app->get_table('produit')->produit_specifier($_GET['id']);
$inscri=$app->get_table('event')->inscri($_SESSION['user'], $_GET['id']);

echo '<div style="text-align:center;" class="produit">';
echo '<h3>'.$produit->titre_produit.'</h3>';
$images=$app->get_table('image')->get_produit_image($_GET['id']);

	echo '<table>';
echo '<tr>';
foreach ($images as $image){
echo '<td>';

echo '<a href=""><img src="'.$image->image_path().'" class="imagepub"></a>';
echo '</td>';
}
echo '</tr>';
echo '</table>';

echo '</div>';
echo '<hr>';
		require '../app/views/compte/temps.php'; 
		require '../app/views/compte/chronometre.php';
	
echo '<hr>';
echo '<div style="text-align:center;">';
		require '../app/views/compte/message.php';
echo '</div>';
echo '<hr>';
if($inscri){
	echo '<div id="clavier">';
		require '../app/views/compte/clavier.php';
	echo '</div>';
}
echo '<div>';
		require '../app/views/compte/getwinner.php';
		
echo '</div>';

?>
