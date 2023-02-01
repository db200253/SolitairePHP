<?php
function getDebutHTML(string $title = "Title content", string $style = null) : string {
    
    $debutHtml = "<!doctype html>
      <html lang='fr'>
      	<head>
      		<meta charset='UTF-8'>
      		<title>";
    $debutHtml .= $title;
    $debutHtml .= "</title>
      					<link rel='stylesheet' href=$style>
                        <link rel='stylesheet' href='./stylePerso.css'>

      				</head>
      				<body>";
    
    return $debutHtml;
}

function getFinHTML(): string {
    
    $finHtml = '</body>
		</html>';
    
    return $finHtml;
}

function affichage(String $code) {

	echo $code;
}
?>