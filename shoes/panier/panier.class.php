<?php

class Panier {
	var $article;       // Tableau des article du Panier
	var $nbarticle;     // Nombre d'article dans le Panier
	var $totalHT;       // Montant total HT du Panier
	var $totalTTC;      // Montant total TTC du Panier
	var $TVA;           // Montant TVA
	var $calculmontant; // Active le calcul du montant ou non
	var $port;          // Tarif livraison
	var $typeport;      // Type de livraison

	// Constructeur initialise le tableau d'article et le montant total du Panier
	function Panier($actif = false, $tva = 19.6) {
		$this->article       = array();
		$this->nbarticle     = 0;
		$this->totalHT       = 0;
		$this->totalTTC      = 0;
		$this->TVA           = $tva;
		$this->calculmontant = $actif;
		$this->port          = 0;
		$this->typeport      = 0;
		$this->portTVA       = 0;
	}

	function destroy() {
		unset ($this->article);
		unset ($this->nbarticle);
		unset ($this->totalHT);
		unset ($this->totalTTC);
		unset ($this->TVA);
		unset ($this->calculmontant);
		unset ($this->port);
		unset ($this->typeport);
	}

	// Frais de port
	function getLivraison() {
		if (isset($this->calculmontant) && $this->calculmontant == true) return ($this->port);
		else return 0;
	}

	// Type livraison
	function getTypeLivraison() {
		if (isset($this->calculmontant) && $this->calculmontant == true) return ($this->typeport);
		else return 0;
	}

	// Frais de port
	function ajoutPort($port, $typeport) {
		if (isset($this->calculmontant) && $this->calculmontant == true) {
			$this->port     = $port;
			$this->typeport = $typeport;
			$this->portTVA  = $port * (1 + ($this->TVA / 100));
		}
	}

	// Renvoie le total final HT + frais de port
	function getTotalFinalHT() {
		if (isset($this->calculmontant) && $this->calculmontant == true) return (sprintf("%.2f", ($this->totalHT+$this->port)));
		else return 0;
	}

	// Renvoie le total final TVA + frais de port
	function getTotalFinalTVA() {
		if (isset($this->calculmontant) && $this->calculmontant == true) return (sprintf("%.2f", (($this->totalHT+$this->port) * ($this->TVA / 100))));
		else return 0;
	}

	// Renvoie le total final TTC + frais de port
	function getTotalFinalTTC() {
		if (isset($this->calculmontant) && $this->calculmontant == true) return (sprintf("%.2f", ($this->totalTTC+$this->portTVA)));
		else return 0;
	}

	// Renvoie la quantite de l'article $numserie
	function getQteArticle($numserie) {
		if (isset($this->article[$numserie]['qte'])) return ($this->article[$numserie]['qte']);
		else return 0;
	}

	// Renvoie le prix de l'article $numserie
	function getPrixArticle($numserie) {
		if (isset($this->calculmontant) && $this->calculmontant == true) return (sprintf("%.2f", $this->article[$numserie]['prix']));
		else return 0;
	}

	// Renvoie le montant HT de l'article $numserie
	function getMontantArticle($numserie) {
		if (isset($this->calculmontant) && $this->calculmontant == true) return (sprintf("%.2f", $this->article[$numserie]['montantHT']));
		else return 0;
	}

	// Renvoie le montant TTC de l'article $numserie
	function getMontantTTCArticle($numserie) {
		if (isset($this->calculmontant) && $this->calculmontant == true) return (sprintf("%.2f", $this->article[$numserie]['montantTTC']));
		else return 0;
	}

	// Renvoie le montant TVA de l'article $numserie
	function getMontantTVAArticle($numserie) {
		// if ($this->calculmontant) return (sprintf("%.2f", ($this->article[$numserie]['montantTTC'] - $this->article[$numserie]['montantHT'])));
		if (isset($this->calculmontant) && $this->calculmontant == true) return (sprintf("%.2f", ($this->article[$numserie]['montantHT'] * ($this->TVA / 100))));
		else return 0;
	}

	// Renvoie le nombre d'article contenus dans le Panier
	function getNombreArticle() {
		return ($this->nbarticle);
	}

	// Renvoie le montant total HT
	function getTotalHT() {
		if (isset($this->calculmontant) && $this->calculmontant == true) return (sprintf("%.2f", $this->totalHT));
		else return 0;
	}

	// Renvoie le montant total TTC
	function getTotalTTC() {
		if (isset($this->calculmontant) && $this->calculmontant == true) return (sprintf("%.2f", $this->totalTTC));
		else return 0;
	}

	// Renvoie le montant total de la TVA
	function getTotalTVA() {
		// if ($this->calculmontant) return (sprintf("%.2f", ($this->totalTTC - $this->totalHT)));
		if (isset($this->calculmontant) && $this->calculmontant == true) return (sprintf("%.2f", ($this->totalHT * ($this->TVA / 100))));
		else return 0;
	}

	// Renvoie le montant de la TVA
	function getTVA() {
		return (sprintf("%.2f", $this->TVA));
	}

	// Ajoute un article dans le Panier
	function ajouterArticle($numserie, $quantite, $montantHT = 0) {
		if (!empty($numserie)) {
			if ($this->article[$numserie]) $this->article[$numserie]['qte'] += $quantite;
			else {
				$this->article[$numserie]['qte'] = $quantite;
				$this->nbarticle++;
			}
			if (isset($this->calculmontant) && $this->calculmontant == true) {
				$this->article[$numserie]['prix']      = $montantHT;
				$this->CalculMontantArticle($numserie, $this->article[$numserie]['prix'], $quantite);
				$this->CalculTotal($this->article[$numserie]['montantHT']);
			}
		}
	}

	// Supprime un article du Panier
	function supprimerArticle($numserie) {
		if (!empty($numserie) && $this->article[$numserie]) {
			if (isset($this->calculmontant) && $this->calculmontant == true) $this->CalculTotal(- $this->article[$numserie]['montantHT']);

			unset($this->article[$numserie]);
			$this->nbarticle--;
		}
	}

	// Met à jour la quantite d'un article sélectionné dans le Panier
	function miseAJourQteArticle($numserie, $quantite) {
		if (!empty($numserie) && $this->article[$numserie]) {
			if (isset($this->calculmontant) && $this->calculmontant == true) {
				$diff = $quantite - $this->article[$numserie]['qte'];
				$this->CalculMontantArticle($numserie, $this->article[$numserie]['prix'], $diff);
				$diff *= $this->article[$numserie]['prix'];
				$this->CalculTotal($diff);
			}

			$this->article[$numserie]['qte'] = $quantite;
		}
	}

	// Calcule le montant Total HT et TTC du panier
	function CalculTotal($prix) {
		$this->totalHT  += $prix;
		$this->totalTTC += $prix * (1 + ($this->TVA / 100));
	}

	// Calcule le montant Total HT et TTC par article
	function CalculMontantArticle($numserie, $prix, $qte) {
		$this->article[$numserie]['montantHT'] += $prix * $qte;
		$this->article[$numserie]['montantTTC'] += $prix * $qte * (1 + ($this->TVA / 100));
	}
}
?>