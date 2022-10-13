<?php
/* Test lecture  dans la base de données mysql des données necessaires a l'appli
//ok
*/
$servername = "savemysunday.com:3306";
/*$servername = "localhost";*/
$database = "duth1917_revues";
$table = "science";
$username = "duth1917_thierry";
$password = "Annouchka1961";
$base_image ="https://www.savemysunday.com/s&v/images/";
$base_texte="https://www.savemysunday.com/s&v/sommaires/";

// recupere parametre de la commande lecture/ajout/modif 
$action=$_POST["action"];
// tentative connexion base
$conn=new mysqli($servername,$username,$password,$database);
if ($conn->connect_error){
die("Echec Connexion :" .$conn->connect_error);
return;
}

// lecture toute la base
if ("GET_ALL" == $action){
$db_data=array();
$sql = "SELECT numero,illustration,sommaire,possession,etat,estimation from $table ORDER BY numero DESC";
$result =$conn->query($sql);
if ($result->num_rows >0) {
  while ($row = $result->fetch_assoc()){
    $db_data[]=$row;
  }
  //envoie reponse 
  echo json_encode($db_data);
}
else { echo " erreur";}
$conn->close();
return;
}



  //mysqli_close($conn);
