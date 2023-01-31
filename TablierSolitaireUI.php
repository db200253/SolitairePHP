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
		
		$chaine = "<button class='" . $classe . "'name='coord' value='" . $ligne . "_" . $colonne . "' " . $cache . ">&nbsp</button>";
		
		return $chaine;
	}
	
	public function getFormulaireOrigine() : String {
	
		$action = $_SERVER['PHP_SELF'];
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

		$form = "<div class = 'columns is-vcentered'>
                    <div class = 'column is-1'></div>
                    <div class ='column'>
                        <h6 class = 'subtitle is-h6 has-text-centered has-text-success-dark'>
                            <br><br>
                            Regles du jeu : Le solitaire est un jeu qui, comme l'indique son nom, 
                            se pratique seul. Le joueur deplace des pions 
                            (generalement des billes ou des fiches) sur un plateau dans le 
                            but de n'en avoir plus qu'un seul.
                            <br><br>
                            Pour supprimer des pions, il faut que deux pions soient adjacents 
                            et suivis d'une case vide. Le premier pion saute par-dessus 
                            le deuxieme et rejoint la case vide. Le deuxieme pion est alors 
                            retire du plateau. Un pion ne peut sauter qu'horizontalement ou 
                            verticalement, et un seul pion a la fois.
                            <br><br>
                            Dans le plateau ci-contre les cases violettes sont les cases vides
                            tandis que les grises sont neutralisees.
                        </h6>
                    </div>
                    <div class = 'column is-1'></div>
                    <div class ='column is-half'>
                        <br><br>
                        <form action = $action method = $methode>";
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
   	    $form .= "      </form>
                    </div>
                  </div>";	
		
		return $form;
	}
	
	public function getFormulaireDestination() : String {
		
		if(isset($_POST['coord'])) {
			
			$action = "./action.php";
			$methode = "post";
			$tab = array();
			$coord = explode('_', $_POST['coord']);
			
			for($i = 0; $i < $this->ts->getNbLignes(); ++$i) {
			
				for($j = 0; $j < $this->ts->getNbColonnes(); ++$j) {
					
					if($this->ts->getCase($i, $j)->getValeur() == 1) {
				
						$tab[$i][$j] = self::getBoutonCaseSolitaire("bille", $i, $j, true);
					} else if($this->ts->getCase($i, $j)->getValeur() == -1){
				
						$tab[$i][$j] = self::getBoutonCaseSolitaire("neutralise", $i, $j, true);			
					} else {
				
						$tab[$i][$j] = self::getBoutonCaseSolitaire("vide", $i, $j, true);			
					}
			
					if($i == $coord[0] && $j == $coord[1]) {
						
						if($this->ts->estValideMvtDir($i, $j, 0)) {
						
							$tab[$i-2][$j] = self::getBoutonCaseSolitaire("vide", $i-2, $j, false);
						}
						if($this->ts->estValideMvtDir($i, $j, 1)) {
						
							$tab[$i][$j+2] = self::getBoutonCaseSolitaire("vide", $i, $j+2, false);
						}
						if($this->ts->estValideMvtDir($i, $j, 2)) {
						
							$tab[$i+2][$j] = self::getBoutonCaseSolitaire("vide", $i+2, $j, false);
						}
						if($this->ts->estValideMvtDir($i, $j, 3)) {
						
							$tab[$i][$j-2] = self::getBoutonCaseSolitaire("vide", $i, $j-2, false);
						}
					}
				}
	   	}
			
			$form = "<div class = 'columns is-vcentered'>
                    <div class = 'column is-1'></div>
                    <div class ='column'>
                        <h6 class = 'subtitle is-h6 has-text-centered has-text-success-dark'>
                            <br><br>
                            Regles du jeu : Le solitaire est un jeu qui, comme l'indique son nom, 
                            se pratique seul. Le joueur deplace des pions 
                            (generalement des billes ou des fiches) sur un plateau dans le 
                            but de n'en avoir plus qu'un seul.
                            <br><br>
                            Pour supprimer des pions, il faut que deux pions soient adjacents 
                            et suivis d'une case vide. Le premier pion saute par-dessus 
                            le deuxieme et rejoint la case vide. Le deuxieme pion est alors 
                            retire du plateau. Un pion ne peut sauter qu'horizontalement ou 
                            verticalement, et un seul pion a la fois.
                            <br><br>
                            Dans le plateau ci-contre les cases violettes sont les cases vides
                            tandis que les grises sont neutralisees.
                        </h6>
                    </div>
                    <div class = 'column is-1'></div>
                    <div class ='column is-half'>
                        <br><br>
                        <form action = $action method = $methode>
                        <input name='coord' type='hidden' value='" . $coord[0] . "_" . $coord[1] . "'>";
		
			foreach($tab as $line) {
		    
		    	foreach($line as $element) {
		    		
		    		$form .= $element;
		    	}
		    	
		    	$form .= "<br>";
			}
   	    	
   	   $form .= "    </form>
                    	</div>
                  </div>";	
		
			return $form;
		}
		
		return "";
	}
}
?>