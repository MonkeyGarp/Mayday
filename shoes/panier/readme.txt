Class panier caddie-------------------
Url     : http://codes-sources.commentcamarche.net/source/29499-class-panier-caddieAuteur  : Steph666Date    : 01/08/2013
Licence :
=========

Ce document intitulé « Class panier caddie » issu de CommentCaMarche
(codes-sources.commentcamarche.net) est mis à disposition sous les termes de
la licence Creative Commons. Vous pouvez copier, modifier des copies de cette
source, dans les conditions fixées par la licence, tant que cette note
apparaît clairement.

Description :
=============

Petite classe, une de plus sur les caddies :
<br />    - Gestion des articles

<br />    - Des Frais de port
<br />    - Des tarifs HT et TTC
<br /><a name='
source-exemple'></a><h2> Source / Exemple : </h2>
<br /><pre class='code' data
-mode='basic'>
// Frais de port et livraison
function getLivraison()

functi
on getTypeLivraison() 

function ajoutPort($port, $typeport)

// Total Final
 TTC
function getTotalFinalTTC()

// Renvoie la quantite de l'article $numser
ie
function getQteArticle($numserie)

// Renvoie le prix de l'article $numser
ie
function getPrixArticle($numserie) 

// Renvoie le montant HT de l'article
 $numserie
function getMontantArticle($numserie) 

// Renvoie le montant TTC 
de l'article $numserie
function getMontantTTCArticle($numserie) 

// Renvoie 
le montant TTC de l'article $numserie
function getMontantTVAArticle($numserie)


// Renvoie le nombre d'article contenus dans le Panier
function getNombreArt
icle()

// Renvoie le montant total HT
function getTotalHT() 

// Renvoie l
e montant total TTC
function getTotalTTC() 

// Renvoie le montant de la TVA

function getTotalTVA() 

// Renvoie le montant de la TVA
function getTVA() 


// Ajoute un article dans le Panier
function ajouterArticle($numserie, $quan
tite, $montantHT = 0)

// Supprime un article du Panier
function supprimerArt
icle($numserie) 

// Met à jour la quantite d'un article sélectionné dans le P
anier
function miseAJourQteArticle($numserie, $quantite) 

// Calcule le mont
ant Total HT et TTC du panier
function CalculTotal($prix) 

// Calcule le mon
tant Total HT et TTC par article
function CalculMontantArticle($numserie, $prix
, $qte)
</pre>
