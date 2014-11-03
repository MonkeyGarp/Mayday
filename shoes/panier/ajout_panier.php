<?php

include_once 'panier.class.php';

session_start();

if (!isset($_SESSION['panier'])) {
	session_register("panier");
	$var = new Panier();
} 
else {
	$var = unserialize($_SESSION['panier']);
	
	if ($var == "") $var = new Panier();
}



/*************************************************************************************************
**                               affectations variables                                         **
*************************************************************************************************/
$numserie = isset($_REQUEST["numserie"]) ? $_REQUEST["numserie"] : "";
$qte      = isset($_REQUEST["qte"])      ? $_REQUEST["qte"]      : 0;
$origine  = isset($_REQUEST["origine"])  ? $_REQUEST["origine"]  : "";
$prix     = isset($_REQUEST["prix"])     ? $_REQUEST["prix"]     : 0;


/*************************************************************************************************
**                                  programme principal                                         **
*************************************************************************************************/
if (!Empty($numserie) && $qte > 0) {
	if ($prix > 0) {
		$var->calculmontant = true;
		$var->ajouterArticle($numserie, $qte, $prix);
	} else $var->ajouterArticle($numserie, $qte);

	$_SESSION["panier"] = serialize($var);
}
if ($origine) {
	Header("Location: $origine");
	exit;
}
?>