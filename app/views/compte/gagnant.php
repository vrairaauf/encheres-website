<p>la page de gagnat</p>
<?php
$app=App::get_instance();
$winner=$app->get_table('gagnant')->get_event_winner($_GET['idprod']);
$user_winner=$app->get_table('user')->get_user($winner->id_user);
$produit=$app->get_table('produit')->produit_specifier($_GET['idprod']);
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

echo '<a href=""><img src="'.$image->image_path().'" class="imagepub"></a>';
echo '</td>';
}
echo '</tr>';
echo '</table>';
echo "<hr>";
echo '<h4>prix original  :'.$produit->prix_original.' TND</h4>';
echo '<h4>prix de vente :'.$produit->prix_vente.'TND</h4>';
echo '<h5>le winner : '.$user_winner->pseudo.'</h5>';
if($_SESSION['user']===$user_winner->id_user){
    //echo '<a href="?page=certificat&gagnant='.$winner->id_gagnant.'">telecharger le certificat</a>';
    echo '<br>';
    echo '<a href="?page=gagnant&tache=pdf&idprod='.$_GET['idprod'].'">voir certificat</a>';
}
if(isset($_GET['tache']) AND $_GET['tache']==='pdf'){
    $winner=$app->get_table('gagnant')->get_event_winner($_GET['idprod']);
    //header('location: final.php?p=gagnant&gagnant='.$winner->id_gagnant);
    header('location: pdf_files.php?gagnant='.$winner->id_gagnant);
}
echo '</div>';
?>