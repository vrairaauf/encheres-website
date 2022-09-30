<?php
namespace app\table;
use core\table\Table; 
class EventTable extends Table{
	public function ajout_event($id_offre, $id_user){
		
		$d=date('Y-m-d H:i:s');
		
			$inser=$this->db->getPDO()->exec('INSERT INTO evenement SET id_user="'.$id_user.'",id_produit="'.$id_offre.'", date_inscri="'.$d.'"');
		
		return 'inscription dans cette offre est validee';
		
	}
	public function trouve_event($id_user){
		return $this->create_req('SELECT * FROM evenement WHERE id_user=? AND situation="en_cour"', [$id_user]);
	}
	public function nb_membre($id_produit){
		return $this->create_req('SELECT COUNT(id_user) AS nb_membre FROM evenement WHERE id_produit=?', [$id_produit] , true);
	}
	public function inscri($id_user, $id_produit){
		return $this->create_req('SELECT * FROM evenement WHERE id_user=? AND id_produit=?',[$id_user, $id_produit], true);
	}
	public function set_situation($id_produit){
		return $this->db->getPDO()->exec('UPDATE evenement SET situation="fermer" WHERE id_produit="'.$id_produit.'"');
	}

}
?>