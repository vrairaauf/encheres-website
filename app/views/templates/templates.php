  <!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initiale-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../public/css/principal.css">
	<link rel="stylesheet" type="text/css" href="../public/css/font/fontawesome-free-5.15.3-web/css/all.css">
	
</head>
<body>
<div class="templatemain">
	<table>
<tr>
	<?php

	?>
	<td id="fenetre">
		
	</td>
	<td id="contenu"> 
		<?php
echo '<div class="menudenavigation">';
require '../app/views/produit/complements/header.php';
echo '</div>';
	?>
<h2 style="text-align: center;"><a href="index.php?p=principal" style="text-decoration: none;color:black;"><strong>batta.tn</strong></a></h2>
	</td>
	<td id="pub"></td>
</tr>		
<tr>
			<td class="container" id="fenetre">
<div class="menuu">
	<ul>
		<?php
$app=App::get_instance();
$menus=$app->get_table('menu')->menu();

foreach($menus as $menu){
	echo '<li>';
	/*if($menu->titre==$_GET['tache']){
		echo '<p >'.utf8_encode($menu->titre).'</p>';
	}else{*/
	
	echo '<p><a href="'.$menu->lien().'">'.utf8_encode($menu->titre).'</a></P>';
//}
	echo '</li>';
}
		?>
	</ul>
</div>
<div class="deuxiememenu">
	<ul>
		<li><a href="index.php?p=commentaire">dernier commentaires</a></li>
		<br>
		<li>votre email : </li>

		<div>

			<form method="post">
				<?php
			$erreur['information']="
			";
if(isset($_POST['submitemail'])){
	
	$app=App::get_instance();
	if(empty($_POST['email'])){
		$erreur['information']='veiller saisir votre email';
	}else{
		$email=$app->get_table('email')->ajout_email($_POST['email']);
		$erreur['information']=$email;
	}
}
			?>
				<p><?php 
					echo $erreur['information'];
				 ?></p>
				<input type="email" name="email">
				<p><input type="submit" name="submitemail" value="envoyer"></p>
			</form>
		</div>
	</ul>
</div>
			</td>
			<td id="contenu">
				
<?php
echo $contenu;
?>
<div class="publicitecenter">
	<p>
		<a href=""><img src="../app/views/publicite/image/th (3).jpg"></a>
	</p>
</div>
<div class="deuxiememenucenter">
	<ul>
		<li><a href="index.php?p=commentaire">dernier commentaires</a></li>
		<br>
		<li>votre email : </li>

		<div>

			<form method="post">
				<?php
			$erreur['information']="
			";
if(isset($_POST['submitemail'])){
	
	$app=App::get_instance();
	if(empty($_POST['email'])){
		$erreur['information']='veiller saisir votre email';
	}else{
		$email=$app->get_table('email')->ajout_email($_POST['email']);
		$erreur['information']=$email;
	}
}
			?>
				<p><?php 
					echo $erreur['information'];
				 ?></p>
				<input type="email" name="email">
				<p><input type="submit" name="submitemail" value="envoyer"></p>
			</form>
		</div>
	</ul>
</div>

			</td>
			<td id="pub"><?php
require '../app/views/publicite/publicite.php';
			?></td>
		</tr>
	<tr>
		<td class="contenu"  colspan="3"><?php
require '../app/views/compte/footer.php';
	?></td>
	
	</tr>
	</table>
</div>
</body>
</html>