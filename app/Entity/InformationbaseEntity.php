<?php
namespace app\Entity;
use core\Entity\Entity;
class InformationbaseEntity extends Entity{
	public function verif_true_info(){
		return 'admin.php?p=verifier les comptesc des membres&situation=vrai&id='.$this->id_user;
	}
	public function verif_false_info(){
		return 'admin.php?p=verifier les comptesc des membres&situation=false&id='.$this->id_user;
	}
}