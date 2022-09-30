<?php
namespace app\table;
use core\table\Table; 
class ImageTable extends Table{
	public function get_produit_image($id){
		return $this->create_req('SELECT * FROM image_produit WHERE id_produit=?', [$id]);
	}
	public function get_user_image($id){
		return $this->create_req('SELECT * FROM image WHERE id_user=?', [$id], true);
	}
	public function insert_image($nom, $id_produit){
		$path='../app/views/produit/image/';
		return $this->db->getPDO()->exec('INSERT INTO image_produit SET nom_image="'.$nom.'", path_image="'.$path.'", id_produit="'.$id_produit.'"');
	}
	public function insert_user_image($nom, $id_user){
		$path='../app/views/compte/image/';
		return $this->db->getPDO()->exec('INSERT INTO image SET nom_image="'.$nom.'", path_image="'.$path.'", id_user="'.$id_user.'"');
	}
	public function insert_cin_image($id_user, $nom_image){
		return $this->db->getPDO()->exec('INSERT INTO image_cin SET id_user="'.$id_user.'", nom_image="'.$nom_image.'"');
	}
	public function get_cin_image($id_user){
		return $this->create_req('SELECT * FROM image_cin WHERE id_user=?', [$id_user]);
	}
	public function change_user_image($nom, $id_user, $tmp){
		$name_extention=explode('.', $nom);
    	$extension=$name_extention[1];
    	$name=date('Y-m-d H:i:s').'.'.$extension;
    	$name=str_replace(' ', '', $name);
    	$name=str_replace(':', 'dp', $name);
    	$name=str_replace('-', 'tr', $name);
        
		$req=$this->db->getPDO()->exec('UPDATE image SET nom_image="'.$name.'" WHERE id_user="'.$id_user.'"');
		$user_image=$this->get_user_image($id_user);
		move_uploaded_file($tmp, $user_image->path_image.$name);
		echo 'votre foto est changer';
	}
	public function get_une_image_pour_produit($id_produit){
		return $this->create_req('SELECT * FROM image_produit WHERE id_produit=? LIMIT 1', [$id_produit], true);
	}
}
?>