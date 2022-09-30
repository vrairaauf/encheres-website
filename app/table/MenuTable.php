<?php
namespace app\table;
use core\table\Table; 
class MenuTable extends Table{
	
	public function menu(){
		return $this->create_req('SELECT * FROM menu');
	}
	public function menu_site(){
		return $this->create_req('SELECT * FROM site_menu');
	}
}
?>