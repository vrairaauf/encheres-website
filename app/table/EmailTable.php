<?php
namespace app\table;
use core\table\Table; 
class EmailTable extends Table{
	public function get_email($email){
		return $this->create_req('SELECT * FROM email WHERE email=?', [$email], true);
	}
	public function trace_ajout_email($email){
		$file_path='../files/ajouter/emails/emails';
		$file=fopen($file_path, 'r+b');
		$contenu=file_get_contents($file_path);
		$contenu.="\r\n".'|-->'.$email;
		fwrite($file, $contenu);
		fclose($file);
	}
	public function ajout_email($email){
		$d=date('Y-m-d H:i:s');
		$req=$this->get_email($email);
		if($req){
			return 'email existe';
		}else{
			$ajout=$this->db->getPDO()->exec('INSERT INTO email SET email="'.$email.'", date_ajout="'.$d.'"');
			$trace=$this->trace_ajout_email($email);
			return 'email ajouter';
		}
	}
	
	public function get_all_emails(){
		return $this->create_req('SELECT * FROM email');
	}
	public function get_one_email($id_email){
		return $this->create_req('SELECT email FROM email WHERE id_email=?', [$id_email], true);
	}
	public function remplir_fichier($email, $message, $id_email){
		
		$file_path='../files/emails/'.$id_email.'.txt';
		
		if(file_exists($file_path)){
			$f=fopen($file_path, 'r+b');
		}else{
			$f=fopen($file_path, 'a+b');
		}
		
		$contenu=file_get_contents($file_path);
		$contenu.="\r\n".'email:'.$email.'|---|message:'.$message.'|---|date denvoie:'.date('Y-m-d H:i:s');
		//file_put_contents($file_path, $contenu, FILE_APPEND);
		fwrite($f, $contenu);
		fclose($f);
	}
	public function envoie_emails($id_email, $message_notification, $produit_information){
		$titre_email=$this->get_one_email($id_email);
		$email=$titre_email->email;
		$message=$produit_information.'&nbsp&nbsp&nbsp'.$message_notification;
		$headers='From: vrairaaufabidi@gmail.com'. "\r\n".
				'MIME-Version: 1.0'."\r\n".
					'Content-Type: text/html;charset=utf-8';
		$sujet=' des nouveau produit sur site batta.tn';
		if(mail($email, $sujet, $message, $headers)){
			echo 'les emails sont envoyees avec succees';
			return true;
		}else{
			$file=$this->remplir_fichier($email ,$message, $id_email);
			
			
			return false;
			
			
		}
	}
	
}
?>