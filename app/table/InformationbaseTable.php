<?php
namespace app\table;
use core\table\Table; 
class InformationbaseTable extends Table{
	public function get_base_information($id_user){
		return $this->create_req('SELECT * FROM information_base WHERE id_user=?', [$id_user], true);
	}
	public function ajout_information($id_user, $cin_user, $telephone, $adresse){
		return $this->db->getPDO()->exec('INSERT INTO information_base SET id_user="'.$id_user.'", cin_user="'.$cin_user.'", telephone="'.$telephone.'", adresse="'.$adresse.'"');
	}
	public function all(){
		return $this->create_req('SELECT * FROM information_base');
	}
	public function delete_info($id_user){
		$this->db->getPDO()->exec('DELETE FROM information_base WHERE id_user="'.$id_user.'" LIMIT 1');
	}
	
	
}
?>