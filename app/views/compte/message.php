
<div id="prix" class="prix">
	
</div>
<script type="text/javascript">
	setInterval(function(){
		let ajax=new XMLHttpRequest();
		ajax.open('GET', '../app/views/compte/tache_ajax/prix_produit.ajax.php?idprod=<?php echo $_GET['id']; ?>', false);
		ajax.send(null);
		document.getElementById("prix").innerHTML=ajax.responseText;
	}, 1000);
</script>