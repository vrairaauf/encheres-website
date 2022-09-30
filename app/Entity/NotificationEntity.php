<?php
namespace app\Entity;
use core\Entity\Entity;
class NotificationEntity extends Entity{
	public function lien(){
		return '<a href="routeur.php?page=notification&id='.$this->id_notification.'" >'.$this->titre.'</a>';
	}
	public function get_extrai(){
		return substr($this->contenu, 0, 20);
	}
}