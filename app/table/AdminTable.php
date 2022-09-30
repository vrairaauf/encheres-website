<?php
namespace app\table;
use core\table\Table; 
class AdminTable extends Table{
	public function verif_admin($username, $password){
		return $this->create_req('SELECT * FROM admin WHERE username=? AND password=?', [$username, $password], true);
	}
}
?>