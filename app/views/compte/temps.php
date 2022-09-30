<?php
$app=App::get_instance();
$chrono=$app->get_table('chrono')->chrono($_GET['id']);
$c=$chrono->general;
$_SESSION['general']=$c;
$_SESSION['start_general']=date('Y-m-d H:i:s');


?>
<div id="general" class="principal">
	
</div>
<script type="text/javascript">
	setInterval(function(){
		let ajax=new XMLHttpRequest();
		ajax.open('GET', '../app/views/compte/tache_ajax/temps.ajax.php?idchrono=<?php echo $_GET['id']; ?>', false);
		ajax.send(null);
		document.getElementById('general').innerHTML=ajax.responseText;
	}, 1000);
</script>