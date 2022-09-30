<p>veiller entrer vos coordonne</p>
<div>
	<?php
$erreur['erreur']='';
if(isset($_POST['submit'])){
	if(!empty($_POST['username']) || !empty($_POST['password'])){
		$username=strip_tags($_POST['username']);
		$password=strip_tags($_POST['password']);
		$app=App::get_instance();
		$admin=$app->get_table('admin')->verif_admin($username, $password);
		
		if($admin){
			$_SESSION['admin']=$admin->id;
			
			
			header('location: ?p=dashbord');
		}
	}else{
		$erreur['erreur']='vos coordonne sont incorrect';
	}
}
	?>
	<form method="post">
		<p><?php echo $erreur['erreur']; ?></p>
		<input type="text" name="username" placeholder="username">
		<br>
		<input type="password" name="password" placeholder="password">
		<br>
		<input type="submit" name="submit" value="login">
	</form>
</div>
<?php
//le menue des choix

?>