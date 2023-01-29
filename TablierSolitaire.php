<?php

/**
 *
 * @author Baptiste Duvieu
 * @author Billal Zaidi
 *
 */

require("./CaseSolitaire.php");

class TablierSolitaire {
	
	public const NORD = 0;
	public const EST = 1;
	public const SUD = 2;
	public const OUEST = 3;
	protected $tablier = array(array());
	private int $nbLignes;
	private int $nbColonnes;
	
	/**
	 * 
	 * @param int $nbLig
	 * @param int $nbCol
	 * construit tablier vide
	 */
	public function __construct(int $nbLig = 5, int $nbCol = 5) {
		
		$this->nbLignes = $nbLig;
		$this->nbColonnes = $nbCol;
		for($i=0; $i < $this->nbLignes; ++$i) {
			
			for($j = 0; $j < $this->nbColonnes; ++$j) {
			
				$this->tablier[$i][$j] = new CaseSolitaire(0);
			}	
		}
	}
	
	/**
	 * 
	 * @return int : nb lignes
	 */
	public function getNbLignes() : int {
		
		return $this->nbLignes;	
	}
	
	/**
	 * 
	 * @return int : nb colonnes
	 */
	public function getNbColonnes() : int {
		
		return $this->nbColonnes;	
	}
	
	/**
	 * 
	 * @return array : tablier
	 */
	public function getTablier() : array {
	
		return $this->tablier;	
	}
	
	/**
	 * 
	 * @param int $numLigne
	 * @param int $numColonne
	 * @return CaseSolitaire : case correspondante
	 */
	public function getCase(int $numLigne, int $numColonne) : CaseSolitaire {
	
		return $this->tablier[$numLigne][$numColonne];	
	}
	
	/**
	 * 
	 * @param int $numLigne
	 * @param int $numColonne
	 * vide case
	 */
	public function videCase(int $numLigne, int $numColonne) {
		
		$this->tablier[$numLigne][$numColonne]->setValeur(0);
	}
	
	/**
	 * 
	 * @param int $numLigne
	 * @param int $numColonne
	 * remplit case
	 */
	public function remplitCase(int $numLigne, int $numColonne) {
		
		$this->tablier[$numLigne][$numColonne]->setValeur(1);
	}
	
	/**
	 * 
	 * @param int $numLigne
	 * @param int $numColonne
	 * neutralise case
	 */
	public function neutraliseCase(int $numLigne, int $numColonne) {
		
		$this->tablier[$numLigne][$numColonne]->setValeur(-1);
	}
	
	/**
	 * 
	 * @param int $numLigDepart
	 * @param int $numColDepart
	 * @param int $numLigArrivee
	 * @param int $numColArrivee
	 * @return bool : mouvement valide de [$numLigDepart][$numColDepart] vers [$numLigArrivee][$numColArrivee]
	 */
	public function estValideMvt(int $numLigDepart, int $numColDepart, int $numLigArrivee, int $numColArrivee) : bool {
	
		if($this->tablier[$numLigArrivee][$numColArrivee]->getValeur() == CaseSolitaire::VIDE) {
			
			if($this->tablier[($numLigArrivee + $numLigDepart)/2][($numColArrivee + $numColDepart)/2]->getValeur() == CaseSolitaire::BILLE) {
				
			    if($numLigArrivee - $numLigDepart = 2 && $numColDepart==$numColArrivee ||  $numLigArrivee - $numLigDepart = -2 && $numColDepart==$numColArrivee) {
				
					return true;
			    } elseif($numLigArrivee==$numLigDepart && $numColArrivee - $numColDepart = 2 || $numLigArrivee==$numLigDepart && $numColArrivee - $numColDepart = - 2) {
			
					return true;			
				}
			
				return false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * 
	 * @param int $numLigDepart
	 * @param int $numColDepart
	 * @param int $dir
	 * @return bool : mouvement valide de [$numLigDepart][$numColDepart] vers $dir
	 */
	public function estValideMvtDir(int $numLigDepart, int $numColDepart, int $dir) : bool {
	
	    if($this->tablier[$numLigDepart][$numColDepart]->getValeur() == 1) {
	        
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
	            
	            if($numColDepart - 2 > 0 && $this->tablier[$numLigDepart][$numColDepart-2]->getValeur() == CaseSolitaire::VIDE && $this->tablier[$numLigDepart][$numColDepart-1]->getValeur() == CaseSolitaire::BILLE) {
	                
	                return true;
	            }
	        }
	    }
		
		return false;
	}
	
	/**
	 * 
	 * @param int $numLigDepart
	 * @param int $numColDepart
	 * @return bool : si bille jouable
	 */
	public function isBilleJouable(int $numLigDepart, int $numColDepart) : bool {
		
		if($this->estValideMvtDir($numLigDepart, $numColDepart, 0) || $this->estValideMvtDir($numLigDepart, $numColDepart, 1) || $this->estValideMvtDir($numLigDepart, $numColDepart, 2) || $this->estValideMvtDir($numLigDepart, $numColDepart, 3)) {
			
			return true;
		}
		
		return false;
	}
	
	/**
	 * 
	 * @param int $numLigDepart
	 * @param int $numColDepart
	 * @param int $numLigArrivee
	 * @param int $numColArrivee
	 * deplace bille de [$numLigDepart][$numColDepart] vers [$numLigArrivee][$numColArrivee]
	 */
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
	
	/**
	 * 
	 * @param int $numLigDepart
	 * @param int $numColDepart
	 * @param int $dir
	 * deplace [$numLigDepart][$numColDepart] vers $dir
	 */
	public function deplaceBilleDir(int $numLigDepart, int $numColDepart, int $dir) {
		
		if($this->estValideMvtDir($numLigDepart, $numColDepart, $dir) == true) {
			
			if($dir == 0) {
			
				$this->tablier[$numLigDepart][$numColDepart]->setValeur(0);
				$this->tablier[$numLigDepart-1][$numColDepart]->setValeur(0);
				$this->tablier[$numLigDepart-2][$numColDepart]->setValeur(1);
			} elseif($dir == 2) {
			
				$this->tablier[$numLigDepart][$numColDepart]->setValeur(0);
				$this->tablier[$numLigDepart+1][$numColDepart]->setValeur(0);
				$this->tablier[$numLigDepart+2][$numColDepart]->setValeur(1);
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
	
	/**
	 * 
	 * @return String : toutes les cases du tablier
	 */
	public function __toString() : String{
	
		$res="";
		
		for($i=0; $i < $this->nbLignes; ++$i) {
			
			for($j = 0; $j < $this->nbColonnes; ++$j) {
			
				$res .= "[".$i."][".$j."] : ".$this->tablier[$i][$j]->__toString();
			}
			
			echo "\n";
		}
		
		return $res;
	}
	
	/**
	 * 
	 * @return bool : si fin de partie
	 */
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
						echo "Deplacement possible de la bille : [" . $i . "][" .$j . "]\n";
					}
				}	
			}
			
			if($deplacementPossible == false) {
			
				return true;	
			}
		}
		
		return false;
	}
	
