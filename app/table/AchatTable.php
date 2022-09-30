<?php
namespace app\table;
use core\table\Table; 
class AchatTable extends Table{
	public function ajout_achat($montant, $nbcoupon, $id_user, $id_offre=0){

		$d=date('Y-m-d H:i:s');
		
			$inser=$this->db->getPDO()->exec('INSERT INTO achat SET id_user="'.$id_user.'",id_produit="'.$id_offre.'", date_achat="'.$d.'", nb_coupon="'.$nbcoupon.'", montant="'.$montant.'"');
		
		return 'votre achat est effectuer';
		
	}
	public function get_achat($id_user){
		return $this->create_req('SELECT * FROM achat WHERE id_user=?', [$id_user]);
	}
	public function trace_achat($id_user, $montant, $nombre_coupon, $id_user_secour){
		$file_path='../files/ajouter/achat/'.$id_user;
		if(file_exists($file_path)){
			fopen($file_path, 'r+b');
		}else{
			fopen($file_path, 'a+b');
			file_put_contents($file_path, "\r\n".'user   | epreuve user | montant | nombre de coupon | date operation ');
		}
		$contenu=file_get_contents($file_path);
		$contenu.="\r\n".$id_user.'     | '.$id_user_secour.'           | '.$montant.'      | '.$nombre_coupon.'                |'.date('Y-m-d H:i:s');
		fwrite(fopen($file_path, 'r+b'), $contenu);
		fclose(fopen($file_path, 'r+b'));

	}
	
}
?>