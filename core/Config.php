<?php
namespace core;
class Config{
	protected  $setting=array();
	protected static $instance;
	public static function get_config($file){
	if(is_null(self::$instance)){
		self::$instance=new config($file);
	}
	return self::$instance;
	}
	public function __construct($file){
		$this->setting= require($file);
	}
	public function get($nom){
		return $this->setting[$nom];
	}
}
?>