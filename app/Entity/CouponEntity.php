<?php
namespace app\Entity;
use core\Entity\Entity;
class CouponEntity extends Entity{
	public function achet_coupon(){
		return 'routeur.php?page=achat';
	}
}
?>