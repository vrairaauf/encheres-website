<?php
namespace app\table;
use core\table\Table; 
class NotificationTable extends Table{
	    
		public function ajout_base_notification($id_user){
			$d=date('Y-m-d H:i:s');
			return $this->db->getPDO()->exec('INSERT INTO notification SET titre="bienvenu dans site batta.tn" ,contenu="pour beneficier des operation de site il faut completer votre profil <a href=\"routeur\.php?page=parametre\">completer votre profil</a>", date_notification="'.$d.'", id_user="'.$id_user.'"');
		}
		public function get_notification($id_user){
			$non='non';
			return $this->create_req('SELECT * FROM notification WHERE lire=? AND id_user=?', [$non, $id_user]);
		}
		public function set_lire_notification($id){

			return $this->db->getPDO()->exec('UPDATE notification SET lire="oui" WHERE id_notification="'.$id.'"');
		}
		public function get_one_notification($id){
			$lire=$this->set_lire_notification($id);
			return $this->create_req('SELECT * FROM notification WHERE id_notification=?', [$id], true);
		}
		public function ajout_information_notofication($id_user){
			$d=date('Y-m-d H:i:s');
			return $this->db->getPDO()->exec('INSERT INTO notification SET titre="votre compte sur batta.tn sera verifier dans maximum 24 heure" ,contenu="notre equipe va valider votre compte dans un intervalle du temps ne depasse pas le 48 heure pour plus dinformation liser notre <a href=\"\">politique de confidentialitee</a>", date_notification="'.$d.'", id_user="'.$id_user.'"');
		}
		public function notification_verif_compte($id_user){
			$d=date('Y-m-d H:i:s');
			return $this->db->getPDO()->exec('INSERT INTO notification SET titre="votre compte sur batta.tn est bien verifier " ,contenu="votre compte est maintenant activer maintenant vous avez l\'occasion de faire des achats et de rejoindre des evenements ", date_notification="'.$d.'", id_user="'.$id_user.'"');
		}
		public function revoir_base_notification($id_user){
			return $this->db->getPDO()->exec('UPDATE notification SET lire="non" WHERE lire="oui" AND id_user="'.$id_user.'" AND titre="bienvenu dans site batta.tn"');
		}
		public function notification_erreur_verification($id_user){
			$d=date('Y-m-d H:i:s');
		$req=$this->create_req('SELECT * FROM notification WHERE id_user=? AND titre=?', [$id_user, 'erreur de verification de profil sur batta.tn'], true);
		if($req){
			return $this->db->getPDO()->exec('UPDATE notification SET lire="non" WHERE id_user="'.$id_user.'" AND titre="erreur de verification de profil sur batta.tn"');
		}else{
			return $this->db->getPDO()->exec('INSERT INTO notification SET titre="erreur de verification de profil sur batta.tn" ,contenu="nous somme dzl de vous rinforme que lequipe de batta.tn a trouve des information incompatible lors de verification de votre compte il faut de reverifier votre compte ", date_notification="'.$d.'", id_user="'.$id_user.'"');
		}

			
		
		}


}
?>