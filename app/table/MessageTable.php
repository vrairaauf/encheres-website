<?php
namespace app\table;
use core\table\Table; 
class MessageTable extends Table{
	public function get_message($id_produit){
		return $this->create_req('SELECT * FROM message WHERE id_produit=?', [$id_produit]);
	}
	public function propose_prix($prix, $id_user, $id_produit){
		$d=date('Y-m-d H:i:s');
		return $this->db->getPDO()->exec('INSERT INTO message SET id_user="'.$id_user.'", contenu_message="'.$prix.'", date_message="'.$d.'", id_produit="'.$id_produit.'"');
	} 
	public function get_max_prix($id_produit){
		return $this->create_req('SELECT MAX(contenu_message) AS prix_max , id_user FROM message WHERE id_produit=?', [$id_produit], true);
	}

}
?>