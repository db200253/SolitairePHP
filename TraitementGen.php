<?php

/**
 * 
 * @author Baptiste Duvieu
 * @author Billal Zaidi
 */

include_once "TablierSolitaireUI.php";

session_start();

//pour refaire le tablier completement
if(isset($_GET['Refaire'])){
    for ($i = 0; $i < $_SESSION['tablier']->getNbLignes(); $i++) {
        for ($j = 0; $j < $_SESSION['tablier']->getNbColonnes(); $j++) {
            $_SESSION['tablier']->remplitCase($i,$j);
        }
    }
    header('Location: GenerePlateau.php');
}
//si le tablier est bon le boutton genere s'active et on peut commencer le jeu
else if(isset($_GET['genere'])){
    header('Location: index.php');
}


else if(isset($_GET) && isset($_GET['coord']) && isset($_GET['dpt']) ) {
    
    $coord = explode("_", $_GET['coord']);
    //si on veut vider la case
    if ($_GET['dpt'] == '0') {
        $_SESSION['tablier']->videCase($coord[0], $coord[1]);
        header('Location: GenerePlateau.php');
    }
    //si on veut neutraliser la case
    if ($_GET['dpt'] == '-1') {
        $_SESSION['tablier']->neutraliseCase( $coord[0], $coord[1]);
        header('Location: GenerePlateau.php');
    }
}

else  header('Location: GenerePlateau.php?coord=' . $_GET['coord']);