<?php
$app=App::get_instance();
echo '<div style="text-align:center;font-weight:bold;">';
echo '<p>chronometre de dernier produit</P>';
$chrono=$app->get_table('chrono')->chrono($_GET['id']);
$c=$chrono->duration;
$_SESSION['duration']=$c;
$_SESSION['start_time']=date('Y-m-d H:i:s');
$end_time=date('Y-m-d H:i:s', strtotime('+'.$_SESSION['duration'].'seconds', strtotime($_SESSION['start_time'])));
$_SESSION['end_time']=$end_time;
echo '<div id="response"></div>';
echo '</div>';
?>
<script type="text/javascript">
	setInterval(function(){
		let xmlhttp=new XMLHttpRequest();
		xmlhttp.open('GET', "../app/views/compte/tache_ajax/response.php?idprod=<?php echo $_GET['id'] ?>", false);
		xmlhttp.send(null);
		document.getElementById("response").innerHTML=xmlhttp.responseText;
	}, 1000);
</script>