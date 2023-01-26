<?php
class TablierSolitaire {
	
	public const NORD = 0;
	public const EST = 1;
	public const SUD = 2;
	public const OUEST = 3;
	protected $tablier = array(array());
	private int $nbLignes;
	private int $nbColonnes;
	
	public function __construct(int $nbLig = 5, int $nbCol = 5) {
		
		$this->nbLignes = $nbLig;
		$this->nbColonnes = $nbCol;
		for($i=0; $i < $this->nbLignes; ++$i) {
			
			for($j = 0; $j < $this->nbColonnes; ++$j) {
			
				$this->tablier[$i][$j] = new CaseSolitaire(0);
			}	
		}
	}
	
	public function getNbLignes() : int {
		
		return $this->nbLignes;	
	}
	
	public function getNbColonnes() : int {
		
		return $this->nbColonnes;	
	}
	
	public function getTablier() {
	
		return $this->tablier;	
	}
	
	public function getCase(int $numLigne, int $numColonne) : CaseSolitaire {
	
		return $this->tablier[$numLigne][$numColonne];	
	}
	
	public function videCase(int $numLigne, int $numColonne) {
		
		$this->tablier[$numLigne][$numColonne]->setValeur(0);
	}
	
	public function remplitCase(int $numLigne, int $numColonne) {
		
		$this->tablier[$numLigne][$numColonne]->setValeur(1);
	}
	
	public function neutraliseCase(int $numLigne, int $numColonne) {
		
		$this->tablier[$numLigne][$numColonne]->setValeur(-1);
	}
	
	public function estValideMvt(int $numLigDepart, int $numColDepart, int $numLigArrivee, int $numColArrivee) : bool {
	
		if($this->tablier[$numLigArrivee][$numColArrivee]->getValeur() == CaseSolitaire::VIDE) {
			
			if($this->tablier[($numLigArrivee - $numLigDepart)/2][($numColArrivee - $numColDepart)/2]->getValeur == CaseSolitaire::BILLE) {
				
				if($numLigArrivee - $numLigDepart = 2 ||  $numLigArrivee - $numLigDepart = -2 && $numColDepart==$numColArrivee) {
				
					return true;
				} elseif($numLigArrivee==$numLigDepart && $numColArrivee - $numColDepart = 2 || $numColArrivee - $numColDepart = - 2) {
			
					return true;			
				}
			
				return false;
			}
			
			return false;
		}
		
		return false;
	}
	
	public function estValideMvtDir(int $numLigDepart, int $numColDepart, int $dir) : bool {
	
		if($dir==0) {
			
			if($numLigDepart - 2 > 0 && $this->tablier[$numLigDepart-2][$numColDepart]->getValeur() == CaseSolitaire::VIDE && $this->tablier[$numLigDepart-1][$numColDepart]->getValeur() == CaseSolitaire::BILLE) {
			
				return true;		
			}
		} elseif($dir==1) {
			
			if($numColDepart + 2 < $this->nbColonnes && $this->tablier[$numLigDepart][$numColDepart+2]->getValeur() == CaseSolitaire::VIDE && $this->tablier[$numLigDepart][$numColDepart+1]->getValeur() == CaseSolitaire::BILLE) {
			
				return true;		
			}
		} elseif($dir==2) {
			
			if($numLigDepart + 2 < $this->nbLignes && $this->tablier[$numLigDepart+2][$numColDepart]->getValeur() == CaseSolitaire::VIDE && $this->tablier[$numLigDepart+1][$numColDepart]->getValeur() == CaseSolitaire::BILLE) {
			
				return true;		
			}
		} elseif($dir==3) {
			
			if($numColDepart - 2 < $this->nbColonnes && $this->tablier[$numLigDepart][$numColDepart-2]->getValeur() == CaseSolitaire::VIDE && $this->tablier[$numLigDepart][$numColDepart-1]->getValeur() == CaseSolitaire::BILLE) {
			
				return true;		
			}
		}
		
		return false;
	}
	
	public function isBilleJouable(int $numLigDepart, int $numColDepart) : bool {
		
		if($this->estValideMvtDir($numLigDepart, $numColDepart, 0) || $this->estValideMvtDir($numLigDepart, $numColDepart, 1) || $this->estValideMvtDir($numLigDepart, $numColDepart, 2) || $this->estValideMvtDir($numLigDepart, $numColDepart, 3)) {
			
			return true;
		}
		
		return false;
	}
	
	public function deplaceBille(int $numLigDepart, int $numColDepart, int $numLigArrivee, int $numColArrivee) {
		
		if($this->estValideMvt($numLigDepart, $numColDepart, $numLigArrivee, $numColArrivee) == true) {
			
			if($numLigArrivee - $numLigDepart == 2) {
			
				$this->tablier[$numLigDepart][$numColDepart]->setValeur(0);
				$this->tablier[$numLigDepart+1][$numColDepart]->setValeur(0);
				$this->tablier[$numLigArrivee][$numColArrivee]->setValeur(1);
			} elseif($numLigArrivee - $numLigDepart == -2) {
			
				$this->tablier[$numLigDepart][$numColDepart]->setValeur(0);
				$this->tablier[$numLigDepart-1][$numColDepart]->setValeur(0);
				$this->tablier[$numLigArrivee][$numColArrivee]->setValeur(1);
			} elseif($numColArrivee - $numColDepart == -2) {
			
				$this->tablier[$numLigDepart][$numColDepart]->setValeur(0);
				$this->tablier[$numLigDepart][$numColDepart+1]->setValeur(0);
				$this->tablier[$numLigArrivee][$numColArrivee]->setValeur(1);
			} else {
				
				$this->tablier[$numLigDepart][$numColDepart]->setValeur(0);
				$this->tablier[$numLigDepart][$numColDepart-1]->setValeur(0);
				$this->tablier[$numLigArrivee][$numColArrivee]->setValeur(1);
			}
		}
	}
	
