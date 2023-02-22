<?php

/**
 *
 * @author Baptiste Duvieu
 * @author Billal Zaidi
 */


require('./libFonction.php');

$form = "<div class = 'tile notification has-background-grey-dark has-text-white-ter' >
            <h4 class = 'subtitle is-4'>Generez votre plateau</h4>
         </div>
         <div class = 'tile notification'>
            <form action='./GenerePlateau.php' method='post'>
                <p>Nombre colonnes : <input type = 'number' name='colonne' min = '3' max = '8'></p>
                <p>Nombre lignes : <input type = 'number' name='ligne' min = '3' max = '8'></p>
                <br/>
                <p><input class='submit' type='submit' value='Selectionner' />
            </form>
         </div>";

$colonnes = "<div class = 'columns is-vcentered'>
                <div class = 'column'></div>
                <div class = 'column is-narrow'>
                    <br><br><br>" .
                    $form .
                    "</div>
                <div class = 'column'></div>
            </div>";

echo getDebutHTML() . $colonnes . getFinHTML();
?>