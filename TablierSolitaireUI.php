<?php

require("./TablierSolitaire.php");
require("./libFonction.php");

class TablierSolitaireUI {
	
	private TablierSolitaire $ts;
	
	public function __construct(TablierSolitaire $ts = null) {
	
		$this->ts = $ts;	
	}
	
	private static function getBoutonCaseSolitaire(String $classe, int $ligne, int $colonne, bool $disabled) : String {
		
		if($disabled == false) {
			
			$cache = "";
		} else {
			
			$cache = "disabled";		
		}
		
		$chaine = "<button class='" . $classe . "'name='coord' value='" . $ligne . "_" . $colonne . "' " . $cache . ">" . $ligne . "," . $colonne . "</button>";
		
		return $chaine;
	}
	
	public function getFormulaireOrigine() : String {
	
		$action = self::getFormulaireDestination();
		$methode = "post";
		$tab = array();
		
		for($i = 0; $i < $this->ts->getNbLignes(); ++$i) {
			
			for($j = 0; $j < $this->ts->getNbColonnes(); ++$j) {
			
				if($this->ts->getCase($i, $j)->getValeur() == 1 && $this->ts->isBilleJouable($i, $j)) {
					
					$tab[] = self::getBoutonCaseSolitaire("bille", $i, $j, false);
				} elseif($this->ts->getCase($i, $j)->getValeur() == 1) {
				
					$tab[] = self::getBoutonCaseSolitaire("bille", $i, $j, true);
				} else if($this->ts->getCase($i, $j)->getValeur() == -1){
				
					$tab[] = self::getBoutonCaseSolitaire("neutralise", $i, $j, true);			
				} else {
				
					$tab[] = self::getBoutonCaseSolitaire("vide", $i, $j, true);			
				}
			}
	   }

		$form = "<h1>Choisissez une bille à déplacer</h1><form action = $action method = $methode>";
		foreach($tab as $element) {
   		
   		$form .= $element;
   	}
   	$form .= "</form>";	
		
		return $form;
	}
	
	public function getFormulaireDestination() : String {
		
		$action = "./action.php";
		$methode = "post";
		$tab = array();
		$bille = explode("_", $_POST['coord']);
		$tab = array();
		
		foreach($bille as $elem) {
			echo $elem;		
		}
		
		for($i = 0; $i < 4; ++$i) {
			
			$l = (int)$bille[0];
			$c = (int)$bille[1];
			
			if($this->ts->estValideMvtDir($l, $c, $i)) {
				
				if($i == 0) {
					
					$tab[] = self::getBoutonCaseSolitaire("vide", $l - 2, $c, false);	
				} elseif($i == 1) {
				
					$tab[] = self::getBoutonCaseSolitaire("vide", $l, $c + 2, false);				
				} elseif($i == 2) {
				
					$tab[] = self::getBoutonCaseSolitaire("vide", $l + 2, $c, false);				
				} else {
				
					$tab[] = self::getBoutonCaseSolitaire("vide", $l, $c - 2, false);				
				}
			}		
		}
		
		$form = "<form action = $action method = $methode>";
		
		foreach($tab as $element) {
   		
   		$form .= $element;
   	}
		$form .= "</form>";	
		
		return $form;
	}
}

$TablierSolitaire = TablierSolitaire::initTablierEuropeen();
$instUI = new TablierSolitaireUI($TablierSolitaire);

$html = getDebutHTML("");
$html .= $instUI->getFormulaireOrigine();
$html .= getFinHTML();

echo $html;
?>