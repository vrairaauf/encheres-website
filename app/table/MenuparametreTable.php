<?php
namespace app\table;
use core\table\Table; 
class MenuparametreTable extends Table{
	
	public function get_menu_parametre(){
        return $this->create_req('SELECT * FROM menu_parametre');
    }
    public function one_parametre($id){
        return $this->create_req('SELECT * FROM menu_parametre WHERE id_parametre=?', [$id], true);
    }
}
?>