<?php
namespace app\controller;
use App;
class ProduitController extends AppController{
	public function affiche(){
		$app=App::get_instance();
		$produits=$app->get_table('produit')->produit_vendu();
		$produits_courant=$app->get_table('produit')->produit_non_vendu();
		$this->rendor('produit.principal', compact('app', 'produits', 'produits_courant'));
	}
	 
} 
?>