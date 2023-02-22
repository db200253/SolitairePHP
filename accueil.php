<?php

/**
 * 
 * @author Baptiste Duvieu
 * @author Billal Zaidi
 */

require('./TablierSolitaireUI.php');

/**
 * 
 * Sélection du tablier
 */
$form="<div class = 'tile notification has-background-grey-dark has-text-white-ter' >
        <h4 class = 'subtitle is-4'>Veuillez selectionner un tablier</h4>
       </div>
       <div class = 'tile notification'>
        <form action='index.php' method='get'>
            <select size='1' name='tab'>
                <option selected='selected' value='Anglais' >Tablier Anglais</option>
                <option value='Europe'  >Tablier Europeen</option>
                <option value='Wiegleb' >Tablier de Wiegleb</option>
            </select></br></br>
            <p>
                <input class='submit' type='submit' name='jouer' value='jouer' />  
            </p></br>
        </form>
       </div>";

/**
 * 
 * colonnes pour alignement vertical
 */
$colonnes = "<div class = 'columns is-vcentered'>
                <div class = 'column'></div>
                <div class = 'column is-narrow'>
                    <br><br><br>" .
                    $form .
               "</div>
                <div class = 'column'></div>
            </div>";

$html = getDebutHTML() .
        $colonnes . 
        getFinHTML(); 

echo $html;
?>