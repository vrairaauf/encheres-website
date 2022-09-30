<?php
namespace app\table;
use core\table\Table; 
class ChronoTable extends Table{
	public function chrono($id){
		
		return $this->create_req('SELECT * FROM chrono WHERE id=?',[$id], true);
	}
	public function set_etat($id){
		
		return $this->db->getPDO()->exec('UPDATE chrono SET etat="on" WHERE id="'.$id.'"');
	}
	public function set_endtime($t, $id){
		
		return $this->db->getPDO()->exec('UPDATE chrono SET end_time="'.$t.'" WHERE id="'.$id.'"');
	}
	public function get_etat($id){
		
		$etat=$this->create_req('SELECT * FROM chrono WHERE id=?',[$id], true);
		if($etat==='off'){
			return false;
		}else{
			return true;
		}
	}
	public function initial_etat($id){
		return $this->db->getPDO()->exec('UPDATE chrono SET etat="off" WHERE id="'.$id.'"');
	}
	public function get_endtime($id){
		
		return $this->create_req('SELECT end_time FROM chrono WHERE id=?',[$id],true);
	}
	public function set_demarrer($id){
		
		return $this->db->getPDO()->exec('UPDATE chrono SET demarrer="oui" WHERE id="'.$id.'"');
	}
	public function set_endgeneral($t, $id){
		
		return $this->db->getPDO()->exec('UPDATE chrono SET end_general="'.$t.'" WHERE id="'.$id.'"');
	}
	public function get_demarrer($id){
		//$id=1;
		$req=$this->create_req('SELECT * FROM chrono WHERE id=?', [$id], true);
		return $req->demarrer;
	}
	public function add_chrono($id){
		$duration=30;
		$general=1;
		return $this->db->getPDO()->exec('INSERT INTO chrono SET id="'.$id.'", duration="'.$duration.'", etat="off", debuter="non", general="'.$general.'", demarrer="init", depart="oui"');
	}
	public function delete_chrono($id_chrono){
		return $this->create_req('DELETE FROM chrono WHERE id="'.$id_chrono.'"');
	}
	
}
?>