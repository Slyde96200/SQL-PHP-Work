<?php

/* connexion a la BD */
include '00_index.php'; 

echo 'Exercice 3';
echo '<h1>Voici tous les 20 premiers clients :</h1><br/>';

$query = "SELECT * FROM clients ORDER BY id ASC LIMIT 20";

// tentative de connexion et de récupération de la requete dans la base

try {
    $results = $database->query($query);
} catch (PDOException $e) {
    die("ERROR : " . $e->getMessage() . "<br />");
}

// conversion des données récupérées en un tableau + affichage 

$data = $results->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $array) {
    echo "<h5>" . $array["firstName"] . "</h5>";
}


?>