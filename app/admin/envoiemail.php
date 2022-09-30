<?php
if(!isset($_SESSION['admin'])){
	header('location: ?p=login');
}
$app=App::get_instance();
echo '<div>';
$table['erreur']="";
if(isset($_POST['envoiemails'])){
    
    if(!isset($_POST['R']) OR !isset($_POST['notification']) OR !isset($_POST['emails'])){
        echo 'completer tous les champs necessaire';
    }else{
       $produit=$app->get_table('produit')->produit_specifier(intval($_POST['R']));
       foreach($_POST['emails'] as $k=>$v){
        $envoie_emails=$app->get_table('email')->envoie_emails(intval($v), $_POST['notification'], $produit->titre_produit.$produit->prix_original);
       }
    }
}
echo '<form method="post">';
echo '<p>'.$table['erreur'].'</p>';
echo '<p>selectionner un seul produit pour tels vos membre de cet produit</p>';
$produits=$app->get_table('produit')->all_non_vendu_product();
echo '<div>';
echo '<table>';
foreach($produits as $produit){
    $image=$app->get_table('image')->get_une_image_pour_produit($produit->id_produit);
    echo '<tr>';
    echo '<td>';
    echo '<p><input type="radio" name="R" value="'.$produit->id_produit.'"></P>';
    echo '</td>';
    echo '<td>';
    echo '<p>'.$produit->titre_produit.'</p>';
    if($image){
    echo '<p><img style="width:200px;height:200px;" src="'.$image->path_image.$image->nom_image.'"></p>';
    }
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
echo '</div>';
echo '<p>ajouter un texte pour motivie vos membre</p>';
echo '<p><textarea cols="80" rows="15" name="notification"></textarea></p>';
$emails=$app->get_table('email')->get_all_emails();
foreach($emails as $email){
    echo '<p><input type="checkbox" name="emails[]" value="'.$email->id_email.'">'.$email->email.'</p>';
}
echo '<p><input type="submit" name="envoiemails" value="envoyer"></P>';
echo '</form>';
echo '</div>';

?>
<?php
//le menue des choix
require '../app/admin/adminmenu.php';

?>