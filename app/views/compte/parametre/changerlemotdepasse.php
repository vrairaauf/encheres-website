<?php
$one_parametre=$app->get_table('menuparametre')->one_parametre($_GET['id']);
echo '<p>'.$one_parametre->desc_parametre.'</p>';

echo '<div>';
$table['erreur']="";
if(isset($_POST['changepassword'])){
    var_dump($_POST);
    
    foreach($_POST AS $k=>$v){
        if(empty($v)){
            $table['erreur']='veiller completer votre&nbsp&nbsp:&nbsp&nbsp'.str_replace('-', ' ', $k);
        } 
    }
        if(empty($table['erreur'])){
            if($_POST['ancien-mot-de-passe']!=$_POST['verifier-ancien-mot-de-passe']){
                $table['erreur']="votre mot de passe est incorrect (different)";
            }else{
                $password=$app->get_table('user')->get_user($_SESSION['user']);
                if($password->password===md5($_POST['ancien-mot-de-passe'])){
                    
                    $update_password=$app->get_table('user')->update_password($_POST['nouveau-mot-de-passe'], $_SESSION['user']);
                }else{
                    $table['erreur']='mot de passe incorrect slvp reverifier';
                }
            }
        
    }
}
echo '<form method="post">';
echo '<h5>'.$table['erreur'].'</h5>';
echo '<p>ancien mot de passe: &nbsp&nbsp&nbsp<input name="ancien-mot-de-passe" type="password"></p>';
echo '<p>confirmer ancien  mot de passe: &nbsp&nbsp&nbsp<input name="verifier-ancien-mot-de-passe" type="password"></p>';
echo '<p>nouveau mot de passe: &nbsp&nbsp&nbsp<input name="nouveau-mot-de-passe" type="password"></p>';
echo '<p><input name="changepassword" type="submit" value="changer le mot de passe"></p>';
echo '</form>';
echo '</div>';
?>