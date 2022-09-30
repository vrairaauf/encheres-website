<?php
namespace app\table;
use core\table\Table; 
class AdminmenuTable extends Table{
public function all(){
	return $this->create_req('SELECT * FROM admin_menu');
}
	
}
?>