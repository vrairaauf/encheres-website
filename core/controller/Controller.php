<?php
namespace core\controller;
class Controller{
	protected $template='main';
	protected $viewpath;
	public function rendor($views, $art=[]){
		ob_start();
		extract($art);
		require ($this->viewpath.$views=str_replace('.', '/', $views).'.php');
		$content=ob_get_clean();
		require $this->viewpath.'templates/'.$this->template.'.php';
	}
}
?>