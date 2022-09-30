<?php
namespace app\table;
use core\table\Table; 
class GagnantTable extends Table{
	
    public function get_gagnant($id_produit, $id_user){
        $req= $this->create_req('SELECT * FROM gagnant WHERE id_produit=? AND id_user=?', [$id_produit, $id_user], true);
        if($req){
            echo 'levenement est terminer';
            //header('location: ?page=gagnant');
        }
    }
    public function get_event_winner($id_produit){
        return $this->create_req('SELECT * FROM gagnant WHERE id_produit=?',[$id_produit], true);
    }
    
    public function get_coords_gagnant($id_gagnant){
        $coords= $this->create_req('SELECT * FROM gagnant WHERE id_gagnant=?', [$id_gagnant], true);
        return $coords->id_gagnant.'/winner:'.$coords->id_user.'/product:'.$coords->id_produit.'/date:'.$coords->date_gagne;
    }
    public function get_info_gagnant($id_gagnant){
        return $this->create_req('SELECT * FROM gagnant WHERE id_gagnant=?', [$id_gagnant], true);
    }
    public function event_gagnee($id_user){
        return $this->create_req('SELECT * FROM gagnant WHERE id_user=?', [$id_user]);
    }
	
}
?>