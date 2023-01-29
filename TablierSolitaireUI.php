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
	
		$action = "";//self::getFormulaireDestination();
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
                            se pratique seul. Le joueur déplace des pions 
                            (généralement des billes ou des fiches) sur un plateau dans le 
                            but de n'en avoir plus qu'un seul.
                            <br><br>
                            Pour supprimer des pions, il faut que deux pions soient adjacents 
                            et suivis d'une case vide. Le premier pion « saute » par-dessus 
                            le deuxième et rejoint la case vide. Le deuxième pion est alors 
                            retiré du plateau. Un pion ne peut sauter qu'horizontalement ou 
                            verticalement, et un seul pion à la fois.
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
	
	/*public function getFormulaireDestination() : String {
		
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
	}*/
}

$TablierSolitaire = TablierSolitaire::initTablierEuropeen();
$instUI = new TablierSolitaireUI($TablierSolitaire);

$html = getDebutHTML("", "'https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma-rtl.min.css'");
$html .= "<section class='hero is-small is-primary'>
            <div class='hero-body'>
                <p class='title'>
                    Solitaire
                </p>
                <p class='subtitle'>
                    Jouez au jeu du solitaire !
                </p>
            </div>
        </section>";
$html .= $instUI->getFormulaireOrigine();
$html .= getFinHTML();

echo $html;
?>