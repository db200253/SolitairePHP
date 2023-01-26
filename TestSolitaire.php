<?php

/**
 *
 * @author Baptiste Duvieu
 * @author Billal Zaidi
 *
 */
    
    require("./TablierSolitaire.php");
    
    /**
     * 
     * Tests CaseSolitaire : set, Vide, Bille, Neutralise, etc...
     */
    
    $instanceCS1 = new CaseSolitaire();
    echo("\n".$instanceCS1."\n");
    
    if($instanceCS1->isCaseVide() == true) {
        
        echo "La case est VIDE\n";
    } elseif($instanceCS1->isCaseBille() == true) {
        
        echo "La case est BILLE\n";
    } elseif($instanceCS1->isCaseNeutralise() == true) {
        
        echo "La case est NEUTRALISE\n";
    }
    
    $instanceCS1->setValeur(0);
    echo("\n".$instanceCS1."\n");
    
    if($instanceCS1->isCaseVide() == true) {
        
        echo "La case est VIDE\n";
    } elseif($instanceCS1->isCaseBille() == true) {
        
        echo "La case est BILLE\n";
    } elseif($instanceCS1->isCaseNeutralise() == true) {
        
        echo "La case est NEUTRALISE\n";
    }
    
    $instanceCS1->setValeur(-1);
    echo("\n".$instanceCS1."\n");
    
    if($instanceCS1->isCaseVide() == true) {
        
        echo "La case est VIDE\n";
    } elseif($instanceCS1->isCaseBille() == true) {
        
        echo "La case est BILLE\n";
    } elseif($instanceCS1->isCaseNeutralise() == true) {
        
        echo "La case est NEUTRALISE\n";
    }
    
    /**
     * 
     * tests TablierSolitaire : remplit, vide, neutralise, get
     */
    $instTab = new TablierSolitaire();
    echo "\nIl y a ".$instTab->getNbLignes()." lignes dans ce tablier.\n";
    echo "\nIl y a ".$instTab->getNbColonnes()." colonnes dans ce tablier.\n";
    
    echo($instTab . "\n"); 
    echo "On remplit 6 cases : \n";
    
    $instTab->remplitCase(3, 1);
    $instTab->remplitCase(1, 1);
    $instTab->remplitCase(2, 2);
    $instTab->remplitCase(3, 4);
    $instTab->remplitCase(0, 2);
    $instTab->remplitCase(1, 2);
    
    echo($instTab . "\n");    
    echo "On neutralise 3 cases : \n";
    
    $instTab->neutraliseCase(2, 0);
    $instTab->neutraliseCase(0, 0);
    $instTab->neutraliseCase(1, 3);
    
    echo($instTab . "\n");
    echo "On vide 2 cases : \n";
    
    $instTab->videCase(2, 2);
    $instTab->videCase(3, 1);
    
    echo($instTab . "\n");
    
    echo "Case [3, 4] : " . $instTab->getCase(3, 4) . "\n";
    
    /**
     * 
     * tests Tablier europeen
     */
    $tabEur = TablierSolitaire::initTablierEuropeen();
    echo "Exemple de tablier europeen : \n";
    echo($tabEur . "\n");
    
    /**
     * bille jouable, mouvement valide (dir) et deplace bille (dir)
     */
    if($tabEur->isBilleJouable(2, 4) == true) {
        
        echo "La bille [2, 4] est jouable. \n";
        
        if($tabEur->estValideMvtDir(2, 4, 2) == true) {
            
            echo "Le mouvement de la bille [2, 4] vers le sud est valide.\n";
            $tabEur->deplaceBilleDir(2, 4, 2);
            echo "On deplace la bille : \n";
            echo($tabEur . "\n");
        } else {
            
            echo "Le mouvement de la bille [2, 4] vers le sud n'est pas valide.\n";
        }
    } else {
        
        echo "La bille [2, 4] n'est pas jouable. \n";
    }
    
    /**
     * 
     * tests tablier anglais
     */
    $tabAngl = TablierSolitaire::initTablierAnglais();
    echo "Exemple de tablier anglais : \n";
    echo($tabAngl . "\n");
    
    /**
     * bille jouable, mouvement valide, deplace bille
     */
    if($tabAngl->isBilleJouable(1, 3) == true) {
        
        echo "La bille [1, 3] est jouable.\n";
        
        if($tabAngl->estValideMvtDir(1, 3, 2) == true) {
            
            echo "Le mouvement de la bille [1, 3] vers le sud est valide.\n";
        } else {
            
            echo "Le mouvement de la bille [1, 3] vers le sud n'est pas valide.\n";
        }
        
        if($tabAngl->estValideMvt(1, 3, 3, 3) == true) {
            
            echo "Le mouvement de la bille [1, 3] vers la case [3, 3] est valide.\n";            
            $tabAngl->deplaceBille(1, 3, 3, 3);
            echo "On deplace la bille : \n";
            echo($tabAngl . "\n");
        } else {
            
            echo "Le mouvement de la bille [1, 3] vers la case [3, 3] n'est pas valide.\n";
        }
        
        if($tabAngl->estValideMvt(1, 3, 4, 3) == true) {
            
            echo "Le mouvement de la bille [1, 3] vers la case [4, 3] est valide.\n";
        } else {
            
            echo "Le mouvement de la bille [1, 3] vers la case [4, 3] n'est pas valide.\n";
        }
        
        if($tabAngl->estValideMvtDir(1, 3, 0) == true) {
            
            echo "Le mouvement de la bille [1, 3] vers le nord est valide.\n";
        } else {
            
            echo "Le mouvement de la bille [1, 3] vers le nord n'est pas valide.\n";
        }
    } else {
        
        echo "La bille [1, 3] n'est pas jouable.\n";
    }
    
    if($tabAngl->isBilleJouable(3, 4) == true) {
        
        echo "La bille [3, 4] est jouable.\n";
    } else {
        
        echo "La bille [3, 4] n'est pas jouable.\n";
    }
    
    /**
     * 
     * tests tablier gagnant
     */
    $tabGagn = TablierSolitaire::initTablierGagnant();
    echo "Exemple de tablier gagnant : \n";
    echo($tabGagn . "\n");
    
    /**
     * is fin partie (true) et isvictoire (true)
     */
    if($tabGagn->isFinPartie() == true) {
        
        echo "La partie est finie pour le tablier ci-dessus. \n";
        
        if($tabGagn->isVictoire() == true) {
            
            echo "La partie est gagnee. \n";
        } else {
            
            echo "La partie est perdue. \n";
        }
    }
    
    /**
     * 
     * tests tablier perdant
     */
    $tabPerd = TablierSolitaire::initTablierPerdant();
    echo "Exemple de tablier perdant : \n";
    echo($tabPerd . "\n");
    
    /**
     * is fin partie (true) et isvictoire (false)
     */
    if($tabPerd->isFinPartie() == true) {
        
        echo "La partie est finie pour le tablier ci-dessus. \n";
        
        if($tabPerd->isVictoire() == true) {
            
            echo "La partie est gagnee. \n";
        } else {
            
            echo "La partie est perdue. \n";
        }
    }
    
    /**
     * tests premier tableau : is fin partie (false)
     */
    echo "On a le premier tableau : \n" . $instTab . "\n";
    
    if($instTab->isFinPartie() == true) {
        
        echo "La partie est finie pour le tablier ci-dessus. \n";
        
        if($instTab->isVictoire() == true) {
            
            echo "La partie est gagnee. \n";
        } else {
            
            echo "La partie est perdue. \n";
        }
    } else {
        
        echo "La partie n'est pas finie pour le tablier ci-dessus. \n";
    }
?>