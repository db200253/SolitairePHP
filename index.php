<?php

/**
 *
 * @author Baptiste Duvieu
 * @author Billal Zaidi
 */

require("./TablierSolitaireUI.php");

session_start();

/**
 * 
 * tablier selon choix dans accueil
 */
if (!isset($_SESSION['tablier'])) {
       
    if(isset($_GET) && isset($_GET['jouer']) ){
        
        if($_GET['tab']=='Anglais') {
            
            $_SESSION['tablier'] = TablierSolitaire::initTablierAnglais();
        } else if($_GET['tab']=='Europeen'){
            
            $_SESSION['tablier'] = TablierSolitaire::initTablierEuropeen();
        } else if($_GET['tab'] == 'Wiegleb') {
            
            $_SESSION['tablier'] = TablierSolitaire::initTablierWiegleb();
        }
    } else {
        
        header('Location: Accueil.php');
    }
}

$tablier = $_SESSION['tablier'];
$UI = new TablierSolitaireUI($tablier);

/**
 * 
 * si partie non finie, succession de formulaires, 
 * sinon message fin partie avec tablier plus bouton rejouer
 */
if ($tablier->isFinPartie() == false) {
    
    $ec = "<div class = 'tile notification has-background-grey-dark has-text-white-ter' >
                <h4 class='subtitle is-4'>Partie en cours</h4>
           </div>
        <br><br>";
    if (isset($_GET['coord'])) {
        
        $ec .= $UI->getFormulaireDestination($_GET['coord']);
    } else {
        
        $ec .= $UI->getFormulaireOrigine();
    }
} else {
    
    $ec = "
    <div class = 'tile notification has-background-grey-dark has-text-white-ter' >";
   
    if ($tablier->isVictoire()) {
        
        $ec .= "<p>
                    <h4 class='title is-4'>Vous avez gagne</h4>
                </p>";
    } else {
        
        $ec .= "<p>
                    <h4 class='title is-4'>Vous avez perdu</h4>
                </p>";
    }
    
    $ec .= "</div>";
    
    $ec .= $UI->getFormulaireOrigine();
    $_SESSION = array(); 
    session_destroy();
    session_unset();
}

/**
 * 
 * 
 * formulaire pour le bouton rejouer
 */
$form = "</br><br>";
$form .= "<form action='action.php' method='get'>";
$form .= "<input class='submit' type='submit' name='rejouer' value='Rejouer' />";
$form .= "</form>";

$ec .= $form;

$colonnes = "<div class = 'columns is-vcentered'>
                <div class = 'column'></div>
                <div class = 'column is-narrow'>
                    <br><br><br>" .
                    $ec .
                    "</div>
                <div class = 'column'></div>
            </div>";

echo getDebutHTML() . $colonnes . getFinHTML();
?>