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
			
	 	  return $this->getValeur();
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

$instanceCS1 = new CaseSolitaire();
$instanceCS1->getValeur();
print_r($instanceCS1);
if($instanceCS1->isCaseVide() == true) {
	echo "La case est VIDE\n";
} elseif($instanceCS1->isCaseBille() == true) {
	echo "La case est BILLE\n";
} elseif($instanceCS1->isCaseNeutralise() == true) {
	echo "La case est NEUTRALISE\n";
}
$instanceCS1->setValeur(0);
$instanceCS1->getValeur();
print_r($instanceCS1);
if($instanceCS1->isCaseVide() == true) {
	echo "La case est VIDE\n";
} elseif($instanceCS1->isCaseBille() == true) {
	echo "La case est BILLE\n";
} elseif($instanceCS1->isCaseNeutralise() == true) {
	echo "La case est NEUTRALISE\n";
}
$instanceCS1->setValeur(-1);
$instanceCS1->getValeur();
print_r($instanceCS1);
if($instanceCS1->isCaseVide() == true) {
	echo "La case est VIDE\n";
} elseif($instanceCS1->isCaseBille() == true) {
	echo "La case est BILLE\n";
} elseif($instanceCS1->isCaseNeutralise() == true) {
	echo "La case est NEUTRALISE\n";
}
?>