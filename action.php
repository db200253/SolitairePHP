<?php

/**
 *
 * @author Baptiste Duvieu
 * @author Bilal Zaidi
 *
 */

/**
*redirection http
*/
	header("HTTP/1.1 301 Moved Permanently");
	header("Cache-Control: no-cache, must-revalidate");
   header('Location: http://ust-infoserv.univlehavre.lan/~db200253/L3/TP2/solitairephp/index.php');
	
	require('./index.php');
	
/**
*recuperation données et déplacement bille
*/
	$coord = explode("_", $_POST['coord']);
	$bille = explode("_", $_POST['bille']);
	
	$_SESSION['tablier']->deplaceBille($bille[0], $bille[1], $coord[0], $coord[1]);
	
/**
*si fin de partie, plateau + message victoire ou défaite
*/
	if($_SESSION['tablier']->isFinPartie() == true) {
		
		$head = $_SESSION['debut'];
		
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
		
		$form = "<div class = 'columns is-vcentered'>
                   <div class = 'column is-1'></div>
                   <div class ='column'>
                     <br><br>
                    	<div class ='tile is-8 has-background-primary'>
                        <h6 class = 'subtitle is-h6 has-text-centered has-text-white'>
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
                           tandis que les grises sont neutralisees. Les cases encadrees en jaune
                           sont les billes jouables/les cases disponibles.
                        </h6>
                      </div>
                   </div>
                   <div class = 'column is-1'></div>
                   <div class ='column is-half'>
                      <br><br>
                      <form action = $action method = $methode>";
		
		foreach($tab as $line) {
		    
		    foreach($line as $element) {
		    		
		    	$form .= $element;
		    }
		    	
		    $form .= "<br>";
		}
   	    	
   	$form .= "    </form>";
	
		if($_SESSION['tablier']->isVictoire() == true) {
			
			$sentence = "Vous avez gagne !";
		} else {
		
			$sentence = "Vous avez perdu !";
		}
		
		$html = $head . $form;
		$html .= "<br><br>
					 <div class ='tile is-8 has-background-primary'>
						" . $sentence . 
					"</div>
				  </div
				</div>";;
				
		echo $html;
		
/**
*destruction variables et session si fin de partie 
*/
		session_unset();
		session_destroy();
	}
?>