<?php
namespace app\table;
use core\table\Table;
use NotificationTable;
use \PDO;
class UserTable extends Table{
	protected $temps_session=15;
	private function annuler_injection_sql($string){
		$string=stripcslashes($string);
		$string=stripslashes($string);
		$string=strip_tags($string);
		$string=htmlentities($string);
		$string=htmlspecialchars($string);
		return $string;
	}
	public function authentification($username, $password){
		$username=$this->annuler_injection_sql($username);
		$password=$this->annuler_injection_sql($password);
		return $this->create_req('SELECT * FROM user WHERE email=? AND password=?', [$username, md5($password)], true);
	}
	public function trace_connecteur($ip_user, $email, $pseudo){
		
		$file_path='../files/connexion/trace_membre/'.$pseudo;
		if(file_exists($file_path)){
			fopen($file_path, 'r+b');
		}else{
			fopen($file_path, 'a+b');
		}
		$contenu=file_get_contents($file_path);
		$contenu.="\r\n".$ip_user.'|--->'.$email.'|--->'.date('Y-m-d H:i:s');
		fwrite(fopen($file_path, 'r+b'), $contenu);
		fclose(fopen($file_path, 'r+b'));
	}
	public function update_password($password, $id_user){
		$update=$this->db->getPDO()->exec('UPDATE user SET password="'.md5($password).'" WHERE id_user="'.$id_user.'"');
		echo 'votre nouveau mot de passe sera remplacee';
	}
	public function search_pseudo($pseudo){
		$req=$this->create_req('SELECT * FROM user WHERE pseudo=?', [$pseudo], true);
		if($req){
			return false;
			
		}else{
			return false;
		}
	}
	public function update_user_information($nom, $prenom, $pseudo, $id_user){
		return $this->db->getPDO()->exec('UPDATE user SET nom_user="'.$nom.'", prenom_user="'.$prenom.'", pseudo="'.$pseudo.'" WHERE id_user="'.$id_user.'"');
	}
	public function get_user($id){
		return $this->create_req('SELECT * FROM user WHERE id_user=?', [$id], true);
	}
	public function en_ligne($id_user){
		return $this->create_req('SELECT * FROM en_ligne WHERE id_user=?', [$id_user], true);
	}
	public function add_en_ligne($id_user){
		$d=date('U');
		return $this->db->getPDO()->exec('INSERT INTO en_ligne SET temps="'.$d.'", id_user="'.$id_user.'"');
	}
	public function reste_en_ligne($id_user){
		$d=date('U');
		return $this->db->getPDO()->exec('UPDATE en_ligne SET temps="'.$d.'" WHERE id_user="'.$id_user.'"');
	}
	public function remove_or_ligne(){
		$expire_session=date('U')-$this->temps_session;
		return $this->db->getPDO()->exec('DELETE FROM en_ligne WHERE temps < '.$expire_session);
	}
	public function verif_email($mail){
		return $this->create_req('SELECT email FROM user WHERE email=?', [$mail], true);
	}
	public function pseudo($nom){
		$i=1;
		$bool=true;
		$ps=$nom.$i;
		while($bool){
			$req=$this->create_req('SELECT pseudo FROM user WHERE pseudo=?', [$ps], true);
			if($req){
				$i++;
			}else{
				$bool=false;
			}
		}
		return $ps;
	} 
	public function create_code(){
		$message='';
		for($i=0; $i<5 ; $i++){
			$c=rand(0, 9);
			$c=strval($c);
			$message.=$c;
		}
		return $message;
	}
	public function set_code($code, $email){
		return $this->db->getPDO()->exec('UPDATE user SET code="'.$code.'" WHERE email="'.$email.'"');
	}
	public function envoi_mail($message, $email){
		$headers='From: vrairaaufabidi@gmail.com'. "\r\n".
				'MIME-Version: 1.0'."\r\n".
					'Content-Type: text/html;charset=utf-8';
		$sujet=' code de verification de compte sur site batta.tn';
		if(mail($email, $sujet, $message, $headers)){
			return true;
		}else{
			return false;
		}
	}
	public function add_user($nom, $prenom, $pseudo, $email, $password){
		$req= $this->db->getPDO()->exec('INSERT INTO user SET nom_user="'.$nom.'",prenom_user="'.$prenom.'", pseudo="'.$pseudo.'", email="'.$email.'", password="'.md5($password).'"');
		$c=$this->create_code();
		$code=$this->set_code($c, $email);
		$mail=$this->envoi_mail($c, $email);
		return 'votre compte est creer est vous avez recoit un code apres quelque minutes';

	}
	public function trace_ajout_user($id_user ,$nom_user, $prenom_user, $pseudo, $email, $password, $nb_coupon){
		$file_path='../files/ajouter/users/'.$id_user;
		if(file_exists($file_path)){
			$f=fopen($file_path, 'r+b');
		}else{
			$f=fopen($file_path, 'a+b');
		}
		$contenu=file_get_contents($file_path);
		$contenu.="\r\n".'id user : '.$id_user;
		$contenu.="\r\n".'nom user :'.$nom_user;
		$contenu.="\r\n".'prenom user :'.$prenom_user;
		$contenu.="\r\n".'pseudo user :'.$pseudo;
		$contenu.="\r\n".'email user :'.$email;
		$contenu.="\r\n".'mot de passe user :'.$password;
		$contenu.="\r\n".'nombre de coupon :'.$nb_coupon;
		$contenu.="\r\n".'date de participation :'.date('Y-m-d H:i:s');
		$contenu.="\r\n".'_____________________________________________';
		fwrite($f, $contenu);
		fclose($f);

	}
	
