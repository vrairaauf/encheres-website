<div id="winner"></div>
<script type="text/javascript">
    setInterval(function(){
		let xmlhttp=new XMLHttpRequest();
		xmlhttp.open('GET', "../app/views/compte/tache_ajax/winner.php?idprod=<?php echo  $_GET['id'];?>&iduser=<?php echo $_SESSION['user']; ?>", false);
		xmlhttp.send(null);
		document.getElementById('winner').innerHTML=xmlhttp.responseText;
	}, 1000);
</script>