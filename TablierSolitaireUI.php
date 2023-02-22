<?php

/**
 *
 * @author Baptiste Duvieu
 * @author Bilal Zaidi
 *
 */


require("./TablierSolitaire.php");
require("./libFonction.php");


class TablierSolitaireUI {
	
	private TablierSolitaire $ts;
	
	/**
	 * 
	 * @param TablierSolitaire $ts
	 * attribue = parametre
	 */
	public function __construct(TablierSolitaire $ts) {
	
		$this->ts = $ts;	
	}
	
	public function getTS() : TablierSolitaire {
		
		return $this->ts;
	}
	
	/**
	*@param String $classe
	*@param int $ligne
	*@param int $colonne
	*@param bool $disabled
	*@return String : un bouton html
	*construit un bouton à la ligne et à la colonne correspondantes, potentiellement disabled et avec une classe css précisée
	*/
	public static function getBoutonCaseSolitaire(String $classe, int $ligne, int $colonne, bool $disabled) : String {
		
		if($disabled == false) {
			
			$cache = "";
		} else {
			
			$cache = "disabled";
		}
		
		$chaine = "<button class='" . $classe . "'name='coord' value='" . $ligne . "_" . $colonne . "' " . $cache . ">&nbsp</button>";
		
		return $chaine;
	}
	
	/**
	*@return String : la chaîne de caractères correspondante à un plateau sous forme de formulaire en sélectionnant les billes jouables
	*/
	public function getFormulaireOrigine() : String {
	
		$action = "./index.php";
		$methode = "get";
		$tab = array();
		
		for($i = 0; $i < $this->ts->getNbLignes(); ++$i) {
			
			for($j = 0; $j < $this->ts->getNbColonnes(); ++$j) {
			
				if($this->ts->getCase($i, $j)->getValeur() == 1 && $this->ts->isBilleJouable($i, $j)) {
					
					$tab[] = self::getBoutonCaseSolitaire("bille play", $i, $j, false);
				} elseif($this->ts->getCase($i, $j)->getValeur() == 1) {
				
					$tab[] = self::getBoutonCaseSolitaire("bille", $i, $j, true);
				} else if($this->ts->getCase($i, $j)->getValeur() == -1){
				
					$tab[] = self::getBoutonCaseSolitaire("neutralise", $i, $j, true);			
				} else {
				
					$tab[] = self::getBoutonCaseSolitaire("vide", $i, $j, true);			
				}
			}
	   }

		$form = "<form action = $action method = $methode>";
		$compteur = 0;
		
		foreach($tab as $element) {
		    
		    if($compteur < $this->ts->getNbColonnes()) {
		        
		        $form .= $element;
		        ++$compteur;
		    } else {
		        
		        $form .= "<br>" . $element;
		        $compteur = 1;
		    }
		}
   	    $form .= "</form>";	
		
		return $form;
	}
	
	/**
	*@return String : la chaîne de caractères correspondante à un plateau sous forme de formulaire en sélectionnant les cases jouables
	*/
	public function getFormulaireDestination(String $coordD) : String {
		
		if(isset($_GET['coord'])) {
			
			$action = "./action.php";
			$methode = "get";
			$tab = array();
			$coord = explode('_', $coordD);
			
			for($i = 0; $i < $this->ts->getNbLignes(); ++$i) {
			
				for($j = 0; $j < $this->ts->getNbColonnes(); ++$j) {
						
					if($this->ts->getCase($i, $j)->getValeur() == 1) {

                 $tab[$i][$j] = self::getBoutonCaseSolitaire("bille", $i, $j, true);
               } else if($this->ts->getCase($i, $j)->getValeur() == -1){

                 $tab[$i][$j] = self::getBoutonCaseSolitaire("neutralise", $i, $j, true);
               } else {

                 $tab[$i][$j] = self::getBoutonCaseSolitaire("vide", $i, $j, true);
               }
            }
			}
			
			for($i = 0; $i < $this->ts->getNbLignes(); ++$i) {
			
				for($j = 0; $j < $this->ts->getNbColonnes(); ++$j) {
			
					if($i == $coord[0] && $j == $coord[1]) {
					    
					    $tab[$i][$j] = self::getBoutonCaseSolitaire("bille play", $i, $j, false);
						
						if($this->ts->estValideMvtDir($i, $j, 0)) {
						
							$tab[$i-2][$j] = self::getBoutonCaseSolitaire("vide play", $i-2, $j, false);
						}
						if($this->ts->estValideMvtDir($i, $j, 1)) {
						
							$tab[$i][$j+2] = self::getBoutonCaseSolitaire("vide play", $i, $j+2, false);
						}
						if($this->ts->estValideMvtDir($i, $j, 2)) {
						
							$tab[$i+2][$j] = self::getBoutonCaseSolitaire("vide play", $i+2, $j, false);
						}
						if($this->ts->estValideMvtDir($i, $j, 3)) {
						
							$tab[$i][$j-2] = self::getBoutonCaseSolitaire("vide play", $i, $j-2, false);
						}
					}
				}
	   	}
			
			$form = "<form action = $action method = $methode>
                        <input name='bille' type='hidden' value='" . $coord[0] . "_" . $coord[1] . "'>";
		
			foreach($tab as $line) {
		    
		    	foreach($line as $element) {
		    		
		    		$form .= $element;
		    	}
		    	
		    	$form .= "<br>";
			}
   	    	
   	   $form .= "</form>";	
		
			return $form;
		}
		
		return "";
	}
}
?>