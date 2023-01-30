<?php

/* connexion a la BD */
include '00_index.php'; 

echo 'Exercice 2';
echo '<h1>Voici tous les spectacles :</h1><br/>';

$query = "SELECT * FROM shows";

// tentative de connexion et de récupération de la requete dans la base

try {
    $results = $database->query($query);
} catch (PDOException $e) {
    die("ERROR : " . $e->getMessage() . "<br />");
}

// conversion des données récupérées en un tableau + affichage 

$data = $results->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $array) {
    echo "<h5>" . $array["title"] . "<br></h5>";
}


?>