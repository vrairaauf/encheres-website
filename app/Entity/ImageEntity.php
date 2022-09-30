<?php
namespace app\Entity;
use core\Entity\Entity;
class ImageEntity extends Entity{
	public function image_path(){
		return $this->path_image.$this->nom_image;
	}
	public function voir(){
		 header('Content-Type: image/jpeg');
		 readfile($this->image_path());
	}
	public function src(){
		return $this->path_image.$this->nom_image;
	}
}