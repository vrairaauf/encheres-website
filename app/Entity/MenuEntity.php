<?php
namespace app\Entity;
use core\Entity\Entity;
class MenuEntity extends Entity{
	public function lien(){
		return 'index.php?p='.utf8_encode($this->titre);
	}
	public function site_menu_lien(){
		return 'routeur.php?page='.utf8_encode($this->titre);
	}
}
?>