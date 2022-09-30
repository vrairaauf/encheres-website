<?php
namespace app\Entity;
use core\Entity\Entity;
class MenuparametreEntity extends Entity{
	public function lien(){
        return '?page=parametre&tache='.$this->nom_parametre.'&id='.$this->id_parametre;
    }
}
?>