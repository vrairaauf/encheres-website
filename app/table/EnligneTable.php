<?php
namespace app\table;
use core\table\Table; 
class EnligneTable extends Table{
	
	public function all(){
		return $this->create_req('SELECT * FROM en_ligne') ;
	}
	
}
?>