	public function get_user_mail($mail){
		return $this->create_req('SELECT * FROM user WHERE email=?', [$mail], true);
	}
	//travaille pour le completer
	public function trace_verif_compte($id_user){
		$file_path='../files/ajouter/users/'.$id_user;
		if(file_exists($file_path)){
		 $f= fopen($file_path, 'r+b');
		}
		//$contenu=file_get_contents($file_path);
		$contenu='premier verification du compte : verifier';
		
		fwrite($f, $contenu);
		fclose($f);
	}
	public function set_premier_verif($id_user){
		$req= $this->db->getPDO()->exec('UPDATE user SET premier_verif="oui" WHERE id_user="'.$id_user.'"');
		//$trace=$this->trace_verif_compte($id_user);
	}
	public function all(){
		
		return $this->create_req('SELECT * FROM user');

	}
	public function set_verifier($id){
		return $this->db->getPDO()->exec('UPDATE user SET verifier_user="oui" WHERE id_user="'.$id.'"');

	}
	public function autre_code_verification($email){
		$code=$this->set_code($this->create_code(), $email);
		$mail=$this->envoi_mail($this->create_code(), $email);
		return 'votre compte est creer est vous avez recoit un code apres quelque minutes';

	}
	public function deconnexion(){
		session_destroy();
		setcookie('auth', '', time()-3600, '/', 'localhost', false, true);
		header('location: index.php');
	}
	public function est_il_verifier($id_user){
		$user=$this->get_user($id_user);
		if($user->verifier_user==='oui'){
			return true;
		}else{
			return false;
		}
		
	}
	public function envoie_email_motdepasse_oublier($email, $session_id){
		if($this->get_user_mail($email)){
		$d=date('Y-m-d H:i:s');
		$code=$this->create_code();
		$mailer=$this->envoi_mail($code, $email);
		
		//if($mailer){
			$this->db->getPDO()->exec('INSERT INTO mot_de_passe_oublier SET email="'.$email.'", id_session="'.$session_id.'", code="'.$code.'", date_operation="'.$d.'"');
			$_SESSION['email']=$email;
			header('location: index.php?p=verif code motdepasse oublier');

		}else{
			header('location: index.php?p=créer un compte');
		
		}
	}
	public function verif_code_mot_depasse_oublier($session_id, $code){
		$req=$this->create_req('SELECT * FROM mot_de_passe_oublier WHERE id_session=? AND code=? AND utilise="non"', [$session_id, $code], true);

		if($req){
			$set=$this->db->getPDO()->exec('UPDATE mot_de_passe_oublier SET utilise="oui" WHERE id="'.$req->id.'"');

			header('location: index.php?p=change password');
			
		}else{
			return false;
		}
	}
	public function set_user_password($email, $password){
		$set=$this->db->getPDO()->exec('UPDATE user SET password="'.md5($password).'" WHERE email="'.$email.'"');
		unset($_SESSION['email']);
		header('location: index.php?p=connexion');
	}
	public function  get_nombre_of_coupon($id_user){
		$req=$this->create_req('SELECT nombre_coupon AS coupon FROM user WHERE id_user=?',[$id_user], true);
		if($req->coupon>0){
			$n=$req->coupon-1;
			$mise_ajour=$this->db->getPDO()->prepare('UPDATE user SET nombre_coupon=:n WHERE id_user=:id_user');
			$mise_ajour->execute(array(':n'=>$n, ':id_user'=>$id_user));
			return true;
		}else{
			echo 'vos coupon ont eteb expirée vous navez la possibilite de termine la jeu';
			return false;
		}
	}
	public function get_nbcoupon($id_user){
		$req=$this->create_req('SELECT nombre_coupon AS coupon FROM user WHERE id_user=?',[intval($id_user)], true);
		if($req->coupon>0){
			$n=$req->coupon-1;
			
			$mise_ajour=$this->db->getPDO()->prepare('UPDATE user SET nombre_coupon=:n WHERE id_user=:id_user');
			$mise_ajour->execute(array(':n'=>$n, ':id_user'=>$id_user));
		

		}else{
			echo 'vos coupon ont eteb expirée vous navez la possibilite de termine la jeu';
			return false;
		}
	}
	public function set_coupon($id, $nb_coupon){
		$req=$this->create_req('SELECT nombre_coupon AS coupon FROM user WHERE id_user=?', [$id], true);
		$nombre_coupon=$req->coupon;
		$nombre_coupon+=$nb_coupon;
		$set=$this->db->getPDO()->exec('UPDATE user SET nombre_coupon="'.$nombre_coupon.'" WHERE id_user="'.$id.'"');
	}
	public function get_nombre_decoupon($id_user){
		return $this->create_req('SELECT nombre_coupon AS coupon FROM user WHERE id_user=?', [$id_user], true);
	}
	public function get_user_avec_email($email){
		return $this->create_req('SELECT * FROM user WHERE email=?', [$email], true);
	}
	public function trace_doperation_de_connexion($id_user){
		$file_path='../files/connexion/nombre_de_connexion';
		if(file_exists($file_path)){
			fopen($file_path, 'r+b');
		}else{
			fopen($file_path, 'a+b');
		}
		$contenu=(int)file_get_contents($file_path);
		$contenu++;
		file_put_contents($file_path, $contenu);
		fclose(fopen($file_path, 'r+b'));
	}
}
?>