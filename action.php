<?php

/**
 *
 * @author Baptiste Duvieu
 * @author Billal Zaidi
 */

require("./TablierSolitaireUI.php");

/**
 * 
 * session pour persistance données
 */
session_start();

$tablier = $_SESSION['tablier'];

/**
 * 
 * si on veut rejouer, destruction session et redirection http
 */
if( isset($_GET['rejouer'])){
    
    session_destroy();
    session_unset();
    header('Location: accueil.php');
} else {
    
    if (isset($_GET) && isset($_GET['coord'])) {
        
        if (isset($_GET['bille'])) {
            
            /**
             * 
             * rien si clic sur bille séléctionnée, déplacement sinon
             */
            if ($_GET['bille'] == $_GET['coord']) {
                
                header('Location: index.php');
            } else {
                
                $bille = explode("_", $_GET['bille']);
                $coord = explode("_", $_GET['coord']);
                
                $tablier->deplaceBille($bille[0], $bille[1], $coord[0], $coord[1]);
                $_SESSION['tablier'] = $tablier;
                
                header('Location: index.php');
            }
        } else {
            
            header('Location: TablierSolitaireUI.php?coord=' . $_GET['coord']);
        }
    }
    
}

?>