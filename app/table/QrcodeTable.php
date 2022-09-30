<?php
namespace app\table;
use core\table\Table; 

class QrcodeTable extends Table{
	
	public function get_qrcode($gagnant ,$id_gagnant){
        require '../app/table/librairie/phpqrcode/qrlib.php';
        $nom='../app/views/compte/image/qrcode/'.$id_gagnant.'.png';
        QRcode::png($gagnant , $nom);
    }
	
}
?>