<?php
namespace app\Entity;
use core\Entity\Entity;
class AdminmenuEntity extends Entity{
	public function lien(){
		return '<a href="admin.php?p='.utf8_encode($this->titre).'">'.utf8_encode($this->titre).'</a>';
	}  
}