<?php
if(!isset($_SESSION['user'])){
	header('location: index.php?p=connexion');
}
$app=App::get_instance();
//_________________________________________
//systeme d'en ligne
$user=$app->get_table('user');
$en_ligne=$user->en_ligne($_SESSION['user']);

if($en_ligne===false){
$l=$user->add_en_ligne($_SESSION['user']);
}else{
$l=$user->reste_en_ligne($_SESSION['user']);
}
$r=$user->remove_or_ligne();
//_________________________________________
$verif=$app->get_table('user')->est_il_verifier($_SESSION['user']);


$produit=$app->get_table('produit')->produit_specifier(htmlentities($_GET['id_offre']));

$images=$app->get_table('image')->get_produit_image($produit->id_produit);


echo '<div class="produitnv">';
echo '<h3>'.utf8_encode($produit->titre_produit).'</h3>';

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
echo '<p>pour rejoindrere cette offreil faut payer un frais : '.$produit->prix_participe.'  TND</p>';

echo '</div>';
echo "<br>";
?>
<hr>
<?php
if($verif){
?>
<div>
	<?php
	

$error=['erreur'=>''];
if(isset($_POST['submit'])){

	if(empty(htmlentities($_POST['fullname']))){
		$error['erreur']='taper votre full name';

	}elseif (empty(htmlentities($_POST['lastname']))) {
		$error['erreur']='taper votre last name';
	}elseif (empty(htmlentities($_POST['cardfirstname']))) {
	$error['erreur']='taper votre first card name';
	}elseif (empty(htmlentities($_POST['cardlastname']))) {
	$error['erreur']='taper votre last card name';
	}elseif (empty(htmlentities($_POST['cardnumber']))) {
	$error['erreur']='taper votre card number';
	}elseif (empty(htmlentities($_POST['securecode']))) {
	$error['erreur']='taper votre secure code';
	}elseif (empty(htmlentities($_POST['montant']))) {
	$error['erreur']='taper  votre montant a payer';
	}
	else{
		$firstname=htmlentities($_POST['fullname']);
		$lastname=htmlentities($_POST['lastname']);
		$cardfirstname=htmlentities($_POST['cardfirstname']);
		$cardlastname=htmlentities($_POST['cardlastname']);
		$cardnumber=htmlentities($_POST['cardlastname']);
		$securecode=htmlentities($_POST['securecode']);
		$cvv=htmlentities($_POST['cvv']);
		$montant=htmlentities($_POST['montant']);
		$mescoupon=$app->get_table('coupon')->coupon_nombre($_POST['utilisateur']);
				if(intval($mescoupon->nombre_coupon)<5){
			echo '<div>';
			echo '<h3>pour abboner dans une offre il faut que votre nombre de coupon depasse le 5 coupons</h3>';
			echo '<p><a href="'.$mescoupon->achet_coupon().'">acheter des coupons</a></p>';
			echo '</div>';

		}else{
			//____________________
			//verifier lachat avec les api
			//_______________________
			$event=$app->get_table('event')->ajout_event($_POST['offre'], $_POST['utilisateur']);
			$nb_inscri=$app->get_table('event')->nb_membre($produit->id_produit);
			if(intval($nb_inscri->nb_membre)===intval($produit->nombre_ouvrir)){
				$update=$app->get_table('produit')->set_situation($produit->id_produit);
			}
			echo '<h3>votre inscription dans loffre est valider avec succe</h3>';
			//_________lenregistrement de trace
			$trace_rejoindre=$app->get_table('produit')->trace_rejoindre($produit->id_produit, $produit->titre_produit, $_POST['utilisateur'], $_POST['montant']);
			//__________________________________
			$firstname=htmlentities($_POST['fullname']);
			$lastname='';
		$cardfirstname='';
		$cardlastname='';
		$cardnumber='';
		$securecode='';
		$cvv='';
		$montant=htmlentities($_POST['montant']);
			
		}
		
	}
	
}
	?>
	<form method="post">
		<div>
	<?php echo '<p>'.$error['erreur'].'</p>' ?>	
		</div>

		<p>Full Name :<input type="text" name="fullname" value="<?php
if(isset($firstname)){
	echo $firstname;
	}
		?>">          &nbsp&nbsp&nbsp    <input type="text" name="lastname" value="<?php
if(isset($lastname)){
	echo $lastname;
	}
		?>"></p>
		<p><hr></p>
		<h4>Credit Card</h4>
		<p>First Name :<input type="text" name="cardfirstname" value="<?php
if(isset($cardfirstname)){
	echo $cardfirstname;
	}
		?>">&nbsp&nbsp Last Name<input type="text" name="cardlastname" value="<?php
if(isset($cardlastname)){
	echo $cardlastname;
	}
		?>"></p>
		<p>Credit Card Number<input type="text" name="cardnumber" value="<?php
if(isset($cardnumber)){
	echo $cardnumber;
	}
		?>">&nbsp&nbsp&nbsp Security Code: <input type="password" name="securecode" value="<?php
if(isset($securecode)){
	echo $securecode;
	}
		?>"></p>
		<p>CVV &nbsp&nbsp:<input type="number" name="cvv" value="<?php
if(isset($cvv)){
	echo $cvv;
	}
		?>"></p>
		<p>montant &nbsp&nbsp:<input type="number" readonly=""  name="montant" value="<?php

	echo $produit->prix_participe ;
	
		?>">  :TND</p>
		<p><input type="hidden" name="utilisateur" value="<?php
echo $_SESSION['user'];
		?>"></p>
		<p><input type="hidden" name="offre" value="<?php
echo $_GET['id_offre'];
		?>"></p>
		<br>
		<p><input type="submit" name="submit" value="payer"></p>
	</form>
</div>
<?php
}else{
	echo '<h3>pour rejoindrer des evenements il faut tous dabord de verifier votre compte <a href="routeur.php?page=parametre">verifier le compte</a></h3>';
}
?>