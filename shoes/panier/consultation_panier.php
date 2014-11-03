<?php

include_once 'panier.class.php';

session_start();


/*************************************************************************************************
**                               déclarations variables                                         **
*************************************************************************************************/
$contenu = "";
$page    = null;


/*************************************************************************************************
**                               affectations variables                                         **
*************************************************************************************************/
$page->maj      = isset($_POST["maj_x"]) ? $_POST["maj_x"] : "";
$page->base     = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https" : "http")."://".$_SERVER["HTTP_HOST"];
$page->dirname  = dirname($_SERVER["SCRIPT_NAME"]);
$page->query    = isset($_SERVER["QUERY_STRING"]) ? "?".$_SERVER["QUERY_STRING"]."" : "";
$page->protocol = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https" : "http";
$page->action   = $page->protocol."://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"].$page->query;
$page->panier   = isset($_SESSION['panier']) ? unserialize($_SESSION['panier']) : "";

/*************************************************************************************************
**                                  programme principal                                         **
*************************************************************************************************/
print '
<html>
<head>
<title>Consultation Panier</title>
</head>
<body>
<form name="form1" method="post" action="'.$page->action.'" enctype="application/x-www-form-urlencoded">';

if ($page->maj) maj($page);

$contenu .= Affichages($page);

print $contenu.'
</form>
</body>
</html>';

$_SESSION["panier"] = serialize($page->panier);

/*************************************************************************************************
**                                        fonctions                                             **
*************************************************************************************************/
// affichage principal
function Affichages(&$page) {
	 if ($page->panier == "" || (is_object($page->panier) && $page->panier->getNombreArticle() <= 0)) return '<br /><center>Votre panier est vide<br /><a href="liste_article.php">Liste Produits</a></center>';

	$out = '
	<center>
	<br />
	<table border="0" cellspacing="0" cellpadding="0" width="80%">
		<tr>
			<td align="left" class="titrecell">Réf (Num Série)</td>
			<td align="right" class="titrecell">P.U. (HT)</td>
			<td align="right" class="titrecell">Quantité</td>
			<td align="right" class="titrecell">Total HT</td>
			<td align="right" class="titrecell">Total TTC</td>
			<td align="middle" class="titrecell">Supprimer</td>
		</tr>';

 	foreach ($page->panier->article as $numserie => $val) {
		$out .= '
		<tr>
			<td>'.$numserie.'</td>
			<td align="right">'.$page->panier->getPrixArticle($numserie).'&nbsp;&euro;</td>
			<td align="right">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr valign="middle">
						<td><input type="text" name="qte_'.$numserie.'" value="'.$page->panier->getQteArticle($numserie).'" readonly size="4" /></td>
						<td><a href="#" onclick="document.form1.qte_'.$numserie.'.value++;return false"><img src="plus.gif" width="14" height="10" border="0" hspace="0" vspace="0" /></a><br /><a href="#" onclick="document.form1.qte_'.$numserie.'.value--;return false"><img src="moins.gif" width="14" height="10" border="0" hspace="0" vspace="0" /></a></td>
					</tr>
				</table>
			</td>
			<td align="right" class="intitule">'.$page->panier->getMontantArticle($numserie).'&nbsp;&euro;</td>
			<td align="right" class="intitule">'.$page->panier->getMontantTTCArticle($numserie).'&nbsp;&euro;</td>
			<td align="middle" class="intitule"><input type="checkbox" name="suppr_'.$numserie.'" /></td>
		</tr>';
	}

	$out .= '
		<tr>
			<td colspan="6"><hr width="50%" /></td>
		</tr>
		<tr>
			<td colspan="5" align="right" class="titrecell">Sous-Total HT :</td>
			<td align="right" class="intitule">'.$page->panier->getTotalHT().'&nbsp;&euro;</td>
		</tr>
		<tr>
			<td colspan="5" align="right" class="titrecell">Livraison Port HT :</td>
		<td align="right" class="intitule">A déterminer</td>
		</tr>
		<tr>
			<td colspan="5" align="right" class="titrecell">Total HT :</td>
			<td align="right" class="intitule">'.$page->panier->getTotalFinalHT().'&nbsp;&euro;</td>
		</tr>
		<tr>
			<td colspan="5" align="right" class="titrecell">TVA ('.$page->panier->getTVA().'&nbsp;%) :</td>
			<td align="right" class="intitule">'.$page->panier->getTotalFinalTVA().'&nbsp;&euro;</td>
		</tr>
		<tr>
			<td colspan="5" align="right" class="titrecell">Total TTC :</td>
			<td align="right" class="intitule">'.$page->panier->getTotalFinalTTC().'&nbsp;&euro;</td>
		</tr>
		<tr>
			<td colspan="6"><hr width="50%" /></td>
		</tr>
		<tr>
			<td colspan="6" align="center"><input type="image" name="maj" src="valider.gif" /></td>
		</tr>
		<tr>
			<td colspan="6"><hr width="50%" /></td>
		</tr>
	</table>
	</center>';

	return $out;
}

function maj(&$page) {
	foreach ($_POST as $cle => $valeur) {
		if (preg_match("/suppr_(.*)/", $cle, $res)) $page->panier->supprimerArticle($res[1]);
		if (preg_match("/qte_(.*)/", $cle, $res)) $page->panier->miseAJourQteArticle($res[1], $valeur);
	}

	if ($page->panier->getNombreArticle() <= 0) {
		$page->panier->destroy();
		$page->panier = null;
	}
}
?>