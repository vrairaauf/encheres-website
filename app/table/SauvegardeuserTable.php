<?php
namespace app\table;
use core\table\Table; 


class SauvegardeuserTable extends Table{
	public function ajout_user($id_user, $nom_user, $prenom_user, $email, $password, $pseudo, $verifier, $tverif){
		return $this->db;
		//return $this->db->getPDO()->exec('INSERT INTO user SET id_user="'.$id_user.'", nom_user="'.$nom_user.'", prenom_user="'.$prenom_user.'", email="'.$email.'", password="'.$password.'", pseudo="'.$pseudo.'", verifier="'.$verifier.'", tous_verif="'.$tverif.'"');
	}
	
}
?>