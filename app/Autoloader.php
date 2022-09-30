<?php
namespace app;

	class Autoloader{
	static function register(){
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}
	static function autoload($classe){
		if(strpos($classe, __NAMESPACE__.'\\')===0){
		$classe=str_replace(__NAMESPACE__.'\\', '', $classe);
		$classe=str_replace('\\', '/', $classe);
		require '..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$classe.'.php';
	}
	}

}
?>