	/**
	 * 
	 * @return bool : si victoire
	 */
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
	
	/**
	 * 
	 * @return TablierSolitaire : tablier gagnant
	 */
	public static function initTablierGagnant() : TablierSolitaire {
		
		$tabGagnant = new TablierSolitaire(5, 5);
		
		for($i=0; $i < $tabGagnant->nbLignes; ++$i) {
		    
		    for($j = 0; $j < $tabGagnant->nbColonnes; ++$j) {
		        
		        $tabGagnant->tablier[$i][$j]->setValeur(0);
		    }
		}
		
		$tabGagnant->tablier[2][2]->setValeur(1);
		
		return $tabGagnant;
	}
	
	/**
	 * 
	 * @return TablierSolitaire : tablier perdant
	 */
	public static function initTablierPerdant() : TablierSolitaire {
		
	    $tabPerdant = new TablierSolitaire(5, 5);
	    
	    for($i=0; $i < $tabPerdant->nbLignes; ++$i) {
	        
	        for($j = 0; $j < $tabPerdant->nbColonnes; ++$j) {
	            
	            $tabPerdant->tablier[$i][$j]->setValeur(0);
	        }
	    }
	    
	    $tabPerdant->tablier[2][2]->setValeur(1);
	    $tabPerdant->tablier[4][2]->setValeur(1);
	    
	    return $tabPerdant;
	}
	
	/**
	 * 
	 * @return TablierSolitaire : tablier europeen
	 */
	public static function initTablierEuropeen() : TablierSolitaire {
		
		$tab = new TablierSolitaire(9, 9);
		
		for($i=0; $i < $tab->nbLignes; ++$i) {
		    
		    for($j = 0; $j < $tab->nbColonnes; ++$j) {
		        
		        if($i < 3 && $j < 3 || $i < 3 && $j > 5 || $i > 5 && $j < 3 || $i > 5 && $j > 5) {
		            
		            $tab->tablier[$i][$j]->setValeur(-1);
		        } else if($i == 4 && $j == 4) {
		            
		            $tab->tablier[$i][$j]->setValeur(0);
		        } else {
		            
		            $tab->tablier[$i][$j]->setValeur(1);
		        }
		    }
		}
		
		return $tab;
	}
	
	/**
	 * 
	 * @return TablierSolitaire : tablier anglais
	 */
	public static function initTablierAnglais() : TablierSolitaire {
		
	    $tab = new TablierSolitaire(7, 7);
	    
	    for($i=0; $i < $tab->nbLignes; ++$i) {
	        
	        for($j = 0; $j < $tab->nbColonnes; ++$j) {
	            
	            if($i == 3 && $j == 3) {
	                
	                $tab->tablier[$i][$j]->setValeur(0);
	            } else if($i < 2 && $j < 2 || $i > 4 && $j < 2 || $i < 2 && $j > 4 || $i > 4 && $j > 4) {
	                
	                $tab->tablier[$i][$j]->setValeur(-1);
	            } else {
	                
	                $tab->tablier[$i][$j]->setValeur(1);
	            }
	        }
	    }
	    
	    return $tab;
	}
}
?>