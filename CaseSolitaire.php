<?php
class CaseSolitaire {

    public const BILLE = 1;
    public const VIDE = 0;
    public const NEUTRALISE = -1;
    protected $valeur = self::BILLE || self::VIDE || self::NEUTRALISE;

    public function __construct(int $valeur = self::BILLE) {

        $this->valeur = $valeur;
    }

    public function __toString() : String {
			
	 	  return "La valeur de la case est " . $this->valeur . "\n";
    }

    public function getValeur() : int {

        return $this->valeur;
    }

    public function setValeur(int $valeur) {

        $this->valeur = $valeur;
    }

    public function isCaseVide() : bool {

        if($this->valeur == self::VIDE) return true;
        return false;
    }

    public function isCaseBille() : bool {

        if($this->valeur == self::BILLE) return true;
        return false;
    }

    public function isCaseNeutralise() : bool {

        if($this->valeur == self::NEUTRALISE) return true;
        return false;
    }
}
?>