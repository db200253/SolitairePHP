<?php

/**
 *
 * @author Baptiste Duvieu
 * @author Billal Zaidi
 */

/**
 * 
 * @return string : debut html avec bandeau
 */
function getDebutHTML() : string {
    
    $debutHtml = "<!doctype html>
      <html lang='fr'>
      	<head>
      		<meta charset='UTF-8'>
      		<title>";
    $debutHtml .= 'Solitaire';
    $debutHtml .= "</title>
      					<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma-rtl.min.css'>
                        <link rel='stylesheet' href='./stylePerso.css'>
                        
      				</head>
      				<body>
                        <section class='hero is-small has-background-grey-dark'>
           					 <div class='hero-body'>
              					<p class='title has-text-white-ter'>
                    				Solitaire
              					</p>
                				<p class='subtitle has-text-white-ter'>
                    				Jouez au jeu du solitaire !
                				</p>
            				</div>
        				</section>";
    
    return $debutHtml;
}

/**
 *  
 * @return string : fin html
 */
function getFinHTML(): string {
    
    $finHtml = '</body>
		</html>';
    
    return $finHtml;
}
?>