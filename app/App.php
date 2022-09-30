<?php
use core\Config;
use core\database\MysqlDatabase;
class App{
	private static $instance;
	private $db;
	
	public static function get_instance(){
		if(is_null(self::$instance)){
			self::$instance=new App();
		}
		return self::$instance;
	}
	
	public function get_db($file){
		$config=Config::get_config('../app/config/config.php');
		if(is_null($this->db)){
			$this->db=new MysqlDatabase($config->get('host'), $config->get('dbname'), $config->get('user'), $config->get('password'));
		}
		return $this->db;
	}
	
	public function get_table($table){
		$table='app\table\\'.ucfirst($table).'Table';
		return new $table($this->get_db($this->db));
	}
	
	public static function load(){
		session_start();
		require '../app/Autoloader.php';
		app\Autoloader::register();
		require '../core/Autoloader.php';
		core\Autoloader::register();
	}
	
}
?>