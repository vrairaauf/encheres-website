<?php
echo '<div>';
require '../app/views/produit/complements/menu.php';
echo '</div>';
$app=App::get_instance();
$commentaires=$app->get_table('commentaire')->get_commentaire();

foreach($commentaires as $commentaire){
	$auteur=$app->get_table('user')->get_user($commentaire->id_user);
	echo '<div class="commentairediv">';
	echo '<h3>'.$auteur->pseudo.'</h3>';
	echo '<p>';
	echo $commentaire->contenu;
	echo '</p>';
	echo '<p><strong>'.$commentaire->date_commentaire.'</strong></p>';
	echo '</div>';
	echo '<br>';
}




?>
<?php
if(isset($_SESSION['user'])){
	
	?>
<div>
	<h3>ajouter un commentaire</h3>
	<form method="post">
		<?php
		echo '<hr>';
		$error['information']='';
		if(isset($_POST['submit'])){
			
			if(!isset($_POST['commentaire']) || empty($_POST['commentaire'])){
				$error['information']='veiller entrer un commentaire';
			}else{
				$commentaires=$app->get_table('commentaire')->ajout_commentaire($_POST['utilisateur'], $_POST['commentaire']);
				$error['information']='votre commentaire est sauvegardee avec succe';
			}
		}
		?>
		<p><?php echo $error['information']; ?></p>
		<p><input type="hidden" name="utilisateur" value="<?php echo $_SESSION['user']; ?>" readonly=""></p>
		<p><textarea cols="40" rows="20" name="commentaire"></textarea></p>
		<p><input type="submit" name="submit" value="poster"></p>
	</form>
</div>
<?php
}else{
	echo '<p class="connecterpourajoutercommentaie"><a href="index.php?p=templatemain&tache=connexion">connecter pour ajouter un commentaire</a></p>';
}
?>