<?php

/**
 * 
 * @author Baptiste Duvieu
 * @author Billal Zaidi
 *
 */

class CaseSolitaire {

    public const BILLE = 1;
    public const VIDE = 0;
    public const NEUTRALISE = -1;
    protected $valeur = self::BILLE || self::VIDE || self::NEUTRALISE;

    /**
     * 
     * @param int $valeur : valeur par défaut
     */
    public function __construct(int $valeur = self::BILLE) {

        $this->valeur = $valeur;
    }

    /**
     * 
     * @return String : valeur de la case
     */
    public function __toString() : String {
			
	 	  return "La valeur de la case est " . $this->valeur . "\n";
    }
    
    /**
     * 
     * @return int : valeur de la case
     */
    public function getValeur() : int {

        return $this->valeur;
    }
    
    /**
     * 
     * @param int $valeur : valeur à donner
     * change valeur
     */
    public function setValeur(int $valeur) {

        $this->valeur = $valeur;
    }
    
    /**
     * 
     * @return bool : vide
     */
    public function isCaseVide() : bool {

        if($this->valeur == self::VIDE) return true;
        return false;
    }
    
    /**
     * 
     * @return bool : bille
     */
    public function isCaseBille() : bool {

        if($this->valeur == self::BILLE) return true;
        return false;
    }
    
    /**
     * 
     * @return bool : neutralise
     */
    public function isCaseNeutralise() : bool {

        if($this->valeur == self::NEUTRALISE) return true;
        return false;
    }
}
?>