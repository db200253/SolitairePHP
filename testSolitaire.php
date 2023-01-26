<?php
    
    require("./TablierSolitaire.php");
    
    $instanceCS1 = new CaseSolitaire();
    print_r($instanceCS1);
    
    if($instanceCS1->isCaseVide() == true) {
        
        echo "La case est VIDE\n";
    } elseif($instanceCS1->isCaseBille() == true) {
        
        echo "La case est BILLE\n";
    } elseif($instanceCS1->isCaseNeutralise() == true) {
        
        echo "La case est NEUTRALISE\n";
    }
    
    $instanceCS1->setValeur(0);
    print_r($instanceCS1);
    
    if($instanceCS1->isCaseVide() == true) {
        
        echo "La case est VIDE\n";
    } elseif($instanceCS1->isCaseBille() == true) {
        
        echo "La case est BILLE\n";
    } elseif($instanceCS1->isCaseNeutralise() == true) {
        
        echo "La case est NEUTRALISE\n";
    }
    
    $instanceCS1->setValeur(-1);
    print_r($instanceCS1);
    
    if($instanceCS1->isCaseVide() == true) {
        
        echo "La case est VIDE\n";
    } elseif($instanceCS1->isCaseBille() == true) {
        
        echo "La case est BILLE\n";
    } elseif($instanceCS1->isCaseNeutralise() == true) {
        
        echo "La case est NEUTRALISE\n";
    }
?>