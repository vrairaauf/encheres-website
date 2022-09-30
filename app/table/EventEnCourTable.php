<?php
namespace app\table;
use core\table\Table; 
class EventEnCourTable extends Table{
	public function insert_event_en_cour($id_produit){
		$date=date('Y-m-d H:i:s');
		return $this->db->getPDO()->exec('INSERT INTO event_en_cours SET id_produit="'.$id_produit.'", date_ouvrir="'.$date.'"');
	}
	public function get_en_cour(){
		
	}

	
}
?>