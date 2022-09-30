<?php
$nbp=1;
if(isset($_GET['nbp'])){
	$nbp=$_GET['nbp'];
}
$app=App::get_instance();
//systeme de pagination
$lignes=$app->get_table('produit')->nb_ligne_vendu();

$total=intval($lignes->total);
$perpage=2;
$totalpage=ceil($total/$perpage)+1;
$debut=$nbp*$perpage-$perpage;

$enchere_terminer=$app->get_table('produit')->produit_vendu($debut, $perpage);

if(!empty($enchere_terminer)){
    foreach($enchere_terminer as $produit){
        $images=$app->get_table('image')->get_produit_image($produit->id_produit);
        
    echo '<div class="produit">';
    echo '<h4>'.utf8_encode($produit->titre_produit).'</h4>';
    echo '<table>';
    echo '<tr>';
    foreach ($images as $image){
    echo '<td>';
    //'.$image->voir().'
    echo '<a href=""><img src="'.$image->image_path().'" class="imagepub"></a>';
    echo '</td>';
    }
    echo '</tr>';
    echo '</table>';
    /*echo '<pre>';
    echo utf8_encode($produit->desc_produit);
    echo '</pre>';*/
    echo "<hr>";
    echo '<h5>prix original  :'.$produit->prix_original.' TND</h5>';
    echo '<h5>prix de vente  :'.$produit->prix_vente.' TND</h5>';
    $winner=$app->get_table('user')->get_user($produit->winner);
    echo '<h5>winner : &nbsp'.$winner->pseudo.'</h5>';
    echo '</div>';
    echo "<br>";
    }
    }
    echo '<div class="containerpagination">';
for($i=1;$i<$totalpage; $i++){
	if($nbp==$i){
		echo '<span class="pagination">'.$i.'</span>';
	}else{
		echo '<span class="pagination"><a href="index.php?p=principal&nbp='.$i.'">'.$i.'</a></span>';
	}
}
echo '</div>';
?>