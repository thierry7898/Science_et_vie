<?php
$servername = "savemysunday.com:3306";
/*$servername = "localhost";*/
$database = "duth1917_revues";
$username = "duth1917_thierry";
$password = "Annouchka1961";
$base_image ="https://www.savemysunday.com/s&v/images/";
$base_texte="https://www.savemysunday.com/s&v/sommaires/";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    echo ("erreur");
      die("Échec de la connexion : " . mysqli_connect_error());
}

echo "Connexion réussie test ecriture 1060 lignes  : <br>";
for ($i=1; $i<1061; $i++) {
    //creation adresse de l'illustration  ok
    echo ("  ");
    //$numero = strval($i);
    //echo (numero);
    if (strlen($i)==1) { $numero = "s_000$i.jpg"; } 
    if (strlen($i)==2) { $numero = "s_00$i.jpg"; } 
    if (strlen($i)==3) { $numero = "s_0$i.jpg"; } 
    if (strlen($i)==4) { $numero = "s_$i.jpg"; } 
    $illustration = $base_image; 
    $illustration .= $numero ; 




 // creation texte ou enregistrement texte
 $sommaire = $base_texte;
 $sommaire .= $i;
 $sommaire .= ".s&v"; 

// sortie test des adressages
 //echo("$i  : $illustration , ");
 //echo ($sommaire) ;
 //echo(' <br>');
 
 // test resultats
 /*
 echo("$i  : $numero  : ");
 echo ('<img src="'); // affichage des images en test
 echo ($illustration) ;
 echo('"/> ');
  
$texte  = file_get_contents($sommaire);
echo $texte;  // les textes
echo('"/> <br>');
*/
 // ecriture 
$sql = "INSERT INTO science (numero, illustration,sommaire,possession,etat,estimation) VALUES ($i, '$illustration','$sommaire',0,0,0)";
if (mysqli_query($conn, $sql)) {
      echo "Nouveau enregistrement créé avec succès";
} else {
      echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
}
}
mysqli_close($conn);
?>