	public function deplaceBilleDir(int $numLigDepart, int $numColDepart, int $dir) {
		
		if($this->estValideMvtDir($numLigDepart, $numColDepart, $dir) == true) {
			
			if($dir == 0) {
			
				$this->tablier[$numLigDepart][$numColDepart]->setValeur(0);
				$this->tablier[$numLigDepart+1][$numColDepart]->setValeur(0);
				$this->tablier[$numLigDepart+2][$numColDepart]->setValeur(1);
			} elseif($dir == 2) {
			
				$this->tablier[$numLigDepart][$numColDepart]->setValeur(0);
				$this->tablier[$numLigDepart-1][$numColDepart]->setValeur(0);
				$this->tablier[$numLigDepart-2][$numColDepart]->setValeur(1);
			} elseif($dir == 1) {
			
				$this->tablier[$numLigDepart][$numColDepart]->setValeur(0);
				$this->tablier[$numLigDepart][$numColDepart+1]->setValeur(0);
				$this->tablier[$numLigDepart][$numColDepart+2]->setValeur(1);
			} else {
				
				$this->tablier[$numLigDepart][$numColDepart]->setValeur(0);
				$this->tablier[$numLigDepart][$numColDepart-1]->setValeur(0);
				$this->tablier[$numLigDepart][$numColDepart-2]->setValeur(1);
			}
		}
	}
	
	public function __toString() : String{
	
		$res="";
		
		for($i=0; $i < $this->nbLignes; ++$i) {
			
			for($j = 0; $j < $this->nbColonnes; ++$j) {
			
				$res.=$this->tablier[$i][$j]->__toString();
			}	
		}
		
		return $res;
	}
	
	public function isFinPartie() : bool {
	
		$compteur = 0;
		
		for($i=0; $i < $this->nbLignes; ++$i) {
			
			for($j = 0; $j < $this->nbColonnes; ++$j) {
			
				if($this->tablier[$i][$j]->getValeur() == CaseSolitaire::BILLE) {
				
					++$compteur;				
				}
			}	
		}
		
		if($compteur == 1) {
		
			return true;		
		} elseif($compteur > 1) {
		
			$deplacementPossible = false;
			
			for($i=0; $i < $this->nbLignes; ++$i) {
			
				for($j = 0; $j < $this->nbColonnes; ++$j) {
			
					if($this->isBilleJouable($i, $j)) {
				
						$deplacementPossible = true;				
					}
				}	
			}
			
			if($deplacementPossible == false) {
			
				return true;	
			}
		}
		
		return false;
	}
	
	public function isVictoire() : bool {
		
	    if($this -> isFinPartie() == true) {
	        
	        $compteur = 0;
	        
	        for($i=0; $i < $this->nbLignes; ++$i) {
	            
	            for($j = 0; $j < $this->nbColonnes; ++$j) {
	                
	                if($this->tablier[$i][$j]->getValeur() == CaseSolitaire::BILLE) {
	                    
	                    ++$compteur;
	                }
	            }
	        }
	        
	        if($compteur == 1) {
	            
	            return true;
	        }
	    }
	    
	    return false;
	}
	
	public static function initTablierGagnant() : TablierSolitaire {
		
		$tabGagnant = new TablierSolitaire(5, 5);
		
		for($i=0; $i < $tabGagnant->nbLignes; ++$i) {
		    
		    for($j = 0; $j < $tabGagnant->nbColonnes; ++$j) {
		        
		        $tabGagnant->tablier[$i][$j]->setValeur(0);
		    }
		}
		
		$tabGagnant->tablier[($tabGagnant->nbLignes)/2][($tabGagnant->nbColonnes)/2]->setValeur(1);
		
		return $tabGagnant;
	}
	
	public static function initTablierPerdant() : TablierSolitaire {
		
	    $tabPerdant = new TablierSolitaire(5, 5);
	    
	    for($i=0; $i < $tabPerdant->nbLignes; ++$i) {
	        
	        for($j = 0; $j < $tabPerdant->nbColonnes; ++$j) {
	            
	            $tabPerdant->tablier[$i][$j]->setValeur(0);
	        }
	    }
	    
	    $tabPerdant->tablier[($tabPerdantt->nbLignes)/2][($tabPerdant->nbColonnes)/2]->setValeur(1);
	    $tabPerdant->tablier[($tabPerdantt->nbLignes)/2+2][($tabPerdant->nbColonnes)/2]->setValeur(1);
	    
	    return $tabPerdant;
	}
	
	public static function initTablierEuropeen() : TablierSolitaire {
		
		$tab = new TablierSolitaire(9, 9);
		
		for($i=0; $i < $tab->nbLignes; ++$i) {
		    
		    for($j = 0; $j < $tab->nbColonnes; ++$j) {
		        
		        if($i == ($tab->nbLignes)/2 && $j == ($tab->nbColonnes)/2) {
		            
		            $tab->tablier[$i][$j]->setValeur(0);
		        } else if($i < sqrt($tab->nbLignes) || $i >= 2*sqrt($tab->nbLignes) && $j < sqrt($tab->nbColonnes) || $j >= 2*sqrt($tab->nbColonnes)) {
		            
		            $tab->tablier[$i][$j]->setValeur(-1);
		        } else {
		            
		            $tab->tablier[$i][$j]->setValeur(1);
		        }
		    }
		}
		
		return $tab;
	}
	
	public static function initTablierAnglais() : array {
		
		//TODO
	}
}
?>