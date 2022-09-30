<div>
	<?php
	if(!isset($_SESSION['user'])){
	header('location: index.php?p=connexion');
}
//_________________________________________
//systeme d'en ligne
	$app=App::get_instance();
$user=$app->get_table('user');
$en_ligne=$user->en_ligne($_SESSION['user']);

if($en_ligne===false){
$l=$user->add_en_ligne($_SESSION['user']);
}else{
$l=$user->reste_en_ligne($_SESSION['user']);
}
$r=$user->remove_or_ligne();
//_________________________________________

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
	}elseif(!isset($_POST['offre'])){
	$error['erreur']='choisir un offre ';
	}
	else{
		$app=App::get_instance();
		switch($_POST['offre']){
			case 'deuxieme':
			$_POST['montant']=15;
			break;
			case 'troisieme':
			$_POST['montant']=20;
			break;
			default:
			$_POST['montant']=10;
			break;
		}
		$nbcoupon=$app->get_table('coupon')->achete_coupon(htmlentities($_POST['montant']), $_POST['utilisateur'], $_POST['offre']);
		$achat=$app->get_table('achat')->ajout_achat(htmlentities($_POST['montant']), $nbcoupon, $_POST['utilisateur']);
		$set_coupon=$app->get_table('user')->set_coupon($_SESSION['user'], $nbcoupon);
		$trace_operation_achat=$app->get_table('achat')->trace_achat($_SESSION['user'], $_POST['montant'], $nbcoupon, $_POST['utilisateur']);
		echo 'vous avez acheter des coupon';
	}
		$firstname=htmlentities($_POST['fullname']);
		$lastname=htmlentities($_POST['lastname']);
		$cardfirstname=htmlentities($_POST['cardfirstname']);
		$cardlastname=htmlentities($_POST['cardlastname']);
		$cardnumber=htmlentities($_POST['cardlastname']);
		$securecode=htmlentities($_POST['securecode']);
		$cvv=htmlentities($_POST['cvv']);
		$montant=htmlentities($_POST['montant']);
}
	?>
	<form method="post">

		<div>
	<?php echo '<p>'.$error['erreur'].'</p>' ?>	
		</div>
		<div>
			<input type="radio" name="offre" value="premier"><span>acheter 5 coupons avec 10 dinar</span>
			<br>
			<input type="radio" name="offre" value="deuxieme"><span>acheter 10 coupons avec 20 dinar</span>
			<br>
			<input type="radio" name="offre" value="troisieme"><span>acheter 15 coupons avec 20 dinar</span>
			<br>

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
		<p>montant &nbsp&nbsp:<input type="number"  name="montant" value="<?php

	if(isset($montant)){
	echo $montant;
	}
	
		?>">  :TND</p>
		<p><input type="hidden" name="utilisateur" value="<?php
echo $_SESSION['user'];
		?>">
		<br>
		<p><input type="submit" name="submit" value="payer"></p>
	</form>
</div>