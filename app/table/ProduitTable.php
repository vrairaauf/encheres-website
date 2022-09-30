<?php
namespace app\table;
use core\table\Table;
class ProduitTable extends Table{
	public function nb_ligne_vendu(){
		$non='oui';
		return $this->create_req('SELECT COUNT(*) AS total FROM produit WHERE vente=?',[$non], true);
	}
	public function produit_vendu($debut=0, $perpage=2){
		$oui='oui';
		return $this->create_req('SELECT * FROM produit WHERE vente="oui" LIMIT '.$debut.','.$perpage);
	}
	public function produit_all_vendu(){
		return $this->create_req('SELECT * FROM produit WHERE vente="oui"');
	}
	public function tache_publicitaire(){
		$n=1;
		return $this->create_req('SELECT * FROM produit WHERE vente="oui" LIMIT '.$n);
	}
	public function produit_non_vendu($debut=0, $perpage=2){
		$non='non';
		return $this->create_req('SELECT * FROM produit WHERE vente="non" LIMIT '.$debut.','.$perpage);
	}
	public function all_non_vendu_product(){
		$non="non";
		return $this->create_req('SELECT * FROM produit WHERE vente=?',[$non]);
	}
	public function produit_specifier($id){
		return $this->create_req('SELECT * FROM produit WHERE id_produit=?', [$id], true);
	}
	public function est_il_inscri($id_produit, $id_user){
		return $this->create_req('SELECT * FROM evenement WHERE id_user=? AND id_produit=?', [$id_user, $id_produit], true);
	}
	public function completed_prod(){
		$s='completed';
		return $this->create_req('SELECT * FROM produit WHERE situation=?', $s);
	}
	public function set_situation($id_produit){
		return $this->db->getPDO()->exec('UPDATE produit SET situation="completed" WHERE id_produit="'.$id_produit.'"');	
	}
	public  function nb_ligne(){
		$non='non';
		return $this->create_req('SELECT COUNT(*) AS total FROM produit WHERE vente=?',[$non], true);
		
	}
	public function get_produit($debut, $perpage){
		return $this->create_req('SELECT * FROM produit WHERE vente="non" LIMIT '.$debut.','.$perpage);
	}
	public function produit_completed(){
		$situation='completed';
		$non='non';
		return $this->create_req('SELECT * FROM produit WHERE situation=? AND vente=?', [$situation, $non]);
	} 
	public function set_date_ouvrir($date, $time, $id_produit){
		$req= $this->db->getPDO()->exec('UPDATE produit SET  date_ouvrir="'.$date .' '.$time.'" WHERE id_produit="'.$id_produit.'"');
		return true;
	}
	public function ajouter_produit($titre, $desc, $p_o, $p_p, $n_o){
		$d=date('Y-m-d H:i:s');
		return $this->db->getPDO()->exec('INSERT INTO produit SET titre_produit="'.$titre.'", desc_produit="'.$desc.'", prix_original="'.intval($p_o).'", datepublication="'.$d.'", prix_participe="'.intval($p_p).'", nombre_ouvrir="'.intval($n_o).'", situation="not_completed"');
	}
	public function produit_de_now($titre, $desc){
		return $this->create_req('SELECT id_produit FROM produit WHERE titre_produit=? AND desc_produit=?', [$titre, $desc], true);
	}
	public function delete_produit($id_produit){
		return $this->db->getPDO()->exec('DELETE FROM produit WHERE id_produit="'.$id_produit.'"');
	}
	public function get_produit_encour(){
		return $this->create_req('SELECT * FROM produit WHERE date_ouvrir>=? AND vente="non"', [date('Y-m-d H:m:s')]);
	}
	public function set_prix_vente($prix, $id_produit){
		$req=$this->create_req('SELECT prix_vente FROM produit WHERE id_produit=?', [$id_produit], true);
		$prixx=$req->prix_vente;
		$prixx+=intval($prix);
		$mise_a_jour=$this->db->getPDO()->exec('UPDATE produit SET prix_vente="'.$prixx.'" WHERE id_produit="'.$id_produit.'"');
		return 'vous avez proposer un nouveau prix';
	}
	public function get_prix_vente($id_produit){
		return $this->create_req('SELECT prix_vente FROM produit WHERE id_produit=?', [$id_produit], true);
	}
	public static function setvisite(){ 

		$fichier='../files/visite/nombre_de_visite';

		if(file_exists($fichier)){

			fopen($fichier, 'r+b');

		}else{

			fopen($fichier, 'a+b');
		}
		$compteur=(int)file_get_contents($fichier);
		$compteur++;
		file_put_contents($fichier, $compteur);
		fclose(fopen($fichier, 'r+b'));
		
		}
		public function set_nombre_Visiteur($remote_addr){
			$fichier='../files/visite/nombre_de_visiteur';
			if(file_exists($fichier)){
				fopen($fichier, 'r+b');
			}else{
				fopen($fichier, 'a+b');
			}
			$nb=file_get_contents($fichier);
			
			$remote=explode('--', $nb);
	
			if(!in_array($remote_addr, $remote)){
				$remote[0]++;
				$nb=implode('--', $remote);
				$nb.='--'.$remote_addr;
				file_put_contents($fichier, $nb);
			}
			fclose(fopen($fichier, 'r+b'));
		}
		public function ip_visiteur_avec_date($ip_visiteur){
			$ip_visiteur=strval($ip_visiteur);
			$ip_visiteur=str_replace(':', 'P', $ip_visiteur);
			$file_path='../files/visite/ipvisiteur/'.$ip_visiteur;
			if(file_exists($file_path)){
				$file=fopen($file_path, 'r+b');
			}else{
				$file=fopen($file_path, 'a+b');
			}
			$contenu=file_get_contents($file_path);
			$contenu.="\r\n".date('Y-m-d H:i:s');
			fwrite($file, $contenu);
			fclose($file);
		}
		public function trace_dajout_de_produit($id_produit, $titre_produit, $desc_produit, $prix_oroginal, $prix_participe, $nb_ouvrir){
			$file='../files/ajouter/produit/'.$id_produit.'.txt';
			if(file_exists($file)){
				$f=fopen($file, 'r+b');
			}
			else{
				$f=fopen($file, 'a+b');
			}
			$contenu=file_get_contents($file);
			$contenu.="\r\n".'id de produit :'.$id_produit;
			$contenu.="\r\n".'le titre de produit :'.$titre_produit;
			$contenu.="\r\n".'la description du produit :'.$desc_produit;
			$contenu.="\r\n".'le prix orginal de produit :'.strval($prix_oroginal);
			$contenu.="\r\n".'le prix de participation :'.strval($prix_participe);
			$contenu.="\r\n".'le nombre necessaire pou ouvrir :'.strval($nb_ouvrir);
			fwrite($f, $contenu);
			fclose($f);
			}
		public function trace_rejoindre($id_produit, $titre_produit, $id_user, $frais){
			$file='../files/ajouter/produit/'.$id_produit.'.txt';
			if(file_exists($file)){
				$f=fopen($file, 'r+b');
			}
			$contenu=file_get_contents($file);
			$contenu.="\r\n".'_________________________________________________________________________';
			$contenu.="\r\n".'une nouvelle inscription dans le produit  :'.$titre_produit;
			$contenu.="\r\n".'id_user:'.strval($id_user).'|---|montant payee:'.strval($frais).'|---| date de loperation :'.date('Y-m-d H:i:s');
			fwrite($f, $contenu);
			fclose($f);
		}
		
}
?>