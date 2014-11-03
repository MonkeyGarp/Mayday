<?php

include_once 'panier.class.php';


/*************************************************************************************************
**                                        session                                               **
*************************************************************************************************/
session_start();


/*************************************************************************************************
**                               déclarations variables                                         **
*************************************************************************************************/
$contenu = "";
$page    = null;


/*************************************************************************************************
**                               affectations variables                                         **
*************************************************************************************************/
$page->base     = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https" : "http")."://".$_SERVER["HTTP_HOST"];
$page->dirname  = dirname($_SERVER["SCRIPT_NAME"]);
$page->basename = basename($_SERVER["SCRIPT_NAME"]);
$page->origine  = $page->base.$page->dirname."/".$page->basename.(isset($_SERVER["QUERY_STRING"]) ? "?".$_SERVER["QUERY_STRING"] : "");
$page->query    = isset($_SERVER["QUERY_STRING"]) ? "?".$_SERVER["QUERY_STRING"]."" : "";
$page->protocol = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https" : "http";
$page->action   = $page->protocol."://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"].$page->query;


/*************************************************************************************************
**                                  programme principal                                         **
*************************************************************************************************/
print '
<html>
<head>
<title>Liste Article</title>
</head>
<body>
<form name="form1" method="post" action="'.$page->action.'" enctype="application/x-www-form-urlencoded">';

$contenu .= Affichages($page, $html);

print $contenu.'
</form>
</body>
</html>';


/*************************************************************************************************
**                                        fonctions                                             **
*************************************************************************************************/
// affichage principal
function Affichages(&$page, &$html) {
	$out = '
	<table border="0" cellspacing="0" cellpadding="0" width="80%" align="center">
	<tr>
		<td align="left"><b>Désignation</b></td>
		<td align="left"><b>Référence</b></td>
		<td align="right"><b>P.U. (HT)</b></td>
		<td align="right"><b>P.U. (TTC)</b></td>
		<td align="middle"><b>Panier</b></td>
	</tr>
	<tr>
		<td align="left">Designation1</td>
		<td align="left">Reference1</td>
		<td align="right">152.00&nbsp;&euro;</td>
		<td align="right">181.79&nbsp;&euro;</td>
		<td align="middle"><input type="text" name="qte_1" value="1" size="4" />
			&nbsp;<a href="#" onclick="document.location.href=\'ajout_panier.php?numserie=Reference1&qte=\'+document.form1.qte_1.value+\'&prix=152.00&origine=liste_article.php?\'">Ajout Panier</a>
		</td>
	</tr>
	<tr>
		<td align="left">Designation2</td>
		<td align="left">Reference2</td>
		<td align="right">100.00&nbsp;&euro;</td>
		<td align="right">119.60&nbsp;&euro;</td>
		<td align="middle"><input type="text" name="qte_2" value="1" size="4" />
			&nbsp;<a href="#" onclick="document.location.href=\'ajout_panier.php?numserie=Reference2&qte=\'+document.form1.qte_2.value+\'&prix=100.00&origine=liste_article.php?\'">Ajout Panier</a>
		</td>
	</tr>
	<tr>
		<td align="left">Designation3</td>
		<td align="left">Reference3</td>
		<td align="right">326.00&nbsp;&euro;</td>
		<td align="right">389.90&nbsp;&euro;</td>
		<td align="middle"><input type="text" name="qte_3" value="1" size="4" />
			&nbsp;<a href="#" onclick="document.location.href=\'ajout_panier.php?numserie=Reference3&qte=\'+document.form1.qte_3.value+\'&prix=326.00&origine=liste_article.php?\'">Ajout Panier</a>
		</td>
	</tr>
	<tr>
		<td align="left">Designation4</td>
		<td align="left">Reference4</td>
		<td align="right">304.00&nbsp;&euro;</td>
		<td align="right">363.58&nbsp;&euro;</td>
		<td align="middle"><input type="text" name="qte_4" value="1" size="4" />
			&nbsp;<a href="#" onclick="document.location.href=\'ajout_panier.php?numserie=Reference4&qte=\'+document.form1.qte_4.value+\'&prix=304.00&origine=liste_article.php?\'">Ajout Panier</a>
		</td>
	</tr>
	<tr>
		<td align="left">Designation5</td>
		<td align="left">Reference5</td>
		<td align="right">200.00&nbsp;&euro;</td>
		<td align="right">239.2&nbsp;&euro;</td>
		<td align="middle"><input type="text" name="qte_5" value="1" size="4" />
			&nbsp;<a href="#" onclick="document.location.href=\'ajout_panier.php?numserie=Reference5&qte=\'+document.form1.qte_5.value+\'&prix=200.00&origine=liste_article.php?\'">Ajout Panier</a>
		</td>
	</tr>
	</table>';

	if (isset($_SESSION['panier'])) {
		$page->panier = unserialize($_SESSION['panier']);

		if (is_object($page->panier) && $page->panier->getNombreArticle() > 0) {
			$out .= '
			<br /><br />
			<center><a href="consultation_panier.php">Voir Panier »</a></center>';
		}
	}

	return $out;
}
?>