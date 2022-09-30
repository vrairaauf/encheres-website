<?php
namespace core\table;
use App;
use core\database\MysqlDatabase;
class Table{
	protected $table;
	protected $db;
	public function __construct(MysqlDatabase $db){
		$this->db=$db;
		if(is_null($this->table)){
		$parts=explode('\\', get_class($this));
		$class=end($parts);
		$class=strtolower(str_replace('Table', '', $class));
		$this->table=$class;
	}

	}
	
	public function create_req($statement, $attributes=null, $one=false){
		if($attributes){
			return $this->db->req_prepare($statement, $attributes, str_ireplace('Table', 'Entity', get_class($this)), $one);
		}else{
			return $this->db->querry($statement, str_ireplace('Table', 'Entity', get_class($this)), $one);
		}
	}
	
	
}
?>