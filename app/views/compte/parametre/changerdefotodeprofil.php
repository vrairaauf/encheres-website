<?php
$one_parametre=$app->get_table('menuparametre')->one_parametre($_GET['id']);
echo '<p>'.$one_parametre->desc_parametre.'</p>';
$image=$app->get_table('image')->get_user_image($_SESSION['user']);
echo '<div>';
$table['erreur']='';
if(isset($_POST['changefotodeprofil'])){
    
    if(empty($_FILES['nouveauimage']['name'])){
        $table['erreur']='veiller selectionner une image';
    }else{
        $change_foto=$app->get_table('image')->change_user_image($_FILES['nouveauimage']['name'], $_SESSION['user'], $_FILES['nouveauimage']['tmp_name']);
    }
    
}
echo '<form method="post" enctype="multipart/form-data">';
echo '<p>'.$table['erreur'].'</p>';
echo '<p><img style="width:300px;height:300px;" src="'.$image->path_image.$image->nom_image.'"></p>';
echo '<p><input type="file" name="nouveauimage"></p>';
echo '<p><input type="submit" name="changefotodeprofil" value="changer"></p>';
echo '<form>';
echo '</div>';
?>