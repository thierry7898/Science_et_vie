<?php
/* ecriture dans la base de données mysql des données necessaires a l'appli
a voir avec tableau excel pour croiser la possession et l'etat de la revue
*/
$servername = "savemysunday.com:3306";
/*$servername = "localhost";*/
$database = "duth1917_revues";
$username = "duth1917_thierry";
$password = "Annouchka1961";
$base_image ="https://www.savemysunday.com/s&v/images/";
$base_texte="https://www.savemysunday.com/s&v/sommaires/";
// Create connection

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($servername, $username, $password, $database);

$query = 'SELECT illustration, sommaire  FROM science';

// Utilise un itérateur
$result = $mysqli->query($query);
foreach ($result as $row) {
    printf("%s (%s)\n", $row["illustration"], $row["sommaire"]);
}

echo "\n==================\n";

    
  //mysqli_close($conn);
