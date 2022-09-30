<?php
namespace app\table;
use core\table\Table; 
class CouponTable extends Table{
	public function achete_coupon($montant, $id_user, $offre){
		//$nb_coupon=$montant/2;
		switch($offre){
			case 'deuxieme':
			$nb_coupon=10;
			break;
			case 'troisieme':
			$nb_coupon=15;
			break;
			default:
			$nb_coupon=5;
			break;
		}
		$d=date('Y-m-d H:i:s');
		for ($i=0; $i <$nb_coupon ; $i++) { 
			$inser=$this->db->getPDO()->exec('INSERT INTO coupon SET date_achete="'.$d.'", id_user="'.$id_user.'"');
		}
		return $nb_coupon;
		
	}
	public function coupon_nombre($id_user){
		return $this->create_req('SELECT COUNT(id_coupno) AS nombre_coupon FROM coupon WHERE id_user=?', [$id_user], true);
	}
}
?>