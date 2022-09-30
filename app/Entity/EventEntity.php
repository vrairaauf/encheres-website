<?php
namespace app\Entity;
use core\Entity\Entity;
class EventEntity extends Entity{
	public function pourcent_event($nb_ouvrir){
		return (intval($this->nb_membre)/$nb_ouvrir)*100 .'%';
	}
}