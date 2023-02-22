<?php

/**
 *
 * @author Baptiste Duvieu
 * @author Billal Zaidi
 */

include("./TablierSolitaireUI.php");

session_start();

if (!isset($_SESSION['tablier']) ) {
    
    $_SESSION['tablier'] = new TablierSolitaire($_POST['ligne'], $_POST['colonne']);
    
    for ($i = 0; $i < $_SESSION['tablier']->getNbLignes(); $i++) {
        
        for ($j = 0; $j < $_SESSION['tablier']->getNbColonnes(); $j++) {
            
            $_SESSION['tablier']->remplitCase($i,$j);
        }
    }
}

$tablier = $_SESSION['tablier'];
$UI = new TablierSolitaireUI($tablier);
$form="<div class = 'tile notification has-background-grey-dark has-text-white-ter' >
        <h4 class = 'subtitle is-4'>Generez votre plateau</h4>
       </div>
       <div class = 'tile notification'>
            <form  action='TraitementGen.php' method='get'>
                <p>Type de bouton  : Vide <input type='radio' name='dpt' value='0'  />
                                    Neutralise <input type='radio' name='dpt' value='-1'   />
                </p>";

for ($i = 0; $i < $tablier->getNbLignes(); $i++) {
    
    for ($j = 0; $j < $tablier->getNbColonnes(); $j++) {
        
        if ($tablier->getCase($i, $j)->isCaseVide()) {
            
            $form .= $UI->getBoutonCaseSolitaire("vide", $i, $j, false);
        } else if ($tablier->getCase($i, $j)->isCaseBille() && $tablier->isBilleJouable($i, $j)) {
            
            $form .= $UI->getBoutonCaseSolitaire("bille play", $i, $j, false);
        } else if ($tablier->getCase($i, $j)->isCaseBille() && !($tablier->isBilleJouable($i, $j))) {
            
            $form .= $UI->getBoutonCaseSolitaire("bille", $i, $j, false);
        } else {
            $form .= $UI->getBoutonCaseSolitaire("neutralise", $i, $j, false);
        }
        
    }
    $form .= "<br/>";
}


$form.="<br>
        <button class='submit' type='submit' name='genere' value ='generer'";

$mouvPossible = false;
for($i = 0; $i < $tablier ->getNbLignes(); $i++) {
    
    for($j = 0; $j < $tablier->getNbColonnes(); $j++) {
        
        if($tablier->isBilleJouable($i, $j)) {
            
            $mouvPossible = true;
        }
    }
}

if($mouvPossible == true) {
    
    $form .= "> generer </button>";
}
else {
    
    $form .= "disabled > generer </button>";
}

$form.="    <input class='submit' type='submit' name='Refaire' value='Refaire' />
        </form>
    </div>";


$colonnes = "<div class = 'columns is-vcentered'>
                <div class = 'column'></div>
                <div class = 'column is-narrow'>
                    <br><br><br>" .
                    $form .
                    "</div>
                <div class = 'column'></div>
            </div>";

echo getDebutHTML() . $colonnes . getFinHTML();
?>