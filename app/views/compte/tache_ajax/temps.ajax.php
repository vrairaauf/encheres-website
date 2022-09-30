<?php
require 'principal.php';
$id_chrono=$_GET['idchrono'];
$req=$con->query('SELECT * from chrono WHERE id="'.$id_chrono.'"');
$r=$req->fetchAll();
$demarrer=$r[0]['demarrer'];
$depart=$r[0]['depart'];
function chronometrea($end_time){
	//global $app;
	global $con;
	global $r;
	$id=$r[0]['id'];
	$from_time1=date('Y-m-d H:i:s');
	$to_time1=$end_time;
	$timefirst=strtotime($from_time1);
	$timesecond=strtotime($to_time1);
	$difference=$timesecond-$timefirst;
	if($difference<0){
		$start_time=date('Y-m-d H:i:s');
		$con->exec('UPDATE chrono SET demarrer="non" WHERE id="'.$id.'"');
		$con->exec('UPDATE chrono SET etat="on" WHERE id="'.$id.'"');
		$con->exec('UPDATE chrono SET debuter="oui" WHERE id="'.$id.'"');
		$end_time=date('Y-m-d H:i:s', strtotime('+'.$r[0]['duration'].'seconds', strtotime($start_time)));
		$con->exec('UPDATE chrono SET end_time="'.$end_time.'" WHERE id="'.$id.'"');
		$con->exec('UPDATE chrono SET depart="non"  WHERE id="'.$id.'"');
		
	}else{
		echo gmdate('m:s', $difference);
	}
}
if($demarrer==='oui' AND $depart==="oui"){
		chronometrea($r[0]['end_general']);
	}
?>