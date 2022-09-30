<?php
$one_parametre=$app->get_table('menuparametre')->one_parametre($_GET['id']);
echo '<p>'.$one_parametre->desc_parametre.'</p>';
$informations=$app->get_table('user')->get_user($_SESSION['user']);
echo '<div>';
$table['erreur']="";
if(isset($_POST['changeinformation'])){
foreach($_POST as $k=>$v){
    if($v===""){
        $table['erreur']='completer votre &nbsp&nbsp:&nbsp&nbsp'.$k;
    }
}
if(empty($table['erreur'])){
    $verif_pseudo=$app->get_table('user')->cherche_pseudo($_POST['pseudo']);
    if($verif_pseudo){
        $update_informations=$app->get_table('user')->update_user_informations($_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_SESSION['user']);
        echo 'vos informations sont mis a jour';
    }else{
        $table['erreur']="cet pseudo existe slv choisir un autre pseudo";
    }
}
}
echo '<form method="post">';
echo '<p>'.$table['erreur'].'</p>';
echo '<p><input type="text" name="nom" value="'.$informations->nom_user.'"></p>';
echo '<p><input type="text" name="prenom" value="'.$informations->prenom_user.'"></p>';
echo '<p><input type="text" name="pseudo" value="'.$informations->pseudo.'"></p>';
echo '<p><input type="submit" name="changeinformation" value="effectuer les echanges"></p>';
echo '</form>';
echo '</div>';
?>