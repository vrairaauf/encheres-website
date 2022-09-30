<?php
if(!isset($_SESSION['admin'])){
	header('location: ?p=login');
}
$app=App::get_instance();
$users=$app->get_table('user')->all();

foreach($users as $user){
			$ajout=$app->get_table('sauvegardeuser')->ajout_user($user->id_user, $user->nom_user, $user->prenom_user, $user->email, $user->password, $user->pseudo, $user->premier_verif, $user->verifier_user);
			var_dump($ajout);
		}

?>