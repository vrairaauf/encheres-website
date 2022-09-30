<?php
namespace app\table;
use core\table\Table; 
class CommentaireTable extends Table{
	public function get_commentaire(){
		return $this->create_req('SELECT * from membre_commentaire Limit 12');
	}
	public function ajout_commentaire($id_user, $contenu){
		$d=date('Y-m-d H:i:s');
		return $this->db->getPDO()->exec('INSERT INTO membre_commentaire SET id_user="'.$id_user.'", date_commentaire="'.$d.'", contenu="'.$contenu.'"');
	}
}
?>