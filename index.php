<?php 

require("./TablierSolitaireUI.php");

session_start();

$TablierSolitaire = TablierSolitaire::initTablierEuropeen();
$_SESSION['UI'] = new TablierSolitaireUI($TablierSolitaire);
$_SESSION['compteur'] = 0;

if($_SESSION['compteur'] == 0) {
    
    $_SESSION['debut'] = getDebutHTML("", "'https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma-rtl.min.css'");
    $_SESSION['debut'] .= "<section class='hero is-small is-primary'>
            <div class='hero-body'>
                <p class='title'>
                    Solitaire
                </p>
                <p class='subtitle'>
                    Jouez au jeu du solitaire !
                </p>
            </div>
        </section>";
    
    $html = $_SESSION['debut'] . $_SESSION['UI']->getFormulaireOrigine();
    $_SESSION['compteur'] += 1;
} else {
    
    $html = $_SESSION['debut'] . $_SESSION['UI']->getFormulaireOrigine();
    
    if(isset($_POST['coord'])) {
        
        $html = $_SESSION['debut'] . $_SESSION['UI']->getFormulaireDestination();
    }
}

$html .= getFinHTML();

echo $html;
?>