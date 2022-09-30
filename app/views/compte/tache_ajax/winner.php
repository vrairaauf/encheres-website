<?php
require 'principal.php';
$id_produit=$_GET['idprod'];
$id_user=$_GET['iduser'];
$req= $con->prepare('SELECT * FROM gagnant WHERE id_produit=?');
$req->execute([$id_produit]);
$res=$req->fetchAll();
        if($res){
            echo 'l\'evenement est terminer';
            echo '<br>';
            echo '<a href="?page=gagnant&idprod='.$id_produit.'">voir le winner</a>';
            
        }
$req1=$con->prepare('SELECT * FROM gagnant WHERE id_produit=? AND id_user=?');
$req1->execute([$id_produit, $id_user]);
$res1=$req1->fetchAll();
if($res1){
	echo '&nbsp&nbsp&nbsp  <br> vous avez le gagnant aussi';
	usleep(10000);
    ?>
    <script>
        let css=document.getElementById('clavier');
            css.style.display="hidden";
    </script>
    <?php
    //header('location ?page=gagnant');
   
	
}

?>
