<?php 

/**
 *
 * @author Baptiste Duvieu
 * @author Bilal Zaidi
 *
 */
 
require("./TablierSolitaireUI.php");

session_start();

/**
*si pas de tablier existant : debut de partie donc création d'un tablier
*session pour garder tablier, UI et header 
*/

if(!(isset($_SESSION['tablier']))) {
	
	$TablierSolitaire = TablierSolitaire::initTablierEuropeen();
	$_SESSION['tablier'] = $TablierSolitaire;
}

$_SESSION['UI'] = new TablierSolitaireUI($_SESSION['tablier']);

$_SESSION['debut'] = getDebutHTML("", "'https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma-rtl.min.css'");
$_SESSION['debut'] .= "<section class='hero is-small is-primary'>
           					 <div class='hero-body'>
              					<p class='title'>
                    				Solitaire
              					</p>
                				<p class='subtitle'>
                    				Jouez au jeu du solitaire !
                				</p>
            				</div>
        					</section>";
    
$html = $_SESSION['debut'] . $_SESSION['UI']->getFormulaireOrigine();

if(isset($_POST['coord'])) {
	
	$html = $_SESSION['debut'] . $_SESSION['UI']->getFormulaireDestination();
} 

$html .= getFinHTML();

affichage($html);
?>