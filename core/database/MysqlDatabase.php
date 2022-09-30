<?php
namespace core\database;
use \PDO;
class MysqlDatabase extends Database{
	private $host;
	private $db_name;
	private $user;
	private $pswd;
	private $pdo;
	public function __construct($host='localhost',$db_name='testblog', $db_user='root', $db_pswd=''){
		$this->host=$host;
		$this->db_name=$db_name;
		$this->user=$db_user;
		$this->pswd=$db_pswd;
	}
	public function getPDO(){
		if($this->pdo === null){
		$pdo=new PDO('mysql:host='.$this->host.';dbname='.$this->db_name.'',$this->user,$this->pswd);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->pdo=$pdo;
	}
		return $this->pdo;
	}
	
	public function querry($requete, $class_name=null, $one=false){

		$req=$this->getPDO()->query($requete);
		if(is_null($class_name)){
			$req->setFetchMode(PDO::FETCH_OBJ);
		}else{
		$req->setFetchMode(PDO::FETCH_CLASS, $class_name);
	}
		if($one){
			$data=$req->fetch();

		}else{
			$data=$req->fetchAll();}
		return $data;
	}
	public function req_prepare($requete, $parametre, $class_name, $one=false){
		$req=$this->getPDO()->prepare($requete);
		$req->execute($parametre);
		$req->setFetchMode(PDO::FETCH_CLASS, $class_name);

		if($one){
			$data=$req->fetch();
		}else{
			$data=$req->fetchAll();
		}

		return $data;
	
	}
	public function req_insert($titre, $contenu, $cat){
		$t=date('Y-m-d');
		$insertion=$this->getPDO()->exec('INSERT INTO article SET titre="'.$titre.'", contenu="'.$contenu.'", datearticle="'.$t.'", categorie_id="'.$cat.'"');
		return $insertion;
	}
	
	public function comm_insert($user, $commentaire, $id){
		$jour=date('Y-m-d');
		$req=$this->getPDO()->exec('INSERT INTO commentaire SET nom_user="'.$user.'", contenu_com="'.$commentaire.'", date_com="'.$jour.'", id_article="'.$id.'"');
		return $req;
	}
}
?>