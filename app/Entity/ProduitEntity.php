<?php
namespace app\Entity;
use core\Entity\Entity;
class ProduitEntity extends Entity{
	public function voir_offre(){
		return 'routeur.php?page=detail&id_offre='.$this->id_produit;
	}
	public function rejoindre_offre(){
		return 'routeur.php?page=rejoindre&id_offre='.$this->id_produit;
	}
	public function inscription_on_offre(){
		return '<button class="btn btn-default"><a href="'.$this->rejoindre_offre().'">rejoindrer cette offre</a></button>';
	}
	
	public function get_extrai(){
		return '<p >'.utf8_encode(substr($this->desc_produit,0, 50)) .'...<br><a href="'.$this->voir_offre().'">voir la suite ...</a></p>';
	
	}
	public function vers_offre($ip_visiteur){
		$ip_visiteur=strval($ip_visiteur);
		$ip_visiteur=str_replace(':', 'p', $ip_visiteur);
		$file_path='../files/visite/ipvisiteur/'.$ip_visiteur;
		$fichiers=glob('../files/visite/ipvisiteur/{*}', GLOB_BRACE);

		foreach($fichiers as $k=>$fichier){
			$contenu=file_get_contents($fichier);
			if($fichier!==$file_path AND strlen($contenu)>25){
				return 'index.php?p=connexion';
			}	
		}
				return 'index.php?p=créer un compte';
	}
	public function definir_date_ouvrir(){
		return '<a href="admin.php?p=single&id='.$this->id_produit.'">definir un jour pour louvertur de l\'ev\'enement</a>';
	}
	public function voir_room_event(){
		return 'routeur.php?page=room&id='.$this->id_produit;
	}
	
}
?>